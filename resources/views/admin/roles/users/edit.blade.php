@extends('layouts.admin')

@section('page_title', 'Edit User — ' . $roleUser->name)

@section('content')

<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Edit User: {{ $roleUser->name }}</h1>
        <p>Update login credentials, role, or account status.</p>
    </div>
    <a href="{{ route('admin.role-users.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Back to Users
    </a>
</div>

<div class="row g-3 justify-content-center">
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="card-head">
                <h5><i class="bi bi-person-gear me-2" style="color:var(--accent);"></i>User Details</h5>
                <span class="badge-status {{ $roleUser->is_active ? 'read' : 'unread' }}">
                    {{ $roleUser->is_active ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <div class="card-body-p">

                <form action="{{ route('admin.role-users.update', $roleUser->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label-custom">Full Name <span style="color:var(--danger)">*</span></label>
                        <input type="text" name="name" class="form-control-custom"
                               value="{{ old('name', $roleUser->name) }}" required>
                        @error('name')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Email Address <span style="color:var(--danger)">*</span></label>
                        <input type="email" name="email" class="form-control-custom"
                               value="{{ old('email', $roleUser->email) }}" required>
                        @error('email')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">New Password <span style="color:var(--text-muted); font-weight:400;">(leave blank to keep current)</span></label>
                        <div style="position:relative;">
                            <input type="password" name="password" id="password"
                                   class="form-control-custom" placeholder="Minimum 8 characters" style="padding-right:42px;">
                            <button type="button" onclick="togglePass('password')"
                                    style="position:absolute; right:12px; top:50%; transform:translateY(-50%);
                                           background:none; border:none; cursor:pointer; color:var(--text-muted); font-size:16px;">
                                <i class="bi bi-eye" id="eye-password"></i>
                            </button>
                        </div>
                        @error('password')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Confirm New Password</label>
                        <div style="position:relative;">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="form-control-custom" placeholder="Repeat new password" style="padding-right:42px;">
                            <button type="button" onclick="togglePass('password_confirmation')"
                                    style="position:absolute; right:12px; top:50%; transform:translateY(-50%);
                                           background:none; border:none; cursor:pointer; color:var(--text-muted); font-size:16px;">
                                <i class="bi bi-eye" id="eye-password_confirmation"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Assign Role <span style="color:var(--danger)">*</span></label>
                        <select name="role_id" class="form-control-custom" required id="roleSelect">
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                    data-color="{{ $role->color }}"
                                    data-perms="{{ $role->permissions->count() }}"
                                    {{ old('role_id', $roleUser->role_id) == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                                ({{ $role->permissions->count() }} {{ Str::plural('permission', $role->permissions->count()) }})
                            </option>
                            @endforeach
                        </select>
                        @error('role_id')<div style="color:var(--danger); font-size:12px; margin-top:4px;">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Account Status</label>
                        <div style="display:flex; gap:12px; flex-wrap:wrap;">
                            <label style="display:flex; align-items:center; gap:8px; cursor:pointer; padding:10px 16px;
                                          border:1px solid var(--border); border-radius:8px; transition:all 0.2s;"
                                   id="activeLabel">
                                <input type="radio" name="is_active" value="1"
                                       {{ old('is_active', $roleUser->is_active ? '1' : '0') == '1' ? 'checked' : '' }}
                                       style="accent-color:var(--success);"
                                       onchange="highlightStatus()">
                                <i class="bi bi-check-circle-fill" style="color:var(--success);"></i>
                                <span style="font-size:13px; font-weight:600;">Active</span>
                            </label>
                            <label style="display:flex; align-items:center; gap:8px; cursor:pointer; padding:10px 16px;
                                          border:1px solid var(--border); border-radius:8px; transition:all 0.2s;"
                                   id="inactiveLabel">
                                <input type="radio" name="is_active" value="0"
                                       {{ old('is_active', $roleUser->is_active ? '1' : '0') == '0' ? 'checked' : '' }}
                                       style="accent-color:var(--warning);"
                                       onchange="highlightStatus()">
                                <i class="bi bi-pause-circle-fill" style="color:var(--warning);"></i>
                                <span style="font-size:13px; font-weight:600;">Inactive</span>
                            </label>
                        </div>
                        <div style="font-size:12px; color:var(--text-muted); margin-top:6px;">
                            Inactive users cannot log in until reactivated.
                        </div>
                    </div>

                    <!-- Last login info -->
                    @if($roleUser->last_login_at)
                    <div style="padding:10px 14px; background:var(--body-bg); border-radius:8px; margin-bottom:20px; font-size:13px; color:var(--text-muted);">
                        <i class="bi bi-clock me-1"></i>
                        Last logged in: <strong>{{ $roleUser->last_login_at->diffForHumans() }}</strong>
                        ({{ $roleUser->last_login_at->format('M d, Y — H:i') }})
                    </div>
                    @endif

                    <div style="display:flex; gap:10px; justify-content:flex-end;">
                        <a href="{{ route('admin.role-users.index') }}" class="btn-ghost">Cancel</a>
                        <button type="submit" class="btn-primary-custom">
                            <i class="bi bi-check2"></i> Save Changes
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function togglePass(id) {
        const input = document.getElementById(id);
        const icon  = document.getElementById('eye-' + id);
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    }

    function highlightStatus() {
        const active   = document.querySelector('[name="is_active"][value="1"]').checked;
        document.getElementById('activeLabel').style.borderColor   = active ? 'var(--success)' : 'var(--border)';
        document.getElementById('activeLabel').style.background    = active ? 'rgba(16,185,129,0.06)' : '';
        document.getElementById('inactiveLabel').style.borderColor = !active ? 'var(--warning)' : 'var(--border)';
        document.getElementById('inactiveLabel').style.background  = !active ? 'rgba(245,158,11,0.06)' : '';
    }
    highlightStatus();

    @if(session('success'))
    Swal.fire({ icon:'success', title:'Done!', text:"{{ session('success') }}", timer:2500, showConfirmButton:false, toast:true, position:'top-end' });
    @endif
</script>
@endpush
