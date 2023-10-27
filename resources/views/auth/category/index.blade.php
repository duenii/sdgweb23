@extends('layouts.home')

@section('tatle', 'Create category')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> category </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('category.create')}}" class="btn btn btn-gradient-success">เพิ่มข้อมูล</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body table-responsive">
                
                         <form class="row g-3">
                            @csrf  
                            <div class="col-auto">
                              <label for="staticEmail2" >ค้นหาข้อมูล : </label>				
                            </div>
                            <div class="col-auto">
                             
                              <input type="search" name="search" value="{{ $search }}" class="form-control"  placeholder="ค้นหาโดยชื่อเรื่องข่าว........">
                            </div>
                            <div class="col-auto">
                              <button type="submit" class="btn btn-primary mb-3">Search</button>
                            </div>
                          </form> 

                    @if (count($category) > 0 )

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
          
                       
                        <table class="table table-hover mb-2 table-bordered ">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-center">#</th>
                                    <th class="text-center">cover</th>
                                    <th class="text-center">name</th> 
                                    <th class="text-center">detail</th>                                                                   
                                    <th class="text-center">Update</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $rowcat)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="w-25 text-center"><img src="{{ asset('/storage/images/category/thumbnail').'/'. $rowcat->cover }}" alt="images" class="w-25 h-25"></td>
                                    <td class="text-center">{{$rowcat->name}} </td>
                                    <td> {!! html_entity_decode($rowcat->content) !!}</td>                                   
                                   
                                    <td class="text-center"> {{ date('d M Y', strtotime($rowcat->updated_at)) }} </td>
                                    <td class="text-center">
                                        
                                          <a href="{{ route('category.edit', $rowcat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                       
                                         
                                          <Button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{ $rowcat->id }}">DELETE</Button>
                  
                                          
                                          <div class="modal" id="modal{{ $rowcat->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h4 class="modal-title" id="exampleModalLabel">Delete Data</h4>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                  <h5>ลบข้อมูล</h5><br>
                                                  <p>{{ $rowcat->id }}</p>
                                                  
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary  btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                  <form method="post" action="{{ route('category.destroy', $rowcat->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                  
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
                        {{ $category->links() }}
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