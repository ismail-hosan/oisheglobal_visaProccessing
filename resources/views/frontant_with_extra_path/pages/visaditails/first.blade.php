@extends('frontant_with_extra_path.pages.visaditails.master')

@section('form')

<form method="post" action="{{Route('visa.first.store')}}" autocomplete="off" id="visaForm">
    @csrf
    <div class="wrapper">
        <div class="pageHeader"></div>
        <div class="pageHeading1 text_center">
            Online Visa Application
            <a href="index.html"><img align="right"
                    src="./images/home.png"
                    style=" width: 30px; height:26px;"></a>
        </div>
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <div class="container">
            <div class="form_container">
                <div class="row">
                    <div class="col-1 mandatory"
                        title="Country/Region you are applying visa from">Country/Region
                        you are applying visa from</div>
                    <div class="col-2">
                        <select name="appl.countryname"
                            id="countryname_id">
                            <option value>Select country</option>
                            @foreach($countryNames as $countryName)
                            <option value="{{$countryName->id}}">{{$countryName->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3" id="countryError" class="error"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory"
                        title="Indian Mission/Office">Branch Office</div>
                    <div class="col-2">

                        <select name="appl_branchcode"
                            id="mission">
                            <option value>Select Branch</option>
                            @foreach($branchNames as $branchName)
                            <option value="{{$branchName->id}}">{{$branchName->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3" id="missionError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" id="appl_nationality"
                        title="Nationality/Region">Nationality/Region</div>
                    <div class="col-2">

                        <select name="appl.nationality"
                            id="nationality_id">
                            <option value>Select Nationality</option>
                            <option value="Bangladesh">Bangladesh</option>
                        </select>
                    </div>
                    <div class="col-3" id="nationalityError"></div>
                </div>

                <div class="row">
                    <div class="col-1 mandatory" title="Date of Birth"
                        id="appl_dob">Date of Birth</div>
                    <div class="col-2">
                        <input type="text" name="appl.birthdate" class="datepicker" id="dob_id">
                    </div>
                    <div class="col-3" id="dobError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Email ID"
                        id="appl_email_id">Email ID</div>
                    <div class="col-2">
                        <input name="appl.email" type="email" size="50"
                            maxlength="50" id="email_id">
                    </div>
                    <div class="col-3" id="emailError"></div>
                </div>

                <div class="row">
                    <div class="col-1 mandatory" title="Visa Type"
                        id="visa_type_2">Visa Type</div>
                    <div class="col-2">

                        <select name="appl.visa_service_id"
                            id="visaService">
                            <option value selected>Select visa
                                service</option>
                            <option value="Work Pemit">Work Pemit</option>
                            <option value="Visit Visa">Visit Visa</option>
                            <option value="Student Visa">Student Visa</option>
                            <option value="Business Visa">Business Visa</option>
                            <option value="Sponsor Visa">Sponsor Visa</option>
                        </select>
                    </div>
                    <div class="col-3" id="visaTypeError"></div>
                </div>
                <div class="row text_center">
                    <input name="submit_registration" type="submit"
                        class="btn btn-primary" value="Continue">
                </div>

                <div style="display: block; clear: both;"></div><br><br>
                <div class="pageHeading1 text_center">
                    Online Visa Application
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    document.getElementById('visaForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let valid = true;

        const requiredFields = [{
                id: 'countryname_id',
                errorId: 'countryError'
            },
            {
                id: 'mission',
                errorId: 'missionError'
            },
            {
                id: 'nationality_id',
                errorId: 'nationalityError'
            },
            {
                id: 'dob_id',
                errorId: 'dobError'
            },
            {
                id: 'email_id',
                errorId: 'emailError'
            },
            {
                id: 'visaService',
                errorId: 'visaTypeError'
            }

        ];

        requiredFields.forEach(function(field) {
            const input = document.getElementById(field.id);
            const errorElement = document.getElementById(field.errorId);

            errorElement.textContent = ""; // Clear previous error messages
            if (input.value.trim() === '') {
                errorElement.textContent = "This field is required";
                valid = false;
            }
        });

        if (valid) {
            this.submit();
        }
    });
</script>

@endsection