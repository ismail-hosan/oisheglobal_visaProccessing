@extends('frontant_with_extra_path.pages.visaditails.master')
@section('form')


<form method="post" action="{{Route('visa.therd.store')}}" autocomplete="off" id="visaForm">
    @csrf
    <div class="wrapper">
        <div class="pageHeader"></div>
        <div class="pageHeading1" style="font-size: 1.2rem;line-height: 18px;">
            Applicant's Address Details
            <a href="index.html">
                <img align="right" src="./images/home.png" style="width: 30px; height:26px;">
            </a>
        </div>
        <input type="hidden" name="user_id" value="{{$applyid}}">
        <div class="container" style="min-height: 0px">
            <div class="form_container" style="border:none">
                <div class="pageHeading1 text_center" style="font-size: 1.0rem;line-height: 18px;background-color:white;border-bottom:none;color:red">
                    Present Address
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Surname as shown in your Passport">House No./Street</div>
                    <div class="col-2">
                        <input name="house_no" type="text" size="50" maxlength="50" id="house_no_id">
                    </div>
                    <div class="col-3" id="surenameError" class="error"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Given Name/s as in Passport">Village/Town/City</div>
                    <div class="col-2">
                        <input name="village_name" type="text" size="50" maxlength="50" id="given_name_id">
                    </div>
                    <div class="col-3" id="givenNameError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" id="appl_gender" title="Gender">Country</div>
                    <div class="col-2">
                        <select name="appl_personal_country" id="gender_id">
                            <option value="">Select Country</option>
                            <option value="Bangladesh">Bangladesh</option>
                        </select>
                    </div>
                    <div class="col-3" id="genderError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Country/Region of birth">State/Province/District</div>
                    <div class="col-2">
                        <input name="appl_perosnal_distric" type="text" size="50" maxlength="50" id="citizenship_id">
                    </div>

                    <div class="col-3" id="citizenshipError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Citizenship/National ID No.">Postal/Zip Code</div>
                    <div class="col-2">
                        <input name="appl_personal_post_code" type="text" size="50" maxlength="50" id="post_code">
                    </div>
                    <div class="col-3" id="post_codeError"></div>
                </div>
                <div class="row">
                    <div class="col-1" title="Town/City of birth">Phone No.</div>
                    <div class="col-2">
                        <input name="appl_personal_phone" type="text" size="50" maxlength="50" id="birth_city_id">
                    </div>
                    <div class="col-3" id="birthCityError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Religion">Mobile No.</div>
                    <div class="col-2">
                        <input name="appl_personal_mobile" type="text" size="50" maxlength="50" id="religion_id">
                    </div>
                    <div class="col-3" id="religionError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Religion">Applicant's Marital Status.</div>
                    <div class="col-2">
                        <select name="marid_status" id="marid_status" onchange="toggleMarriedFields()">
                            <option value="">Select Marital Status</option>
                            <option value="Married">Married</option>
                            <option value="Unmarrid">Unmarrid</option>
                        </select>
                    </div>
                    <div class="col-3" id="marid_statusError"></div>
                </div>

                <div id="marriedFields" style="display: none;">
                    <div class="row">
                        <div class="col-1 mandatory">Husbant/Wife Name:</div>
                        <div class="col-2">
                            <input type="text" name="spouse_name" id="spouse_name">
                        </div>
                        <div class="col-3" id="spouse_nameError"></div>
                    </div>
                    <div class="row">
                        <div class="col-1">Phone:</div>
                        <div class="col-2">
                            <input type="number" name="spouse_phone" id="spouse_phone">
                        </div>
                    </div>
                </div>

                <div class="row" style="display: flex;justify-content:center">
                    <button type="button" id="do">Do</button>
                </div>

                <div class="pageHeading1 text_center" style="font-size: 1.0rem;line-height: 18px;background-color:white;border-bottom:none;color:red">
                    Permanent Address:
                </div>

                <div class="row">
                    <div class="col-1 mandatory" title="Educational Qualification">House No./Street*</div>
                    <div class="col-2">
                        <input name="appl_permanent_street" type="text" size="50" maxlength="50" id="education_qualification_id">
                    </div>
                    <div class="col-3" id="educationQualificationError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Did you acquire Nationality by birth or by naturalization?">Village/Town/City</div>
                    <div class="col-2">
                        <input name="appl_permanent_village" type="text" size="50" maxlength="50" id="nationality_acquisition_id">
                    </div>
                    <div class="col-3" id="nationalityAcquisitionError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Did you acquire Nationality by birth or by naturalization?">State/Province/District </div>
                    <div class="col-2">
                        <input name="appl_permanent_distric" type="text" size="50" maxlength="50" id="state_id">
                    </div>
                    <div class="col-3" id="state_idError"></div>
                </div>
            </div>
        </div>
        <div class="pageHeading1" style="font-size: 1.2rem;line-height: 18px;">
            Family Details
        </div>
        <div class="pageHeading1 text_center" style="font-size: 1.0rem;line-height: 18px;background-color:white;border-bottom:none;color:red">
            Father's Details:
        </div>

        <div class="container" style="min-height: 0px">
            <div class="form_container" style="border:none">
                <div class="row">
                    <div class="col-1 mandatory" title="Passport Number">Name</div>
                    <div class="col-2">
                        <input name="father_name" type="text" size="50" maxlength="50" id="passport_number_id">
                    </div>
                    <div class="col-3" id="passportNumberError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Place of Issue">Phone</div>
                    <div class="col-2">
                        <input name="father_phone" type="number" size="50" maxlength="50" id="place_of_issue_id">
                    </div>
                    <div class="col-3" id="placeOfIssueError"></div>
                </div>
                <div class="pageHeading1 text_center" style="font-size: 1.0rem;line-height: 18px;background-color:white;border-bottom:none;color:red">
                    Mother Ditails:
                </div>

                <div class="row">
                    <div class="col-1 mandatory" title="Date of Issue">Name</div>
                    <div class="col-2">
                        <input name="monther_name" type="text" id="date_of_issue_id">
                    </div>
                    <div class="col-3" id="dateOfIssueError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Any other valid Passport/Identity Certificate(IC) held?" id="appl_other_passport">Phone
                    </div>
                    <div class="col-2">
                        <input name="monther_phone" type="number" id="mother_phone">
                    </div>
                    <div class="col-3" id="mother_phoneError"></div>
                </div>
            </div>
        </div>

        <div class="pageHeading1" style="font-size: 1.2rem;line-height: 18px;">
            Profession / Occupation Details of Applicant
        </div>
        <div class="container" style="min-height: 0px">
            <div class="form_container" style="border:none">
                <div class="row">
                    <div class="col-1 mandatory" title="Passport Number">Present Occupation</div>
                    <div class="col-2">
                        <select name="appl_parents_ocipations" id="appl_parents_ocipations">
                            <option value="">Select Gender</option>
                            <option value="Bussiness">Bussiness</option>
                            <option value="Job">Job</option>
                            <option value="Student">Student</option>
                            <option value="House wife">House Wife</option>
                            <option value="Farmer">Farmer</option>
                            <option value="Daily Labour">Daily Labour</option>
                        </select>
                    </div>
                    <div class="col-3" id="appl_parents_ocipationsError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Place of Issue">Employer Name/business</div>
                    <div class="col-2">
                        <input name="app_business_name" type="text" size="50" maxlength="50" id="app_business_name">
                    </div>
                    <div class="col-3" id="app_business_nameError"></div>
                </div>
                <div class="row">
                    <div class="col-1" title="Date of Issue">Designation</div>
                    <div class="col-2">
                        <input name="app_empolyee_designation" type="text" id="app_empolyee_designation">
                    </div>
                    <div class="col-3" id="app_empolyee_designationError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Any other valid Passport/Identity Certificate(IC) held?" id="appl_other_passport">Address
                    </div>
                    <div class="col-2">
                        <input name="app_company_address" type="text" id="app_company_address">
                    </div>
                    <div class="col-3" id="app_company_addressError"></div>
                </div>
                <div class="row">
                    <div class="col-1 mandatory" title="Any other valid Passport/Identity Certificate(IC) held?" id="appl_other_passport">Phone</div>
                    <div class="col-2">
                        <input name="app_business_phone" type="number" id="app_business_phone">
                    </div>
                    <div class="col-3" id="app_business_phoneError"></div>
                </div>

                <div class="row">
                    <div class="col-1 mandatory" title="Any other valid Passport/Identity Certificate(IC) held?" id="appl_other_passport">
                        Are/were you in a Military/Semi-Military/Police/Security.
                        Organization?
                    </div>
                    <div class="col-2" style="display: flex; align-items: center;">
                        <label for="yes_id" style="margin-right: 10px;">Yes</label>
                        <input type="radio" name="yes_id" id="yes_id" value="yes" style="margin-right: 20px;" onclick="toggleFields(true)" checked>

                        <label for="no_id" style="margin-right: 10px;">No</label>
                        <input type="radio" name="yes_id" id="no_id" value="no" onclick="toggleFields(false)">
                    </div>

                    <div class="col-3" id="passportError"></div>
                </div>
                <div id="conditionalFields" style="display:block;">
                    <div class="row">
                        <div class="col-1 mandatory" title="Expected Date of Arrival" id="expected_arrival_date">Organization</div>
                        <div class="col-2">
                            <input name="app_organigation_name" type="text" size="50" maxlength="50" id="app_organigation_name">
                        </div>
                        <div class="col-3" id="app_organigation_nameError"></div>
                    </div>

                    <div class="row">
                        <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Designation</div>
                        <div class="col-2">
                            <input name="app_organigation_designation" type="text" size="50" maxlength="50" id="app_organigation_designation">
                        </div>
                        <div class="col-3" id="app_organigation_designationError"></div>
                    </div>
                    <div class="row">
                        <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Rank</div>
                        <div class="col-2">
                            <input name="app_organigation_rank" type="text" size="50" maxlength="50" id="app_organigation_rank">
                        </div>
                        <div class="col-3" id="app_organigation_rankError"></div>
                    </div>
                    <div class="row">
                        <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Place of Posting</div>
                        <div class="col-2">
                            <input name="app_organigation_post" type="text" size="50" maxlength="50" id="app_organigation_post">
                        </div>
                        <div class="col-3" id="app_organigation_postError"></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="pageHeading1" style="font-size: 1.2rem;line-height: 18px;">
            Previous Visa/Currently valid Visa Details
        </div>
        <div class="container" style="min-height: 0px">
            <div class="form_container" style="border:none">

                <div class="row">
                    <div class="col-1 mandatory" title="Any other valid Passport/Identity Certificate(IC) held?" id="appl_other_passport">
                        Have you ever visited before any country?
                    </div>
                    <div class="col-2" style="display: flex; align-items: center;">
                        <label for="yes_id" style="margin-right: 10px;">Yes</label>
                        <input type="radio" name="yes_visa_id" id="yes_visa_id" value="yes" style="margin-right: 20px;" onclick="visaFields(true)" checked>

                        <label for="no_id" style="margin-right: 10px;">No</label>
                        <input type="radio" name="yes_visa_id" id="no_visa_id" value="no" onclick="visaFields(false)">
                    </div>

                    <div class="col-3" id="passportError"></div>
                </div>
                <div id="visaFields" style="display:block;">
                    <div class="row">
                        <div class="col-1 mandatory" title="Expected Date of Arrival" id="expected_arrival_date">Address</div>
                        <div class="col-2">
                            <input name="privius_visa_address" type="text" size="50" maxlength="50" id="privius_visa_address">
                        </div>
                        <div class="col-3" id="privius_visa_addressError"></div>
                    </div>
                    <div class="row">
                        <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Visa No</div>
                        <div class="col-2">
                            <input name="privius_visa_no" type="text" size="50" maxlength="50" id="privius_visa_no">
                        </div>
                        <div class="col-3" id="privius_visa_noError"></div>
                    </div>
                    <div class="row">
                        <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Country</div>
                        <div class="col-2">
                            <input name="privius_visa_country" type="text" size="50" maxlength="50" id="privius_visa_country">
                        </div>
                        <div class="col-3" id="privius_visa_countryError"></div>
                    </div>
                    <div class="row">
                        <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Type of Visa</div>
                        <div class="col-2">
                            <input name="privius_visa_type" type="text" size="50" maxlength="50" id="privius_visa_type">
                        </div>
                        <div class="col-3" id="privius_visa_typeError"></div>
                    </div>
                    <div class="row">
                        <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Place of Issue</div>
                        <div class="col-2">
                            <input name="privius_visa_place_issu" type="text" size="50" maxlength="50" id="privius_visa_place_issu">
                        </div>
                        <div class="col-3" id="privius_visa_place_issuError"></div>
                    </div>
                    <div class="row">
                        <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Date of Issue</div>
                        <div class="col-2">
                            <input name="privius_visa_date_issu" type="text" class="datepicker" size="50" maxlength="50" id="privius_visa_date_issu">
                        </div>
                        <div class="col-3" id="privius_visa_date_issuError"></div>
                    </div>
                    <div class="row">
                        <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Expired Of Issu</div>
                        <div class="col-2">
                            <input name="privius_visa_expired_issu" type="text" class="datepicker" size="50" maxlength="50" id="privius_visa_expired_issu">
                        </div>
                        <div class="col-3" id="privius_visa_expired_issuError"></div>
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
    document.getElementById('do').addEventListener('click', function() {
        var houseNoValue = document.getElementById('house_no_id').value;
        var cityStat = document.getElementById('given_name_id').value;
        var district = document.getElementById('citizenship_id').value;

        document.getElementById('education_qualification_id').value = houseNoValue;
        document.getElementById('nationality_acquisition_id').value = cityStat;
        document.getElementById('state_id').value = district;
    });

    function toggleMarriedFields() {
        var maritalStatus = document.getElementById("marid_status").value;
        var marriedFields = document.getElementById("marriedFields");

        if (maritalStatus === "Married") {
            marriedFields.style.display = "block";
        } else {
            marriedFields.style.display = "none";
        }
    }

    function toggleFields(show) {
        var conditionalFields = document.getElementById('conditionalFields');
        if (show) {
            conditionalFields.style.display = 'block';
        } else {
            conditionalFields.style.display = 'none';
        }
    }

    function visaFields(show) {
        var conditionalFields = document.getElementById('visaFields');
        if (show) {
            conditionalFields.style.display = 'block';
        } else {
            conditionalFields.style.display = 'none';
        }
    }
    document.getElementById('visaForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let valid = true;

        const requiredFields = [{
                id: 'house_no_id',
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
                id: 'citizenship_id',
                errorId: 'citizenshipError'
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
                id: 'nationality_acquisition_id',
                errorId: 'nationalityAcquisitionError'
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
                id: 'mother_phone',
                errorId: 'mother_phoneError'
            },
            {
                id: 'post_code',
                errorId: 'post_codeError'
            },
            {
                id: 'state_id',
                errorId: 'state_idError'
            },
            {
                id: 'marid_status',
                errorId: 'marid_statusError'
            },
            {
                id: 'appl_parents_ocipations',
                errorId: 'appl_parents_ocipationsError'
            },
            {
                id: 'app_business_name',
                errorId: 'app_business_nameError'
            },
            {
                id: 'app_company_address',
                errorId: 'app_company_addressError'
            },
            {
                id: 'app_business_phone',
                errorId: 'app_business_phoneError'
            },


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
                    id: 'app_organigation_name',
                    errorId: 'app_organigation_nameError'
                },
                {
                    id: 'app_organigation_designation',
                    errorId: 'app_organigation_designationError'
                },
                {
                    id: 'app_organigation_rank',
                    errorId: 'app_organigation_rankError'
                },
                {
                    id: 'app_organigation_post',
                    errorId: 'app_organigation_postError'
                },
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
        if (document.getElementById('yes_visa_id').checked) {
            const conditionalFields = [{
                    id: 'privius_visa_address',
                    errorId: 'privius_visa_addressError'
                },
                {
                    id: 'privius_visa_no',
                    errorId: 'privius_visa_noError'
                },
                {
                    id: 'privius_visa_country',
                    errorId: 'privius_visa_countryError'
                },
                {
                    id: 'privius_visa_type',
                    errorId: 'privius_visa_typeError'
                },
                {
                    id: 'privius_visa_place_issu',
                    errorId: 'privius_visa_place_issuError'
                },
                {
                    id: 'privius_visa_date_issu',
                    errorId: 'privius_visa_date_issuError'
                },
                {
                    id: 'privius_visa_expired_issu',
                    errorId: 'privius_visa_expired_issuError'
                },
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
        var maritalStatus = document.getElementById("marid_status").value;
        if (maritalStatus === "Married") {
            const conditionalFields = [{
                id: 'spouse_name',
                errorId: 'spouse_nameError'
            }, ];

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
</script>

@endsection