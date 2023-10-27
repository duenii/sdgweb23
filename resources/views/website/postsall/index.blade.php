@extends('layouts.website')

@section('content')


@foreach ($cat as $cat_row)

@if ($cat_row->id == 1)
@php
$box_img = "title_header01.jpg";
@endphp
@endif

@if ($cat_row->id == 2)
@php
$box_img = "title_header02.jpg";
@endphp
@endif

@if ($cat_row->id == 3)
@php
$box_img = "title_header03.jpg";
@endphp
@endif

@if ($cat_row->id == 4)
@php
$box_img = "title_header04.jpg";
@endphp
@endif

@if ($cat_row->id == 5)
@php
$box_img = "title_header05.jpg";
@endphp
@endif

@if ($cat_row->id == 6)
@php
$box_img = "title_header06.jpg";
@endphp
@endif

@if ($cat_row->id == 7)
@php
$box_img = "title_header07.jpg";
@endphp
@endif

@if ($cat_row->id == 8)
@php
$box_img = "title_header08.jpg";
@endphp
@endif

@if ($cat_row->id == 9)
@php
$box_img = "title_header09.jpg";
@endphp
@endif

@if ($cat_row->id == 10)
@php
$box_img = "title_header10.jpg";
@endphp
@endif

@if ($cat_row->id == 11)
@php
$box_img = "title_header11.jpg";
@endphp
@endif

@if ($cat_row->id == 12)
@php
$box_img = "title_header12.jpg";
@endphp
@endif

@if ($cat_row->id == 13)
@php
$box_img = "title_header13.jpg";
@endphp
@endif

@if ($cat_row->id == 14)
@php
$box_img = "title_header14.jpg";
@endphp
@endif

@if ($cat_row->id == 15)
@php
$box_img = "title_header15.jpg";
@endphp
@endif

@if ($cat_row->id == 16)
@php
$box_img = "title_header16.jpg";
@endphp
@endif

@if ($cat_row->id == 17)
@php
$box_img = "title_header17.jpg";
@endphp
@endif

@if ($cat_row->id == 18)
@php
$box_img = "title_header18.jpg";
@endphp
@endif


<div class="px-5">
    <div class="row">
      <div class="col-md-12">
        <!-- Title text -->
        <img class="d-block w-100" src="{{ asset('assets/themeweb/images/icon_sgd_topcat/'.$box_img) }}" alt="">
      </div>
    </div>
</div>

{{-- <section class="hero-area text-center" style="background:url({{ asset('assets/themeweb/images/icon_sgd_topcat').'/'. $box_img }}")>
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
		
			
			</div>
		</div>
	</div>
	<!-- Container End -->
</section> --}}


<section class=" blog-wrap pt-3">
  <div class="container">

    {{-- <div class="row">
      <div class="col-md-12">
        <div class="search-result bg-gray">
          <h2>{{ $cat_row->id }} </h2>
          
          <p>{{ $cat_row->name }}</p>

          


        </div>
      </div>
    </div> --}}

    <div class="row">

      {{-- @foreach ($posts->Where('category_id', $cat_row->id) as $post) --}}

      @foreach ($posts as $post)
      {{-- {{$post->category_id}} --}}
      {{-- @if ()

      @endif --}}


      @if ($cat_row->id==$post->category_id)
      <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6">
        <a href="{{ route('website.posts.show', $post->id) }}">
          <div class="category-block">
            <div class="text-center">
              <div class="thumb-content">
                <p class="card-text">{{ $post->category_id }}</p>

                <a href="single.html">
                  <img src="{{ asset('/storage/images/posts/thumbnail').'/'. $post->gallery_id }}" alt=""
                    class="img-fluid img-thumbnail w-75">
                </a>
              </div>

            </div>

            <ul class="list-inline product-meta">
              
              <li class="list-inline-item">
                <i class="fa fa-calendar"></i><span class="text-sm text-muted"> {{ date('d M Y'),
                  strtotime($post->created_at) }}
              </li>
            </ul>
            <p class="card-text">{{ $post->title }}</p>



          </div>
        </a>
      </div>
      @endif

      {{-- @endforeach

      @foreach ($posts->Where('category_id', $cat_row->id) $post) --}}

     

      @endforeach
    </div>

    @endforeach



  </div>



</section>

@endsection