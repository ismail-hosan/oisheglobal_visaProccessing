@extends('backend_extra_path.layouts.master')

@section('title')
{{ config('app.name', 'IT WAY BD') }} - {{$title}}
@endsection
@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Products </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('products.index'))
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>{{$title ?? 'Create'}}</span></li>
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
                <h3 class="card-title">{{$title ?? 'Create'}}</h3>
                <div class="card-tools">
                    @if (helper::roleAccess('visaproccesing.index'))
                    <a class="btn btn-default" href="{{ route('visaproccesing.index') }}"><i class="fa fa-list"></i>
                        Visa List</a>
                    @endif
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form class="needs-validation" method="POST" action="{{ route('visaproccesing.store') }}" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="title">Continent :</label>
                            <select name="continent" id="continent" class="form-control">
                                <option value="">Select Continent</option>
                                <option value="europe">Europe</option>
                                <option value="asia">Asia</option>
                            </select>
                            @error('continent')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="subtitle">Image :</label>
                            <input type="file" name="image" class="form-control" id="image" placeholder="image"
                                value="{{ $editInfo->subtitle ?? '' }}">
                            @error('image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="title">Name * :</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="name"
                                value="{{ $editInfo->title ?? '' }}">
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div id="module_section">
                                <div class="mb-3">
                                    <label style="display: block;">Slider Image* :
                                        <input type="file" name="slider_image[]" class="form-control">
                                    </label>
                                    @error('slider_image')
                                    <span class="error text-red text-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <a href="javascript:;" class="btn btn-info add_module_item">+</a>
                        </div>

                        <div class="col-md-6">
                            <div id="visited_section">
                                <div class="mb-3">
                                    <label style="display: block;">Visited Image* :
                                        <input type="file" name="visited_image[]" class="form-control">
                                    </label>
                                    @error('slider_image')
                                    <span class="error text-red text-bold">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <a href="javascript:;" class="btn btn-info add_visted_item">+</a>
                        </div>
                        <br>

                        <div class="col-md-12 mb-3">
                            <label for="description">Description :</label>
                            <textarea class="form-control summernote" name="description" id="description" rows="5"
                                placeholder="Write about your company...">{{ $editInfo->description ?? '' }}</textarea>
                            @error('description')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-12 form-group">
                        <label>Meta Code :</label>
                        <textarea type="text" name="meta" class="form-control"
                            placeholder="Write Your meta code">  </textarea>
                    </div>

                    <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> &nbsp;Save</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>


@endsection

@section('scripts')

<script type="text/javascript" src="{{asset('public/editor/ckeditor.js')}}"></script>
<script>
    var allEditors = document.querySelectorAll('.summernote');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(
            allEditors[i], {
                fontSize: {
                    options: [
                        12, 13, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36
                    ],
                    supportAllValues: true
                },
            }
        );
    }

    $(document).on('click', '.add_module_item', function() {
        let html = `<div class="row item">
        <div class="col-11">
            <label style="display: block;">Another Image* :
                <input type="file" name="slider_image[]" class="form-control" placeholder="Module name">
            </label>
        </div>
        <div class="col-1">
            <label>&nbsp;</label>
            <a href="javascript:;" class="btn btn-danger pack-remove" style="margin-top:-7px;">&times;</a>
        </div>
    </div>`;

        let moduleParent = $(this).parents('.col-md-6').find('#module_section');
        moduleParent.append(html);
    });

    $(document).on('click', '.add_visted_item', function() {
        let html = `<div class="row item">
        <div class="col-11">
            <label style="display: block;">Another Visited Image* :
                <input type="file" name="visited_image[]" class="form-control" placeholder="Module name">
            </label>
        </div>
        <div class="col-1">
            <label>&nbsp;</label>
            <a href="javascript:;" class="btn btn-danger pack-remove" style="margin-top:-7px;">&times;</a>
        </div>
    </div>`;

        let moduleParent = $(this).parents('.col-md-6').find('#visited_section');
        moduleParent.append(html);
    });


    $(document).on('click', '.pack-remove', function() {
        if (confirm("Are you sure to remove this package?")) {
            $(this).closest('.row.item').remove();
            checkPackageFeatureAndUpdate();
        }
    });
</script>

@endsection