@extends('layouts.admin')

@section('page_title', 'Team Members')

@section('content')

<!-- Page Header -->
<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Team Members</h1>
        <p>{{ $members->count() }} {{ Str::plural('member', $members->count()) }} on your team.</p>
    </div>
    <a href="{{ route('admin.team.create') }}" class="btn-primary-custom">
        <i class="bi bi-person-plus-fill"></i> Add Member
    </a>
</div>

<!-- Table -->
<div class="admin-card">
    <div class="card-head">
        <h5><i class="bi bi-people-fill me-2"></i>All Team Members</h5>
        <div style="position:relative;">
            <i class="bi bi-search" style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:13px;"></i>
            <input type="text" id="searchMembers" class="form-control-custom"
                   placeholder="Search members..."
                   style="padding-left:32px; padding-top:7px; padding-bottom:7px; font-size:13px; min-width:220px;">
        </div>
    </div>

    <div style="overflow-x:auto;">
        <table class="admin-table" id="membersTable">
            <thead>
                <tr>
                    <th style="width:40px;">Order</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th class="d-none d-md-table-cell">Position</th>
                    <th class="d-none d-lg-table-cell">Expertise</th>
                    <th class="d-none d-sm-table-cell">Experience</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                <tr class="member-row"
                    data-search="{{ strtolower($member->name . ' ' . $member->position . ' ' . $member->expertise) }}">
                    <td>
                        <span style="font-size:13px; color:var(--text-muted); font-weight:600;">{{ $member->sort_order }}</span>
                    </td>
                    <td>
                        <img src="{{ asset('uploads/' . $member->photo) }}"
                             alt="{{ $member->name }}"
                             style="width:46px; height:46px; object-fit:cover; border-radius:50%; border:2px solid var(--border);">
                    </td>
                    <td>
                        <span style="font-weight:600; font-size:14px;">{{ $member->name }}</span>
                    </td>
                    <td class="d-none d-md-table-cell">
                        <span style="font-size:13px;">{{ $member->position }}</span>
                    </td>
                    <td class="d-none d-lg-table-cell">
                        <span class="badge-status read">{{ $member->expertise }}</span>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <span style="font-size:13px; font-weight:600; color:var(--accent);">
                            {{ $member->experience_years }}+ yrs
                        </span>
                    </td>
                    <td>
                        <div style="display:flex; gap:6px; flex-wrap:wrap;">
                            <a href="{{ route('admin.team.edit', $member->id) }}"
                               class="btn-info-custom"
                               style="padding:6px 12px; font-size:12px;">
                                <i class="bi bi-pencil"></i>
                                <span class="d-none d-sm-inline">Edit</span>
                            </a>
                            <form id="delete-form-{{ $member->id }}"
                                  action="{{ route('admin.team.destroy', $member->id) }}"
                                  method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        class="btn-danger-custom"
                                        style="padding:6px 12px; font-size:12px;"
                                        onclick="confirmDelete({{ $member->id }}, '{{ addslashes($member->name) }}')">
                                    <i class="bi bi-trash"></i>
                                    <span class="d-none d-sm-inline">Delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:64px 24px; color:var(--text-muted);">
                        <i class="bi bi-people" style="font-size:48px; opacity:0.2; display:block; margin-bottom:12px;"></i>
                        No team members yet.
                        <a href="{{ route('admin.team.create') }}" style="color:var(--accent); text-decoration:none; font-weight:600;">
                            Add your first member →
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Live search
    document.getElementById('searchMembers').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.member-row').forEach(row => {
            row.style.display = row.getAttribute('data-search').includes(q) ? '' : 'none';
        });
    });

    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Remove Team Member?',
            text: '"' + name + '" will be permanently removed.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Yes, remove',
            cancelButtonText: 'Cancel',
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Done!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
    @endif
</script>
@endpush
