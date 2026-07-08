<!--================Footer Area =================-->
<footer class="footer_area p_120">
    <div class="container">
        <div class="row footer_inner">

            {{-- About / Brand Column --}}
            <div class="col-lg-4 col-sm-6">
                <aside class="f_widget ab_widget">
                    <div class="f_title">
                        <a href="{{ route('home') }}" style="display:inline-block; margin-bottom: 16px;">
                            <img src="{{ asset('img/company logo.png') }}"
                                 alt="CodeEdge Labs"
                                 style="
                                     height: 64px;
                                     width: auto;
                                     border-radius: 10px;
                                     object-fit: contain;
                                     display: block;
                                 ">
                        </a>
                    </div>
                    <p>
                        I am a passionate software developer focused on building modern, scalable,
                        and user-friendly web applications. I love turning ideas into real-world
                        digital solutions.
                    </p>
                    <p>
                        &copy; <script>document.write(new Date().getFullYear());</script>
                        All rights reserved &mdash; Made with <i class="fas fa-heart" style="color:#766dff;"></i>
                        by <strong style="color:#fff;">codeEdge Labs</strong>
                    </p>
                </aside>
            </div>

            {{-- Quick Links Column --}}
            <div class="col-lg-2 col-sm-6">
                <aside class="f_widget">
                    <div class="f_title">
                        <h3>Quick Links</h3>
                    </div>
                    <ul class="list footer_links">
                        <li><a href="{{ route('home') }}"><i class="fas fa-angle-right"></i> Home</a></li>
                        <li><a href="{{ route('about-us') }}"><i class="fas fa-angle-right"></i> About</a></li>
                        <li><a href="{{ route('team') }}"><i class="fas fa-angle-right"></i> Our Team</a></li>
                        <li><a href="{{ route('portfolio') }}"><i class="fas fa-angle-right"></i> Projects</a></li>
                        <li><a href="{{ route('services') }}"><i class="fas fa-angle-right"></i> Services</a></li>
                        <li><a href="{{ route('blog') }}"><i class="fas fa-angle-right"></i> Blog</a></li>
                        <li><a href="{{ route('contact') }}"><i class="fas fa-angle-right"></i> Contact</a></li>
                    </ul>
                </aside>
            </div>

            {{-- Newsletter Column --}}
            <div class="col-lg-3 col-sm-6">
                <aside class="f_widget news_widget">
                    <div class="f_title">
                        <h3>Newsletter</h3>
                    </div>
                    <p>Stay updated with the latest projects and insights. No spam, ever.</p>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Enter your email">
                        <div class="input-group-append">
                            <button class="sub-btn" type="button">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </aside>
            </div>

            {{-- Social Column --}}
            <div class="col-lg-3 col-sm-6">
                <aside class="f_widget social_widget">
                    <div class="f_title">
                        <h3>Follow Me</h3>
                    </div>
                    <p>Connect with me on social media for updates and conversations.</p>
                    <ul class="list social_links">
                        <li>
                            <a href="https://www.facebook.com/share/1BeRAUG6Xu/" title="Facebook" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-facebook-square fa-lg"></i>
                                <span>Facebook</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://x.com/MaazSikandar" title="Twitter / X" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-twitter-square fa-lg"></i>
                                <span>Twitter</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/in/maaz-sikandar-sikandar-8b726a40b" title="LinkedIn" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-linkedin fa-lg"></i>
                                <span>LinkedIn</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://github.com/sikandarmaaz804-ctrl" title="GitHub" target="_blank" rel="noopener noreferrer">
                                <i class="fab fa-github-square fa-lg"></i>
                                <span>GitHub</span>
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>

        </div>{{-- /.row --}}

        {{-- Bottom Bar --}}
        <div class="row">
            <div class="col-12">
                <div class="footer_bottom">
                    <p>
                        Designed &amp; developed by <a href="#">codeEdge Labs</a> &mdash;
                        Building digital experiences that matter.
                    </p>
                </div>
            </div>
        </div>

    </div>
</footer>
<!--================End Footer Area =================-->

<style>
/* ---- Footer enhancements ---- */
.footer_area {
    background: #0a0a12;
    padding-top: 70px;
    padding-bottom: 0;
    border-top: 3px solid #766dff;
}

.footer_inner {
    padding-bottom: 50px;
}

/* Quick links */
.footer_links li {
    margin-bottom: 10px;
}
.footer_links li a {
    color: #777;
    font-size: 14px;
    font-family: "Roboto", sans-serif;
    transition: color 300ms linear;
    text-decoration: none;
}
.footer_links li a i {
    margin-right: 7px;
    color: #766dff;
}
.footer_links li a:hover {
    color: #766dff;
    padding-left: 4px;
}

/* Social links styled as a list with labels */
.social_links li {
    margin-bottom: 12px;
    display: block !important;
}
.social_links li a {
    color: #aaa;
    font-size: 14px;
    font-family: "Roboto", sans-serif;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: color 300ms linear;
}
.social_links li a i {
    font-size: 20px;
    width: 24px;
    text-align: center;
}
.social_links li a span {
    font-size: 13px;
}
.social_links li a:hover {
    color: #766dff;
}

/* Footer bottom bar */
.footer_bottom {
    border-top: 1px solid #1e1e2e;
    padding: 18px 0;
    text-align: center;
}
.footer_bottom p {
    color: #555;
    font-size: 13px;
    font-family: "Roboto", sans-serif;
    margin: 0;
}
.footer_bottom p a {
    color: #766dff;
    text-decoration: none;
    transition: opacity 200ms;
}
.footer_bottom p a:hover {
    opacity: 0.8;
}

/* Newsletter button icon spacing */
.news_widget .sub-btn i {
    font-size: 14px;
}
</style>

<!-- ================ WhatsApp CTA Button ================ -->
<div id="whatsapp-cta">
    <button id="whatsapp-btn" onclick="openWhatsAppModal()" aria-label="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
        <span class="whatsapp-label">Let's Chat</span>
    </button>
</div>

<!-- WhatsApp Message Selector Modal -->
<div id="whatsapp-modal-overlay" onclick="closeWhatsAppModal()" aria-hidden="true"></div>
<div id="whatsapp-modal" role="dialog" aria-modal="true" aria-labelledby="wa-modal-title">
    <div class="wa-modal-header">
        <div class="wa-modal-avatar">
            <i class="fab fa-whatsapp"></i>
        </div>
        <div class="wa-modal-info">
            <h4 id="wa-modal-title">codeEdge Labs</h4>
            <span class="wa-online"><span class="wa-dot"></span> Typically replies quickly</span>
        </div>
        <button class="wa-close-btn" onclick="closeWhatsAppModal()" aria-label="Close">&times;</button>
    </div>

    <div class="wa-modal-body">
        <p class="wa-choose-label">Choose a message to send:</p>
        <div class="wa-options">
            <button class="wa-option-btn" onclick="sendWhatsApp('Hi! I have a project idea and I\'d like to discuss it with you.')">
                <i class="fas fa-lightbulb"></i> I have a project idea
            </button>
            <button class="wa-option-btn" onclick="sendWhatsApp('Hello! I\'m interested in getting a quote for my project.')">
                <i class="fas fa-file-invoice-dollar"></i> I need a price quote
            </button>
            <button class="wa-option-btn" onclick="sendWhatsApp('Hi! I\'d like to hire you for web development.')">
                <i class="fas fa-laptop-code"></i> I want to hire you
            </button>
            <button class="wa-option-btn" onclick="sendWhatsApp('Hello! I need help with an existing website or application.')">
                <i class="fas fa-tools"></i> I need support / fixes
            </button>
            <button class="wa-option-btn" onclick="sendWhatsApp('Hi! I\'m interested in a custom web application. Can we talk?')">
                <i class="fas fa-code"></i> Custom web application
            </button>
            <button class="wa-option-btn" onclick="sendWhatsApp('Hello! I would like to collaborate on a project with you.')">
                <i class="fas fa-handshake"></i> Collaboration opportunity
            </button>
        </div>
    </div>

    <div class="wa-modal-footer">
        <p>or <a href="#" onclick="sendWhatsApp('Hello! I came across your portfolio and would like to get in touch.'); return false;">send a general greeting</a></p>
    </div>
</div>

<style>
/* ---- WhatsApp Floating Button ---- */
#whatsapp-cta {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 9999;
}

#whatsapp-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #25D366;
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 14px 22px;
    font-size: 16px;
    font-family: "Roboto", sans-serif;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(37, 211, 102, 0.45);
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    animation: wa-pulse 2.5s infinite;
}

#whatsapp-btn:hover {
    background: #1ebe5d;
    transform: translateY(-3px);
    box-shadow: 0 8px 28px rgba(37, 211, 102, 0.55);
    animation: none;
}

#whatsapp-btn .fab {
    font-size: 22px;
    line-height: 1;
}

@keyframes wa-pulse {
    0%   { box-shadow: 0 4px 20px rgba(37,211,102,0.45); }
    50%  { box-shadow: 0 4px 28px rgba(37,211,102,0.75), 0 0 0 10px rgba(37,211,102,0.08); }
    100% { box-shadow: 0 4px 20px rgba(37,211,102,0.45); }
}

/* ---- Modal Overlay ---- */
#whatsapp-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    z-index: 10000;
    animation: wa-fade-in 0.2s ease;
}

/* ---- Modal Box ---- */
#whatsapp-modal {
    display: none;
    position: fixed;
    bottom: 100px;
    right: 30px;
    width: 340px;
    max-width: calc(100vw - 30px);
    background: #fff;
    border-radius: 16px;
    z-index: 10001;
    box-shadow: 0 12px 40px rgba(0,0,0,0.25);
    overflow: hidden;
    animation: wa-slide-up 0.25s ease;
}

@keyframes wa-slide-up {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

@keyframes wa-fade-in {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* Modal Header */
.wa-modal-header {
    background: #25D366;
    padding: 16px 18px;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #fff;
}

.wa-modal-avatar {
    width: 46px;
    height: 46px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
}

.wa-modal-info {
    flex: 1;
}

.wa-modal-info h4 {
    margin: 0 0 3px;
    font-size: 15px;
    font-weight: 700;
    color: #fff;
    font-family: "Roboto", sans-serif;
}

.wa-online {
    font-size: 12px;
    opacity: 0.9;
    display: flex;
    align-items: center;
    gap: 5px;
    font-family: "Roboto", sans-serif;
}

.wa-dot {
    width: 8px;
    height: 8px;
    background: #fff;
    border-radius: 50%;
    display: inline-block;
    animation: wa-blink 1.4s infinite;
}

@keyframes wa-blink {
    0%, 100% { opacity: 1; }
    50%       { opacity: 0.3; }
}

.wa-close-btn {
    background: none;
    border: none;
    color: #fff;
    font-size: 24px;
    cursor: pointer;
    line-height: 1;
    padding: 0 2px;
    opacity: 0.85;
    transition: opacity 0.15s;
}
.wa-close-btn:hover { opacity: 1; }

/* Modal Body */
.wa-modal-body {
    padding: 18px 18px 10px;
    background: #f0f4f3;
    max-height: 55vh;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}

.wa-choose-label {
    font-size: 12px;
    font-family: "Roboto", sans-serif;
    color: #888;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.wa-options {
    display: flex;
    flex-direction: column;
    gap: 9px;
}

.wa-option-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 11px 14px;
    font-size: 13.5px;
    font-family: "Roboto", sans-serif;
    color: #333;
    cursor: pointer;
    text-align: left;
    transition: background 0.15s, border-color 0.15s, color 0.15s;
}

.wa-option-btn i {
    color: #25D366;
    font-size: 15px;
    width: 18px;
    flex-shrink: 0;
}

.wa-option-btn:hover {
    background: #25D366;
    border-color: #25D366;
    color: #fff;
}

.wa-option-btn:hover i {
    color: #fff;
}

/* Modal Footer */
.wa-modal-footer {
    padding: 10px 18px 14px;
    background: #f0f4f3;
    text-align: center;
    border-top: 1px solid #e5e5e5;
}

.wa-modal-footer p {
    font-size: 12.5px;
    font-family: "Roboto", sans-serif;
    color: #888;
    margin: 0;
}

.wa-modal-footer a {
    color: #25D366;
    font-weight: 600;
    text-decoration: none;
}
.wa-modal-footer a:hover {
    text-decoration: underline;
}

/* ---- Responsive ---- */
@media (max-width: 575px) {
    /* Button: icon-only circle */
    #whatsapp-cta { bottom: 20px; right: 18px; }
    #whatsapp-btn {
        padding: 0;
        width: 54px;
        height: 54px;
        border-radius: 50%;
        justify-content: center;
        gap: 0;
    }
    #whatsapp-btn .whatsapp-label { display: none; }
    #whatsapp-btn .fab { font-size: 26px; }

    /* Modal: slide-up bottom sheet */
    #whatsapp-modal {
        position: fixed;
        bottom: 0;
        right: 0;
        left: 0;
        width: 100%;
        max-width: 100%;
        border-radius: 20px 20px 0 0;
        animation: wa-sheet-up 0.28s cubic-bezier(0.32, 0.72, 0, 1);
    }

    /* Overlay full screen */
    #whatsapp-modal-overlay {
        position: fixed;
        inset: 0;
    }

    @keyframes wa-sheet-up {
        from { transform: translateY(100%); opacity: 0.8; }
        to   { transform: translateY(0);    opacity: 1; }
    }

    /* Compact options on mobile */
    .wa-option-btn {
        padding: 12px 14px;
        font-size: 13px;
    }

    /* Handle bar indicator */
    .wa-modal-header::before {
        content: '';
        display: block;
        width: 40px;
        height: 4px;
        background: rgba(255,255,255,0.4);
        border-radius: 4px;
        position: absolute;
        top: 8px;
        left: 50%;
        transform: translateX(-50%);
    }
    .wa-modal-header { position: relative; padding-top: 22px; }
}
</style>

<script>
    var WA_NUMBER = '923015878068'; // WhatsApp number (country code, no +)

    function openWhatsAppModal() {
        document.getElementById('whatsapp-modal').style.display = 'block';
        document.getElementById('whatsapp-modal-overlay').style.display = 'block';
    }

    function closeWhatsAppModal() {
        document.getElementById('whatsapp-modal').style.display = 'none';
        document.getElementById('whatsapp-modal-overlay').style.display = 'none';
    }

    function sendWhatsApp(message) {
        var url = 'https://wa.me/' + WA_NUMBER + '?text=' + encodeURIComponent(message);
        window.open(url, '_blank', 'noopener,noreferrer');
        closeWhatsAppModal();
    }

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeWhatsAppModal();
    });
</script>

<!--================ SCRIPTS =================-->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/stellar.js"></script>
<script src="vendors/lightbox/simpleLightbox.min.js"></script>
<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
<script src="vendors/isotope/isotope.pkgd.min.js"></script>
<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="vendors/popup/jquery.magnific-popup.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="vendors/counter-up/jquery.counterup.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script src="js/mail-script.js"></script>
<script src="js/theme.js"></script>

</body>
</html>
