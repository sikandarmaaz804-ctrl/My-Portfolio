@extends('layouts.admin')

@section('page_title', 'Projects')

@section('content')

<!-- Page Header -->
<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Projects</h1>
        <p>{{ $projects->count() }} {{ Str::plural('project', $projects->count()) }} in your portfolio.</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="btn-primary-custom">
        <i class="bi bi-plus-lg"></i> Add Project
    </a>
</div>

<!-- Projects Table -->
<div class="admin-card">
    <div class="card-head">
        <h5><i class="bi bi-folder2-open me-2"></i>All Projects</h5>
        <div style="position:relative;">
            <i class="bi bi-search" style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:13px;"></i>
            <input type="text" id="searchProjects" class="form-control-custom"
                   placeholder="Search projects..."
                   style="padding-left:32px; padding-top:7px; padding-bottom:7px; font-size:13px; min-width:220px;">
        </div>
    </div>

    <div style="overflow-x:auto;">
        <table class="admin-table" id="projectsTable">
            <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>Preview</th>
                    <th>Title</th>
                    <th class="d-none d-md-table-cell">Client</th>
                    <th class="d-none d-sm-table-cell">Category</th>
                    <th class="d-none d-lg-table-cell">Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $key => $project)
                <tr class="project-row"
                    data-search="{{ strtolower($project->title . ' ' . $project->client_name . ' ' . $project->category) }}">
                    <td>
                        <span style="font-size:12px; color:var(--text-muted); font-weight:600;">{{ $key + 1 }}</span>
                    </td>
                    <td>
                        <img src="{{ asset('uploads/' . $project->image1) }}"
                             alt="{{ $project->title }}"
                             style="width:52px; height:40px; object-fit:cover; border-radius:8px; border:1px solid var(--border);">
                    </td>
                    <td>
                        <span style="font-weight:600; font-size:14px;">{{ $project->title }}</span>
                    </td>
                    <td class="d-none d-md-table-cell">
                        <span style="font-size:13px;">{{ $project->client_name }}</span>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        @php
                            $categoryLabels = [
                                'manipul' => 'Web Development',
                                'creative' => 'UI/UX Design',
                                'brand' => 'Branding'
                            ];
                            $label = $categoryLabels[$project->category] ?? $project->category;
                        @endphp
                        <span class="badge-status read">{{ $label }}</span>
                    </td>
                    <td class="d-none d-lg-table-cell">
                        <span style="font-size:12px; color:var(--text-muted);">
                            {{ $project->created_at->format('M d, Y') }}<br>
                            <small>{{ $project->created_at->format('h:i A') }}</small>
                        </span>
                    </td>
                    <td>
                        <div style="display:flex; gap:6px; flex-wrap:wrap;">
                            <a href="{{ route('admin.projects.edit', $project->id) }}"
                               class="btn-info-custom"
                               style="padding:6px 12px; font-size:12px;">
                                <i class="bi bi-pencil"></i>
                                <span class="d-none d-sm-inline">Edit</span>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project->id) }}"
                                  method="POST" class="delete-form" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger-custom"
                                        style="padding:6px 12px; font-size:12px;">
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
                        <i class="bi bi-folder2-open" style="font-size:48px; opacity:0.2; display:block; margin-bottom:12px;"></i>
                        No projects found.
                        <a href="{{ route('admin.projects.create') }}" style="color:var(--accent); text-decoration:none; font-weight:600;">
                            Add your first project →
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
    document.getElementById('searchProjects').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.project-row').forEach(row => {
            row.style.display = row.getAttribute('data-search').includes(q) ? '' : 'none';
        });
    });

    // Confirm delete
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Delete Project?',
                text: 'This will permanently remove the project and its images.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, delete it',
                cancelButtonText: 'Cancel',
                borderRadius: '16px',
            }).then(result => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

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
