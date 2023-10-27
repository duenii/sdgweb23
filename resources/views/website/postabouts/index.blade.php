@extends('layouts.website')

@section('content')

  
  <section class=" blog-wrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 mb-5">
            <div class="blog-item">
              
             
              @foreach ($menu as $rowabout)
    
                <div class="blog-item-content">
                  <div class="blog-item-meta mb-3 mt-4 text-center">
                    <div class="search-result bg-gray">
                      <h2>{{ $rowabout->title }}</h2>
                      
                    </div>                    
                    
                  </div>

    
                    <p class="mb-4">{!! $rowabout->content !!}</p>


                    <div class="blog-item-meta mb-3 mt-2">
                      <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-1"></i> {{ date('d M Y'), strtotime($rowabout->created_at)  }} </span>
                    </div>
    
                 
                </div>
                @endforeach
               

            </div>
        
    
      </div>
    </div>
  </section>

  @endsection