@extends('layouts.admin')

@section('page_title', 'Media Library')

@section('content')

<!-- Page Header -->
<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Media Library</h1>
        <p>All uploaded blog images — {{ $blogs->count() }} {{ Str::plural('item', $blogs->count()) }}.</p>
    </div>
    <a href="{{ route('admin.blog') }}" class="btn-primary-custom">
        <i class="bi bi-plus-lg"></i> Upload New
    </a>
</div>

@if($blogs->count())

<!-- Search / Filter Bar -->
<div class="admin-card mb-3">
    <div class="card-body-p" style="padding:14px 18px;">
        <div class="row g-2 align-items-center">
            <div class="col-sm-6 col-md-4">
                <div style="position:relative;">
                    <i class="bi bi-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:var(--text-muted);"></i>
                    <input type="text" id="searchInput" class="form-control-custom" placeholder="Search by title..." style="padding-left:38px;">
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <select id="sortSelect" class="form-control-custom">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                    <option value="az">A → Z</option>
                    <option value="za">Z → A</option>
                </select>
            </div>
            <div class="col-md-auto ms-md-auto">
                <span style="font-size:13px; color:var(--text-muted);" id="resultCount">
                    Showing {{ $blogs->count() }} items
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Grid -->
<div class="row g-3" id="mediaGrid">
    @foreach($blogs as $blog)
    <div class="col-6 col-md-4 col-lg-3 media-item" data-title="{{ strtolower($blog->title) }}" data-date="{{ $blog->created_at->timestamp }}">
        <div class="admin-card h-100 media-card">

            <!-- Image -->
            <div style="position:relative; overflow:hidden;">
                <img src="{{ asset('uploads/'.$blog->image) }}"
                     class="media-img"
                     style="width:100%; height:160px; object-fit:cover; display:block; transition:transform 0.3s;"
                     onerror="this.src='https://via.placeholder.com/300x160'">
                <!-- Overlay on hover -->
                <div class="media-overlay" style="position:absolute; inset:0; background:rgba(15,23,42,0.55); display:flex; align-items:center; justify-content:center; gap:10px; opacity:0; transition:opacity 0.25s;">
                    <a href="{{ asset('uploads/'.$blog->image) }}" target="_blank"
                       class="topbar-btn" style="background:rgba(255,255,255,0.15); border-color:rgba(255,255,255,0.3); color:#fff;"
                       title="View Full Image">
                        <i class="bi bi-eye"></i>
                    </a>
                </div>
            </div>

            <!-- Info -->
            <div class="card-body-p" style="padding:12px 14px;">
                <div style="font-size:13px; font-weight:600; margin-bottom:4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="{{ $blog->title }}">
                    {{ $blog->title }}
                </div>
                <div style="font-size:11px; color:var(--text-muted); margin-bottom:12px;">
                    {{ $blog->created_at->format('M d, Y') }}
                </div>

                <!-- Actions -->
                <div style="display:flex; gap:6px;">
                    <a href="{{ route('blog.popup', $blog->id) }}" target="_blank"
                       class="btn-info-custom" style="flex:1; justify-content:center; padding:6px 10px; font-size:11px;">
                        <i class="bi bi-eye"></i>
                    </a>
                    <button type="button"
                            class="btn-danger-custom delete-btn"
                            data-id="{{ $blog->id }}"
                            style="flex:1; justify-content:center; padding:6px 10px; font-size:11px;">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>

                <!-- Hidden delete form -->
                <form id="delete-form-{{ $blog->id }}" action="{{ route('admin.blog.delete', $blog->id) }}" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>

        </div>
    </div>
    @endforeach
</div>

@else

<!-- Empty State -->
<div class="admin-card">
    <div class="card-body-p" style="text-align:center; padding:80px 24px;">
        <i class="bi bi-images" style="font-size:72px; opacity:0.1; display:block; margin-bottom:20px;"></i>
        <h5 style="color:var(--text-muted); margin-bottom:8px;">No Uploads Yet</h5>
        <p style="color:var(--text-muted); font-size:14px; margin-bottom:24px;">Create a blog post to upload your first image.</p>
        <a href="{{ route('admin.blog') }}" class="btn-primary-custom">
            <i class="bi bi-cloud-upload"></i> Upload First Image
        </a>
    </div>
</div>

@endif

@endsection

@push('styles')
<style>
    .media-card:hover .media-overlay { opacity: 1 !important; }
    .media-card:hover .media-img { transform: scale(1.05); }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Delete with SweetAlert
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Delete Image?',
                text: "This will also delete the blog post permanently.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        });
    });

    // Search filter
    const searchInput = document.getElementById('searchInput');
    const items = document.querySelectorAll('.media-item');
    const resultCount = document.getElementById('resultCount');

    if (searchInput) {
        searchInput.addEventListener('input', filterMedia);
    }

    function filterMedia() {
        const q = searchInput.value.toLowerCase();
        let visible = 0;
        items.forEach(item => {
            const match = item.getAttribute('data-title').includes(q);
            item.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        if (resultCount) resultCount.textContent = `Showing ${visible} items`;
    }

    // Sorting logic
    const sortSelect = document.getElementById('sortSelect');
    const mediaGrid = document.getElementById('mediaGrid');
    
    if (sortSelect && mediaGrid && items.length > 0) {
        sortSelect.addEventListener('change', function() {
            const val = this.value;
            const itemArr = Array.from(items);
            
            itemArr.sort((a, b) => {
                if (val === 'newest') {
                    return b.getAttribute('data-date') - a.getAttribute('data-date');
                } else if (val === 'oldest') {
                    return a.getAttribute('data-date') - b.getAttribute('data-date');
                } else if (val === 'az') {
                    return a.getAttribute('data-title').localeCompare(b.getAttribute('data-title'));
                } else if (val === 'za') {
                    return b.getAttribute('data-title').localeCompare(a.getAttribute('data-title'));
                }
                return 0;
            });
            
            itemArr.forEach(item => mediaGrid.appendChild(item));
        });
    }

    // Success toast
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Done!',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
    @endif
</script>
@endpush
