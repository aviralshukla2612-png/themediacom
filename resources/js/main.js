class ClickSpark {
    constructor(options = {}) {
        this.sparkColor = options.sparkColor || '#ff0000';
        this.sparkSize = options.sparkSize !== undefined ? options.sparkSize : 45;
        this.sparkRadius = options.sparkRadius !== undefined ? options.sparkRadius : 85;
        this.sparkCount = options.sparkCount !== undefined ? options.sparkCount : 9;
        this.duration = options.duration !== undefined ? options.duration : 800;
        this.easing = options.easing || 'ease-out';
        this.extraScale = options.extraScale !== undefined ? options.extraScale : 1.0;

        this.canvas = null;
        this.ctx = null;
        this.sparks = [];
        this.animationId = null;

        this.init();
    }

    init() {
        this.canvas = document.createElement('canvas');
        this.canvas.id = 'click-spark-canvas';

        Object.assign(this.canvas.style, {
            position: 'fixed',
            top: '0',
            left: '0',
            width: '100vw',
            height: '100vh',
            pointerEvents: 'none',
            zIndex: '99999',
            display: 'block',
            userSelect: 'none'
        });

        document.body.appendChild(this.canvas);
        this.ctx = this.canvas.getContext('2d');

        this.resizeCanvas();
        window.addEventListener('resize', () => this.resizeCanvas());

        document.addEventListener('click', (e) => this.handleClick(e));

        this.animate();
    }

    resizeCanvas() {
        if (this.canvas) {
            this.canvas.width = window.innerWidth;
            this.canvas.height = window.innerHeight;
        }
    }

    easeFunc(t) {
        switch (this.easing) {
            case 'linear':
                return t;
            case 'ease-in':
                return t * t;
            case 'ease-in-out':
                return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
            default: // ease-out
                return t * (2 - t);
        }
    }

    handleClick(e) {
        if (!this.canvas) return;
        const rect = this.canvas.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const now = performance.now();
        const newSparks = Array.from({ length: this.sparkCount }, (_, i) => ({
            x,
            y,
            angle: (2 * Math.PI * i) / this.sparkCount,
            startTime: now
        }));

        this.sparks.push(...newSparks);
    }

    animate() {
        if (!this.canvas || !this.ctx) return;

        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);

        const now = performance.now();
        this.sparks = this.sparks.filter(spark => {
            const elapsed = now - spark.startTime;
            if (elapsed >= this.duration) {
                return false;
            }

            const progress = elapsed / this.duration;
            const eased = this.easeFunc(progress);

            const distance = eased * this.sparkRadius * this.extraScale;
            const lineLength = this.sparkSize * (1 - eased);

            const x1 = spark.x + distance * Math.cos(spark.angle);
            const y1 = spark.y + distance * Math.sin(spark.angle);
            const x2 = spark.x + (distance + lineLength) * Math.cos(spark.angle);
            const y2 = spark.y + (distance + lineLength) * Math.sin(spark.angle);

            this.ctx.strokeStyle = this.sparkColor;
            this.ctx.lineWidth = 2;
            this.ctx.beginPath();
            this.ctx.moveTo(x1, y1);
            this.ctx.lineTo(x2, y2);
            this.ctx.stroke();

            return true;
        });

        this.animationId = requestAnimationFrame(() => this.animate());
    }
}

document.addEventListener('DOMContentLoaded', () => {
    // Initialize ClickSpark globally with custom options
    new ClickSpark({
        sparkColor: '#ff0000',
        sparkSize: 45,
        sparkRadius: 85,
        sparkCount: 9,
        duration: 800
    });

    // Initialize AOS
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
        AOS.refresh();
    }

    // Navbar Scroll Effect
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // Mobile Menu Toggle
    const mobileBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');

    if (mobileBtn && navLinks && !mobileBtn.dataset.initialized) {
        mobileBtn.dataset.initialized = 'true';
        const toggleMobileMenu = (e) => {
            if (e) e.stopPropagation();
            navLinks.classList.toggle('active');

            const isActive = navLinks.classList.contains('active');
            mobileBtn.classList.toggle('active', isActive);

            // Prevent body scroll when menu is open
            document.body.style.overflow = isActive ? 'hidden' : '';
        };

        mobileBtn.addEventListener('click', toggleMobileMenu);

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (navLinks.classList.contains('active') &&
                !navLinks.contains(e.target) &&
                !mobileBtn.contains(e.target)) {
                toggleMobileMenu();
            }
        });


        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', (e) => {
                // Do not close the mobile menu if they are just toggling the dropdown!
                if (link.parentElement.classList.contains('nav-item-dropdown') && window.innerWidth <= 1024) {
                    return;
                }

                if (navLinks.classList.contains('active')) {
                    navLinks.classList.remove('active');
                    mobileBtn.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
    }

    // Animated Counters
    const counters = document.querySelectorAll('.counter-val');
    const speed = 600; // Increased for slower increment

    const animateCounters = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 40); // Increased delay
                } else {
                    counter.innerText = target + (counter.getAttribute('data-plus') || '');
                }
            };

            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    updateCount();
                    observer.disconnect();
                }
            });
            observer.observe(counter);
        });
    }

    if (counters.length > 0) {
        animateCounters();
    }

    // ==========================================
    // DYNAMIC ESTIMATOR WITH STATE MANAGEMENT
    // ==========================================
    const estimatorContainer = document.querySelector('.estimator-container');
    if (estimatorContainer) {
        const pricingState = {
            serviceType: "",
            btl: { promoters: 0, days: 0 },
            printing: { size: "small", qty: 0 },
            corporate: { guests: 0, venue: "budget" },
            rwa: { societies: 0, duration: 0 },
            ai: { type: "basic" },
            step: 1
        };

        const serviceSelect = document.getElementById('service-type');
        const dynamicFields = document.querySelectorAll('.dynamic-fields');
        const resultDiv = document.getElementById('estimation-result');
        const budgetAmount = document.getElementById('budget-amount');

        if (serviceSelect) {
            serviceSelect.addEventListener('change', function () {
                pricingState.serviceType = this.value;
                pricingState.step = 2;
                renderEstimatorUI();
            });

            // Bind inputs to state
            const bindInput = (id, key, subKey) => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', (e) => {
                        let val = e.target.value;
                        if (e.target.type === 'number') val = parseInt(val) || 0;
                        pricingState[key][subKey] = val;
                        calculateEstimate();
                    });
                }
            };

            // BTL
            bindInput('btl-promoters', 'btl', 'promoters');
            bindInput('btl-days', 'btl', 'days');

            // Printing
            bindInput('print-size', 'printing', 'size');
            bindInput('print-qty', 'printing', 'qty');

            // Corporate
            bindInput('corp-guests', 'corporate', 'guests');
            bindInput('corp-venue', 'corporate', 'venue');

            // RWA
            bindInput('rwa-societies', 'rwa', 'societies');
            bindInput('rwa-duration', 'rwa', 'duration');

            // AI
            bindInput('ai-type', 'ai', 'type');

            function renderEstimatorUI() {
                dynamicFields.forEach(field => field.classList.remove('active'));
                resultDiv.style.display = 'none';

                if (pricingState.serviceType) {
                    const targetField = document.getElementById(`fields-${pricingState.serviceType}`);
                    if (targetField) targetField.classList.add('active');
                    calculateEstimate();
                }
            }

            function calculateEstimate() {
                const service = pricingState.serviceType;
                if (!service) return;

                let minPrice = 0;
                let maxPrice = 0;

                switch (service) {
                    case 'printing':
                        const basePrice = pricingState.printing.size === 'large' ? 100 : (pricingState.printing.size === 'medium' ? 50 : 20);
                        let qty = pricingState.printing.qty;
                        minPrice = basePrice * qty;
                        if (qty > 100) minPrice *= 0.9; // Bulk discount logic
                        maxPrice = minPrice * 1.5;
                        break;
                    case 'btl':
                        minPrice = (pricingState.btl.promoters * 1500 * pricingState.btl.days) + 10000;
                        maxPrice = minPrice * 1.8;
                        break;
                    case 'corporate':
                        const perGuest = pricingState.corporate.venue === '5star' ? 3000 : 1500;
                        minPrice = (pricingState.corporate.guests * perGuest) + 50000;
                        maxPrice = minPrice * 1.5;
                        break;
                    case 'rwa':
                        minPrice = pricingState.rwa.societies * 5000 * pricingState.rwa.duration;
                        maxPrice = minPrice * 1.4;
                        break;
                    case 'ai':
                        if (pricingState.ai.type === 'chatbot') { minPrice = 25000; maxPrice = 50000; }
                        else if (pricingState.ai.type === 'analytics') { minPrice = 40000; maxPrice = 80000; }
                        else { minPrice = 30000; maxPrice = 60000; }
                        break;
                }

                if (minPrice > 0) {
                    resultDiv.style.display = 'block';
                    const formatter = new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR', maximumFractionDigits: 0 });
                    const budgetStr = `${formatter.format(minPrice)} - ${formatter.format(maxPrice)}`;
                    budgetAmount.innerText = budgetStr;
                    const hiddenBudget = document.getElementById('hidden-budget-val');
                    if (hiddenBudget) hiddenBudget.value = budgetStr;
                } else {
                    resultDiv.style.display = 'none';
                }
            }
        }

        // Handle Claim Form Submission via AJAX
        const claimForm = document.querySelector('.claim-form');
        if (claimForm) {
            claimForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const submitBtn = this.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerText;
                submitBtn.innerText = 'Sending...';
                submitBtn.disabled = true;

                const formData = new FormData(this);

                fetch(this.getAttribute('action'), {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const claimContainer = document.querySelector('.claim-estimate');
                            claimContainer.innerHTML = `
                            <div class="success-message" style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10B981; padding: 2rem; border-radius: 8px; text-align: center; margin-top: 2rem;">
                                <i class="fas fa-check-circle" style="color: #10B981; font-size: 3rem; margin-bottom: 1rem;"></i>
                                <h4 style="color: #10B981; margin-bottom: 0.5rem; font-size: 1.25rem;">Request Received Successfully!</h4>
                                <p style="color: white; font-size: 1rem;">${data.message || 'Your official proposal request has been received.'}</p>
                                <p style="color: #9CA3AF; font-size: 0.85rem; margin-top: 1rem;">Our team will get back to you shortly to discuss your custom proposal.</p>
                            </div>
                        `;
                        } else {
                            alert(data.message || 'Something went wrong. Please try again.');
                            submitBtn.innerText = originalBtnText;
                            submitBtn.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again later.');
                        submitBtn.innerText = originalBtnText;
                        submitBtn.disabled = false;
                    });
            });
        }
    }

    // ==========================================
    // MASONRY ALGORITHM (RESIZEOBSERVER)
    // ==========================================
    const masonryGrids = document.querySelectorAll('.masonry-grid');
    if (masonryGrids.length > 0) {
        const layoutAllMasonry = () => {
            masonryGrids.forEach(grid => {
                const currentFilter = document.querySelector('.filter-btn.active')?.getAttribute('data-filter') || 'all';
                const items = Array.from(grid.querySelectorAll('.gallery-item'));

                const visibleItems = items.filter(item => {
                    if (currentFilter === 'all') return true;
                    return item.getAttribute('data-category') === currentFilter;
                });

                const colCount = window.innerWidth > 1024 ? 3 : window.innerWidth > 768 ? 2 : 1;
                const columns = Array.from({ length: colCount }, () => 0);
                const gap = 24;

                grid.style.position = 'relative';
                const itemWidth = (grid.offsetWidth - (gap * (colCount - 1))) / colCount;

                items.forEach(item => {
                    if (visibleItems.includes(item)) {
                        item.style.position = 'absolute';
                        item.style.width = `${itemWidth}px`;

                        const minHeight = Math.min(...columns);
                        const colIndex = columns.indexOf(minHeight);

                        item.style.left = `${colIndex * (itemWidth + gap)}px`;
                        item.style.top = `${minHeight}px`;

                        item.style.display = 'block';
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';

                        columns[colIndex] += item.offsetHeight + gap;
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            if (!visibleItems.includes(item)) item.style.display = 'none';
                        }, 300);
                    }
                });

                grid.style.height = `${Math.max(...columns)}px`;
            });

            // Refresh AOS to detect new positions
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        };


        // Initialize Filter buttons
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                layoutAllMasonry();
            });
        });

        // Event Listeners
        window.addEventListener('resize', layoutAllMasonry);
        window.addEventListener('load', layoutAllMasonry);

        // Initial layout attempts
        setTimeout(layoutAllMasonry, 100);
        setTimeout(layoutAllMasonry, 500);
        setTimeout(layoutAllMasonry, 1000);

        // ResizeObserver for each grid
        const ro = new ResizeObserver(layoutAllMasonry);
        masonryGrids.forEach(grid => ro.observe(grid));
    }



    // Modal for Gallery
    const modal = document.getElementById('imageModal');
    if (modal) {
        const modalImg = document.getElementById('modalImage');
        const closeBtn = document.querySelector('.close');

        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', function () {
                const img = this.querySelector('img');
                modal.style.display = 'block';
                modalImg.src = img.src;
            });
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target == modal) {
                modal.style.display = 'none';
            }
        });
    }
});
