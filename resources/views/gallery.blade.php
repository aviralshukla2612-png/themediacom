@extends('layouts.app')
@section('content')


<!-- Page Header -->
<header class="page-header py-20" style="background-image: linear-gradient(rgba(17, 24, 39, 0.8), rgba(17, 24, 39, 0.95)), url('new_gallary/Corporate%20Events/Corporate%20Events%20-%20TMC%20(8).png'); background-size: cover; background-position: center;">
    <div class="container" data-aos="fade-up">
        <h1 class="page-title">Phygital Experiences Showcase</h1>
        <p class="section-subtitle mx-auto">A visual journey through our most impactful campaigns and dynamic events.
        </p>
    </div>
</header>

<!-- Premium Bento Gallery Section -->
<section class="py-20 overflow-hidden" style="background: var(--bg-dark); min-height: 80vh;">
    <div class="container">
        <!-- Filters -->
        <div class="gallery-filters mb-12" data-aos="fade-up"
            style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <button class="btn btn-outline execution-btn-outline filter-btn active" data-filter="all"
                style="padding: 0.8rem 2rem !important; border-color: var(--accent-red) !important; color: white !important;">All
                Campaigns</button>
            <button class="btn btn-outline execution-btn-outline filter-btn" data-filter="rwa"
                style="padding: 0.8rem 2rem !important;">RWA</button>
            <button class="btn btn-outline execution-btn-outline filter-btn" data-filter="btl"
                style="padding: 0.8rem 2rem !important;">BTL</button>
            <button class="btn btn-outline execution-btn-outline filter-btn" data-filter="mall"
                style="padding: 0.8rem 2rem !important;">Mall Promotion</button>
            <button class="btn btn-outline execution-btn-outline filter-btn" data-filter="corporate"
                style="padding: 0.8rem 2rem !important;">Corporate Events</button>
        </div>

        <!-- Bento Grid Layout refactored to clean 4x3 Grid -->
        <div class="bento-gallery-grid">
            @foreach($gallery_items as $item)
                @if(!empty($item['is_video']))
                    <!-- Video Item -->
                    <div class="bento-gallery-item filter-item {{ $item['category'] }} gsap-fade-up"
                        style="grid-column: span 1; grid-row: span 1; position: relative; border-radius: 16px; overflow: hidden; cursor: pointer; transition: opacity 0.4s; height: 100%;">
                        @php
                            $videoUrl = \Illuminate\Support\Str::startsWith($item['path'], ['new_gallary', 'client logo']) ? asset($item['path']) : asset('storage/' . $item['path']);
                        @endphp
                        <video autoplay loop muted playsinline class="img-cover"
                            style="filter: brightness(0.7); width: 100%; height: 100%; object-fit: cover;">
                            <source src="{{ $videoUrl }}" type="video/mp4">
                        </video>
                        <div class="bento-overlay"
                            style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); transition: 0.4s;">
                        </div>

                    </div>
                @else
                    <!-- Image Item -->
                    <div class="bento-gallery-item filter-item {{ $item['category'] }} gsap-fade-up"
                        style="grid-column: span 1; grid-row: span 1; position: relative; border-radius: 16px; overflow: hidden; cursor: pointer; transition: transform 0.4s, opacity 0.4s; height: 100%;">
                        @php
                            $rawUrl = \Illuminate\Support\Str::startsWith($item['path'], ['new_gallary', 'client logo']) ? asset($item['path']) : asset('storage/' . $item['path']);
                            $imageUrl = str_replace([' ', '(', ')'], ['%20', '%28', '%29'], $rawUrl);
                        @endphp
                        <img src="{{ $imageUrl }}"
                            alt="{{ $item['title'] }}" class="img-cover"
                            style="filter: brightness(0.8); transition: 0.5s; width: 100%; height: 100%; object-fit: cover;">

                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const filterItems = document.querySelectorAll('.filter-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active from all buttons
                filterBtns.forEach(b => {
                    b.classList.remove('active');
                    b.style.borderColor = '';
                    b.style.color = '';
                });

                // Set active styles
                btn.classList.add('active');
                btn.style.borderColor = 'var(--accent-red)';
                btn.style.color = 'white';

                const filterValue = btn.getAttribute('data-filter');

                filterItems.forEach(item => {
                    if (filterValue === 'all' || item.classList.contains(filterValue)) {
                        item.style.display = 'block';
                        // Slight delay for transition
                        setTimeout(() => {
                            item.style.opacity = '1';
                        }, 50);
                    } else {
                        item.style.opacity = '0';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 400);
                    }
                });
            });
        });
    });
</script>

<!-- Modal for Full Image -->
<div id="imageModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
</div>



@endsection
