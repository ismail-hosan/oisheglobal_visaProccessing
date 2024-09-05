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
                    Settings </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if(helper::roleAccess('settings.customer.index'))
                    <li class="breadcrumb-item"><a href="{{route('inventorySetup.customer.index')}}">Customer List</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit Customer</span></li>
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
                <h3 class="card-title">Agent Edit</h3>
                <div class="card-tools">
                    @if(helper::roleAccess('inventorySetup.customer.create'))
                    <a class="btn btn-default" href="{{ route('inventorySetup.customer.create') }}"><i
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

                <form class="needs-validation" method="POST" action="{{ route('agent.update', $editInfo->id) }}" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Agent Name * :</label>
                            <input type="text" name="name" class="form-control" id="validationCustom01"
                                placeholder="Customer Name" value="{{ $editInfo->name }}">
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02"> E-mail :</label>
                            <input type="text" name="email" class="form-control" id="validationCustom02"
                                placeholder="E-mail" value="{{ $editInfo->email  }}" required>
                            @error('email')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Branch Name * :</label>
                            <select class="form-control select2" name="branch_id">
                                <option selected disabled value="">--Select--</option>
                                <option value="0">Branch</option>
                                @foreach($branchs as $key => $value)
                                <option <?php if ($editInfo->branch_id == $value->id) {
                                            echo 'selected="selected"';
                                        } ?>
                                    value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                            @error('branch_id')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Phone * :</label>
                            <input type="text" name="phone" class="form-control" id="validationCustom01"
                                placeholder="Phone" value="{{ $editInfo->phone ?? ''}}" required>
                            @error('phone')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Address* :</label>
                            <input name="address" class="form-control" id="validationCustom02" placeholder="Address"
                                value="{{ $editInfo->address  }}" required>
                            @error('address')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Password :</label>
                            <input type="text" name="password" class="form-control" id="password" placeholder="password........." required>
                            @error('password')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Agent Code:</label>
                            <input type="text" name="agent_code" class="form-control" id="validationCustom01" placeholder="Agent Code" value="{{ $editInfo->code ?? ''}}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom04">Mobile:</label>
                            <input type="text" name="mobile" class="form-control" id="validationCustom04" placeholder="Mobile" value="{{ $editInfo->phone ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom05">NID No:</label>
                            <input type="text" name="nid" class="form-control" id="validationCustom05" placeholder="NID No" value="{{ $editInfo['agentData']['nid_no'] ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom06">Father's Name:</label>
                            <input type="text" name="father_name" class="form-control" id="validationCustom06" placeholder="Father's Name" value="{{ $editInfo['agentData']['father_name'] ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom07">Mother's Name:</label>
                            <input type="text" name="mother_name" class="form-control" id="validationCustom07" placeholder="Mother's Name" value="{{ $editInfo['agentData']['mother_name'] ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom08">RL No:</label>
                            <input type="text" name="rl_no" class="form-control" id="validationCustom08" placeholder="RL No" value="{{ $editInfo['agentData']['rl_no'] ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom09">Passport No:</label>
                            <input type="text" name="passport_no" class="form-control" id="validationCustom09" placeholder="Passport No" value="{{ $editInfo['agentData']['passport_no'] ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom10">Permanent Address:</label>
                            <input type="text" name="permanent_address" class="form-control" id="validationCustom10" placeholder="Permanent Address" value="{{ $editInfo['agentData']['permanent_address'] ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom11">Company Name:</label>
                            <input type="text" name="company_name" class="form-control" id="validationCustom11" placeholder="Company Name" value="{{ $editInfo['agentData']['company_name'] ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom12">TIN Number:</label>
                            <input type="text" name="tin_number" class="form-control" id="validationCustom12" placeholder="TIN Number" value="{{ $editInfo['agentData']['tin_number'] ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom13">Company Address:</label>
                            <input type="text" name="company_address" class="form-control" id="validationCustom13" placeholder="Company Address" value="{{ $editInfo['agentData']['company_address'] ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom14">Trade License No:</label>
                            <input type="text" name="trade_license_no" class="form-control" id="validationCustom14" placeholder="Trade License No" value="{{ $editInfo['agentData']['trade_license_no'] ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom15">BIN Number:</label>
                            <input type="text" name="bin_number" class="form-control" id="validationCustom15" placeholder="BIN Number" value="{{ $editInfo['agentData']['bin_number'] ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom16">Business Year:</label>
                            <input type="text" name="business_year" class="form-control" id="validationCustom16" placeholder="Business Year" value="{{ $editInfo['agentData']['bussiness_year'] ?? ''}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom17">Personal:</label>
                            <input type="file" name="personal_image" class="form-control" id="validationCustom17">
                            @if ($editInfo['agentData']['personal_image'] ?? '')
                            <img src="{{ asset('public/' . $editInfo['agentData']['personal_image']) }}" width="100" alt="Personal">
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom18">Passport:</label>
                            <input type="file" name="passport_image" class="form-control" id="validationCustom18">
                            @if ($editInfo['agentData']['passport_image'] ?? '')
                            <img src="{{ asset('public/' . $editInfo['agentData']['passport_image']) }}" width="100" alt="Passprt">
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom19">RL Certificate:</label>
                            <input type="file" name="rl_image" class="form-control" id="validationCustom19">
                            @if ($editInfo['agentData']['rld_image'] ?? '')
                            <img src="{{ asset('public/' . $editInfo['agentData']['rld_image']) }}" width="100" alt="Rl certificate">
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom20">NID Front:</label>
                            <input type="file" name="nid_front" class="form-control" id="validationCustom20">
                            @if ($editInfo['agentData']['nid_front'] ?? '')
                            <img src="{{ asset('public/' . $editInfo['agentData']['nid_front']) }}" width="100" alt="Nid Front">
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom21">NID Back:</label>
                            <input type="file" name="nid_back" class="form-control" id="validationCustom21">
                            @if ($editInfo['agentData']['nid_back'] ?? '')
                            <img src="{{ asset('public/' . $editInfo['agentData']['nid_back']) }}" width="100" alt="Nid back">
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom22">Trade Certificate:</label>
                            <input type="file" name="trade_image" class="form-control" id="validationCustom22">
                            @if ($editInfo['agentData']['trade_image'] ?? '')
                            <img src="{{ asset('public/' . $editInfo['agentData']['trade_image']) }}" width="100" alt="Trade Image">
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom23">TIN Certificate:</label>
                            <input type="file" name="tin_image" class="form-control" id="validationCustom23">
                            @if ($editInfo['agentData']['tin_image'] ?? '')
                            <img src="{{ asset('public/' . $editInfo['agentData']['tin_image']) }}" width="100" alt="Tin Image">
                            @endif
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