@extends('backend_extra_path.layouts.master')

@section('navbar-content')
<style>
    .form-section-heading {
        font-size: 1.0rem;
        line-height: 18px;
        background-color: #10245A;
        color: white;
    }

    .mandatory {
        font-weight: bold;
    }

    .mandatory:after {
        content: '*';
        color: #B51717;
    }

    .error {
        color: red;
    }

    label {
        text-align: right;
        margin-bottom: 0rem;
    }

    #conditionalFields,
    #visaFields {
        display: none;
    }


    @media print {
        body {
            position: relative;
        }

        .print-exclude {
            display: none;
        }

        #update {
            display: none;
        }

        #watermark {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('http://oisheglobal.com/public/backend/logo/WhatsApp%20Image%202024-08-11%20at%2011.03.41_988480db%20(1).png');
            background-size: 50%;
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.1;
            z-index: -1;
            pointer-events: none;
        }

        #printableArea {
            position: relative;
            z-index: 1;
        }

        .btn-info {
            display: none;
        }

        * {
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
    }
</style>

<div class="container" id="update">
    @if(Auth::user()->type=='Admin' || Auth::user()->type=='Branch')
    <h5 class="form-section-heading">Status Details</h5>
    <form action="{{Route('application-list.status',$data->id)}}" method="post">
        @csrf

        <div class="row" style="padding-bottom: 10px;display: flex;justify-content: center;">
            <div class="col-sm-4" style="display: flex;justify-content:center">
                <select name="status" id="status" class="form-control">
                    <option {{$data->status ==  "Pending" ? "selected":""}} value="Pending">Pending</option>
                    <option {{$data->status ==  "Approved" ? "selected":""}} value="Approved">Approved</option>
                    <option {{$data->status ==  "Processing" ? "selected":""}} value="Processing">Processing</option>
                    <option {{$data->status ==  "Complited" ? "selected":""}} value="Complited">Complited</option>
                </select>
            </div>

            @if($data->referance)
            <div class="col-sm-6 " style="display: flex;justify-content:center">
                <label for="">commission ({{$data->referance->name ?? ""}}) - {{$data->referance->phone ?? ""}}</label>
                <input type="number" placeholder="amount" value="{{$data->commission}}" name="commission" class="form-control">
            </div>
            @endif

            <div class="col-sm-2 " style="display: flex;justify-content:center">
                <button type="submit" class="btn btn-success text-center">Update</button>
            </div>
        </div>
    </form>
    @endif
</div>

<div class="row">
    <div class="col-md-12 m-2 text-center">
        <button onclick="printDiv()" class="btn btn-info">Print</button>
        <button  id="download-pdf" class="btn btn-info">Download PDF</button>
    </div>
</div>

<div id="logoArea" class="container">
    <img src="http://localhost/oishiglobals/public/backend/logo/WhatsApp%20Image%202024-08-11%20at%2011.03.41_988480db%20(1).png" alt="Logo" style="width: 150px; margin-bottom: 20px;">
</div>

<div class="container" id="printableArea">
    <h5 class="form-section-heading">-----Photo-----</h5>
    <div class="col-sm-12" style="display: flex;justify-content:center">
        <img src="{{ asset('public/' . $data->photo) }}" width="100" alt="Current Image" style="margin-bottom:5px">
    </div>

    <h5 class="form-section-heading">Applicant's Address Details</h5>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Application Status</label>
        <div class="col-sm-3"><b>{{$data['status'] ??''}}</b></div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Application Country</label>
        <div class="col-sm-3">{{$data['countryName']['name'] ??''}}</div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Surname (as shown in your Passport)</label>
        <div class="col-sm-3">{{$data->surname ??''}}</div>
    </div>

    
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Given Name/s (Complete as in Passport)</label>
        <div class="col-sm-3">
            {{$data->given_name ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Country/Region of birth</label>
        <div class="col-sm-3">
            {{$data->b_country ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Citizenship/National ID No.</label>
        <div class="col-sm-3">
            {{$data->National_id ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Town/City of birth</label>
        <div class="col-sm-3">
            {{$data->b_city ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Religion</label>
        <div class="col-sm-3">
            {{$data->religion ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Educational Qualification</label>
        <div class="col-sm-3">
            {{$data->educational_qualification ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <label class="col-sm-4 mandatory" for="surname_id" style="font-weight: 400;">Did you acquire Nationality by birth or by naturalization?</label>
        <div class="col-sm-3">
            {{$data->naturalization ??''}}
        </div>
    </div>
    <div class="row">

        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Have you lived for at least two years in the country where you are applying for a visa?</label>
        <div class="col-sm-3">
            {{$data->lived_in_country ??''}}
        </div>
    </div>
    <!-- Add other address fields similarly -->

    <!-- Family Details -->
    <h5 class="form-section-heading">Passport Details</h5>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Passport Number</label>
        <div class="col-sm-3">
            {{$data->passport_number ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Place of Issue</label>
        <div class="col-sm-3">
            {{$data->place_of_issue ??''}}
        </div>
    </div>
    <div id="watermark"></div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Date of Issue</label>
        <div class="col-sm-3">
            {{$data->date_of_issue ??''}}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Any other valid Passport/Identity Certificate(IC) held?</label>
        <div class="col-sm-3">
            {{$data->date_of_expiry ??''}}
        </div>
    </div>
    @if($data->date_of_expiry=='yes')
    <div class="row">
        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Second Passport Country</label>
        <div class="col-sm-3">
            {{$data->another_passport_country ??''}}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Second Passport No</label>
        <div class="col-sm-3">
            {{$data->another_passport_no ??''}}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Date of Issue</label>
        <div class="col-sm-3">
            {{$data->another_passport_issu_date ??''}}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Place of Issue</label>
        <div class="col-sm-3">
            {{$data->another_passport_issu_place ??''}}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Nationality mentioned therein</label>
        <div class="col-sm-3">
            {{$data->another_passport_nationality ??''}}
        </div>
    </div>
    @endif

    <!-- Profession / Occupation Details -->
    <h5 class="form-section-heading">Applicant's Address Details</h5>

    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">House No./Street</label>
        <div class="col-sm-3">
            {{$data->present_address_street ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Village/Town/City</label>
        <div class="col-sm-3">
            {{$data->present_address_city ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Country</label>
        <div class="col-sm-3">
            {{$data->present_address_country ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">State/Province/District</label>
        <div class="col-sm-3">
            {{$data->present_address_district ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Postal/Zip Code</label>
        <div class="col-sm-3">
            {{$data->present_address_zipcode ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Phone No</label>
        <div class="col-sm-3">
            {{$data->present_address_phone ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Mobile No</label>
        <div class="col-sm-3">
            {{$data->present_address_mobile ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Applicant's Marital Status.</label>
        <div class="col-sm-3">
            {{$data->marital_status ??''}}
        </div>
    </div>
    @if($data->marital_status=='Married')
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Spouse Name</label>
        <div class="col-sm-3">
            {{$data->spouse_name ??''}}
        </div>
    </div>
    @if($data->spouse_phone)
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Spouse Phone</label>
        <div class="col-sm-3">
            {{$data->spouse_phone ??''}}
        </div>
    </div>
    @endif
    @endif
    <div class="row">
        <div class="col-sm-3" style="text-align: right;">Permanent Address</div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">House No./Street</label>
        <div class="col-sm-3">
            {{$data->permanent_address_street ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Village/Town/City</label>
        <div class="col-sm-3">
            {{$data->permanent_address_city ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">State/Province/District </label>
        <div class="col-sm-3">
            {{$data->permanent_address_distric ??''}}
        </div>
    </div>
    <h5 class="form-section-heading">Family Details</h5>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3" style="color: orange;" for="">Father's Details:</label>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Name</label>
        <div class="col-sm-3">
            {{$data->father_name ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Phone</label>
        <div class="col-sm-3">
            {{$data->father_phone ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3" style="color: orange;" for="">Mother's Details:</label>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Name</label>
        <div class="col-sm-3">
            {{$data->mother_name ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Phone</label>
        <div class="col-sm-3">
            {{$data->mother_phone ??''}}
        </div>
    </div>

    <h5 class="form-section-heading">Profession / Occupation Details of Applicant</h5>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Present Occupation</label>
        <div class="col-sm-3">
            {{$data->present_occupation ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Employer Name/business</label>
        <div class="col-sm-3">
            {{$data->present_busibess_name ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Designation</label>
        <div class="col-sm-3">
            {{$data->present_busibess_designation ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Address </label>
        <div class="col-sm-3">
            {{$data->present_busibess_designation ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Phone</label>
        <div class="col-sm-3">
            {{$data->present_busibess_phone ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Past Occupation, if any?</label>
        <div class="col-sm-3">
            {{$data->past_occupation ??''}}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Are/were you in a Military/Semi-Military/Police/Security. Organization?</label>
        <div class="col-sm-3">
            {{$data->any_organigation ??''}}
        </div>
    </div>
    @if($data->any_organigation=='yes')
    <div class="row">
        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Organization</label>
        <div class="col-sm-3">
            {{$data->other_orgnigation_name ??''}}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Designation</label>
        <div class="col-sm-3">
            {{$data->other_orgnigation_degination ??''}}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Rank</label>
        <div class="col-sm-3">
            {{$data->other_orgnigation_rank ??''}}
        </div>
    </div>
    <div class="row">
        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Place of Posting</label>
        <div class="col-sm-3">
            {{$data->other_orgnigation_post ??''}}
        </div>
    </div>
    @endif

    <h5 class="form-section-heading">Previous Visa/Currently valid Visa Details</h5>
    <div class="row">
        <label class="col-sm-6 mandatory" for="surname_id" style="font-weight: 400;">Have you ever visited before any country?</label>
        <div class="col-sm-3">
            {{$data->visited_any_country ??''}}
        </div>
    </div>
    @if($data->visited_any_country=='yes')
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Address</label>
        <div class="col-sm-3">
            {{$data->privius_visa_address ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Visa No</label>
        <div class="col-sm-3">
            {{$data->privius_visa_no ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Country</label>
        <div class="col-sm-3">
            {{$data->privius_visa_country ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Visa Type</label>
        <div class="col-sm-3">
            {{$data->privius_visa_type ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Place Of issu</label>
        <div class="col-sm-3">
            {{$data->privius_visa_place_issu ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Date of issu</label>
        <div class="col-sm-3">
            {{$data->privius_visa_date_issu ??''}}
        </div>
    </div>
    @endif

    <h5 class="form-section-heading">Refarance</h5>
    @if($data->referance)
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Refarence Person Name</label>
        <div class="col-sm-3">
            {{$data->referance->name ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Refarence Person Phone</label>
        <div class="col-sm-3">
            {{$data->referance->phone ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Refarence Person Email</label>
        <div class="col-sm-3">
            {{$data->referance->email ??''}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Refarence Person Branch Name</label>
        <div class="col-sm-3">
            {{$data->referance->branch->name ??''}}
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Refarence Person Name</label>
        <div class="col-sm-3">
            {{$data->reafarance_name ??''}}
        </div>
    </div>
    @endif
    <div class="col-md-12">
        <div class="row">
            <div class="col-6">
                Customer Signature<br>
                ................................
            </div>
            <div class="col-6 text-right">
                Authorize Signature<br>
                .................................
            </div>
        </div>
    </div>
</div>

<div class="row print-exclude">
    <div class="col-md-6">
        <img src="{{asset('public/'.$data->passport_photo)}}" width="80%" style="height: 193px;" class="" alt="Image 1">
    </div>
    <div class="col-md-6">
        <img src="{{asset('public/'.$data->another_passport_image)}}" width="80%" class="" style="height: 193px;" alt="Image 2">
    </div>
</div>

<!-- Include jsPDF and html2pdf.js libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


<script>
    function printDiv() {
        window.print();
    }

    // function downloadPDF() {
    //     const element = document.getElementById('printableArea');
    //     const opt = {
    //         margin: 1,
    //         filename: 'application-details.pdf',
    //         image: {
    //             type: 'jpeg',
    //             quality: 0.98
    //         },
    //         html2canvas: {
    //             scale: 2
    //         },
    //         jsPDF: {
    //             unit: 'in',
    //             format: 'letter',
    //             orientation: 'portrait'
    //         },
    //         pagebreak: {
    //             mode: ['avoid-all', 'css', 'legacy']
    //         }
    //     };

    //     const watermark = document.createElement('div');
    //     watermark.id = 'watermark';
    //     watermark.style.position = 'fixed';
    //     watermark.style.top = '0';
    //     watermark.style.left = '0';
    //     watermark.style.right = '0';
    //     watermark.style.bottom = '0';
    //     watermark.style.backgroundImage = "url('http://oisheglobal.com/public/backend/logo/WhatsApp%20Image%202024-08-11%20at%2011.03.41_988480db%20(1).png')";
    //     watermark.style.backgroundSize = '50%';
    //     watermark.style.backgroundRepeat = 'no-repeat';
    //     watermark.style.backgroundPosition = 'center';
    //     // watermark.style.opacity = '0.1';
    //     // watermark.style.pointerEvents = 'none';
    //     document.body.appendChild(watermark);

    //     html2pdf().from(element).set(opt).save().then(() => {
    //         document.body.removeChild(watermark);
    //     });
    // }

    document.getElementById('download-pdf').addEventListener('click', async () => {
            const { PDFDocument } = PDFLib;

            try {
                // Capture the div as an image using html2canvas
                const canvas = await html2canvas(document.getElementById('printableArea'));
                const imgData = canvas.toDataURL('image/png');

                // Create a new PDF document
                const pdfDoc = await PDFDocument.create();
                const page = pdfDoc.addPage([canvas.width, canvas.height]);

                // Embed the captured image
                const pngImage = await pdfDoc.embedPng(imgData);
                
                page.drawImage(pngImage, {
                    x: 0,
                    y: 0,
                    width: canvas.width,
                    height: canvas.height,
                });

                // Embed the watermark image (make sure it is a valid PNG and accessible)
                const watermarkImageUrl = 'https://oisheglobal.com/public/backend/logo/WhatsApp%20Image%202024-08-11%20at%2011.03.41_988480db%20(1).png';
                const response = await fetch(watermarkImageUrl);
                if (!response.ok) {
                    throw new Error('Failed to fetch watermark image');
                }
                const watermarkImageArrayBuffer = await response.arrayBuffer();
                const watermarkImage = await pdfDoc.embedPng(watermarkImageArrayBuffer);

                page.drawImage(watermarkImage, {
                    x: 50,
                    y: 50,
                    width: 300,
                    height: 300,
                    opacity: 0.1,
                });

                // Serialize the PDFDocument to bytes
                const pdfBytes = await pdfDoc.save();

                // Create a Blob from the PDF bytes
                const blob = new Blob([pdfBytes], { type: 'application/pdf' });

                // Create a link element and trigger a download
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'watermarked.pdf';
                link.click();
            } catch (error) {
                console.error('Error generating PDF:', error);
            }
        });
</script>

@endsection