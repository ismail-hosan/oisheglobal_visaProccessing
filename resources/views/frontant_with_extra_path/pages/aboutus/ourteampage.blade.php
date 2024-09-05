@extends('frontant_with_extra_path.layouts.master')

@section('title')
Our Team
@endsection




@section('page-intro')
<li><a href="{{route('menu.aboutus')}}">About Us</a></li>
<li><a class="active">Our Team</a></li>

@endsection

@section('main-content')


<style>
   .banner {
    display: none;
}

.border {
    border: 1px solid rgb(222, 222, 222);
    border-radius: 2px;
    transition: all 1.00s ease-in-out;
    padding: 8px;
    position: relative; 
    overflow: hidden; 
    height: 372px;
}

.ceo-section {
    display: flex;
    justify-content: center;
    margin-top: -15rem; 
    position: relative;
}

.ceo-section:hover .border {
    height: auto; 
}

.all:hover .border {
    height: auto; 
}

.additional-text {
    opacity: 0;
    transition: opacity 1.00s ease-in-out; 
    width: 100%; 
    color: black;  
    margin-top: 20px; 
    box-sizing: border-box;
    /*background-color: #c3cdc3;*/
    padding: 2px; 
}

.ceo-section:hover .additional-text {
    opacity: 1;
}

.all:hover .additional-text {
    opacity: 1;
}

    
</style>

<div class="container" style="margin-bottom: 35px;">
    <div style="background: rgb(248, 248, 248);width: 100%;height: 20rem;margin-top:29px;"></div>
    <div class="row" style="display: flex;justify-content: center;margin-bottom: 44px;">
    @if($chairman)
        <div class="col-md-4 ceo-section" style="display: flex;justify-content: center;margin-top: -15rem;">
            <div class="border">
                <img src="{{asset('public/backend/team/'.$chairman->image)}}" alt="{{ $ceo->alt ?? 'gtech' }}" class="IvCgm" style="height:290px;width: 100%;">
                <h5 class="text-center">{{$chairman->name}}</h5>
                <p class="text-center" style="margin-bottom: 0px;">{{$chairman->designation_id}}</p>
                <div class="additional-text">
                    {!! $chairman->s_degination  !!}
                </div>
            </div>
            
        </div>
    </div>
    @endif

   
   <div class="row" style="display: flex;justify-content: center">
    @if ($teamMembers)
    @foreach($teamMembers as $value)
        <div class="col-md-4 all" style="width:31%">
            <div class="border">
                <img src="{{ asset('public/backend/team/'.$value->image) }}" alt="{{ $value->alt ?? 'gtech' }}" class="img-fluid">
                <h5 class="text-center">{{ $value->name }}</h5>
                <p class="text-center" style="margin-bottom: 0px;">{{ $value->designation_id }}</p>
                <div class="additional-text">
                    {!! $value->s_degination  !!}
                </div>
            </div>
        </div>
    @endforeach
    @endif
</div>
    
    
</div>



<!-- <div class="section gray-bg clearfix">
    @if ($teamMembers)

    @foreach($teamMembers as $value)
    <div class="col-md-3 ">
        <div class="box-style-1 white-bg team-member">
            <div class="overlay-container">
                <img class="avatar" src="{{asset('public/backend/team/'.$value->image)}}"
                    alt="{{ $value->alt ?? 'IT Way BD' }}">
            </div>
            <h4>{{$value->name}}</h4>
            {{$value->designation_id}}
        </div>
    </div>
    @endforeach

    @endif
</div> -->

@endsection