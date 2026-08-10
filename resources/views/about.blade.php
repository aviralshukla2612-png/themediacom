@extends('layouts.app')
@section('content')


<!-- Premium Styles for About Us Page -->
<style>
    :root {
        --card-glow-red: rgba(255, 59, 59, 0.15);
        --card-glow-blue: rgba(56, 189, 248, 0.1);
    }

    /* About Header */
    .about-header {
        position: relative;
        padding-top: 180px;
        padding-bottom: 120px;
        background: #090b10;
        background: radial-gradient(circle at top right, #111827 0%, #090b10 100%);
        color: white;
        overflow: hidden;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .about-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');
        opacity: 0.02;
        pointer-events: none;
        z-index: 1;
    }

    .about-hero-bg {
        position: absolute;
        inset: 0;
        opacity: 0.15;
        z-index: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .about-header .container {
        position: relative;
        z-index: 2;
    }

    .pill-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 59, 59, 0.1);
        border: 1px solid rgba(255, 59, 59, 0.2);
        padding: 6px 18px;
        border-radius: 50px;
        color: var(--accent-red);
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 1.5px;
        margin-bottom: 24px;
        text-transform: uppercase;
    }

    /* Narrative Section */
    .narrative-section {
        background-color: var(--bg-light);
        color: var(--text-main);
    }

    .narrative-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 60px;
        align-items: center;
    }

    @media (max-width: 1024px) {
        .narrative-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
    }

    .narrative-text p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: var(--text-muted);
        margin-bottom: 24px;
    }

    .narrative-text p.lead {
        font-size: 1.25rem;
        color: var(--text-main);
        font-weight: 500;
    }

    .narrative-visual {
        position: relative;
    }

    .narrative-image-card {
        background: white;
        padding: 12px;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: var(--transition);
    }

    .narrative-image-card img {
        border-radius: calc(var(--radius-lg) - 8px);
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    /* Philosophy Banner (Dark) */
    .philosophy-banner {
        background: #090b10;
        background: radial-gradient(circle at center, #111827 0%, #05070a 100%);
        color: white;
        position: relative;
        overflow: hidden;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .philosophy-card {
        max-width: 900px;
        margin: 0 auto;
        padding: 60px;
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: var(--radius-lg);
        text-align: center;
        position: relative;
        z-index: 2;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
        .philosophy-card {
            padding: 30px 20px;
        }
    }

    .philosophy-card blockquote {
        font-size: clamp(1.25rem, 3vw, 1.85rem);
        font-weight: 600;
        line-height: 1.5;
        position: relative;
        margin-bottom: 20px;
        color: #f3f4f6;
    }

    .philosophy-card .quote-icon {
        font-size: 2.5rem;
        color: var(--accent-red);
        opacity: 0.3;
        margin-bottom: 15px;
    }

    /* Capabilities Section */
    .capabilities-section {
        background-color: white;
    }

    .capabilities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-top: 48px;
    }

    .capability-card {
        background: var(--bg-light);
        border: 1px solid #e2e8f0;
        border-radius: var(--radius-md);
        padding: 35px 25px;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .capability-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 4px; height: 0;
        background: var(--accent-red);
        transition: var(--transition);
    }

    .capability-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
        border-color: #cbd5e1;
    }

    .capability-card:hover::before {
        height: 100%;
    }

    .capability-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255, 59, 59, 0.08);
        color: var(--accent-red);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 24px;
        transition: var(--transition);
    }

    .capability-card:hover .capability-icon {
        background: var(--accent-red);
        color: white;
        transform: scale(1.1);
    }

    .capability-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 12px;
        color: var(--text-main);
    }

    .capability-desc {
        color: var(--text-muted);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Why Choose Us Section */
    .why-section {
        background: #090b10;
        background: radial-gradient(circle at bottom left, #0d121f 0%, #090b10 100%);
        color: white;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-top: 48px;
    }

    @media (max-width: 1024px) {
        .why-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .why-grid {
            grid-template-columns: 1fr;
        }
    }

    .why-card {
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        padding: 40px 30px;
        transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        display: flex;
        flex-direction: column;
    }

    .why-card:hover {
        transform: translateY(-8px);
        border-color: rgba(255, 59, 59, 0.3);
        background: rgba(255, 255, 255, 0.03);
        box-shadow: 0 20px 40px -20px rgba(255, 59, 59, 0.3);
    }

    .why-icon-badge {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(255, 59, 59, 0.1) 0%, rgba(255, 59, 59, 0.2) 100%);
        border: 1px solid rgba(255, 59, 59, 0.2);
        color: var(--accent-red);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 24px;
    }

    .why-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 12px;
        color: white;
    }

    .why-card-desc {
        color: #9CA3AF;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* CTA Section */
    .about-cta {
        background-color: var(--accent-red);
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .about-cta-content {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .about-cta-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .about-cta-desc {
        font-size: clamp(1rem, 2vw, 1.2rem);
        margin-bottom: 35px;
        opacity: 0.9;
    }
</style>

<!-- About Page Header -->
<header class="about-header">
    <img src="{{ asset('<?= htmlspecialchars($about_hero_bg) ?>') }}" class="about-hero-bg" alt="Event Execution Banner">
    <div class="container" data-aos="fade-up">

        <h1 class="section-title" style="color: white;"><?= htmlspecialchars($about_title) ?></h1>
        <p class="section-subtitle" style="color: #cbd5e1; margin-left: 0;"><?= htmlspecialchars($about_subtitle) ?></p>
    </div>
</header>

<!-- Narrative Section -->
<section class="narrative-section py-20">
    <div class="container">
        <div class="narrative-grid">
            <div class="narrative-text" data-aos="fade-right">
                <div class="prose prose-invert max-w-none text-lg">
                    {!! nl2br(htmlspecialchars($about_paragraph)) !!}
                </div>
            </div>
            <div class="narrative-visual" data-aos="fade-left">
                <div class="narrative-image-card">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=800&q=80" alt="Brand Activation Execution">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Philosophy Banner (Dark & Cinematic) -->
<section class="philosophy-banner py-20">
    <div class="container">
        <div class="philosophy-card" data-aos="zoom-in">
            <div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
            <blockquote>
                "At The Media Com, we believe that successful marketing is not just about visibility — it is about creating memorable experiences that leave a lasting impression."
            </blockquote>
            <p style="color: var(--accent-red); font-weight: 600; text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem;">Our Core Driving Philosophy</p>
        </div>
    </div>
</section>

<!-- What We Do Section -->
<section class="capabilities-section py-20">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <span class="pill-tag">Our Scope</span>
            <h2 class="section-title" style="color: var(--accent-red) !important;">What We Do</h2>
            <p class="section-subtitle mx-auto" style="color: #1A202C !important; opacity: 1 !important; font-weight: 600;">Diverse engagement solutions designed to amplify brand presence on the ground.</p>
        </div>

        <div class="capabilities-grid">
            <!-- 1. RWA Activations -->
            <div class="capability-card" data-aos="fade-up" data-aos-delay="100">
                <div class="capability-icon"><i class="fa-solid fa-house-chimney-user"></i></div>
                <h3 class="capability-title">RWA Activations & Community Engagement</h3>
                <p class="capability-desc">Engage residents directly inside premium societies through custom kiosks, interactive stalls, and community-driven events.</p>
            </div>

            <!-- 2. Product Sampling -->
            <div class="capability-card" data-aos="fade-up" data-aos-delay="200">
                <div class="capability-icon"><i class="fa-solid fa-gift"></i></div>
                <h3 class="capability-title">Product Sampling Campaigns</h3>
                <p class="capability-desc">Drive immediate trial, user feedback, and conversions with systematic door-to-door or centralized sampling.</p>
            </div>

            <!-- 3. BTL Marketing -->
            <div class="capability-card" data-aos="fade-up" data-aos-delay="300">
                <div class="capability-icon"><i class="fa-solid fa-bullhorn"></i></div>
                <h3 class="capability-title">BTL Marketing Activities</h3>
                <p class="capability-desc">High-impact below-the-line campaigns, including roadshows, canter operations, and street marketing.</p>
            </div>

            <!-- 4. Mall Promotions -->
            <div class="capability-card" data-aos="fade-up" data-aos-delay="400">
                <div class="capability-icon"><i class="fa-solid fa-bag-shopping"></i></div>
                <h3 class="capability-title">Mall Promotions & Retail Activations</h3>
                <p class="capability-desc">Capture footfall in high-end shopping centers with eye-catching displays and interactive experiential setups.</p>
            </div>

            <!-- 5. Corporate Events -->
            <div class="capability-card" data-aos="fade-up" data-aos-delay="500">
                <div class="capability-icon"><i class="fa-solid fa-building"></i></div>
                <h3 class="capability-title">Corporate Events & Brand Programs</h3>
                <p class="capability-desc">Seamless execution of corporate conferences, dealer meets, launch shows, and employee engagement sessions.</p>
            </div>

            <!-- 6. Brand Promotions -->
            <div class="capability-card" data-aos="fade-up" data-aos-delay="600">
                <div class="capability-icon"><i class="fa-solid fa-lightbulb"></i></div>
                <h3 class="capability-title">Brand Promotions & Experiential Marketing</h3>
                <p class="capability-desc">Immersive marketing experiences that engage all senses and build emotional connections with consumers.</p>
            </div>

            <!-- 7. Event Planning -->
            <div class="capability-card" data-aos="fade-up" data-aos-delay="700">
                <div class="capability-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <h3 class="capability-title">Event Planning & Execution</h3>
                <p class="capability-desc">Flawless end-to-end planning, logistics management, fabrication, staging, and on-ground operational support.</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section (Dark & Futuristic) -->
<section class="why-section py-20">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <span class="pill-tag" style="background: rgba(255, 59, 59, 0.1); border-color: rgba(255, 59, 59, 0.2);">Our Edge</span>
            <h2 class="section-title" style="color: white;">Why Choose Us</h2>
            <p class="section-subtitle mx-auto" style="color: #9CA3AF;">What makes The Media Com the preferred execution partner for leading brands.</p>
        </div>

        <div class="why-grid">
            <!-- 1 -->
            <div class="why-card" data-aos="fade-up" data-aos-delay="100">
                <div class="why-icon-badge"><i class="fa-solid fa-people-group"></i></div>
                <h3 class="why-card-title">Experienced Execution Team</h3>
                <p class="why-card-desc">An expert on-ground workforce trained to handle event complexities and consumer interactions professionally.</p>
            </div>

            <!-- 2 -->
            <div class="why-card" data-aos="fade-up" data-aos-delay="200">
                <div class="why-icon-badge"><i class="fa-solid fa-layer-group"></i></div>
                <h3 class="why-card-title">End-to-End Management</h3>
                <p class="why-card-desc">From concept designing and permissions to fabrication, execution, and reporting – we handle it all.</p>
            </div>

            <!-- 3 -->
            <div class="why-card" data-aos="fade-up" data-aos-delay="300">
                <div class="why-icon-badge"><i class="fa-solid fa-sliders"></i></div>
                <h3 class="why-card-title">Customized Solutions</h3>
                <p class="why-card-desc">Campaign designs and setups tailored to meet your brand’s specific guidelines, goals, and target demographic.</p>
            </div>

            <!-- 4 -->
            <div class="why-card" data-aos="fade-up" data-aos-delay="400">
                <div class="why-icon-badge"><i class="fa-solid fa-network-wired"></i></div>
                <h3 class="why-card-title">Strong Operational Network</h3>
                <p class="why-card-desc">A deep, scalable logistical network enabling multi-city and cross-regional activations simultaneously.</p>
            </div>

            <!-- 5 -->
            <div class="why-card" data-aos="fade-up" data-aos-delay="500">
                <div class="why-icon-badge"><i class="fa-solid fa-chart-line"></i></div>
                <h3 class="why-card-title">Focus on Quality & Results</h3>
                <p class="why-card-desc">We structure campaigns with clear, measurable deliverables, guaranteeing visibility and user engagement.</p>
            </div>

            <!-- 6 -->
            <div class="why-card" data-aos="fade-up" data-aos-delay="600">
                <div class="why-icon-badge"><i class="fa-solid fa-certificate"></i></div>
                <h3 class="why-card-title">Proven Campaign Expertise</h3>
                <p class="why-card-desc">A successful track record of executing diverse campaign formats across numerous industries with excellent results.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="about-cta py-20">
    <div class="container">
        <div class="about-cta-content" data-aos="zoom-in">
            <h2 class="about-cta-title">Turn Ideas Into Memorable Experiences</h2>
            <p class="about-cta-desc">We are committed to helping brands build stronger connections with their customers through impactful activation and engagement solutions.</p>
            <a href="{{ route('contact') }}" class="btn btn-dark btn-lg" style="box-shadow: 0 10px 30px rgba(0,0,0,0.3); border-radius: 50px; padding: 1rem 2.5rem;">Partner With Us <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i></a>
        </div>
    </div>
</section>

<!-- Required Scripts for Premium UI (GSAP / Lenis / AOS) -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@studio-freight/lenis@1.0.29/dist/lenis.min.js"></script>


@endsection

