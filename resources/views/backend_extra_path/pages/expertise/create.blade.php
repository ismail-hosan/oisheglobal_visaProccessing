@extends('backend_extra_path.layouts.master')

@section('title')
Expertises - {{ $title }}
@endsection
@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Expertises </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('expertises.expertises.index'))
                    <li class="breadcrumb-item"><a href="{{ route('expertises.expertises.index') }}">Expertises
                            List</a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Add New Expertises</span></li>
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
                <h3 class="card-title">Add New Expertises</h3>
                <div class="card-tools">
                    @if (helper::roleAccess('expertises.expertises.index'))
                    <a class="btn btn-default" href="{{ route('expertises.expertises.index') }}"><i
                            class="fa fa-list"></i>
                        Expertises List</a>
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
                <form class="needs-validation" method="POST" action="{{ route('expertises.expertises.store') }}"
                    novalidate enctype="multipart/form-data">
                    @csrf
                    <div class=" form-row">

                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Image * :</label>
                            <input type="file" name="image" class="form-control " id="validationCustom01"
                                placeholder="Name" value="{{ old('image') }}">
                            @error('image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="alt">Image Alternative Text :</label>
                            <input type="text" name="alt" class="form-control" id="alt"
                                placeholder="Image Alternative Text">
                            @error('alt')
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