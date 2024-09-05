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
                <h1 class="m-0">Career</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    @if(helper::roleAccess('career.index'))
                    <li class="breadcrumb-item"><a href="{{route('career.index')}}">Career List</a>
                    </li>
                    @endif
                    <li class="breadcrumb-item active"><span>Edit Career</span></li>
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
                <h3 class="card-title">Career</h3>
                <div class="card-tools">
                    @if(helper::roleAccess('career.create'))
                    <a class="btn btn-default" href="{{ route('career.create') }}"><i class="fas fa-plus"></i>
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

                <form class="needs-validation" method="POST" action="{{ route('career.update',$editInfo->id) }}"
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
                            <label>Vacancy * :</label>
                            <input type="text" name="vacancy" class="form-control" placeholder="Ex: 03"
                                value="{{ old('vacancy') ?? ($editInfo->vacancy ?? '') }}">
                            @error('vacancy')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Email *:</label>
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ old('email') ?? ($editInfo->email ?? '') }}">
                            @error('email')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Publish At * :</label>
                            <input type="date" name="published_at" class="form-control"
                                value="{{ old('published_at') ?? ($editInfo->published_at ?? '') }}">
                            @error('published_at')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Deadline * :</label>
                            <input type="date" name="application_deadline" class="form-control"
                                value="{{ old('application_deadline') ?? ($editInfo->application_deadline ?? '') }}">
                            @error('application_deadline')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Employment Status * :</label>
                            <input type="text" name="employment_status" class="form-control"
                                placeholder="employment_status"
                                value="{{ old('employment_status') ?? ($editInfo->employment_status ?? '') }}">
                            @error('employment_status')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Job Location * :</label>
                            <input type="text" name="job_location" class="form-control" placeholder="Ex: Dhaka"
                                value="{{ old('job_location') ?? ($editInfo->job_location ?? '') }}">
                            @error('job_location')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Gender * :</label>
                            <input type="text" name="gender" class="form-control" placeholder="Ex: Male and Female both"
                                value="{{ old('gender') ?? ($editInfo->gender ?? '') }}">
                            @error('gender')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Salary :</label>
                            <input type="text" name="salary" class="form-control" placeholder="salary"
                                value="{{ old('salary') ?? ($editInfo->salary ?? '') }}">
                            @error('salary')
                            <span class=" error text-red text-bold">{{ $message }}</span>
                            @enderror
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