@extends('backend_extra_path.layouts.master')

@section('title')
About Us - {{$title}}
@endsection


@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> About Us </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if(helper::roleAccess('aboutus.index'))
                    <li class="breadcrumb-item"><a href="{{route('aboutus.index')}}">About us List</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit About us</span></li>
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
                <h3 class="card-title">About us</h3>
                <div class="card-tools">
                    {{-- @if(helper::roleAccess('aboutus.create'))
                    <a class="btn btn-default" href="{{ route('aboutus.create') }}"><i class="fas fa-plus"></i>
                        Add New</a>
                    @endif --}}
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

                <form class="needs-validation" method="POST" action="{{ route('aboutus.update',$editInfo->id) }}"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="title">Title * :</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title"
                                value="{{ $editInfo->title ?? '' }}">
                            @error('title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tagline">Tagline * :</label>
                            <input type="text" name="tagline" class="form-control" id="tagline" placeholder="tagline"
                                value="{{ $editInfo->tagline ?? '' }}">
                            @error('tagline')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description">description * :</label>

                            <textarea class="form-control summernote" name="description" id="description" rows="5"
                                placeholder="Write about your company...">{{ $editInfo->description ?? '' }}</textarea>
                            @error('description')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="video">Video * :</label>
                            <input type="text" name="video" class="form-control" id="video" placeholder="video url"
                                value="{{ $editInfo->video ?? '' }}">
                            @error('video')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="m_title">Mission Title * :</label>
                            <input type="text" name="m_title" class="form-control" id="m_title"
                                placeholder="mission title" value="{{ $editInfo->m_title ?? '' }}">
                            @error('m_title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="mission">mission * :</label>

                            <textarea class="form-control summernote" name="mission" id="mission" rows="5"
                                placeholder="Write about your mission...">{{ $editInfo->mission ?? '' }}</textarea>
                            @error('mission')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="v_title">Vision Title * :</label>
                            <input type="text" name="v_title" class="form-control" id="v_title"
                                placeholder="Vision title" value="{{ $editInfo->v_title ?? '' }}">
                            @error('v_title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="vision">Vision * :</label>

                            <textarea class="form-control summernote" name="vision" id="vision" rows="5"
                                placeholder="Write about your vision...">{{ $editInfo->vision ?? '' }}</textarea>
                            @error('vision')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="image">Image * :</label>
                            <input type="file" name="image" class="form-control-file" id="image">
                            @error('image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="m_image">Mission Image * :</label>
                            <input type="file" name="m_image" class="form-control-file" id="m_image">
                            @error('m_image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="v_image">Vission Image * :</label>
                            <input type="file" name="v_image" class="form-control-file" id="v_image">
                            @error('v_image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-12 form-group">
                            <label for="validationCustom01">Meta Code :</label>
                            <textarea type="text" name="meta" class="form-control"
                                placeholder="Write Your meta code"> {!! $editInfo->meta !!} </textarea>
                        </div>
                        <div class="col-md-12 mb-3">
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
        </div>
    </div>
    <!-- /.col-->
</div>


@endsection


@section('scripts')

<script src="{{asset('public/editor/ckeditor.js')}}"></script>
<script>
    var allEditors = document.querySelectorAll('.summernote');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i]);
    }
</script>
@endsection