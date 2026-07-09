@extends('layouts.admin')

@section('page_title', 'Role Users')

@section('content')

@php
    use App\Helpers\PermissionHelper;
@endphp

<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Role Users</h1>
        <p>{{ $users->count() }} sub-admin {{ Str::plural('account', $users->count()) }}. Each account has a role that controls its access.</p>
    </div>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        @if(PermissionHelper::can('roles.view'))
        <a href="{{ route('admin.roles.index') }}" class="btn-ghost">
            <i class="bi bi-shield-fill"></i> Manage Roles
        </a>
        @endif
        <a href="{{ route('admin.role-users.create') }}" class="btn-primary-custom">
            <i class="bi bi-person-plus-fill"></i> New User
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="card-head">
        <h5><i class="bi bi-people-fill me-2"></i>All Role Users</h5>
        <div style="position:relative;">
            <i class="bi bi-search" style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:13px;"></i>
            <input type="text" id="searchUsers" class="form-control-custom"
                   placeholder="Search users..."
                   style="padding-left:32px; padding-top:7px; padding-bottom:7px; font-size:13px; min-width:220px;">
        </div>
    </div>

    @if($users->isEmpty())
    <div style="text-align:center; padding:64px 24px; color:var(--text-muted);">
        <i class="bi bi-person-x" style="font-size:48px; opacity:0.2; display:block; margin-bottom:12px;"></i>
        No role users yet.
        <a href="{{ route('admin.role-users.create') }}" style="color:var(--accent); text-decoration:none; font-weight:600;">
            Create your first →
        </a>
    </div>
    @else
    <div style="overflow-x:auto;">
        <table class="admin-table" id="usersTable">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="d-none d-md-table-cell">Status</th>
                    <th class="d-none d-lg-table-cell">Last Login</th>
                    <th class="d-none d-sm-table-cell">Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="user-row"
                    data-search="{{ strtolower($user->name . ' ' . $user->email . ' ' . ($user->role->name ?? '')) }}">
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="
                                width:38px; height:38px; border-radius:50%;
                                background: linear-gradient(135deg, {{ $user->role->color ?? '#6366f1' }}, {{ $user->role->color ?? '#818cf8' }}88);
                                display:flex; align-items:center; justify-content:center;
                                color:#fff; font-weight:700; font-size:14px; flex-shrink:0;
                            ">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            <span style="font-weight:600; font-size:14px;">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td><span style="font-size:13px; color:var(--text-muted);">{{ $user->email }}</span></td>
                    <td>
                        @if($user->role)
                        <span style="
                            font-size:12px; font-weight:700; padding:3px 10px; border-radius:20px;
                            background: {{ $user->role->color }}22; color: {{ $user->role->color }};
                        ">{{ $user->role->name }}</span>
                        @else
                        <span style="font-size:12px; color:var(--text-muted);">—</span>
                        @endif
                    </td>
                    <td class="d-none d-md-table-cell">
                        <span class="badge-status {{ $user->is_active ? 'read' : 'unread' }}">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="d-none d-lg-table-cell">
                        <span style="font-size:13px; color:var(--text-muted);">
                            {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                        </span>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <span style="font-size:13px; color:var(--text-muted);">{{ $user->created_at->format('M d, Y') }}</span>
                    </td>
                    <td>
                        <div style="display:flex; gap:6px; flex-wrap:wrap;">
                            <a href="{{ route('admin.role-users.edit', $user->id) }}"
                               class="btn-info-custom" style="padding:6px 12px; font-size:12px;">
                                <i class="bi bi-pencil"></i>
                                <span class="d-none d-sm-inline">Edit</span>
                            </a>

                            <form action="{{ route('admin.role-users.toggle', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit"
                                        class="{{ $user->is_active ? 'btn-danger-custom' : 'btn-success-custom' }}"
                                        style="padding:6px 12px; font-size:12px;"
                                        title="{{ $user->is_active ? 'Deactivate' : 'Activate' }}">
                                    <i class="bi bi-{{ $user->is_active ? 'pause-circle' : 'play-circle' }}"></i>
                                    <span class="d-none d-md-inline">{{ $user->is_active ? 'Deactivate' : 'Activate' }}</span>
                                </button>
                            </form>

                            <form id="del-user-{{ $user->id }}"
                                  action="{{ route('admin.role-users.destroy', $user->id) }}"
                                  method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="button"
                                        class="btn-danger-custom"
                                        style="padding:6px 12px; font-size:12px;"
                                        onclick="confirmDeleteUser({{ $user->id }}, '{{ addslashes($user->name) }}')">
                                    <i class="bi bi-trash"></i>
                                    <span class="d-none d-sm-inline">Delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('searchUsers')?.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.user-row').forEach(row => {
            row.style.display = row.getAttribute('data-search').includes(q) ? '' : 'none';
        });
    });

    function confirmDeleteUser(id, name) {
        Swal.fire({
            title: 'Delete User?',
            text: '"' + name + '" will be permanently removed.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, delete',
        }).then(result => {
            if (result.isConfirmed) document.getElementById('del-user-' + id).submit();
        });
    }

    @if(session('success'))
    Swal.fire({ icon:'success', title:'Done!', text:"{{ session('success') }}", timer:3000, showConfirmButton:false, toast:true, position:'top-end' });
    @endif
    @if(session('error'))
    Swal.fire({ icon:'error', title:'Error', text:"{{ session('error') }}", confirmButtonColor:'#6366f1' });
    @endif
</script>
@endpush
