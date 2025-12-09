<header class="page-hero" id="pageHero">
    <div class="overlay"></div>

    <div class="container text-center hero-content">
        <h1>{{ $title }}</h1>

        @isset($subtitle)
            <p class="subtitle">{{ $subtitle }}</p>
        @endisset
    </div>
</header>

<style>
    /* ===============================
   PAGE HERO / BREADCRUMB HEADER
   =============================== */

.page-hero {
    position: relative;
    padding: 100px 0 100px;
    color: #fff;
    background:
        linear-gradient(rgba(91, 0, 35, 0.5), rgba(38, 0, 15, 0.5)),
        url("/images/page-hero/scale-justice.jpg") center/cover no-repeat;
}

/* Optional collage on desktop only */
@media (min-width: 992px) {
    .page-hero{
        background: 
            linear-gradient(rgba(91, 0, 35, 0.78), rgba(38, 0, 15, 0.78)),
            url("{{asset('images/page-hero/scale-justice.jpg')}}") no-repeat;
            padding: 140px 0 60px 0;
        max-height: 500px;
    }
    
}

.page-hero .hero-content {
    position: relative;
    z-index: 2;
    animation: fadeUp .8s ease forwards;
}

.page-hero h1 {
    font-size: clamp(2rem, 4vw, 3.5rem);
    font-weight: 300;
    letter-spacing: 3px;
    text-transform: capitalize;
}

.page-hero .subtitle {
    margin-top: 15px;
    font-size: 1.2rem;
    opacity: .85;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>