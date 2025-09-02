<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Law Firm — Our Team (Professional Spotlight)</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  :root{
    --accent: #00b4b6;
    --bg-start: #42002e;
    --bg-end: #3d002a;
    --muted: rgba(255,255,255,0.78);
  }
  html,body{height:100%;margin:0;font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial;}
  .split{min-height:100vh;display:flex;background:linear-gradient(135deg,var(--bg-start),var(--bg-end));color:#fff;}
  .left{flex:1;display:flex;align-items:center;padding:3rem;}
  .right{flex:1;display:flex;align-items:center;justify-content:center;padding:2rem;}
  .content{max-width:680px;}
  h1{font-weight:600}
  .thumbs{display:flex;flex-direction:column;gap:16px;margin-right:28px;align-items:center;}
  .thumb{
    width:64px;height:64px;border-radius:50%;overflow:hidden;border:2px solid rgba(255,255,255,0.12);
    display:flex;align-items:center;justify-content:center;background:#fff1;border-radius:50%;
    box-shadow:0 6px 18px rgba(0,0,0,0.35);
    transition:transform .25s, box-shadow .25s, border-color .25s; cursor:pointer;
    outline:none;
  }
  .thumb:focus,.thumb:hover{transform:translateY(-4px);border-color:var(--accent);box-shadow:0 12px 30px rgba(0,0,0,0.5)}
  .thumb img{width:100%;height:100%;object-fit:cover;display:block}

  .spotlight {
    display:flex;align-items:center;gap:22px;
    max-width:640px;background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
    border-radius:14px;padding:22px;border:1px solid rgba(255,255,255,0.04);
    box-shadow: 0 18px 50px rgba(2,6,23,0.6);
  }

  .portrait {
    width:160px;height:160px;border-radius:50%;overflow:hidden;flex:0 0 160px;border:4px solid rgba(255,255,255,0.9);
    display:flex;align-items:center;justify-content:center;background:linear-gradient(180deg,#e9eef8, #dfe7f6);
  }
  .portrait img{width:100%;height:100%;object-fit:cover;display:block}

  .info{color:var(--muted);max-width:420px}
  .info h4{margin:0;color:#fff;font-weight:600}
  .info p.title{margin:4px 0 10px;color:rgba(255,255,255,0.86);font-size:.95rem}
  .info p.bio{margin:0;font-size:.92rem;line-height:1.36;color:rgba(255,255,255,0.78)}

  /* fade animation */
  .slide { position:relative; }
  .slide .fade-wrap { position:relative; min-height:140px; }
  .fade-item {
    position:absolute; inset:0; opacity:0; transform:translateY(6px); transition: opacity 520ms ease, transform 520ms ease;
  }
  .fade-item.active { opacity:1; transform:translateY(0); position:static; }

  /* initials fallback */
  .initials { font-weight:700;color:#123; font-size:36px; }

  /* responsive */
  @media (max-width: 900px) {
    .split{flex-direction:column}
    .left{padding:2rem}
    .right{padding:1.2rem}
    .portrait{width:120px;height:120px;flex:0 0 120px}
    .thumb{width:56px;height:56px}
  }

  /* prefer-reduced-motion honor */
  @media (prefers-reduced-motion: reduce) {
    .fade-item, .thumb, .portrait, .fade-item.active { transition: none !important; transform: none !important; }
  }

</style>
</head>
<body>
<section class="split">
  <div class="left">
    <div class="content">
      <h1 class="display-6">Our Legal Team</h1>
      <p class="lead" style="color:var(--muted)">Thoughtful counsel. Measured advocacy. Click a face to view a concise profile — the spotlight will rotate on its own every 6 seconds (respecting reduced-motion).</p>

      <div class="d-none d-md-block mt-4">
        <h6 style="color:#fff">Why choose our firm?</h6>
        <ul style="color:var(--muted);padding-left:1rem">
          <li>Decades of combined experience across corporate, IP and litigation</li>
          <li>Practical, client-first legal strategies</li>
          <li>Clear communication and proven results</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="right">
    <!-- Left column of thumbnails + spotlight card -->
    <div style="display:flex;align-items:center">
      <div class="thumbs" id="thumbs" aria-hidden="false"></div>

      <div class="spotlight" aria-live="polite">
        <div class="portrait" id="portraitWrap" aria-hidden="false">
          <!-- image or initials injected by JS -->
        </div>
        <div class="info slide">
          <div class="fade-wrap" id="fadeWrap">
            <!-- active content injected by JS -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // -------- Data: keep small, curated (professional) ----------
  const lawyers = [
    {id:1,name:"Sarah Johnson", title:"Senior Partner — Corporate Litigation", image:"https://images.unsplash.com/photo-1580489944761-15a19d654956?w=800&h=800&fit=crop&crop=face", bio:"Sarah leads our disputes team and focuses on cross-border corporate litigation with over 18 years of experience.", link:"/profile/1"},
    {id:2,name:"Michael Chen", title:"Partner — M&A & Compliance", image:"https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=800&fit=crop&crop=face", bio:"Michael advises companies on M&A, regulatory compliance and governance matters.", link:"/profile/2"},
    {id:3,name:"Jessica Williams", title:"Partner — Intellectual Property", image:"https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=800&h=800&fit=crop&crop=face", bio:"Jessica handles IP portfolio strategy, enforcement and licensing for tech and creative clients.", link:"/profile/3"},
    {id:4,name:"David Rodriguez", title:"Partner — Litigation", image:"https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=800&h=800&fit=crop&crop=face", bio:"David is a trial lawyer experienced in high-value commercial disputes.", link:"/profile/4"}
  ];

  // -------- Build thumbs and spotlight ----------
  const thumbsEl = document.getElementById('thumbs');
  const portraitWrap = document.getElementById('portraitWrap');
  const fadeWrap = document.getElementById('fadeWrap');

  let index = 0;
  let autoTimer = null;
  const ROTATE_DELAY = 6000; // 6 seconds — slow and calm

  function makeThumb(person, i){
    const btn = document.createElement('button');
    btn.className = 'thumb';
    btn.type = 'button';
    btn.title = `${person.name} — ${person.title}`;
    btn.setAttribute('aria-pressed','false');
    btn.dataset.index = i;

    // image or initials fallback
    const img = document.createElement('img');
    img.src = person.image;
    img.alt = person.name;
    img.loading = 'lazy';
    img.onerror = () => {
      img.remove();
      const initials = document.createElement('div');
      initials.className = 'initials';
      initials.textContent = person.name.split(' ').map(s=>s[0]).slice(0,2).join('').toUpperCase();
      btn.appendChild(initials);
    };
    btn.appendChild(img);

    btn.addEventListener('click', ()=> selectIndex(i, true));
    btn.addEventListener('keydown', (e)=> {
      if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); selectIndex(i, true); }
      if(e.key === 'ArrowLeft') { e.preventDefault(); prev(); }
      if(e.key === 'ArrowRight') { e.preventDefault(); next(); }
    });

    thumbsEl.appendChild(btn);
  }

  function renderSpotlight(i) {
    const p = lawyers[i];
    // portrait
    portraitWrap.innerHTML = '';
    const img = document.createElement('img');
    img.src = p.image;
    img.alt = p.name;
    img.loading = 'eager';
    img.onerror = () => {
      portraitWrap.innerHTML = '<div class="initials">' + p.name.split(' ').map(s=>s[0]).slice(0,2).join('').toUpperCase() + '</div>';
    };
    portraitWrap.appendChild(img);

    // fade content
    fadeWrap.innerHTML = '';

    const item = document.createElement('div');
    item.className = 'fade-item active';
    item.innerHTML = `<h4>${p.name}</h4><p class="title">${p.title}</p><p class="bio">${p.bio}</p>`;
    fadeWrap.appendChild(item);

    // highlight thumb aria-pressed
    Array.from(thumbsEl.children).forEach((b,idx) => b.setAttribute('aria-pressed', idx===i ? 'true' : 'false'));
  }

  function selectIndex(i, userInitiated=false) {
    index = (i + lawyers.length) % lawyers.length;
    renderSpotlight(index);
    resetAutoRotate(userInitiated);
  }

  function next(userInitiated=false){
    selectIndex(index+1, userInitiated);
  }
  function prev(userInitiated=false){
    selectIndex(index-1, userInitiated);
  }

  // auto-rotation, but DO NOT auto-start if user has reduced-motion preference
  const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  function startAutoRotate(){
    if(prefersReduced) return;
    stopAutoRotate();
    autoTimer = setInterval(()=> next(false), ROTATE_DELAY);
  }
  function stopAutoRotate(){ if(autoTimer) { clearInterval(autoTimer); autoTimer = null; } }
  function resetAutoRotate(userInitiated){
    // if user clicked, restart timer so they can read
    if(prefersReduced) return;
    stopAutoRotate();
    // short delay before restarting so it doesn't immediately rotate away
    autoTimer = setTimeout(()=> {
      stopAutoRotate();
      autoTimer = setInterval(()=> next(false), ROTATE_DELAY);
    }, ROTATE_DELAY);
  }

  // keyboard: left/right for entire component
  document.addEventListener('keydown', (e)=>{
    if(e.key === 'ArrowLeft') prev(true);
    if(e.key === 'ArrowRight') next(true);
  });

  // build initial
  lawyers.forEach((p,i)=> makeThumb(p,i));
  selectIndex(0,false);
  startAutoRotate();

  // responsive note: if container hidden / not visible, we avoid auto-rotation churn
  document.addEventListener('visibilitychange', ()=> {
    if(document.hidden) stopAutoRotate(); else startAutoRotate();
  });

  // Public: if you want no images at all, set showImages=false and remove image nodes
  // Example: to force initials-only, uncomment below:
  // document.querySelectorAll('.thumb img, .portrait img').forEach(n=>n.remove());
</script>
</body>
</html>
