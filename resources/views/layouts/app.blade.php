<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('seo_title', $global_seo['seo_title'] ?? 'The Media Com | From Strategy to Street — WE EXECUTE')</title>
    <meta name="description" content="@yield('seo_description', $global_seo['seo_description'] ?? 'The Media Com is a leading brand activation and event execution company dedicated to creating impactful on-ground marketing experiences.')">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="@yield('seo_title', $global_seo['seo_title'] ?? 'The Media Com | From Strategy to Street — WE EXECUTE')">
    <meta property="og:description" content="@yield('seo_description', $global_seo['seo_description'] ?? 'The Media Com is a leading brand activation and event execution company dedicated to creating impactful on-ground marketing experiences.')">
    <meta property="og:image" content="@yield('seo_image', asset($global_seo['seo_image'] ?? 'logo_transparent.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <link rel="icon" type="image/png" href="{{ $global_seo['favicon_image'] ?? asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ $global_seo['favicon_image'] ?? asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    @vite(['resources/css/style.css', 'resources/css/execution-premium.css', 'resources/css/cursor.css'])
    
    @stack('styles')

    <style>
        /* Bulletproof Page Loader Styles */
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #111827;
            z-index: 999999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.6s ease, visibility 0.6s ease;
            margin: 0;
            padding: 0;
        }
        #page-loader.loaded {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        .loader-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            text-align: center;
        }
        .loader-logo {
            max-width: 280px;
            width: 100%;
            height: auto;
            animation: pulseLogo 2s infinite ease-in-out;
            display: block;
        }
        .loader-text {
            color: #ffffff;
            font-family: 'Poppins', sans-serif;
            font-size: 1.2rem;
            letter-spacing: 4px;
            font-weight: 500;
            text-transform: uppercase;
            margin-top: 10px;
        }
        .loader-text .dots span {
            animation: dotBlink 1.4s infinite both;
        }
        .loader-text .dots span:nth-child(2) { animation-delay: 0.2s; }
        .loader-text .dots span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes dotBlink {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }
        @keyframes pulseLogo {
            0% { transform: scale(0.95); opacity: 0.8; filter: drop-shadow(0 0 5px rgba(255, 59, 59, 0.3)); }
            50% { transform: scale(1.05); opacity: 1; filter: drop-shadow(0 0 20px rgba(255, 59, 59, 0.7)); }
            100% { transform: scale(0.95); opacity: 0.8; filter: drop-shadow(0 0 5px rgba(255, 59, 59, 0.3)); }
        }
    </style>
</head>
<body>
    <!-- Page Loader -->
    <div id="page-loader">
        <div class="loader-content">
            <img src="{{ asset('loadder.png') }}" alt="{{ $global_seo['site_name'] ?? 'The Media Com' }} Logo" class="loader-logo">
            <div class="loader-text">LOADING<span class="dots"><span>.</span><span>.</span><span>.</span></span></div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="logo" style="display: flex; align-items: center;"><img src="{{ $global_seo['logo_image'] ?? asset('logo_transparent.png') }}" alt="{{ $global_seo['site_name'] ?? 'The Media Com' }}" style="height: 80px; width: auto;"></a>
            
            <ul class="nav-links">
                <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>

                <li class="nav-item-dropdown">
                    <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services <i class="fas fa-chevron-down" style="font-size:0.8rem; margin-left:4px;"></i></a>
                    <div class="dropdown-menu" style="min-width: 220px; padding: 1.25rem; flex-direction: column; gap: 0.25rem;">
                        <div class="dropdown-col">
                            <a href="{{ route('services') }}#rwa">RWA</a>
                            <a href="{{ route('services') }}#btl">BTL</a>
                            <a href="{{ route('services') }}#mall">Mall Promotion</a>
                            <a href="{{ route('services') }}#corporate">Corporate Event</a>
                            <a href="{{ route('services') }}#other">Other</a>
                        </div>
                    </div>
                </li>
                <li><a href="{{ route('gallery') }}" class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a></li>
                <li><a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
                <li style="margin-top: 1rem;"><a href="{{ route('contact') }}" class="btn btn-primary" style="width: 100%; text-align: center;">Get Quote</a></li>
            </ul>
            <button class="mobile-menu-btn" aria-label="Toggle Menu">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer overflow-hidden">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-about">
                    <a href="{{ route('home') }}" class="logo"
                        style="display: inline-block; margin-bottom: 1.5rem; margin-left: -1.5rem;"><img
                            src="{{ $global_seo['logo_image'] ?? asset('logo_transparent.png') }}" alt="{{ $global_seo['site_name'] ?? 'The Media Com' }}"
                            style="width: 100%; max-width: 320px; height: auto;"></a>
                    <p>{{ $global_seo['footer_text'] ?? ($footer_text ?? 'The Media Com is a leading brand activation and event execution company dedicated to creating impactful on-ground marketing experiences. We specialize in RWA activations, BTL campaigns, mall promotions, corporate events, product sampling, and customer engagement programs that help brands connect with their audience in meaningful ways.') }}
                    </p>
                    <div class="social-links">
                        <a href="https://www.linkedin.com/company/themediacom" class="social-link"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.instagram.com/the.mediacom" class="social-link"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.facebook.com/themediakom" class="social-link"><i
                                class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="footer-title">Services</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('services') }}#rwa">RWA Activations</a></li>
                        <li><a href="{{ route('services') }}#btl">BTL Activities</a></li>
                        <li><a href="{{ route('services') }}#mall">Mall Promotions</a></li>
                        <li><a href="{{ route('services') }}#corporate">Corporate Events</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="footer-title">Company</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('gallery') }}">Portfolio</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="footer-title">Contact</h4>
                    @php
                        $f_address  = $contact_address ?? 'Ahmedabad';
                        $f_phone    = $contact_phone ?? '+91 88664 46225';
                        $f_email    = trim($contact_email ?? 'info@themediacom.com');
                        $f_phoneDig = preg_replace('/[^0-9+]/', '', $f_phone);
                        $f_mapsUrl  = 'https://maps.google.com/?q=' . urlencode($f_address);
                    @endphp
                    <style>
                        .footer-contact-link {
                            display: flex;
                            align-items: flex-start;
                            gap: 0.75rem;
                            text-decoration: none;
                            color: inherit;
                            padding: 6px 8px;
                            border-radius: 8px;
                            margin-bottom: 6px;
                            transition: background 0.2s ease, color 0.2s ease, transform 0.18s ease;
                        }
                        .footer-contact-link:hover {
                            background: rgba(220, 38, 38, 0.1);
                            color: #f87171;
                            transform: translateX(4px);
                        }
                        .footer-contact-link i {
                            color: var(--accent-red);
                            min-width: 16px;
                            margin-top: 2px;
                        }
                    </style>
                    <ul class="footer-contact" style="list-style: none; padding: 0; margin: 0;">
                        <li>
                            <a href="{{ $f_mapsUrl }}" target="_blank" rel="noopener noreferrer"
                               class="footer-contact-link" title="Open in Google Maps">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $f_address }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="tel:{{ $f_phoneDig }}"
                               class="footer-contact-link" title="Call us">
                                <i class="fas fa-phone-alt"></i>
                                <span>{{ $f_phone }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:{{ $f_email }}"
                               class="footer-contact-link" title="Send us an email">
                                <i class="fas fa-envelope"></i>
                                <span>{{ $f_email }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} The Media Com. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Floating Action Buttons -->
    <div class="floating-actions"
        style="position: fixed; bottom: 30px; right: 30px; display: flex; gap: 1rem; align-items: center; z-index: 100;">
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact_phone ?? '918866446225') }}"
            class="whatsapp-float-inline" target="_blank"
            style="width: 60px; height: 60px; background-color: #25d366; color: white; border-radius: 50px; display: flex; align-items: center; justify-content: center; font-size: 30px; box-shadow: 2px 2px 10px rgba(0,0,0,0.3); transition: transform 0.3s ease;">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    
    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.34/dist/lenis.min.js"></script>
    
    @vite(['resources/js/main.js', 'resources/js/motion.js'])
    
    <script>
        window.addEventListener('load', function () {
            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.classList.add('loaded');
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 600); // Wait for the transition to finish before hiding
            }
        });

        // Mobile Dropdown Fix
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownLink = document.querySelector('.nav-item-dropdown > a');
            if (dropdownLink) {
                dropdownLink.addEventListener('click', function (e) {
                    if (window.innerWidth <= 1024) {
                        if (e.target.tagName.toLowerCase() === 'i' || e.target.closest('i')) {
                            e.preventDefault();
                            e.stopPropagation();
                            const dropdownMenu = this.nextElementSibling;
                            if (dropdownMenu.style.display === 'flex') {
                                dropdownMenu.style.display = 'none';
                            } else {
                                dropdownMenu.style.display = 'flex';
                            }
                        }
                    }
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
