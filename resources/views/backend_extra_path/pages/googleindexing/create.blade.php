@extends('backend_extra_path.layouts.master')

@section('title')
Google Indexing
@endsection
@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Google Indexing </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    
                    <li class="breadcrumb-item active"><span>Add New index</span></li>
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
                <h3 class="card-title">Add New google index</h3>
                
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form class="needs-validation" method="POST" action="{{ route('indexing.store') }}">
                    @csrf
                    <div class=" form-row">
                        <div class="col-md-4 mb-3">
                            <label for="">URL * :</label>
                            <input type="text" name="url" class="form-control" placeholder="url"
                                value="{{ old('url') }}">
                            @error('url')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>


                    <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> &nbsp;Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>

@endsection
