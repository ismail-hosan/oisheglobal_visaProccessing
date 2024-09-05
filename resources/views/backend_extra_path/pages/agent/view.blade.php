@extends('backend_extra_path.layouts.master')

@section('title')
Settings - {{$title}}
@endsection

@section('navbar-content')
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header text-center">
                <button class="btn btn-dark" onclick="printDiv()">
                    <span class="">Print</span>
                </button>
            </div>
            <div class="card-body" id="printableArea">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header">
                            <h4 class="card-title">Personal Information</h4>
                        </div>

                        <ul>
                            <li class="font-weight-bold">Agent Code: {{$data['code']}}</li>
                            <li class="font-weight-bold">Name: {{$data['name']}}</li>
                            <li class="font-weight-bold">Phone: {{$data['phone']}}</li>
                            <li class="font-weight-bold">Mobile: {{$data['agentData']['mobile'] ?? ''}}</li>
                            <li class="font-weight-bold">NID No: {{$data['agentData']['nid_no'] ?? ''}}</li>
                            <li class="font-weight-bold">Father's Name: {{$data['agentData']['father_name'] ?? ''}}</li>
                            <li class="font-weight-bold">Mother's Name: {{$data['agentData']['mother_name'] ?? ''}}</li>
                            <li class="font-weight-bold">RL No: {{$data['agentData']['rl_no'] ?? ''}}</li>
                            <li class="font-weight-bold">Passport No: {{$data['agentData']['passport_no'] ?? ''}}</li>
                            <li class="font-weight-bold">Permanent Address: {{$data['agentData']['permanent_address'] ?? ''}}</li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <div class="card-header">
                            <h4 class="card-title">Company Information</h4>
                        </div>
                        <ul>
                            <li class="font-weight-bold">Company Name: {{$data['agentData']['company_name'] ?? ''}}</li>
                            <li class="font-weight-bold">TIN Number: {{$data['agentData']['tin_number'] ?? ''}}</li>
                            <li class="font-weight-bold">Company Address: {{$data['agentData']['company_address'] ?? ''}}</li>
                            <li class="font-weight-bold">Trade License No: {{$data['agentData']['trade_license_no'] ?? ''}}</li>
                            <li class="font-weight-bold">BIN Number: {{$data['agentData']['bin_number'] ?? ''}}</li>
                            <li class="font-weight-bold">Business Year: {{$data['agentData']['bussiness_year'] ?? ''}}</li>
                        </ul>
                    </div>
                </div>



                <style>
                    .col-md-4 {
                        padding-top: 40px;
                    }
                </style>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <h4 class="card-title">Documents</h4>
                        </div>
                        <div class="row">
                            <!-- First column (4 columns wide) -->
                            <div class="col-md-12" style="display: flex; flex-wrap: wrap;">
                                <div class="col-md-4">
                                    <div class="font-weight-bold">Personal Image:</div>
                                    <img
                                        src="{{ isset($data['agentData']['personal_image']) ? asset('public/'.$data['agentData']['personal_image']) : asset('default_image.jpg') }}"
                                        alt="Personal Image"
                                        width="200"
                                        height="100">

                                </div>
                                <div class="col-md-4">
                                    <div class="font-weight-bold">Passport Image: </div>

                                    <img
                                        src="{{ isset($data['agentData']['personal_image']) ? asset('public/'.$data['agentData']['passport_image']) : asset('default_image.jpg') }}"
                                        alt="Passport Image"
                                        width="200"
                                        height="100">
                                </div>
                                <div class="col-md-4">
                                    <div class="font-weight-bold">RL Image:</div>

                                    <img
                                        src="{{ isset($data['agentData']['personal_image']) ? asset('public/'.$data['agentData']['rld_image']) : asset('default_image.jpg') }}"
                                        alt="Rl Image"
                                        width="200"
                                        height="100">
                                </div>
                                <div class="col-md-4">
                                    <div class="font-weight-bold">Nid Fornt:</div>

                                    <img
                                        src="{{ isset($data['agentData']['personal_image']) ? asset('public/'.$data['agentData']['nid_front']) : asset('default_image.jpg') }}"
                                        alt="Nid Front"
                                        width="200"
                                        height="100">
                                </div>
                                <div class="col-md-4">
                                    <div class="font-weight-bold">Nid Back:</div>

                                    <img
                                        src="{{ isset($data['agentData']['personal_image']) ? asset('public/'.$data['agentData']['nid_back']) : asset('default_image.jpg') }}"
                                        alt="Nid Back"
                                        width="200"
                                        height="100">
                                </div>
                                <div class="col-md-4">
                                    <div class="font-weight-bold">Trade Image:</div>

                                    <img
                                        src="{{ isset($data['agentData']['personal_image']) ? asset('public/'.$data['agentData']['trade_image']) : asset('default_image.jpg') }}"
                                        alt="Trade Image"
                                        width="200"
                                        height="100">
                                </div>
                                <div class="col-md-4">
                                    <div class="font-weight-bold">TIN Image:</div>
                                    <img
                                        src="{{ isset($data['agentData']['personal_image']) ? asset('public/'.$data['agentData']['tin_image']) : asset('default_image.jpg') }}"
                                        alt="Tin Image"
                                        width="200"
                                        height="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function printDiv() {
                    var divContents = document.getElementById("printableArea").innerHTML;
                    var originalContents = document.body.innerHTML;

                    document.body.innerHTML = divContents;

                    window.print();

                    document.body.innerHTML = originalContents;
                }
            </script>

            @endsection

            @push('scripts')

            @endpush