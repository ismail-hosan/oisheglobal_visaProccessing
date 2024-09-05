@extends('frontant_with_extra_path.layouts.master')

@section('main-title')
{{$data->title ?? 'Services'}}
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection

@section('page-intro')
<li><a href="{{route('menu.aboutus')}}">Home</a></li>
<li class="active">{{$data->title ?? 'Services'}}</li>
@endsection


@section('main-content')
<style>
#portfolio {
    padding: 40px;
    margin: 0 auto;
}
.gallery-title
{
    font-size: 36px;
    color: #db584e;
    text-align: center;
    font-weight: 700;
    padding: 40px 20px 60px;
}
.filter-button
{
    font-size: 18px;
    border: 1px solid #ffffff;
    border-radius: 5px;
    text-align: center;
    color: #262827;
    margin-bottom: 30px;
    font-family: 'Sintony', sans-serif;

}
.filter-button:hover
{
    font-size: 18px;
    border: 1px solid #3ee311;
    border-radius: 5px;
    text-align: center;
    color: #ffffff;
    background-color: #3ee311;

}


.btn-default:active .filter-button:active
{
    background-color: red;
    color: white;
}

.port-image
{
    width: 100%;
}

.gallery_product
{
    margin-bottom: 30px;
}

</style>


<section id="portfolio">
   
        <div class="container">
            <div class="text-center">
                <button class="btn btn-default filter-button" data-filter="all">All</button>
                <button class="btn btn-default filter-button" data-filter="commercial">ongoing</button>
                <button class="btn btn-default filter-button" data-filter="residential">upcoming</button>
            </div>
            <div class="row">
            @if($images)
               @foreach($images as $image)
                <div class="gallery_product col-md-3 filter center {{$image->type}}">
                    <img src="{{ asset('public/'.$image->image) }}">
                </div>
                @endforeach
            @endif  
                
           
            </div>
        </div>
</section>

</div>
</div>
</div>




</section>



@endsection

@section("scripts")
<script>
    $(document).ready(function(){

        $(".filter-button").click(function(){
            var value = $(this).attr('data-filter');
            
            if(value == "all")
            {
                //$('.filter').removeClass('hidden');
                $('.filter').show('1000');
                }
                else
                {
                    //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
                    //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                    $(".filter").not('.'+value).hide('3000');
                    $('.filter').filter('.'+value).show('3000');
                    
                    }
                    });
                    
                    if ($(".filter-button").removeClass("active")) {
                        $(this).removeClass("active");
                        }
                        $(this).addClass("active");
                        
                        });
</script>
@endsection