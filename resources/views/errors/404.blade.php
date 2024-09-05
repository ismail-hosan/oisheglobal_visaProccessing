@extends('frontant_with_extra_path.layouts.master')

@section('main-title')
{{ $title ?? 'Career'}}
@endsection

@section('header-banner')
{{asset('public/frontant/images/blog-4.jpg')}}
@endsection

@section('main-content')
<!-- main-container start -->
<!-- ================ -->
<section class="main-container">

    <div class="container">

		<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-6 col-md-offset-3">
							<h1 class="title">Ooops! Page Not Found - 404</h1>
							<br>
							<p>The requested URL was not found on this server. Make sure that the Web site address displayed in the address bar of your browser is spelled and formatted correctly or <a href="/">return to Home page.</a></p>
		
						</div>
						<!-- main end -->

					</div>
					</div>
					
					
    </div>
</section>
<!-- main-container end -->

@endsection