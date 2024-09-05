@extends('frontant_with_extra_path.layouts.master')

@section('main-title')
Contact Us
@endsection


@section('page-intro')
<li><a class="active">Contact Us</a></li>
@endsection
<style>
    .banner {
        display: none;
    }


    .contact-form {
        background:rgb(82 82 82 / 38%);
        padding: 20px;
        border-radius: 10px;
        color: #fff;
    }

    .contact-info {
        background: rgb(10 10 10 / 72%);
        padding: 20px;
        border-radius: 10px;
        color: #fff;
    }

    .btn-submit {
        background-color: green;
        border: none;
    }

    .form-control {
        background-color: transparent;
    }
   .form-control
    {
        background: transparent;
    }
</style>

@section('main-content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="containers" style="background-image: url('public/frontant/images/blog-4.jpg');background-size: cover;
      background-position: center;">
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="contact-form">
                    <h2 class="text-center" style="color:white;">Get in Touch</h2>
                    <form method="POST" action="{{ route('contactemailsend') }}" role="form">
                    @csrf
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Your Number">
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-submit btn-block">Submit</button>
                    </form>
                </div>

            </div>
            <div class="col-md-6">
                  <div class="contact-info mt-4 text-center" style="margin-top: 194px;">
                    <h5 style="color:white;">Corporate Office</h5>
                    <p>{{$company->address ?? ''}}</p>
                    <p>Email: <a href="mailto:hello@bel.ltd" class="text-white">{{$company->email ?? ''}}</a></p>
                    <p>Phone: <a href="tel:+8809678060708" class="text-white">{{$company->phone ?? ''}}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection