<style>
    .min-hight {
        min-height: 150px;
        margin-top: 20px;
        text-align: center
    }

    .bottom-btn {
        max-width: 150px;
        margin: 0 auto;
    }
    
    .card 
    {
        width: 25rem;
    }
     @media (max-width: 768px) {
            .card {
                width: 31rem;

            }
        }

</style>

<br>
<br>
<!-- section start -->
<!-- ================ -->
<div class="section clearfix">
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container text-center">
                <br>
                    <hr style="border-top: 1px solid #010101;">
                    <div class="blox_hr_txt"><span class="uc_style_blox_line_text_divider_elementor_text" style="color:#012E58;">Our Services</span></div>
                    <!-- <span style="background: #ef622b;border-radius:10px 0px;padding:0px 5px;color:#fff;">Choose Us ?</span></h2> -->
                </div> 
                <div class="row">
                    @foreach($services as $value)
                    {{-- @if($value->url) --}}
                    <div class="col-md-3 col-sm-6">
                        <div class="service_style">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('public/backend/service/'.$value->image) }}" alt="Card image cap" style="height: 20rem;">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{!! $value->title !!}</h5>
                                    <!-- <p class="card-text text-center"><i class="fa fa-map-marker" aria-hidden="true" style="color:green;font-size: 21px;"></i> Gulsan</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- @endif --}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section end -->