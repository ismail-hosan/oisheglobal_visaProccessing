@extends('backend_extra_path.layouts.master')
@section('title')
inventory - {{$title}}
@endsection

@section('styles')
<style>
    .bootstrap-switch-large {
        width: 200px;
    }
</style>
@endsection

@section('navbar-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    Inventory </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home') }}">Dashboard</a></li>
                    @if(helper::roleAccess('inventorySetup.customer.index'))
                    <li class="breadcrumb-item"><a href="{{route('inventorySetup.customer.index') }}">Customer</a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Customer List</span></li>
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
                <h3 class="card-title">Branch User List</h3>
                <div class="card-tools">
                  
                    <a class="btn btn-default" href="{{ route('barnch-user-list.create') }}"><i
                            class="fas fa-plus"></i>Add New</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="systemDatatable" class="display table-hover table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Customer Name</th>
                                <th>Branch</th>
                                <th>Type</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SL</th>
                                <th>Customer Name</th>
                                <th>Branch</th>
                                <th>Type</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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
@include('backend_extra_path.pages.branch.script')
@endsection