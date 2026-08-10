@extends('layouts.app')

@section('seo_title', 'Our Services | The Media Com')
@section('seo_description', 'Discover our services including RWA activations, BTL activities, Mall Promotions, and Corporate Events.')

@section('content')

<!-- CSS for Premium Services Section -->
<style>
    .services-section {
        background: #090b10;
        background: radial-gradient(circle at top right, #0d121f 0%, #090b10 100%);
        color: #ffffff;
        position: relative;
        overflow: hidden;
        padding-top: 160px !important;
        /* Space for fixed navbar */
    }

    .services-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');
        opacity: 0.02;
        pointer-events: none;
        z-index: 1;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    @media (max-width: 1024px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .services-grid {
            grid-template-columns: 1fr;
        }
    }

    .service-card {
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .service-card:hover {
        transform: translateY(-8px);
        border-color: rgba(255, 59, 59, 0.3);
        box-shadow: 0 20px 40px -15px rgba(255, 59, 59, 0.15);
        background: rgba(255, 255, 255, 0.03);
    }

    .service-img-wrapper {
        position: relative;
        height: 300px;
        overflow: hidden;
        width: 100%;
        background: #111;
    }
    
    @media (max-width: 768px) {
        .service-img-wrapper {
            height: 220px;
        }
    }

    .service-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .service-card:hover .service-img {
        transform: scale(1.08);
    }

    .service-img-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(9, 11, 16, 1) 0%, rgba(9, 11, 16, 0.2) 100%);
        z-index: 1;
    }

    .service-icon-badge {
        position: absolute;
        bottom: 20px;
        right: 25px;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: var(--accent-red);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.3rem;
        z-index: 10;
        box-shadow: 0 8px 20px rgba(255, 59, 59, 0.4);
        border: 2px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s ease;
    }

    .service-card:hover .service-icon-badge {
        transform: scale(1.1) rotate(10deg);
        box-shadow: 0 8px 25px rgba(255, 59, 59, 0.6);
    }

    .service-content {
        padding: 40px 30px 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 2;
    }

    .service-title {
        font-size: 1.4rem;
        font-weight: 800;
        margin-bottom: 15px;
        color: #ffffff;
        line-height: 1.3;
    }

    .service-desc {
        color: #9CA3AF;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 25px;
        flex-grow: 1;
    }

    .service-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #ffffff;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        margin-top: auto;
    }

    .service-link i {
        font-size: 0.8rem;
        transition: transform 0.3s ease;
    }

    .service-card:hover .service-link {
        color: var(--accent-red);
    }

    .service-card:hover .service-link i {
        transform: translateX(5px);
    }

    /* Featured Service Card Styling */
    .service-card.featured-card {
        grid-column: span 2;
        border-color: rgba(255, 59, 59, 0.25);
        background: linear-gradient(135deg, rgba(255, 59, 59, 0.03) 0%, rgba(255, 255, 255, 0.01) 100%);
    }

    @media (max-width: 1024px) {
        .service-card.featured-card {
            grid-column: span 2;
        }
    }

    @media (max-width: 768px) {
        .service-card.featured-card {
            grid-column: span 1;
        }
    }

    .service-card.featured-card .service-img-wrapper {
        height: 340px;
    }

    .service-card.featured-card .service-img {
        object-position: center 20%;
    }

    @media (max-width: 768px) {
        .service-card.featured-card .service-img-wrapper {
            height: 220px;
        }
    }

    .featured-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: var(--accent-red);
        color: #ffffff;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(255, 59, 59, 0.3);
    }

    .service-card.featured-card:hover {
        border-color: rgba(255, 59, 59, 0.5);
        box-shadow: 0 25px 50px -15px rgba(255, 59, 59, 0.25);
    }
</style>

<!-- Services Grid Section -->
<section class="services-section py-20">
    <div class="ambient-glow glow-red"
        style="position: absolute; width: 500px; height: 500px; border-radius: 50%; filter: blur(130px); background: rgba(255, 59, 59, 0.06); top: 15%; left: -100px; pointer-events: none;">
    </div>
    <div class="ambient-glow glow-blue"
        style="position: absolute; width: 600px; height: 600px; border-radius: 50%; filter: blur(160px); background: rgba(56, 189, 248, 0.04); bottom: 15%; right: -150px; pointer-events: none;">
    </div>

    <div class="container" style="position: relative; z-index: 10;">
        <div class="text-center mb-16" data-aos="fade-up"
            style="max-width: 850px; margin: 0 auto 6rem; text-align: center;">
            <span class="pill-badge"
                style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255, 59, 59, 0.1); border: 1px solid rgba(255, 59, 59, 0.2); padding: 6px 16px; border-radius: 20px; color: #ff3b3b; font-size: 0.85rem; font-weight: 600; letter-spacing: 1.5px; margin-bottom: 20px; text-transform: uppercase;">Our
                Core Capabilities</span>
            <h1
                style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 800; text-transform: uppercase; margin-bottom: 20px; line-height: 1.2; color: #ffffff;">
                Bespoke <span style="color: var(--accent-red);">Activation</span> & Marketing Services</h1>
            <p
                style="color: #9CA3AF; font-size: clamp(1.1rem, 1.8vw, 1.35rem); line-height: 1.7; max-width: 750px; margin: 0 auto;">
                We create high-impact, experiential brand campaigns and corporate events with flawless on-ground
                execution across India.</p>
        </div>

        <div class="services-grid">
            @foreach($services as $service)
            <div id="{{ strtolower(str_replace(' ', '-', $service->title)) }}" class="service-card {{ $loop->first ? 'featured-card' : '' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                @if($loop->first)
                <span class="featured-badge"><i class="fa-solid fa-star" style="margin-right: 5px;"></i> Featured Service</span>
                @endif
                <div class="service-img-wrapper">
                    <!-- For simplicity, use a generic abstract placeholder if no image exists in DB, or try to map based on title -->
                    @php
                        $image = 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=800';
                        if(stripos($service->title, 'rwa') !== false) $image = asset('new_gallary/RWA/RWA- The Media Com (1).png');
                        if(stripos($service->title, 'btl') !== false) $image = asset('new_gallary/BTL Activity/BTL - TMC (1).png');
                        if(stripos($service->title, 'mall') !== false) $image = asset('new_gallary/Mall Promotions/Activity Clicks (10).png');
                    @endphp
                    <img src="{{ $image }}" alt="{{ $service->title }}" class="service-img">
                    <div class="service-img-overlay"></div>
                    <div class="service-icon-badge">
                        <i class="fa-solid {{ $service->icon }}"></i>
                    </div>
                </div>
                <div class="service-content">
                    <h3 class="service-title">{{ $service->title }}</h3>
                    <p class="service-desc">{{ $service->description }}</p>
                    @php
                        $cta = 'View Details';
                        if(stripos($service->title, 'rwa') !== false) $cta = 'Inquire About RWA';
                        elseif(stripos($service->title, 'btl') !== false || stripos($service->title, 'corporate') !== false) $cta = 'Get a Proposal';
                        elseif(stripos($service->title, 'other') !== false) $cta = 'Consult Our Team';
                    @endphp
                    <a href="{{ url(str_replace('contact.php', 'contact', $service->link)) }}" class="service-link">{{ $cta }} <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
