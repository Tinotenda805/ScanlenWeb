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
            top: 0;
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
            font-size: 3rem;
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
            position: relative;
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
            font-size: 2.5rem;
            color: var(--maroon);
            font-weight: bold;
            margin-bottom: 20px;
            letter-spacing: 2px;
        }

        .decade-title {
            font-size: 1.8rem;
            color: var(--light-maroon);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .decade-description {
            font-size: 1.1rem;
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
            max-width: 700px;
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
            .header h1 {
                font-size: 2.5rem;
            }
            
            .timeline::before {
                left: 30px;
            }
            
            .decade {
                padding-left: 80px;
            }
            
            .decade-marker {
                left: 30px;
            }
            
            .decade-year {
                font-size: 2rem;
            }
            
            .decade-title {
                font-size: 1.5rem;
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
                    <li>Client-Centered Excellence</li>
                    <li>Ethical Leadership</li>
                    <li>Innovation & Adaptability</li>
                    <li>Community Partnership</li>
                    <li>Diversity & Inclusion</li>
                    <li>Professional Integrity</li>
                </ul>
            </div>
            
            
        </aside>

        <!-- History Timeline Section -->
        <main class="timeline-section">
            <div class="timeline-header">
                <h2>Our History</h2>
                <p>A journey of growth, innovation, and unwavering commitment to legal excellence</p>
            </div>

            <div class="timeline">
                
                <div class="decade">
                    <div class="decade-marker"></div>
                    <div class="decade-content">
                        <div class="decade-year">1980s</div>
                        <h3 class="decade-title">Foundation & Vision</h3>
                        <p class="decade-description">
                            Our firm was established with a clear mission: to provide exceptional legal counsel while building lasting relationships with our clients. Starting as a small practice, we focused on personal attention and innovative legal solutions.
                        </p>
                        <ul class="highlights">
                            <li>Founded by partners with Harvard Law School credentials</li>
                            <li>Established first office in downtown district</li>
                            <li>Won landmark commercial litigation case</li>
                            <li>Built reputation for corporate law expertise</li>
                        </ul>
                    </div>
                </div>

                <div class="decade">
                    <div class="decade-marker"></div>
                    <div class="decade-content">
                        <div class="decade-year">1990s</div>
                        <h3 class="decade-title">Growth & Recognition</h3>
                        <p class="decade-description">
                            The 1990s marked a period of significant expansion as we doubled our attorney count and expanded into new practice areas. Our commitment to excellence earned us recognition from peers and clients alike.
                        </p>
                        <ul class="highlights">
                            <li>Expanded to 25 attorneys across multiple specializations</li>
                            <li>Opened second office to serve growing client base</li>
                            <li>Received "Best Law Firm" award from state bar association</li>
                            <li>Launched pro bono initiative serving local community</li>
                        </ul>
                    </div>
                </div>

                <div class="decade">
                    <div class="decade-marker"></div>
                    <div class="decade-content">
                        <div class="decade-year">2000s</div>
                        <h3 class="decade-title">Innovation & Technology</h3>
                        <p class="decade-description">
                            Embracing the digital age, we invested heavily in legal technology and innovative practice methods. This decade saw us handling increasingly complex cases while maintaining our personal touch.
                        </p>
                        <ul class="highlights">
                            <li>Implemented cutting-edge case management systems</li>
                            <li>Achieved Martindale-Hubbell AV rating for all partners</li>
                            <li>Successfully represented Fortune 500 companies</li>
                            <li>Established intellectual property practice group</li>
                        </ul>
                    </div>
                </div>

                <div class="decade">
                    <div class="decade-marker"></div>
                    <div class="decade-content">
                        <div class="decade-year">2010s</div>
                        <h3 class="decade-title">National Presence</h3>
                        <p class="decade-description">
                            Our reputation for excellence attracted clients nationwide. We expanded our geographic footprint while deepening our expertise in emerging areas of law, particularly in technology and environmental sectors.
                        </p>
                        <ul class="highlights">
                            <li>Opened offices in three additional metropolitan areas</li>
                            <li>Launched environmental law and cybersecurity practices</li>
                            <li>Named to "Top 100 Law Firms" by Legal 500</li>
                            <li>Achieved carbon-neutral office operations</li>
                        </ul>
                    </div>
                </div>

                <div class="decade">
                    <div class="decade-marker"></div>
                    <div class="decade-content">
                        <div class="decade-year">2020s</div>
                        <h3 class="decade-title">Future-Forward Excellence</h3>
                        <p class="decade-description">
                            Adapting to a rapidly changing world, we've embraced remote capabilities, expanded our diversity initiatives, and continued to attract top legal talent. Our focus remains on delivering exceptional results for our clients.
                        </p>
                        <ul class="highlights">
                            <li>Seamlessly transitioned to hybrid work model</li>
                            <li>Achieved 40% diversity in attorney workforce</li>
                            <li>Launched AI-assisted legal research capabilities</li>
                            <li>Established scholarship fund for underrepresented law students</li>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Statistics Section -->
            <section class="stats-section">
                <div class="stats-container">
                    <div class="stat-item">
                        <div class="stat-number">40+</div>
                        <div class="stat-label">Years of Excellence</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">75+</div>
                        <div class="stat-label">Experienced Attorneys</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">5000+</div>
                        <div class="stat-label">Cases Successfully Resolved</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Practice Areas</div>
                    </div>
                </div>
            </section>
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