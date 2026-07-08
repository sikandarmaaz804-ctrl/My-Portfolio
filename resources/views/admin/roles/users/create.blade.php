@extends('layouts.admin')

@section('page_title', 'Create Role User')

@section('content')

<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Create Role User</h1>
        <p>Create a sub-admin account and assign a role that controls their access.</p>
    </div>
    <a href="{{ route('admin.role-users.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Back to Users
    </a>
</div>

@if($roles->isEmpty())
<div class="admin-card">
    <div style="text-align:center; padding:56px 24px; color:var(--text-muted);">
        <i class="bi bi-shield-exclamation" style="font-size:52px; opacity:0.2; display:block; margin-bottom:16px;"></i>
        <h5 style="font-weight:700; margin-bottom:8px;">No roles exist yet</h5>
        <p style="margin-bottom:20px;">You need to create at least one role before adding users.</p>
        <a href="{{ route('admin.roles.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-lg"></i> Create First Role
        </a>
    </div>
</div>
@else

<div class="row g-3 justify-content-center">
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="card-head">
                <h5><i class="bi bi-person-plus-fill me-2" style="color:var(--accent);"></i>User Details</h5>
            </div>
            <div class="card-body-p">

                <form action="{{ route('admin.role-users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label-custom">Full Name <span style="color:var(--danger)">*</span></label>
                        <input type="text" name="name" class="form-control-custom"
                               value="{{ old('name') }}" placeholder="e.g. John Doe" required>
                        @error('name')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Email Address <span style="color:var(--danger)">*</span></label>
                        <input type="email" name="email" class="form-control-custom"
                               value="{{ old('email') }}" placeholder="john@example.com" required>
                        @error('email')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Password <span style="color:var(--danger)">*</span></label>
                        <div style="position:relative;">
                            <input type="password" name="password" id="password" class="form-control-custom"
                                   placeholder="Minimum 8 characters" required style="padding-right:42px;">
                            <button type="button" onclick="togglePass('password')"
                                    style="position:absolute; right:12px; top:50%; transform:translateY(-50%);
                                           background:none; border:none; cursor:pointer; color:var(--text-muted); font-size:16px;">
                                <i class="bi bi-eye" id="eye-password"></i>
                            </button>
                        </div>
                        @error('password')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Confirm Password <span style="color:var(--danger)">*</span></label>
                        <div style="position:relative;">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control-custom" placeholder="Repeat password" required style="padding-right:42px;">
                            <button type="button" onclick="togglePass('password_confirmation')"
                                    style="position:absolute; right:12px; top:50%; transform:translateY(-50%);
                                           background:none; border:none; cursor:pointer; color:var(--text-muted); font-size:16px;">
                                <i class="bi bi-eye" id="eye-password_confirmation"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Assign Role <span style="color:var(--danger)">*</span></label>
                        <select name="role_id" class="form-control-custom" required id="roleSelect">
                            <option value="">— Select a role —</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                    data-color="{{ $role->color }}"
                                    data-perms="{{ $role->permissions->count() }}"
                                    {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                                ({{ $role->permissions->count() }} {{ Str::plural('permission', $role->permissions->count()) }})
                            </option>
                            @endforeach
                        </select>
                        @error('role_id')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror

                        <!-- Role preview card -->
                        <div id="rolePreview" style="display:none; margin-top:12px; padding:12px 16px;
                             border-radius:10px; border:1px solid var(--border); background:var(--body-bg);">
                            <div style="font-size:12px; color:var(--text-muted); font-weight:600; margin-bottom:6px;">Role Preview</div>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div id="rpIcon" style="width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                    <i class="bi bi-shield-fill" id="rpIconColor" style="font-size:15px;"></i>
                                </div>
                                <div>
                                    <span id="rpName" style="font-weight:700; font-size:14px;"></span>
                                    <div id="rpPerms" style="font-size:12px; color:var(--text-muted);"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex; gap:10px; justify-content:flex-end;">
                        <a href="{{ route('admin.role-users.index') }}" class="btn-ghost">Cancel</a>
                        <button type="submit" class="btn-primary-custom">
                            <i class="bi bi-person-plus-fill"></i> Create User
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function togglePass(id) {
        const input = document.getElementById(id);
        const icon  = document.getElementById('eye-' + id);
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }

    document.getElementById('roleSelect')?.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const preview  = document.getElementById('rolePreview');
        if (!this.value) { preview.style.display = 'none'; return; }

        const color = selected.dataset.color || '#6366f1';
        const perms = selected.dataset.perms;
        document.getElementById('rpIcon').style.background = color + '22';
        document.getElementById('rpIconColor').style.color = color;
        document.getElementById('rpName').textContent = selected.text.split('(')[0].trim();
        document.getElementById('rpPerms').textContent = perms + ' permission' + (perms !== '1' ? 's' : '');
        preview.style.display = 'block';
    });

    @if(session('error'))
    Swal.fire({ icon:'error', title:'Error', text:"{{ session('error') }}", confirmButtonColor:'#6366f1' });
    @endif
</script>
@endpush
