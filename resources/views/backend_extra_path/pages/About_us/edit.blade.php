@extends('backend_extra_path.layouts.master')

@section('title')
Client - {{ $title }}
@endsection
@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Client </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if (helper::roleAccess('aboutUs.ourClient.index'))
                    <li class="breadcrumb-item"><a href="{{ route('aboutUs.ourClient.index') }}">Client
                        </a></li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit Client</span></li>
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
                <h3 class="card-title">Edit Client</h3>
                <div class="card-tools">
                    @if (helper::roleAccess('aboutUs.ourClient.index'))
                    <a class="btn btn-default" href="{{ route('aboutUs.ourClient.index') }}"><i class="fa fa-list"></i>
                        Client List</a>
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
                <form class="needs-validation" method="POST" action="{{ route('aboutUs.ourClient.update',$ourClient->id) }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    <!--New add-->
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Logo*(700px*650px):</label>
                            <input type="file" class="form-control" name="logo">
                            @error('logo')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <br>
                                <span>
                                    <img src="{{asset($ourClient->logo)}}" width="20%" alt="gtech">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="title">Type :</label>
                            <select name="type" id="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="client" {{ $ourClient->type == 'client' ? 'selected' : '' }}>Client</option>
                                <option value="concern" {{ $ourClient->type == 'concern' ? 'selected' : '' }}>Concern</option>
                            </select>
                            @error('type')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">Order By *:</label>
                            <input type="number" name="orderby" class="form-control" value="{{$ourClient->orderNo}}">
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="alt">Name*:</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name........" value="{{ $ourClient->name ?? '' }}">
                            @error('name')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">Image</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <br>
                                <span>
                                    <img src="{{asset($ourClient->image ??'')}}" width="20%" alt="gtech">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Description * :</label>
                            <textarea class="form-control summernote" name="description" rows="5">{{ $ourClient->description ?? '' }}</textarea>
                            @error('description')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="alt">Image Alternative Text :</label>
                            <input type="text" name="alt" class="form-control" id="alt" placeholder="Image Alternative Text" value="{{ $ourClient->alt ?? '' }}">
                            @error('alt')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> &nbsp;Save</button>
                </form>
            </div>

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
</script>
@endsection