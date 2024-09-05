@extends('backend_extra_path.layouts.master')

@section('title')
{{ config('app.name', 'IT WAY BD') }} - {{$title}}
@endsection


@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    Inventory </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if(helper::roleAccess('inventorySetup.category.index'))
                    <li class="breadcrumb-item"><a href="{{route('inventorySetup.category.index')}}">Category List</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit Category</span></li>
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
                <h3 class="card-title">Category List</h3>
                <div class="card-tools">
                    @if(helper::roleAccess('inventorySetup.category.create'))
                    <a class="btn btn-default" href="{{ route('inventorySetup.category.create') }}"><i
                            class="fas fa-plus"></i>
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
                    action="{{ route('inventorySetup.category.update',$editInfo->id) }}" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="parent_id">Parent Name * :</label>
                            <select class="form-control select2" name="parent_id">
                                <option selected disabled value="">--Select Parent--</option>
                                {{-- <option value="0">Root Cateogry</option> --}}
                                @foreach ($category as $key => $value)
                                <option value="{{ $value->id }}" {{$value->id == $editInfo->parent_id? 'selected' :
                                    ''}}>{{ $value->name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="submenu">Sub Menu * :</label>
                            <select class="form-control select2" name="submenu">
                                <option selected disabled value="">--Select Submenu--</option>
                                @foreach ($products as $key => $product)
                                <option
                                    value="{{ ($product->slug ?? 'slug-nai') .','. $product_model.','.$product->title }}"
                                    {{$product->slug == $editInfo->slug ? 'selected' :''}}>
                                    {{
                                    $product->title }}</option>
                                @endforeach
                            </select>
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Name * :</label>
                            <input type="text" name="name" class="form-control" id="validationCustom01"
                                placeholder="Name" value="{{ old('name') }}">
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        {{-- <div class="col-md-6 mb-3">
                            <label for="route_name">Route Name * :</label>
                            <input type="text" name="route_name" class="form-control" id="route_name"
                                placeholder="Route Name" value="{{ old('route_name') }}" required>
                            @error('route_name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="col-md-6 mb-3">
                            <label for="order_by">Serial No * :</label>
                            <input type="number" name="order_by" class="form-control" id="order_by"
                                placeholder="Serial No" value="{{ old('order_by') }}" required>
                            @error('order_by')
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