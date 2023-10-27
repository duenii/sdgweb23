@extends('layouts.home')

@section('tatle', 'Create category')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        {{-- <div class="page-header">
            <h3 class="page-title"> Edit Form PostNews </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form PostNews</li>
                </ol>
            </nav>
        </div> --}}
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit category </h4>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }}</li>

                                @endforeach


                            </ul>

                        </div>


                        @endif


                        <form action="{{ route('category.update', $category->id) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" id="exampleInputUsername2" placeholder="Title" value="{{ $category->name }}" require>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">File upload</label>
                                <div class="col-sm-9">
                                    <input type="file" name="file" class="form-control file-upload-info" value="{{ $category->cover }}" require>
                                     <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ $category->cover }}</label> 
                                    <img src="{{ asset('/storage/images/category/thumbnail').'/'. $category->cover }}" alt="images" width="150px">
                                </div>
                                
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleTextarea1" class="col-sm-3 col-form-label">content</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="content" id="summernote" require> {{ $category->content }} </textarea>
                                </div>
                            </div>

                      

                            <div class="form-group row text-center">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-gradient-primary mr-2">Save</button>
                                    <a href="{{ route('category.index') }}" class="btn btn-light">Cancel</a>
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

@section('scripts')

<!-- summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 400
        });

    });
</script>

@endsection