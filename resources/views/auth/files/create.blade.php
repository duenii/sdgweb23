@extends('layouts.home')

@section('tatle', 'Create Files')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
       
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Files </h4>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }}</li>

                                @endforeach


                            </ul>

                        </div>


                        @endif


                        <form method="post" action="{{ route('files.store') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
							
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="exampleInputUsername2" placeholder="Name" value="{{ old('name')}}" require>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">File upload</label>
                                <div class="col-sm-9">
                                    <input type="file" name="file" class="form-control file-upload-info" require>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleFormControlSelect3" class="col-sm-3 col-form-label"> Published</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm" name="status" id="exampleFormControlSelect3" require>
                                        <option selected>เลือกสถานะ</option>
                                       
                                        <option @selected( old('status')== 1) value="1">แสดง</option>
                                        <option @selected( old('status')== 2) value="2">ไม่แสดง</option>
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row text-center">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-gradient-primary mr-2">Save</button>
                                    <a href="{{ route('files.index') }}" class="btn btn-light">Cancel</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
