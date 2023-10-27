@extends('layouts.website')

@section('content')

{{-- <section class="bannertext-center overly">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			@foreach (range(1,count($banners)-1) as $i)
			<li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
			@endforeach

		</ol>
		<div class="carousel-inner">
			@foreach ($banners as $ban)
			@if($ban->id == $banners->max('id'))
			<div class="carousel-item active">
				@else
				<div class="carousel-item">
					@endif

					<img class="d-block w-100" src="{{ asset( '/storage/images/banners/'.$ban->image) }}"
						alt="First slide">

				</div>
				@endforeach

			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
</section> --}}

<div class="container-fluid">
	<div class="row align-items-center ">


		<img src="{{ asset('assets/themeweb/images/home/hero.jpg') }}" alt="" class="img-fluid ">


	</div>
</div>

<!-- Container Start -->
<div class="container">
	<div class="row">
		<div class="col-12">
			
			<div class="row py-4">

				@foreach ($cat as $cat_row)
				<div class="col-lg-2 offset-lg-0 col-md-5 offset-md-1 col-sm-6">
					<a href="{{ route('website.postsall.show',$cat_row->id)}}">

						<div class="header pb-2">
							<div class="thumb-content">

								<img class="card-img-top img-fluid"
									src="{{ asset('/storage/images/category/thumbnail').'/'. $cat_row->cover }}"
									alt="Card image cap">

							</div>

						</div>					
					</a>
				</div>

				@endforeach
			</div>
		</div>
	</div>
</div>
<!-- Container End -->

<div class="container-fluid ">
	<div class="row px-5">
		<div class="col-lg-12">
			<div class="widget archive">
				<!-- Widget Header -->
				<h3 class="widget-header">  ข่าวสาร</h3>
				<div class="card-group">
				@foreach ($news as $r_news)


				{{-- <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6">
					<a href="{{ route('website.news.show', $r_news->id) }}">
						<div class="category-block">
							<div class="text-center">
								<div class="thumb-content">
									<a href="{{ route('website.news.show', $r_news->id) }}">
										<img src="{{ asset('/storage/images/news/thumbnail').'/'. $r_news->gallery_id }}"
											alt="" class="img-fluid img-thumbnail w-75">
									</a>
								</div>

							</div>

							<ul class="list-inline product-meta">
								
								<li class="list-inline-item text-right">
									<i class="fa fa-calendar"></i><span class="text-sm text-muted"> {{ date('d M Y'),
										strtotime($r_news->created_at) }}
								</li>
							</ul>
							<p class="card-text">{{ $r_news->title }}</p>



						</div>
					</a>
				</div> --}}
				


				<div class="col-lg-3 col-sm-6">
					<div class="card my-3 my-lg-0 h-100">
						<a href="{{ route('website.news.show', $r_news->id) }}">
							<img src="{{ asset('/storage/images/news/thumbnail').'/'. $r_news->gallery_id }}"
								alt="" class="card-img-top">
						</a>
					  <div class="card-body bg-gray">
						<div class="card-text text-right"><i class="fa fa-calendar"></i><span class="text-sm text-muted"> {{ date('d M Y'),
							strtotime($r_news->created_at) }}
						</div>
						<h5 class="card-title">{{ $r_news->title }}</h5>
						
					  </div>
					</div>
				  </div>

			
				@endforeach
			</div>
			</div>
			<div class="row bg-fff px-5 bg-showdata py-2">
				<div class="col-lg-12 col-md-12 col-sm-12 text-lg-right ">
					<a class="btn btn-main " href="{{ route('website.newsall.show')}}">View All <i
							class="icofont-simple-right ml-2  "></i></a>
				</div>
			</div>
		</div>


	</div>
</div>



@endsection