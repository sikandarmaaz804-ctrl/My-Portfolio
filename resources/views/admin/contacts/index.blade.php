@extends('layouts.admin')

@section('page_title', 'Messages')

@section('content')

<!-- Page Header -->
<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
    <div>
        <h1>Messages</h1>
        <p>{{ $contacts->count() }} {{ Str::plural('message', $contacts->count()) }} in your inbox.</p>
    </div>
    <div class="d-flex align-items-center gap-2 flex-wrap">

        {{-- Trash link with badge --}}
        @if($trashedCount > 0)
        <a href="{{ route('admin.contacts.trash') }}"
           style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:8px;
                  background:rgba(239,68,68,0.1); color:#ef4444; font-size:13px; text-decoration:none; font-weight:600;
                  border:1px solid rgba(239,68,68,0.25);">
            <i class="bi bi-trash3"></i> Trash
            <span style="background:#ef4444; color:#fff; border-radius:20px; padding:1px 8px; font-size:11px;">
                {{ $trashedCount }}
            </span>
        </a>
        @endif

        {{-- Delete All button --}}
        @if($contacts->count() > 0)
        <form method="POST" action="{{ route('admin.contacts.deleteAll') }}" id="deleteAllForm">
            @csrf @method('DELETE')
            <button type="button" onclick="confirmDeleteAll()"
                style="display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:8px;
                       background:rgba(239,68,68,0.15); color:#ef4444; font-size:13px; font-weight:600; cursor:pointer;
                       border:1px solid rgba(239,68,68,0.3);">
                <i class="bi bi-trash3-fill"></i> Delete All
            </button>
        </form>
        @endif

        <div style="font-size:13px; color:var(--text-muted);">
            <i class="bi bi-info-circle me-1"></i> Click a row to view details
        </div>
    </div>
</div>

<!-- Flash: deleted notice -->
@if(session('deleted'))
<div style="background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.25); border-radius:10px;
            padding:12px 18px; margin-bottom:20px; display:flex; align-items:center; gap:10px; font-size:13px; color:#ef4444;">
    <i class="bi bi-trash3-fill"></i>
    {{ session('deleted') }}
    &nbsp;—&nbsp;
    <a href="{{ route('admin.contacts.trash') }}" style="color:#ef4444; font-weight:700; text-decoration:underline;">View Trash</a>
</div>
@endif

<!-- Contacts Table Card -->
<div class="admin-card">
    <div class="card-head">
        <h5><i class="bi bi-envelope me-2"></i>Inbox</h5>
        <div style="position:relative;">
            <i class="bi bi-search" style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--text-muted); font-size:13px;"></i>
            <input type="text" id="searchInbox" class="form-control-custom" placeholder="Search messages..."
                   style="padding-left:32px; padding-top:7px; padding-bottom:7px; font-size:13px; min-width:220px;">
        </div>
    </div>

    <div style="overflow-x:auto;">
        <table class="admin-table" id="messagesTable">
            <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>Sender</th>
                    <th>Email</th>
                    <th class="d-none d-md-table-cell">Phone</th>
                    <th class="d-none d-md-table-cell">Subject</th>
                    <th class="d-none d-lg-table-cell">Preview</th>
                    <th class="d-none d-sm-table-cell">Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $key => $contact)
                <tr class="message-row" data-search="{{ strtolower($contact->name . ' ' . $contact->email . ' ' . $contact->phone . ' ' . $contact->subject) }}">
                    <td>
                        <span style="font-size:12px; color:var(--text-muted); font-weight:600;">{{ $key + 1 }}</span>
                    </td>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div style="width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg, var(--accent), #818cf8); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:13px; flex-shrink:0;">
                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                            </div>
                            <span style="font-weight:600; font-size:14px;">{{ $contact->name }}</span>
                        </div>
                    </td>
                    <td>
                        <a href="mailto:{{ $contact->email }}"
                           style="color:var(--accent); text-decoration:none; font-size:13px;">
                            {{ $contact->email }}
                        </a>
                    </td>
                    <td class="d-none d-md-table-cell">
                        @if($contact->phone)
                        <a href="tel:{{ $contact->phone }}"
                           style="color:var(--accent); text-decoration:none; font-size:13px;">
                            📞 {{ $contact->phone }}
                        </a>
                        @else
                        <span style="color:var(--text-muted); font-size:13px;">—</span>
                        @endif
                    </td>
                    <td class="d-none d-md-table-cell">
                        <span style="font-size:13px;">{{ $contact->subject }}</span>
                    </td>
                    <td class="d-none d-lg-table-cell">
                        <span style="font-size:13px; color:var(--text-muted);">
                            {{ \Illuminate\Support\Str::limit($contact->message, 55) }}
                        </span>
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <span style="font-size:12px; color:var(--text-muted);">
                            {{ $contact->created_at->format('M d, Y') }}<br>
                            <small>{{ $contact->created_at->format('h:i A') }}</small>
                        </span>
                    </td>
                    <td>
                        <div style="display:flex; gap:6px; flex-wrap:wrap;">
                            <a href="{{ route('admin.contacts.show', $contact->id) }}"
                               class="btn-info-custom"
                               style="padding:6px 12px; font-size:12px;">
                                <i class="bi bi-eye"></i>
                                <span class="d-none d-sm-inline">View</span>
                            </a>
                            <button type="button"
                                    class="btn-success-custom"
                                    style="padding:6px 12px; font-size:12px;"
                                    onclick="openReplyModal(
                                        '{{ $contact->id }}',
                                        '{{ addslashes($contact->name) }}',
                                        '{{ addslashes($contact->subject) }}',
                                        '{{ route('admin.contacts.reply', $contact->id) }}'
                                    )">
                                <i class="bi bi-reply-fill"></i>
                                <span class="d-none d-sm-inline">Reply</span>
                            </button>

                            {{-- Per-row Delete --}}
                            <form method="POST" action="{{ route('admin.contacts.destroy', $contact->id) }}"
                                  class="delete-single-form" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="button"
                                        onclick="confirmDeleteSingle(this)"
                                        style="padding:6px 12px; font-size:12px; display:inline-flex; align-items:center; gap:4px;
                                               background:rgba(239,68,68,0.12); color:#ef4444; border:1px solid rgba(239,68,68,0.25);
                                               border-radius:7px; cursor:pointer; font-weight:600;">
                                    <i class="bi bi-trash3"></i>
                                    <span class="d-none d-sm-inline">Delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:64px 24px; color:var(--text-muted);">
                        <i class="bi bi-inbox" style="font-size:48px; opacity:0.2; display:block; margin-bottom:12px;"></i>
                        No messages found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ═══ REPLY MODAL ═══════════════════════════════════════════ -->
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" id="replyForm" onsubmit="handleReplySubmit(event)">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">
                        <i class="bi bi-reply-fill me-2" style="color:var(--accent);"></i>
                        Reply to <span id="replyRecipient" style="color:var(--accent);"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label-custom">Subject</label>
                        <input type="text" name="subject" id="replySubject" class="form-control-custom" required>
                    </div>
                    <div class="mb-1">
                        <label class="form-label-custom">Message <span style="color:var(--danger);">*</span></label>
                        <textarea name="message" id="replyMessage" class="form-control-custom" rows="6"
                                  placeholder="Type your reply here..." required></textarea>
                        <div style="font-size:12px; color:var(--text-muted); text-align:right; margin-top:4px;">
                            <span id="replyCharCount">0</span> characters
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-ghost" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-primary-custom" id="replySubmitBtn">
                        <i class="bi bi-send"></i> Send Reply
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // ── Reply modal ────────────────────────────────────────────────────────────
    function openReplyModal(id, name, subject, url) {
        document.getElementById('replyRecipient').textContent = name;
        document.getElementById('replySubject').value = 'Re: ' + subject;
        document.getElementById('replyMessage').value = '';
        document.getElementById('replyCharCount').textContent = '0';
        document.getElementById('replyForm').action = url;
        new bootstrap.Modal(document.getElementById('replyModal')).show();
    }

    document.getElementById('replyMessage').addEventListener('input', function () {
        document.getElementById('replyCharCount').textContent = this.value.length;
    });

    function handleReplySubmit(e) {
        const btn = document.getElementById('replySubmitBtn');
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';
        btn.disabled = true;
    }

    // ── Delete single ──────────────────────────────────────────────────────────
    function confirmDeleteSingle(btn) {
        Swal.fire({
            title: 'Move to Trash?',
            text: 'This message will be moved to trash and permanently deleted after 5 days.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                btn.closest('form').submit();
            }
        });
    }

    // ── Delete all ─────────────────────────────────────────────────────────────
    function confirmDeleteAll() {
        Swal.fire({
            title: 'Delete All Messages?',
            text: 'All messages will be moved to trash. You can restore them within 5 days.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete all',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteAllForm').submit();
            }
        });
    }

    // ── Search ─────────────────────────────────────────────────────────────────
    const searchInbox = document.getElementById('searchInbox');
    if (searchInbox) {
        searchInbox.addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.message-row').forEach(row => {
                row.style.display = row.getAttribute('data-search').includes(q) ? '' : 'none';
            });
        });
    }

    // ── Flash messages ─────────────────────────────────────────────────────────
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
