@extends('backend_extra_path.layouts.master')

@section('title')
Client - {{ $title }}
@endsection
@section('navbar-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Client </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('settings.slider.index'))
                    <li class="breadcrumb-item"><a href="{{ route('settings.slider.index') }}">Client
                        </a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Add New Slider</span></li>
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
                <h3 class="card-title">Add New Import Export</h3>
                <div class="card-tools">
                    @if (helper::roleAccess('project.image.index'))
                    <a class="btn btn-default" href="{{ route('project.image.index') }}"><i class="fa fa-list"></i>
                        Slider List</a>
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
                <form class="needs-validation" method="POST" action="{{ route('project.image.store') }}" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="title">Type :</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="Import">Import</option>
                                <option value="Export">Export</option>
                            </select>
                            @error('type')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="orderby">orderBy :</label>
                            <input type="text" name="orderby" class="form-control" id="orderby" placeholder="orderBy" value="{{ $editInfo->subtitle ?? '' }}">
                            @error('orderby')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="title">Item Name * :</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $editInfo->title ?? '' }}">
                            @error('title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Image *:</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">Short Description :</label>

                            <textarea class="form-control summernote" name="short_description" id="short_description" rows="5" placeholder="Write about your short description...">{{ $editInfo->description ?? '' }}</textarea>
                            @error('short_description')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">Description :</label>
                            <textarea class="form-control summernote" name="description" id="description" rows="5" placeholder="Write about your description...">{{ $editInfo->description ?? '' }}</textarea>
                            @error('description')
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


<script type="text/javascript" src="{{asset('public/editor/ckeditor.js')}}"></script>
<!--<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>-->
<script>
    var allEditors = document.querySelectorAll('.summernote');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(
            allEditors[i],{
                fontSize: {
                    options: [
                       12,13,14,16,18,20,22,24,26,28,30,32,34,36
                    ],
                    supportAllValues: true
                },
            }
        );
    }
</script>




@endsection