@extends('layouts.admin')

@section('page_title', 'Trash — Messages')

@section('content')

<!-- Page Header -->
<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1><i class="bi bi-trash3 me-2" style="color:#ef4444;"></i>Trash</h1>
        <p style="color:var(--text-muted); font-size:13px;">
            {{ $trashed->count() }} {{ Str::plural('message', $trashed->count()) }} in trash.
            Messages are permanently deleted after <strong>5 days</strong>.
        </p>
    </div>
    <div class="d-flex align-items-center gap-2 flex-wrap">

        {{-- Back to Inbox --}}
        <a href="{{ route('admin.contacts.index') }}"
           style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:8px;
                  background:rgba(99,102,241,0.1); color:var(--accent); font-size:13px; text-decoration:none; font-weight:600;
                  border:1px solid rgba(99,102,241,0.25);">
            <i class="bi bi-inbox"></i> Back to Inbox
        </a>

        {{-- Restore All --}}
        @if($trashed->count() > 0)
        <form method="POST" action="{{ route('admin.contacts.restoreAll') }}" id="restoreAllForm">
            @csrf
            <button type="button" onclick="confirmRestoreAll()"
                style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:8px;
                       background:rgba(34,197,94,0.12); color:#16a34a; font-size:13px; font-weight:600; cursor:pointer;
                       border:1px solid rgba(34,197,94,0.25);">
                <i class="bi bi-arrow-counterclockwise"></i> Restore All
            </button>
        </form>
        @endif
    </div>
</div>

<!-- Flash -->
@if(session('success'))
<div style="background:rgba(34,197,94,0.1); border:1px solid rgba(34,197,94,0.25); border-radius:10px;
            padding:12px 18px; margin-bottom:20px; display:flex; align-items:center; gap:10px; font-size:13px; color:#16a34a;">
    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
</div>
@endif

<!-- Trash Table -->
<div class="admin-card">
    <div class="card-head">
        <h5><i class="bi bi-trash3 me-2"></i>Deleted Messages</h5>
        <span style="font-size:12px; color:var(--text-muted);">
            <i class="bi bi-clock me-1"></i> Items here are auto-deleted after 5 days
        </span>
    </div>

    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>Sender</th>
                    <th>Email</th>
                    <th class="d-none d-md-table-cell">Subject</th>
                    <th class="d-none d-sm-table-cell">Deleted</th>
                    <th class="d-none d-sm-table-cell">Expires in</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trashed as $key => $contact)
                @php
                    $deletedAt  = $contact->deleted_at;
                    $expiresAt  = $deletedAt->copy()->addDays(5);
                    $daysLeft   = max(0, (int) now()->diffInDays($expiresAt, false));
                    $hoursLeft  = max(0, (int) now()->diffInHours($expiresAt, false));
                    $expiresSoon = $daysLeft <= 1;
                @endphp
                <tr style="opacity: {{ $expiresSoon ? '0.75' : '1' }};">
                    <td>
                        <span style="font-size:12px; color:var(--text-muted); font-weight:600;">{{ $key + 1 }}</span>
                    </td>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#9ca3af,#6b7280); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:13px; flex-shrink:0;">
                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                            </div>
                            <span style="font-weight:600; font-size:14px; color:var(--text-muted);">{{ $contact->name }}</span>
                        </div>
                    </td>
                    <td>
                        <span style="color:var(--text-muted); font-size:13px;">{{ $contact->email }}</span>
                    </td>
                    <td class="d-none d-md-table-cell">
                        <span style="font-size:13px; color:var(--text-muted);">{{ $contact->subject }}</span>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <span style="font-size:12px; color:var(--text-muted);">
                            {{ $deletedAt->format('M d, Y') }}<br>
                            <small>{{ $deletedAt->format('h:i A') }}</small>
                        </span>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        @if($expiresSoon)
                            <span style="font-size:12px; color:#ef4444; font-weight:700;">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                {{ $hoursLeft > 0 ? $hoursLeft . 'h left' : 'Expires soon' }}
                            </span>
                        @else
                            <span style="font-size:12px; color:#f59e0b; font-weight:600;">
                                {{ $daysLeft }} {{ Str::plural('day', $daysLeft) }} left
                            </span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex; gap:6px; flex-wrap:wrap;">
                            {{-- Restore --}}
                            <form method="POST" action="{{ route('admin.contacts.restore', $contact->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit"
                                    style="padding:6px 12px; font-size:12px; display:inline-flex; align-items:center; gap:4px;
                                           background:rgba(34,197,94,0.12); color:#16a34a; border:1px solid rgba(34,197,94,0.25);
                                           border-radius:7px; cursor:pointer; font-weight:600;">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                    <span class="d-none d-sm-inline">Restore</span>
                                </button>
                            </form>

                            {{-- Permanently delete --}}
                            <form method="POST" action="{{ route('admin.contacts.forceDelete', $contact->id) }}"
                                  class="force-delete-form" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmForceDelete(this)"
                                    style="padding:6px 12px; font-size:12px; display:inline-flex; align-items:center; gap:4px;
                                           background:rgba(239,68,68,0.12); color:#ef4444; border:1px solid rgba(239,68,68,0.25);
                                           border-radius:7px; cursor:pointer; font-weight:600;">
                                    <i class="bi bi-x-circle"></i>
                                    <span class="d-none d-sm-inline">Delete Forever</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:64px 24px; color:var(--text-muted);">
                        <i class="bi bi-trash3" style="font-size:48px; opacity:0.2; display:block; margin-bottom:12px;"></i>
                        Trash is empty
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
    function confirmRestoreAll() {
        Swal.fire({
            title: 'Restore All Messages?',
            text: 'All trashed messages will be moved back to your inbox.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#16a34a',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, restore all',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('restoreAllForm').submit();
            }
        });
    }

    function confirmForceDelete(btn) {
        Swal.fire({
            title: 'Permanently Delete?',
            text: 'This cannot be undone. The message will be gone forever.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete forever',
        }).then((result) => {
            if (result.isConfirmed) {
                btn.closest('form').submit();
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
