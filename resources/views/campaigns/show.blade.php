@extends('layouts.app')

@section('seo_title', $campaign->title . ' | The Media Com')
@section('seo_description', \Illuminate\Support\Str::limit(strip_tags($campaign->problem), 150))
@section('seo_image', str_starts_with($campaign->image, 'http') ? $campaign->image : asset($campaign->image))

@section('content')
<style>
    .case-hero {
        position: relative;
        padding: 150px 0 100px;
        background: #090b10;
        color: white;
        overflow: hidden;
    }
    .case-hero-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.3;
        filter: blur(5px);
    }
    .case-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, #000 0%, rgba(0,0,0,0.4) 100%);
    }
    .case-hero-content {
        position: relative;
        z-index: 10;
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }
    .case-meta {
        color: var(--accent-red);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 1rem;
        display: block;
    }
    .case-title {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1.5rem;
    }
    
    .case-content-section {
        padding: 80px 0;
        background: white;
        color: #1f2937;
    }
    .case-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: start;
    }
    @media (max-width: 768px) {
        .case-grid { grid-template-columns: 1fr; }
    }
    
    .case-text-block h3 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 1rem;
        color: #111827;
        position: relative;
        padding-bottom: 1rem;
    }
    .case-text-block h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--accent-red);
    }
    .case-text-block p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #4B5563;
        margin-bottom: 2rem;
    }
    
    .case-image-main {
        width: 100%;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .metrics-bar {
        background: #111827;
        color: white;
        padding: 4rem 0;
    }
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        text-align: center;
    }
    .metric-item .value {
        font-size: 3.5rem;
        font-weight: 900;
        color: var(--accent-red);
        margin-bottom: 0.5rem;
        line-height: 1;
    }
    .metric-item .label {
        font-size: 1.1rem;
        color: #D1D5DB;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>

<!-- Hero Section -->
<section class="case-hero">
    <img src="{{ str_starts_with($campaign->image, 'http') ? $campaign->image : asset($campaign->image) }}" class="case-hero-bg" alt="{{ $campaign->title }}">
    <div class="case-hero-overlay"></div>
    <div class="container case-hero-content">
        <span class="case-meta">{{ $campaign->category }}</span>
        <h1 class="case-title">{{ $campaign->title }}</h1>
    </div>
</section>

<!-- Content Section -->
<section class="case-content-section">
    <div class="container">
        <div class="case-grid">
            <div>
                <img src="{{ str_starts_with($campaign->image, 'http') ? $campaign->image : asset($campaign->image) }}" class="case-image-main" alt="{{ $campaign->title }}">
            </div>
            <div>
                @if($campaign->problem)
                <div class="case-text-block">
                    <h3>The Challenge</h3>
                    <p>{{ nl2br(e($campaign->problem)) }}</p>
                </div>
                @endif
                
                @if($campaign->solution)
                <div class="case-text-block" style="margin-top: 3rem;">
                    <h3>Our Solution</h3>
                    <p>{{ nl2br(e($campaign->solution)) }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Metrics Section -->
@if($campaign->metrics_1_val || $campaign->metrics_2_val)
<section class="metrics-bar">
    <div class="container">
        <div class="metrics-grid">
            @if($campaign->metrics_1_val)
            <div class="metric-item">
                <div class="value">{{ $campaign->metrics_1_val }}</div>
                <div class="label">{{ $campaign->metrics_1_label }}</div>
            </div>
            @endif
            
            @if($campaign->metrics_2_val)
            <div class="metric-item">
                <div class="value">{{ $campaign->metrics_2_val }}</div>
                <div class="label">{{ $campaign->metrics_2_label }}</div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<div class="text-center" style="padding: 4rem 0; background: #f3f4f6;">
    <a href="{{ route('campaigns.index') }}" class="btn btn-primary" style="background: var(--accent-red); padding: 1rem 2rem; border-radius: 8px; font-weight: 700;"><i class="fas fa-arrow-left"></i> Back to Campaigns</a>
</div>

@endsection
