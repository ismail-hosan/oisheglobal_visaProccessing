@extends('backend_extra_path.layouts.master')

@section('title')
Client - {{ $title }}
@endsection
@section('navbar-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Coustomer </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('settings.slider.index'))
                    <li class="breadcrumb-item"><a href="{{ route('settings.slider.index') }}">Coustomer
                        </a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Our Client</span></li>
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
                <h3 class="card-title">Edit Slider</h3>
                <div class="card-tools">

                    <a class="btn btn-default" href="{{ route('settings.slider.index') }}"><i class="fa fa-list"></i>
                        Client List</a>

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
                <form class="needs-validation" method="POST" action="{{ route('slider.update',$slider->id) }}"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Type *:</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="Top" {{ $slider->type == 'Top' ? 'selected' : '' }}>Top</option>
                                <option value="Consern" {{ $slider->type == 'Consern' ? 'selected' : '' }}>Import/Export</option>
                            </select>
                            @error('type')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Image *:</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Title *:</label>
                            <input type="text" class="form-control" name="title" value="{{$slider->title}}">
                            @error('title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="alt">alt:</label>
                            <input type="text" name="alt" class="form-control" id="alt"
                                placeholder="alt" value="{{ $slider->alt }}">
                            @error('alt')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Order By *:</label>
                            <input type="number" name="orderby" class="form-control" value="{{ $slider->order_by }}">
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> &nbsp;Update</button>
                </form>
            </div>
            <!-- /.card-body -->
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
        </div>
    </div>
    <!-- /.col-->
</div>










@endsection