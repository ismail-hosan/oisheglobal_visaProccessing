<?php

namespace App\Http\Controllers;

use App\Models\AgentRegisterData;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerLoginController extends Controller
{

    public function registration(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'phone' => [
                'required',
                'max:255',
                Rule::unique('users', 'phone'),
            ],
            'address'=> 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);

        $randomInteger = rand(300, 9999);

        $customer = User::create([
            'code'=> $randomInteger,
            'branch_id' => $request->input('branch_id') ?? '',
            'phone' => $request->input('phone'),
            'name' => $request->input('name'),
            'address' =>$request->input('address'),
            'type' => 'Customer',
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        $notification = array(
            'message' => 'Registration Completed Successfully Please Wait for admin approve !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function branchregistration(Request $request)
    {
    //   dd($request->all());
    
        $validated = $request->validate([
            'phone' => [
                'required',
                'max:255',
                Rule::unique('users', 'phone'),
            ],
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $randomInteger = rand(300, 9999);
        $customer = User::create([
            'code'=> $randomInteger,
            'branch_id' => $request->input('branch_id'),
            'phone' => $request->input('phone'),
            'name' => $request->input('name'),
            'address' =>$request->input('present_address'),
            'type' => 'Agent',
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'status'=>'Inactive',
        ]);

        $agentData = new AgentRegisterData();
        $agentData->agent_id = $customer->id;
        $agentData->mobile = $request->mobile;
        $agentData->nid_no = $request->nid_no;
        $agentData->father_name = $request->father_name;
        $agentData->mother_name = $request->mother_name;
        $agentData->rl_no = $request->rl_no;
        $agentData->passport_no = $request->passport_no;
        $agentData->permanent_address = $request->permanent_address;
        $agentData->company_name = $request->company_name;
        $agentData->tin_number = $request->tin_number;
        $agentData->company_address = $request->company_address;
        $agentData->trade_license_no = $request->trade_license_no;
        $agentData->bin_number = $request->bin_number;
        $agentData->bussiness_year = $request->bussiness_year;
        if ($request->hasFile('personal_image')) {
            $image = $request->file('personal_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/agent/personal/'), $imageName);
            $agentData->personal_image = 'backend/agent/personal/' . $imageName;
        }
        if ($request->hasFile('rld_image')) {
            $image = $request->file('rld_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/agent/rld_image/'), $imageName);
            $agentData->rld_image = 'backend/agent/rld_image/' . $imageName;
        }
        if ($request->hasFile('tin_image')) {
            $image = $request->file('tin_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/agent/tin/'), $imageName);
            $agentData->tin_image = 'backend/agent/tin/' . $imageName;
        }
        if ($request->hasFile('trade_image')) {
            $image = $request->file('trade_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/agent/trade/'), $imageName);
            $agentData->trade_image = 'backend/agent/trade/' . $imageName;
        }
        if ($request->hasFile('nid_front')) {
            $image = $request->file('nid_front');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/agent/nid-front/'), $imageName);
            $agentData->nid_front = 'backend/agent/nid-front/' . $imageName;
        }
        if ($request->hasFile('nid_back')) {
            $image = $request->file('nid_back');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/agent/nid-back/'), $imageName);
            $agentData->nid_back = 'backend/agent/nid-back/' . $imageName;
        }
        if ($request->hasFile('passport_image')) {
            $image = $request->file('passport_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/agent/passport/'), $imageName);
            $agentData->passport_image = 'backend/agent/passport/' . $imageName;
        }
        if ($request->hasFile('bin_image')) {
            $image = $request->file('bin_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/agent/bin/'), $imageName);
            $agentData->bin_image = 'backend/agent/bin/' . $imageName;
        }
       
        $agentData->save();
        $notification = array(
            'message' => 'Registration Completed Successfully Please Wait for admin approve !!',
            'alert-type' => 'success'
        );
        return redirect()->route('login')->with($notification);
    }




    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            return redirect()->url('admin/home');
        } else {
            return back()->with('error', 'Invalid credentials or not a Customer. Please try again.');
        }
    }




    public function dashboard()
    {
        return view('customer.home');
    }
}
