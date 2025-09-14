@extends('layouts.app')

@section('content')

    <!-- Page Title -->
    <div class="page-title">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">AI in Law Firms: Training Tool, Not a Threat</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{route('homePage')}}">Home</a></li>
            <li class="current">Single Post</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <div class="container mt-4">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article">

                <div class="post-img">
                  <img src="{{asset('images/law.jpg')}}" alt="" class="img-fluid">
                </div>

                <h2 class="title">AI in Law Firms: Training Tool, Not a Threat</h2>

                <div class="meta-top">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">Sjr Dlomo</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01">Sept 13, 2025</time></a></li>
                    {{-- <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">12 Comments</a></li> --}}
                  </ul>
                </div><!-- End meta top -->

                <div class="content">
                  <p>
                    A recent Canadian Lawyer article explores how artificial intelligence is reshaping associate training and development in law firms. While some worry that AI reduces opportunities for 
                    learning, the article highlights how firms are using technology to accelerate—not replace—professional growth.
                  </p>

                  <p>
                    Scanlen is featured for its perspective on “reverse mentorship,” where junior associates share digital expertise with senior lawyers, helping to advance technology adoption while 
                    strengthening intergenerational collaboration.
                  </p>

                  <blockquote>
                    <p>
                      Law enforcement and criminal justice authorities are increasingly using artificial intelligence (AI) and 
                      automated decision-making (ADM) systems in their work.
                    </p>
                  </blockquote>

                  <p>
                    One of the benefits of AI in law is the ability to simplify rote tasks with the click of a button. 
                    Lawyers no longer need to dedicate countless hours to researching case law, drafting and managing contracts, or generating documents. 
                    Instead, they can leverage AI-enabled tools to do the work for them and redirect their attention to higher-value work, such as strategic legal planning and negotiations.
                  </p>

                  {{-- <h3>Et quae iure vel ut odit alias.</h3> --}}
                  <h3>What are the legal ethics issues with AI?</h3>
                  <p>
                    But in an industry that’s built on billable hours, a reduction in hours poses a risk to operations and 
                    headcount. Traditionally, clients have been billed by the hour, with the bulk of time-intensive work executed by junior associates and paralegals. 
                    But if that work can be executed in seconds with the help of AI, clients might demand an alternative billing structure, which could lead to a consolidation 
                    in the number of junior staffers.
                  </p>
                  {{-- <img src="{{asset('images/law.jpg')}}" class="img-fluid" alt=""> --}}

                  <p>
                    As AI in law and legal practice shape-shifts, junior and senior lawyers alike will need to adapt to market changes while also keeping ethical considerations top of mind.
                    The American Bar Association’s (ABA) Model Rules of Professional Conduct codifies best practices and ethical guidance on how to use AI in legal work, including:
                  </p>
                  {{-- <p>
                    Alias quia non aliquid. Eos et ea velit. Voluptatem maxime enim omnis ipsa voluptas incidunt. Nulla sit eaque mollitia nisi asperiores est veniam.
                  </p> --}}

                </div><!-- End post content -->

                {{-- <div class="meta-bottom">
                  <i class="bi bi-folder"></i>
                  <ul class="cats">
                    <li><a href="#">Business</a></li>
                  </ul>

                  <i class="bi bi-tags"></i>
                  <ul class="tags">
                    <li><a href="#">Creative</a></li>
                    <li><a href="#">Tips</a></li>
                    <li><a href="#">Marketing</a></li>
                  </ul>
                </div><!-- End meta bottom --> --}}

              </article>

            </div>
          </section><!-- /Blog Details Section -->

         

        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Blog Author Widget -->
            <div class="blog-author-widget widget-item">

              <div class="d-flex flex-column align-items-center">
                <div class="d-flex align-items-center w-100">
                  <img src="{{asset('images/2.jpeg')}}" class="rounded-circle flex-shrink-0" alt="">
                  <div>
                    <h4>Sjr Dlomo</h4>
                    <div class="social-links">
                      <a href="https://x.com/#"><i class="bi bi-twitter-x"></i></a>
                      <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                      <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                      <a href="https://instagram.com/#"><i class="biu bi-linkedin"></i></a>
                    </div>
                  </div>
                </div>

                <p>
                  Demystifying the law one article at a time. I believe that legal knowledge shouldn't be confined to the courtroom but should empower people in their daily lives and business decisions.
                </p>

              </div>

            </div><!--/Blog Author Widget -->

            <!-- Search Widget -->
            <div class="search-widget widget-item">

              <h3 class="widget-title">Search</h3>
              <form action="">
                <input type="text">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>

            </div><!--/Search Widget -->

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Recent Posts</h3>

              <div class="post-item">
                <img src="{{asset('images/law.jpg')}}" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="{{route('article')}}">OpenAI's Screenless Future</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->
              <div class="post-item">
                <img src="{{asset('images/law.jpg')}}" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="{{route('article')}}">OpenAI's Screenless Future</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->
              <div class="post-item">
                <img src="{{asset('images/law.jpg')}}" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="{{route('article')}}">OpenAI's Screenless Future</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->
              <div class="post-item">
                <img src="{{asset('images/law.jpg')}}" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="{{route('article')}}">OpenAI's Screenless Future</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->



            </div><!--/Recent Posts Widget -->

            <!-- Tags Widget -->
            <div class="tags-widget widget-item">

              <h3 class="widget-title">Tags</h3>
              <ul>
                <li><a href="#">App</a></li>
                <li><a href="#">IT</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Mac</a></li>
                <li><a href="#">Design</a></li>
                <li><a href="#">Office</a></li>
                <li><a href="#">Creative</a></li>
                <li><a href="#">Studio</a></li>
                <li><a href="#">Smart</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>

            </div><!--/Tags Widget -->

          </div>

        </div>

      </div>
    </div>


@endsection