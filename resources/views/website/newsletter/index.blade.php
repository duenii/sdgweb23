@extends('layouts.website')

@section('content')

  <section class=" blog-wrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <h3 class="mt-4 mb-1">จดหมายข่าว</h3>
          <div class="divider my-2"></div>
        </div> 
      </div> 
      
      <div class="row pb-5">

      @foreach ($newsletter as $rowletter)


        <div class="col-lg-2 col-md-6 pt-3 card-group ">

          <div class="card">
            <a href="{{ asset('/files').'/'.$rowletter->file  }}"  target="_blank"> 
              <img src="{{ asset('/storage/images/newsletter/' . $rowletter->image) }}" class="card-img-top rounded mx-auto d-block w-75 pt-4" alt="..." >
            </a>
            <div class="card-body">
            <p class="card-text">{{$rowletter->name}}</p>
            </div>
          </div>
          </div>
        
     
			@endforeach

       </div>

    </div>
  </section>

  @endsection