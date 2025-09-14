@extends('layouts.app')

@section('content')

  <section class="py-5">
    <div class="container">

      <h1 class="page-heading">Articles</h1>
        <p class="intro-text mb-3">
            Knowledge is power in navigating complex legal landscapes. Our attorneys regularly share their 
            expertise through these articles, breaking down complicated legal concepts into actionable insights. 
            Discover valuable information that can help you make informed decisions.
        </p>

      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Posts Section -->
          <section id="blog-posts" class="blog-posts section">

            <div class="container">
              <div class="row gy-4">

                <div class="col-lg-6">
                  <article class="position-relative h-100">

                    <div class="post-img position-relative overflow-hidden">
                      <img src="{{asset('images/law.jpg')}}" class="img-fluid" alt="">
                      <span class="post-date">June 24</span>
                    </div>

                    <div class="post-content d-flex flex-column">

                      <h3 class="post-title">AI in Law Firms: Training Tool, Not a Threat</h3>

                      <div class="meta d-flex align-items-center">
                        <div class="d-flex align-items-center">
                          <i class="bi bi-person"></i> <span class="ps-2">Sjr Dlomo</span>
                        </div>
                        <span class="px-3 text-black-50">/</span>
                        <div class="d-flex align-items-center">
                          <i class="bi bi-folder2"></i> <span class="ps-2">IT</span>
                        </div>
                      </div>

                      <p>
                        A recent Canadian Lawyer article explores how artificial intelligence is reshaping associate training and development in law firms. 
                        While some worry that AI reduces opportunities for learning, the article highlights how firms are using technology to accelerate—not replace—professional growth.
                      </p>

                      <hr>

                      <a href="{{route('article')}}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                    </div>

                  </article>
                </div><!-- End post list item -->
                <div class="col-lg-6">
                  <article class="position-relative h-100">

                    <div class="post-img position-relative overflow-hidden">
                      <img src="{{asset('images/law.jpg')}}" class="img-fluid" alt="">
                      <span class="post-date">June 24</span>
                    </div>

                    <div class="post-content d-flex flex-column">

                      <h3 class="post-title">AI in Law Firms: Training Tool, Not a Threat</h3>

                      <div class="meta d-flex align-items-center">
                        <div class="d-flex align-items-center">
                          <i class="bi bi-person"></i> <span class="ps-2">Sjr Dlomo</span>
                        </div>
                        <span class="px-3 text-black-50">/</span>
                        <div class="d-flex align-items-center">
                          <i class="bi bi-folder2"></i> <span class="ps-2">IT</span>
                        </div>
                      </div>

                      <p>
                        A recent Canadian Lawyer article explores how artificial intelligence is reshaping associate training and development in law firms. 
                        While some worry that AI reduces opportunities for learning, the article highlights how firms are using technology to accelerate—not replace—professional growth.
                      </p>

                      <hr>

                      <a href="{{route('article')}}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

                    </div>

                  </article>
                </div><!-- End post list item -->

                

              </div>
            </div>

          </section><!-- /Blog Posts Section -->


        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Blog Author Widget 2 -->
            <div class="blog-author-widget-2 widget-item">

              <div class="d-flex flex-column align-items-center">
                <img src="{{asset('images/9.jpeg')}}" class="rounded-circle flex-shrink-0" alt="">
                <h4>Sjr Dlomo</h4>
                <div class="social-links">
                  <a href="https://x.com/#"><i class="bi bi-twitter-x"></i></a>
                  <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                  <a href="https://instagram.com/#"><i class="biu bi-instagram"></i></a>
                  <a href="https://instagram.com/#"><i class="biu bi-linkedin"></i></a>
                </div>

                <p>
                  Demystifying the law one article at a time. I believe that legal knowledge shouldn't be confined to the courtroom but should empower people in their daily lives and business decisions.
                </p>

              </div>
            </div><!--/Blog Author Widget 2 -->

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
                  <h4><a href="{{route('article')}}">Nihil blanditiis at in nihil autem</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="{{asset('images/law.jpg')}}" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="{{route('article')}}">Quidem autem et impedit</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="{{asset('images/law.jpg')}}" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="{{route('article')}}">Id quia et et ut maxime similique occaecati ut</a></h4>
                  <time datetime="2020-01-01">Jan 1, 2020</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="{{asset('images/law.jpg')}}" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="{{route('article')}}">Laborum corporis quo dara net para</a></h4>
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

  </section>

@endsection

 
 