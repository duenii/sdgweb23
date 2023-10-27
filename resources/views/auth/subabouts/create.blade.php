@extends('layouts.home')

@section('tatle', 'Create Postabouts')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        {{-- <div class="page-header">
            <h3 class="page-title"> Add Form Postabouts </h3>
           
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form Postabouts</li>
                </ol>
            </nav>
        </div> --}}
        <div class="row">

            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Create Submenu </h4>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li> {{ $error }}</li>

                                @endforeach


                            </ul>

                        </div>


                        @endif


                        <form method="post" action="{{ route('subabouts.store') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="exampleFormControlSelect3" class="col-sm-3 col-form-label">Main Menu</label>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-sm" name="postabouts" id="exampleFormControlSelect3" require>
                                        <option selected>เลือกเมนูหลัก</option>
                                        @if (count($postabouts) > 0)
                                        @foreach($postabouts as $about_row)
                                        <option @selected( old('category')== $about_row->id ) value="{{ $about_row->id }}">{{ $about_row->title }}</option>

                                        @endforeach

                                        @endif
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">tatle submenu</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" class="form-control" id="exampleInputUsername2" placeholder="Title" value="{{ old('title')}}" require>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">link</label>
                                <div class="col-sm-9">
                                    <input type="text" name="link" class="form-control" id="exampleInputUsername2" placeholder="link" value="{{ old('link')}}" require>
                                </div>
                            </div>                       

                            <div class="form-group row">
                                <label for="exampleTextarea1" class="col-sm-3 col-form-label">content</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="content" id="summernote" require> {{ old('content') }} </textarea>
                                </div>
                            </div>

                            <div class="form-group row text-center">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-gradient-primary mr-2">Save</button>
                                    <a href="{{ route('subabouts.index') }}" class="btn btn-light">Cancel</a>
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