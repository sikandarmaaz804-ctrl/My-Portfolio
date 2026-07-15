@extends('layouts.admin')

@section('page_title', 'Add Project')

@section('content')

<!-- Page Header -->
<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Add Project</h1>
        <p>Fill in the details to add a new portfolio project.</p>
    </div>
    <a href="{{ route('admin.projects.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Back to Projects
    </a>
</div>

<!-- Form Card -->
<div class="admin-card">
    <div class="card-head">
        <h5><i class="bi bi-folder-plus me-2"></i>Project Details</h5>
    </div>
    <div class="card-body-p">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- Title -->
                <div class="col-md-6">
                    <label class="form-label-custom">Project Title <span style="color:var(--danger);">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="form-control-custom @error('title') is-invalid @enderror"
                           placeholder="e.g. E-Commerce Website" required>
                    @error('title')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Client Name -->
                <div class="col-md-6">
                    <label class="form-label-custom">Client Name <span style="color:var(--danger);">*</span></label>
                    <input type="text" name="client_name" value="{{ old('client_name') }}"
                           class="form-control-custom @error('client_name') is-invalid @enderror"
                           placeholder="e.g. John Doe" required>
                    @error('client_name')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="col-md-6">
                    <label class="form-label-custom">Category <span style="color:var(--danger);">*</span></label>
                    <select name="category" class="form-control-custom @error('category') is-invalid @enderror" required>
                        <option value="" disabled {{ old('category') ? '' : 'selected' }}>— Select a category —</option>
                        <option value="manipul"  {{ old('category') === 'manipul'  ? 'selected' : '' }}>Web Development</option>
                        <option value="creative" {{ old('category') === 'creative' ? 'selected' : '' }}>UI/UX Design</option>
                        <option value="brand"    {{ old('category') === 'brand'    ? 'selected' : '' }}>Branding</option>
                        <option value="mobile"   {{ old('category') === 'mobile'   ? 'selected' : '' }}>Mobile Applications</option>
                        <option value="desktop"  {{ old('category') === 'desktop'  ? 'selected' : '' }}>Desktop Applications</option>
                    </select>
                    @error('category')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Website Link <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                    <input type="url" name="website_link" value="{{ old('website_link') }}"
                           class="form-control-custom @error('website_link') is-invalid @enderror"
                           placeholder="https://example.com">
                    @error('website_link')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image 1 -->
                <div class="col-md-4">
                    <label class="form-label-custom">Main Image <span style="color:var(--danger);">*</span></label>
                    <input type="file" name="image1" accept="image/*"
                           class="form-control-custom @error('image1') is-invalid @enderror"
                           onchange="previewImage(this, 'prev1')" required>
                    @error('image1')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                    <img id="prev1" src="#" alt="Preview"
                         style="display:none; margin-top:10px; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border);">
                </div>

                <!-- Image 2 -->
                <div class="col-md-4">
                    <label class="form-label-custom">Image 2 <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                    <input type="file" name="image2" accept="image/*"
                           class="form-control-custom @error('image2') is-invalid @enderror"
                           onchange="previewImage(this, 'prev2')">
                    @error('image2')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                    <img id="prev2" src="#" alt="Preview"
                         style="display:none; margin-top:10px; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border);">
                </div>

                <!-- Image 3 -->
                <div class="col-md-4">
                    <label class="form-label-custom">Image 3 <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                    <input type="file" name="image3" accept="image/*"
                           class="form-control-custom @error('image3') is-invalid @enderror"
                           onchange="previewImage(this, 'prev3')">
                    @error('image3')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                    <img id="prev3" src="#" alt="Preview"
                         style="display:none; margin-top:10px; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border);">
                </div>

                <div class="col-md-4">
                    <label class="form-label-custom">Image 4 <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                    <input type="file" name="image4" accept="image/*"
                           class="form-control-custom @error('image4') is-invalid @enderror"
                           onchange="previewImage(this, 'prev4')">
                    @error('image4')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                    <img id="prev4" src="#" alt="Preview"
                         style="display:none; margin-top:10px; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border);">
                </div>

                <div class="col-md-4">
                    <label class="form-label-custom">Image 5 <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                    <input type="file" name="image5" accept="image/*"
                           class="form-control-custom @error('image5') is-invalid @enderror"
                           onchange="previewImage(this, 'prev5')">
                    @error('image5')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                    <img id="prev5" src="#" alt="Preview"
                         style="display:none; margin-top:10px; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border);">
                </div>

                <div class="col-md-4">
                    <label class="form-label-custom">Image 6 <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                    <input type="file" name="image6" accept="image/*"
                           class="form-control-custom @error('image6') is-invalid @enderror"
                           onchange="previewImage(this, 'prev6')">
                    @error('image6')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                    <img id="prev6" src="#" alt="Preview"
                         style="display:none; margin-top:10px; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border);">
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn-primary-custom">
                    <i class="bi bi-check-lg"></i> Save Project
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn-ghost">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
