@extends('backend_extra_path.layouts.master')

@section('title')
Edit Customer - {{$title}}
@endsection

@section('navbar-content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Customer</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('inventorySetup.customer.index') }}">Customer List</a></li>
                    <li class="breadcrumb-item active"><span>Edit Customer</span></li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('admin-content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Edit Application Ditails</h3>
            </div>
            <div class="card-body">
                <form class="needs-validation" method="POST" action="{{ route('application-list.update', $editInfo->id) }}" novalidate>
                    @csrf

                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="code">Country * :</label>
                            <select name="appl.countryname" class="form-control" id="countryname_id">
                                <option value="">Select country</option>
                                @foreach($countryNames as $countryName)
                                <option value="{{ $countryName->id }}"
                                    {{ $countryName->id == $editInfo->country_id ? 'selected' : '' }}>
                                    {{ $countryName->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('appl.countryname')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="user_id">Branch Office * :</label>
                            <select name="appl_branchcode" class="form-control" id="mission">
                                <option value="">Select Branch</option>
                                @foreach($branchNames as $branchName)
                                <option value="{{ $branchName->id }}"
                                    {{ $branchName->id == $editInfo->id ? 'selected' : '' }}>
                                    {{ $branchName->name }}
                                </option>
                                @endforeach
                            </select>

                            @error('appl_branchcode')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="country_id">Nationality/Region:</label>
                            <select name="appl.nationality" class="form-control" id="nationality_id">
                                <option value="">Select Nationality</option>
                                <option value="Bangladesh"
                                    {{ $editInfo->nationality == 'Bangladesh' ? 'selected' : '' }}>
                                    Bangladesh
                                </option>
                            </select>
                            @error('appl.nationality')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="branch_id">Email ID :</label>
                            <input type="text" name="appl.email" class="form-control" id="branch_id" value="{{ $editInfo->Email }}">
                            @error('appl.email')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nationality">Visa Type :</label>
                            <select name="appl.visa_service_id" class="form-control" id="visaService">
                                <option value="" {{ empty($editInfo->visa_type) ? 'selected' : '' }}>Select visa service</option>
                                <option value="Work Permit" {{ $editInfo->visa_type == 'Work Permit' ? 'selected' : '' }}>Work Permit</option>
                                <option value="Visit Visa" {{ $editInfo->visa_type == 'Visit Visa' ? 'selected' : '' }}>Visit Visa</option>
                                <option value="Student Visa" {{ $editInfo->visa_type == 'Student Visa' ? 'selected' : '' }}>Student Visa</option>
                                <option value="Business Visa" {{ $editInfo->visa_type == 'Business Visa' ? 'selected' : '' }}>Business Visa</option>
                                <option value="Sponsor Visa" {{ $editInfo->visa_type == 'Sponsor Visa' ? 'selected' : '' }}>Sponsor Visa</option>
                            </select>

                            @error('appl.visa_service_id')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email">Surname (as shown in your Passport) :</label>
                            <input type="text" name="appl_surname" class="form-control" id="email" value="{{ $editInfo->surname }}">
                            @error('appl_surname')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="journeydate">Given Name/s (Complete as in Passport):</label>
                            <input type="text" name="appl_given_name" class="form-control" id="journeydate" value="{{ $editInfo->given_name }}">
                            @error('appl_given_name')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="birthday">Gender :</label>
                            <select name="appl.gender" id="gender_id" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ $editInfo->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $editInfo->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('appl.gender')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="visa_type">Country/Region of birth :</label>
                            <select name="appl.birth_country" id="birth_country_id" class="form-control">
                                <option value="">Select Country</option>
                                <option value="Bangladesh" selected>Bangladesh</option>
                            </select>
                            @error('appl.birth_country')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="surname">Citizenship/National ID No:</label>
                            <input type="text" name="appl.citizenship_id" class="form-control" id="surname" value="{{ $editInfo->National_id }}">
                            @error('appl.citizenship_id')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="given_name">Town/City of birth:</label>
                            <input type="text" name="appl.birth_city" class="form-control" id="given_name" value="{{ $editInfo->b_city }}">
                            @error('appl.birth_city')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="gender">Religion :</label>
                            <select name="appl.religion" id="religion_id" class="form-control">
                                <option value="">Select Religion</option>
                                <option value="Islam" {{ $editInfo->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Hindu" {{ $editInfo->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            </select>
                            @error('appl.religion')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="b_city">Educational Qualification:</label>
                            <select name="appl.education_qualification" id="education_qualification_id" class="form-control">
                                <option value="">Select Qualification</option>
                                <option value="High School" {{ $editInfo->educational_qualification== 'High School' ? 'selected' : '' }}>High School</option>
                                <option value="Undergraduate" {{ $editInfo->educational_qualification == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                                <option value="Postgraduate" {{ $editInfo->educational_qualification== 'Postgraduate' ? 'selected' : '' }}>Postgraduate</option>
                            </select>
                            @error('appl.education_qualification')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="b_country">Passport Number :</label>
                            <input type="text" name="passport.number" class="form-control" id="b_country" value="{{ $editInfo->passport_number}}">
                            @error('passport.number')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="national_id">Place of Issue :</label>
                            <input type="text" name="passport.place_of_issue" class="form-control" id="national_id" value="{{ $editInfo->place_of_issue }}">
                            @error('passport.place_of_issue')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="religion">Date of Issue:</label>
                            <input type="text" name="passport.date_of_issue" class="form-control" id="religion" value="{{ $editInfo->date_of_issue }}">
                            @error('religion')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="visible_identification">Country/Region of Issue :</label>
                            <select name="second_passport_country"
                                id="second_passport_country" class="form-control">
                                <option>Select Country</option>
                                <option value="Bangladesh" selected>Bangladesh</option>
                            </select>
                            @error('second_passport_country')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="educational_qualification">Passport/IC No:</label>
                            <input type="text" name="second_passport_ic" class="form-control" id="educational_qualification" value="{{ $editInfo->another_passport_no }}">
                            @error('second_passport_ic')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="naturalization">Date of Issue :</label>
                            <input type="text" name="second_passport_issu" class="form-control" id="naturalization" value="{{ $editInfo->another_passport_issu_date }}">
                            @error('second_passport_issu')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="passport_number">Place of Issue :</label>
                            <input type="text" name="second_passport_place_issue" class="form-control" id="passport_number" value="{{ $editInfo->another_passport_issu_place }}">
                            @error('second_passport_place_issue')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="place_of_issue">Nationality mentioned therein :</label>
                            <select name="second_passport_nationality"
                                id="second_passport_nationality" class="form-control">
                                <option value selected>Select Nationality</option>
                                <option value="Bangladesh" slected>Bangladesh</option>
                            </select>
                            @error('second_passport_nationality')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="date_of_issue">House No./Street:</label>
                            <input type="text" name="house_no" class="form-control" id="date_of_issue" value="{{ $editInfo->present_address_street }}">
                            @error('house_no')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="expiry_date">Village/Town/City:</label>
                            <input type="text" name="village_name" class="form-control" id="expiry_date" value="{{ $editInfo->present_address_city }}">
                            @error('village_name')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="visa_number">Country:</label>
                            <select name="appl_personal_country" id="gender_id" class="form-control">
                                <option value="">Select Country</option>
                                <option value="Bangladesh" selected>Bangladesh</option>
                            </select>
                            @error('appl_personal_country')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone">State/Province/District * :</label>
                            <input type="text" name="appl_perosnal_distric" class="form-control" id="phone" value="{{ $editInfo->present_address_district }}">
                            @error('appl_perosnal_distric')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="address">Postal/Zip Code :</label>
                            <input type="text" name="appl_personal_phone" class="form-control" id="address" value="{{ $editInfo->present_address_phone }}">
                            @error('appl_personal_phone')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Phone No :</label>
                            <input type="text" name="appl_personal_post_code" class="form-control" id="address" value="{{ $editInfo->present_address_phone }}">
                            @error('appl_personal_post_code')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Mobile No :</label>
                            <input type="text" name="appl_personal_mobile" class="form-control" id="address" value="{{ $editInfo->present_address_mobile }}">
                            @error('appl_personal_mobile')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Applicant's Marital Status :</label>
                            <select name="marid_status" id="marid_status" class="form-control">
                                <option value="">Select Marital Status</option>
                                <option value="Married" {{ $editInfo->marital_status == 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Unmarried" {{ $editInfo->marital_status == 'Unmarried' ? 'selected' : '' }}>Unmarried</option>
                            </select>

                            @error('marid_status')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Husbant/Wife Name :</label>
                            <input type="text" name="spouse_name" class="form-control" id="address" value="{{ $editInfo->spouse_name ??'' }}">
                            @error('spouse_name')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Phone :</label>
                            <input type="text" name="spouse_phone" class="form-control" id="address" value="{{ $editInfo->spouse_phone ??'' }}">
                            @error('spouse_phone')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="address">Permanent House No./Street :</label>
                            <input type="text" name="appl_permanent_street" class="form-control" id="address" value="{{ $editInfo->permanent_address_street }}">
                            @error('appl_permanent_street')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Village/Town/City:</label>
                            <input type="text" name="appl_permanent_village" class="form-control" id="address" value="{{ $editInfo->permanent_address_city }}">
                            @error('appl_permanent_village')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Postal/Zip Code :</label>
                            <input type="text" name="appl_personal_post_code" class="form-control" id="address" value="{{ $editInfo->present_address_zipcode }}">
                            @error('appl_personal_post_code')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">State/Province/District :</label>
                            <input type="text" name="appl_permanent_distric" class="form-control" id="address" value="{{ $editInfo->permanent_address_distric }}">
                            @error('appl_permanent_distric')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Father Name :</label>
                            <input type="text" name="father_name" class="form-control" id="address" value="{{ $editInfo->father_name ??'' }}">
                            @error('appl_personal_post_code')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Father Phone :</label>
                            <input type="text" name="father_phone" class="form-control" id="address" value="{{ $editInfo->father_phone ??'' }}">
                            @error('father_phone')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Mother Name :</label>
                            <input type="text" name="monther_name" class="form-control" id="address" value="{{ $editInfo->mother_name ??'' }}">
                            @error('monther_name')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Mother Phone :</label>
                            <input type="text" name="monther_phone" class="form-control" id="address" value="{{ $editInfo->mother_phone ??'' }}">
                            @error('monther_phone')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="appl_parents_ocipations" class="mandatory">Present Occupation</label>
                            <select name="appl_parents_ocipations" id="appl_parents_ocipations" class="form-control">
                                <option value="">Select Occupation</option>
                                <option value="Business" {{ $editInfo->present_occupation == 'Business' ? 'selected' : '' }}>Business</option>
                                <option value="Job" {{ $editInfo->present_occupation == 'Job' ? 'selected' : '' }}>Job</option>
                                <option value="Student" {{ $editInfo->present_occupation == 'Student' ? 'selected' : '' }}>Student</option>
                                <option value="House Wife" {{ $editInfo->present_occupation == 'House Wife' ? 'selected' : '' }}>House Wife</option>
                                <option value="Farmer" {{ $editInfo->present_occupation == 'Farmer' ? 'selected' : '' }}>Farmer</option>
                                <option value="Daily Labour" {{ $editInfo->present_occupation == 'Daily Labour' ? 'selected' : '' }}>Daily Labour</option>
                            </select>

                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="app_business_name" class="mandatory">Employer Name/Business</label>
                            <input type="text" name="app_business_name" class="form-control" id="app_business_name" maxlength="50" value="{{ $editInfo->present_busibess_name ??'' }}">
                        </div>


                        <!-- Designation -->
                        <div class="col-md-6 mb-3">
                            <label for="app_empolyee_designation">Designation</label>
                            <input type="text" name="app_empolyee_designation" class="form-control" id="app_empolyee_designation" value="{{ $editInfo->present_busibess_designation ??'' }}">
                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-3">
                            <label for="app_company_address" class="mandatory">Address</label>
                            <input type="text" name="app_company_address" class="form-control" id="app_company_address" value="{{ $editInfo->present_busibess_address ??'' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="app_business_phone" class="mandatory">Phone</label>
                            <input type="number" name="app_business_phone" class="form-control" id="app_business_phone" value="{{ $editInfo->present_busibess_phone ??'' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="mandatory">Are/were you in a Military/Semi-Military/Police/Security Organization?</label><br>
                            <input type="text" name="yes_id" id="yes_id" style="margin-right: 20px;" class="form-control" value="{{ $editInfo->any_organigation ??'' }}">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="app_organigation_name" class="mandatory">Organization</label>
                            <input type="text" name="app_organigation_name" class="form-control" id="app_organigation_name" maxlength="50" value="{{ $editInfo->other_orgnigation_name ??'' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="app_organigation_designation" class="mandatory">Designation</label>
                            <input type="text" name="app_organigation_designation" class="form-control" id="app_organigation_designation" maxlength="50" value="{{ $editInfo->other_orgnigation_degination ??'' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="app_organigation_rank" class="mandatory">Rank</label>
                            <input type="text" name="app_organigation_rank" class="form-control" id="app_organigation_rank" maxlength="50" value="{{ $editInfo->other_orgnigation_rank ??'' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="app_organigation_post" class="mandatory">Place of Posting</label>
                            <input type="text" name="app_organigation_post" class="form-control" id="app_organigation_post" maxlength="50" value="{{ $editInfo->other_orgnigation_post ??'' }}">
                            @error('app_organigation_post')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="monther_name">Have you ever visited before any country?</label>
                            <input type="text" name="yes_visa_id" class="form-control" id="yes_visa_id" value="{{ $editInfo->visited_any_country ?? '' }}">
                            @error('yes_visa_id')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="monther_phone">Address:</label>
                            <input type="text" name="privius_visa_address" class="form-control" id="privius_visa_address" value="{{ $editInfo->privius_visa_address ?? '' }}">
                            @error('privius_visa_address')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monther_phone">Visa No:</label>
                            <input type="text" name="privius_visa_no" class="form-control" id="privius_visa_no" value="{{ $editInfo->privius_visa_no ?? '' }}">
                            @error('privius_visa_no')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monther_phone">Country:</label>
                            <input type="text" name="privius_visa_country" class="form-control" id="privius_visa_country" value="{{ $editInfo->privius_visa_country ?? '' }}">
                            @error('privius_visa_country')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monther_phone">Type of Visa:</label>
                            <input type="text" name="privius_visa_type" class="form-control" id="privius_visa_type" value="{{ $editInfo->privius_visa_type ?? '' }}">
                            @error('privius_visa_type')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monther_phone">Visa Place Issu:</label>
                            <input type="text" name="privius_visa_place_issu" class="form-control" id="privius_visa_place_issu" value="{{ $editInfo->privius_visa_place_issu ?? '' }}">
                            @error('privius_visa_place_issu')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="monther_phone">Visa Date of Issue:</label>
                            <input type="text" name="privius_visa_date_issu" class="form-control" id="privius_visa_date_issu" value="{{ $editInfo->privius_visa_date_issu ?? '' }}">
                            @error('privius_visa_date_issu')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="monther_phone">Visa Expired Of Issu:</label>
                            <input type="text" name="privius_visa_expired_issu" class="form-control" id="privius_visa_expired_issu" value="{{ $editInfo->privius_visa_expired_issu ?? '' }}">
                            @error('privius_visa_expired_issu')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status">Status :</label>
                            <select name="status" id="status" class="form-control">
                                <option value="Active" {{ $editInfo->status == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ $editInfo->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="Pending" {{ $editInfo->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                            @error('status')
                            <span class="error text-red text-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-info" type="submit"><i class="fa fa-save"></i> &nbsp;Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection