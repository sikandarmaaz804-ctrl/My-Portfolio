@extends('main')

@section('main-container')

{{-- ╔══════════════════════════════════════════════════════════════╗
     ║  BLOG PAGE  —  blog.blade.php                               ║
     ║  Bootstrap 4 + local jQuery (loaded by footer.blade.php)    ║
     ║  NO extra jQuery / Bootstrap CDN here — that breaks navbar  ║
     ╚══════════════════════════════════════════════════════════════╝ --}}

<style>
/* ══ RESET / BASE ═════════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; }

/* ══ HERO BANNER ══════════════════════════════════════════════ */
.blog_banner {
    min-height: 580px;
    position: relative;
    z-index: 1;
    overflow: hidden;
    margin-bottom: 0;
}
.blog_banner .banner_inner {
    background: linear-gradient(135deg, #0f172a 0%, #1a1f3c 100%);
    position: relative;
    overflow: hidden;
    width: 100%;
    min-height: 580px;
    z-index: 1;
    display: flex;
    align-items: center;
}
.blog_banner .banner_inner .overlay {
    background: url('../img/banner/IMG_7467.jpg') no-repeat center center;
    background-size: cover;
    opacity: .15;
    position: absolute;
    left: 0; top: 0;
    width: 100%; height: 100%;
    z-index: 0;
}
/* decorative orbs */
.blog_banner .orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(70px);
    pointer-events: none;
    z-index: 0;
}
.blog_banner .orb-1 {
    width: 420px; height: 420px;
    background: rgba(118,109,255,.18);
    top: -120px; left: -100px;
}
.blog_banner .orb-2 {
    width: 320px; height: 320px;
    background: rgba(136,243,255,.12);
    bottom: -80px; right: -60px;
}
.blog_banner .blog_b_text {
    max-width: 820px;
    margin: 0 auto;
    color: #fff;
    text-align: center;
    position: relative;
    z-index: 2;
    padding: 0 20px;
}
.blog_banner .blog_b_text .eyebrow {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(136,243,255,.9);
    margin-bottom: 18px;
    display: block;
}
.blog_banner .blog_b_text h2 {
    font-size: 52px;
    font-weight: 800;
    font-family: 'Heebo', sans-serif;
    line-height: 1.15;
    margin-bottom: 18px;
    text-transform: none;
    color: #fff;
}
.blog_banner .blog_b_text h2 span {
    background: linear-gradient(135deg, #a78bfa, #88f3ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.blog_banner .blog_b_text p {
    font-size: 16px;
    line-height: 1.8;
    color: rgba(255,255,255,.72);
    margin-bottom: 36px;
    max-width: 620px;
    margin-left: auto;
    margin-right: auto;
}
.blog_banner .blog_b_text .btn-hero {
    display: inline-block;
    padding: 14px 38px;
    border-radius: 50px;
    background: linear-gradient(135deg, #766dff, #88f3ff);
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: .5px;
    text-transform: uppercase;
    text-decoration: none;
    transition: all .3s;
    box-shadow: 0 8px 24px rgba(118,109,255,.35);
}
.blog_banner .blog_b_text .btn-hero:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 32px rgba(118,109,255,.5);
    color: #fff;
    text-decoration: none;
}
.hero-stats {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
    margin-top: 48px;
    padding-top: 40px;
    border-top: 1px solid rgba(255,255,255,.1);
    flex-wrap: wrap;
}
.hero-stat {
    text-align: center;
    padding: 0 36px;
}
.hero-stat + .hero-stat {
    border-left: 1px solid rgba(255,255,255,.1);
}
.hero-stat .num {
    font-size: 30px;
    font-weight: 800;
    color: #fff;
    font-family: 'Heebo', sans-serif;
    line-height: 1;
    margin-bottom: 4px;
}
.hero-stat .lbl {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: rgba(255,255,255,.45);
}

/* ══ BLOG SECTION ════════════════════════════════════════════ */
.blog_area {
    background: #f4f7fc;
    padding-top: 64px;
    padding-bottom: 80px;
}

/* ══ FILTER BAR ══════════════════════════════════════════════ */
.blog-filter-bar {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 16px rgba(0,0,0,.06);
    padding: 16px 20px;
    margin-bottom: 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
}
.blog-filter-tabs {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    flex: 1;
}
.filter-btn {
    padding: 8px 18px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .3px;
    border: 2px solid #e5e7eb;
    background: #fff;
    color: #6b7280;
    cursor: pointer;
    transition: all .22s;
    white-space: nowrap;
}
.filter-btn:hover,
.filter-btn.active {
    background: linear-gradient(135deg, #766dff, #88f3ff);
    color: #fff;
    border-color: #766dff;
}
.blog-search-wrap {
    position: relative;
    min-width: 220px;
    flex-shrink: 0;
}
.blog-search-wrap input {
    width: 100%;
    padding: 9px 38px 9px 16px;
    border-radius: 50px;
    border: 2px solid #e5e7eb;
    font-size: 13px;
    color: #374151;
    background: #f9fafb;
    outline: none;
    transition: border-color .22s, background .22s;
}
.blog-search-wrap input:focus {
    border-color: #766dff;
    background: #fff;
}
.blog-search-wrap .search-icon {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 14px;
    pointer-events: none;
}

/* ══ BLOG CARD ════════════════════════════════════════════════ */
.blog-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e9edf5;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: transform .28s, box-shadow .28s, border-color .28s;
}
.blog-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(118,109,255,.14);
    border-color: #c4b9ff;
}
.blog-card .img-wrap {
    position: relative;
    overflow: hidden;
    height: 210px;
    flex-shrink: 0;
}
.blog-card .img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .45s cubic-bezier(.4,0,.2,1);
}
.blog-card:hover .img-wrap img {
    transform: scale(1.07);
}
.blog-card .cat-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(135deg, #766dff, #88f3ff);
    color: #fff;
    padding: 4px 14px;
    border-radius: 50px;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .6px;
    text-transform: uppercase;
    z-index: 2;
    box-shadow: 0 4px 12px rgba(118,109,255,.35);
}
.blog-card .img-overlay {
    position: absolute;
    inset: 0;
    background: rgba(118,109,255,.72);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity .28s;
    z-index: 3;
    cursor: pointer;
}
.blog-card:hover .img-overlay {
    opacity: 1;
}
.img-overlay .play-icon {
    width: 56px;
    height: 56px;
    background: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #766dff;
    font-size: 20px;
    transform: scale(.7);
    transition: transform .28s;
    box-shadow: 0 6px 20px rgba(0,0,0,.2);
}
.blog-card:hover .play-icon {
    transform: scale(1);
}
.blog-card .card-body-inner {
    padding: 22px 22px 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.blog-card .meta-row {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 12px;
    flex-wrap: wrap;
}
.blog-card .meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    color: #9ca3af;
    font-weight: 600;
    letter-spacing: .2px;
}
.blog-card .meta-item i {
    color: #766dff;
    font-size: 12px;
}
.blog-card h3 {
    font-size: 17px;
    font-weight: 800;
    line-height: 1.45;
    color: #1e293b;
    margin-bottom: 10px;
    font-family: 'Heebo', sans-serif;
    cursor: pointer;
    transition: color .22s;
}
.blog-card h3:hover {
    color: #766dff;
}
.blog-card .excerpt {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.75;
    margin-bottom: 18px;
    flex: 1;
}
.blog-card .read-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: #766dff;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .5px;
    text-transform: uppercase;
    cursor: pointer;
    border: none;
    background: none;
    padding: 0;
    transition: gap .22s, color .22s;
    align-self: flex-start;
    margin-top: auto;
}
.blog-card .read-btn i {
    font-size: 14px;
    transition: transform .22s;
}
.blog-card .read-btn:hover {
    color: #4f46e5;
    gap: 11px;
}
.blog-card .read-btn:hover i {
    transform: translateX(3px);
}

/* ══ EMPTY / NO RESULTS ══════════════════════════════════════ */
.empty-state {
    text-align: center;
    padding: 64px 24px;
    color: #9ca3af;
}
.empty-state i {
    font-size: 52px;
    opacity: .18;
    display: block;
    margin-bottom: 14px;
}
.empty-state h5 {
    color: #374151;
    font-family: 'Heebo', sans-serif;
    font-weight: 700;
    margin-bottom: 6px;
}
.empty-state p { font-size: 13px; margin: 0; }

/* ══ SIDEBAR ═════════════════════════════════════════════════ */
.sidebar-widget {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e9edf5;
    overflow: hidden;
    margin-bottom: 24px;
    transition: box-shadow .28s;
}
.sidebar-widget:hover {
    box-shadow: 0 6px 20px rgba(0,0,0,.07);
}
.sidebar-widget .sw-head {
    padding: 16px 22px;
    border-bottom: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    gap: 10px;
}
.sidebar-widget .sw-head .sw-icon {
    width: 28px; height: 28px;
    background: linear-gradient(135deg, #766dff, #88f3ff);
    border-radius: 7px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 13px;
    flex-shrink: 0;
}
.sidebar-widget .sw-head h5 {
    margin: 0;
    font-size: 14px;
    font-weight: 800;
    color: #1e293b;
    font-family: 'Heebo', sans-serif;
}
.sidebar-widget .sw-body {
    padding: 22px;
}

/* author */
.sw-author-avatar {
    width: 82px; height: 82px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #766dff;
    display: block;
    margin: 0 auto 14px;
}
.sw-author-name {
    font-size: 17px;
    font-weight: 800;
    color: #1e293b;
    font-family: 'Heebo', sans-serif;
    margin-bottom: 3px;
    text-align: center;
}
.sw-author-role {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    color: #766dff;
    text-align: center;
    margin-bottom: 12px;
}
.sw-author-bio {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.75;
    margin-bottom: 16px;
    text-align: center;
}
.sw-social {
    display: flex;
    justify-content: center;
    gap: 8px;
}
.sw-social a {
    width: 34px; height: 34px;
    border-radius: 50%;
    border: 1px solid #e5e7eb;
    display: flex; align-items: center; justify-content: center;
    color: #6b7280; font-size: 14px;
    transition: all .22s;
    text-decoration: none;
}
.sw-social a:hover {
    background: linear-gradient(135deg, #766dff, #88f3ff);
    color: #fff; border-color: #766dff;
    transform: translateY(-2px);
    text-decoration: none;
}

/* recent posts */
.recent-post {
    display: flex;
    gap: 12px;
    align-items: center;
    padding: 11px 0;
    border-bottom: 1px solid #f1f5f9;
    cursor: pointer;
    transition: transform .2s;
}
.recent-post:first-child { padding-top: 0; }
.recent-post:last-child  { border-bottom: none; padding-bottom: 0; }
.recent-post:hover { transform: translateX(4px); }
.recent-post img {
    width: 56px; height: 56px;
    border-radius: 10px;
    object-fit: cover;
    flex-shrink: 0;
    transition: transform .3s;
}
.recent-post:hover img { transform: scale(1.06); }
.rp-info .rp-title {
    font-size: 12px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.45;
    margin-bottom: 3px;
    transition: color .2s;
}
.recent-post:hover .rp-title { color: #766dff; }
.rp-info .rp-date {
    font-size: 11px;
    color: #9ca3af;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* newsletter */
.nl-input {
    width: 100%;
    padding: 10px 16px;
    border-radius: 10px;
    border: 2px solid #e5e7eb;
    font-size: 13px;
    font-family: 'Roboto', sans-serif;
    color: #374151;
    background: #f9fafb;
    outline: none;
    margin-bottom: 10px;
    transition: border-color .22s;
    -webkit-appearance: none;
}
.nl-input:focus { border-color: #766dff; background: #fff; }
.nl-btn {
    width: 100%;
    padding: 11px;
    background: linear-gradient(135deg, #766dff, #88f3ff);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 800;
    letter-spacing: .5px;
    text-transform: uppercase;
    cursor: pointer;
    transition: all .25s;
    font-family: 'Roboto', sans-serif;
}
.nl-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(118,109,255,.38);
}

/* tags */
.tag-cloud { line-height: 1; }
.tag-cloud a {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 50px;
    border: 1.5px solid #e5e7eb;
    font-size: 11px;
    font-weight: 700;
    color: #6b7280;
    margin: 0 4px 8px 0;
    transition: all .22s;
    text-decoration: none;
    letter-spacing: .2px;
}
.tag-cloud a:hover {
    background: linear-gradient(135deg, #766dff, #88f3ff);
    color: #fff;
    border-color: #766dff;
    transform: translateY(-1px);
    text-decoration: none;
}

/* ══ MODAL ════════════════════════════════════════════════════ */
#blogModal .modal-dialog { max-width: 900px; }
#blogModal .modal-content {
    border: none;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 24px 70px rgba(0,0,0,.22);
}
#blogModal .modal-header {
    background: linear-gradient(135deg, #0f172a, #1a1f3c);
    color: #fff;
    border: none;
    padding: 18px 26px;
}
#blogModal .modal-title {
    font-size: 17px;
    font-weight: 800;
    font-family: 'Heebo', sans-serif;
    color: #fff;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: calc(100% - 40px);
}
#blogModal .modal-header .close {
    color: rgba(255,255,255,.7);
    opacity: 1;
    font-size: 26px;
    font-weight: 300;
    padding: 0;
    margin: 0;
    transition: color .2s;
    line-height: 1;
}
#blogModal .modal-header .close:hover { color: #fff; }
#blogModal .modal-body { padding: 0; }

/* loading */
.modal-loading {
    padding: 72px 24px;
    text-align: center;
}
.modal-spinner {
    width: 44px; height: 44px;
    border: 3px solid #e5e7eb;
    border-top-color: #766dff;
    border-radius: 50%;
    animation: spin .7s linear infinite;
    margin: 0 auto 16px;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* ══ RESPONSIVE ═══════════════════════════════════════════════ */
@media (max-width: 991px) {
    .blog_banner { min-height: 460px; }
    .blog_banner .banner_inner { min-height: 460px; }
    .blog_banner .blog_b_text h2 { font-size: 38px; }
    .hero-stat { padding: 0 22px; }
    .hero-stat .num { font-size: 24px; }
    .blog-filter-bar { flex-direction: column; align-items: stretch; }
    .blog-search-wrap { min-width: unset; width: 100%; }
    .blog-filter-tabs { justify-content: flex-start; }
}
@media (max-width: 767px) {
    .blog_banner { min-height: 400px; }
    .blog_banner .banner_inner { min-height: 400px; }
    .blog_banner .blog_b_text h2 { font-size: 30px; line-height: 1.25; }
    .blog_banner .blog_b_text p { font-size: 14px; }
    .hero-stats { gap: 0; padding-top: 28px; margin-top: 32px; }
    .hero-stat { padding: 0 16px; }
    .hero-stat .num { font-size: 20px; }
    .hero-stat .lbl { font-size: 9px; }
    .blog-card .img-wrap { height: 190px; }
}
@media (max-width: 575px) {
    .blog_banner { min-height: 360px; }
    .blog_banner .banner_inner { min-height: 360px; }
    .blog_banner .blog_b_text h2 { font-size: 24px; }
    .blog_banner .blog_b_text p { font-size: 13px; margin-bottom: 24px; }
    .blog_banner .blog_b_text .btn-hero { padding: 12px 28px; font-size: 12px; }
    .hero-stats { flex-direction: row; flex-wrap: nowrap; }
    .hero-stat { padding: 0 12px; }
    .hero-stat .num { font-size: 18px; }
    .hero-stat .lbl { display: none; }
    .blog-filter-tabs .filter-btn { padding: 7px 12px; font-size: 11px; }
    .blog_area { padding-top: 40px; padding-bottom: 50px; }
    #blogModal .modal-dialog { margin: 10px; }
}
@media (max-width: 400px) {
    .blog_banner .blog_b_text h2 { font-size: 20px; }
    .hero-stat + .hero-stat { border-left: none; }
    .hero-stats { gap: 10px; }
}
</style>


{{-- ══════════════════════════════════════════════════════════════
     HERO BANNER
     ══════════════════════════════════════════════════════════════ --}}
<section class="home_banner_area blog_banner">
    <div class="banner_inner">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="container">
            <div class="blog_b_text">
                <span class="eyebrow">✦ Latest Articles</span>
                <h2>
                    Insights, Tutorials<br>
                    <span>& Web Dev Stories</span>
                </h2>
                <p>Deep dives into Laravel, modern JavaScript, UI/UX design, and everything in between. Written to help developers grow.</p>
                <a href="#blogs" class="btn-hero">Explore All Articles</a>
                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="num">{{ $blogs->count() }}+</div>
                        <div class="lbl">Articles</div>
                    </div>
                    <div class="hero-stat">
                        <div class="num">{{ \App\Models\Comment::count() }}+</div>
                        <div class="lbl">Comments</div>
                    </div>
                    <div class="hero-stat">
                        <div class="num">100%</div>
                        <div class="lbl">Free</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     BLOG LISTING SECTION
     ══════════════════════════════════════════════════════════════ --}}
<section class="blog_area" id="blogs">
    <div class="container">

        {{-- FILTER BAR --}}
        <div class="blog-filter-bar">
            <div class="blog-filter-tabs">
                <button class="filter-btn active" onclick="filterBlogs('all', this)">All Posts</button>
                <button class="filter-btn" onclick="filterBlogs('laravel', this)">Laravel</button>
                <button class="filter-btn" onclick="filterBlogs('javascript', this)">JavaScript</button>
                <button class="filter-btn" onclick="filterBlogs('design', this)">Design</button>
                <button class="filter-btn" onclick="filterBlogs('general', this)">General</button>
            </div>
            <div class="blog-search-wrap">
                <input type="text" id="searchInput" placeholder="Search articles...">
                <i class="fa fa-search search-icon"></i>
            </div>
        </div>

        <div class="row">

            {{-- ═══════════════ BLOG GRID ═══════════════════════════ --}}
            <div class="col-lg-8">

                @if($blogs->count())
                <div class="row" id="blogGrid">
                    @foreach($blogs as $blog)
                    <div class="col-md-6 mb-4 blog-col" data-title="{{ strtolower($blog->title) }}" data-cat="{{ strtolower($blog->category ?? 'general') }}">
                        <div class="blog-card">
                            <div class="img-wrap">
                                @if($blog->image)
                                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" onerror="this.src='https://via.placeholder.com/600x210/766dff/fff?text=Blog'">
                                @else
                                <img src="https://via.placeholder.com/600x210/766dff/fff?text=Blog" alt="{{ $blog->title }}">
                                @endif
                                <span class="cat-badge">{{ $blog->category ?? 'General' }}</span>
                                <div class="img-overlay openBlogModal" data-id="{{ $blog->id }}">
                                    <div class="play-icon"><i class="fa fa-book-open"></i></div>
                                </div>
                            </div>
                            <div class="card-body-inner">
                                <div class="meta-row">
                                    <span class="meta-item"><i class="fa fa-calendar"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                                    <span class="meta-item"><i class="fa fa-comments"></i> {{ $blog->comments->count() }}</span>
                                    <span class="meta-item"><i class="fa fa-user"></i> Admin</span>
                                </div>
                                <h3 class="openBlogModal" data-id="{{ $blog->id }}">{{ $blog->title }}</h3>
                                <p class="excerpt">{{ Str::limit($blog->description, 105) }}</p>
                                <button class="read-btn openBlogModal" data-id="{{ $blog->id }}">
                                    Read Article <i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- No results --}}
                <div id="noResults" class="empty-state" style="display:none;">
                    <i class="fa fa-search"></i>
                    <h5>No articles found</h5>
                    <p>Try a different search term or category.</p>
                </div>

                @else
                <div class="empty-state">
                    <i class="fa fa-feather-alt"></i>
                    <h5>No articles yet</h5>
                    <p>Check back soon for fresh content.</p>
                </div>
                @endif

            </div>
            {{-- ═══════════════ END BLOG GRID ════════════════════════ --}}


            {{-- ═══════════════ SIDEBAR ══════════════════════════════ --}}
            <div class="col-lg-4">

                {{-- Author --}}
                <div class="sidebar-widget">
                    <div class="sw-head">
                        <div class="sw-icon"><i class="fa fa-user"></i></div>
                        <h5>About the Author</h5>
                    </div>
                    <div class="sw-body text-center">
                        <img src="{{ asset('img/developer.png') }}" alt="Maaz Sikandar"
                             class="sw-author-avatar"
                             onerror="this.src='https://ui-avatars.com/api/?name=Maaz+Sikandar&background=766dff&color=fff&size=164'">
                        <div class="sw-author-name">Maaz Sikandar</div>
                        <div class="sw-author-role">Laravel Developer</div>
                        <p class="sw-author-bio">Building modern, scalable web applications with Laravel, Vue.js, and clean UI patterns. Writing about real-world dev experiences.</p>
                        <div class="sw-social">
                            <a href="#" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="#" title="GitHub"><i class="fa-brands fa-github"></i></a>
                            <a href="#" title="Twitter"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                </div>

                {{-- Recent Posts --}}
                @if($blogs->count() > 1)
                <div class="sidebar-widget">
                    <div class="sw-head">
                        <div class="sw-icon"><i class="fa fa-clock"></i></div>
                        <h5>Recent Articles</h5>
                    </div>
                    <div class="sw-body">
                        @foreach($blogs->take(4) as $recent)
                        <div class="recent-post openBlogModal" data-id="{{ $recent->id }}">
                            <img src="{{ $recent->image_url }}" alt="{{ $recent->title }}"
                                 onerror="this.src='https://via.placeholder.com/56x56/766dff/fff'">
                            <div class="rp-info">
                                <div class="rp-title">{{ Str::limit($recent->title, 48) }}</div>
                                <div class="rp-date"><i class="fa fa-calendar" style="font-size:9px;"></i> {{ $recent->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Newsletter --}}
                <div class="sidebar-widget">
                    <div class="sw-head">
                        <div class="sw-icon"><i class="fa fa-envelope"></i></div>
                        <h5>Newsletter</h5>
                    </div>
                    <div class="sw-body">
                        <p style="font-size:12px; color:#6b7280; line-height:1.7; margin-bottom:14px;">
                            Get the latest articles and tutorials delivered straight to your inbox. No spam, ever.
                        </p>
                        <form onsubmit="handleNewsletter(event)">
                            <input type="text" class="nl-input" placeholder="Your full name">
                            <input type="email" class="nl-input" placeholder="Your email address" required>
                            <button type="submit" class="nl-btn" id="nlBtn"><i class="fa fa-paper-plane" style="margin-right:5px;"></i> Subscribe Now</button>
                        </form>
                    </div>
                </div>

                {{-- Tags --}}
                <div class="sidebar-widget">
                    <div class="sw-head">
                        <div class="sw-icon"><i class="fa fa-tags"></i></div>
                        <h5>Topics</h5>
                    </div>
                    <div class="sw-body">
                        <div class="tag-cloud">
                            <a href="#" onclick="filterBlogs('laravel', null); return false;">Laravel</a>
                            <a href="#" onclick="filterBlogs('php', null); return false;">PHP</a>
                            <a href="#" onclick="filterBlogs('javascript', null); return false;">JavaScript</a>
                            <a href="#" onclick="filterBlogs('design', null); return false;">UI/UX</a>
                            <a href="#" onclick="filterBlogs('vue', null); return false;">Vue.js</a>
                            <a href="#" onclick="filterBlogs('css', null); return false;">CSS</a>
                            <a href="#" onclick="filterBlogs('api', null); return false;">REST API</a>
                            <a href="#" onclick="filterBlogs('general', null); return false;">General</a>
                        </div>
                    </div>
                </div>

            </div>
            {{-- ═══════════════ END SIDEBAR ═══════════════════════════ --}}

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     MODAL
     ══════════════════════════════════════════════════════════════ --}}
<div class="modal fade" id="blogModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Loading...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div id="modalContent">
                    <div class="modal-loading">
                        <div class="modal-spinner"></div>
                        <p style="color:#9ca3af; font-size:13px; margin:0;">Loading article...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- ══════════════════════════════════════════════════════════════
     JAVASCRIPT
     NO jQuery/Bootstrap CDN here — footer already loads them
     ══════════════════════════════════════════════════════════════ --}}
<script>
(function() {
    'use strict';

    /* ──────────────────────────────────────────────────────────
       Wait for footer scripts (jQuery, Bootstrap) to load
       ────────────────────────────────────────────────────────── */
    var checkReady = setInterval(function() {
        if (typeof jQuery !== 'undefined' && typeof jQuery.fn.modal !== 'undefined') {
            clearInterval(checkReady);
            init();
        }
    }, 50);

    function init() {

        /* ── Open Blog Modal ────────────────────────────── */
        $(document).on('click', '.openBlogModal', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var blogId = $(this).data('id');
            var title  = $(this).closest('.blog-card, .recent-post').find('h3, .rp-title').first().text().trim() || 'Blog Article';

            $('#modalTitle').text(title);
            $('#blogModal').modal('show');

            $('#modalContent').html(`
                <div class="modal-loading">
                    <div class="modal-spinner"></div>
                    <p style="color:#9ca3af; font-size:13px; margin:0;">Loading article...</p>
                </div>
            `);

            $.ajax({
                url: '/blog/' + blogId + '/popup',
                type: 'GET',
                success: function(response) {
                    $('#modalContent').html(response);
                    var h2 = $('#modalContent h2, #modalContent h3').first().text();
                    if (h2) $('#modalTitle').text(h2);
                },
                error: function() {
                    $('#modalContent').html(`
                        <div class="modal-loading">
                            <i class="fa fa-exclamation-triangle" style="font-size:36px; color:#ef4444; margin-bottom:10px; display:block;"></i>
                            <p style="color:#6b7280; font-size:13px; margin:0;">Failed to load article. Please try again.</p>
                        </div>
                    `);
                }
            });
        });

        /* ── Search ─────────────────────────────────────── */
        $('#searchInput').on('input', function() {
            filterCards();
        });

        /* ── Smooth Scroll to #blogs on hero CTA click ──── */
        $('a[href="#blogs"]').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: $('#blogs').offset().top - 80 }, 400);
        });

        /* ── Auto-close mobile navbar on link click ──────── */
        $('.navbar-nav a').on('click', function() {
            if ($(window).width() < 992) {
                $('.navbar-collapse').collapse('hide');
            }
        });

    } // end init()

    /* ──────────────────────────────────────────────────────────
       Filter Categories
       ────────────────────────────────────────────────────────── */
    window.filterBlogs = function(cat, btn) {
        if (btn) {
            $('.filter-btn').removeClass('active');
            $(btn).addClass('active');
        }
        filterCards(cat === 'all' ? null : cat);

        // Scroll to section (only if not from tag click)
        if (btn && $('#blogs').length) {
            $('html, body').animate({ scrollTop: $('#blogs').offset().top - 80 }, 380);
        }
    };

    function filterCards(cat) {
        var search = $('#searchInput').val().toLowerCase();
        var visible = 0;

        $('.blog-col').each(function() {
            var title = $(this).data('title') || '';
            var c     = $(this).data('cat') || '';

            var matchSearch = !search || title.indexOf(search) !== -1;
            var matchCat    = !cat    || c.indexOf(cat) !== -1;

            if (matchSearch && matchCat) {
                $(this).show();
                visible++;
            } else {
                $(this).hide();
            }
        });

        $('#noResults').toggle(visible === 0 && $('.blog-col').length > 0);
    }

    /* ──────────────────────────────────────────────────────────
       Newsletter Handler
       ────────────────────────────────────────────────────────── */
    window.handleNewsletter = function(e) {
        e.preventDefault();
        var btn = document.getElementById('nlBtn');
        btn.innerHTML = '<i class="fa fa-check" style="margin-right:5px;"></i> Subscribed!';
        btn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
        btn.disabled = true;
        setTimeout(function() {
            btn.innerHTML = '<i class="fa fa-paper-plane" style="margin-right:5px;"></i> Subscribe Now';
            btn.style.background = '';
            btn.disabled = false;
            e.target.reset();
        }, 3200);
    };

})();
</script>

@endsection
