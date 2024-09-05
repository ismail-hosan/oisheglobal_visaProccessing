@extends('backend_extra_path.layouts.master')

@section('title')
{{$title}}
@endsection
{{-- @dd($editInfo) --}}

@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Blog edit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if(helper::roleAccess('blog.index'))
                    <li class="breadcrumb-item"><a href="{{route('blog.index')}}">Blog List</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit Blog</span></li>
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
                <h3 class="card-title">Blog edit</h3>
                <div class="card-tools">
                    @if(helper::roleAccess('blog.create'))
                    <a class="btn btn-default" href="{{ route('blog.create') }}"><i class="fas fa-plus"></i>
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

                <form class="needs-validation" method="POST" action="{{ route('blog.update',$editInfo->id) }}"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class=" form-row">
                        <div class="col-md-4 mb-3">
                            <label for="">Title * :</label>
                            <input type="text" name="title" class="form-control" placeholder="Title"
                                value="{{ old('title') ?? ($editInfo->title ?? '') }}">
                            @error('title')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Image * :</label>
                            <input type="file" name="image" class="form-control" placeholder="Ex: 03"
                                value="{{ old('image') }}">
                            @error('image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                            @if ($editInfo->image)
                            <div style="margin-top:5px;">
                                <img width="50" src="{{ asset('public/backend/blog/'.$editInfo->image) }}"
                                    alt="{{ $editInfo->title }}">
                            </div>

                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Short Description * :</label>
                            <textarea name="short_description" class="form-control"
                                rows="5">{{ old('short_description') ?? ($editInfo->short_description ?? '') }}</textarea>
                            @error('short_description')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="">Description * :</label>
                            <textarea name="description" class="form-control summernote"
                                rows="5">{{ old('description') ?? ($editInfo->description ?? '') }}</textarea>
                            @error('description')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        
                        <div class="col-md-12 mb-12 form-group">
                            <label for="validationCustom01">Meta Code :</label>
                            <textarea type="text" name="meta" class="form-control"
                                placeholder="Write Your meta code"> {!! $editInfo->meta !!} </textarea>
                            @error('meta')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
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