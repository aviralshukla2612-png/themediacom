document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Initialize Lenis Smooth Scroll
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        mouseMultiplier: 1,
        smoothTouch: false,
        touchMultiplier: 2,
        infinite: false,
    });

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    // Sync GSAP ScrollTrigger with Lenis
    gsap.registerPlugin(ScrollTrigger);
    
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });
    gsap.ticker.lagSmoothing(0);

    // 2. Subtle Scroll Reveals (Global)
    const fadeUpElements = document.querySelectorAll('[data-aos="fade-up"]');
    fadeUpElements.forEach((el, i) => {
        // Disable AOS since we are using GSAP
        el.removeAttribute('data-aos');
        
        gsap.fromTo(el, 
            { y: 30, opacity: 0 },
            { 
                scrollTrigger: {
                    trigger: el,
                    start: 'top 85%',
                },
                y: 0, 
                opacity: 1, 
                duration: 1, 
                ease: 'power3.out' 
            }
        );
    });

    // 3. Execution Cards Stagger Reveal (If present)
    const serviceCards = document.querySelectorAll('.service-card');
    if (serviceCards.length > 0) {
        // Disable AOS on these too
        serviceCards.forEach(c => c.removeAttribute('data-aos'));
        
        gsap.fromTo('.service-card', 
            { y: 40, opacity: 0 },
            {
                scrollTrigger: {
                    trigger: '.services-grid',
                    start: 'top 80%',
                },
                y: 0,
                opacity: 1,
                duration: 0.8,
                stagger: 0.15,
                ease: 'power3.out'
            }
        );
    }

    // 4. Cinematic Campaigns GSAP Stagger Reveal
    const cinematicCards = document.querySelectorAll('.cinematic-card');
    if (cinematicCards.length > 0) {
        gsap.fromTo('.cinematic-card', 
            { y: 50, opacity: 0 },
            {
                scrollTrigger: {
                    trigger: '.cinematic-campaigns-grid',
                    start: 'top 75%',
                },
                y: 0,
                opacity: 1,
                duration: 1,
                stagger: 0.15, // 0ms, 150ms, 300ms effect
                ease: 'power4.out'
            }
        );

        // 5. Video on Hover Logic
        cinematicCards.forEach(card => {
            const video = card.querySelector('video');
            if (video) {
                card.addEventListener('mouseenter', () => {
                    video.play();
                });
                card.addEventListener('mouseleave', () => {
                    video.pause();
                    video.currentTime = 0; // Reset video to start
                });
            }
        });
    }

});
