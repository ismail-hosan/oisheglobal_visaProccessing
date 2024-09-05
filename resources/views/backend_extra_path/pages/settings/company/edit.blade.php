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
                    @if(helper::roleAccess('settings.company.index'))
                    <li class="breadcrumb-item"><a href="{{route('settings.company.index')}}">Company List</a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit Company</span></li>
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
                <h3 class="card-title">Company List</h3>
                <div class="card-tools">
                    {{-- @if(helper::roleAccess('settings.company.create'))
                    <a class="btn btn-default" href="{{ route('settings.company.create') }}"><i class="fas fa-plus"></i>
                        Add New</a>
                    @endif
                    --}}
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
                    action="{{ route('settings.company.update',$editInfo->id) }}" novalidate
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Company Name * :</label>
                            <input type="text" name="company_name" class="form-control" id="validationCustom01"
                                placeholder="Company Name" value="{{ $editInfo->company_name }}">
                            @error('company_name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02"> Logo * :</label>
                            <input type="file" name="logo" class="form-control" id="validationCustom02"
                                placeholder="Logo">
                            <img src="{{asset('public/backend/logo/' . $editInfo->logo)}}" width="50px">
                            @error('logo')
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
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Invoice Logo * :</label>
                            <input type="file" name="invoice_logo" class="form-control" id="validationCustom01"
                                placeholder="Invoice Logo">
                            <img src="{{asset('public/backend/invoicelogo/' . $editInfo->invoice_logo)}}" width="50px">
                            @error('invoice_logo')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Favicon * :</label>
                            <input type="file" name="favicon" class="form-control" id="validationCustom01"
                                placeholder="Favicon">
                            <img class="img-thumbnail" src="{{asset('public/backend/favicon/' . $editInfo->favicon)}}"
                                width="50px">
                            @error('favicon')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Website * :</label>
                            <input type="url" name="website" class="form-control" id="validationCustom01"
                                placeholder="Website" value="{{ $editInfo->website }}" required>
                            @error('website')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone">Phone * :</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone"
                                value="{{ $editInfo->phone }}" required>
                            @error('phone')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="email">Email * :</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Email"
                                value="{{ $editInfo->email }}" required>
                            @error('email')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Address * :</label>
                            <input type="text" name="address" class="form-control" id="validationCustom01"
                                placeholder="Address" value="{{ $editInfo->address }}" required>
                            @error('address')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="form-row">


                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Branch Address 1:</label>
                            <input type="text" name="branch_address 1" class="form-control" id="validationCustom01"
                                placeholder="Branch Address" value="{{ $editInfo->branch_address_1 }}">
                            @error('branch_address_1')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Branch Address 2 :</label>
                            <input type="text" name="branch_address_2" class="form-control" id="validationCustom01"
                                placeholder="Branch Address 2" value="{{ $editInfo->branch_address_2 }}">
                            @error('branch_address_2')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Identification Number :</label>
                            <input type="text" name="task_identification_number" class="form-control"
                                id="validationCustom01" placeholder="Identification Number"
                                value="{{ $editInfo->task_identification_number }}">
                            @error('task_identification_number')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom21">Sales Number :</label>
                            <input type="text" name="sale_phone" class="form-control" id="validationCustom21"
                                placeholder="Sales Number" value="{{ $editInfo->sale_phone }}">
                            @error('sale_phone')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="validationCustom22">Sales Email :</label>
                            <input type="email" name="sale_email" class="form-control" id="validationCustom22"
                                placeholder="Sales email" value="{{ $editInfo->sale_email }}">
                            @error('sale_email')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom23">HR Number :</label>
                            <input type="text" name="hr_phone" class="form-control" id="validationCustom23"
                                placeholder="HR Number" value="{{ $editInfo->hr_phone }}">
                            @error('sale_phone')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="validationCustom24">HR Email :</label>
                            <input type="email" name="hr_email" class="form-control" id="validationCustom24"
                                placeholder="HR Email" value="{{ $editInfo->hr_email }}">
                            @error('hr_email')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom25">Support Number :</label>
                            <input type="text" name="support_phone" class="form-control" id="validationCustom25"
                                placeholder="Support Number" value="{{ $editInfo->support_phone }}">
                            @error('support_phone')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="validationCustom26">Support Email :</label>
                            <input type="email" name="support_email" class="form-control" id="validationCustom26"
                                placeholder="Support Email" value="{{ $editInfo->support_email }}">
                            @error('support_email')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>



                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="terms_and_conditions">Terms And Conditions :</label>

                            <textarea class="form-control summernote" name="terms_and_conditions"
                                id="terms_and_conditions" rows="5"
                                placeholder="Write about your terms_and_conditions...">{{ $editInfo->terms_and_conditions ?? '' }}</textarea>
                            @error('terms_and_conditions')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="privacy_policy">Privacy Policy :</label>

                            <textarea class="form-control summernote" name="privacy_policy" id="privacy_policy" rows="5"
                                placeholder="Write about your privacy_policy...">{{ $editInfo->privacy_policy ?? '' }}</textarea>
                            @error('privacy_policy')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="privacy_policy">Linkedin :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text d-flex items-center justify-content-center"
                                        style="width: 40px;">
                                        <i class="fab fa-linkedin-in"></i>
                                    </span>
                                </div>
                                <input type="url" value="{{old('linkedin') ?? ($editInfo->linkedin ?? '')}}"
                                    name="linkedin" class="form-control" placeholder="http://linkedin.com">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="privacy_policy">Facebook :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text d-flex items-center justify-content-center"
                                        style="width: 40px;">
                                        <i class="fab fa-facebook-f"></i>
                                    </span>
                                </div>
                                <input type="url" value="{{old('facebook') ?? ($editInfo->facebook ?? '')}}"
                                    name="facebook" class="form-control" placeholder="http://facebook.com">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="privacy_policy">Instagram :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text d-flex items-center justify-content-center"
                                        style="width: 40px;">
                                        <i class="fab fa-instagram"></i>
                                    </span>
                                </div>
                                <input type="url" value="{{old('instagram') ?? ($editInfo->instagram ?? '')}}"
                                    name="instagram" class="form-control" placeholder="http://instagram.com">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="privacy_policy">Twitter :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text d-flex items-center justify-content-center"
                                        style="width: 40px;">
                                        <i class="fab fa-twitter"></i>
                                    </span>
                                </div>
                                <input type="url" value="{{old('twitter') ?? ($editInfo->twitter ?? '')}}"
                                    name="twitter" class="form-control" placeholder="http://twitter.com">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom01">Total Clients :</label>
                            <input type="text" name="total_clients" class="form-control" id="validationCustom01"
                                placeholder="Total Clients" value="{{ $editInfo->total_clients }}">
                            @error('total_clients')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="validationCustom01">Project Done:</label>
                            <input type="text" name="project_done" class="form-control" id="validationCustom01"
                                placeholder="Project Done" value="{{ $editInfo->project_done }}">
                            @error('project_done')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom01">Running Project :</label>
                            <input type="text" name="running_project" class="form-control" id="validationCustom01"
                                placeholder="Running Project" value="{{ $editInfo->running_project }}">
                            @error('running_project')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="validationCustom01">Success Rate :</label>
                            <input type="text" name="success_rate" class="form-control" id="validationCustom01"
                                placeholder="Success Rate" value="{{ $editInfo->success_rate }}">
                            @error('success_rate')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-12 form-group">
                            <label for="validationCustom01">Meta Code :</label>
                            <textarea type="text" name="meta" class="form-control"
                                placeholder="Write Your meta code"> {!! $editInfo->meta !!} </textarea>
                        </div>

                        <div class="col-md-12 mb-12 form-group">
                            <label for="validationCustom01">Team Meta Code :</label>
                            <textarea type="text" name="team_meta" class="form-control"
                                placeholder="Write Your meta code"> {!! $editInfo->team_meta !!} </textarea>
                        </div>

                        <div class="col-md-12 mb-12 form-group">
                            <label for="validationCustom01">Testimunials Meta Code :</label>
                            <textarea type="text" name="testimunials_meta" class="form-control"
                                placeholder="Write Your meta code"> {!! $editInfo->testimunials_meta !!} </textarea>
                        </div>

                        <div class="col-md-12 mb-12 form-group">
                            <label for="validationCustom01">Client Meta Code :</label>
                            <textarea type="text" name="client_meta" class="form-control"
                                placeholder="Write Your meta code"> {!! $editInfo->client_meta !!} </textarea>
                        </div>
                        <div class="col-md-12 mb-12 form-group">
                            <label for="">Blog Meta Code :</label>
                            <textarea type="text" name="blog_meta" class="form-control"
                                placeholder="Write Your meta code"> {!! $editInfo->blog_meta !!} </textarea>
                        </div>
                        <div class="col-md-12 mb-12 form-group">
                            <label for="validationCustom01">Career Meta Code :</label>
                            <textarea type="text" name="career_meta" class="form-control"
                                placeholder="Write Your meta code"> {!! $editInfo->career_meta !!} </textarea>
                        </div>
                        <div class="col-md-12 mb-12 form-group">
                            <label for="validationCustom01">Contact Meta Code :</label>
                            <textarea type="text" name="contact_meta" class="form-control"
                                placeholder="Write Your meta code"> {!! $editInfo->contact_meta !!} </textarea>
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



@section('scripts')
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