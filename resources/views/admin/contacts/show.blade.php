@extends('layouts.admin')

@section('page_title', 'Message Detail')

@section('content')

<!-- Breadcrumb / Back -->
<div style="margin-bottom:20px;">
    <a href="{{ route('admin.contacts.index') }}" class="btn-ghost" style="padding:8px 14px; font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back to Inbox
    </a>
</div>

<div class="row g-3">

    <!-- Sender Info -->
    <div class="col-lg-4 col-xl-3">
        <div class="admin-card mb-3">
            <div class="card-head">
                <h5><i class="bi bi-person me-2"></i>Sender</h5>
            </div>
            <div class="card-body-p" style="text-align:center;">

                <!-- Avatar -->
                <div style="width:72px; height:72px; background:linear-gradient(135deg, var(--accent), #818cf8); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:28px; margin:0 auto 16px;">
                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                </div>

                <h5 style="margin:0 0 4px; font-weight:700;">{{ $contact->name }}</h5>
                <a href="mailto:{{ $contact->email }}" style="font-size:13px; color:var(--accent); word-break:break-all;">
                    {{ $contact->email }}
                </a>

                @if($contact->phone)
                <a href="tel:{{ $contact->phone }}" style="font-size:13px; color:var(--accent); display:block; word-break:break-all; margin-top:4px;">
                    📞 {{ $contact->phone }}
                </a>
                @endif

                <hr style="border-color:var(--border); margin:16px 0;">

                <div style="text-align:left;">
                    <div style="font-size:12px; color:var(--text-muted); margin-bottom:6px;">Subject</div>
                    <div style="font-size:13px; font-weight:600; margin-bottom:14px;">{{ $contact->subject }}</div>

                    <div style="font-size:12px; color:var(--text-muted); margin-bottom:6px;">Received</div>
                    <div style="font-size:13px; font-weight:600;">
                        {{ $contact->created_at->format('M d, Y') }}<br>
                        <span style="font-weight:400; color:var(--text-muted);">{{ $contact->created_at->format('h:i A') }}</span>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="mailto:{{ $contact->email }}" class="btn-ghost w-100 justify-content-center mb-2">
                        <i class="bi bi-envelope"></i> Send Email
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Conversation + Reply -->
    <div class="col-lg-8 col-xl-9">

        <!-- Thread -->
        <div class="admin-card mb-3">
            <div class="card-head">
                <h5><i class="bi bi-chat-text me-2"></i>Conversation</h5>
                <span class="badge-status unread">{{ $contact->subject }}</span>
            </div>
            <div class="card-body-p">

                <!-- User message -->
                <div style="display:flex; gap:12px; margin-bottom:20px;">
                    <div style="width:40px; height:40px; background:linear-gradient(135deg, #cbd5e1, #94a3b8); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:15px; flex-shrink:0;">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>
                    <div style="flex:1;">
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px; flex-wrap:wrap;">
                            <span style="font-weight:700; font-size:14px;">{{ $contact->name }}</span>
                            <span style="font-size:11px; color:var(--text-muted);">{{ $contact->created_at->format('M d, Y h:i A') }}</span>
                        </div>
                        <div style="background:var(--body-bg); border:1px solid var(--border); border-radius:12px 12px 12px 4px; padding:16px 18px; font-size:14px; line-height:1.7; color:var(--text-main);">
                            {{ $contact->message }}
                        </div>
                    </div>
                </div>

                @if($contact->reply_message)
                <!-- Admin reply -->
                <div style="display:flex; gap:12px; flex-direction:row-reverse;">
                    <div style="width:40px; height:40px; background:linear-gradient(135deg, var(--accent), #818cf8); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:15px; flex-shrink:0;">
                        A
                    </div>
                    <div style="flex:1;">
                        <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px; flex-direction:row-reverse; flex-wrap:wrap;">
                            <span style="font-weight:700; font-size:14px;">You (Admin)</span>
                            <span style="font-size:11px; color:var(--text-muted);">{{ $contact->updated_at->format('M d, Y h:i A') }}</span>
                        </div>
                        <div style="background:linear-gradient(135deg, var(--accent), #818cf8); border-radius:12px 12px 4px 12px; padding:16px 18px; font-size:14px; line-height:1.7; color:#fff; text-align:right;">
                            {{ $contact->reply_message }}
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>

        <!-- Reply Form -->
        <div class="admin-card">
            <div class="card-head">
                <h5><i class="bi bi-reply-fill me-2" style="color:var(--accent);"></i>Send Reply</h5>
            </div>
            <div class="card-body-p">

                @if(session('success'))
                    <div class="alert-custom alert-success mb-3">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert-custom alert-danger mb-3">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.contacts.reply', $contact->id) }}" method="POST" id="replyForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label-custom">To</label>
                        <input type="text" class="form-control-custom" value="{{ $contact->email }}" disabled
                               style="background:#f8fafc; color:var(--text-muted);">
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Subject <span style="color:var(--danger);">*</span></label>
                        <input type="text" name="subject" class="form-control-custom"
                               value="Re: {{ $contact->subject }}" required>
                        @error('subject')
                            <div style="font-size:12px; color:var(--danger); margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Message <span style="color:var(--danger);">*</span></label>
                        <textarea name="message" class="form-control-custom" rows="6"
                                  placeholder="Type your reply..." required id="replyMsg">{{ old('message') }}</textarea>
                        <div style="font-size:12px; color:var(--text-muted); text-align:right; margin-top:4px;">
                            <span id="msgCount">0</span> characters
                        </div>
                        @error('message')
                            <div style="font-size:12px; color:var(--danger); margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="display:flex; gap:10px; flex-wrap:wrap;">
                        <button type="submit" class="btn-primary-custom" id="sendBtn">
                            <i class="bi bi-send"></i> Send Reply
                        </button>
                        <a href="{{ route('admin.contacts.index') }}" class="btn-ghost">
                            <i class="bi bi-x-lg"></i> Cancel
                        </a>
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
    // Char counter
    const replyMsg = document.getElementById('replyMsg');
    const msgCount = document.getElementById('msgCount');
    if (replyMsg) {
        replyMsg.addEventListener('input', () => {
            msgCount.textContent = replyMsg.value.length;
        });
        msgCount.textContent = replyMsg.value.length;
    }

    // Loading state on submit
    const replyForm = document.getElementById('replyForm');
    const sendBtn   = document.getElementById('sendBtn');
    if (replyForm) {
        replyForm.addEventListener('submit', () => {
            sendBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';
            sendBtn.disabled = true;
        });
    }

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Reply Sent!',
        text: "{{ session('success') }}",
        timer: 2500,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
    @endif
</script>
@endpush
