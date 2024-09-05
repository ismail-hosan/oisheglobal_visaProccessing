@extends('backend_extra_path.layouts.master')

@section('title')
{{ config('app.name', 'IT WAY BD') }} - {{$title}}
@endsection


@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Products</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if(helper::roleAccess('products.index'))
                    <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active"><span>{{$title ?? 'Edit'}}</span></li>
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
                <h3 class="card-title">{{$title ?? 'Edit'}}</h3>
                <div class="card-tools">
                    @if(helper::roleAccess('products.create'))
                    <a class="btn btn-default" href="{{ route('products.create') }}"><i class="fas fa-plus"></i>
                        Add New</a>
                    @endif
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form class="needs-validation" method="POST" action="{{ route('products.update',$editInfo->id) }}"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="title">Service :</label>
                            <select name="service_id" id="service_id" class="form-control">
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                <option value="{{$service->id}}" {{$service->id ==$editInfo->service_id ? 'selected' :
                                    '' }}>{{$service->title?? 'N/A'}}</option>
                                @endforeach
                            </select>
                            @error('title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title">Title * :</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title"
                                value="{{ $editInfo->title ?? '' }}">
                            @error('title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="subtitle">Subtitle :</label>
                            <input type="text" name="subtitle" class="form-control" id="subtitle" placeholder="subtitle"
                                value="{{ $editInfo->subtitle ?? '' }}">
                            @error('subtitle')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">Description :</label>

                            <textarea class="form-control summernote" name="description" id="description" rows="5"
                                placeholder="Write about your company...">{{ $editInfo->description ?? '' }}</textarea>
                            @error('description')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="tecnology">Development Tecnology :</label>

                            <textarea class="form-control summernote" name="tecnology" id="tecnology" rows="5"
                                placeholder="Write about your te...">{{ $editInfo->tecnology ?? '' }}</textarea>
                            @error('tecnology')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="video_title">Video Title :</label>
                            <input type="text" name="video_title" class="form-control" id="video_title"
                                placeholder="Video title" value="{{ $editInfo->video_title ?? '' }}">
                            @error('video_title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="video_link">Video Link :</label>
                            <input type="text" name="video_link" class="form-control" id="video_link" placeholder="url"
                                value="{{ $editInfo->video_link ?? '' }}">
                            @error('video_link')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="module_title">Module Title :</label>
                            <input type="text" name="module_title" class="form-control" id="module_title"
                                placeholder="mission title" value="{{ $editInfo->module_title ?? '' }}">
                            @error('module_title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="gallary_title">Gallary Title :</label>
                            <input type="text" name="gallary_title" class="form-control" id="gallary_title"
                                placeholder="Gallary title" value="{{ $editInfo->gallary_title ?? '' }}">
                            @error('gallary_title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row mb-3">
                        <div class="col-md-6">
                            <div id="module_section">
                                @if (count($editInfo->modules)>0)
                                @foreach ($editInfo->modules as $module)
                                <div class="row item">
                                    <div class="col-11">
                                        <label style="display: block;">Module Item * :
                                            <input type="text" name="module_item[]" class="form-control"
                                                placeholder="Module name" value="{{$module->name??''}}">
                                        </label>
                                    </div>
                                    @if (!$loop->first)
                                    <div class="col-1">
                                        <label>&nbsp;</label>
                                        <a href="javascript:;" class="btn btn-danger remove-item"
                                            style="margin-top:-7px;">&times;</a>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                                @else
                                <div class="mb-3">
                                    <label style="display: block;">Module Item * :
                                        <input type="text" name="module_item[]" class="form-control"
                                            placeholder="Module name">
                                    </label>
                                    @error('module_item')
                                    <span class="error text-red text-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endif
                            </div>
                            <a href="javascript:;" class="btn btn-info add_module_item">+</a>
                        </div>
                        <div class="col-md-6">
                            <div id="gallary_section">
                                @forelse ($editInfo->gallaries as $image)
                                <div class="row item mb-3">
                                    <div class="col-11">
                                        <label style="display: block;">Image * :
                                            <input type="file" name="image[]" class="form-control">
                                        </label>
                                        <img src="{{asset('public/backend/products/' . $image->image)}}" width="50px">
                                    </div>
                                    @if (!$loop->first)
                                    <div class="col-1">
                                        <label>&nbsp;</label>
                                        <a href="javascript:;" class="btn btn-danger remove-item"
                                            style="margin-top:-7px;">&times;</a>
                                    </div>
                                    @endif
                                </div>
                                @empty
                                <div class="mb-3">
                                    <label style="display: block;">Image * :
                                        <input type="file" name="image[]" class="form-control">
                                    </label>
                                    @error('image')
                                    <span class="error text-red text-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endforelse
                            </div>
                            <a href="javascript:;" class="btn btn-info add_gallary_item">+</a>
                        </div>
                    </div>


                    <div class="package-section">

                        @foreach ($editInfo->packages as $package)
                        <fieldset class="pack_parent">
                            <legend class="legend">Package:</legend>
                            <a href="javascript:;" class="btn btn-danger pack-remove float-right"
                                style="margin-top:-45px;margin-right:10px;">&times;</a>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="name_{{$package->id}}">Package Name</label>
                                    <input type="text" name="name[]" value="{{$package->name??''}}" class="form-control"
                                        id="name_{{$package->id}}" placeholder="Package Name">
                                    @error('name')
                                    <span class=" error text-red text-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="onetime_amount{{$package->id}}">Onetime Amount</label>
                                    <input type="text" name="onetime_amount[]" value="{{$package->onetime_amount??''}}"
                                        class="form-control" id="onetime_amount{{$package->id}}"
                                        placeholder="Ex: 5000 / Onetime">
                                    @error('onetime_amount')
                                    <span class=" error text-red text-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="monthly_amount{{$package->id}}">Monthly Amount</label>
                                    <input type="text" name="monthly_amount[]" value="{{$package->monthly_amount??''}}"
                                        class="form-control" id="monthly_amount{{$package->id}}"
                                        placeholder="Ex: 100/Per User">
                                    @error('monthly_amount')
                                    <span class=" error text-red text-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="features-section mb-3">
                                <label>Features</label>
                                <div class="form-row">
                                    @foreach ($package->details as $detail)
                                    <div class="col-md-4 d-flex flex-row align-items-center mb-3 item">
                                        <div class="flex-grow-1 mr-2">
                                            <input type="text" name="package_features[][]"
                                                value="{{$detail->name ?? ''}}" class="form-control features_item"
                                                placeholder="Ex: Non masking SMS">
                                        </div>
                                        @if (!$loop->first)
                                        <a href="javascript:;" class="btn btn-danger remove-item">&times;</a>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                <a href="javascript:;" class="btn btn-info add_features_item">+</a>
                            </div>
                        </fieldset>
                        @endforeach


                    </div>
                    <div class="row" style="margin-bottom:12px;">
                        <div class="col-md-12">
                            <a href="javascript:;" class="btn btn-info add_another_package">+ Add Package</a>

                        </div>
                    </div>

                    <div class="col-md-12 mb-12 form-group">
                        <label>Meta Code :</label>
                        <textarea type="text" name="meta" class="form-control"
                            placeholder="Write Your meta code"> {!! $editInfo->meta !!} </textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="alt">Image Alternative Text :</label>
                        <input type="text" name="alt" class="form-control" id="alt" placeholder="Image Alternative Text"
                            value="{{ $editInfo->alt ?? '' }}">
                        @error('alt')
                        <span class=" error text-red text-bold">{{ $message }}</span>
                        @enderror
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
<script>
    $(document).ready(function () {
        checkPackageFeatureAndUpdate();
    });
    $(document).on('click', '.add_another_package', function () {
        let html = `
        <fieldset class="pack_parent">
            <legend class="legend">Package:</legend>
            <a href="javascript:;" class="btn btn-danger pack-remove float-right" style="margin-top:-45px;margin-right:10px;">&times;</a>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="name">Package Name</label>
                    <input type="text" name="name[]" class="form-control" id="name" placeholder="Package Name">
                    @error('name')
                    <span class=" error text-red text-bold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="onetime_amount">Onetime Amount</label>
                    <input type="text" name="onetime_amount[]" class="form-control" id="onetime_amount"
                        placeholder="Ex: 5000 / Onetime">
                    @error('onetime_amount')
                    <span class=" error text-red text-bold">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="monthly_amount">Monthly Amount</label>
                    <input type="text" name="monthly_amount[]" class="form-control" id="monthly_amount"
                        placeholder="Ex: 100/Per User">
                    @error('monthly_amount')
                    <span class=" error text-red text-bold">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="features-section mb-3">
                <label>Features</label>
                <div class="form-row">
                    <div class="col-md-4 d-flex flex-row align-items-center mb-3 item">
                        <div class="flex-grow-1 mr-2">
                            <input type="text" name="package_features[][]" class="form-control features_item"
                                placeholder="Ex: Non masking SMS">
        
                        </div>
                    </div>
                </div>
                <a href="javascript:;" class="btn btn-info add_features_item">+</a>
            </div>
        </fieldset>
        `;
        let packageParent = $('.package-section').append(html);

        checkPackageFeatureAndUpdate();
    });

    function checkPackageFeatureAndUpdate() {

        $.each($('.features-section'), function (index, item) {
            let feature_val = `package_features[${index}][]`;
            $(item).find('.features_item').attr('name', feature_val);
        });

    }

    $(document).on('click', '.add_module_item', function () {
        let html = `<div class="row item">
            <div class="col-11">
                <label style="display: block;">Module Item * :
                    <input type="text" name="module_item[]" class="form-control" placeholder="Module name">
                </label>
            </div>
            <div class="col-1">
                <label>&nbsp;</label>
                <a href="javascript:;" class="btn btn-danger remove-item" style="margin-top:-7px;">&times;</a>
            </div>
        </div>
        `;

        let moduleParent = $(this).parents('.col-md-6').find('#module_section');
        moduleParent.append(html)
    });
    $(document).on('click', '.add_gallary_item', function () {
        let html = `<div class="row item">
            <div class="col-11">
                <label style="display: block;">Image * :
                    <input type="file" name="image[]" class="form-control">
                </label>
            </div>
            <div class="col-1">
                <label>&nbsp;</label>
                <a href="javascript:;" class="btn btn-danger remove-item" style="margin-top:-7px;">&times;</a>
            </div>
        </div>
        `;

        let moduleParent = $(this).parents('.col-md-6').find('#gallary_section');
        moduleParent.append(html)
    });

    $(document).on('click', '.add_features_item', function () {
        let html = `<div class="col-md-4 d-flex flex-row align-items-center mb-3 item">
            <div class="flex-grow-1 mr-2">
                <input type="text" name="package_features[][]" class="form-control features_item" placeholder="Ex: Non masking SMS">
        
            </div>
            <a href="javascript:;" class="btn btn-danger remove-item">&times;</a>
        </div>
        `;

        let moduleParent = $(this).parents('.features-section').find('.form-row');
        moduleParent.append(html);

        checkPackageFeatureAndUpdate();
    });



    $(document).on('click', '.remove-item', function () {
        if (confirm("Are you sure to remove this item?")) {
            $(this).parents('.item').remove();
        }
    });


    $(document).on('click', '.pack-remove', function () {
        if (confirm("Are you sure to remove this package?")) {
            $(this).parents('.pack_parent').remove();
            checkPackageFeatureAndUpdate();
        }
    });
</script>


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