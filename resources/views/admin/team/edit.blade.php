@extends('layouts.admin')

@section('page_title', 'Edit Team Member')

@section('content')

<!-- Page Header -->
<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Edit Team Member</h1>
        <p>Update details for <strong>{{ $team->name }}</strong>.</p>
    </div>
    <a href="{{ route('admin.team.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Back to Team
    </a>
</div>

<!-- Form Card -->
<div class="admin-card">
    <div class="card-head">
        <h5><i class="bi bi-pencil-square me-2"></i>Member Details</h5>
    </div>
    <div class="card-body-p">
        <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-4">

                <!-- Name -->
                <div class="col-md-6">
                    <label class="form-label-custom">Full Name <span style="color:var(--danger);">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $team->name) }}"
                           class="form-control-custom @error('name') is-invalid @enderror"
                           required>
                    @error('name')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Position -->
                <div class="col-md-6">
                    <label class="form-label-custom">Position / Role <span style="color:var(--danger);">*</span></label>
                    <input type="text" name="position" value="{{ old('position', $team->position) }}"
                           class="form-control-custom @error('position') is-invalid @enderror"
                           required>
                    @error('position')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Expertise -->
                <div class="col-md-6">
                    <label class="form-label-custom">Expertise / Specialization <span style="color:var(--danger);">*</span></label>
                    <input type="text" name="expertise" value="{{ old('expertise', $team->expertise) }}"
                           class="form-control-custom @error('expertise') is-invalid @enderror"
                           required>
                    @error('expertise')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Experience Years -->
                <div class="col-md-3">
                    <label class="form-label-custom">Years of Experience <span style="color:var(--danger);">*</span></label>
                    <input type="number" name="experience_years"
                           value="{{ old('experience_years', $team->experience_years) }}"
                           class="form-control-custom @error('experience_years') is-invalid @enderror"
                           min="0" max="99" required>
                    @error('experience_years')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sort Order -->
                <div class="col-md-3">
                    <label class="form-label-custom">
                        Display Order
                        <span style="color:var(--text-muted); font-weight:400;">(optional)</span>
                    </label>
                    <input type="number" name="sort_order"
                           value="{{ old('sort_order', $team->sort_order) }}"
                           class="form-control-custom @error('sort_order') is-invalid @enderror"
                           min="0">
                    <small style="color:var(--text-muted); font-size:11px;">Lower numbers appear first.</small>
                    @error('sort_order')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-12">
                    <label class="form-label-custom">Short Description <span style="color:var(--danger);">*</span></label>
                    <textarea name="description" rows="3"
                              class="form-control-custom @error('description') is-invalid @enderror"
                              maxlength="1000" required>{{ old('description', $team->description) }}</textarea>
                    <small style="color:var(--text-muted); font-size:11px;">
                        <span id="desc-count">{{ strlen($team->description) }}</span>/1000 characters
                    </small>
                    @error('description')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Current Photo -->
                <div class="col-md-6">
                    <label class="form-label-custom">
                        Update Photo
                        <span style="color:var(--text-muted); font-weight:400;">(leave empty to keep current)</span>
                    </label>
                    <input type="file" name="photo" accept="image/*"
                           class="form-control-custom @error('photo') is-invalid @enderror"
                           onchange="previewPhoto(this)">
                    <small style="color:var(--text-muted); font-size:11px;">JPG, JPEG, PNG or WebP — max 2 MB.</small>
                    @error('photo')
                        <div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Photo Preview -->
                <div class="col-md-6 d-flex align-items-center">
                    <img id="photoPreview"
                         src="{{ asset('uploads/' . $team->photo) }}"
                         alt="{{ $team->name }}"
                         style="width:100px; height:100px; object-fit:cover; border-radius:50%; border:3px solid var(--border); box-shadow:0 4px 14px rgba(0,0,0,0.1);">
                </div>

            </div>

            <!-- Actions -->
            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn-primary-custom">
                    <i class="bi bi-check-lg"></i> Update Member
                </button>
                <a href="{{ route('admin.team.index') }}" class="btn-ghost">Cancel</a>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function previewPhoto(input) {
        const preview = document.getElementById('photoPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => { preview.src = e.target.result; };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Character counter
    const textarea = document.querySelector('textarea[name="description"]');
    const counter  = document.getElementById('desc-count');
    if (textarea && counter) {
        textarea.addEventListener('input', () => {
            counter.textContent = textarea.value.length;
        });
    }
</script>
@endpush
