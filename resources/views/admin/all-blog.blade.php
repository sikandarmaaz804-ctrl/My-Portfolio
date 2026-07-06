@extends('layouts.admin')

@section('page_title', 'All Blogs')

@section('content')

<!-- Page Header -->
<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>All Blogs</h1>
        <p>Manage all your blog posts in one place.</p>
    </div>
    <a href="{{ route('admin.blog') }}" class="btn-primary-custom">
        <i class="bi bi-plus-lg"></i> New Blog
    </a>
</div>

<!-- Blogs Grid -->
@if($blogs->count())
<div class="row g-3">
    @foreach($blogs as $blog)
    <div class="col-sm-6 col-lg-4 col-xl-3">
        <div class="admin-card h-100">
            <!-- Image -->
            <div style="position:relative; overflow:hidden;">
                <img src="{{ asset('uploads/'.$blog->image) }}"
                     style="width:100%; height:180px; object-fit:cover; display:block;"
                     onerror="this.src='https://via.placeholder.com/400x180'">
                <div style="position:absolute; top:10px; right:10px;">
                    <span class="badge-status read">Published</span>
                </div>
            </div>

            <!-- Content -->
            <div class="card-body-p">
                <h5 style="font-size:15px; font-weight:700; margin-bottom:8px; line-height:1.4;">
                    {{ $blog->title }}
                </h5>
                <p style="font-size:13px; color:var(--text-muted); margin-bottom:10px; line-height:1.5;">
                    {{ \Illuminate\Support\Str::limit($blog->description, 80) }}
                </p>

                <!-- Meta -->
                <div style="display:flex; align-items:center; gap:10px; font-size:12px; color:var(--text-muted); margin-bottom:14px; padding-top:10px; border-top:1px solid var(--border);">
                    <span><i class="bi bi-calendar3"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                    <span><i class="bi bi-chat-dots"></i> {{ $blog->comments->count() }}</span>
                </div>

                <!-- Actions -->
                <div style="display:flex; gap:8px;">
                    <a href="{{ route('blog.popup', $blog->id) }}" target="_blank" class="btn-info-custom" style="flex:1; justify-content:center;">
                        <i class="bi bi-eye"></i> View
                    </a>
                    <button type="button" class="btn-danger-custom delete-blog" data-id="{{ $blog->id }}" style="flex:1; justify-content:center;">
                        <i class="bi bi-trash"></i> Delete
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
<div class="admin-card">
    <div class="card-body-p" style="text-align:center; padding:64px 24px;">
        <i class="bi bi-journal-x" style="font-size:64px; opacity:0.15; display:block; margin-bottom:16px;"></i>
        <h5 style="color:var(--text-muted); margin-bottom:8px;">No Blogs Found</h5>
        <p style="color:var(--text-muted); font-size:14px; margin-bottom:24px;">Start creating amazing content for your audience.</p>
        <a href="{{ route('admin.blog') }}" class="btn-primary-custom">
            <i class="bi bi-plus-lg"></i> Create First Blog
        </a>
    </div>
</div>
@endif

@endsection

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelectorAll('.delete-blog').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.getAttribute('data-id');

        Swal.fire({
            title: 'Delete Blog?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    });
});

@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: "{{ session('success') }}",
    timer: 2500,
    showConfirmButton: false
});
@endif
</script>
@endpush
