document.addEventListener('DOMContentLoaded', () => {
    // 1. Initialize Lenis (Smooth Scroll)
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

    // Integrate Lenis with GSAP ScrollTrigger
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        // Update ScrollTrigger on Lenis scroll
        lenis.on('scroll', ScrollTrigger.update);

        gsap.ticker.add((time) => {
            lenis.raf(time * 1000);
        });

        gsap.ticker.lagSmoothing(0, 0);

        // 2. Global Staggered Text Reveal
        const splitTextElements = document.querySelectorAll('.gsap-text-reveal');
        
        splitTextElements.forEach(el => {
            // A simple word-level split since we don't have SplitText plugin
            const words = el.innerText.split(' ');
            el.innerHTML = '';
            words.forEach(word => {
                const wordSpan = document.createElement('span');
                wordSpan.style.display = 'inline-block';
                wordSpan.style.overflow = 'hidden';
                wordSpan.style.verticalAlign = 'bottom';
                
                const innerSpan = document.createElement('span');
                innerSpan.style.display = 'inline-block';
                innerSpan.innerText = word + '\u00A0'; // add non-breaking space
                innerSpan.classList.add('gsap-word');
                
                wordSpan.appendChild(innerSpan);
                el.appendChild(wordSpan);
            });

            gsap.fromTo(el.querySelectorAll('.gsap-word'), 
                { y: '100%', opacity: 0, rotateZ: 5 },
                { 
                    y: '0%', 
                    opacity: 1, 
                    rotateZ: 0,
                    duration: 1.2, 
                    stagger: 0.05, 
                    ease: 'power4.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 90%',
                    }
                }
            );
        });

        // 3. Cinematic Image Parallax (for Bento Grid & Hero)
        const parallaxImages = document.querySelectorAll('.gsap-parallax img');
        parallaxImages.forEach(img => {
            gsap.to(img, {
                yPercent: 20,
                ease: 'none',
                scrollTrigger: {
                    trigger: img.parentElement,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true
                }
            });
        });

        // 4. Fade Up Reveal Elements
        const fadeUpElements = document.querySelectorAll('.gsap-fade-up');
        fadeUpElements.forEach(el => {
            gsap.fromTo(el,
                { y: 50, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    duration: 1,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 85%'
                    }
                }
            );
        });
        
        // 5. Marquee Infinite Scroll (GSAP)
        const marquees = document.querySelectorAll('.gsap-marquee');
        marquees.forEach(marquee => {
            const inner = marquee.querySelector('.marquee-inner');
            if (inner) {
                // Clone the inner content for seamless looping
                inner.innerHTML += inner.innerHTML;
                
                const ltr = marquee.getAttribute('data-direction') === 'ltr';
                
                gsap.fromTo(inner, 
                    { xPercent: ltr ? -50 : 0 },
                    {
                        xPercent: ltr ? 0 : -50,
                        ease: "none",
                        duration: 20, // Adjust speed here
                        repeat: -1
                    }
                );
            }
        });
    }
});
