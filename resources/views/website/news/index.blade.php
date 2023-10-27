@extends('layouts.website')

@section('content')

 

              <section class="page-title">
                <!-- Container Start -->
                <div class="container">
                  <div class="row">
                    <div class="col-md-8 offset-md-2 text-center">
                      <!-- Title text -->
                      <h3>ข่าวสาร</h3>
                    </div>
                  </div>
                </div>
                <!-- Container End -->
              </section>   

  <section class=" blog-wrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 mb-5">
            <div class="blog-item">
              
             
             @foreach ($news as $r_news)
    
                <div class="blog-item-content">
                  <div class="blog-item-meta mb-3 mt-4 text-center">
                    <h5 class="text-black text-capitalize mr-3"> {{ $r_news->title }} </h5>
                    <img src="{{ asset('/images/news').'/'. $r_news->gallery_id }}" alt="" class="img-fluid w-50 mt-2"> 
                  </div>


                    <div class="blog-item-meta mb-3 mt-2">
                      <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-1"></i> {{ date('d M Y'), strtotime($r_news->created_at)  }} </span>
                    </div>
    
                    
                    <p class="mb-4"> {!! html_entity_decode($r_news->content) !!}</p>
                    
    
                 
                </div>
                @endforeach
               

            </div>
        
    
      </div>
    </div>
  </section>

  @endsection