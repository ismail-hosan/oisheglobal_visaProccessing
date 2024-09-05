@extends('frontant_with_extra_path.pages.visaditails.master')
@section('form')


<form method="post" action="{{Route('visa.second.store')}}" autocomplete="off" id="visaForm">
    @csrf
    <div class="wrapper">
        <div class="pageHeader"></div>
        <div class="pageHeading1 text_center">
            Applicant Details Form
            <a href="index.html">
                <img align="right" src="./images/home.png" style="width: 30px; height:26px;">
            </a>
        </div>
        <input type="hidden" name="user_id" value="{{$userId}}">
        <div class="container" style="min-height: 0px">
            <div class="form_container" style="border:none">
                <div class="row">
                    <div class="col-1 mandatory" title="Surname as shown in your Passport">Surname (as shown in your Passport)</div>
                    <div class="col-2">
                        <input name="appl_surname" type="text" size="50" maxlength="50" id="surname_id">
                    </div>
                    <div class="col-3" id="surenameError" class="error"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Given Name/s as in Passport">Given Name/s (Complete as in Passport)</div>
                    <div class="col-2">
                        <input name="appl_given_name" type="text" size="50" maxlength="50" id="given_name_id">
                    </div>
                    <div class="col-3" id="givenNameError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" id="appl_gender" title="Gender">Gender</div>
                    <div class="col-2">
                        <select name="appl.gender" id="gender_id">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-3" id="genderError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Country/Region of birth">Country/Region of birth</div>
                    <div class="col-2">
                        <select name="appl.birth_country" id="birth_country_id">
                            <option value="">Select Country</option>
                            <option value="Bangladesh">Bangladesh</option>
                        </select>
                    </div>
                    <div class="col-3" id="birthCountryError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Citizenship/National ID No.">Citizenship/National ID No.</div>
                    <div class="col-2">
                        <input name="appl.citizenship_id" type="text" size="50" maxlength="50" id="citizenship_id">
                    </div>
                    <div class="col-3" id="citizenshipError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Town/City of birth">Town/City of birth</div>
                    <div class="col-2">
                        <input name="appl.birth_city" type="text" size="50" maxlength="50" id="birth_city_id">
                    </div>
                    <div class="col-3" id="birthCityError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Religion">Religion</div>
                    <div class="col-2">
                        <select name="appl.religion" id="religion_id">
                            <option value="">Select Religion</option>
                            <option value="Islam">Islam</option>
                            <option value="Hindu">Hindu</option>
                        </select>
                    </div>
                    <div class="col-3" id="religionError"></div>
                </div>

                <div class="row">
                    <div class="col-1 mandatory" title="Educational Qualification">Educational Qualification</div>
                    <div class="col-2">
                        <select name="appl.education_qualification" id="education_qualification_id">
                            <option value="">Select Qualification</option>
                            <option value="High School">High School</option>
                            <option value="Undergraduate">Undergraduate</option>
                            <option value="Postgraduate">Postgraduate</option>
                        </select>
                    </div>
                    <div class="col-3" id="educationQualificationError"></div>
                </div>
            </div>
        </div>
        <div class="pageHeading1 text_center" style="font-size: 1.2rem;line-height: 18px;">
            Passport Details
        </div>
        <div class="container" style="min-height: 0px">
            <div class="form_container" style="border:none">
                <div class="row">
                    <div class="col-1 mandatory" title="Passport Number">Passport Number</div>
                    <div class="col-2">
                        <input name="passport.number" type="text" size="50" maxlength="50" id="passport_number_id">
                    </div>
                    <div class="col-3" id="passportNumberError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Place of Issue">Place of Issue</div>
                    <div class="col-2">
                        <input name="passport.place_of_issue" type="text" size="50" maxlength="50" id="place_of_issue_id">
                    </div>
                    <div class="col-3" id="placeOfIssueError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Date of Issue">Date of Issue</div>
                    <div class="col-2">
                        <input type="text" name="passport.date_of_issue" class="datepicker" id="date_of_issue_id">
                    </div>
                    <div class="col-3" id="dateOfIssueError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Date of Issue">Date of expiry</div>
                    <div class="col-2">
                        <input type="text" name="passport.date_of_expary" class="datepicker" id="date_of_expary_id">
                    </div>
                    <div class="col-3" id="date_of_expary_idError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Any other valid Passport/Identity Certificate(IC) held?" id="appl_other_passport">
                        Any other valid Passport/Identity Certificate(IC) held?
                    </div>
                    <div class="col-2" style="display: flex; align-items: center;">
                        <label for="yes_id" style="margin-right: 10px;">Yes</label>
                        <input type="radio" name="other_passport" id="yes_id" value="yes" style="margin-right: 20px;" onclick="toggleFields(true)" checked>

                        <label for="no_id" style="margin-right: 10px;">No</label>
                        <input type="radio" name="other_passport" id="no_id" value="no" onclick="toggleFields(false)">
                    </div>

                    <div class="col-3" id="passportError"></div>

                    <div id="conditionalFields" style="display:block;">
                        <div class="row">
                            <div class="col-1 mandatory" title="Expected Date of Arrival" id="expected_arrival_date">Country/Region of Issue</div>
                            <div class="col-2">
                                <select name="second_passport_country"
                                    id="second_passport_country">
                                    <option value selected>Select Country</option>
                                    <option value="Construction">Bangladesh</option>
                                </select>
                            </div>
                            <div class="col-3" id="second_passport_countryError"></div>
                        </div>

                        <div class="row">
                            <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Passport/IC No</div>
                            <div class="col-2">
                                <input name="second_passport_ic" type="number" size="50" maxlength="50" id="second_passport_ic">
                            </div>
                            <div class="col-3" id="second_passport_icError"></div>
                        </div>
                        <div class="row">
                            <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Date of Issue</div>
                            <div class="col-2">
                                <input type="text" name="second_passport_issu" class="datepicker" id="second_passport_issu">
                            </div>
                            <div class="col-3" id="second_passport_issuError"></div>
                        </div>
                        <div class="row">
                            <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Place of Issue</div>
                            <div class="col-2">
                                <input name="second_passport_place_issue" type="text" size="50" maxlength="50" id="second_passport_place_issue">
                            </div>
                            <div class="col-3" id="second_passport_place_issueError"></div>
                        </div>

                        <div class="row">
                            <div class="col-1 mandatory" title="Expected Date of Arrival" id="expected_arrival_date">Nationality mentioned therein</div>
                            <div class="col-2">
                                <select name="second_passport_nationality"
                                    id="second_passport_nationality">
                                    <option value selected>Select Nationality</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                </select>
                            </div>
                            <div class="col-3" id="second_passport_nationalityError"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pageHeading1 text_center">
        <div class="row text_center">
            <input name="submit_registration" type="submit" class="btn btn-primary" value="Continue">
        </div>
    </div>
</form>


<script>
    document.getElementById('visaForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let valid = true;

        const requiredFields = [{
                id: 'surname_id',
                errorId: 'surenameError'
            },
            {
                id: 'given_name_id',
                errorId: 'givenNameError'
            },
            {
                id: 'gender_id',
                errorId: 'genderError'
            },
            {
                id: 'birth_country_id',
                errorId: 'birthCountryError'
            },
            {
                id: 'citizenship_id',
                errorId: 'citizenshipError'
            },
            {
                id: 'birth_city_id',
                errorId: 'birthCityError'
            },
            {
                id: 'religion_id',
                errorId: 'religionError'
            },
            {
                id: 'education_qualification_id',
                errorId: 'educationQualificationError'
            },
            {
                id: 'passport_number_id',
                errorId: 'passportNumberError'
            },
            {
                id: 'place_of_issue_id',
                errorId: 'placeOfIssueError'
            },
            {
                id: 'date_of_issue_id',
                errorId: 'dateOfIssueError'
            },
            {
                id: 'date_of_expary_id',
                errorId: 'date_of_expary_idError'
            }
        ];

        requiredFields.forEach(function(field) {
            const input = document.getElementById(field.id);
            const errorElement = document.getElementById(field.errorId);

            errorElement.textContent = "";
            if (input.value.trim() === '') {
                errorElement.textContent = "This field is required";
                valid = false;
            }
        });

        if (document.getElementById('yes_id').checked) {
            const conditionalFields = [{
                    id: 'second_passport_country',
                    errorId: 'second_passport_countryError'
                },
                {
                    id: 'second_passport_ic',
                    errorId: 'second_passport_icError'
                },
                {
                    id: 'second_passport_issu',
                    errorId: 'second_passport_issuError'
                },
                {
                    id: 'second_passport_place_issue',
                    errorId: 'second_passport_place_issueError'
                },
                {
                    id: 'second_passport_nationality',
                    errorId: 'second_passport_nationalityError'
                }
            ];

            conditionalFields.forEach(function(field) {
                const input = document.getElementById(field.id);
                const errorElement = document.getElementById(field.errorId);

                errorElement.textContent = "";
                if (input && input.value.trim() === '') {
                    errorElement.textContent = "This field is required";
                    valid = false;
                }
            });
        }

        if (valid) {
            this.submit();
        }
    });

    function toggleFields(show) {
        var conditionalFields = document.getElementById('conditionalFields');
        if (show) {
            conditionalFields.style.display = 'block';
        } else {
            conditionalFields.style.display = 'none';
        }
    }
</script>

@endsection