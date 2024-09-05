@extends('backend_extra_path.layouts.master')

@section('title')
Why Choose - {{ $title }}
@endsection
@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Why Choose </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('why.why.index'))
                    <li class="breadcrumb-item"><a href="{{ route('why.why.index') }}">Why Choose
                            List</a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Add New Why Choose</span></li>
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
                <h3 class="card-title">Add New Why Choose</h3>
                <div class="card-tools">
                    @if (helper::roleAccess('why.why.index'))
                    <a class="btn btn-default" href="{{ route('why.why.index') }}"><i class="fa fa-list"></i>
                        Why Choose List</a>
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
                <form class="needs-validation" method="POST" action="{{ route('why.why.store') }}" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="">Title * :</label>
                            <input type="text" name="title" class="form-control " id="" placeholder="Title"
                                value="{{ old('title') }}">
                            @error('title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Fa Icon * :</label>
                            <input type="text" name="fa_icon" class="form-control " id=""
                                placeholder="Ex: fa fa-facebook" value="{{ old('fa_icon') }}">
                            @error('fa_icon')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Serial * :</label>
                            <input type="text" name="serial" class="form-control " id="" placeholder="serial"
                                value="{{ old('serial') }}">
                            @error('serial')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description">Details * :</label>
                            <textarea class="form-control summernote" name="details" id="description" rows="5"
                                placeholder="Write about your company...">{{ old('details') }}</textarea>
                            @error('details')
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