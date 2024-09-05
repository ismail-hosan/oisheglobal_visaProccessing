@extends('backend_extra_path.layouts.master')

@section('title')
Message - {{$title}}
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
                    @if(helper::roleAccess('aboutus.index'))
                    <li class="breadcrumb-item"><a href="{{route('aboutus.index')}}">Message List</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit Message</span></li>
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
                <h3 class="card-title">About us</h3>
                <div class="card-tools">
                    @if(helper::roleAccess('message.message.create'))
                    <a class="btn btn-default" href="{{ route('message.message.create') }}"><i class="fas fa-plus"></i>
                        Add New</a>
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

                <form class="needs-validation" method="POST"
                    action="{{ route('message.message.update',$editInfo->id) }}" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Type * :</label>
                            <select class="form-control select2" name="type_id">
                                <option selected disabled value="">--Select Type--</option>
                                <option {{ $editInfo->type_id == 1 ? "selected" : "" }} value="1">Chairman</option>
                                <option {{ $editInfo->type_id == 2 ? "selected" : "" }} value="2">CTO</option>
                                <option {{ $editInfo->type_id == 3 ? "selected" : "" }} value="3">Director</option>
                                <option {{ $editInfo->type_id == 4 ? "selected" : "" }} value="4">Managing Director
                                </option>
                                <option {{ $editInfo->type_id == 5 ? "selected" : "" }} value="5">HR</option>
                                <option {{ $editInfo->type_id == 6 ? "selected" : "" }} value="6">Head Of Maketing
                                </option>
                                <option {{ $editInfo->type_id == 7 ? "selected" : "" }} value="7">Manager</option>
                                <option {{ $editInfo->type_id == 8 ? "selected" : "" }} value="8">Technical Manager
                                </option>
                                <option {{ $editInfo->type_id == 9 ? "selected" : "" }} value="9">Team Leader</option>
                                <option {{ $editInfo->type_id == 10 ? "selected" : "" }} value="10">Project Manager
                                </option>
                            </select>
                            @error('type_id')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Image * :</label>
                            <input type="file" name="image" class="form-control " id="validationCustom01"
                                placeholder="Name" value="{{ old('image') }}">
                            <input type="hidden" name="newimage" value="{{ $editInfo->image }}">
                            <img src="{{asset('public/backend/message/' . $editInfo->image)}}" width="50px">
                            @error('image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Name * :</label>
                            <input type="text" name="name" class="form-control" id="validationCustom01"
                                placeholder="Name" value="{{ $editInfo->name ?? '' }}">
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="desctiption">Message * :</label>
                            <textarea class="form-control summernote" name="message" id="desctiption" rows="5"
                                placeholder="Write about your company...">{{ $editInfo->message ?? '' }}</textarea>
                            @error('message')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>








                    </div>

                    <button class="btn btn-info" type="submit"><i class="fa fa-save"></i>&nbsp;Update</button>
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