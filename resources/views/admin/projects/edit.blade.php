@extends('layouts.admin')

@section('page_title', 'Edit Project')

@section('content')

<!-- Page Header -->
<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Edit Project</h1>
        <p>Update the details for <strong>{{ $project->title }}</strong>.</p>
    </div>
    <a href="{{ route('admin.projects.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Back to Projects
    </a>
</div>

<!-- Form Card -->
<div class="admin-card">
    <div class="card-head">
        <h5><i class="bi bi-pencil-square me-2"></i>Project Details</h5>
    </div>
    <div class="card-body-p">
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <!-- Title -->
                <div class="col-md-6">
                    <label class="form-label-custom">Project Title <span style="color:var(--danger);">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}"
                           class="form-control-custom @error('title') is-invalid @enderror"
                           required>
                    @error('title')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Client Name -->
                <div class="col-md-6">
                    <label class="form-label-custom">Client Name <span style="color:var(--danger);">*</span></label>
                    <input type="text" name="client_name" value="{{ old('client_name', $project->client_name) }}"
                           class="form-control-custom @error('client_name') is-invalid @enderror"
                           required>
                    @error('client_name')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="col-md-6">
                    <label class="form-label-custom">Category <span style="color:var(--danger);">*</span></label>
                    <select name="category" class="form-control-custom @error('category') is-invalid @enderror" required>
                        <option value="" disabled>— Select a category —</option>
                        <option value="manipul"  {{ old('category', $project->category) === 'manipul'  ? 'selected' : '' }}>Web Development</option>
                        <option value="creative" {{ old('category', $project->category) === 'creative' ? 'selected' : '' }}>UI/UX Design</option>
                        <option value="brand"    {{ old('category', $project->category) === 'brand'    ? 'selected' : '' }}>Branding</option>
                        <option value="mobile"   {{ old('category', $project->category) === 'mobile'   ? 'selected' : '' }}>Mobile Applications</option>
                        <option value="desktop"  {{ old('category', $project->category) === 'desktop'  ? 'selected' : '' }}>Desktop Applications</option>
                    </select>
                    @error('category')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Website Link <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                    <input type="url" name="website_link" value="{{ old('website_link', $project->website_link) }}"
                           class="form-control-custom @error('website_link') is-invalid @enderror"
                           placeholder="https://example.com">
                    @error('website_link')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image 1 -->
                <div class="col-md-4">
                    <label class="form-label-custom">Main Image</label>
                    @if($project->image1)
                        <img src="{{ asset('uploads/' . $project->image1) }}"
                             id="prev1"
                             alt="Current image"
                             style="display:block; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border); margin-bottom:8px;">
                    @else
                        <img id="prev1" src="#" alt="Preview"
                             style="display:none; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border); margin-bottom:8px;">
                    @endif
                    <input type="file" name="image1" accept="image/*"
                           class="form-control-custom @error('image1') is-invalid @enderror"
                           onchange="previewImage(this, 'prev1')">
                    <small style="color:var(--text-muted); font-size:11px;">Leave empty to keep current image.</small>
                    @error('image1')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image 2 -->
                <div class="col-md-4">
                    <label class="form-label-custom">Image 2 <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                    @if($project->image2)
                        <img src="{{ asset('uploads/' . $project->image2) }}"
                             id="prev2"
                             alt="Current image 2"
                             style="display:block; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border); margin-bottom:8px;">
                    @else
                        <img id="prev2" src="#" alt="Preview"
                             style="display:none; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border); margin-bottom:8px;">
                    @endif
                    <input type="file" name="image2" accept="image/*"
                           class="form-control-custom @error('image2') is-invalid @enderror"
                           onchange="previewImage(this, 'prev2')">
                    <small style="color:var(--text-muted); font-size:11px;">Leave empty to keep current image.</small>
                    @error('image2')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image 3 -->
                <div class="col-md-4">
                    <label class="form-label-custom">Image 3 <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                    @if($project->image3)
                        <img src="{{ asset('uploads/' . $project->image3) }}"
                             id="prev3"
                             alt="Current image 3"
                             style="display:block; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border); margin-bottom:8px;">
                    @else
                        <img id="prev3" src="#" alt="Preview"
                             style="display:none; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border); margin-bottom:8px;">
                    @endif
                    <input type="file" name="image3" accept="image/*"
                           class="form-control-custom @error('image3') is-invalid @enderror"
                           onchange="previewImage(this, 'prev3')">
                    <small style="color:var(--text-muted); font-size:11px;">Leave empty to keep current image.</small>
                    @error('image3')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label-custom">Image 4 <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                    @if($project->image4)
                        <img src="{{ asset('uploads/' . $project->image4) }}"
                             id="prev4"
                             alt="Current image 4"
                             style="display:block; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border); margin-bottom:8px;">
                    @else
                        <img id="prev4" src="#" alt="Preview"
                             style="display:none; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border); margin-bottom:8px;">
                    @endif
                    <input type="file" name="image4" accept="image/*"
                           class="form-control-custom @error('image4') is-invalid @enderror"
                           onchange="previewImage(this, 'prev4')">
                    <small style="color:var(--text-muted); font-size:11px;">Leave empty to keep current image.</small>
                    @error('image4')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label-custom">Image 5 <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                    @if($project->image5)
                        <img src="{{ asset('uploads/' . $project->image5) }}"
                             id="prev5"
                             alt="Current image 5"
                             style="display:block; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border); margin-bottom:8px;">
                    @else
                        <img id="prev5" src="#" alt="Preview"
                             style="display:none; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border); margin-bottom:8px;">
                    @endif
                    <input type="file" name="image5" accept="image/*"
                           class="form-control-custom @error('image5') is-invalid @enderror"
                           onchange="previewImage(this, 'prev5')">
                    <small style="color:var(--text-muted); font-size:11px;">Leave empty to keep current image.</small>
                    @error('image5')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label-custom">Image 6 <span style="color:var(--text-muted); font-weight:400;">(optional)</span></label>
                    @if($project->image6)
                        <img src="{{ asset('uploads/' . $project->image6) }}"
                             id="prev6"
                             alt="Current image 6"
                             style="display:block; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border); margin-bottom:8px;">
                    @else
                        <img id="prev6" src="#" alt="Preview"
                             style="display:none; width:100%; height:120px; object-fit:cover; border-radius:10px; border:1px solid var(--border); margin-bottom:8px;">
                    @endif
                    <input type="file" name="image6" accept="image/*"
                           class="form-control-custom @error('image6') is-invalid @enderror"
                           onchange="previewImage(this, 'prev6')">
                    <small style="color:var(--text-muted); font-size:11px;">Leave empty to keep current image.</small>
                    @error('image6')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn-primary-custom">
                    <i class="bi bi-check-lg"></i> Update Project
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
