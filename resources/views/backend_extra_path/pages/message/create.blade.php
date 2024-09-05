@extends('backend_extra_path.layouts.master')

@section('title')
Message - {{ $title }}
@endsection
@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Message </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('messge.messge.index'))
                    <li class="breadcrumb-item"><a href="{{ route('messge.messge.index') }}">Message
                            List</a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Add New Message</span></li>
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
                <h3 class="card-title">Add New Message</h3>
                <div class="card-tools">
                    @if (helper::roleAccess('message.message.index'))
                    <a class="btn btn-default" href="{{ route('message.message.index') }}"><i class="fa fa-list"></i>
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
                <form class="needs-validation" method="POST" action="{{ route('message.message.store') }}" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <div class=" form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Type * :</label>
                            <select class="form-control select2" name="type_id">
                                <option selected disabled value="">--Select Type--</option>
                                <option value="1">Chairman</option>
                                <option value="2">CTO</option>
                                <option value="3">Director</option>
                                <option value="4">Managing Director</option>
                                <option value="5">HR</option>
                                <option value="6">Head Of Maketing</option>
                                <option value="7">Manager</option>
                                <option value="8">Technical Manager</option>
                                <option value="9">Team Leader</option>
                                <option value="10">Project Manager</option>
                            </select>
                            @error('type_id')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Image * :</label>
                            <input type="file" name="image" class="form-control " id="validationCustom01"
                                placeholder="Name" value="{{ old('image') }}">
                            @error('image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Name * :</label>
                            <input type="text" name="name" class="form-control" id="validationCustom01"
                                placeholder="Name" value="{{ old('name') }}">
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description">Message * :</label>
                            <textarea class="form-control summernote" name="message" id="description" rows="5"
                                placeholder="Write about your company..."></textarea>
                            @error('message')
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