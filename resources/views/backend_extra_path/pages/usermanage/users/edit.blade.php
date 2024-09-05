@extends('backend_extra_path.layouts.master')

@section('title')
usermanage - {{ $title }}
@endsection


@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    Usermanage </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('usermanage.user.index'))
                    <li class="breadcrumb-item"><a href="{{ route('usermanage.user.index') }}">User List</a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit User</span></li>
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
                <h3 class="card-title">{{ $title }}</h3>
                <div class="card-tools">
                    @if (helper::roleAccess('usermanage.user.index'))
                    <a class="btn btn-default" href="{{ route('usermanage.user.index') }}"><i class="fa fa-list"></i>
                        User List</a>
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
                    action="{{ route('usermanage.user.update', $userDetails->id) }}" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Name :</label>
                            <input type="text" name="name" class="form-control" id="validationCustom01"
                                placeholder="Name" value="{{ $userDetails->name }}">
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02"> Email * :</label>
                            <input type="text" name="email" class="form-control" id="validationCustom02"
                                placeholder="Email" value="{{ $userDetails->email }}" required>
                            @error('email')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Role Name * :</label>
                            <select name="role_name" id="" class="form-control ">
                                <option>--Select Role--</option>
                                @foreach ($userRoll as $key => $value)
                                <option {{ $userDetails->role_id == $value->id ? 'selected' : '' }}
                                    value="{{ $value->id }}">{{ $value->role_name }}</option>
                                @endforeach
                            </select>
                            @error('role_name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02"> Type *:</label>
                            <select name="type" id="utype" class="form-control select2"
                                onchange="showBranchDiv(this.value)">
                                <option {{ $userDetails->type == 'Admin' ? 'selected' : '' }} value="Admin">Admin
                                </option>
                                <option {{ $userDetails->type == 'Employee' ? 'selected' : '' }} value="Employee">
                                    Employee</option>
                                <option {{ $userDetails->type == 'Project' ? 'selected' : '' }} value="Project">
                                    Project</option>
                            </select>
                            @error('type')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>






                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02"> Phone * :</label>
                            <input type="text" name="phone" class="form-control" id="validationCustom02"
                                placeholder="Phone" value="{{ $userDetails->phone }}" required>
                            @error('phone')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Password * :</label>
                            <input type="password" name="password" class="form-control" id="validationCustom01"
                                placeholder="Password" value="{{ old('password') }}" required>
                            @error('password')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Confirm Password * :</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                id="validationCustom01" placeholder="Confirm Password"
                                value="{{ old('password_confirmation') }}" required>
                            @error('password_confirmation')
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


<script>
    function showBranchDiv(type) {
            if (type != "Project") {
                $("#showBranch").show(500);
            } else {
                $("#showBranch").hide(500);
            }
        }
</script>

<script>
    $(document).ready(function() {
            let utype = $("#utype").val();
            if (utype == "Project") {
                $("#showBranch").hide(500);
            } else {
                $("#showBranch").show(500);
            }
        });
</script>




@endsection