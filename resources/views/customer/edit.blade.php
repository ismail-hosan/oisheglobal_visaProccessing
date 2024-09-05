@extends('backend_extra_path.layouts.master')

@section('title')
Settings - {{$title}}
@endsection


@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    Application </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if(helper::roleAccess('settings.customer.index'))
                    <li class="breadcrumb-item"><a href="{{route('inventorySetup.customer.index')}}">Application List</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit Application</span></li>
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
                <h3 class="card-title">Application Edit</h3>
                <div class="card-tools">
                    <a class="btn btn-default" href="{{ route('barnch-user-list.create') }}"><i
                            class="fas fa-plus"></i>
                        Add New</a>
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
                    action="{{ route('application-list.update',$editInfo->id) }}" novalidate>
                    @csrf
                    <div class="form-row mb-3">
                            <div class="col-md-6">
                                <label for="">Visa Type</label>
                                <select name="visa_type" class="form-control select2"
                                    id="visaService">
                                    <option value selected>Select visa
                                        service</option>
                                    <option {{$editInfo->visa_type == "Work Pemit" ? "selected":""}} value="Work Pemit">Work Pemit</option>
                                    <option {{$editInfo->visa_type == "Visit Visa" ? "selected":""}} value="Visit Visa">Visit Visa</option>
                                    <option {{$editInfo->visa_type == "Garments" ? "selected":""}} value="Garments">Student Visa</option>
                                    <option {{$editInfo->visa_type == "Cleaning" ? "selected":""}} value="Cleaning">Business Visa</option>
                                    <option {{$editInfo->visa_type == "Garments" ? "selected":""}} value="Garments">Sponsor Visa</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Country</label>
                                <select name="country_id" class="form-control select2"
                                    >
                                    <option value>Select country</option>
                                    @foreach($countryNames as $countryName)
                                    <option {{$editInfo->country_id == $countryName->id ? "selected":""}} value="{{$countryName->id}}">{{$countryName->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3" id="countryError" class="error"></div>
                        </div>
                                 @if($editInfo->status == "Pending")
                        <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> &nbsp;Update</button>
                        @endif
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
