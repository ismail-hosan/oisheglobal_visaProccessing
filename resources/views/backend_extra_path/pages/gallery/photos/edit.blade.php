@extends('backend_extra_path.layouts.master')

@section('title')
Gallery - {{ $title }}
@endsection
@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Image </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('photos.index'))
                    <li class="breadcrumb-item"><a href="{{ route('photos.index') }}">Image
                        </a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit Image</span></li>
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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
                <h3 class="card-title">Edit Image</h3>
                <div class="card-tools">
                    @if (helper::roleAccess('photos.index'))
                    <a class="btn btn-default" href="{{ route('photos.index') }}"><i class="fa fa-list"></i>
                    Image List</a>
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
                    action="{{ route('photos.update',$photo->id) }}" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
                @if ($photo->image)
                    <img src="{{ asset('public/images/' . $photo->image) }}" width="100" alt="Current Image">
                @endif
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $photo->title }}">
            </div>
            <div class="form-group">
                <label for="meta">Meta</label>
                <textarea name="meta" class="form-control">{{ $photo->meta }}</textarea>
            </div>
            <div class="form-group">
                <label for="orderNo">Order No</label>
                <input type="number" name="orderNo" class="form-control" value="{{ $photo->orderNo }}">
            </div>
            <!-- <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="Active" {{ $photo->status == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ $photo->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div> -->
            <button type="submit" class="btn btn-primary">Update Photo</button>
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