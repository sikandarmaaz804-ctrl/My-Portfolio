@extends('layouts.admin')

@section('page_title', 'New Blog Post')

@push('styles')
<style>
    .image-preview-box {
        width: 100%;
        height: 200px;
        border: 2px dashed var(--border);
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        overflow: hidden;
        background: #fafbff;
    }
    .image-preview-box:hover {
        border-color: var(--accent);
        background: rgba(99,102,241,0.03);
    }
    .image-preview-box img {
        width: 100%; height: 100%; object-fit: cover;
    }
    .char-count {
        font-size: 12px;
        color: var(--text-muted);
        text-align: right;
        margin-top: 4px;
    }
</style>
@endpush

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h1>New Blog Post</h1>
    <p>Create and publish a new blog article.</p>
</div>

<div class="row g-3">

    <!-- Form -->
    <div class="col-lg-8">
        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
            @csrf

            <!-- Main Content Card -->
            <div class="admin-card mb-3">
                <div class="card-head">
                    <h5><i class="bi bi-pencil-square me-2"></i>Post Content</h5>
                </div>
                <div class="card-body-p">

                    <!-- Title -->
                    <div class="mb-4">
                        <label class="form-label-custom">Post Title <span style="color:var(--danger);">*</span></label>
                        <input type="text"
                               name="title"
                               class="form-control-custom"
                               placeholder="Enter an engaging blog title..."
                               maxlength="255"
                               id="blogTitle"
                               value="{{ old('title') }}"
                               required>
                        <div class="char-count" id="titleCount">0 / 255</div>
                        @error('title')
                            <div style="font-size:12px; color:var(--danger); margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-2">
                        <label class="form-label-custom">Content <span style="color:var(--danger);">*</span></label>
                        <textarea name="description"
                                  class="form-control-custom"
                                  rows="10"
                                  placeholder="Write your blog content here..."
                                  id="blogContent"
                                  required>{{ old('description') }}</textarea>
                        <div class="char-count" id="contentCount">0 characters</div>
                        @error('description')
                            <div style="font-size:12px; color:var(--danger); margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Submit (mobile) -->
            <div class="d-lg-none">
                <button type="submit" class="btn-primary-custom w-100 justify-content-center" style="padding:12px;">
                    <i class="bi bi-cloud-upload"></i> Publish Blog
                </button>
            </div>

        </form>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">

        <!-- Featured Image -->
        <div class="admin-card mb-3">
            <div class="card-head">
                <h5><i class="bi bi-image me-2"></i>Featured Image</h5>
            </div>
            <div class="card-body-p">
                <label for="imageInput" class="image-preview-box" id="imagePreview">
                    <i class="bi bi-cloud-upload" style="font-size:32px; margin-bottom:8px; opacity:0.4;"></i>
                    <span>Click to upload image</span>
                    <small style="font-size:12px; margin-top:4px; opacity:0.6;">JPG, PNG, WEBP</small>
                </label>
                <input type="file" name="image" id="imageInput" accept="image/*" required
                       style="display:none;" form="blogForm">
                @error('image')
                    <div style="font-size:12px; color:var(--danger); margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Publish Card -->
        <div class="admin-card">
            <div class="card-head">
                <h5><i class="bi bi-send me-2"></i>Publish</h5>
            </div>
            <div class="card-body-p">
                <div style="font-size:13px; color:var(--text-muted); margin-bottom:16px; display:flex; align-items:center; gap:8px;">
                    <i class="bi bi-globe"></i> Status: <strong style="color:var(--success);">Public</strong>
                </div>
                <button type="submit" form="blogForm" class="btn-primary-custom w-100 justify-content-center" style="padding:11px;">
                    <i class="bi bi-cloud-upload"></i> Publish Blog Post
                </button>
                <a href="{{ route('admin.blogs') }}" class="btn-ghost w-100 mt-2 justify-content-center">
                    <i class="bi bi-x-lg"></i> Discard
                </a>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    // Image preview
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Char counters
    const titleInput   = document.getElementById('blogTitle');
    const titleCount   = document.getElementById('titleCount');
    const contentInput = document.getElementById('blogContent');
    const contentCount = document.getElementById('contentCount');

    function updateCount(input, display, max) {
        input.addEventListener('input', () => {
            display.textContent = max
                ? `${input.value.length} / ${max}`
                : `${input.value.length} characters`;
        });
        // init
        display.textContent = max
            ? `${input.value.length} / ${max}`
            : `${input.value.length} characters`;
    }

    updateCount(titleInput, titleCount, 255);
    updateCount(contentInput, contentCount, null);
</script>
@endpush
