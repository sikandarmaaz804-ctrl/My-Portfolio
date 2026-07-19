{{-- ╔══════════════════════════════════════════════════════════════╗
     ║  BLOG POPUP  —  blog-popup.blade.php                        ║
     ║  Loaded via AJAX into modal                                 ║
     ║  Uses Bootstrap 4 + jQuery from footer                      ║
     ╚══════════════════════════════════════════════════════════════╝ --}}

<style>
/* ══ HERO IMAGE ══════════════════════════════════════════════ */
.popup-hero {
    position: relative;
    max-height: 380px;
    overflow: hidden;
    background: #0f172a;
}
.popup-hero img {
    width: 100%;
    max-height: 380px;
    height: auto;
    object-fit: cover;
    display: block;
}
.popup-hero .ph-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(15,23,42,.82) 0%, transparent 55%);
}
.popup-hero .ph-meta {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px 32px 22px;
    color: #fff;
    z-index: 2;
}
.popup-hero .ph-meta h2 {
    font-size: 26px;
    font-weight: 800;
    font-family: 'Heebo', sans-serif;
    line-height: 1.3;
    margin-bottom: 10px;
    color: #fff;
}
.ph-chips {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
}
.ph-chip {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    font-weight: 600;
    color: rgba(255,255,255,.85);
    letter-spacing: .2px;
}
.ph-chip i {
    font-size: 12px;
    color: #88f3ff;
}

/* ══ BODY ════════════════════════════════════════════════════ */
.popup-body {
    padding: 32px 36px 36px;
    background: #fff;
}
.popup-content {
    font-size: 14px;
    line-height: 1.85;
    color: #374151;
    white-space: pre-line;
    background: #f8f9ff;
    border-left: 4px solid #766dff;
    border-radius: 0 12px 12px 0;
    padding: 20px 22px;
    margin-bottom: 32px;
}

/* ══ SHARE ═══════════════════════════════════════════════════ */
.share-bar {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 18px;
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}
.share-bar .share-label {
    font-size: 12px;
    font-weight: 800;
    color: #1e293b;
    letter-spacing: .3px;
}
.share-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 800;
    text-decoration: none;
    transition: all .22s;
    border: none;
    cursor: pointer;
    letter-spacing: .3px;
}
.share-btn:hover {
    transform: translateY(-1px);
    text-decoration: none;
}
.share-btn.tw {
    background: #1da1f2;
    color: #fff;
}
.share-btn.tw:hover { background: #0d8dd8; color: #fff; }
.share-btn.li {
    background: #0a66c2;
    color: #fff;
}
.share-btn.li:hover { background: #084e91; color: #fff; }
.share-btn.cp {
    background: #f1f5f9;
    color: #374151;
    border: 1px solid #e5e7eb;
}
.share-btn.cp:hover { background: #e2e8f0; color: #1e293b; }

/* ══ COMMENTS ════════════════════════════════════════════════ */
.comments-section {
    margin-bottom: 32px;
}
.comments-section h4 {
    font-size: 17px;
    font-weight: 800;
    color: #1e293b;
    font-family: 'Heebo', sans-serif;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.comments-section h4 i {
    color: #766dff;
    font-size: 18px;
}
.comment-count {
    background: linear-gradient(135deg, #766dff, #88f3ff);
    color: #fff;
    font-size: 10px;
    padding: 3px 9px;
    border-radius: 20px;
    font-weight: 800;
    letter-spacing: .3px;
}
.comment {
    display: flex;
    gap: 12px;
    padding: 14px 0;
    border-bottom: 1px solid #f1f5f9;
}
.comment:last-child { border-bottom: none; }
.comment-avatar {
    width: 40px; height: 40px;
    background: linear-gradient(135deg, #766dff, #88f3ff);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-weight: 800; font-size: 15px;
    flex-shrink: 0;
}
.comment-body .c-name {
    font-size: 13px;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 4px;
    font-family: 'Heebo', sans-serif;
}
.comment-body .c-text {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.65;
    margin: 0;
}
.no-comments {
    text-align: center;
    padding: 28px;
    background: #f8faff;
    border-radius: 12px;
    color: #9ca3af;
}
.no-comments i {
    font-size: 32px;
    opacity: .22;
    display: block;
    margin-bottom: 8px;
}

/* ══ COMMENT FORM ════════════════════════════════════════════ */
.comment-form-card {
    background: #f8f9ff;
    border-radius: 14px;
    border: 1px solid #e9edf5;
    padding: 24px;
}
.comment-form-card h4 {
    font-size: 16px;
    font-weight: 800;
    color: #1e293b;
    font-family: 'Heebo', sans-serif;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 7px;
}
.comment-form-card h4 i {
    color: #766dff;
    font-size: 17px;
}
.cf-input {
    width: 100%;
    padding: 11px 15px;
    border: 2px solid #e5e7eb;
    border-radius: 10px;
    font-size: 13px;
    font-family: 'Roboto', sans-serif;
    color: #374151;
    background: #fff;
    outline: none;
    transition: border-color .22s;
    margin-bottom: 11px;
    -webkit-appearance: none;
}
.cf-input:focus {
    border-color: #766dff;
}
textarea.cf-input {
    resize: vertical;
    min-height: 100px;
    line-height: 1.65;
}
.cf-submit {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: linear-gradient(135deg, #766dff, #88f3ff);
    color: #fff;
    border: none;
    padding: 11px 26px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .5px;
    text-transform: uppercase;
    cursor: pointer;
    transition: all .25s;
    font-family: 'Roboto', sans-serif;
}
.cf-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(118,109,255,.4);
}
.cf-submit:disabled {
    opacity: .7;
    cursor: not-allowed;
    transform: none;
}

/* ══ RESPONSIVE ══════════════════════════════════════════════ */
@media (max-width: 767px) {
    .popup-hero { max-height: 280px; }
    .popup-hero img { max-height: 280px; }
    .popup-hero .ph-meta { padding: 16px 20px 18px; }
    .popup-hero .ph-meta h2 { font-size: 20px; }
    .ph-chips { gap: 10px; }
    .ph-chip { font-size: 10px; }
    .popup-body { padding: 24px 20px 28px; }
}
@media (max-width: 575px) {
    .popup-hero { max-height: 240px; }
    .popup-hero img { max-height: 240px; }
    .popup-hero .ph-meta h2 { font-size: 17px; line-height: 1.35; }
    .ph-chips { gap: 8px; }
    .ph-chip { font-size: 9px; }
    .popup-body { padding: 20px 16px 24px; }
    .popup-content { padding: 16px 18px; font-size: 13px; }
    .share-bar { flex-direction: column; align-items: stretch; padding: 12px 14px; }
    .share-bar .share-label { margin-bottom: 4px; }
    .share-btn { justify-content: center; width: 100%; }
    .comment-form-card { padding: 18px; }
    .comment-avatar { width: 36px; height: 36px; font-size: 14px; }
}
@media (max-width: 400px) {
    .popup-hero .ph-meta h2 { font-size: 15px; }
}
</style>


{{-- HERO IMAGE --}}
@if($blog->image)
<div class="popup-hero">
    <img src="{{ $blog->image_url }}"
         alt="{{ $blog->title }}"
         onerror="this.onerror=null;this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'900\' height=\'380\'%3E%3Crect width=\'900\' height=\'380\' fill=\'%23e2e8f0\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' dominant-baseline=\'middle\' text-anchor=\'middle\' font-size=\'48\' fill=\'%2394a3b8\'%3E✦%3C/text%3E%3C/svg%3E'">
    <div class="ph-overlay"></div>
    <div class="ph-meta">
        <h2>{{ $blog->title }}</h2>
        <div class="ph-chips">
            <span class="ph-chip"><i class="fa fa-calendar"></i> {{ $blog->created_at->format('F d, Y') }}</span>
            <span class="ph-chip"><i class="fa fa-user"></i> Admin</span>
            <span class="ph-chip"><i class="fa fa-comments"></i> {{ $blog->comments->count() }} Comments</span>
            <span class="ph-chip"><i class="fa fa-tag"></i> {{ $blog->category ?? 'General' }}</span>
        </div>
    </div>
</div>
@endif

{{-- BODY --}}
<div class="popup-body">

    {{-- Title (only when no image) --}}
    @if(!$blog->image)
    <h2 style="font-size:24px; font-weight:800; color:#1e293b; font-family:'Heebo',sans-serif; line-height:1.35; margin-bottom:6px;">{{ $blog->title }}</h2>
    <div class="ph-chips" style="margin-bottom:20px;">
        <span class="ph-chip" style="color:#6b7280;"><i class="fa fa-calendar"></i> {{ $blog->created_at->format('F d, Y') }}</span>
        <span class="ph-chip" style="color:#6b7280;"><i class="fa fa-comments"></i> {{ $blog->comments->count() }} Comments</span>
        <span class="ph-chip" style="color:#6b7280;"><i class="fa fa-tag"></i> {{ $blog->category ?? 'General' }}</span>
    </div>
    @endif

    {{-- Content --}}
    <div class="popup-content">{{ $blog->description }}</div>

    {{-- Share Bar --}}
    <div class="share-bar">
        <span class="share-label">Share this article:</span>
        <a href="https://twitter.com/intent/tweet?text={{ urlencode($blog->title) }}" target="_blank" rel="noopener" class="share-btn tw">
            <i class="fa-brands fa-twitter"></i> Twitter
        </a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&title={{ urlencode($blog->title) }}" target="_blank" rel="noopener" class="share-btn li">
            <i class="fa-brands fa-linkedin-in"></i> LinkedIn
        </a>
        <button type="button" class="share-btn cp" id="copyLinkBtn" onclick="copyPostLink()">
            <i class="fa fa-link"></i> Copy Link
        </button>
    </div>

    {{-- Comments --}}
    <div class="comments-section">
        <h4>
            <i class="fa fa-comments"></i>
            Comments
            <span class="comment-count" id="commentCounter">{{ $blog->comments->count() }}</span>
        </h4>

        <div id="commentsBox">
            @forelse($blog->comments as $c)
            <div class="comment">
                <div class="comment-avatar">{{ strtoupper(substr($c->name, 0, 1)) }}</div>
                <div class="comment-body">
                    <div class="c-name">{{ $c->name }}</div>
                    <p class="c-text">{{ $c->comment }}</p>
                </div>
            </div>
            @empty
            <div class="no-comments" id="emptyMsg">
                <i class="fa fa-comment-slash"></i>
                <p style="font-size:13px; margin:0;">No comments yet — be the first!</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Comment Form --}}
    <div class="comment-form-card">
        <h4><i class="fa fa-pen-to-square"></i> Leave a Comment</h4>

        <form id="popupCommentForm">
            @csrf
            <input type="text" name="name" class="cf-input" placeholder="Your name *" required>
            <textarea name="comment" class="cf-input" placeholder="Share your thoughts..." required></textarea>
            <button type="submit" class="cf-submit" id="popupSubmitBtn">
                <i class="fa fa-paper-plane"></i> Post Comment
            </button>
        </form>

    </div>

</div>

<script>
/* ── Post Comment ──────────────────────────────────────────── */
(function() {
    var form = document.getElementById('popupCommentForm');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        var btn     = document.getElementById('popupSubmitBtn');
        var name    = this.elements.name.value.trim();
        var comment = this.elements.comment.value.trim();

        if (!name || !comment) return;

        btn.innerHTML = '<span style="display:inline-block;width:12px;height:12px;border:2px solid rgba(255,255,255,.4);border-top-color:#fff;border-radius:50%;animation:spin .6s linear infinite;margin-right:6px;vertical-align:middle;"></span>Posting...';
        btn.disabled = true;

        fetch("{{ route('blog.comment', $blog->id) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept':       'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ name: name, comment: comment })
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {

                /* Remove empty state */
                var empty = document.getElementById('emptyMsg');
                if (empty) empty.remove();

                /* Inject new comment */
                var box  = document.getElementById('commentsBox');
                var div  = document.createElement('div');
                div.className = 'comment';
                div.style.animation = 'popIn .35s ease';
                div.innerHTML =
                    '<div class="comment-avatar">' + name.charAt(0).toUpperCase() + '</div>' +
                    '<div class="comment-body">' +
                        '<div class="c-name">' + name + '</div>' +
                        '<p class="c-text">' + comment + '</p>' +
                    '</div>';
                box.appendChild(div);

                /* Update counter */
                var counter = document.getElementById('commentCounter');
                if (counter) counter.textContent = parseInt(counter.textContent || 0) + 1;

                /* Reset */
                form.reset();
                btn.innerHTML = '<i class="fa fa-check"></i> Posted!';
                btn.style.background = 'linear-gradient(135deg, #10b981, #059669)';

                setTimeout(function() {
                    btn.innerHTML = '<i class="fa fa-paper-plane"></i> Post Comment';
                    btn.style.background = '';
                    btn.disabled = false;
                }, 2800);
            }
        })
        .catch(function() {
            btn.innerHTML = '<i class="fa fa-paper-plane"></i> Post Comment';
            btn.disabled = false;
        });
    });
})();

/* ── Copy Link ─────────────────────────────────────────────── */
function copyPostLink() {
    var url = window.location.href;
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(function() {
            flashCopyBtn();
        });
    } else {
        /* Fallback */
        var ta = document.createElement('textarea');
        ta.value = url;
        document.body.appendChild(ta);
        ta.select();
        document.execCommand('copy');
        document.body.removeChild(ta);
        flashCopyBtn();
    }
}
function flashCopyBtn() {
    var btn = document.getElementById('copyLinkBtn');
    if (!btn) return;
    btn.innerHTML = '<i class="fa fa-check"></i> Copied!';
    btn.style.background = '#dcfce7';
    btn.style.color = '#16a34a';
    setTimeout(function() {
        btn.innerHTML = '<i class="fa fa-link"></i> Copy Link';
        btn.style.background = '';
        btn.style.color = '';
    }, 2000);
}

/* ── keyframe for new comment ──────────────────────────────── */
var styleEl = document.createElement('style');
styleEl.textContent =
    '@keyframes popIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }' +
    '@keyframes spin  { to { transform:rotate(360deg); } }';
document.head.appendChild(styleEl);
</script>
