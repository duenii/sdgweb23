@extends('layouts.home')

@section('content')

<div class="main-panel">
  <div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Files Upload </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
  
          <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('files.create') }}" class="btn btn btn-gradient-success">Add File</a></li>
        </ol>
      </nav>
    </div> 
      <div class="rowban">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card">
            <div class="card-body table-responsive">
				
				
					{{-- <form  action="">
						@csrf       
						<div class="input-group col-lg-12">
							<input type="search" name="search" value="{{ $search }}" class="form-control" placeholder="ค้นหาโดยชื่อ......." aria-label="Recipient's username" aria-describedby="button-addon2">
							<button class="btn btn-outline-secondary ">Search</button>
						</div>
					</form> --}}

					<form class="row g-3">
						@csrf  
						<div class="col-auto">
						  <label for="staticEmail2" >ค้นหาข้อมูล : </label>				
						</div>
						<div class="col-auto">
						 
						  <input type="search" name="search" value="{{ $search }}" class="form-control"  placeholder="ค้นหาโดยชื่อ........">
						</div>
						<div class="col-auto">
						  <button type="submit" class="btn btn-primary mb-3">Search</button>
						</div>
					  </form>
			

				 @if (count($files) > 0 )

                @if($message = Session::get('success'))
                    <div class="alert alert-success">
                      <i class="mdi mdi-check icon-md"> </i> {{ $message }}
                    </div>
                @elseif ($message = Session::get('warning'))
                    <div class="alert alert-warning">
                      <i class="mdi mdi-tooltip-edit icon-md"></i> {{ $message }}
                    </div>

                @elseif($message = Session::get('danger'))
                    <div class="alert alert-danger">
                        <i class="mdi mdi-delete icon-md"></i> {{ $message }}
                    </div>

                @endif
				<table class="table table-hover table-bordered pb-2">
					<thead>
					  <tr>
						 <th>#</th>
						<th>name</th>
						<th>File Link</th>
						<th>Status</th>
						<th>Update</th>
						<th>Action</th>
					  </tr>
					</thead>
					   <tbody>                
					  @foreach($files as $rowfile)
					  <tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $rowfile->name }}</td>
						<td>{{ asset('/files').'/'.$rowfile->file }}</td>
							<!--<td>   <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{ asset('/files').'/'.$rowfile->file }}" disabled></td>-->
						{{-- <td> {{ $rowfile->status == 1 ? 'แสดง' : 'ไม่แสดง' }}</td> --}}

						<td> 
							@if ( $rowfile->status == 1)
								<label class="badge badge-gradient-success"> <i class="mdi mdi-eye"></i> แสดง </label>                                                                     
							@else
								<label class="badge badge-gradient-danger"> <i class="mdi mdi-eye-off"></i> ไม่แสดง </label>
							@endif
						</td>
						<td> {{ date('d M Y', strtotime($rowfile->updated_at)) }} </td>
						<td>	
							<a href="{{ asset('/files').'/'.$rowfile->file  }}" class="btn btn-info btn-sm" target="_blank">View</a>
							

							<!--<input type="submit" class="btn btn-danger btn-sm" value="DELETE" />-->
							<Button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $rowfile->id }}">DELETE</Button>

							<!-- Modal -->
							<div class="modal" id="modal{{ $rowfile->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<h4 class="modal-title" id="exampleModalLabel">Delete Data</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								  </div>
								  <div class="modal-body">
									<h5>ลบข้อมูล </h5><br>
									  {{ $rowfile->name }}


								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-secondary  btn-sm" data-bs-dismiss="modal">Cancel</button>
									<form method="post" action="{{ route('files.destroy', $rowfile->id) }}">
									  @csrf
									  @method('DELETE')
									<!--<button type="button" class="btn btn-primary">Delete</button>-->
									<input type="submit" class="btn btn-danger btn-sm" value="DELETE" />


								  </form>
								  </div>
								</div>
							  </div>
							</div>



						</td>
					  </tr>

					@endforeach
					</tbody>
           		 </table>
				  {{ $files->links() }}

                        @else
                        <h3 class="text-center text0"> No post found</h3>


                        @endif
                        
				  </div>
			    </div>
			  </div>
		    </div>
       </div>
  </div>

</div>

    @endsection