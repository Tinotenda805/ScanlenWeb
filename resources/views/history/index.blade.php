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

            --new-maroon:#861043;
        }
        /* Main Content Layout */
        .maincontent {
            display: flex;
            /* max-width: 1400px; */
            margin: 0 auto;
            min-height: 100vh;
            gap: 0;
        }

        /* Who We Are Sidebar */
        .sidebar {
            /* width: 20%; */
            max-width: 500px;
            background: linear-gradient(180deg, #3c0008 0%, #50010b 100%);
            color: white;
            padding: 60px 5px;
            position: sticky;
            top: 60px;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar h2 {
            font-size: 2rem;
            margin-bottom: 30px;
            color: #ecf0f1;
            border-bottom: 3px solid var(--light-gray);
            padding-bottom: 15px;
            font-weight: 400;
        }

        .firm-description {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 40px;
            color: #bdc3c7;
        }

        .values-section h3 {
            font-size: 1.4rem;
            color: var(--light-gray);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .values-list {
            list-style: none;
            padding: 0;
        }

        .values-list li {
            margin-bottom: 15px;
            padding-left: 25px;
            position: relative;
            color: #ecf0f1;
            font-size: 1rem;
        }

        .values-list li::before {
            content: '▸';
            position: absolute;
            left: 0;
            color: var(--gold);
            font-weight: bold;
        }

        /* History Timeline Section */
        .timeline-section {
            /* width: 80%; */
            background: white;
            padding: 60px 5px;
        }

        .timeline-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .timeline-header h2 {
            /* font-size: 3rem; */
            font-size: clamp(2rem, 4vw, 3rem);
            color: #000;
            margin-bottom: 20px;
            font-weight: 300;
        }

        .timeline-header p {
            font-size: 1.2rem;
            color: #5a6c7d;
            max-width: 600px;
            margin: 0 auto;
        }

        .timeline {
            position: relative;
            /* max-width: 900px; */
            margin: 0 auto;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 40px;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #3c0008, #3c0008);
            border-radius: 2px;
            box-shadow: 0 0 20px rgba(30, 60, 114, 0.3);
        }

        .decade {
            position: relative;
            margin-bottom: 80px;
            padding-left: 100px;
            padding-right: 50px;
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .decade.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .decade-marker {
            position: absolute;
            left: 40px;
            top: 30px;
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #3c0008, #343a40);
            border: 5px solid white;
            border-radius: 50%;
            transform: translateX(-50%);
            box-shadow: 0 0 20px rgba(30, 60, 114, 0.4);
            z-index: 2;
        }

        .decade-content {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e6ed;
            /* position: relative; */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .decade-content:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
        }

        .decade-content::after {
            content: '';
            position: absolute;
            left: -15px;
            top: 40px;
            width: 0;
            height: 0;
            border: 15px solid transparent;
            border-right-color: white;
        }

        .decade-year {
            /* font-size: 2.5rem; */
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            color: var(--maroon);
            font-weight: bold;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .decade-title {
            font-size: 1.8rem;
            /* font-size: clamp(1.3rem, 2.5vw, 1.8rem); */
            color: var(--light-maroon);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .decade-image {
            margin: 1.5rem 0;
            border-radius: 8px;
            overflow: hidden;
        }

        .decade-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .decade-description {
            /* font-size: 1.1rem; */
            font-size: 1rem;
            color: #5a6c7d;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .highlights {
            list-style: none;
            padding: 0;
        }

        .highlights li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 12px;
            color: #4a5568;
            font-size: 1rem;
        }

        .highlights li::before {
            content: '⚖️';
            position: absolute;
            left: 0;
            top: 0;
        }

        /* Statistics Section */
        .stats-section {
            background: linear-gradient(135deg, #f1f3f4 0%, #e8eaf6 100%);
            padding: 60px;
            margin-top: 60px;
            border-radius: 15px;
            text-align: center;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 30px;
            /* max-width: 700px; */
            margin: 0 auto;
        }

        .stat-item {
            background: white;
            padding: 30px 20px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--maroon);
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 1rem;
            color: #5a6c7d;
            font-weight: 500;
        }

        .stat-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--new-maroon);
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .maincontent {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 10px;
            }
            
            .timeline-section {
                width: 100%;
                padding: 10px 2px;
            }
            .decade-marker {
                left: 10px;
                top: 30px;
                width: 20px;
                height: 20px;
            }
            .decade-content {
                padding: 10px;
                border-radius: 15px;
            }
            .decade-content::after {
                left: -10px;
                border: 10px solid transparent;
            }
            .decade {
                margin-bottom: 20px;
                padding-left: 10px;
                padding-right: 10px;
            }
        }

        @media (max-width: 768px) {
            .timeline-header p {
                text-align: justify;
            }
            .timeline-section{
                margin-top: 60px;
            }
            .header h1 {
                font-size: 2.5rem;
            }
            
            .timeline::before {
                /* display: none; */
                left: 10px;
            }
            
            .decade {
                padding-left: 20px;
            }
            
            .decade-marker {
                left: 10px;
                /* top: 30px; */
                width: 15px;
                height: 15px;
                border: 3px solid var(--maroon);
                background: var(--white);
            }
            
            .decade-year {
                font-size: 2rem;
            }
            
            .decade-title {
                font-size: 1.5rem;
            }
            .decade-content::after {
                display: none;
            }
        }

        html {
            scroll-behavior: smooth;
        }
    </style>


    @include('layouts.page-header')

    <div class="maincontent">
        <!-- Who We Are Sidebar -->
        <aside class="sidebar px-5">
            <h2>Who We Are</h2>
            
            <div class="firm-description">
                Scanlen and Holderness is a premier law firm dedicated to delivering exceptional legal services with integrity, innovation, and unwavering commitment to our clients' success.
            </div>
            
            <div class="values-section">
                <h3>Our Values</h3>
                <ul class="values-list">
                    <li>Integrity</li>
                    <li>Excellence</li>
                    <li>Respect</li>
                    <li>Innovation</li>
                </ul>
            </div>
            
            
        </aside>

        <!-- History Timeline Section -->
        <main class="timeline-section">
            <div class="timeline-header ">
                <h2 class="fw-bolder">Our Journey</h2>
                <p>A journey of growth, innovation, and unwavering commitment to legal excellence</p>
            </div>

            <div class="timeline">
                
                @foreach($timelines as $timeline)
                    <div class="decade">
                        <div class="decade-marker"></div>
                        <div class="decade-content">
                            <div class="decade-year">{{ $timeline->decade }}</div>
                            <h3 class="decade-title">{{ $timeline->title }}</h3>
                            
                            @if($timeline->image)
                            <div class="decade-image img-fluid img-thumbnail">
                                <img src="{{ $timeline->image_url }}" alt="{{ $timeline->decade }}">
                            </div>
                            @endif

                            <p class="decade-description fs-5 lh-base justify-info">
                                {!! $timeline->description !!}
                            </p>

                            @if($timeline->highlights && count($timeline->highlights) > 0)
                            <ul class="highlights">
                                @foreach($timeline->highlights as $highlight)
                                    <li>{{ $highlight }}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Statistics Section -->
            @if($statistics->count() > 0)
                <section class="stats-section">
                    <div class="stats-container">
                        @foreach($statistics as $stat)
                        <div class="stat-item">
                            @if($stat->icon)
                                <div class="stat-icon">
                                    <i class="{{ $stat->icon }}"></i>
                                </div>
                            @endif
                            <div class="stat-number">{{ $stat->value }}</div>
                            <div class="stat-label">{{ $stat->label }}</div>
                        </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </main>
    </div>

    <script>
        // Intersection Observer for timeline animations
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, index * 200);
                }
            });
        }, observerOptions);

        // Observe all decade elements
        document.querySelectorAll('.decade').forEach(decade => {
            observer.observe(decade);
        });

        // Animate statistics on scroll
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const number = entry.target.querySelector('.stat-number');
                    const finalValue = parseInt(number.textContent);
                    const suffix = number.textContent.replace(/[0-9]/g, '');
                    
                    let current = 0;
                    const increment = finalValue / 50;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= finalValue) {
                            number.textContent = finalValue + suffix;
                            clearInterval(timer);
                        } else {
                            number.textContent = Math.floor(current) + suffix;
                        }
                    }, 30);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.stat-item').forEach(stat => {
            statsObserver.observe(stat);
        });
    </script>

@endsection