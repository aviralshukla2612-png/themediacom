@extends('layouts.app')
@section('content')

    <!-- Page Header -->
    <header class="page-header py-32" style="border-bottom: 1px solid rgba(255,255,255,0.05); position: relative; overflow: hidden;">
        <img src="{{ asset('<?= htmlspecialchars($corp_hero_bg) ?>') }}" class="img-cover" style="position: absolute; inset: 0; opacity: 0.15; z-index: 1;" alt="Corporate Banner">
        <div class="container" data-aos="fade-up" style="position: relative; z-index: 2;">
            <h1 class="page-title" style="font-weight: 400; letter-spacing: -2px;"><?= $corp_title ?></h1>
            <p class="section-subtitle mx-auto" style="color: #9CA3AF; font-weight: 300;"><?= htmlspecialchars($corp_subtitle) ?></p>
        </div>
    </header>


    <!-- Timeline Layout for Event Types -->
    <section class="py-20 overflow-hidden">
        <div class="container">
            <div class="timeline">
                <div class="timeline-item left" data-aos="fade-right">
                    <div class="timeline-content">
                        <h3>Conferences & Summits</h3>
                        <p>End-to-end management from venue sourcing to AV setup, ensuring a smooth flow of keynote sessions and panel discussions for industry leaders.</p>
                    </div>
                </div>
                <div class="timeline-item right" data-aos="fade-left">
                    <div class="timeline-content">
                        <h3>Product Launches</h3>
                        <p>High-impact reveals with stunning visual effects, media management, and VIP hospitality to create a lasting first impression.</p>
                    </div>
                </div>
                <div class="timeline-item left" data-aos="fade-right">
                    <div class="timeline-content">
                        <h3>Dealer & Partner Meets</h3>
                        <p>Motivational and reward-driven events focusing on networking, entertainment, and strategic alignments with your network.</p>
                    </div>
                </div>
                <div class="timeline-item right" data-aos="fade-left">
                    <div class="timeline-content">
                        <h3>Award Functions</h3>
                        <p>Gala dinners and recognition ceremonies executed with red-carpet luxury, sophisticated staging, and flawless production.</p>
                    </div>
                </div>
                <div class="timeline-item left" data-aos="fade-right">
                    <div class="timeline-content">
                        <h3>Employee Engagement</h3>
                        <p>Annual days, offsites, and team-building retreats designed to foster corporate culture and boost morale.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Showcase Gallery (Dark) -->
    <section class="py-20 overflow-hidden" style="border-top: 1px solid rgba(255,255,255,0.05);">
        <div class="container">
            <div class="event-showcase">
                <img src="{{ asset('<?= htmlspecialchars($corp_img_1) ?>') }}" alt="Conference" style="width: 100%; border-radius: 4px; filter: grayscale(20%);" data-aos="fade-up">
                <img src="{{ asset('<?= htmlspecialchars($corp_img_2) ?>') }}" alt="Summit" style="width: 100%; border-radius: 4px; filter: grayscale(20%);" data-aos="fade-up" data-aos-delay="100">
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('contact') }}" class="btn btn-outline" style="border-radius: 4px;">Inquire For Event</a>
            </div>
        </div>
    </section>



@endsection

