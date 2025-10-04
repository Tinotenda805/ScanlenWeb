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
            justify-content: space-between; /* info left, image right */
            align-items: flex-end; /* align both to bottom */
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
            transform: translateY(40px); /* make it “sit” below the header a bit */
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            transition: transform 0.3s ease;
        }

        .profile-image:hover {
            transform: translateY(40px) scale(1.05);
        }

        .header-info {
            padding-bottom: 1.5rem; /* space from bottom */
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

        .section h2 {
            font-size: 1.8rem;
            color: var(--maroon);
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section h2::after {
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
            /* justify-content: space-between; */
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
            padding: 1.5rem;
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

        /* insights */
        .insights-flex{
            display: flex;
            max-height: 100px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            padding: 10px;
            margin-bottom: 10px;
            border-radius:20px 0px 20px 0;
        }

        .insights-flex:hover{
            cursor: pointer;
        }

        .insights-flex .insight-img img{
            width: 80px;
            height:80px;
            /* margin-right: 20px; */
            object-fit: fill;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }
        .insights-flex:hover .insight-img img{
            transform: translateY(2px) scale(1.05);
        }
        .insights-flex:hover .insight-title{
            text-decoration: underline;
        }
        
        .insights-flex .insight-info{
            padding: 10px
        }

        .insights-flex .insight-info .insight-date{
            color: var(--dark-gray)
        }
        .insights-flex .insight-info .insight-title{
            color: black;
            padding-top:5px;
            font-weight: 400;
        }
       
        .cta-section {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 3rem;
            text-align: center;
            margin-top: 3rem;
        }

        .cta-section h3 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            font-weight: 300;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: white;
            color: #2a5298;
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        @media (max-width: 768px) {
            .header-content {
                /* grid-template-columns: 1fr; */
                text-align: start;
                /* gap: 2rem; */
                display: inline;
            }

            .overview-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 2rem;
            }

            .header-info h1 {
                font-size: 2rem;
            }

            .contact-info{
                display: inline;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>

    <!-- Header Section -->
    <div class="header">
        <div class="header-content">
            <div class="header-info">
                <h1 class="text-uppercase bolder">Sarah Mitchell</h1>
                <div class="position">Senior Partner & Head of Corporate Law</div>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="bi bi-envelope-at me-2"></i> sarah.mitchell@lawfirm.com
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-telephone me-2"></i> +1 (555) 123-4567
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-geo-alt me-2"></i> Harare, ZW
                    </div>
                </div>
                <div class="team-icons mt-3 ">
                    <a class="rounded btn btn-maroon me-3" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="rounded btn btn-maroon me-3" href=""><i class="fab fa-twitter"></i></a>
                    <a class="rounded btn btn-maroon me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="rounded btn btn-maroon me-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <img src="{{asset('images/9.jpeg')}}" alt="Sarah Mitchell" class="profile-image">
        </div>
    </div>
    <div class="container">

        <!-- Content Section -->
        <div class="content">
            <!-- Profile Overview -->
            <div class="section">
                <h2>Profile Overview</h2>
                <div class="overview-grid">
                    <div class="overview-text">
                        Sarah Mitchell is a distinguished Senior Partner with over 15 years of experience in corporate law and mergers & acquisitions. 
                        She has successfully guided Fortune 500 companies through complex transactions worth over $2 billion, establishing herself as one 
                        of the leading corporate attorneys in the region. Sarah's strategic approach combines deep legal expertise with practical 
                        business acumen, making her a trusted advisor to CEOs and boards of directors across various industries.
                        
                        <br><br>Known for her meticulous attention to detail and innovative problem-solving abilities, Sarah has been instrumental in 
                        structuring some of the most complex deals in the technology and healthcare sectors. Her client-focused approach and commitment 
                        to excellence have earned her recognition from leading legal publications and peer organizations.
                    </div>
                    <div class="quick-facts">
                        <h3>Quick Facts</h3>
                        <div class="fact-item">
                            <span class="me-2">Years of Experience:</span>
                            <strong>15+ Years</strong>
                        </div>
                        <div class="fact-item">
                            <span class="me-2">Deals Completed:</span>
                            <strong>200+</strong>
                        </div>
                        <div class="fact-item">
                            <span class="me-2">Languages:</span>
                            <strong>English, Shona, Ndebele</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Areas of Expertise -->
            <div class="section">
                <h2>Areas of Expertise</h2>
                <div class="expertise-grid">
                    <div class="expertise-item">
                        <h4>Mergers & Acquisitions</h4>
                        <p>Complex M&A transactions, due diligence, and strategic corporate restructuring for mid-market to large enterprises.</p>
                    </div>
                    <div class="expertise-item">
                        <h4>Corporate Governance</h4>
                        <p>Board advisory services, compliance frameworks, and corporate governance best practices implementation.</p>
                    </div>
                    
                </div>
            </div>

            <!-- Experience -->
            <div class="section">
                <h2>Professional Experience</h2>
                <div class="experience-timeline">
                    <div class="timeline-item">
                        <div class="timeline-date">2018 - Present</div>
                        <div class="timeline-role">Senior Partner & Head of Corporate Law</div>
                        <div class="timeline-company">Mitchell & Associates LLP</div>
                        <p>Leading the corporate practice group with responsibility for major client relationships and strategic initiatives. Spearheading the firm's expansion into emerging markets.</p>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-date">2014 - 2018</div>
                        <div class="timeline-role">Partner</div>
                        <div class="timeline-company">Mitchell & Associates LLP</div>
                        <p>Promoted to partner with focus on M&A transactions and securities offerings. Built specialized practice in technology sector deals.</p>
                    </div>
                    
                </div>
            </div>

            <!-- Qualifications -->
            <div class="section">
                <h2>Qualifications & Education</h2>
                <div class="qualifications-list">
                    <div class="qualification-item">
                        <h4>Juris Doctor (J.D.)</h4>
                        <p><strong>Harvard Law School</strong><br>
                        Magna Cum Laude, Harvard Law Review<br>
                        Class of 2007</p>
                    </div>
                    <div class="qualification-item">
                        <h4>Master of Business Administration (MBA)</h4>
                        <p><strong>Wharton School, University of Pennsylvania</strong><br>
                        Finance Concentration<br>
                        Class of 2005</p>
                    </div>
                    <div class="qualification-item">
                        <h4>Bachelor of Arts (B.A.)</h4>
                        <p><strong>Yale University</strong><br>
                        Economics Major, Phi Beta Kappa<br>
                        Class of 2003</p>
                    </div>
                    <div class="qualification-item">
                        <h4>Professional Certifications</h4>
                        <p>• Certified M&A Advisor (CM&AA)<br>
                        • New York State Bar Association<br>
                        • American Bar Association Member</p>
                    </div>
                </div>
            </div>

            <!-- Recent Insights -->
            <div class="section">
                <h2>Recent Insights & Publications</h2>
                <ol type="1">
                    <li>
                    <div class="insights-flex">
                        <div class="insight-img">
                            <img src="{{asset('images/8.jpeg')}}" class="fluid-img" alt="">
                        </div>
                        <div class="insight-info">
                            <span class="insight-date"> <i class="bi bi-calendar-check-fill me-2"></i> August 2023</span>
                            <h3 class="insight-title">Navigating ESG Compliance in M&A Transactions</h3>
                        </div>
                    </div>
                    </li>
                    <li>
                    <div class="insights-flex">
                        <div class="insight-img">
                            <img src="{{asset('images/5.jpeg')}}" class="fluid-img" alt="">
                        </div>
                        <div class="insight-info">
                            <span class="insight-date"> <i class="bi bi-calendar-check-fill me-2"></i> September 2025</span>
                            <h3 class="insight-title">Legal Frameworks for Digital Assets and Blockchain</h3>
                        </div>
                    </div>
                    </li>
                </ol>
            </div>
        </div>

    </div>
@endsection