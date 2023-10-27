@extends('layouts.home')

@section('tatle', 'Create Post About')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Main Menu </h3>
            <nav aria-label="breadcrumb">
                
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('postabouts.create')}}" class="btn btn btn-gradient-success">เพิ่มข้อมูล</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body table-responsive">
                        {{-- <div class="col-lg-6 mb-2 ">
                            <form  action="">
                                @csrf       
                                <div class="input-group col-lg-12">
                                    <input type="search" name="search" value="{{ $search }}" class="form-control" placeholder="ค้นหาโดยชื่อเมนูหลัก......." aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary">Search</button>
                                </div>
                            </form>
                        </div> --}}

                        <form class="row g-3">
                            @csrf  
                            <div class="col-auto">
                              <label for="staticEmail2" >ค้นหาข้อมูล : </label>				
                            </div>
                            <div class="col-auto">
                             
                              <input type="search" name="search" value="{{ $search }}" class="form-control"  placeholder="ค้นหาโดยชื่อเมนูหลัก........">
                            </div>
                            <div class="col-auto">
                              <button type="submit" class="btn btn-primary mb-3">Search</button>
                            </div>
                          </form>

                    @if (count($postabouts) > 0 )

                        {{-- <h4 class="card-title">Main Menu</h4> --}}

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
                    
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">submenu</th> 
                                    <th class="text-center">link</th>                                  
                                    {{-- <th class="text-center">User</th> --}}
                                    <th class="text-center">Update</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($postabouts as $rowabout)
                                <tr >
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td >{{ $rowabout->title }}</td>   
                                    <td class="text-secondary">
                                        @foreach($subabouts as $subpost)
                                            @if($rowabout->id == $subpost->postabouts_id) 
                                                <p> - {{$subpost->title }}</p>
                                            @endif

                                           
                                        @endforeach
                                       

                                    </td>                               
                                    <td class="text-center"> 
                                     @if(!$rowabout->link == '')
                                        <a href="{{ $rowabout->link }}" class="btn btn-outline-info btn-sm"> <i class="mdi mdi-link-variant"></i> link</a>
                                     @endif
                                    </td>
                                    
                                    
                                    {{-- <td class="text-center">{{ $rowabout->users->name }}</td> --}}
                                    <td class="text-center"> {{ date('d M Y', strtotime($rowabout->updated_at)) }} </td>
                                    <td class="text-center">
                                        <a href="{{ route('postabouts.edit', $rowabout->id) }}" class="btn btn-warning btn-sm ">Edit</a>
                       
                                          <!--<input type="submit" class="btn btn-danger btn-sm" value="DELETE" />-->
                                          <Button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $rowabout->id }}">DELETE</Button>
                  
                                          <!-- Modal -->
                                          <div class="modal" id="modal{{ $rowabout->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title" id="exampleModalLabel">Delete Data</h4>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                  <h5>ลบข้อมูล </h5><br>
                                                  <p>{{ $rowabout->title }}</p>
                                                  
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary  btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                  <form method="post" action="{{ route('postabouts.destroy', $rowabout->id) }}">
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
                        {{ $postabouts->links() }}
                        @else
                        <h3 class="text-center text0"> No post found</h3>
                        @endif
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection