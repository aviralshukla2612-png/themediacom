@extends('layouts.app')

@section('seo_title', 'Our Campaigns | The Media Com')
@section('seo_description', 'Explore how we transform brand objectives into measurable on-ground success across India.')

@section('content')
<style>
    .campaigns-showcase {
        background: #000;
        padding: 100px 0;
        position: relative;
    }
    .showcase-gallery {
        margin-top: 3rem;
    }
    .featured-project {
        position: relative;
        height: 60vh;
        min-height: 500px;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 2rem;
    }
    .featured-project img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .featured-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0) 100%);
    }
    .featured-content {
        position: absolute;
        bottom: 10%;
        left: 5%;
        max-width: 600px;
        color: white;
    }
    .project-meta {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
        color: var(--accent-red);
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .featured-content h3 {
        font-size: clamp(2rem, 4vw, 3.5rem);
        margin-bottom: 1rem;
        font-weight: 800;
        line-height: 1.1;
    }
    .featured-content p {
        font-size: 1.1rem;
        color: #D1D5DB;
        margin-bottom: 2rem;
    }
    
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
    }
    .project-card {
        position: relative;
        height: 450px;
        border-radius: 16px;
        overflow: hidden;
        display: block;
        text-decoration: none;
    }
    .project-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .project-card:hover img {
        transform: scale(1.05);
    }
    .project-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.2) 60%, rgba(0,0,0,0) 100%);
    }
    .project-card-content {
        position: absolute;
        bottom: 2rem;
        left: 2rem;
        right: 2rem;
        color: white;
    }
    .card-meta {
        display: flex;
        gap: 1rem;
        color: var(--accent-red);
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }
    .project-card h4 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: white;
    }
    .card-desc {
        color: #9CA3AF;
        font-size: 0.95rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .filter-nav {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    .filter-btn {
        background: rgba(255,255,255,0.1);
        color: white;
        border: 1px solid rgba(255,255,255,0.2);
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s;
    }
    .filter-btn:hover, .filter-btn.active {
        background: var(--accent-red);
        border-color: var(--accent-red);
    }
</style>

<div style="padding-top: 80px; background: #000;">
    <section class="campaigns-showcase">
        <div class="container">
            <div class="text-left mb-8">
                <h2 class="section-title" style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 800; color: white; text-transform: uppercase;">Our Campaigns</h2>
                <p class="section-subtitle" style="color: #9CA3AF; font-size: 1.2rem; max-width: 600px;">Explore how we transform brand objectives into measurable on-ground success across India.</p>
            </div>

            <div class="showcase-gallery">
                @if($campaigns->count() > 0)
                    @php 
                        $featured = $campaigns->where('featured', 1)->first() ?? $campaigns->first(); 
                        $others = $campaigns->where('id', '!=', $featured->id);
                    @endphp

                    <!-- Large Featured Project -->
                    <div class="featured-project">
                        <img src="{{ str_starts_with($featured->image, 'http') ? $featured->image : asset($featured->image) }}" alt="{{ $featured->title }}">
                        <div class="featured-overlay"></div>
                        <div class="featured-content">
                            <div class="project-meta">
                                <span>{{ $featured->category }}</span>
                                <span>Featured</span>
                            </div>
                            <h3>{{ $featured->title }}</h3>
                            <p>{{ Str::limit($featured->problem, 150) }}</p>
                            <a href="{{ route('campaigns.show', $featured->id) }}" class="btn btn-primary" style="background: var(--accent-red); padding: 1rem 2.5rem; border-radius: 8px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">View Case Study</a>
                        </div>
                    </div>

                    <!-- Grid Projects -->
                    <div class="projects-grid mt-8">
                        @foreach($others as $camp)
                            <a href="{{ route('campaigns.show', $camp->id) }}" class="project-card">
                                <img src="{{ str_starts_with($camp->image, 'http') ? $camp->image : asset($camp->image) }}" alt="{{ $camp->title }}">
                                <div class="project-card-overlay"></div>
                                <div class="project-card-content">
                                    <div class="card-meta">
                                        <span>{{ $camp->category }}</span>
                                    </div>
                                    <h4>{{ $camp->title }}</h4>
                                    <p class="card-desc">{{ Str::limit($camp->problem, 100) }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p style="color: white;">No campaigns available at the moment.</p>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
