@extends('main')

@section('main-container')

<style>
/* ==================== MODERN PORTFOLIO STYLES ==================== */

/* Hero Banner Section */
.portfolio-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 120px 0 100px;
    position: relative;
    overflow: hidden;
}

.portfolio-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
    background-size: cover;
    opacity: 0.3;
}

.portfolio-hero h1 {
    color: white;
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    animation: fadeInUp 0.8s ease-out;
}

.portfolio-hero p {
    color: rgba(255,255,255,0.95);
    font-size: 1.25rem;
    max-width: 600px;
    margin: 0 auto 2rem;
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.breadcrumb-custom {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    padding: 10px 25px;
    display: inline-flex;
    gap: 15px;
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

.breadcrumb-custom a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s;
}

.breadcrumb-custom a:hover {
    transform: translateY(-2px);
}

.breadcrumb-custom span {
    color: rgba(255,255,255,0.7);
}

/* Filter Navigation */
.filter-section {
    padding: 60px 0 40px;
    background: #f8f9fa;
}

.filter-pills {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
    padding: 0;
    margin: 0;
    list-style: none;
}

.filter-pills li a {
    display: block;
    padding: 12px 30px;
    background: white;
    color: #667eea;
    border: 2px solid #e0e7ff;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.filter-pills li a:hover {
    background: #667eea;
    color: white;
    border-color: #667eea;
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.filter-pills li a.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-color: transparent;
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

/* Project Cards */
.projects-section {
    padding: 60px 0 100px;
    background: #f8f9fa;
}

.project-card {
    height: 100%;
    border: none;
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    cursor: pointer;
    background: white;
    animation: fadeInUp 0.6s ease-out both;
}

.project-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.project-card-img-wrapper {
    position: relative;
    overflow: hidden;
    padding-top: 70%;
}

.project-card-img-wrapper img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.project-card:hover .project-card-img-wrapper img {
    transform: scale(1.1);
}

.project-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.project-card:hover .project-overlay {
    opacity: 1;
}

.project-overlay-icon {
    color: white;
    font-size: 3rem;
    transform: scale(0.5);
    transition: transform 0.4s ease;
}

.project-card:hover .project-overlay-icon {
    transform: scale(1);
}

.project-card-body {
    padding: 25px;
}

.project-card-body h5 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 8px;
    transition: color 0.3s;
}

.project-card:hover .project-card-body h5 {
    color: #667eea;
}

.project-card-body .client-name {
    color: #718096;
    font-size: 0.95rem;
    font-weight: 500;
    margin-bottom: 12px;
}

.project-category {
    display: inline-block;
    padding: 5px 15px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Modal Styles - REPLACED BY LIGHTBOX (see below) */

/* ==================== PROFESSIONAL LIGHTBOX ==================== */

/* Overlay backdrop */
#portfolioLightbox {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(10, 10, 20, 0.97);
    animation: lbFadeIn 0.3s ease;
}

#portfolioLightbox.lb-active {
    display: flex;
    flex-direction: column;
}

@keyframes lbFadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Top bar */
.lb-topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 30px;
    background: rgba(255,255,255,0.04);
    border-bottom: 1px solid rgba(255,255,255,0.07);
    flex-shrink: 0;
}

.lb-topbar-left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.lb-category-badge {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 4px 14px;
    border-radius: 20px;
}

.lb-title {
    color: white;
    font-size: 1.15rem;
    font-weight: 700;
    margin: 0;
}

.lb-topbar-right {
    display: flex;
    align-items: center;
    gap: 10px;
}

.lb-counter {
    color: rgba(255,255,255,0.45);
    font-size: 0.85rem;
    font-weight: 500;
    min-width: 50px;
    text-align: right;
}

.lb-close-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.2);
    background: transparent;
    color: white;
    font-size: 1.4rem;
    line-height: 1;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

.lb-close-btn:hover {
    background: #667eea;
    border-color: #667eea;
    transform: rotate(90deg);
}

/* Main body */
.lb-body {
    display: flex;
    flex: 1;
    overflow: hidden;
    min-height: 0;
}

/* Image stage */
.lb-stage {
    flex: 1;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: #0d0d18;
}

.lb-slides-container {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.lb-slide {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.lb-slide.lb-active {
    opacity: 1;
    pointer-events: auto;
    z-index: 2;
}

.lb-slide img {
    max-width: 90%;
    max-height: 90%;
    object-fit: contain;
    border-radius: 4px;
    box-shadow: 0 30px 80px rgba(0,0,0,0.6);
    display: block;
}

/* Navigation arrows */
.lb-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 54px;
    height: 54px;
    border-radius: 50%;
    border: none;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(8px);
    color: white;
    font-size: 1.3rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    z-index: 10;
}

.lb-nav-btn:hover {
    background: linear-gradient(135deg, #667eea, #764ba2);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 8px 25px rgba(102,126,234,0.5);
}

.lb-prev { left: 20px; }
.lb-next { right: 20px; }

.lb-nav-btn:disabled {
    opacity: 0.2;
    cursor: not-allowed;
    transform: translateY(-50%) scale(1);
}

/* Side info panel */
.lb-info {
    width: 320px;
    flex-shrink: 0;
    background: #111122;
    border-left: 1px solid rgba(255,255,255,0.07);
    display: flex;
    flex-direction: column;
    overflow-y: auto;
}

.lb-info-header {
    padding: 30px 28px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.07);
}

.lb-info-header h3 {
    color: white;
    font-size: 1.4rem;
    font-weight: 800;
    margin-bottom: 10px;
    line-height: 1.3;
}

.lb-info-client {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.55);
    font-size: 0.9rem;
}

.lb-info-client i {
    color: #667eea;
}

.lb-info-body {
    padding: 24px 28px;
    flex: 1;
}

.lb-info-label {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #667eea;
    margin-bottom: 8px;
    margin-top: 20px;
}

.lb-info-label:first-child {
    margin-top: 0;
}

.lb-info-value {
    color: rgba(255,255,255,0.8);
    font-size: 0.95rem;
    line-height: 1.7;
}

/* Thumbnail strip */
.lb-thumbs {
    padding: 16px 28px 24px;
    border-top: 1px solid rgba(255,255,255,0.07);
}

.lb-thumbs-label {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: rgba(255,255,255,0.35);
    margin-bottom: 12px;
}

.lb-thumbs-strip {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.lb-thumb {
    width: 68px;
    height: 50px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    transition: all 0.3s;
    flex-shrink: 0;
}

.lb-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.lb-thumb:hover {
    border-color: rgba(102,126,234,0.6);
    transform: scale(1.05);
}

.lb-thumb.lb-thumb-active {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102,126,234,0.3);
}

/* Bottom thumbnail progress bar */
.lb-progress {
    flex-shrink: 0;
    padding: 14px 30px;
    background: rgba(255,255,255,0.03);
    border-top: 1px solid rgba(255,255,255,0.07);
    display: flex;
    align-items: center;
    gap: 16px;
}

.lb-progress-dots {
    display: flex;
    gap: 8px;
}

.lb-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    cursor: pointer;
    transition: all 0.3s;
}

.lb-dot.lb-dot-active {
    background: #667eea;
    transform: scale(1.3);
    box-shadow: 0 0 8px rgba(102,126,234,0.6);
}

.lb-keyboard-hint {
    margin-left: auto;
    color: rgba(255,255,255,0.2);
    font-size: 0.75rem;
    display: flex;
    gap: 6px;
    align-items: center;
}

.lb-key {
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 4px;
    padding: 1px 6px;
    font-size: 0.7rem;
}

/* Responsive lightbox */
@media (max-width: 900px) {
    .lb-body {
        flex-direction: column;
    }

    .lb-info {
        width: 100%;
        max-height: 220px;
        border-left: none;
        border-top: 1px solid rgba(255,255,255,0.07);
    }

    .lb-info-header {
        padding: 16px 20px;
    }

    .lb-info-body {
        padding: 12px 20px;
    }

    .lb-thumbs {
        display: none;
    }

    .lb-nav-btn {
        width: 42px;
        height: 42px;
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .lb-topbar {
        padding: 14px 16px;
    }

    .lb-title {
        font-size: 1rem;
    }

    .lb-prev { left: 8px; }
    .lb-next { right: 8px; }

    .lb-keyboard-hint { display: none; }
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Staggered Animation for Cards */
.project-card:nth-child(1) { animation-delay: 0.1s; }
.project-card:nth-child(2) { animation-delay: 0.2s; }
.project-card:nth-child(3) { animation-delay: 0.3s; }
.project-card:nth-child(4) { animation-delay: 0.4s; }
.project-card:nth-child(5) { animation-delay: 0.5s; }
.project-card:nth-child(6) { animation-delay: 0.6s; }

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.empty-state-icon {
    font-size: 5rem;
    color: #cbd5e0;
    margin-bottom: 20px;
}

.empty-state h3 {
    color: #4a5568;
    font-weight: 600;
    margin-bottom: 10px;
}

.empty-state p {
    color: #718096;
}

/* Responsive Design */
@media (max-width: 992px) {
    .portfolio-hero h1 {
        font-size: 2.5rem;
    }
    
    .portfolio-hero p {
        font-size: 1.1rem;
    }
}

@media (max-width: 768px) {
    .portfolio-hero {
        padding: 110px 0 60px;
    }
    
    .portfolio-hero h1 {
        font-size: 2rem;
    }
    
    .portfolio-hero p {
        font-size: 1rem;
    }
    
    .filter-pills li a {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
    
    .carousel-item img {
        height: 400px;
    }
}

@media (max-width: 576px) {
    .portfolio-hero h1 {
        font-size: 1.75rem;
    }
    
    .filter-pills {
        gap: 10px;
    }
    
    .filter-pills li a {
        padding: 8px 16px;
        font-size: 0.85rem;
    }
    
    .carousel-item img {
        height: 300px;
    }
    
    .project-card-body {
        padding: 20px;
    }
}
</style>

<!-- ================= HERO BANNER ================= -->
<section class="portfolio-hero">
    <div class="container">
        <div class="text-center position-relative">
            <h1>My Portfolio</h1>
            <p>Explore my latest projects crafted with passion and expertise. From web development to creative design, each project tells a unique story.</p>
            <div class="breadcrumb-custom">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('portfolio') }}">Portfolio</a>
            </div>
        </div>
    </div>
</section>

<!-- ================= FILTER NAVIGATION ================= -->
<section class="filter-section">
    <div class="container">
        <ul class="filter-pills" id="filterPills">
            <li>
                <a class="filter-btn active" data-filter="all" href="#">
                    <i class="fa fa-th"></i> All Projects
                </a>
            </li>
            @foreach($categories as $cat)
            <li>
                <a class="filter-btn" data-filter="{{ $cat['slug'] }}" href="#">
                    {{ $cat['label'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</section>


<!-- ================= PROJECTS GRID ================= -->
<section class="projects-section">
    <div class="container">
        <div class="row" id="projectsGrid">

            @forelse($projects as $project)
            @php
                $categoryLabels = [
                    'manipul'  => 'Web Development',
                    'creative' => 'UI/UX Design',
                    'brand'    => 'Branding',
                    'mobile'   => 'Mobile Applications',
                    'desktop'  => 'Desktop Applications',
                ];
                $categoryLabel = $categoryLabels[$project->category] ?? ucfirst($project->category);
            @endphp
            <div class="col-lg-4 col-md-6 mb-4 project-item" data-category="{{ $project->category }}">
                <div class="project-card lb-open-btn"
                     data-id="{{ $project->id }}"
                     data-title="{{ $project->title }}"
                     data-client="{{ $project->client_name }}"
                     data-category="{{ $project->category }}"
                     data-category-label="{{ $categoryLabel }}"
                     data-description="{{ $project->description ?? '' }}"
                     data-website-link="{{ $project->website_link ?? '' }}"
                     data-img1="{{ asset('uploads/' . $project->image1) }}"
                     data-img2="{{ $project->image2 ? asset('uploads/' . $project->image2) : '' }}"
                     data-img3="{{ $project->image3 ? asset('uploads/' . $project->image3) : '' }}"
                     data-img4="{{ $project->image4 ? asset('uploads/' . $project->image4) : '' }}"
                     data-img5="{{ $project->image5 ? asset('uploads/' . $project->image5) : '' }}"
                     data-img6="{{ $project->image6 ? asset('uploads/' . $project->image6) : '' }}">
                    <div class="project-card-img-wrapper">
                        <img src="{{ asset('uploads/' . $project->image1) }}" alt="{{ $project->title }}">
                        <div class="project-overlay">
                            <i class="fa fa-search-plus project-overlay-icon"></i>
                        </div>
                    </div>
                    <div class="project-card-body">
                        <h5>{{ $project->title }}</h5>
                        <p class="client-name"><i class="fa fa-user"></i> {{ $project->client_name }}</p>
                        <span class="project-category">{{ $categoryLabel }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <div class="empty-state-icon">📂</div>
                    <h3>No Projects Yet</h3>
                    <p>Check back soon for exciting new projects!</p>
                </div>
            </div>
            @endforelse

        </div>

        <!-- No results message -->
        <div id="noResults" class="empty-state" style="display:none;">
            <div class="empty-state-icon">🔍</div>
            <h3>No Projects Found</h3>
            <p>No projects in this category yet.</p>
        </div>
    </div>
</section>


<!-- ================= PROFESSIONAL LIGHTBOX ================= -->
<div id="portfolioLightbox" role="dialog" aria-modal="true" aria-label="Project viewer">

    <!-- Top bar -->
    <div class="lb-topbar">
        <div class="lb-topbar-left">
            <span class="lb-category-badge" id="lbCategory"></span>
            <h2 class="lb-title" id="lbTitle"></h2>
        </div>
        <div class="lb-topbar-right">
            <span class="lb-counter" id="lbCounter"></span>
            <button class="lb-close-btn" id="lbClose" aria-label="Close">&times;</button>
        </div>
    </div>

    <!-- Body -->
    <div class="lb-body">

        <!-- Image stage -->
        <div class="lb-stage" id="lbStage">
            <button class="lb-nav-btn lb-prev" id="lbPrev" aria-label="Previous image">
                <i class="fa fa-chevron-left"></i>
            </button>
            <div class="lb-slides-container" id="lbSlidesContainer">
                <!-- Slides injected here by JS -->
            </div>
            <button class="lb-nav-btn lb-next" id="lbNext" aria-label="Next image">
                <i class="fa fa-chevron-right"></i>
            </button>
        </div>

        <!-- Side info panel -->
        <div class="lb-info">
            <div class="lb-info-header">
                <h3 id="lbInfoTitle"></h3>
                <div class="lb-info-client">
                    <i class="fa fa-user"></i>
                    <span id="lbInfoClient"></span>
                </div>
            </div>
            <div class="lb-info-body">
                <div class="lb-info-label">Category</div>
                <div class="lb-info-value" id="lbInfoCategory"></div>

                <div id="lbDescBlock" style="display:none;">
                    <div class="lb-info-label">About this project</div>
                    <div class="lb-info-value" id="lbInfoDesc"></div>
                </div>

                <div class="lb-info-label">Photos</div>
                <div class="lb-info-value" id="lbInfoCount"></div>

                <a id="lbWebsiteButton" href="#" target="_blank" rel="noopener noreferrer"
                   style="display:none; margin-top:12px; padding:10px 14px; border-radius:999px; background:var(--accent); color:#fff; text-decoration:none; font-weight:600; text-align:center;">
                    Visit Website
                </a>
            </div>

            <!-- Thumbnail strip -->
            <div class="lb-thumbs">
                <div class="lb-thumbs-label">Gallery</div>
                <div class="lb-thumbs-strip" id="lbThumbsStrip"></div>
            </div>
        </div>

    </div>

    <!-- Bottom progress dots -->
    <div class="lb-progress">
        <div class="lb-progress-dots" id="lbDots"></div>
        <div class="lb-keyboard-hint">
            <span class="lb-key">&#8592;</span>
            <span class="lb-key">&#8594;</span>
            <span style="margin-left:4px;">Navigate</span>
            <span class="lb-key" style="margin-left:10px;">Esc</span>
            <span style="margin-left:4px;">Close</span>
        </div>
    </div>

</div>

<script>
// ===================== PORTFOLIO FILTER =====================

document.addEventListener('DOMContentLoaded', function () {

    // ---------- FILTER ----------
    var filterBtns   = document.querySelectorAll('.filter-btn');
    var projectItems = document.querySelectorAll('.project-item');
    var noResults    = document.getElementById('noResults');

    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            filterBtns.forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');

            var filter       = btn.getAttribute('data-filter');
            var visibleCount = 0;

            projectItems.forEach(function (item) {
                var itemCategory = item.getAttribute('data-category');
                if (filter === 'all' || itemCategory === filter) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (noResults) {
                noResults.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    });

    // ---------- LIGHTBOX ----------
    var lightbox         = document.getElementById('portfolioLightbox');
    var lbClose          = document.getElementById('lbClose');
    var lbPrev           = document.getElementById('lbPrev');
    var lbNext           = document.getElementById('lbNext');
    var lbSlidesContainer = document.getElementById('lbSlidesContainer');
    var lbDots           = document.getElementById('lbDots');
    var lbThumbsStrip    = document.getElementById('lbThumbsStrip');

    var images      = [];
    var currentIdx  = 0;
    var slides      = [];

    // Collect all cards
    document.querySelectorAll('.lb-open-btn').forEach(function (card) {
        card.addEventListener('click', function () {
            var imgs = [
                card.getAttribute('data-img1'),
                card.getAttribute('data-img2'),
                card.getAttribute('data-img3'),
                card.getAttribute('data-img4'),
                card.getAttribute('data-img5'),
                card.getAttribute('data-img6')
            ].filter(function(img) { return img && img.trim() !== ''; });

            openLightbox({
                title:         card.getAttribute('data-title'),
                client:        card.getAttribute('data-client'),
                category:      card.getAttribute('data-category'),
                categoryLabel: card.getAttribute('data-category-label') || capitalizeFirst(card.getAttribute('data-category')),
                description:   card.getAttribute('data-description'),
                websiteLink:   card.getAttribute('data-website-link'),
                images:        imgs
            });
        });
    });

    function openLightbox(data) {
        images     = data.images;
        currentIdx = 0;
        slides     = [];

        // Populate info panel
        document.getElementById('lbTitle').textContent        = data.title;
        document.getElementById('lbInfoTitle').textContent    = data.title;
        document.getElementById('lbInfoClient').textContent   = data.client;
        document.getElementById('lbCategory').textContent     = (data.categoryLabel || data.category).toUpperCase();
        document.getElementById('lbInfoCategory').textContent = data.categoryLabel || capitalizeFirst(data.category);
        document.getElementById('lbInfoCount').textContent    = images.length + ' photo' + (images.length > 1 ? 's' : '');

        var descBlock = document.getElementById('lbDescBlock');
        if (data.description && data.description.trim() !== '') {
            document.getElementById('lbInfoDesc').textContent = data.description;
            descBlock.style.display = '';
        } else {
            descBlock.style.display = 'none';
        }

        var websiteButton = document.getElementById('lbWebsiteButton');
        if (data.websiteLink && data.websiteLink.trim() !== '') {
            websiteButton.href = data.websiteLink;
            websiteButton.style.display = 'inline-block';
        } else {
            websiteButton.style.display = 'none';
        }

        // Build slides
        lbSlidesContainer.innerHTML = '';
        images.forEach(function (src, i) {
            var slide = document.createElement('div');
            slide.className = 'lb-slide';
            if (i === 0) slide.classList.add('lb-active');
            slide.innerHTML = '<img src="' + src + '" alt="Project image ' + (i+1) + '">';
            lbSlidesContainer.appendChild(slide);
            slides.push(slide);
        });

        // Build thumbnails
        lbThumbsStrip.innerHTML = '';
        images.forEach(function (src, i) {
            var thumb = document.createElement('div');
            thumb.className = 'lb-thumb';
            if (i === 0) thumb.classList.add('lb-thumb-active');
            thumb.innerHTML = '<img src="' + src + '" alt="Thumb ' + (i+1) + '">';
            thumb.addEventListener('click', function () { goToSlide(i); });
            lbThumbsStrip.appendChild(thumb);
        });

        // Build dots
        lbDots.innerHTML = '';
        images.forEach(function (_, i) {
            var dot = document.createElement('div');
            dot.className = 'lb-dot';
            if (i === 0) dot.classList.add('lb-dot-active');
            dot.addEventListener('click', function () { goToSlide(i); });
            lbDots.appendChild(dot);
        });

        updateControls();
        lightbox.classList.add('lb-active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.remove('lb-active');
        document.body.style.overflow = '';
    }

    function goToSlide(idx) {
        if (idx < 0 || idx >= images.length || idx === currentIdx) return;

        // Remove active from current
        slides[currentIdx].classList.remove('lb-active');

        // Set new index
        currentIdx = idx;

        // Add active to new
        slides[currentIdx].classList.add('lb-active');

        updateControls();
    }

    function updateControls() {
        // Counter
        document.getElementById('lbCounter').textContent = (currentIdx + 1) + ' / ' + images.length;

        // Dots
        var dotElements = lbDots.querySelectorAll('.lb-dot');
        dotElements.forEach(function (d, i) {
            if (i === currentIdx) {
                d.classList.add('lb-dot-active');
            } else {
                d.classList.remove('lb-dot-active');
            }
        });

        // Thumbnails
        var thumbElements = lbThumbsStrip.querySelectorAll('.lb-thumb');
        thumbElements.forEach(function (t, i) {
            if (i === currentIdx) {
                t.classList.add('lb-thumb-active');
            } else {
                t.classList.remove('lb-thumb-active');
            }
        });

        // Arrow states
        lbPrev.disabled = (currentIdx === 0);
        lbNext.disabled = (currentIdx === images.length - 1);
    }

    // Navigation
    lbPrev.addEventListener('click', function () {
        goToSlide(currentIdx - 1);
    });

    lbNext.addEventListener('click', function () {
        goToSlide(currentIdx + 1);
    });

    // Close
    lbClose.addEventListener('click', closeLightbox);

    lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });

    // Keyboard
    document.addEventListener('keydown', function (e) {
        if (!lightbox.classList.contains('lb-active')) return;

        if (e.key === 'ArrowLeft' || e.key === 'Left') {
            e.preventDefault();
            goToSlide(currentIdx - 1);
        }
        if (e.key === 'ArrowRight' || e.key === 'Right') {
            e.preventDefault();
            goToSlide(currentIdx + 1);
        }
        if (e.key === 'Escape' || e.key === 'Esc') {
            e.preventDefault();
            closeLightbox();
        }
    });

    // Touch swipe
    var touchStartX = 0;
    var touchStartY = 0;
    
    lbSlidesContainer.addEventListener('touchstart', function (e) {
        touchStartX = e.changedTouches[0].clientX;
        touchStartY = e.changedTouches[0].clientY;
    }, { passive: true });

    lbSlidesContainer.addEventListener('touchend', function (e) {
        var touchEndX = e.changedTouches[0].clientX;
        var touchEndY = e.changedTouches[0].clientY;
        var diffX = touchStartX - touchEndX;
        var diffY = touchStartY - touchEndY;

        // Only trigger if horizontal swipe is dominant
        if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
            if (diffX > 0) {
                goToSlide(currentIdx + 1);
            } else {
                goToSlide(currentIdx - 1);
            }
        }
    }, { passive: true });

    // Helper
    function capitalizeFirst(str) {
        if (!str) return '';
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

});
</script>

@endsection