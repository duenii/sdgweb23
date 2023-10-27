@extends('layouts.website')

@section('content')
  
  <section class=" blog-wrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 mb-5">
            <div class="blog-item">
              
             
              @foreach ($post as $rowpost)
    
                <div class="blog-item-content">
                  <div class="blog-item-meta mb-3 mt-4 text-center">
                    <h5 class="text-black text-capitalize mr-3"> {{ $rowpost->title }} </h5>
                    <img src="{{ asset('/images/posts').'/'. $rowpost->gallery->image }}" alt="" class="img-fluid w-50 mt-2"> 
                  </div>


                    <div class="blog-item-meta mb-3 mt-2">
                      <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-1"></i> {{ date('d M Y'), strtotime($rowpost->created_at)  }} </span>
                    </div>
    
                    
                    <p class="mb-4"> {!! html_entity_decode($rowpost->content) !!}</p>
                    
    
                 
                </div>
                @endforeach
               

            </div>
        
    
      </div>
    </div>
  </section>

  @endsection