@extends('backend_extra_path.layouts.master')

@section('title')
Gallery - {{ $title }}
@endsection
@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Video </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('videos.index'))
                    <li class="breadcrumb-item"><a href="{{ route('videos.index') }}">Video
                        </a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>{{ isset($video) ? 'Edit' : 'Add New' }}  Video</span></li>
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
                <h3 class="card-title">{{ isset($video) ? 'Edit' : 'Add New' }}  Video</h3>
                <div class="card-tools">
                    @if (helper::roleAccess('videos.index'))
                    <a class="btn btn-default" href="{{ route('videos.index') }}"><i class="fa fa-list"></i>
                    Video List</a>
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
                <form class="needs-validation" method="POST" action="{{ isset($video) ? route('videos.update', $video->id) : route('videos.store') }}"
                    enctype="multipart/form-data" novalidate>
                    @csrf
    

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ isset($video) ? $video->title : old('title') }}" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Link:</strong>
                    <input type="text" name="link" value="{{ isset($video) ? $video->link : old('link') }}" class="form-control" placeholder="Link">
                </div>
            </div>
            @if(isset($video) && preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video->link, $matches))
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $matches[1] }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            @endif
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Meta:</strong>
                    <textarea class="form-control" style="height:150px" name="meta" placeholder="Meta">{{ isset($video) ? $video->meta : old('meta') }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Order Number:</strong>
                    <input type="number" name="orderNo" value="{{ isset($video) ? $video->orderNo : old('orderNo') }}" class="form-control" placeholder="Order Number">
                </div>
            </div>
            <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select class="form-control" name="status">
                        <option value="Active" {{ isset($video) && $video->status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ isset($video) && $video->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div> -->
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{ isset($video) ? 'Update' : 'Submit' }}</button>
            </div>
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