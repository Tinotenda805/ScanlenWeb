{{-- resources/views/our-people/partner.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    :root {
        --maroon: #3c0008;
        --light-maroon: #50010b;
        --white: #ffffff;
        --light-gray: #f8f9fa;
        --dark-gray: #343a40;
        --gold: #d4af37;
    }

    .header {
        background: linear-gradient(135deg, #f8f9fa 0%, #343434 100%);
        color: black;
        position: relative;
        overflow: hidden;
        min-height: 350px;
        display: flex;
        align-items: flex-end;
    }

    .header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 100%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        position: relative;
        z-index: 2;
    }

    .profile-image {
        width: 320px;
        height: 320px;
        object-fit: cover;
        border-radius: 4px;
        transform: translateY(40px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        transition: transform 0.3s ease;
    }

    .profile-image:hover {
        transform: translateY(40px) scale(1.05);
    }

    .header-info {
        padding-bottom: 1.5rem;
    }

    .header-info h1 {
        font-size: 3rem;
        font-weight: 300;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .position {
        font-size: 1.3rem;
        opacity: 0.9;
        margin-bottom: 1rem;
        font-weight: 300;
    }

    .contact-info {
        display: flex;
        gap: 2rem;
        margin-top: 1.5rem;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        opacity: 0.9;
        transition: opacity 0.3s ease;
    }

    .contact-item:hover {
        opacity: 1;
    }

    .content {
        padding: 3rem;
    }

    .section {
        margin-bottom: 3rem;
        opacity: 0;
        animation: fadeInUp 0.8s ease forwards;
    }

    .section:nth-child(1) { animation-delay: 0.2s; }
    .section:nth-child(2) { animation-delay: 0.4s; }
    .section:nth-child(3) { animation-delay: 0.6s; }
    .section:nth-child(4) { animation-delay: 0.8s; }
    .section:nth-child(5) { animation-delay: 1s; }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .section .overview {
        font-size: 1.8rem;
        color: var(--maroon);
        margin-bottom: 1rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .section h2, h3 {
        font-size: 1.2rem;
        color: #000;
    }

    .section .overview::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(135deg, #50010b 0%, #3c0008 100%);
        border-radius: 2px;
    }

    .overview-grid {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 3rem;
        align-items: start;
    }

    .overview-text {
        font-size: 1.1rem;
        color: #555;
        line-height: 1.8;
    }

    .quick-facts {
        background: linear-gradient(135deg, #f8f9ff 0%, #e8f0ff 100%);
        padding: 2rem;
        border-radius: 15px;
        border-left: 4px solid #3c0008;
    }

    .quick-facts h3 {
        color: #3c0008;
        margin-bottom: 1rem;
        font-size: 1.2rem;
    }

    .fact-item {
        display: flex;
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(42, 82, 152, 0.1);
    }

    .fact-item:last-child {
        border-bottom: none;
    }

    .expertise-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .expertise-item {
        background: white;
        padding: 0.5rem;
        border-radius: 10px;
        border: 1px solid #ccc9ca;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .expertise-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.15);
        border-color: #3c0008;
    }

    .expertise-item h4 {
        color: var(--light-maroon);
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .experience-timeline {
        position: relative;
        padding-left: 2rem;
    }

    .experience-timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        height: 100%;
        width: 2px;
        background: linear-gradient(180deg, #3c0008 0%, #764ba2 100%);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
        padding-left: 2rem;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -8px;
        top: 5px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #667eea;
        border: 3px solid white;
        box-shadow: 0 0 0 3px #3c0008;
    }

    .timeline-date {
        color: #667eea;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .timeline-role {
        font-weight: 600;
        color: #333;
        margin: 0.3rem 0;
    }

    .timeline-company {
        color: #2a5298;
        font-weight: 500;
    }

    .qualifications-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
    }

    .qualification-item {
        background: linear-gradient(135deg, #f8f9ff 0%, #e8f0ff 100%);
        padding: 1.5rem;
        border-radius: 10px;
        border-left: 4px solid #3c0008;
    }

    .insights-flex {
        display: flex;
        max-height: 100px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 20px 0px 20px 0;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .insights-flex:hover {
        cursor: pointer;
        transform: translateX(5px);
    }

    .insights-flex .insight-img img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .insights-flex:hover .insight-img img {
        transform: translateY(2px) scale(1.05);
    }

    .insights-flex:hover .insight-title {
        text-decoration: underline;
    }

    .insights-flex .insight-info {
        padding: 10px;
    }

    .insights-flex .insight-info .insight-date {
        color: var(--dark-gray);
        font-size: 0.85rem;
    }

    .insights-flex .insight-info .insight-title {
        color: black;
        padding-top: 5px;
        font-weight: 400;
    }

    /* Responsive */
    @media (max-width: 468px) {
        .header-content {
            display: block;
            text-align: center;
            padding-top: 10px;
        }

        .profile-image {
            width: 200px;
            height: 200px;
            margin: 0 auto 20px;
        }

        .team-icons .btn {
            padding: 8px;
            width: 40px;
        }

        .overview-grid {
            grid-template-columns: 1fr;
        }

        .content {
            padding: 2rem 1rem;
        }

        .header-info h1 {
            font-size: 2rem;
        }

        .contact-info {
            display: block;
        }
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .profile-image {
            margin: 0 auto 20px;
            /* transform: translateY(0); */
        }

        .overview-grid {
            grid-template-columns: 1fr;
        }

        .content {
            padding: 2rem;
        }

        .header-info{
            justify-content: start;
            text-align: start;
        }
        .header-info h1 {
            font-size: 1.5rem;
            
        }

        .contact-info {
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>

<!-- Header Section -->
<div class="header">
    <div class="header-content">
        <div class="header-info">
            <h1 class="text-uppercase bolder">{{ $person->name }}</h1>
            <div class="position">{{ $person->designation }}</div>
            <div class="contact-info">
                @if($person->email)
                <div class="contact-item">
                    <i class="bi bi-envelope-at me-2"></i> {{ $person->email }}
                </div>
                @endif
                @if($person->phone)
                <div class="contact-item">
                    <i class="bi bi-telephone me-2"></i> {{ $person->phone }}
                </div>
                @endif
                <div class="contact-item">
                    <i class="bi bi-geo-alt me-2"></i> {{ $person->location }}
                </div>
            </div>
            <div class="team-icons mt-3">
                @if($person->email)
                <a class="rounded btn btn-maroon me-3" href="mailto:{{ $person->email }}">
                    <i class="fas fa-envelope"></i>
                </a>
                @endif
                @if($person->linkedin_url)
                <a class="rounded btn btn-maroon me-3" href="{{ $person->linkedin_url }}" target="_blank">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                @endif
                @if($person->whatsapp_link)
                <a class="rounded btn btn-maroon me-3" href="{{ $person->whatsapp_link }}" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                </a>
                @endif
                @if($person->phone)
                <a class="rounded btn btn-maroon me-0" href="tel:{{ $person->phone }}">
                    <i class="fas fa-phone"></i>
                </a>
                @endif
            </div>
        </div>
        <img src="{{ $person->avatar_url }}" alt="{{ $person->name }}" class="profile-image">
    </div>
</div>

<div class="container">
    <div class="content">
        <!-- Profile Overview -->
        @if($person->profile_overview)
        <div class="section">
            <h2 class="overview">Profile Overview</h2>
            <div class="overview-grid">
                <div class="overview-text">
                    {!! $person->profile_overview !!}
                    {{-- {!! nl2br(e($person->profile_overview)) !!} --}}
                </div>
                <div class="quick-facts">
                    <h3>Quick Facts</h3>
                    @if($person->years_of_experience)
                    <div class="fact-item">
                        <span class="me-2">Years of Experience:</span>
                        <strong>{{ $person->years_of_experience }}+ Years</strong>
                    </div>
                    @endif
                    @if($person->deals_completed)
                    <div class="fact-item">
                        <span class="me-2">Deals Completed:</span>
                        <strong>{{ $person->deals_completed }}+</strong>
                    </div>
                    @endif
                    @if($person->languages)
                    <div class="fact-item">
                        <span class="me-2">Languages:</span>
                        <strong>{{ $person->languages }}</strong>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Areas of Expertise -->
        @if($person->expertise && count($person->expertise) > 0)
        <div class="section">
            <h2>Areas of Expertise</h2>
            <div class="expertise-grid">
                @foreach($person->expertise as $expertise)
                <div class="expertise-item">
                    <div class="d-flex">
                        <img src="{{ $expertise->image_url }}" alt="{{ $expertise->name }}" class="image-fluid rounded-circle me-2 mb-2" width="60">
                        <h4>{{ $expertise->name ?? '' }}</h4>
                    </div>
                    <p>{{ $expertise->short_description ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Professional Experience -->
        @if($person->professional_experience && count($person->professional_experience) > 0)
        <div class="section">
            <h2>Professional Experience</h2>
            <div class="experience-timeline">
                @foreach($person->professional_experience as $experience)
                <div class="timeline-item">
                    <div class="timeline-date">{{ $experience['period'] ?? '' }}</div>
                    <div class="timeline-role">{{ $experience['role'] ?? '' }}</div>
                    <div class="timeline-company">{{ $experience['company'] ?? '' }}</div>
                    <p>{{ $experience['description'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Qualifications -->
        @if($person->qualifications && count($person->qualifications) > 0)
        <div class="section">
            <h2>Qualifications & Education</h2>
            <div class="qualifications-list">
                @foreach($person->qualifications as $qualification)
                <div class="qualification-item">
                    <h4>{{ $qualification['title'] ?? '' }}</h4>
                    <p>
                        @if(isset($qualification['institution']))
                            <strong>{{ $qualification['institution'] }}</strong><br>
                        @endif
                        @if(isset($qualification['details']))
                            {{ $qualification['details'] }}<br>
                        @endif
                        @if(isset($qualification['year']))
                            {{ $qualification['year'] }}
                        @endif
                    </p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Recent Insights -->
        @if($person->recent_insights && $person->recent_insights->count() > 0)
        <div class="section">
            <h2>Recent Insights & Publications</h2>
            @foreach($person->recent_insights as $insight)
            <a href="{{ route('articles.show', $insight) }}" 
               class="insights-flex">
                <div class="insight-img">
                    <img src="{{ $insight->featured_image ? asset('storage/' . $insight->featured_image) : asset('images/default-article.jpg') }}" 
                         alt="{{ $insight->title }}">
                </div>
                <div class="insight-info">
                    <div class="insight-date">{{ $insight->created_at->format('M d, Y') }}</div>
                    <div class="insight-title">{{ $insight->title }}</div>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection