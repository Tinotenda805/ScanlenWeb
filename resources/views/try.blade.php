<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sterling & Associates - Premier Legal Counsel</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', serif;
            overflow-x: hidden;
            color: #1a1a1a;
        }

        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('../images/law.jpg');
            background-size: cover;
            background-position: center;
            z-index: -2;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            right: 0;
            width: 55%;
            height: 100%;
            background-image: var(--bg-image);
            background-size: cover;
            background-position: center left;
            z-index: -1;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, 
                rgba(250, 248, 246, 0.98) 0%,
                rgba(250, 248, 246, 0.95) 35%,
                rgba(250, 248, 246, 0.5) 50%,
                rgba(0, 0, 0, 0.05) 70%,
                rgba(0, 0, 0, 0) 100%);
            z-index: 0;
        }

        nav {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 1.5rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        nav.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            padding: 1rem 5%;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #8B6914;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
        }

        .nav-links a {
            color: #2c2c2c;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: color 0.3s;
            letter-spacing: 0.5px;
        }

        .nav-links a:hover {
            color: #8B6914;
        }

        .content {
            position: relative;
            z-index: 1;
            max-width: 650px;
            padding: 0 5% 0 8%;
            animation: fadeInUp 1s ease;
        }

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

        .eyebrow {
            color: #8B6914;
            font-size: 0.9rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        h1 {
            font-size: 4.5rem;
            line-height: 1.1;
            margin-bottom: 2rem;
            color: #1a1a1a;
            font-weight: 400;
        }

        .tagline {
            font-size: 1.3rem;
            line-height: 1.8;
            color: #4a4a4a;
            margin-bottom: 3rem;
            font-style: italic;
        }

        .cta-group {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 4rem;
        }

        .btn {
            padding: 1rem 2.5rem;
            text-decoration: none;
            font-size: 1rem;
            border-radius: 2px;
            transition: all 0.3s ease;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 0.85rem;
            cursor: pointer;
        }

        .btn-primary {
            background: #8B6914;
            color: white;
            box-shadow: 0 4px 15px rgba(139, 105, 20, 0.3);
        }

        .btn-primary:hover {
            background: #6d5210;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 105, 20, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: #2c2c2c;
            border: 2px solid #2c2c2c;
        }

        .btn-secondary:hover {
            background: #2c2c2c;
            color: white;
            transform: translateY(-2px);
        }

        .stats {
            display: flex;
            gap: 3rem;
        }

        .stat {
            border-left: 3px solid #8B6914;
            padding-left: 1.5rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #8B6914;
            margin-bottom: 0.3rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 3rem;
            left: 8%;
            z-index: 1;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        .scroll-indicator span {
            display: block;
            width: 2px;
            height: 40px;
            background: #8B6914;
            margin: 0 auto 0.5rem;
        }

        .scroll-text {
            font-size: 0.75rem;
            color: #666;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            h1 {
                font-size: 2.5rem;
            }

            .tagline {
                font-size: 1.1rem;
            }

            .content {
                padding: 0 5%;
            }

            .cta-group {
                flex-direction: column;
            }

            .stats {
                flex-direction: column;
                gap: 2rem;
            }

            .hero-bg {
                width: 100%;
                opacity: 0.3;
            }

            .hero-overlay {
                background: linear-gradient(to bottom,
                    rgba(250, 248, 246, 0.95) 0%,
                    rgba(250, 248, 246, 0.85) 100%);
            }
        }
    </style>
</head>
<body>
    <nav id="navbar">
        <div class="logo">STERLING & ASSOCIATES</div>
        <ul class="nav-links">
            <li><a href="#about">About</a></li>
            <li><a href="#practice">Practice Areas</a></li>
            <li><a href="#team">Our Team</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>

    <section class="hero">
        <div class="hero-bg" id="heroBg"></div>
        <div class="hero-overlay"></div>
        
        <div class="content">
            <div class="eyebrow">Established 1987</div>
            <h1>Justice Through Excellence</h1>
            <p class="tagline">Where integrity meets expertise. Defending your rights with unwavering commitment and three decades of legal mastery.</p>
            
            <div class="cta-group">
                <a href="#consultation" class="btn btn-primary">Free Consultation</a>
                <a href="#cases" class="btn btn-secondary">Our Cases</a>
            </div>

            <div class="stats">
                <div class="stat">
                    <div class="stat-number">2,500+</div>
                    <div class="stat-label">Cases Won</div>
                </div>
                <div class="stat">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Success Rate</div>
                </div>
                <div class="stat">
                    <div class="stat-number">35+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
            </div>
        </div>

        <div class="scroll-indicator">
            <span></span>
            <div class="scroll-text">Scroll</div>
        </div>
    </section>

    <script>
        // Convert the uploaded image to base64 and set as background
        const img = new Image();
        img.crossOrigin = "anonymous";
        img.onload = function() {
            const canvas = document.createElement('canvas');
            canvas.width = img.width;
            canvas.height = img.height;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0);
            const dataURL = canvas.toDataURL('image/jpeg');
            document.getElementById('heroBg').style.backgroundImage = `url('${dataURL}')`;
        };
        
        // For demo purposes, we'll use a gradient placeholder
        // In real implementation, you'd set the actual image here
        document.getElementById('heroBg').style.backgroundImage = 
            'linear-gradient(135deg, #d4a574 0%, #b8935f 50%, #8B6914 100%)';

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>