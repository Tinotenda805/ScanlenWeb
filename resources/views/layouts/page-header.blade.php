<header class="header bg-breadcrumb" id="heroHeader">
    <div class="header-content">
        <h1></h1>
        {{-- <h1>{{$title ?? 'Scanlen & Holderness'}}</h1> --}}
    </div>
</header>

<style>
/* ==========================
   Mobile-first (≤767px)
========================== */
.bg-breadcrumb {
    position: relative;
    overflow: hidden;
    background: 
        linear-gradient(rgba(58, 1, 23, 0.636), rgba(58, 1, 23, 0.636)),
        url("{{ asset('images/oldpartners/scanlen.jpeg') }}") center/280px no-repeat;
    /* background-color: rgba(128,1,50,0.692); */
    min-height: 400px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 140px 0 140px 0;
    text-align: center;
}

.header {
    color: white;
    position: relative;
}

.header-content {
    margin: 0;
    transform: none;
}

.header-content h1 {
    font-size: 1.8rem;
    font-weight: 400;
    letter-spacing: 2px;
    line-height: 1.4;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    margin: 0;
    /* color: #000; */
}

/* Optional subtle mobile animation */
.header.loaded .header-content {
    animation: fadeInUpMobile 0.6s ease-out;
}

@keyframes fadeInUpMobile {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ==========================
   Tablet (768px – 992px)
========================== */
@media (min-width: 768px) and (max-width: 1199px) {
    .bg-breadcrumb {
        justify-content: center;
        align-items: center;
        background:
            url("{{ asset('images/oldpartners/scanlen.jpeg') }}") center 90%/160px no-repeat,

            url("{{ asset('images/oldpartners/op1.jpeg') }}") 1% 10%/140px no-repeat,
            url("{{ asset('images/oldpartners/op2.jpeg') }}") 25% 70%/140px no-repeat,
            url("{{ asset('images/oldpartners/op3.jpeg') }}") 75% 70%/140px no-repeat,
            url("{{ asset('images/oldpartners/op4.jpeg') }}") 99% 10%/140px no-repeat;
        background-color: rgba(71, 71, 71, 0.58);
        background-blend-mode: multiply;
        min-height: auto;
        padding: 140px 0 140px 0;
    }

    .header-content {
        margin: 60px; 
        transform: none;
    }

    .header-content h1 {
        font-size: clamp(1.8rem, 2.5vw, 2.2rem);
        letter-spacing: 2.5px;
    }
}

/* ==========================
   Desktop (≥993px)
========================== */
@media (min-width: 1200px) {
    .bg-breadcrumb {
        justify-content: center;
        align-items: center;
        background:
            url("{{ asset('images/oldpartners/scanlen.jpeg') }}") center 90%/160px 180px no-repeat,
            url("{{ asset('images/oldpartners/op1.jpeg') }}") 16% 40%/160px 180px no-repeat,
            url("{{ asset('images/oldpartners/op2.jpeg') }}") 32% 80%/160px 180px no-repeat,
            url("{{ asset('images/oldpartners/op3.jpeg') }}") 1% 10%/160px 180px no-repeat,
            url("{{ asset('images/oldpartners/op4.jpeg') }}") 99% 10%/160px 180px no-repeat,
            url("{{ asset('images/oldpartners/op5.jpeg') }}") 84% 40%/160px 180px no-repeat,
            url("{{ asset('images/oldpartners/op6.jpeg') }}") 68% 80%/160px 180px no-repeat;
        background-color: rgba(71, 71, 71, 0.58);
        background-blend-mode: multiply;
        min-height: auto;
        padding: 140px 0 140px 0;
    }

    .header-content {
        margin: 60px;
        transform: none;
    }

    .header-content h1 {
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        letter-spacing: 3px;
        color: #000;
    }
}
</style>
