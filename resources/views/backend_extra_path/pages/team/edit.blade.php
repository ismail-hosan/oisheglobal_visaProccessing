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

                <form class="needs-validation" method="POST" action="{{ route('team.team.update', $editInfo->id) }}"
                    novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label>Department * :</label>
                            <select name="department_id" class="form-control select2" id="">
                                <option selected disabled> Select A Department</option>
                                <option {{ $editInfo->department_id == 'Management Team' ? "selected" : "" }}
                                    value="Management Team">Management Team</option>
                                <option {{ $editInfo->department_id == 'Operational Team' ? "selected" : "" }}
                                    value="Operational Team">Operational Team</option>
                                <option {{ $editInfo->department_id == 'Software Development Team' ? "selected" : "" }}
                                    value="Software Development Team">
                                    Software Development Team</option>
                                <option {{ $editInfo->department_id == 'Web Development Team' ? "selected" : "" }}
                                    value="Web Development Team">Web Development Team</option>
                                <option {{ $editInfo->department_id == 'Creative Team' ? "selected" : "" }}
                                    value="Creative Team">Creative Team</option>
                                <option {{ $editInfo->department_id == 'Apps Development Team' ? "selected" : "" }}
                                    value="Apps Development Team">Apps Development Team</option>
                                <option {{ $editInfo->department_id == 'Sales & Marketing Team' ? "selected" : "" }}
                                    value="Sales & Marketing Team">Sales & Marketing Team</option>
                                <option {{ $editInfo->department_id == 'HR & Accounts Team' ? "selected" : "" }}
                                    value="HR & Accounts Team">HR & Accounts Team</option>
                               
                                    
                            </select>
                            @error('department_id')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Designation * :</label>
                            <select name="designation_id" class="form-control select2" id="">
                                <option selected disabled> Select A Designation</option>
                                <option {{ $editInfo->designation_id == 'Chairman' ? "selected" : "" }}
                                    value="Chairman">
                                    Chairman</option>
                                <option {{ $editInfo->designation_id == 'CEO' ? "selected" : "" }} value="CEO">CEO
                                </option>
                                <option {{ $editInfo->designation_id == 'Director' ? "selected" : "" }}
                                    value="Director">
                                    Director</option>
                                <option {{ $editInfo->designation_id == 'Chief Operational Officer' ? "selected" : "" }}
                                    value="Chief Operational Officer">Chief Operational Officer</option>
                                <option {{ $editInfo->designation_id == 'Team Leader' ? "selected" : "" }}
                                    value="Team Leader">Team Leader</option>
                                <option {{ $editInfo->designation_id == 'Sr. Software Engineer' ? "selected" : "" }}
                                    value="Sr. Software Engineer">Sr. Software Engineer</option>
                                <option {{ $editInfo->designation_id == 'Sr. Programmer' ? "selected" : "" }}
                                    value="Sr. Programmer">Sr. Programmer</option>
                                <option {{ $editInfo->designation_id == 'Software Developer' ? "selected" : "" }}
                                    value="Software Developer">Software Developer</option>
                                <option {{ $editInfo->designation_id == 'Jr. Software Engineer' ? "selected" : "" }}
                                    value="Jr. Software Engineer">Jr. Software Engineer</option>
                                <option {{ $editInfo->designation_id == 'Sr. Web Developer' ? "selected" : "" }}
                                    value="Sr. Web Developer">Sr. Web Developer</option>
                                <option {{ $editInfo->designation_id == 'Jr. Web Developer' ? "selected" : "" }}
                                    value="Jr. Web Developer">Jr. Web Developer</option>
                                <option {{ $editInfo->designation_id == 'Front End Developer' ? "selected" : "" }}
                                    value="Front End Developer">Front End Developer</option>
                                <option {{ $editInfo->designation_id == 'Web Developer' ? "selected" : "" }}
                                    value="Web Developer">Web Developer</option>
                                <option {{ $editInfo->designation_id == 'Designer' ? "selected" : "" }}
                                    value="Designer">
                                    Designer</option>
                                <option {{ $editInfo->designation_id == 'Graphics Designer' ? "selected" : "" }}
                                    value="Graphics Designer">Graphics Designer</option>
                                <option {{ $editInfo->designation_id == 'Sales & Marketing' ? "selected" : "" }}
                                    value="Sales & Marketing">Sales & Marketing</option>
                                <option {{ $editInfo->designation_id == 'Executive' ? "selected" : "" }}
                                    value="Executive">Executive</option>
                                    <option {{ $editInfo->designation_id == 'Operation Manager' ? "selected" : "" }}
                                        value="Operation Manager">Operation Manager</option>
                                    <option {{ $editInfo->designation_id == 'Teli Sales' ? "selected" : "" }}
                                        value="Teli Sales">Teli Sales</option>
                                    <option {{ $editInfo->designation_id == 'Executive Business Development' ? "selected" : "" }}
                                        value="Executive Business Development">Executive Business Development</option>
                                <option {{ $editInfo->designation_id == 'HR Manager' ? 'selected' : ''}} value="HR
                                    Manager">HR Manager</option>
                                <option {{ $editInfo->designation_id == 'Technical Manager' ? 'selected' : ''}}
                                    value="Technical Manager">Technical Manager</option>
                                <option {{ $editInfo->designation_id == 'TELE MARKETING' ? 'selected' : ''}} value="TELE
                                    MARKETING">TELE MARKETING</option>
                                <option {{ $editInfo->designation_id == 'TECHNICAL CONSULTANT' ? 'selected' : ''}}
                                    value="TECHNICAL CONSULTANT">TECHNICAL CONSULTANT</option>
                                <option {{ $editInfo->designation_id == 'SEO Expert' ? 'selected' : ''}} value="SEO
                                    Expert">SEO Expert</option>
                                <option {{ $editInfo->department_id == 'Sr. App Developer' ? "selected" : "" }}
                                    value="Sr. App Developer">Sr. App Developer</option>
                                <option {{ $editInfo->department_id == 'Jr. App Developer' ? "selected" : "" }}
                                    value="Jr. App Developer">Jr. App Developer</option>
                                <option {{ $editInfo->department_id == 'Head Of Operation' ? "selected" : "" }}
                                    value="Head Of Operation">Head Of Operation</option>
                                <option {{ $editInfo->department_id == 'Manager Business Development' ? "selected" : "" }}
                                    value="Manager Business Development">Manager Business Development</option>
                                <option {{ $editInfo->department_id == 'HR & ACCOUNTS' ? "selected" : "" }}
                                    value="HR & ACCOUNTS">HR & ACCOUNTS</option>
                                <option {{ $editInfo->department_id == 'Internship' ? "selected" : "" }}
                                    value="Internship">Internship</option>
                                <option {{ $editInfo->department_id == 'Executive Support' ? "selected" : "" }}
                                    value="Executive Support">Executive Support</option>
                                    
                            </select>
                            @error('designation_id')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Name * :</label>
                            <input type="text" name="name" class="form-control " placeholder="Name"
                                value="{{ $editInfo->name }}">
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Serial * :</label>
                            <input type="text" name="serial" class="form-control " placeholder="Ex:1"
                                value="{{ $editInfo->serial }}">
                            @error('serial')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Image * <samp style="color: rgb(139, 0, 0);">(480x480
                                    px)</samp>:</label>
                            <input type="file" name="image" class="form-control " placeholder="Name"
                                value="{{ old('image') }}">
                            <input type="hidden" name="newimage" value="{{ $editInfo->image }}">
                            <img src="{{asset('public/backend/team/' . $editInfo->image)}}" width="50px">
                            @error('image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">Short Designation :</label>

                            <textarea class="form-control summernote" name="s_degination" id="s_degination" rows="5" placeholder="Write about your company...">{{ $editInfo->s_degination ?? '' }}</textarea>
                            @error('s_degination')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="alt">Image Alternative Text :</label>
                            <input type="text" name="alt" class="form-control" id="alt"
                                placeholder="Image Alternative Text" value="{{ $editInfo->alt ?? '' }}">
                            @error('alt')
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