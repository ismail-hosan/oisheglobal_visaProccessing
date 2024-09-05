@extends('frontant_with_extra_path.layouts.master')

@section('main-title')
{{$data->title ?? 'Services'}}
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection



@section('main-content')
<section class="main-container">
    <div class="container">
        <div class="row">
            <div class="main col-md-12">
                <!-- page-title start -->
                <h1 class="page-title">{!! $data->title ?? 'Services' !!}</h1>
                <div class="separator-2"></div>
                    <div class="row">

                    @if($data->image && !in_array(strtolower($data->title), $ignore_image))
                    <div class="col-md-12">
                        <img style="width: 100%;height: 466px;" src="{{ asset('public/backend/service/'.$data->image) }}" alt="{{ $data->alt ?? 'IT Way BD' }}">
                    </div>
                    <div class="col-md-12">
                        {!! $data->details !!}
                    </div>
                    @endif
                </div>
                <!-- portfolio items end -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="seciton_title">
                            <h4>Service Projects</h4>
                        </div>
                    </div>
                </div>
                <hr>
                @php
                use App\Models\Projectimage;
                $projects = Projectimage::where('service_id',$data->id)->get();
                @endphp

                <div class="row">
                    @foreach($projects as $project)
                    <div class="col-md-3 col-sm-6 col-xs-12 mb-3">
                        <div class="card">
                            <img src="{{asset('public/' . $project->image)}}" style="margin:0 0 20px 0;border:1px solid #000;height: 224px;" alt="{{$data->alt}}" title="{{$data->alt}}">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{$project->title??'N/A'}}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
@endsection