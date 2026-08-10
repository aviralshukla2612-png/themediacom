document.addEventListener('DOMContentLoaded', () => {
    // Only initialize on desktop
    if (window.innerWidth <= 1024) return;

    // Create cursor elements
    const cursorDot = document.createElement('div');
    cursorDot.classList.add('custom-cursor-dot');
    document.body.appendChild(cursorDot);

    const cursorRing = document.createElement('div');
    cursorRing.classList.add('custom-cursor-ring');
    document.body.appendChild(cursorRing);

    // State
    let mouseX = window.innerWidth / 2;
    let mouseY = window.innerHeight / 2;
    let dotX = window.innerWidth / 2;
    let dotY = window.innerHeight / 2;
    let ringX = window.innerWidth / 2;
    let ringY = window.innerHeight / 2;
    let isHovering = false;
    let isHoveringText = false;

    // Magnetic state
    let magneticX = 0;
    let magneticY = 0;
    let magneticActive = false;

    // Update mouse position
    window.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        
        // Unhide if hidden
        cursorDot.style.opacity = isHoveringText ? '0' : (isHovering ? '0.5' : '1');
        cursorRing.style.opacity = '1';
    });

    // Window leave/enter
    document.addEventListener('mouseleave', () => {
        cursorDot.style.opacity = '0';
        cursorRing.style.opacity = '0';
    });

    document.addEventListener('mouseenter', () => {
        cursorDot.style.opacity = '1';
        cursorRing.style.opacity = '1';
    });

    // Click effect
    window.addEventListener('mousedown', () => {
        cursorRing.classList.add('click-active');
    });
    window.addEventListener('mouseup', () => {
        cursorRing.classList.remove('click-active');
    });

    // Interactive elements hover
    const interactives = document.querySelectorAll('a, button, .btn, .nav-link, .gallery-item, [role="button"]');
    
    interactives.forEach(el => {
        el.addEventListener('mouseenter', (e) => {
            isHovering = true;
            cursorRing.classList.add('hover-active');
            cursorDot.classList.add('hover-active');
            
            // Enable magnet on buttons
            if (el.tagName.toLowerCase() === 'button' || el.classList.contains('btn')) {
                magneticActive = true;
                el.style.transition = 'transform 0.2s cubic-bezier(0.16, 1, 0.3, 1)';
            }
        });
        
        el.addEventListener('mouseleave', () => {
            isHovering = false;
            cursorRing.classList.remove('hover-active');
            cursorDot.classList.remove('hover-active');
            
            // Reset magnet
            magneticActive = false;
            if (el.tagName.toLowerCase() === 'button' || el.classList.contains('btn')) {
                el.style.transform = 'translate(0px, 0px)';
            }
        });

        // Magnetic effect update on mousemove over element
        if (el.tagName.toLowerCase() === 'button' || el.classList.contains('btn')) {
            el.addEventListener('mousemove', (e) => {
                const rect = el.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                // Move button slightly (magnetic attraction)
                el.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
                
                // Cursor snaps to button center slightly
                magneticX = (rect.left + rect.width / 2) + (x * 0.1);
                magneticY = (rect.top + rect.height / 2) + (y * 0.1);
            });
        }
    });

    // Text elements hover (for text-selection variant)
    const textElements = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, span, input[type="text"], textarea');
    textElements.forEach(el => {
        if (!el.closest('a') && !el.closest('button') && !el.closest('.btn')) {
            el.addEventListener('mouseenter', () => {
                isHoveringText = true;
                cursorRing.classList.add('text-active');
                cursorDot.style.opacity = '0'; // Hide dot when in text mode
            });
            el.addEventListener('mouseleave', () => {
                isHoveringText = false;
                cursorRing.classList.remove('text-active');
                cursorDot.style.opacity = '1';
            });
        }
    });

    // Animation Loop (Lerp)
    const lerp = (start, end, factor) => {
        return start + (end - start) * factor;
    };

    const render = () => {
        let targetX = mouseX;
        let targetY = mouseY;

        // If hovering magnetic element, move ring towards it slightly
        if (magneticActive) {
            targetX = lerp(mouseX, magneticX, 0.6);
            targetY = lerp(mouseY, magneticY, 0.6);
        }

        // Apply easing to dot position for micro-smoothness
        dotX = lerp(dotX, mouseX, 0.7);
        dotY = lerp(dotY, mouseY, 0.7);
        cursorDot.style.transform = `translate(${dotX}px, ${dotY}px)`;

        // Apply softer easing to ring position for buttery trail
        ringX = lerp(ringX, targetX, 0.08);
        ringY = lerp(ringY, targetY, 0.08);

        cursorRing.style.transform = `translate(${ringX}px, ${ringY}px)`;
        requestAnimationFrame(render);
    };

    requestAnimationFrame(render);

    // Timeline Progress Bar Logic
    const timelines = document.querySelectorAll('.timeline');
    if (timelines.length > 0) {
        timelines.forEach(timeline => {
            // Check if progress already exists
            if (!timeline.querySelector('.timeline-progress')) {
                const progress = document.createElement('div');
                progress.classList.add('timeline-progress');
                timeline.appendChild(progress);

                window.addEventListener('scroll', () => {
                    const rect = timeline.getBoundingClientRect();
                    const windowHeight = window.innerHeight;
                    
                    // Start progress when top of timeline is at middle of screen
                    const startPos = windowHeight * 0.6; 
                    
                    let progressPercent = 0;
                    
                    // How far we have scrolled past the start point
                    const scrollDistance = startPos - rect.top;
                    const maxScroll = rect.height;
                    
                    if (scrollDistance > 0) {
                        progressPercent = Math.min(100, (scrollDistance / maxScroll) * 100);
                    }
                    
                    progress.style.height = `${progressPercent}%`;
                    
                    // Fill dots as line reaches them
                    const items = timeline.querySelectorAll('.timeline-item, .timeline-step');
                    items.forEach(item => {
                        const itemTop = item.offsetTop;
                        // For timeline-item (index.php desktop uses pseudo-elements around 25px top offset)
                        // For timeline-step (index.php mobile/horizontal uses timeline-dot inside)
                        if (scrollDistance > itemTop + 30) {
                            item.classList.add('filled');
                        } else {
                            item.classList.remove('filled');
                        }
                    });
                });
            }
        });
    }

    // Global Page Scroll Progress Bar Logic
    const pageProgress = document.createElement('div');
    pageProgress.classList.add('page-scroll-progress');
    document.body.appendChild(pageProgress);

    const updatePageProgress = () => {
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const progressPercent = scrollHeight > 0 ? (scrollTop / scrollHeight) * 100 : 0;
        
        pageProgress.style.width = `${progressPercent}%`;
        
        // Hide sparkle if at the very beginning
        if (progressPercent < 1) {
            pageProgress.style.opacity = '0';
        } else {
            pageProgress.style.opacity = '1';
        }
    };

    window.addEventListener('scroll', updatePageProgress);
    window.addEventListener('resize', updatePageProgress);
    updatePageProgress(); // Init
});
