<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  ================================================== -->
  {{-- <meta charset="utf-8"> --}}
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>template</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Novena HTML Template v1.0">
  <meta name="description" content="Health Care Medical Html5 Template"> --}}
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.png" />

  <!-- 
  Essential stylesheets
  =====================================-->
  {{-- <link rel="stylesheet" href="{{ asset('assets/website/plugins/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/website/plugins/icofont/icofont.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/website/plugins/slick-carousel/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/website/plugins/slick-carousel/slick/slick-theme.css') }}"> --}}

  <!-- Main Stylesheet -->
  {{-- <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}"> --}}


  <!-- ** Mobile Specific Metas ** -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  {{-- <meta name="description" content="Agency HTML Template"> --}}
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Classified Marketplace Template v1.0">
    <!-- theme meta -->
	<meta name="theme-name" content="classimax" />

	<!-- favicon -->
	  <link rel="shortcut icon" href="{{ asset('/assets/favicon.ico')}}">
  
	<!-- 
	Essential stylesheets
	=====================================-->
	<link href="{{ asset('assets/themeweb/plugins/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/themeweb/plugins/bootstrap/bootstrap-slider.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/themeweb/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/themeweb/plugins/slick/slick.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/themeweb/plugins/slick/slick-theme.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/themeweb/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
	  <!-- Main Stylesheet -->
	<link href="{{ asset('assets/themeweb/css/style.css') }}" rel="stylesheet">

</head>

<body class="body-wrapper">

	<header>
	

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar-expand-lg navbar-light navigation">
						<a class="navbar-brand" href="index.html">
							<img src="images/logo.png" alt="">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav ml-auto main-nav ">
								<li class="nav-item active">
									<a class="nav-link" href="{{ route('home') }}">Home</a>
								</li>
								@foreach ($navmenu as $menu)
								@if (!$menu->status == 1)

								<li class="nav-item">
									<a class="nav-link" href="{{ route('website.postabouts.show', $menu->id) }}">{{$menu->title}}</a>							
								</li>

								@else

								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="dropdown05"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{
										$menu->title}} <span><i class="fa fa-angle-down"></i></span></a>
									<ul class="dropdown-menu" aria-labelledby="dropdown05">
		
										@foreach ($submenu->Where('postabouts_id', $menu->id) as $submenux)
										@if (!$submenux->link == '')
										<li><a class="dropdown-item" href="{{ $submenux->link }}">{{
												$submenux->title}}</a></li>
		
										@else
		
										<li><a class="dropdown-item"
												href="{{ route('website.subabouts.show', $submenux->id) }}">{{
												$submenux->title}}</a></li>
		
										@endif
		
										@endforeach
		
									</ul>
								</li>	
								
									
								@endif

								@endforeach




							</ul>
							
						</div>
					</nav>
				</div>
			</div>
		</div>
		


	</header>


	@yield('content')

<!--============================
=            Footer            =
=============================-->

  <!-- Footer Bottom -->
  <footer class="footer-bottom">
	<!-- Container Start -->
	<div class="container-fluid">
	  <div class="row px-5">
		<div class="col-lg-8 text-center text-lg-left mb-3 mb-lg-0">
		  <!-- Copyright -->
		  <div class="copyright">
			
			<p>Copyright &copy; <script>
				var CurrentYear = new Date().getFullYear()
				document.write(CurrentYear)
			  </script>. Designed & Developed by <a >Themefisher</a> </p>
		  </div>
		</div>
		<div class="col-lg-4">
			<p >เป้าหมายแห่งการพัฒนาที่ยั่งยืน มหาวิทยาลัยราชภัฏนครราชสีมา
				340 ถ.สุรนารายณ์ ตำบลในเมือง อำเภอเมืองนครราชสีมา จังหวัดนครราชสีมา 30000				
				เบอร์โทร. 044-099099 เบอร์ภายใน</p>
		  <!-- Social Icons -->
		  <ul class="social-media-icons text-center text-right">
			{{-- <li><a class="fa fa-facebook" href="https://www.facebook.com/profile.php?id=100073376840001"></a></li> --}}
		  </ul>
		</div>
	  </div>
	</div>
	<!-- Container End -->
	<!-- To Top -->
	<div class="scroll-top-to">
	  <i class="fa fa-angle-up"></i>
	</div>
  </footer>
  
  <!-- 
  Essential Scripts
  =====================================-->
  <script src="{{ asset('assets/themeweb/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/themeweb/plugins/bootstrap/popper.min.js') }}"></script>
  <script src="{{ asset('assets/themeweb/plugins/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/themeweb/plugins/bootstrap/bootstrap-slider.js') }}"></script>
  <script src="{{ asset('assets/themeweb/plugins/tether/js/tether.min.js') }}"></script>
  <script src="{{ asset('assets/themeweb/plugins/raty/jquery.raty-fa.js') }}"></script>
  <script src="{{ asset('assets/themeweb/plugins/slick/slick.min.js') }}"></script>
  <script src="{{ asset('assets/themeweb/plugins/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
  <!-- google map -->
  {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
  <script src="plugins/google-map/map.js" defer></script> --}}
  
  <script src="{{ asset('assets/themeweb/js/script.js') }}"></script>
  
  </body>
  
  </html>
  
