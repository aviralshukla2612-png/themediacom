@extends('layouts.app')
@section('content')

    <!-- Hero -->
    <header class="ai-hero">
        <div class="container text-center py-20">
            <div data-aos="zoom-in">
                <span class="hero-tag" style="background: rgba(99,102,241,0.1); border-color: #4f46e5; color: #a5b4fc;">Next-Gen Marketing</span>
                <h1 class="hero-title" style="background: linear-gradient(to right, #fff, #a5b4fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Intelligence Meets Marketing</h1>
                <p class="hero-subtitle mx-auto">Deploy sophisticated AI models to automate lead generation, qualify prospects in real-time, and scale your brand's digital presence effortlessly.</p>
                <a href="#services" class="btn btn-primary" style="background: linear-gradient(135deg, #4f46e5, #6366f1); border: none;">Explore Capabilities</a>
            </div>
        </div>
    </header>

    <!-- AI Services -->
    <section id="services" class="py-20 overflow-hidden">
        <div class="container">
            <div class="services-grid">
                <div class="tech-card" data-aos="fade-up">
                    <i class="fas fa-bullseye" style="font-size: 2.5rem; color: #ec4899; margin-bottom: 1.5rem;"></i>
                    <h3 class="mb-4">AI Ad Strategy</h3>
                    <p class="text-muted">Predictive modeling to identify the most profitable ad placements, audiences, and creative variations before spending your budget.</p>
                </div>
                <div class="tech-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-robot" style="font-size: 2.5rem; color: #8b5cf6; margin-bottom: 1.5rem;"></i>
                    <h3 class="mb-4">AI Chatbots</h3>
                    <p class="text-muted">LLM-powered conversational agents that don't just answer FAQs, but actively qualify leads and schedule appointments 24/7.</p>
                </div>
                <div class="tech-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-filter" style="font-size: 2.5rem; color: #3b82f6; margin-bottom: 1.5rem;"></i>
                    <h3 class="mb-4">AI Lead Funnels</h3>
                    <p class="text-muted">Dynamic landing pages and automated email sequences that adapt their messaging based on the user's real-time behavior.</p>
                </div>
                <div class="tech-card" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-pen-fancy" style="font-size: 2.5rem; color: #10b981; margin-bottom: 1.5rem;"></i>
                    <h3 class="mb-4">AI Content Generation</h3>
                    <p class="text-muted">Scale your SEO and social media presence with high-quality, brand-aligned content generated through fine-tuned AI models.</p>
                </div>
                <div class="tech-card full-width-card" data-aos="fade-up" data-aos-delay="400">
                    <div>
                        <i class="fas fa-chart-line" style="font-size: 2.5rem; color: #f59e0b; margin-bottom: 1.5rem;"></i>
                        <h3 class="mb-4">AI Analytics & Insights</h3>
                        <p class="text-muted">Move beyond standard dashboards. Our AI parses through millions of data points to provide actionable text-based insights and next-step recommendations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Workflow -->
    <section class="py-20 workflow-section overflow-hidden">
        <div class="container">
            <h2 class="text-center mb-8" data-aos="fade-up">The AI Integration Process</h2>
            <div class="footer-grid">
                <div class="workflow-step" data-aos="fade-right" data-aos-delay="0">
                    <div class="workflow-line"></div>
                    <div class="workflow-icon"><i class="fas fa-database"></i></div>
                    <h4>1. Data Audit</h4>
                    <p class="text-muted small mt-4">Analyzing existing data infrastructure.</p>
                </div>
                <div class="workflow-step" data-aos="fade-right" data-aos-delay="100">
                    <div class="workflow-line"></div>
                    <div class="workflow-icon"><i class="fas fa-cogs"></i></div>
                    <h4>2. Model Training</h4>
                    <p class="text-muted small mt-4">Customizing AI to your brand voice.</p>
                </div>
                <div class="workflow-step" data-aos="fade-right" data-aos-delay="200">
                    <div class="workflow-line"></div>
                    <div class="workflow-icon"><i class="fas fa-rocket"></i></div>
                    <h4>3. Deployment</h4>
                    <p class="text-muted small mt-4">Seamless integration into funnels.</p>
                </div>
                <div class="workflow-step" data-aos="fade-right" data-aos-delay="300">
                    <div class="workflow-icon"><i class="fas fa-sync-alt"></i></div>
                    <h4>4. Optimization</h4>
                    <p class="text-muted small mt-4">Continuous learning and improvement.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quotation Form -->
    <section id="quote" class="py-20 overflow-hidden">
        <div class="container" style="max-width: 800px;">
            <div class="text-center mb-8" data-aos="fade-up">
                <h2 class="section-title">Get an AI Strategy Quote</h2>
                <p class="section-subtitle mx-auto">Fill out your requirements below and our intelligence engine will analyze your needs.</p>
            </div>
            
            <div class="tech-card" data-aos="fade-up">
                @if(isset($_GET['success']))
                    <div style="background: #10b981; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                        Your quotation request has been received. Our team will analyze it and reach out shortly.
                    </div>
                @endif

                <form action="{{ route('inquiry.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="service" value="ai">
                    <div class="grid-2-cols mb-4">
                        <div class="form-group">
                            <label class="form-label" style="color: #D1D5DB;">Full Name (Required)</label>
                            <input type="text" name="name" class="form-control" required style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.1);">
                        </div>
                        <div class="form-group">
                            <label class="form-label" style="color: #D1D5DB;">Email (Required)</label>
                            <input type="email" name="email" class="form-control" required style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.1);">
                        </div>
                    </div>

                    <div class="grid-2-cols mb-4">
                        <div class="form-group">
                            <label class="form-label" style="color: #D1D5DB;">WhatsApp Number (Required)</label>
                            <input type="tel" name="whatsapp" class="form-control" required style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.1);">
                        </div>
                        <div class="form-group">
                            <label class="form-label" style="color: #D1D5DB;">City</label>
                            <input type="text" name="city" class="form-control" style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.1);">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label" style="color: #D1D5DB;">Business Type</label>
                        <select name="business_type" class="form-control" style="background: #111827; color: white; border-color: rgba(255,255,255,0.1);">
                            <option value="">Select Business Type</option>
                            <option value="FMCG">FMCG</option>
                            <option value="Education">Education</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Retail">Retail</option>
                            <option value="Automobile">Automobile</option>
                            <option value="Technology">Technology</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label" style="color: #D1D5DB;">Target Audience</label>
                        <select name="target_audience" class="form-control" style="background: #111827; color: white; border-color: rgba(255,255,255,0.1);">
                            <option value="">Select Audience</option>
                            <option value="Students">Students</option>
                            <option value="Families">Families</option>
                            <option value="Professionals">Professionals</option>
                            <option value="Seniors">Seniors</option>
                            <option value="B2B">B2B</option>
                        </select>
                    </div>

                    <div class="form-group mb-8">
                        <label class="form-label" style="color: #D1D5DB;">Budget Range</label>
                        <select name="budget_range" class="form-control" style="background: #111827; color: white; border-color: rgba(255,255,255,0.1);">
                            <option value="">Select Budget</option>
                            <option value="Under 50k">Under 50k</option>
                            <option value="50k–1L">50k–1L</option>
                            <option value="1L–2.5L">1L–2.5L</option>
                            <option value="Above 2.5L">Above 2.5L</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-full" style="background: linear-gradient(135deg, #4f46e5, #ec4899); border: none;">Analyze & Submit Quotation <i class="fas fa-magic"></i></button>
                </form>
            </div>
        </div>
    </section>



@endsection
