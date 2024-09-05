@extends('backend_extra_path.layouts.master')

@section('navbar-content')
<style>
    .form-section-heading {
        font-size: 1.0rem;
        line-height: 18px;
        background-color: #DAB9D8;
        color: black;
        /* text-align: center; */
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
</style>




<div class="container mt-5">
    <h5 class="form-section-heading">-----Photo-----</h5>
    <div class="col-sm-12" style="display: flex;justify-content:center">

        <img src="{{ asset('public/' . $data->photo) }}" width="100" alt="Current Image" style="margin-bottom:5px">
    </div>
    <!-- Applicant's Address Details -->
    <h5 class="form-section-heading">Applicant's Address Details</h5>
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Surname (as shown in your Passport)</label>
        <div class="col-sm-3">
            {{$data->surname ??''}}
        </div>
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
    <!-- Add other occupation fields similarly -->

    <!-- Previous Visa/Currently valid Visa Details -->
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
    <div class="row">
        <div class="col-sm-3"></div>
        <label class="col-sm-3 mandatory" for="surname_id" style="font-weight: 400;">Refarence Person Name</label>
        <div class="col-sm-3">
            {{$data->reafarance_name ??''}}
        </div>
    </div>
    <h5 class="form-section-heading">------</h5>
</div>
@endsection

@push('scripts')

<script>
    function printDiv(divId) {
        alert('ok');
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
<script>
    $(document).on('click', '.paymodel', function() {
        let url = $(this).attr('href');
        $('form').attr('action', url);
    })


    function payMonth() {
        let pay = $('#paymentMonth option:selected').attr('payamount');
        let amount = $('#paymentMonth option:selected').attr('amount');
        let total = Number(amount) - (pay ? Number(pay) : 0);
        $('.dueInpute').val(total);
    }

    function payType(e) {
        if (e == "full_pay") {
            $(".payMonth").hide();
            $(".payAmount").hide();
            $(".discountfile").hide();
            $(".extendDate").hide();
        } else if (e == "partial") {
            $(".payMonth").show();
            $(".payAmount").show();
            $(".discountfile").show();
            $(".extendDate").show();

        }
    }
</script>
@endpush