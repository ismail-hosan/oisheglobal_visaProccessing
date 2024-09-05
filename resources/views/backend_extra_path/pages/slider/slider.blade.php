@extends('backend_extra_path.layouts.master')
@section('title')
{{ $title }}
@endsection
@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Slider </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('blog.index'))
                    <li class="breadcrumb-item"><a href="{{ route('settings.slider.index') }}">Slider
                            List</a></li>
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

                <div class="card-tools">
                    @if (helper::roleAccess('settings.slider.index'))
                    <a class="btn btn-default" href="{{ route('settings.slider.index') }}"><i class="fa fa-list"></i>
                        Blog List</a>
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
                <form class="needs-validation" method="POST" action="{{ route('settings.slider.store') }}" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <div class=" form-row">
                        <div class="col-md-6 mb-3">
                            <label for="">Alt * :</label>
                            <input type="text" name="title" class="form-control" placeholder="Title"
                                value="{{ old('title') }}">
                            @error('title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image * : <samp class="text-red">1920*520</samp></label>
                            <input type="file" name="image" class="form-control" value="{{ old('image') }}">
                            @error('image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> &nbsp;Save</button>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <img src="{{asset('public/storage/slider/slider-1641290259.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>

@endsection