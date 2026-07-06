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
                                 alt="CodeEdge Solutions"
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
                        by <strong style="color:#fff;">codeEdge Solutions</strong>
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
                        Designed &amp; developed by <a href="#">codeEdge Solutions</a> &mdash;
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
