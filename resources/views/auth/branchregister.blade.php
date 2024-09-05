<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agent | Registration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>
        html,
        body {
            min-height: 100%;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
            font-family: Roboto, Arial, sans-serif;
            font-size: 14px;
            color: #666;
            background: #f9f9f9;
        }

        h1 {
            margin: 0 0 20px;
            font-weight: 400;
            text-align: center;
            font-size: 24px;
        }

        h3 {
            margin: 12px 0;
            color: #8ebf42;
            font-size: 18px;
        }

        .main-block {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            max-width: 800px;
            margin: 40px auto;
        }

        form {
            width: 100%;
            padding: 20px;
        }

        fieldset {
            border: none;
            border-top: 1px solid #8ebf42;
            margin-bottom: 20px;
            padding-top: 20px;
        }

        .account-details,
        .personal-details {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .account-details>div,
        .personal-details>div {
            flex: 1;
            min-width: 250px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 10px 0;
            margin-top: 20px;
            border-radius: 5px;
            border: none;
            background: #8ebf42;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #82b534;
        }

        .mandatory:after {
            content: '*';
            color: #B51717;
            margin-left: 4px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .account-details,
            .personal-details {
                flex-direction: column;
            }

            .account-details>div,
            .personal-details>div {
                width: 100%;
                min-width: unset;
            }

            .main-block {
                margin: 20px;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            form {
                padding: 15px;
            }

            h1 {
                font-size: 20px;
            }

            h3 {
                font-size: 16px;
            }

            input,
            textarea,
            select {
                font-size: 14px;
            }

            button {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="main-block">
        <form action="{{ Route('branch.registration') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h1>Create an Agent Account</h1>
            <fieldset>
                <legend>
                    <h3>Account Details</h3>
                </legend>
                <div class="account-details">
                    <div>
                        <label class="mandatory">Email</label>
                        <input type="email" name="email" required>
                        @error('email')
                        <div class="alert alert-danger" style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="mandatory">Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <div>
                        <label class="mandatory">Branch</label>
                        <select name="branch_id" id="branch_id" required>
                            <option value="" selected disabled>Select Branch</option>
                            @foreach($branchs as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name ?? 'N/A' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>
                    <h3>Personal Details</h3>
                </legend>
                <div class="personal-details">
                    <div>
                        <label class="mandatory">Name</label>
                        <input type="text" name="name" required>
                    </div>
                    <div>
                        <label>Phone</label>
                        <input type="text" name="phone">
                        @error('phone')
                        <div class="alert alert-danger" style="color:red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="mandatory">Mobile</label>
                        <input type="text" name="mobile" required>
                    </div>
                    <div>
                        <label class="mandatory">NID No</label>
                        <input type="text" name="nid_no" required>
                    </div>
                    <div>
                        <label class="mandatory">Present Address</label>
                        <textarea name="present_address" rows="3" required></textarea>
                    </div>
                </div>
                <div class="personal-details">
                    <div>
                        <label class="mandatory">Father Name</label>
                        <input type="text" name="father_name" required>
                    </div>
                    <div>
                        <label class="mandatory">Mother Name</label>
                        <input type="text" name="mother_name" required>
                    </div>
                    <div>
                        <label class="mandatory">RL No</label>
                        <input type="text" name="rl_no" required>
                    </div>
                    <div>
                        <label class="mandatory">Passport No</label>
                        <input type="text" name="passport_no" required>
                    </div>
                    <div>
                        <label class="mandatory">Permanent Address</label>
                        <textarea name="permanent_address" rows="3" required></textarea>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>
                    <h3>Company Details</h3>
                </legend>
                <div class="personal-details">
                    <div>
                        <label class="mandatory">Company Name</label>
                        <input type="text" name="company_name" required>
                    </div>
                    <div>
                        <label class="mandatory">TIN Number</label>
                        <input type="text" name="tin_number">
                    </div>
                    <div>
                        <label class="mandatory">Company Address</label>
                        <textarea name="company_address" rows="3" required></textarea>
                    </div>
                </div>
                <div class="personal-details">
                    <div>
                        <label class="mandatory">Trade License No</label>
                        <input type="text" name="trade_license_no" required>
                    </div>
                    <div>
                        <label class="mandatory">IRC Number</label>
                        <input type="text" name="irc_number" required>
                    </div>
                    <div>
                        <label class="mandatory">BRC Number</label>
                        <input type="text" name="brc_number" required>
                    </div>
                    <div>
                        <label class="mandatory">Company BIN</label>
                        <input type="text" name="company_bin" required>
                    </div>
                </div>
            </fieldset>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>
