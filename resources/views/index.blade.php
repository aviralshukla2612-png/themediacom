@extends('layouts.app')
@section('content')


<!-- Clickable Highlighted Image Hero (No Crop, Starts After Navbar) -->
<section class="hero overflow-hidden"
    style="min-height: auto !important; height: auto !important; padding-top: 72px !important; background: var(--bg-dark); display: block !important; position: relative;">
    <div style="position: relative; width: 100%; display: block;">
        <picture>
            <source media="(max-width: 768px)" srcset="Hero_Banner_for_Mobile.png">
            <img src="{{ asset('assets/Demo Content.png') }}" alt="The Media Com Hero Banner"
                style="width: 100%; height: auto; display: block; opacity: 1 !important; filter: brightness(1.0) contrast(1.0);">
        </picture>

        <!-- Interactive Hotspots mapped to visual buttons in the image -->
        <!-- Explore Work Button -->
        <a href="{{ route('gallery') }}"
            style="position: absolute; left: 35.8%; top: 78.5%; width: 13.7%; height: 8.5%; z-index: 10; cursor: pointer;"
            title="Explore Work"></a>

        <!-- Contact Us Button -->
        <a href="{{ route('contact') }}"
            style="position: absolute; left: 50.6%; top: 78.5%; width: 13.5%; height: 8.5%; z-index: 10; cursor: pointer;"
            title="Contact Us"></a>

        <!-- Bottom Category Links -->
        <!-- RWA Activations -->
        <a href="{{ route('services') }}"
            style="position: absolute; left: 14%; top: 91%; width: 13%; height: 7%; z-index: 10; cursor: pointer;"
            title="RWA Activations"></a>

        <!-- BTL Campaigns -->
        <a href="{{ route('services') }}"
            style="position: absolute; left: 28%; top: 91%; width: 13%; height: 7%; z-index: 10; cursor: pointer;"
            title="BTL Campaigns"></a>

        <!-- Mall Promotions -->
        <a href="{{ route('services') }}"
            style="position: absolute; left: 42%; top: 91%; width: 13%; height: 7%; z-index: 10; cursor: pointer;"
            title="Mall Promotions"></a>

        <!-- Corporate Events -->
        <a href="{{ route('corporate') }}"
            style="position: absolute; left: 56%; top: 91%; width: 13%; height: 7%; z-index: 10; cursor: pointer;"
            title="Corporate Events"></a>

        <!-- Brand Engagement -->
        <a href="{{ route('services') }}"
            style="position: absolute; left: 72%; top: 91%; width: 13%; height: 7%; z-index: 10; cursor: pointer;"
            title="Brand Engagement"></a>
    </div>
</section>

<style>
    .navbar:not(.scrolled) {
        background: rgba(17, 24, 39, 0.6) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
    }

    .hero-banner-link:hover img {
        filter: brightness(1.05) contrast(1.02) !important;
    }
</style>

<script>
    const categoryContent = {
        'Ecommerce': {
            title: 'Ecommerce Activations',
            text: 'We power online-to-offline (O2O) consumer connections, package inserts, localized delivery hub promotions, and high-impact physical touchpoints for digital brands.'
        },
        'Retail': {
            title: 'Retail Experiences',
            text: 'Elevating in-store experiences with immersive visual merchandising, high-impact store launches, pop-up installations, and interactive digital displays that convert footfall into loyal customers.'
        },
        'Automobile': {
            title: 'Automobile Engagement',
            text: 'Driving brand engagement via premium mall car displays, experiential test drive campaigns, large-scale auto expo stalls, and dealership branding that highlight vehicle features and drive sales.'
        },
        'Real Estate': {
            title: 'Real Estate Marketing',
            text: 'Building trust and creating impact through strategic site activations, exclusive broker meets, VR-enabled property tours, and mega launch events that showcase properties in their best light.'
        },
        'Education': {
            title: 'Education Outreach',
            text: 'Inspiring minds and shaping futures with targeted campus contact programs, large-scale admission fairs, career counseling seminars, and youth outreach initiatives across major institutions.'
        },
        'Technology': {
            title: 'Technology Showcases',
            text: 'Innovating connections by executing IT park activations, flagship product launches, corporate roadshows, and interactive tech exhibitions that demonstrate cutting-edge solutions to B2B and B2C audiences.'
        }
    };

    function showTopic(card, topic) {
        // Remove active class from all cards
        document.querySelectorAll('.premium-card').forEach(c => {
            c.classList.remove('active-card');
        });

        // Add active class to clicked card
        card.classList.add('active-card');

        const data = categoryContent[topic];
        const rightSide = document.querySelector('.premium-right-side');

        const isRed = topic === 'Ecommerce';
        const color = isRed ? '#ff3b3b' : '#38bdf8';
        const bgRgba = isRed ? 'rgba(255,59,59,0.1)' : 'rgba(56,189,248,0.1)';
        const borderRgba = isRed ? 'rgba(255,59,59,0.3)' : 'rgba(56,189,248,0.3)';
        const shadowRgba = isRed ? 'rgba(255,59,59,0.5)' : 'rgba(56,189,248,0.5)';

        const iconHtml = card.querySelector('.card-icon-wrapper').innerHTML;

        // Fade out
        rightSide.style.opacity = 0;
        rightSide.style.transform = 'translateY(20px)';
        rightSide.style.transition = 'all 0.3s ease';

        setTimeout(() => {
            rightSide.innerHTML = `
                        <div class="topic-glass">
                            <div class="topic-header" style="display:flex; align-items:center; gap:15px; margin-bottom: 25px;">
                                <div class="topic-icon" style="width:50px; height:50px; border-radius:50%; display:flex; align-items:center; justify-content:center; background: ${bgRgba}; color: ${color}; border: 1px solid ${borderRgba};">
                                    ${iconHtml}
                                </div>
                                <h3 style="margin:0; font-size:1.6rem; font-weight:800; color:#fff;">${data.title}</h3>
                            </div>
                            <p style="font-size: 1.1rem; line-height: 1.7; color: #cbd5e1; margin-bottom: 30px;">
                                ${data.text}
                            </p>
                            <a href="#quote-wizard" style="display:inline-block; padding: 10px 25px; background: ${bgRgba}; color: ${color}; border: 1px solid ${color}; border-radius: 30px; font-weight:600; text-decoration:none; transition:all 0.3s;">Explore Services →</a>
                        </div>
                        <div class="blue-ring" style="border-color: ${borderRgba}; box-shadow: 0 0 20px ${shadowRgba};"></div>
                    `;
            // Fade in
            requestAnimationFrame(() => {
                rightSide.style.opacity = 1;
                rightSide.style.transform = 'translateY(0)';
            });
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const firstCard = document.querySelector('.premium-card');
        if (firstCard) {
            showTopic(firstCard, 'Ecommerce');
        }
    });
</script>

</section>

<!-- Infinite Marquee Section -->
<div class="marquee-section"
    style="background: var(--accent-red); color: white; padding: 1.5rem 0; overflow: hidden; position: relative; z-index: 20; border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.1);">
    <div class="gsap-marquee">
        <div class="marquee-inner"
            style="display: flex; gap: 4rem; white-space: nowrap; font-family: var(--font-heading); font-size: 1.5rem; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">
            <span>RWA ACTIVATIONS <span style="opacity: 0.5; margin: 0 1rem;">•</span></span>
            <span>BTL ACTIVITIES <span style="opacity: 0.5; margin: 0 1rem;">•</span></span>
            <span>MALL PROMOTIONS <span style="opacity: 0.5; margin: 0 1rem;">•</span></span>
            <span>CORPORATE EVENTS <span style="opacity: 0.5; margin: 0 1rem;">•</span></span>
            <!-- <span>BRAND ENGAGEMENT <span style="opacity: 0.5; margin: 0 1rem;">•</span></span> -->
            <span>SOCIETY PROMOTIONS <span style="opacity: 0.5; margin: 0 1rem;">•</span></span>
            <span>END-TO-END EXECUTION <span style="opacity: 0.5; margin: 0 1rem;">•</span></span>
        </div>
    </div>
</div>



<style>
    .hero-redesign {
        min-height: 100vh;
        display: flex;
        align-items: center;
        background: var(--bg-dark, #111827);
        position: relative;
        padding: 120px 0 60px;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .collage-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        position: relative;
    }

    .btn-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(220, 38, 38, 0.3);
    }

    .btn-outline-hover:hover {
        background: rgba(255, 255, 255, 0.1) !important;
        transform: translateY(-3px);
    }

    .collage-img-wrapper {
        border-radius: 16px;
        overflow: hidden;
        position: relative;
    }

    .collage-img-wrapper img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .collage-img-wrapper:hover img {
        transform: scale(1.08);
    }

    @media (max-width: 991px) {
        .hero-grid {
            grid-template-columns: 1fr;
            gap: 3rem;
        }

        .hero-content-left {
            text-align: center;
        }

        .hero-subtitle {
            margin: 0 auto 2.5rem;
        }

        .hero-buttons {
            justify-content: center;
        }

        .floating-stats {
            transform: scale(0.9);
        }
    }

    @media (max-width: 576px) {
        .collage-grid {
            grid-template-columns: 1fr;
        }

        .floating-stats {
            transform: scale(0.8);
        }
    }

    .topic-glass {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-top: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 20px;
        padding: 40px;
        position: relative;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 450px;
        transition: all 0.3s ease;
    }

    .active-card {
        border-color: rgba(255, 255, 255, 0.5) !important;
        box-shadow: 0 10px 30px -10px rgba(255, 255, 255, 0.3) !important;
        transform: scale(1.05) !important;
        z-index: 20;
    }

    @keyframes pulseBorder {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.1);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        }
    }

    .premium-card {
        animation: pulseBorder 3s infinite;
    }

    .premium-card:hover,
    .active-card {
        animation: none;
    }
</style>

<!-- Redesigned Hero Section -->
<section class="hero-redesign overflow-hidden">
    <!-- Noise Texture Overlay -->
    <div
        style="position: absolute; top:0; left:0; width:100%; height:100%; opacity: 0.03; pointer-events: none; background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E'); z-index: 1;">
    </div>

    <div class="container" style="position: relative; z-index: 10;">
        <div class="hero-grid">

            <!-- Left Side (Content) -->
            <div class="hero-content-left">
                <div class="gsap-fade-up"
                    style="display: inline-block; padding: 0.5rem 1.2rem; border: 1px solid rgba(255,255,255,0.15); border-radius: 50px; font-size: 0.85rem; color: #D1D5DB; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2rem; background: rgba(255,255,255,0.03); backdrop-filter: blur(10px);">
                    BTL Marketing • Brand Activations • Corporate Events
                </div>
                <h1 class="hero-title gsap-text-reveal"
                    style="font-size: clamp(1.5rem, 2.8vw, 3.2rem); color: white; margin-bottom: 1.5rem; font-weight: 800; line-height: 1.1; text-transform: none; white-space: normal;">
                    Creating Experiences That Connect Brands With People
                </h1>
                <p class="hero-subtitle gsap-fade-up"
                    style="color: #9CA3AF; font-size: clamp(1.1rem, 2vw, 1.25rem); margin-bottom: 2.5rem; font-weight: 400; line-height: 1.6; max-width: 90%;">
                    Impactful brand activations, corporate events, and retail campaigns across India.
                </p>
                <div class="hero-buttons gsap-fade-up"
                    style="display: flex; gap: 1rem; flex-wrap: wrap; animation-delay: 0.3s;">
                    <a href="{{ route('gallery') }}" class="btn btn-primary execution-btn btn-hover"
                        style="background: var(--accent-red); padding: 1.2rem 2.5rem !important; border-radius: 8px !important; font-weight: 700; transition: all 0.3s; display: inline-block;">View
                        Our Campaigns</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline execution-btn-outline btn-outline-hover"
                        style="border: 1px solid rgba(255,255,255,0.3) !important; color: white !important; padding: 1.2rem 2.5rem !important; border-radius: 8px !important; font-weight: 600; transition: all 0.3s; display: inline-block;">Get
                        Proposal</a>
                </div>
            </div>

            <!-- Right Side (Visual Collage) -->
            <div class="hero-visual-right" style="position: relative;">
                <div class="collage-grid">

                    <!-- Floating Stats -->
                    <div class="floating-stats" style="position: absolute; top: -20px; left: -20px; z-index: 20;">
                        <div class="gsap-fade-up"
                            style="background: rgba(17,24,39,0.85); backdrop-filter: blur(12px); padding: 1rem 1.5rem; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 20px 40px rgba(0,0,0,0.5); animation-delay: 0.5s;">
                            <div class="counter-val" data-target="500" data-plus="+"
                                style="font-size: 2.2rem; color: var(--accent-red); font-weight: 800; line-height: 1;">0
                            </div>
                            <div
                                style="color: white; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; margin-top: 0.3rem;">
                                Campaigns</div>
                        </div>
                    </div>
                    <div class="floating-stats" style="position: absolute; bottom: 30px; right: -20px; z-index: 20;">
                        <div class="gsap-fade-up"
                            style="background: rgba(17,24,39,0.85); backdrop-filter: blur(12px); padding: 1rem 1.5rem; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 20px 40px rgba(0,0,0,0.5); animation-delay: 0.7s;">
                            <div class="counter-val" data-target="50" data-plus="+"
                                style="font-size: 2.2rem; color: var(--accent-red); font-weight: 800; line-height: 1;">0
                            </div>
                            <div
                                style="color: white; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; margin-top: 0.3rem;">
                                Cities</div>
                        </div>
                    </div>
                    <div class="floating-stats"
                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 20;">
                        <div class="gsap-fade-up"
                            style="background: rgba(17,24,39,0.85); backdrop-filter: blur(12px); padding: 1rem 1.5rem; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 20px 40px rgba(0,0,0,0.5); animation-delay: 0.6s;">
                            <div class="counter-val" data-target="100" data-plus="+"
                                style="font-size: 2.2rem; color: var(--accent-red); font-weight: 800; line-height: 1;">0
                            </div>
                            <div
                                style="color: white; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; margin-top: 0.3rem;">
                                Clients</div>
                        </div>
                    </div>

                    <!-- Collage Images -->
                    <div class="collage-img-wrapper gsap-parallax" style="transform: translateY(20px);">
                        <img src="{{ asset('sec_banner.png') }}" alt="Event Stage">
                    </div>
                    <div class="collage-img-wrapper gsap-parallax" style="transform: translateY(-15px);">
                        <img src="{{ asset('sec_banner2.jpeg') }}" alt="Exhibition Stall">
                    </div>
                    <div class="collage-img-wrapper gsap-parallax" style="transform: translateY(0px);">
                        <img src="{{ asset('sec_banner3.jpeg') }}" alt="Activation">
                    </div>
                    <div class="collage-img-wrapper gsap-parallax" style="transform: translateY(-35px);">
                        <img src="{{ asset('sec_banner4.jpeg') }}" alt="Crowd Engagement">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Brand Logos Infinite Marquee Section (Left to Right) -->
<div class="marquee-section"
    style="background: #000000 !important; padding: 2.5rem 0; overflow: hidden; position: relative; z-index: 20; border-bottom: 1px solid rgba(255,255,255,0.05); border-top: 1px solid rgba(255,255,255,0.05);">
    <!-- Left & Right Fade Overlays for Seamless Scrolling -->
    <div
        style="position: absolute; top: 0; bottom: 0; left: 0; width: 200px; background: linear-gradient(to right, #000000 20%, transparent 100%); z-index: 5; pointer-events: none;">
    </div>
    <div
        style="position: absolute; top: 0; bottom: 0; right: 0; width: 200px; background: linear-gradient(to left, #000000 20%, transparent 100%); z-index: 5; pointer-events: none;">
    </div>

    <style>
        .marquee-inner img {
            flex-shrink: 0 !important;
        }
    </style>
    <div class="gsap-marquee" data-direction="ltr" style="background: #000000 !important;">
        <div class="marquee-inner"
            style="display: flex; gap: 4rem; align-items: center; white-space: nowrap; background: #000000 !important; padding: 0.5rem 0;">
            @if(isset($clients) && $clients->count() > 0)
                @foreach($clients as $client)
                    <img src="{{ Str::startsWith($client->image, 'client') ? asset($client->image) : asset('storage/'.$client->image) }}" alt="{{ $client->name }}"
                        style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;" title="{{ $client->name }}">
                @endforeach
                <!-- Duplicate for seamless loop if needed by marquee -->
                @foreach($clients as $client)
                    <img src="{{ Str::startsWith($client->image, 'client') ? asset($client->image) : asset('storage/'.$client->image) }}" alt="{{ $client->name }}"
                        style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;" title="{{ $client->name }}">
                @endforeach
            @else
                <img src="{{ asset('client logo/1 MG.jpg') }}" alt="1 MG"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Airtel Payment Bank (1).jpg') }}" alt="Airtel Payment Bank"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Alibaba Logo - Orage.png') }}" alt="Alibaba"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Apollo Pharmacy.jpg') }}" alt="Apollo Pharmacy"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Big Basket.jpg') }}" alt="Big Basket"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Coromondal King.jpg') }}" alt="Coromondal King"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/District by Zomato.jpeg') }}" alt="District by Zomato"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/First Choice.jpg') }}" alt="First Choice"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Food Panda.jpg') }}" alt="Food Panda"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Instamart_logo.jpg') }}" alt="Instamart"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Manipal-Fintech_New-Logo.png') }}" alt="Manipal Fintech"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Milk Basket.png') }}" alt="Milk Basket"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Mobikwik.jpg') }}" alt="Mobikwik"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Net Meds.jpg') }}" alt="Net Meds"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Ofo Bikes.jpg') }}" alt="Ofo Bikes"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Ola.jpg') }}" alt="Ola"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/PharmEasy.jpg') }}" alt="PharmEasy"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Shinhan Bank.jpg') }}" alt="Shinhan Bank"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Sodexo.jpg') }}" alt="Sodexo"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Swiggy.jpg') }}" alt="Swiggy"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Toyota-logo.png') }}" alt="Toyota"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Udaan.jpg') }}" alt="Udaan"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
                <img src="{{ asset('client logo/Zomato.jpg') }}" alt="Zomato"
                    style="height: 75px; width: auto; object-fit: contain; background: #ffffff; padding: 10px 24px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.4); transition: transform 0.3s ease;">
            @endif
        </div>
    </div>
</div>



<!-- Trust Building Section -->
<style>
    .trust-section {
        background: #090b10;
        padding: 100px 0 0 0;
        color: white;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .trust-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 4rem;
        align-items: center;
    }

    .trust-content h2 {
        font-size: clamp(2.5rem, 4vw, 3.5rem);
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 1rem;
        line-height: 1.1;
    }

    .trust-subtitle {
        color: #9CA3AF;
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }

    .trust-highlight {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--accent-red);
        margin-bottom: 0.5rem;
        font-family: var(--font-heading);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .brand-categories {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
        margin-bottom: 2rem;
    }

    .brand-category {
        background: rgba(255, 255, 255, 0.03);
        padding: 0.6rem 1.2rem;
        border-radius: 30px;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #D1D5DB;
        border: 1px solid rgba(255, 255, 255, 0.1);
        font-weight: 600;
    }

    .testimonial-box {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.01) 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 3rem;
        position: relative;
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    .testimonial-box::before {
        content: '"';
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 6rem;
        color: rgba(255, 255, 255, 0.1);
        font-family: serif;
        line-height: 1;
    }

    .testimonial-text {
        font-size: 1.2rem;
        line-height: 1.6;
        font-style: italic;
        color: #E5E7EB;
        margin-bottom: 2rem;
        position: relative;
        z-index: 2;
    }

    .testimonial-author {
        font-weight: 700;
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.95rem;
    }

    .testimonial-company {
        color: var(--accent-red);
        font-size: 0.85rem;
        font-weight: 600;
        margin-top: 0.2rem;
    }

    /* Marquee */
    .premium-marquee-container {
        width: 100%;
        overflow: hidden;
        margin: 5rem 0 0 0;
        position: relative;
    }

    .premium-marquee-container::before,
    .premium-marquee-container::after {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 150px;
        z-index: 2;
        pointer-events: none;
    }

    .premium-marquee-container::before {
        left: 0;
        background: linear-gradient(to right, #090b10, transparent);
    }

    .premium-marquee-container::after {
        right: 0;
        background: linear-gradient(to left, #090b10, transparent);
    }

    .premium-marquee {
        display: flex;
        width: max-content;
        animation: marquee 30s linear infinite;
    }

    .premium-marquee:hover {
        animation-play-state: paused;
    }

    .marquee-logo {
        padding: 0 4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 120px;
        cursor: pointer;
    }

    .marquee-logo img {
        max-height: 45px;
        max-width: 150px;
        filter: grayscale(100%) opacity(0.5);
        transition: all 0.4s ease;
    }

    .marquee-logo:hover img {
        filter: grayscale(0%) opacity(1);
        transform: scale(1.1);
    }

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    /* Client Success Strip */
    .success-strip {
        background: rgba(255, 255, 255, 0.02);
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding: 4rem 0;
        margin-top: 2rem;
    }

    .success-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        text-align: center;
    }

    .success-item {
        position: relative;
    }

    .success-item:not(:last-child)::after {
        content: '';
        position: absolute;
        right: -1rem;
        top: 15%;
        height: 70%;
        width: 1px;
        background: rgba(255, 255, 255, 0.1);
    }

    .success-num {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--accent-red);
        font-family: var(--font-heading);
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .success-label {
        font-size: 0.95rem;
        color: #9CA3AF;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .trust-grid {
            grid-template-columns: 1fr;
        }

        .success-grid {
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }

        .success-item:nth-child(2)::after {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .success-grid {
            grid-template-columns: 1fr;
        }

        .success-item::after {
            display: none !important;
        }
    }

    .topic-glass {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-top: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 20px;
        padding: 40px;
        position: relative;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 450px;
        transition: all 0.3s ease;
    }

    .active-card {
        border-color: rgba(255, 255, 255, 0.5) !important;
        box-shadow: 0 10px 30px -10px rgba(255, 255, 255, 0.3) !important;
        transform: scale(1.05) !important;
        z-index: 20;
    }

    @keyframes pulseBorder {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.1);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        }
    }

    .premium-card {
        animation: pulseBorder 3s infinite;
    }

    .premium-card:hover,
    .active-card {
        animation: none;
    }
</style>

<style>
    .premium-dark-section {
        background: #020617;
        background: radial-gradient(circle at top right, #050B1A 0%, #020617 100%);
        padding: 100px 0;
        position: relative;
        overflow: hidden;
        color: #fff;
    }

    .premium-dark-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');
        opacity: 0.03;
        pointer-events: none;
        z-index: 1;
    }

    .ambient-glow {
        position: absolute;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        filter: blur(100px);
        z-index: 0;
        pointer-events: none;
    }

    .glow-red {
        top: -100px;
        left: -100px;
        background: rgba(255, 59, 59, 0.1);
    }

    .glow-blue {
        bottom: 0;
        right: -100px;
        background: rgba(56, 189, 248, 0.1);
    }

    .premium-layout-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 50px;
        position: relative;
        z-index: 10;
    }

    .premium-left-side {
        flex: 1 1 60%;
    }

    .premium-right-side {
        flex: 1 1 35%;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        position: relative;
        padding-top: 160px;
    }

    @media (max-width: 1024px) {
        .premium-right-side {
            padding-top: 2rem;
        }
    }

    .pill-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 59, 59, 0.1);
        border: 1px solid rgba(255, 59, 59, 0.2);
        padding: 6px 16px;
        border-radius: 20px;
        color: #ff3b3b;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .premium-heading {
        font-size: clamp(2.5rem, 4vw, 3.5rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .premium-heading span {
        color: #ff3b3b;
        text-shadow: 0 0 20px rgba(255, 59, 59, 0.4);
    }

    .premium-subtext {
        color: #94a3b8;
        font-size: 1.1rem;
        margin-bottom: 40px;
    }

    .premium-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    .premium-card {
        background: rgba(15, 23, 42, 0.4);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 25px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        min-height: 220px;
    }

    .premium-card:hover {
        transform: translateY(-5px);
        border-color: rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
    }

    .premium-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, transparent 100%);
        pointer-events: none;
    }

    .card-red:hover {
        border-color: rgba(255, 59, 59, 0.5);
        box-shadow: 0 10px 30px -10px rgba(255, 59, 59, 0.2);
    }

    .card-blue:hover {
        border-color: rgba(56, 189, 248, 0.5);
        box-shadow: 0 10px 30px -10px rgba(56, 189, 248, 0.2);
    }

    .card-bg-number {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 4rem;
        font-weight: 800;
        color: rgba(255, 255, 255, 0.03);
        line-height: 1;
        z-index: 0;
    }

    .card-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: auto;
        position: relative;
        z-index: 1;
    }

    .card-red .card-icon-wrapper {
        background: rgba(255, 59, 59, 0.1);
        border: 1px solid rgba(255, 59, 59, 0.2);
        color: #ff3b3b;
    }

    .card-blue .card-icon-wrapper {
        background: rgba(56, 189, 248, 0.1);
        border: 1px solid rgba(56, 189, 248, 0.2);
        color: #38bdf8;
    }

    .card-content {
        position: relative;
        z-index: 1;
        margin-top: 30px;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: #fff;
    }

    .card-desc {
        font-size: 0.9rem;
        color: #94a3b8;
        line-height: 1.4;
    }

    .card-arrow {
        position: absolute;
        bottom: 25px;
        right: 25px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #94a3b8;
        transition: all 0.3s;
        z-index: 1;
    }

    .premium-card:hover .card-arrow {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .testimonial-glass {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-top: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 20px;
        padding: 40px;
        position: relative;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 400px;
    }

    .quote-icon {
        font-size: 4rem;
        color: #ff3b3b;
        line-height: 1;
        font-family: serif;
        margin-bottom: 20px;
        text-shadow: 0 0 15px rgba(255, 59, 59, 0.5);
    }

    .testimonial-glass p {
        font-size: 1.15rem;
        line-height: 1.6;
        font-style: italic;
        color: #cbd5e1;
        margin-bottom: 40px;
    }

    .testimonial-author-flex {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .author-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 2px solid rgba(255, 59, 59, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ff3b3b;
    }

    .author-info h4 {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .author-info span {
        color: #ff3b3b;
        font-size: 0.85rem;
    }

    .blue-ring {
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 110%;
        height: 20px;
        border-radius: 50%;
        box-shadow: 0 0 20px rgba(56, 189, 248, 0.5);
        border: 1px solid rgba(56, 189, 248, 0.3);
        z-index: -1;
    }

    .topic-glass {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-top: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 20px;
        padding: 40px;
        position: relative;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 450px;
        transition: all 0.3s ease;
    }

    .active-card {
        border-color: rgba(255, 255, 255, 0.5) !important;
        box-shadow: 0 10px 30px -10px rgba(255, 255, 255, 0.3) !important;
        transform: scale(1.05) !important;
        z-index: 20;
    }

    @keyframes pulseBorder {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.1);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        }
    }

    .premium-card {
        animation: pulseBorder 3s infinite;
    }

    .premium-card:hover,
    .active-card {
        animation: none;
    }
</style>

<section class="premium-dark-section">
    <div class="ambient-glow glow-red"></div>
    <div class="ambient-glow glow-blue"></div>

    <div class="container">
        <div class="premium-layout-grid">

            <div class="premium-left-side">
                <div class="pill-badge">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    100+ BRANDS SERVED
                </div>
                <h2 class="premium-heading">Trusted By<br>Leading <span>Brands</span></h2>
                <p class="premium-subtext">Across Activations, Events, Exhibitions & Retail Branding.</p>

                <div class="premium-cards-grid">
                    <div class="premium-card card-red gsap-fade-up" style="animation-delay: 0.1s;"
                        onclick="showTopic(this, 'Ecommerce')">
                        <div class="card-bg-number">01</div>
                        <div class="card-icon-wrapper">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                        </div>
                        <div class="card-content">
                            <div class="card-title">Ecommerce</div>
                            <div class="card-desc">Powering consumer connections</div>
                        </div>
                        <div class="card-arrow">→</div>
                    </div>

                    <div class="premium-card card-blue gsap-fade-up" style="animation-delay: 0.2s;"
                        onclick="showTopic(this, 'Retail')">
                        <div class="card-bg-number">02</div>
                        <div class="card-icon-wrapper">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                        </div>
                        <div class="card-content">
                            <div class="card-title">Retail</div>
                            <div class="card-desc">Elevating in-store experiences</div>
                        </div>
                        <div class="card-arrow">→</div>
                    </div>

                    <div class="premium-card card-blue gsap-fade-up" style="animation-delay: 0.3s;"
                        onclick="showTopic(this, 'Automobile')">
                        <div class="card-bg-number">03</div>
                        <div class="card-icon-wrapper">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                        </div>
                        <div class="card-content">
                            <div class="card-title">Automobile</div>
                            <div class="card-desc">Driving brand engagement</div>
                        </div>
                        <div class="card-arrow">→</div>
                    </div>

                    <div class="premium-card card-blue gsap-fade-up" style="animation-delay: 0.4s;"
                        onclick="showTopic(this, 'Real Estate')">
                        <div class="card-bg-number">04</div>
                        <div class="card-icon-wrapper">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 21h18"></path>
                                <path d="M9 8h1"></path>
                                <path d="M9 12h1"></path>
                                <path d="M9 16h1"></path>
                                <path d="M14 8h1"></path>
                                <path d="M14 12h1"></path>
                                <path d="M14 16h1"></path>
                                <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path>
                            </svg>
                        </div>
                        <div class="card-content">
                            <div class="card-title">Real Estate</div>
                            <div class="card-desc">Building trust. Creating impact.</div>
                        </div>
                        <div class="card-arrow">→</div>
                    </div>

                    <div class="premium-card card-blue gsap-fade-up" style="animation-delay: 0.5s;"
                        onclick="showTopic(this, 'Education')">
                        <div class="card-bg-number">05</div>
                        <div class="card-icon-wrapper">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                            </svg>
                        </div>
                        <div class="card-content">
                            <div class="card-title">Education</div>
                            <div class="card-desc">Inspiring minds. Shaping futures.</div>
                        </div>
                        <div class="card-arrow">→</div>
                    </div>

                    <div class="premium-card card-blue gsap-fade-up" style="animation-delay: 0.6s;"
                        onclick="showTopic(this, 'Technology')">
                        <div class="card-bg-number">06</div>
                        <div class="card-icon-wrapper">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                <rect x="9" y="9" width="6" height="6"></rect>
                                <line x1="9" y1="1" x2="9" y2="4"></line>
                                <line x1="15" y1="1" x2="15" y2="4"></line>
                                <line x1="9" y1="20" x2="9" y2="23"></line>
                                <line x1="15" y1="20" x2="15" y2="23"></line>
                                <line x1="20" y1="9" x2="23" y2="9"></line>
                                <line x1="20" y1="14" x2="23" y2="14"></line>
                                <line x1="1" y1="9" x2="4" y2="9"></line>
                                <line x1="1" y1="14" x2="4" y2="14"></line>
                            </svg>
                        </div>
                        <div class="card-content">
                            <div class="card-title">Technology</div>
                            <div class="card-desc">Innovating connections. Delivering tomorrow.</div>
                        </div>
                        <div class="card-arrow">→</div>
                    </div>
                </div>
            </div>

            <div class="premium-right-side">

                <div class="blue-ring"></div>
            </div>

        </div>
    </div>
</section>

<!-- Execution Capabilities Interactive Section -->
<style>
    .execution-section {
        background: var(--bg-dark, #111827);
        color: white;
        position: relative;
        padding: 120px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .execution-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: stretch;
        margin-top: 3rem;
    }

    .exec-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    .exec-item {
        padding: 1.5rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.3s ease;
        opacity: 0.5;
    }

    .exec-item:first-child {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .exec-item:hover,
    .exec-item.active {
        opacity: 1;
        padding-left: 1.5rem;
        border-bottom-color: var(--accent-red);
    }

    .exec-item h3 {
        margin: 0;
        font-size: 1.8rem;
        font-family: var(--font-heading);
        font-weight: 700;
    }

    .exec-item .arrow {
        font-size: 1.8rem;
        opacity: 0;
        transform: translateX(-15px);
        transition: all 0.3s ease;
        color: var(--accent-red);
    }

    .exec-item:hover .arrow,
    .exec-item.active .arrow {
        opacity: 1;
        transform: translateX(0);
    }

    .exec-visual {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        height: 100%;
        min-height: 600px;
    }

    .exec-image-container {
        position: absolute;
        inset: 0;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease, visibility 0.5s ease;
        z-index: 1;
    }

    .exec-image-container.active {
        opacity: 1;
        visibility: visible;
        z-index: 2;
    }

    .exec-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1.05);
        transition: transform 6s ease-out;
    }

    .exec-image-container.active img {
        transform: scale(1);
    }

    .exec-image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(17, 24, 39, 0.95) 0%, rgba(17, 24, 39, 0.2) 60%);
    }

    .exec-desc-box {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 3rem;
        transform: translateY(20px);
        transition: transform 0.5s ease;
    }

    .exec-image-container.active .exec-desc-box {
        transform: translateY(0);
        transition-delay: 0.2s;
    }

    .exec-desc-box h4 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        font-family: var(--font-heading);
        color: white;
        text-transform: uppercase;
    }

    .exec-desc-box p {
        font-size: 1.1rem;
        color: #D1D5DB;
        line-height: 1.6;
        margin: 0;
        max-width: 90%;
    }

    .exec-stats {
        display: flex;
        gap: 3rem;
        margin-top: 4rem;
    }

    .exec-stat-item {
        display: flex;
        flex-direction: column;
    }

    .exec-stat-num {
        font-size: 2.8rem;
        font-weight: 800;
        color: var(--accent-red);
        font-family: var(--font-heading);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .exec-stat-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #9CA3AF;
        font-weight: 600;
    }

    @media (max-width: 991px) {
        .execution-container {
            grid-template-columns: 1fr;
        }

        .exec-visual {
            min-height: 400px;
            order: -1;
        }

        .exec-item h3 {
            font-size: 1.5rem;
        }

        .exec-stats {
            flex-wrap: wrap;
            gap: 2rem;
        }
    }

    @media (max-width: 576px) {
        .exec-item h3 {
            font-size: 1.2rem;
        }

        .exec-item {
            padding: 1rem 0;
        }

        .exec-item:hover,
        .exec-item.active {
            padding-left: 0.5rem;
        }

        .exec-item .arrow {
            font-size: 1.4rem;
            transform: translateX(-5px);
        }

        .exec-item:hover .arrow,
        .exec-item.active .arrow {
            transform: translateX(0);
        }
    }

    .topic-glass {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-top: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 20px;
        padding: 40px;
        position: relative;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 450px;
        transition: all 0.3s ease;
    }

    .active-card {
        border-color: rgba(255, 255, 255, 0.5) !important;
        box-shadow: 0 10px 30px -10px rgba(255, 255, 255, 0.3) !important;
        transform: scale(1.05) !important;
        z-index: 20;
    }

    @keyframes pulseBorder {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.1);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        }
    }

    .premium-card {
        animation: pulseBorder 3s infinite;
    }

    .premium-card:hover,
    .active-card {
        animation: none;
    }
</style>

<section class="execution-section overflow-hidden">
    <!-- Noise Texture Overlay -->
    <div
        style="position: absolute; top:0; left:0; width:100%; height:100%; opacity: 0.02; pointer-events: none; background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E'); z-index: 1;">
    </div>

    <div class="container" style="position: relative; z-index: 5;">
        <div class="mb-10 gsap-fade-up">
            <h2 class="section-title gsap-text-reveal"
                style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 800; color: white; text-transform: uppercase; text-align: left; margin-bottom: 1rem;">
                What We Execute</h2>
            <p style="color: #9CA3AF; font-size: 1.2rem; max-width: 600px;">We deliver high-impact on-ground campaigns
                with precision. Scale your brand's physical presence anywhere in India.</p>
        </div>

        <div class="execution-container">
            <!-- Left Side: Interactive List -->
            <div class="exec-left gsap-fade-up">
                <ul class="exec-list" id="execList">
                    <li class="exec-item active" data-target="exec-1">
                        <h3>RWA Activations</h3>
                        <span class="arrow">→</span>
                    </li>
                    <li class="exec-item" data-target="exec-3">
                        <h3>BTL Activities</h3>
                        <span class="arrow">→</span>
                    </li>
                    <li class="exec-item" data-target="exec-5">
                        <h3>Corporate Events</h3>
                        <span class="arrow">→</span>
                    </li>
                    <li class="exec-item" data-target="exec-4">
                        <h3>Mall Promotions & Retail Activations</h3>
                        <span class="arrow">→</span>
                    </li>
                </ul>
            </div>

            <!-- Right Side: Dynamic Visual -->
            <div class="exec-visual gsap-fade-up" style="animation-delay: 0.2s;">

                <div class="exec-image-container active" id="exec-1">
                    <img src="{{ asset('new_gallary/RWA/RWA-%20The%20Media%20Com%20(4).jpeg') }}" alt="RWA Activations">
                    <div class="exec-image-overlay"></div>
                    <div class="exec-desc-box">
                        <h4>RWA Activations</h4>
                        <p>End-to-end residential society activations, community engagement and brand promotions.</p>
                    </div>
                </div>

                <div class="exec-image-container" id="exec-3">
                    <img src="{{ asset('new_gallary/BTL%20Activity/BTL%20-%20TMC%20(14).png') }}" alt="BTL Activities">
                    <div class="exec-image-overlay"></div>
                    <div class="exec-desc-box">
                        <h4>BTL Activities</h4>
                        <p>Creative on-ground marketing activities designed to increase customer engagement.</p>
                    </div>
                </div>

                <div class="exec-image-container" id="exec-5">
                    <img src="{{ asset('new_gallary/Corporate%20Events/Corporate%20Events%20-%20TMC%20(6).png') }}"
                        alt="Corporate Events">
                    <div class="exec-image-overlay"></div>
                    <div class="exec-desc-box">
                        <h4>Corporate Events</h4>
                        <p>Professional planning and execution of corporate activations and engagement programs.</p>
                    </div>
                </div>

                <div class="exec-image-container" id="exec-4">
                    <img src="{{ asset('new_gallary/Mall%20Promotions/Activity%20clicks%20(2)%20(1).png') }}"
                        alt="Mall Promotions & Retail Activations">
                    <div class="exec-image-overlay"></div>
                    <div class="exec-desc-box">
                        <h4>Mall Promotions & Retail Activations</h4>
                        <p>Interactive mall and retail activations to enhance customer experience and brand visibility.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const execItems = document.querySelectorAll('.exec-item');
        const execImages = document.querySelectorAll('.exec-image-container');

        execItems.forEach(item => {
            const activateTab = () => {
                execItems.forEach(i => i.classList.remove('active'));
                execImages.forEach(img => img.classList.remove('active'));

                item.classList.add('active');
                const targetId = item.getAttribute('data-target');
                document.getElementById(targetId).classList.add('active');
            };

            item.addEventListener('mouseenter', activateTab);
            item.addEventListener('click', activateTab);
        });
    });
</script>

<!-- Pan-India Execution Section -->
<style>
    .coverage-section {
        background: #090b10;
        padding: 100px 0;
        position: relative;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .city-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 4rem;
    }

    .city-card {
        position: relative;
        height: 380px;
        border-radius: 20px;
        overflow: hidden;
        background: #111827;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .city-card img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(80%) brightness(0.5);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .city-card:hover img {
        filter: grayscale(0%) brightness(0.8);
        transform: scale(1.08);
    }

    .city-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0) 70%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 2.5rem 2rem;
        transition: all 0.4s ease;
    }

    .city-name {
        font-size: 2.2rem;
        color: white;
        font-family: var(--font-heading);
        margin-bottom: 0.5rem;
        font-weight: 800;
    }

    .city-stats {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        margin-top: 0.5rem;
    }

    .city-card:hover .city-stats {
        opacity: 1;
        transform: translateY(0);
    }

    .city-stat-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        color: #E5E7EB;
        font-size: 1rem;
        font-weight: 600;
    }

    .city-stat-item i {
        color: var(--accent-red);
        font-size: 1.2rem;
    }

    .coverage-stats-strip {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 2rem;
        margin: 5rem 0;
        padding: 3rem 0;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .coverage-cta-block {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.03) 0%, rgba(255, 255, 255, 0.01) 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 5rem 3rem;
        text-align: center;
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
        .coverage-cta-block {
            padding: 3rem 1rem;
        }
    }

    .coverage-cta-block h3 {
        font-size: clamp(2rem, 3vw, 2.8rem);
        color: white;
        font-family: var(--font-heading);
        margin-bottom: 1.5rem;
        font-weight: 800;
    }

    .coverage-cta-block p {
        color: #9CA3AF;
        font-size: 1.2rem;
        max-width: 650px;
        margin: 0 auto 2.5rem auto;
        line-height: 1.6;
    }

    .btn-coverage {
        background: var(--accent-red);
        color: white;
        padding: 1.2rem 3.5rem;
        border-radius: 50px;
        font-weight: 800;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-coverage:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 30px rgba(220, 38, 38, 0.4);
        color: white;
    }

    .topic-glass {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-top: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 20px;
        padding: 40px;
        position: relative;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 450px;
        transition: all 0.3s ease;
    }

    .active-card {
        border-color: rgba(255, 255, 255, 0.5) !important;
        box-shadow: 0 10px 30px -10px rgba(255, 255, 255, 0.3) !important;
        transform: scale(1.05) !important;
        z-index: 20;
    }

    @keyframes pulseBorder {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.1);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        }
    }

    .premium-card {
        animation: pulseBorder 3s infinite;
    }

    .premium-card:hover,
    .active-card {
        animation: none;
    }
</style>

<section class="coverage-section">
    <div class="container">
        <div class="text-center gsap-fade-up">
            <h2 class="section-title"
                style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; color: white; text-transform: uppercase; line-height: 1.1; margin-bottom: 1rem;">
                Pan-India Activation Network</h2>
            <p class="section-subtitle mx-auto" style="color: #9CA3AF; font-size: 1.25rem; max-width: 700px;">Executing
                Brand Activations, Corporate Events and Retail Campaigns Across Major Cities in India.</p>
        </div>

        <!-- Four City Hub Cards -->
        <div class="city-cards-grid gsap-fade-up">

            <!-- Delhi NCR -->
            <div class="city-card">
                <img src="https://images.unsplash.com/photo-1587474260584-136574528ed5?auto=format&fit=crop&w=800&q=80"
                    alt="Delhi NCR">
                <div class="city-overlay">
                    <div
                        style="display:inline-flex;align-items:center;gap:6px;background:rgba(220,38,38,0.2);border:1px solid rgba(220,38,38,0.4);color:#f87171;font-size:0.7rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 12px;border-radius:50px;margin-bottom:0.75rem;width:fit-content;">
                        <span
                            style="width:5px;height:5px;border-radius:50%;background:#ef4444;display:inline-block;"></span>
                        Hub City
                    </div>
                    <div class="city-name">Delhi NCR</div>
                    <div class="city-stats">
                        <div class="city-stat-item"><i class="fas fa-rocket"></i> 95+ Campaigns Executed</div>
                        <div class="city-stat-item"><i class="fas fa-building"></i> 30+ Enterprise Clients</div>
                        <div class="city-stat-item"><i class="fas fa-map-marker-alt"></i> North India Operations</div>
                    </div>
                </div>
            </div>

            <!-- Jaipur -->
            <div class="city-card">
                <img src="https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?auto=format&fit=crop&w=800&q=80"
                    alt="Jaipur">
                <div class="city-overlay">
                    <div
                        style="display:inline-flex;align-items:center;gap:6px;background:rgba(220,38,38,0.2);border:1px solid rgba(220,38,38,0.4);color:#f87171;font-size:0.7rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 12px;border-radius:50px;margin-bottom:0.75rem;width:fit-content;">
                        <span
                            style="width:5px;height:5px;border-radius:50%;background:#ef4444;display:inline-block;"></span>
                        Hub City
                    </div>
                    <div class="city-name">Jaipur</div>
                    <div class="city-stats">
                        <div class="city-stat-item"><i class="fas fa-rocket"></i> 85+ Campaigns Executed</div>
                        <div class="city-stat-item"><i class="fas fa-building"></i> 25+ Enterprise Clients</div>
                        <div class="city-stat-item"><i class="fas fa-map-marker-alt"></i> Rajasthan Region Hub</div>
                    </div>
                </div>
            </div>

            <!-- Ahmedabad -->
            <div class="city-card">
                <img src="https://images.unsplash.com/photo-1529543544282-ea669407fca3?auto=format&fit=crop&w=800&q=80"
                    alt="Ahmedabad">
                <div class="city-overlay">
                    <div
                        style="display:inline-flex;align-items:center;gap:6px;background:rgba(220,38,38,0.2);border:1px solid rgba(220,38,38,0.4);color:#f87171;font-size:0.7rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 12px;border-radius:50px;margin-bottom:0.75rem;width:fit-content;">
                        <span
                            style="width:5px;height:5px;border-radius:50%;background:#ef4444;display:inline-block;"></span>
                        Head Office
                    </div>
                    <div class="city-name">Ahmedabad</div>
                    <div class="city-stats">
                        <div class="city-stat-item"><i class="fas fa-rocket"></i> 150+ Campaigns Executed</div>
                        <div class="city-stat-item"><i class="fas fa-building"></i> 50+ Enterprise Clients</div>
                        <div class="city-stat-item"><i class="fas fa-map-marker-alt"></i> Gujarat & West India HQ</div>
                    </div>
                </div>
            </div>

            <!-- Mumbai -->
            <div class="city-card">
                <img src="https://images.unsplash.com/photo-1570168007204-dfb528c6958f?auto=format&fit=crop&w=800&q=80"
                    alt="Mumbai">
                <div class="city-overlay">
                    <div
                        style="display:inline-flex;align-items:center;gap:6px;background:rgba(220,38,38,0.2);border:1px solid rgba(220,38,38,0.4);color:#f87171;font-size:0.7rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 12px;border-radius:50px;margin-bottom:0.75rem;width:fit-content;">
                        <span
                            style="width:5px;height:5px;border-radius:50%;background:#ef4444;display:inline-block;"></span>
                        Hub City
                    </div>
                    <div class="city-name">Mumbai</div>
                    <div class="city-stats">
                        <div class="city-stat-item"><i class="fas fa-rocket"></i> 120+ Campaigns Executed</div>
                        <div class="city-stat-item"><i class="fas fa-building"></i> 45+ Enterprise Clients</div>
                        <div class="city-stat-item"><i class="fas fa-map-marker-alt"></i> Maharashtra & West Coast</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Why Leading Brands Trust Us Section -->
<style>
    .why-us-section {
        background: #0f1218;
        padding: 120px 0;
        color: white;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        position: relative;
    }

    .why-us-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 4rem;
        align-items: start;
    }

    .why-us-sticky {
        position: sticky;
        top: 120px;
    }

    .why-us-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        font-family: var(--font-heading);
    }

    .why-us-proof-box {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.01) 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2rem;
        margin-top: 3rem;
        backdrop-filter: blur(10px);
    }

    .why-us-proof-item {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .why-us-proof-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .why-us-proof-item:first-child {
        padding-top: 0;
    }

    .proof-num {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--accent-red);
        font-family: var(--font-heading);
        min-width: 100px;
    }

    .proof-label {
        font-size: 1.1rem;
        color: #E5E7EB;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Value Blocks */
    .value-blocks-container {
        position: relative;
        padding-left: 2rem;
        border-left: 1px solid rgba(255, 255, 255, 0.1);
    }

    .value-block {
        position: relative;
        padding: 2.5rem;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        margin-bottom: 2rem;
        transition: all 0.4s ease;
        overflow: hidden;
        z-index: 1;
    }

    .value-block::before {
        content: '';
        position: absolute;
        left: -2rem;
        top: 50%;
        width: 2rem;
        height: 1px;
        background: var(--accent-red);
        z-index: 0;
        opacity: 0.5;
    }

    .value-block:hover {
        transform: translateX(10px);
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .value-block-num {
        position: absolute;
        right: 10px;
        bottom: -20px;
        font-size: 8rem;
        font-weight: 900;
        color: rgba(255, 255, 255, 0.03);
        font-family: var(--font-heading);
        line-height: 1;
        z-index: -1;
        transition: all 0.4s ease;
    }

    .value-block:hover .value-block-num {
        color: rgba(220, 38, 38, 0.08);
        transform: scale(1.1);
    }

    .value-block h4 {
        font-size: 1.8rem;
        color: white;
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .value-block p {
        color: #D1D5DB;
        font-size: 1.1rem;
        line-height: 1.6;
        margin: 0;
        max-width: 80%;
    }

    /* Process Timeline */
    .process-timeline {
        margin-top: 8rem;
        padding-top: 5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
    }

    .timeline-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        position: relative;
    }

    .timeline-container::before {
        content: '';
        position: absolute;
        top: 30px;
        left: 5%;
        right: 5%;
        height: 2px;
        background: rgba(255, 255, 255, 0.1);
        z-index: 0;
    }

    .timeline-step {
        position: relative;
        z-index: 1;
        text-align: center;
        width: 14%;
    }

    .timeline-dot {
        width: 20px;
        height: 20px;
        background: #0f1218;
        border: 3px solid var(--accent-red);
        border-radius: 50%;
        margin: 20px auto 1rem auto;
        transition: all 0.3s;
        position: relative;
        z-index: 2;
    }

    .timeline-step:hover .timeline-dot,
    .timeline-step.filled .timeline-dot {
        background: var(--accent-red);
        box-shadow: 0 0 15px var(--accent-red);
    }

    .timeline-label {
        color: white;
        font-size: 1.1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    @media (max-width: 991px) {
        .why-us-grid {
            grid-template-columns: 1fr;
        }

        .why-us-sticky {
            position: relative;
            top: 0;
        }

        .timeline-container {
            flex-direction: column;
            align-items: flex-start;
            padding-left: 2rem;
        }

        .timeline-container::before {
            top: 0;
            bottom: 0;
            left: 30px;
            width: 2px;
            height: auto;
        }

        .timeline-step {
            width: 100%;
            text-align: left;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .timeline-dot {
            margin: 0;
        }
    }

    .topic-glass {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-top: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 20px;
        padding: 40px;
        position: relative;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 450px;
        transition: all 0.3s ease;
    }

    .active-card {
        border-color: rgba(255, 255, 255, 0.5) !important;
        box-shadow: 0 10px 30px -10px rgba(255, 255, 255, 0.3) !important;
        transform: scale(1.05) !important;
        z-index: 20;
    }

    @keyframes pulseBorder {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.1);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        }
    }

    .premium-card {
        animation: pulseBorder 3s infinite;
    }

    .premium-card:hover,
    .active-card {
        animation: none;
    }
</style>

<section class="why-us-section">
    <div class="container">
        <div class="why-us-grid">

            <!-- Left Side: Sticky Title & Proof -->
            <div class="why-us-sticky gsap-fade-up">
                <h2 class="why-us-title">Why Leading Brands Trust Us</h2>
                <p style="color: #9CA3AF; font-size: 1.2rem; max-width: 400px; line-height: 1.6;">We don't just provide
                    services; we deliver flawless execution backed by real operational strength.</p>
            </div>

            <!-- Right Side: Value Blocks -->
            <div class="value-blocks-container">

                <div class="value-block gsap-fade-up">
                    <div class="value-block-num">01</div>
                    <h4>End-to-End Execution</h4>
                    <p>From planning and fabrication to on-ground execution and detailed reporting.</p>
                </div>

                <div class="value-block gsap-fade-up">
                    <div class="value-block-num">02</div>
                    <h4>Pan-India Reach</h4>
                    <p>Execute campaigns across multiple cities seamlessly through a single trusted partner.</p>
                </div>

                <div class="value-block gsap-fade-up">
                    <div class="value-block-num">03</div>
                    <h4>Dedicated Project Managers</h4>
                    <p>One dedicated point of contact ensuring consistency from brief to final execution.</p>
                </div>

                <div class="value-block gsap-fade-up">
                    <div class="value-block-num">04</div>
                    <h4>Fast Turnaround</h4>
                    <p>Quick deployment and agile logistics for urgent campaigns and sudden activations.</p>
                </div>

                <div class="value-block gsap-fade-up">
                    <div class="value-block-num">05</div>
                    <h4>Real-Time Reporting</h4>
                    <p>Comprehensive photo, video, and activity reports for complete campaign visibility.</p>
                </div>

                <div class="value-block gsap-fade-up">
                    <div class="value-block-num">06</div>
                    <h4>Experienced Execution Teams</h4>
                    <p>Highly trained field teams capable of handling complex activations of every scale.</p>
                </div>

            </div>
        </div>

        <!-- Process Timeline -->
        <div class="process-timeline gsap-fade-up">
            <div class="text-center mb-12">
                <h3 style="font-size: 2rem; color: white; font-family: var(--font-heading); text-transform: uppercase;">
                    Our Execution Process</h3>
            </div>
            <div class="timeline-container">

                <div class="timeline-step">
                    <div class="timeline-label">Brief</div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-label">Strategy</div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-label">Planning</div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-label">Production</div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-label">Execution</div>
                    <div class="timeline-dot"></div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-label">Reporting</div>
                    <div class="timeline-dot"></div>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- Zero-Friction Quote Wizard -->
<section id="quote-wizard" class="py-20 overflow-hidden">
    <div class="container">
        <div class="text-center gsap-fade-up">
            <h2 class="section-title"
                style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; color: white; text-transform: uppercase; line-height: 1.1; margin-bottom: 1rem;">
                Need a Campaign in Multiple Cities?</h2>
            <p class="section-subtitle mx-auto" style="color: #9CA3AF; font-size: 1.25rem; max-width: 700px;">Our robust
                on-ground teams and trusted execution partners allow us to deliver flawless activations simultaneously
                across Tier 1, Tier 2, and Tier 3 cities in India.</p>
        </div>

        <style>
            .inquiry-form-container {
                background: #ffffff;
                border-radius: 24px;
                padding: 3rem;
                max-width: 650px;
                width: 100%;
                box-sizing: border-box;
                margin: 3rem auto 0 auto;
                text-align: left;
                color: #111827;
            }

            .inquiry-form-container h4 {
                font-size: 2.2rem;
                font-weight: 800;
                margin-bottom: 0.5rem;
                font-family: var(--font-heading);
                color: #0f172a;
                text-align: center;
            }

            .inquiry-form-container p.form-sub {
                font-size: 1rem;
                color: #64748b;
                margin-bottom: 2.5rem;
                text-align: center;
            }

            .inquiry-form-group {
                margin-bottom: 1.5rem;
            }

            .inquiry-form-group label {
                display: block;
                font-weight: 500;
                font-size: 1rem;
                margin-bottom: 0.5rem;
                color: #0f172a;
            }

            .inquiry-form-group input,
            .inquiry-form-group select {
                width: 100%;
                box-sizing: border-box;
                padding: 1rem 1.2rem;
                border-radius: 10px;
                border: 1px solid #e2e8f0;
                background: #ffffff;
                font-size: 1rem;
                color: #0f172a;
                transition: all 0.3s;
            }

            .inquiry-form-group input:focus,
            .inquiry-form-group select:focus {
                outline: none;
                border-color: var(--accent-red);
                box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
            }

            .inquiry-btn {
                width: 100%;
                background: var(--accent-red);
                color: white;
                padding: 1.2rem;
                border-radius: 50px;
                font-weight: 700;
                font-size: 1.1rem;
                border: none;
                cursor: pointer;
                transition: transform 0.3s, background 0.3s, box-shadow 0.3s;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 10px;
                margin-top: 2rem;
                box-sizing: border-box;
            }

            .inquiry-btn:hover {
                transform: translateY(-2px);
                background: #dc2626;
            }

            @media (max-width: 600px) {
                .inquiry-form-container {
                    padding: 2rem 1.5rem;
                    margin-top: 1.5rem;
                    border-radius: 20px;
                }

                .inquiry-form-container h4 {
                    font-size: 1.8rem;
                }
            }
        </style>
        <div class="inquiry-form-container" data-aos="fade-up">
            <h4>Send an Inquiry</h4>
            <p class="form-sub">Fill out the simple form below and we'll get back to you.</p>
            <form action="{{ route('inquiry.store') }}" method="POST">
                        @csrf
                <div class="inquiry-form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Rahul Sharma" required>
                </div>
                <div class="inquiry-form-group">
                    <label>Company Name <span style="font-weight: normal; color: #94a3b8;">(Optional)</span></label>
                    <input type="text" name="company" placeholder="e.g. Acme Corp">
                </div>
                <div class="inquiry-form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" placeholder="+91 98765 43210" required>
                </div>
                <div class="inquiry-form-group">
                    <label>Type of Inquiry</label>
                    <select name="inquiry_type" required>
                        <option value="" disabled selected>Select Option...</option>
                        <option value="BTL Activation">BTL Activation</option>
                        <option value="Corporate Events">Corporate Events</option>
                        <option value="RWA">RWA</option>
                        <option value="Exhibition">Retail Branding</option>
                        <option value="Mall Promotion">Mall Promotion</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <button type="submit" class="inquiry-btn">Submit Inquiry <i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</section>

<!-- Vanta Birds Background Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@0.5.24/dist/vanta.birds.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof VANTA !== 'undefined') {
            VANTA.BIRDS({
                el: "#quote-wizard",
                mouseControls: true,
                touchControls: true,
                gyroControls: false,
                minHeight: 200.00,
                minWidth: 200.00,
                scale: 1.00,
                scaleMobile: 1.00,
                backgroundColor: 0x0,
                color2: 0x2424
            });
        }
    });
</script>


@endsection