@extends('layouts.admin')

@section('page_title', 'Roles & Permissions')

@section('content')

@php
    use App\Helpers\PermissionHelper;
@endphp

<!-- Page Header -->
<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Roles & Permissions</h1>
        <p>{{ $roles->count() }} {{ Str::plural('role', $roles->count()) }} defined. Each role controls what a sub-admin can do.</p>
    </div>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        @if(PermissionHelper::can('roles.create'))
        <form action="{{ route('admin.roles.seed') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-ghost">
                <i class="bi bi-arrow-repeat"></i> Sync Permissions
            </button>
        </form>
        @endif
        @if(PermissionHelper::can('roles.users'))
        <a href="{{ route('admin.role-users.index') }}" class="btn-ghost">
            <i class="bi bi-people-fill"></i> Manage Users
        </a>
        @endif
        @if(PermissionHelper::can('roles.create'))
        <a href="{{ route('admin.roles.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-lg"></i> New Role
        </a>
        @endif
    </div>
</div>

@if($roles->isEmpty())
<!-- Empty State -->
<div class="admin-card">
    <div style="text-align:center; padding:64px 24px; color:var(--text-muted);">
        <i class="bi bi-shield-lock" style="font-size:56px; opacity:0.2; display:block; margin-bottom:16px;"></i>
        <h5 style="font-weight:700; margin-bottom:8px;">No roles yet</h5>
        <p style="margin-bottom:20px;">Create your first role and assign permissions to it.</p>
        @if(PermissionHelper::can('roles.create'))
        <a href="{{ route('admin.roles.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-lg"></i> Create First Role
        </a>
        @endif
    </div>
</div>
@else

<!-- Roles Grid -->
<div class="row g-3 mb-4">
    @foreach($roles as $role)
    <div class="col-md-6 col-xl-4">
        <div class="admin-card" style="height:100%;">
            <!-- Role Header -->
            <div style="padding:20px 22px; border-bottom:1px solid var(--border); display:flex; align-items:flex-start; gap:14px;">
                <div style="
                    width:44px; height:44px;
                    background: {{ $role->color }}22;
                    border-radius:12px;
                    display:flex; align-items:center; justify-content:center;
                    flex-shrink:0;
                ">
                    <i class="bi bi-shield-fill" style="font-size:20px; color:{{ $role->color }};"></i>
                </div>
                <div style="flex:1; min-width:0;">
                    <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                        <h5 style="margin:0; font-size:15px; font-weight:700;">{{ $role->name }}</h5>
                        <span style="
                            font-size:11px; font-weight:700; padding:2px 10px;
                            border-radius:20px;
                            background: {{ $role->color }}22;
                            color: {{ $role->color }};
                        ">{{ $role->slug }}</span>
                    </div>
                    @if($role->description)
                    <p style="margin:4px 0 0; font-size:13px; color:var(--text-muted);">{{ $role->description }}</p>
                    @endif
                </div>
            </div>

            <!-- Stats -->
            <div style="padding:14px 22px; display:flex; gap:20px; border-bottom:1px solid var(--border);">
                <div>
                    <div style="font-size:11px; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Permissions</div>
                    <div style="font-size:20px; font-weight:700; color:{{ $role->color }};">{{ $role->permissions->count() }}</div>
                </div>
                <div>
                    <div style="font-size:11px; color:var(--text-muted); font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Users</div>
                    <div style="font-size:20px; font-weight:700;">{{ $role->users_count }}</div>
                </div>
            </div>

            <!-- Permission Tags -->
            @if($role->permissions->count() > 0)
            <div style="padding:14px 22px; border-bottom:1px solid var(--border);">
                <div style="display:flex; flex-wrap:wrap; gap:6px;">
                    @foreach($role->permissions->take(8) as $perm)
                    <span style="
                        font-size:11px; font-weight:600; padding:3px 9px;
                        border-radius:6px;
                        background: rgba(99,102,241,0.08);
                        color: var(--accent);
                    ">{{ $perm->name }}</span>
                    @endforeach
                    @if($role->permissions->count() > 8)
                    <span style="font-size:11px; color:var(--text-muted); padding:3px 4px;">
                        +{{ $role->permissions->count() - 8 }} more
                    </span>
                    @endif
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div style="padding:14px 22px; display:flex; gap:8px; flex-wrap:wrap;">
                @if(PermissionHelper::can('roles.edit'))
                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn-info-custom" style="font-size:12px; padding:6px 14px;">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                @endif
                @if(PermissionHelper::can('roles.users'))
                <a href="{{ route('admin.role-users.index') }}?role={{ $role->id }}" class="btn-success-custom" style="font-size:12px; padding:6px 14px;">
                    <i class="bi bi-people"></i> Users
                </a>
                @endif
                @if(PermissionHelper::can('roles.delete'))
                <form id="del-role-{{ $role->id }}" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="button"
                            class="btn-danger-custom"
                            style="font-size:12px; padding:6px 14px;"
                            onclick="confirmDeleteRole({{ $role->id }}, '{{ addslashes($role->name) }}', {{ $role->users_count }})">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

@endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDeleteRole(id, name, userCount) {
        if (userCount > 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Cannot Delete',
                text: '"' + name + '" has ' + userCount + ' user(s) assigned. Remove or reassign them first.',
                confirmButtonColor: '#6366f1',
            });
            return;
        }
        Swal.fire({
            title: 'Delete Role?',
            text: '"' + name + '" will be permanently deleted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, delete',
        }).then(result => {
            if (result.isConfirmed) document.getElementById('del-role-' + id).submit();
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
