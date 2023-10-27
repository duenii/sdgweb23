@extends('layouts.website')

@section('content')


<section class="page-title">
  <!-- Container Start -->
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2 text-center ">
        <!-- Title text -->
        <h3>ข่าวสารทั้งหมด</h3>
      </div>
    </div>
  </div>
  <!-- Container End -->
</section>   

<section class=" blog-wrap">
  <div class="container">

    <div class="row pt-3">

     

      @foreach ($news as $r_news)
   
      <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6">
        <a href="{{ route('website.news.show', $r_news->id) }}">
          <div class="category-block">
            <div class="text-center">
              <div class="thumb-content">  

                <a href="{{ route('website.news.show', $r_news->id) }}">
                  <img src="{{ asset('/storage/images/news/thumbnail').'/'. $r_news->gallery_id }}" alt=""
                    class="img-fluid img-thumbnail w-75">
                </a>
              </div>

            </div>

            <ul class="list-inline product-meta">            
              <li class="list-inline-item">
                <i class="fa fa-calendar"></i><span class="text-sm text-muted"> {{ date('d M Y'),
                  strtotime($r_news->created_at) }}
              </li>
            </ul>
            <p class="card-text">{{ $r_news->title }}</p>



          </div>
        </a>
      </div>
  

      {{-- @endforeach

      @foreach ($news->Where('category_id', $cat_row->id) $r_news) --}}

     

      @endforeach
    </div>

 



  </div>



</section>

@endsection