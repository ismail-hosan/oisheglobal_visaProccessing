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
                <h3 class="card-title">Edit Branch</h3>
                <div class="card-tools">
                  
                    <a class="btn btn-default" href="{{ route('project.index') }}"><i class="fa fa-list"></i>
                        Branch List</a>
                   
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
                <form class="needs-validation" method="POST" action="{{ route('project.update',$project->id) }}"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Name*:</label>
                            <input type="text" class="form-control" name="name" value="{{$project->name}}">
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Email*:</label>
                            <input type="email" class="form-control" name="email" value="{{$project->email??''}}">
                            @error('email')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Phone*:</label>
                            <input type="number" class="form-control" name="phone" value="{{$project->phone??''}}">
                            @error('phone')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Address*:</label>
                            <input type="text" class="form-control" name="address" value="{{$project->address??''}}">
                            @error('address')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Order By *:</label>
                            <input type="number" name="orderby" class="form-control" value="{{ $project->order_by}}">
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