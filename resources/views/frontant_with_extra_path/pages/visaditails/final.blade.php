@extends('frontant_with_extra_path.pages.visaditails.master')
@section('form')
<script src="https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js">

</script>
<style>
    h1 {
        color: darkslategray;
    }

    p {
        font-size: 12pt;
        color: black;
    }

    canvas {
        height: 104px;
        border-style: solid;
        border-width: 1px;
        border-color: black;
    }

    input {
        font-family: verdana;
        font-size: 12pt;
    }
</style>

<form method="post" action="{{Route('visa.final.store')}}" autocomplete="off" id="visaForm" enctype="multipart/form-data">
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

        <div class="" style="min-height: 0px">
            <div class="form_container text-center" style="border:none;margin-left: 355px;">
                <h3 class="mandatory">Upload Applier Image(40mm X 50mm)& Regulation 300</h3>
                <canvas id="photo"></canvas>

                <p>
                    Filename:
                    <input type="file" name="personal_image" multiple="false" id="photoinput" onchange="photoupload()">
                </p>
                <div class="col-3" id="personalError"></div>
            </div>
        </div>

        <div class="" style="min-height: 0px">
            <div class="form_container text-center" style="border:none;margin-left: 355px;">
                <h3 class="mandatory">Upload Passport Image</h3>
                <canvas id="passport"></canvas>

                <p>
                    Filename:
                    <input type="file" multiple="false" name="passport_image" accept="image/*" id="passportinput" onchange="passportupload()">
                </p>
                <div class="col-3" id="passprtError"></div>
            </div>
        </div>


        <div class="" style="min-height: 0px">
            <div class="form_container text-center" style="border:none;margin-left: 355px;">
                <h3 class="">Upload Visa Font Page Picture</h3>
                <canvas id="another"></canvas>
                <p>
                    Filename:
                    <input type="file" name="visa_image[]" multiple="false" accept="image/*" id="anotherinput" onchange="anotherupload()">
                </p>
                <button type="button" href="javascript:;" class="btn btn-info add_module_item">ADD Another Visa</button>

            </div>

        </div>
        <div id="module_section"></div>
        <div class="pageHeading1" style="font-size: 1.2rem;line-height: 18px;">
            Refarence
        </div>
        <div class="container" style="min-height: 0px">
            <div class="form_container" style="border:none">
                <div class="row">
                    <div class="col-1" title="Expected Date of Arrival" id="expected_arrival_date">Refarence Person Name</div>
                    <div class="col-2">
                        <input name="refarance_person_name" type="text" size="50" maxlength="50" id="refarance_person_name">
                    </div>
                    <div class="col-3" id="refarance_person_nameError"></div>
                </div>

                <div class="row">
                    <div class="col-1 mandatory" title="Any other valid Passport/Identity Certificate(IC) held?" id="appl_other_passport">
                        Company Agent refarence?
                    </div>
                    <div class="col-2" style="display: flex; align-items: center;">
                        <label for="yes_id" style="margin-right: 10px;">Yes</label>
                        <input type="radio" name="yes_visa_id" id="yes_visa_id" value="yes" style="margin-right: 20px;" onclick="toggleFields(true)" checked>

                        <label for="no_id" style="margin-right: 10px;">No</label>
                        <input type="radio" name="yes_visa_id" id="no_visa_id" value="no" onclick="toggleFields(false)">
                    </div>

                    <!-- <div class="col-3" id="passportError"></div> -->
                </div>
                <div id="conditionalFields" style="display:block;">
                    <div class="row">
                        <div class="col-1 mandatory" title="Visa Type" id="visa_type_2">Refarence Agent</div>
                        <div class="col-2">
                            <select name="refarance_id" class="js-example-basic-multiple-limit" id="refarance_id">
                                <option value="">Select Refarance Name</option>
                                @foreach($agents as $agent)
                                <option value="{{$agent->id}}">{{$agent->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3" id="refarance_idError"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pageHeading1 text_center">
        <div class="row text_center">
            <input name="submit_registration" type="submit" class="btn btn-primary" value="Done">
        </div>
    </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    let moduleCounter = 1;

    $(document).on('click', '.add_module_item', function() {
        let html = `<div class="" style="min-height: 0px">
        <div class="form_container text-center" style="border:none;margin-left: 355px;">
            <h3 class="">Upload Visa Front Page Picture</h3>
            <canvas id="visaPhoto${moduleCounter}"></canvas>
            <p>
                Filename:
                <input type="file" name="visa_image[]" multiple="false" accept="image/*" id="visainput${moduleCounter}" onchange="visaPhoto(${moduleCounter})">
            </p>
        </div>
    </div>`;

        $('#module_section').append(html);
        moduleCounter++;
    });

    $(document).ready(function() {
        $('.js-example-basic-multiple-limit').select2();
    });

    function photoupload() {
        var imgcanvas = document.getElementById("photo");
        var fileinput = document.getElementById("photoinput");
        var image = new SimpleImage(fileinput);
        image.drawTo(imgcanvas);
    }

    function visaPhoto(counter) {
        var imgcanvas = document.getElementById("visaPhoto" + counter);
        var fileinput = document.getElementById("visainput" + counter);
        var image = new SimpleImage(fileinput);
        image.drawTo(imgcanvas);
    }

    function passportupload() {
        var imgcanvas = document.getElementById("passport");
        var fileinput = document.getElementById("passportinput");
        var image = new SimpleImage(fileinput);
        image.drawTo(imgcanvas);
    }

    function anotherupload() {
        var imgcanvas = document.getElementById("another");
        var fileinput = document.getElementById("anotherinput");
        var image = new SimpleImage(fileinput);
        image.drawTo(imgcanvas);
    }

    function toggleFields(show) {
        var conditionalFields = document.getElementById('conditionalFields');
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
                id: 'photoinput',
                errorId: 'personalError'
            },
            {
                id: 'passportinput',
                errorId: 'passprtError'
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
        if (document.getElementById('yes_visa_id').checked) {
            const conditionalFields = [{
                id: 'refarance_id',
                errorId: 'refarance_idError'
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