@extends('layouts.app')
@section('content')


<!-- Page Header with Background Image -->
<header class="page-header py-20" style="
    position: relative;
    min-height: 420px;
    display: flex;
    align-items: center;
    overflow: hidden;
    background-color: #090b10;
    background-image:
        linear-gradient(to bottom, rgba(9,11,16,0.55) 0%, rgba(9,11,16,0.75) 60%, rgba(9,11,16,1) 100%),
        url('new_gallary/Corporate%20Events/Corporate%20Events%20-%20TMC%20(5).png');
    background-size: cover;
    background-position: center 40%;
    background-repeat: no-repeat;
">
    <!-- Noise texture overlay for depth -->
    <div style="
        position: absolute; inset: 0; z-index: 1; pointer-events: none;
        background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22n%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.7%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23n)%22/%3E%3C/svg%3E');
        opacity: 0.025;
    "></div>
    <!-- Accent line removed -->

    <div class="container" data-aos="fade-up" style="position: relative; z-index: 3; text-align: center; width: 100%;">
        <!-- Eyebrow label -->
        <div style="
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(220,38,38,0.12); border: 1px solid rgba(220,38,38,0.3);
            color: #f87171; font-size: 0.8rem; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase;
            padding: 6px 18px; border-radius: 50px; margin-bottom: 20px;
        ">
            <span
                style="width:6px;height:6px;border-radius:50%;background:#ef4444;display:inline-block;box-shadow:0 0 8px #ef4444;"></span>
            Get In Touch
        </div>
        <h1 class="page-title" style="color: #fff; text-shadow: 0 2px 20px rgba(0,0,0,0.4); margin-bottom: 1rem;">
            Contact Us</h1>
        <p class="section-subtitle mx-auto" style="
            color: #cbd5e1;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.08);
            display: inline-block;
            padding: 10px 28px;
            border-radius: 50px;
            font-size: 1.05rem;
        ">Get in touch with us for any inquiries.</p>
    </div>
</header>


<!-- Split Contact Section -->
<section class="py-20 overflow-hidden" style="position: relative;">
    <div class="container" style="position: relative; z-index: 1;">
        <div class="contact-grid">

            <!-- Left: Info -->
            <div data-aos="fade-right">
                <div class="contact-info-card">
                    <h2 class="mb-8" style="font-size: 2rem;">Contact Information</h2>

                    <style>
                        .contact-item-link {
                            display: block;
                            text-decoration: none;
                            color: inherit;
                            border-radius: 12px;
                            transition: background 0.22s ease, transform 0.18s ease;
                            margin-bottom: 0;
                        }

                        .contact-item-link:hover {
                            background: rgba(220, 38, 38, 0.06);
                            transform: translateX(4px);
                        }

                        .contact-item-link:hover .contact-item-icon {
                            background: var(--accent-red);
                            color: #fff;
                        }

                        .contact-item-link:hover .text-muted {
                            color: var(--accent-red);
                        }

                        .contact-item-link .click-hint {
                            display: none;
                            font-size: 0.72rem;
                            color: var(--accent-red);
                            letter-spacing: 0.5px;
                            margin-top: 2px;
                            font-weight: 600;
                        }

                        .contact-item-link:hover .click-hint {
                            display: block;
                        }
                    </style>

                    

                    <!-- Address → Google Maps -->
                    <a href="{{ $mapsUrl }}" target="_blank" rel="noopener noreferrer"
                        class="contact-item-link" title="Open in Google Maps">
                        <div class="contact-item">
                            <div class="contact-item-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h4 class="mb-1">Our Office</h4>
                                <p class="text-muted">{{ $address }}</p>
                                <span class="click-hint">📍 Open in Google Maps</span>
                            </div>
                        </div>
                    </a>

                    <!-- Phone → Dialler -->
                    <a href="tel:{{ $phoneDig }}" class="contact-item-link" title="Call us">
                        <div class="contact-item">
                            <div class="contact-item-icon"><i class="fas fa-phone-alt"></i></div>
                            <div>
                                <h4 class="mb-1">Phone / WhatsApp</h4>
                                <p class="text-muted">{{ $phone }}</p>
                                <span class="click-hint">📞 Tap to Call</span>
                            </div>
                        </div>
                    </a>

                    <!-- Email → Mail Client -->
                    <a href="mailto:{{ $email }}" class="contact-item-link" title="Send us an email">
                        <div class="contact-item">
                            <div class="contact-item-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <h4 class="mb-1">Email</h4>
                                <p class="text-muted">{{ $email }}</p>
                                <span class="click-hint">✉️ Open in Mail App</span>
                            </div>
                        </div>
                    </a>

                    <a href="https://wa.me/<?= htmlspecialchars(preg_replace('/[^0-9]/', '', $phone)) ?>"
                        target="_blank" rel="noopener noreferrer" class="btn btn-primary mt-8 w-full"
                        style="background-color: #25d366; box-shadow: none;">Chat on
                        WhatsApp <i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Right: Simple Form -->
            <div data-aos="fade-left">
                <div class="contact-glass-form">
                    @if(isset($_GET['success']))
                        <div
                            style="background: #10b981; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                            Your inquiry has been sent successfully. We will contact you soon.
                        </div>
                    @endif

                    <h2 class="mb-2" style="font-size: 2.5rem; color: var(--text-main);">Send an Inquiry</h2>
                    <p class="text-muted mb-8">Fill out the simple form below and we'll get back to you.</p>

                    <form action="{{ route('inquiry.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="form_source" value="contact_page">
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Rahul Sharma" required oninput="this.value = this.value.replace(/[0-9]/g, '')">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Company Name <span
                                    style="font-weight: normal; color: #94a3b8;">(Optional)</span></label>
                            <input type="text" name="company" class="form-control" placeholder="e.g. Acme Corp" oninput="this.value = this.value.replace(/[0-9]/g, '')">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="e.g. 9876543210" required
                                   pattern="[0-9]{10}" maxlength="10" title="Please enter exactly 10 digits"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Type of Inquiry</label>
                            <select name="inquiry_type" class="form-control" required>
                                <option value="" disabled selected>Select Option...</option>
                                <option value="BTL Activation">BTL Activation</option>
                                <option value="Corporate Events">Corporate Events</option>
                                <option value="RWA">RWA</option>
                                <option value="Exhibition">Retail Branding</option>
                                <option value="Mall Promotion">Mall Promotion</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-full mt-4">Submit Inquiry <i
                                class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Pan-India Execution Section -->
<style>
    .coverage-section {
        background: #090b10;
        padding: 100px 0;
        position: relative;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .city-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 4rem;
    }

    .city-card {
        position: relative;
        height: 380px;
        border-radius: 20px;
        overflow: hidden;
        background: #111827;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .city-card img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(80%) brightness(0.5);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .city-card:hover img {
        filter: grayscale(0%) brightness(0.8);
        transform: scale(1.08);
    }

    .city-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0) 70%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 2.5rem 2rem;
        transition: all 0.4s ease;
    }

    .city-name {
        font-size: 2.2rem;
        color: white;
        font-family: var(--font-heading);
        margin-bottom: 0.5rem;
        font-weight: 800;
    }

    .city-stats {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        margin-top: 0.5rem;
    }

    .city-card:hover .city-stats {
        opacity: 1;
        transform: translateY(0);
    }

    .city-stat-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        color: #E5E7EB;
        font-size: 1rem;
        font-weight: 600;
    }

    .city-stat-item i {
        color: var(--accent-red);
        font-size: 1.2rem;
    }

    .coverage-stats-strip {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 2rem;
        margin: 5rem 0;
        padding: 3rem 0;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .coverage-cta-block {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.03) 0%, rgba(255, 255, 255, 0.01) 100%);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 5rem 3rem;
        text-align: center;
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
        .coverage-cta-block {
            padding: 3rem 1rem;
        }
    }

    .coverage-cta-block h3 {
        font-size: clamp(2rem, 3vw, 2.8rem);
        color: white;
        font-family: var(--font-heading);
        margin-bottom: 1.5rem;
        font-weight: 800;
    }

    .coverage-cta-block p {
        color: #9CA3AF;
        font-size: 1.2rem;
        max-width: 650px;
        margin: 0 auto 2.5rem auto;
        line-height: 1.6;
    }

    .btn-coverage {
        background: var(--accent-red);
        color: white;
        padding: 1.2rem 3.5rem;
        border-radius: 50px;
        font-weight: 800;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-coverage:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 30px rgba(220, 38, 38, 0.4);
        color: white;
    }

    .topic-glass {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-top: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 20px;
        padding: 40px;
        position: relative;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        width: 100%;
        max-width: 450px;
        transition: all 0.3s ease;
    }

    .active-card {
        border-color: rgba(255, 255, 255, 0.5) !important;
        box-shadow: 0 10px 30px -10px rgba(255, 255, 255, 0.3) !important;
        transform: scale(1.05) !important;
        z-index: 20;
    }

    @keyframes pulseBorder {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.1);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        }
    }

    .premium-card {
        animation: pulseBorder 3s infinite;
    }

    .premium-card:hover,
    .active-card {
        animation: none;
    }
</style>

<section class="coverage-section">
    <div class="container">

        <!-- Four City Hub Cards -->
        <div class="city-cards-grid gsap-fade-up">

            <!-- Delhi NCR -->
            <div class="city-card">
                <img src="https://images.unsplash.com/photo-1587474260584-136574528ed5?auto=format&fit=crop&w=800&q=80"
                    alt="Delhi NCR">
                <div class="city-overlay">
                    <div
                        style="display:inline-flex;align-items:center;gap:6px;background:rgba(220,38,38,0.2);border:1px solid rgba(220,38,38,0.4);color:#f87171;font-size:0.7rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 12px;border-radius:50px;margin-bottom:0.75rem;width:fit-content;">
                        <span
                            style="width:5px;height:5px;border-radius:50%;background:#ef4444;display:inline-block;"></span>
                        Hub City
                    </div>
                    <div class="city-name">Delhi NCR</div>
                    <div class="city-stats">
                        <div class="city-stat-item"><i class="fas fa-rocket"></i> 95+ Campaigns Executed</div>
                        <div class="city-stat-item"><i class="fas fa-building"></i> 30+ Enterprise Clients</div>
                        <div class="city-stat-item"><i class="fas fa-map-marker-alt"></i> North India Operations</div>
                    </div>
                </div>
            </div>

            <!-- Jaipur -->
            <div class="city-card">
                <img src="https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?auto=format&fit=crop&w=800&q=80"
                    alt="Jaipur">
                <div class="city-overlay">
                    <div
                        style="display:inline-flex;align-items:center;gap:6px;background:rgba(220,38,38,0.2);border:1px solid rgba(220,38,38,0.4);color:#f87171;font-size:0.7rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 12px;border-radius:50px;margin-bottom:0.75rem;width:fit-content;">
                        <span
                            style="width:5px;height:5px;border-radius:50%;background:#ef4444;display:inline-block;"></span>
                        Hub City
                    </div>
                    <div class="city-name">Jaipur</div>
                    <div class="city-stats">
                        <div class="city-stat-item"><i class="fas fa-rocket"></i> 85+ Campaigns Executed</div>
                        <div class="city-stat-item"><i class="fas fa-building"></i> 25+ Enterprise Clients</div>
                        <div class="city-stat-item"><i class="fas fa-map-marker-alt"></i> Rajasthan Region Hub</div>
                    </div>
                </div>
            </div>

            <!-- Ahmedabad -->
            <div class="city-card">
                <img src="https://images.unsplash.com/photo-1529543544282-ea669407fca3?auto=format&fit=crop&w=800&q=80"
                    alt="Ahmedabad">
                <div class="city-overlay">
                    <div
                        style="display:inline-flex;align-items:center;gap:6px;background:rgba(220,38,38,0.2);border:1px solid rgba(220,38,38,0.4);color:#f87171;font-size:0.7rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 12px;border-radius:50px;margin-bottom:0.75rem;width:fit-content;">
                        <span
                            style="width:5px;height:5px;border-radius:50%;background:#ef4444;display:inline-block;"></span>
                        Head Office
                    </div>
                    <div class="city-name">Ahmedabad</div>
                    <div class="city-stats">
                        <div class="city-stat-item"><i class="fas fa-rocket"></i> 150+ Campaigns Executed</div>
                        <div class="city-stat-item"><i class="fas fa-building"></i> 50+ Enterprise Clients</div>
                        <div class="city-stat-item"><i class="fas fa-map-marker-alt"></i> Gujarat & West India HQ</div>
                    </div>
                </div>
            </div>

            <!-- Mumbai -->
            <div class="city-card">
                <img src="https://images.unsplash.com/photo-1570168007204-dfb528c6958f?auto=format&fit=crop&w=800&q=80"
                    alt="Mumbai">
                <div class="city-overlay">
                    <div
                        style="display:inline-flex;align-items:center;gap:6px;background:rgba(220,38,38,0.2);border:1px solid rgba(220,38,38,0.4);color:#f87171;font-size:0.7rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 12px;border-radius:50px;margin-bottom:0.75rem;width:fit-content;">
                        <span
                            style="width:5px;height:5px;border-radius:50%;background:#ef4444;display:inline-block;"></span>
                        Hub City
                    </div>
                    <div class="city-name">Mumbai</div>
                    <div class="city-stats">
                        <div class="city-stat-item"><i class="fas fa-rocket"></i> 120+ Campaigns Executed</div>
                        <div class="city-stat-item"><i class="fas fa-building"></i> 45+ Enterprise Clients</div>
                        <div class="city-stat-item"><i class="fas fa-map-marker-alt"></i> Maharashtra & West Coast</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



@endsection
