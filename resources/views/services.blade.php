@extends('main')
@section('main-container')

<style>
/* ==================== SERVICES PAGE STYLES (matches portfolio design) ==================== */

/* Hero Banner */
.services-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 120px 0 100px;
    position: relative;
    overflow: hidden;
}

.services-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
    background-size: cover;
    opacity: 0.3;
}

.services-hero h1 {
    color: white;
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    animation: fadeInUp 0.8s ease-out;
}

.services-hero p {
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

.breadcrumb-custom a:hover { transform: translateY(-2px); }

.breadcrumb-custom span { color: rgba(255,255,255,0.7); }

/* ---- Section Title ---- */
.section-title {
    text-align: center;
    margin-bottom: 60px;
}

.section-title h2 {
    font-size: 2.4rem;
    font-weight: 800;
    color: #2d3748;
    margin-bottom: 16px;
    position: relative;
    display: inline-block;
}

.section-title h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}

.section-title p {
    color: #718096;
    font-size: 1.1rem;
    max-width: 620px;
    margin: 24px auto 0;
    line-height: 1.8;
}

/* ---- Services Section ---- */
.services-section {
    padding: 100px 0;
    background: #f8f9fa;
}

/* ---- Service Card ---- */
.service-card {
    background: white;
    border-radius: 20px;
    padding: 40px 30px;
    height: 100%;
    border: none;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.6s ease-out both;
}

.service-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}

.service-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.12);
}

.service-card:hover::before {
    transform: scaleX(1);
}

.service-icon {
    width: 72px;
    height: 72px;
    background: linear-gradient(135deg, rgba(102,126,234,0.12) 0%, rgba(118,75,162,0.12) 100%);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
    transition: all 0.4s ease;
}

.service-icon i {
    font-size: 2rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.service-card:hover .service-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transform: scale(1.1) rotate(5deg);
}

.service-card:hover .service-icon i {
    -webkit-text-fill-color: white;
    background: none;
}

.service-card h4 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 14px;
    transition: color 0.3s;
}

.service-card:hover h4 { color: #667eea; }

.service-card p {
    color: #718096;
    font-size: 0.97rem;
    line-height: 1.8;
    margin: 0;
}

.service-badge {
    display: inline-block;
    margin-top: 20px;
    padding: 5px 16px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0;
    transform: translateY(8px);
    transition: all 0.3s ease;
}

.service-card:hover .service-badge {
    opacity: 1;
    transform: translateY(0);
}

/* ---- Stats Section ---- */
.stats-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: -50%; left: -50%;
    width: 200%; height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 60%);
}

.stat-item {
    text-align: center;
    padding: 20px;
    animation: fadeInUp 0.6s ease-out both;
}

.stat-number {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    line-height: 1;
    margin-bottom: 8px;
}

.stat-label {
    color: rgba(255,255,255,0.8);
    font-size: 1rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* ---- Testimonials Section ---- */
.testimonials-section {
    padding: 100px 0;
    background: white;
}

.testi-card {
    background: #f8f9fa;
    border-radius: 20px;
    padding: 40px 35px;
    height: 100%;
    position: relative;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    animation: fadeInUp 0.6s ease-out both;
}

.testi-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 45px rgba(0,0,0,0.1);
    background: white;
}

.testi-quote-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
}

.testi-quote-icon i {
    color: white;
    font-size: 1.2rem;
}

.testi-card p {
    color: #4a5568;
    font-size: 1rem;
    line-height: 1.8;
    font-style: italic;
    margin-bottom: 28px;
}

.testi-footer {
    display: flex;
    align-items: center;
    gap: 14px;
    border-top: 1px solid #e2e8f0;
    padding-top: 22px;
}

.testi-avatar {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.testi-avatar span {
    color: white;
    font-weight: 700;
    font-size: 1.1rem;
}

.testi-name h5 {
    font-size: 1rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0 0 2px;
}

.testi-name small {
    color: #667eea;
    font-size: 0.82rem;
    font-weight: 500;
}

.testi-stars {
    margin-left: auto;
    color: #f6c90e;
    font-size: 0.85rem;
    letter-spacing: 2px;
}

/* ---- CTA Section ---- */
.cta-section {
    padding: 100px 0;
    background: #f8f9fa;
}

.cta-box {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 24px;
    padding: 70px 60px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.cta-box::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 220px; height: 220px;
    background: rgba(255,255,255,0.08);
    border-radius: 50%;
}

.cta-box::after {
    content: '';
    position: absolute;
    bottom: -80px; left: -40px;
    width: 280px; height: 280px;
    background: rgba(255,255,255,0.05);
    border-radius: 50%;
}

.cta-box h2 {
    color: white;
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 16px;
    position: relative;
    z-index: 1;
}

.cta-box p {
    color: rgba(255,255,255,0.9);
    font-size: 1.15rem;
    max-width: 560px;
    margin: 0 auto 36px;
    line-height: 1.8;
    position: relative;
    z-index: 1;
}

.cta-btn {
    display: inline-block;
    padding: 16px 48px;
    background: white;
    color: #667eea;
    border-radius: 50px;
    font-size: 1rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.cta-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    color: #764ba2;
    text-decoration: none;
}

/* ---- Animation ---- */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Stagger delays */
.service-card:nth-child(1) { animation-delay: 0.1s; }
.service-card:nth-child(2) { animation-delay: 0.2s; }
.service-card:nth-child(3) { animation-delay: 0.3s; }
.service-card:nth-child(4) { animation-delay: 0.4s; }
.service-card:nth-child(5) { animation-delay: 0.5s; }
.service-card:nth-child(6) { animation-delay: 0.6s; }
.service-card:nth-child(7) { animation-delay: 0.7s; }
.service-card:nth-child(8) { animation-delay: 0.8s; }
.service-card:nth-child(9) { animation-delay: 0.9s; }
.service-card:nth-child(10) { animation-delay: 1.0s; }

.testi-card:nth-child(1) { animation-delay: 0.1s; }
.testi-card:nth-child(2) { animation-delay: 0.25s; }
.testi-card:nth-child(3) { animation-delay: 0.4s; }

/* ---- Responsive ---- */
@media (max-width: 992px) {
    .services-hero h1 { font-size: 2.5rem; }
    .cta-box { padding: 50px 35px; }
    .cta-box h2 { font-size: 2rem; }
}

@media (max-width: 768px) {
    .services-hero { padding: 110px 0 60px; }
    .services-hero h1 { font-size: 2rem; }
    .services-hero p { font-size: 1rem; }
    .section-title h2 { font-size: 1.9rem; }
    .stat-number { font-size: 2.3rem; }
    .cta-box { padding: 40px 24px; }
    .cta-box h2 { font-size: 1.75rem; }
}

@media (max-width: 576px) {
    .services-hero h1 { font-size: 1.75rem; }
    .service-card { padding: 30px 22px; }
    .testi-card { padding: 30px 22px; }
}
</style>

<!-- ================= HERO BANNER ================= -->
<section class="services-hero">
    <div class="container">
        <div class="text-center position-relative">
            <h1>Professional Services</h1>
            <p>Transforming ideas into powerful digital solutions with expertise, precision, and passion for quality.</p>
            <div class="breadcrumb-custom">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('services') }}">Services</a>
            </div>
        </div>
    </div>
</section>

<!-- ================= SERVICES GRID ================= -->
<section class="services-section">
    <div class="container">
        <div class="section-title">
            <h2>What I Offer</h2>
            <p>Delivering cutting-edge solutions across multiple technologies — from robust backend systems to elegant frontend experiences, tailored to your business goals.</p>
        </div>
        <div class="row g-4">

            <!-- Laravel -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-brands fa-laravel"></i>
                    </div>
                    <h4>Laravel Development</h4>
                    <p>Build powerful, scalable web applications with Laravel. I deliver enterprise-grade solutions with clean architecture, optimal performance, and maintainable code that grows with your business.</p>
                    <span class="service-badge">Backend</span>
                </div>
            </div>

            <!-- Web Design -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-brands fa-js"></i>
                    </div>
                    <h4>Modern Web Design</h4>
                    <p>Create stunning, user-friendly interfaces that engage visitors and drive conversions. Responsive designs that work flawlessly across all devices and screen sizes.</p>
                    <span class="service-badge">Frontend</span>
                </div>
            </div>

            <!-- PHP -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-brands fa-php"></i>
                    </div>
                    <h4>PHP Development</h4>
                    <p>Leverage PHP for custom backend solutions. I build secure, efficient server-side applications using modern PHP standards — robust, scalable, and easy to maintain.</p>
                    <span class="service-badge">Backend</span>
                </div>
            </div>

            <!-- Full-Stack -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-brands fa-dev"></i>
                    </div>
                    <h4>Full-Stack Development</h4>
                    <p>End-to-end web solutions from concept to deployment. I handle both frontend and backend, creating seamless web applications with modern frameworks, APIs, and database integration.</p>
                    <span class="service-badge">Full-Stack</span>
                </div>
            </div>

            <!-- Python -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-brands fa-python"></i>
                    </div>
                    <h4>Python Solutions</h4>
                    <p>Harness Python's versatility for web apps, automation, data processing, and AI integration. Perfect for intelligent systems, RESTful APIs, and powerful backend services.</p>
                    <span class="service-badge">AI / Automation</span>
                </div>
            </div>

            <!-- C++ -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-c"></i>
                    </div>
                    <h4>C++ Programming</h4>
                    <p>High-performance solutions for system-level programming and complex algorithms. Ideal for performance-critical applications, embedded systems, and competitive programming.</p>
                    <span class="service-badge">Systems</span>
                </div>
            </div>

            <!-- Graphic Design -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-palette"></i>
                    </div>
                    <h4>Graphic Designing</h4>
                    <p>Eye-catching visuals that communicate your brand's message powerfully. From logos and brand identities to marketing materials, social media graphics, and UI mockups — pixel-perfect design crafted with creativity.</p>
                    <span class="service-badge">Design</span>
                </div>
            </div>

            <!-- AI Automation -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-robot"></i>
                    </div>
                    <h4>AI Automation</h4>
                    <p>Supercharge your business with intelligent automation. I build AI-powered workflows, chatbots, data pipelines, and smart integrations using tools like OpenAI, LangChain, and custom ML models to save time and boost efficiency.</p>
                    <span class="service-badge">AI / Automation</span>
                </div>
            </div>

            <!-- Mobile App Development -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                    </div>
                    <h4>Mobile App Development</h4>
                    <p>Cross-platform mobile apps built with Flutter and React Native, plus native Android apps using Kotlin. Beautiful, performant apps for iOS and Android that deliver a smooth user experience from launch to scale.</p>
                    <span class="service-badge">Mobile</span>
                </div>
            </div>

            <!-- Desktop App Development -->
            <div class="col-lg-4 col-md-6">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fa-solid fa-desktop"></i>
                    </div>
                    <h4>Desktop App Development</h4>
                    <p>Robust Windows desktop applications developed with C# and the .NET framework. From business tools and admin dashboards to data management systems — clean, maintainable code with a polished modern UI.</p>
                    <span class="service-badge">Desktop</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= STATS SECTION ================= -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">20+</div>
                    <div class="stat-label">Projects Done</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item" style="animation-delay:0.1s">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Happy Clients</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item" style="animation-delay:0.2s">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Technologies</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item" style="animation-delay:0.3s">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Satisfaction</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= TESTIMONIALS ================= -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-title">
            <h2>Client Testimonials</h2>
            <p>Here's what clients say about working with me. Their stories reflect my commitment to exceptional results, clear communication, and exceeding expectations every time.</p>
        </div>
        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <div class="testi-card">
                    <div class="testi-quote-icon">
                        <i class="fa fa-quote-left"></i>
                    </div>
                    <p>"Outstanding professionalism and technical expertise. The project was delivered ahead of schedule with exceptional quality. Communication was clear throughout and the final product exceeded our expectations."</p>
                    <div class="testi-footer">
                        <div class="testi-avatar"><span>Z</span></div>
                        <div class="testi-name">
                            <h5>Zafar Ali</h5>
                            <small>Business Owner</small>
                        </div>
                        <div class="testi-stars">★★★★½</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testi-card">
                    <div class="testi-quote-icon">
                        <i class="fa fa-quote-left"></i>
                    </div>
                    <p>"Highly skilled developer with innovative solutions and clean, maintainable code. Excellent problem-solving abilities and attention to detail. A true professional who consistently delivers results."</p>
                    <div class="testi-footer">
                        <div class="testi-avatar"><span>I</span></div>
                        <div class="testi-name">
                            <h5>Imtiaz Alam</h5>
                            <small>Project Manager</small>
                        </div>
                        <div class="testi-stars">★★★★½</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testi-card">
                    <div class="testi-quote-icon">
                        <i class="fa fa-quote-left"></i>
                    </div>
                    <p>"Perfect execution from start to finish. Understanding of requirements was excellent, and the ongoing support made the entire experience seamless. Highly recommended for any web development project."</p>
                    <div class="testi-footer">
                        <div class="testi-avatar"><span>I</span></div>
                        <div class="testi-name">
                            <h5>Irfan Khan</h5>
                            <small>Entrepreneur</small>
                        </div>
                        <div class="testi-stars">★★★★½</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= CALL TO ACTION ================= -->
<section class="cta-section">
    <div class="container">
        <div class="cta-box">
            <h2>Ready to Start Your Project?</h2>
            <p>Let's transform your vision into reality. Whether you need a complete web solution or specific development services, I'm here to help you achieve your goals with quality and expertise.</p>
            <a href="{{ route('contact') }}" class="cta-btn">Get In Touch</a>
        </div>
    </div>
</section>

@endsection
