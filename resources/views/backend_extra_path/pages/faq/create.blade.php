@extends('backend_extra_path.layouts.master')

@section('title')
FAQ - {{ $title }}
@endsection
@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> FAQ </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('faq.faq.index'))
                    <li class="breadcrumb-item"><a href="{{ route('faq.faq.index') }}">FAQ
                            List</a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Add New FAQ</span></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('admin-content')


<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Add New Faq</h3>
                <div class="card-tools">
                    @if (helper::roleAccess('faq.faq.index'))
                    <a class="btn btn-default" href="{{ route('faq.faq.index') }}"><i class="fa fa-list"></i>
                        Category List</a>
                    @endif
                    <span id="buttons"></span>

                    <a class="btn btn-tool btn-default" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </a>
                    <a class="btn btn-tool btn-default" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form class="needs-validation" method="POST" action="{{ route('faq.faq.store') }}" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <div class=" form-row">

                        <div class="col-md-3 mb-3">
                            <label for="validationCustom01">Category Name * :</label>
                            <select class="form-control select2" id="menu_id" name="menu_id">
                                <option selected disabled value="">--Select--</option>
                                @foreach ($category as $key => $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->name }}</option>
                                @endforeach
                            </select>

                            @error('menu_id')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom01">Service Category * :</label>
                            <select class="form-control select2" id="category_id" name="category_id">
                                <option selected disabled value="">--Select--</option>
                                @foreach ($category_cat as $key => $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->title }}</option>
                                @endforeach
                            </select>

                            @error('category_id')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom01">Question * :</label>
                            <input type="text" name="question" class="form-control" id="validationCustom01"
                                placeholder="Question" value="{{ old('question') }}">
                            @error('question')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom01">Serial * :</label>
                            <input type="text" name="serial" class="form-control" id="validationCustom01"
                                placeholder="Serial" value="{{ old('serial') }}">
                            @error('serial')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="desctiption">Answer * :</label>
                            <textarea class="form-control summernote" name="answer" id="desctiption" rows="5"
                                placeholder="Write about your company..."></textarea>
                            @error('answer')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>


                    </div>
                    <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> &nbsp;Save</button>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
        </div>
    </div>
    <!-- /.col-->
</div>

@endsection


@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
<script>
    var allEditors = document.querySelectorAll('.summernote');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i]);
    }
</script>
@endsection