@extends('backend_extra_path.layouts.master')
@section('title')
Team - {{ $title }}
@endsection
@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Team </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('team.team.index'))
                    <li class="breadcrumb-item"><a href="{{ route('team.team.index') }}">Team
                            List</a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Add New Team</span></li>
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
                <h3 class="card-title">Add New Team</h3>
                <div class="card-tools">
                    @if (helper::roleAccess('team.team.index'))
                    <a class="btn btn-default" href="{{ route('team.team.index') }}"><i class="fa fa-list"></i>
                        Team List</a>
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
                <form class="needs-validation" method="POST" action="{{ route('team.team.store') }}" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label>Department * :</label>
                            <select name="department_id" class="form-control select2" id="">
                                <option selected disabled> Select A Department</option>
                                <option value="Management Team">Management Team</option>
                                <option value="Operational Team">Operational Team</option>
                                <option value="Software Development Team">Software Development Team</option>
                                <option value="Web Development Team">Web Development Team</option>
                                <option value="Creative Team">Creative Team</option>
                                <option value="Apps Development Team">Apps Development Team</option>
                                <option value="Sales & Marketing Team">Sales & Marketing Team</option>
                                <option value="HR & Accounts Team">HR & Accounts Team</option>
                               

                            </select>
                            @error('department_id')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Designation * :</label>
                            <select name="designation_id" class="form-control select2" id="">
                                <option selected disabled> Select A Designation</option>
                                <option value="Chairman">Chairman</option>
                                <option value="CEO">CEO</option>
                                <option value="Head of Sales">Head of Sales</option>
                                <option value="Director">Director</option>
                                <option value="Chief Operational Officer">Chief Operational Officer</option>
                                <option value="Operation Manager">Operation Manager</option>
                                <option value="Team Leader">Team Leader</option>
                                <option value="Sr. Software Engineer">Sr. Software Engineer</option>
                                <option value="Sr. Programmer">Sr. Programmer</option>
                                <option value="Software Developer">Software Developer</option>
                                <option value="Jr. Software Engineer">Jr. Software Engineer</option>
                                <option value="Sr. Web Developer">Sr. Web Developer</option>
                                <option value="Executive Business Development">Executive Business Development</option>
                                <option value="Teli Sales">Teli Sales</option>
                                <option value="Jr. Web Developer">Jr. Web Developer</option>
                                <option value="Front End Developer">Front End Developer</option>
                                <option value="Web Developer">Web Developer</option>
                                <!--<option value="SEO Consultant">SEO Consultant</option>-->
                                <option value="Graphics Designer">Graphics Designer</option>
                                <option value="Sales & Marketing">Sales & Marketing</option>
                                <option value="Executive">Executive</option>
                                <option value="HR Manager">HR Manager</option>
                                <option value="Technical Manager">Technical Manager</option>
                                <option value="TELE MARKETING">TELE MARKETING</option>
                                <option value="TECHNICAL CONSULTANT">TECHNICAL CONSULTANT</option>
                                <option value="SEO Expert">SEO Expert</option>
                                <option value="App Developer">App Developer</option>
                                <option value="Sr. App Developer">Sr. App Developer</option>
                                 <option value="Jr. App Developer">Jr. App Developer</option>
                                 <option value="Head Of Operation">Head Of Operation</option>
                                 <option value="Internship">Internship</option>
                                 <option value="Executive Support">Executive Support</option>
                                 <option value="HR & ACCOUNTS">HR & ACCOUNTS</option>
                            </select>
                            @error('designation_id')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Name * :</label>
                            <input type="text" name="name" class="form-control " placeholder="Name"
                                value="{{ old('name') }}">
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Serial * :</label>
                            <input type="text" name="serial" class="form-control " placeholder="Ex: 1"
                                value="{{ old('serial') }}">
                            @error('serial')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image * <samp style="color: rgb(139, 0, 0);">(322x280
                                    px)</samp>:</label>
                            <input type="file" name="image" class="form-control " placeholder="Name"
                                value="{{ old('image') }}">
                            @error('image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">Short Designation :</label>

                            <textarea class="form-control summernote" name="s_degination" id="s_degination" rows="5" placeholder="Write about your company...">{{ $editInfo->description ?? '' }}</textarea>
                            @error('s_degination')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
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

<script type="text/javascript" src="{{asset('public/editor/ckeditor.js')}}"></script>
<!--<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>-->
<script>
    var allEditors = document.querySelectorAll('.summernote');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(
            allEditors[i],{
                fontSize: {
                    options: [
                       12,13,14,16,18,20,22,24,26,28,30,32,34,36
                    ],
                    supportAllValues: true
                },
            }
        );
    }
</script>




@endsection