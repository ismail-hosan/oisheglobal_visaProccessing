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
                <h1 class="m-0">Designation edit</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if(helper::roleAccess('designation.index'))
                    <li class="breadcrumb-item"><a href="{{route('designation.index')}}">Designation List</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit Designation</span></li>
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
                <h3 class="card-title">Designation edit</h3>
                <div class="card-tools">
                    @if(helper::roleAccess('designation.create'))
                    <a class="btn btn-default" href="{{ route('designation.create') }}"><i class="fas fa-plus"></i>
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

                <form class="needs-validation" method="POST" action="{{ route('designation.update',$editInfo->id) }}"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class=" form-row">
                        <div class="col-md-4 mb-3">
                            <label for="">Title * :</label>
                            <input type="text" name="name" class="form-control" placeholder="Title"
                                value="{{ old('name') ?? ($editInfo->name ?? '') }}">
                            @error('name')
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