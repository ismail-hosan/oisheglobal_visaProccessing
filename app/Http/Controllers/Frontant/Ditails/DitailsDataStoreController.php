<?php

namespace App\Http\Controllers\Frontant\Ditails;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VisaDataModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DitailsDataStoreController extends Controller
{
    public function first(Request $request)
    {
        $store = new VisaDataModel();
        $store->code = 'OI' . random_int(100, 999); 
        $store->user_id = $request->user_id;
        $store->country_id = $request->appl_countryname;
        $store->branch_id = $request->appl_branchcode;
        $store->nationality = $request->appl_nationality;
        $store->email = $request->appl_email;
        $store->journeydate = $request->appl_journeydate;
        $store->visa_type = $request->appl_visa_service_id;
        $store->birthday = $request->appl_birthdate;
        $store->save();

        $userId = $store->id;

        if ($store) {
            return view('frontant_with_extra_path.pages.visaditails.second', get_defined_vars());
        } else {
            return redirect()->back()->with('error', 'Somthing is wrong');
        }
    }

    public function second(Request $request)
    {
        $store = VisaDataModel::find($request->user_id);
        $store->surname = $request->appl_surname;
        $store->given_name = $request->appl_given_name;
        $store->gender = $request->appl_gender;
        $store->b_country = $request->appl_birth_country;
        $store->National_id = $request->appl_citizenship_id;
        $store->b_city = $request->appl_birth_city;
        $store->religion = $request->appl_religion;
        $store->visible_identification = $request->appl_identification_marks;
        $store->educational_qualification = $request->appl_education_qualification;
        $store->naturalization = $request->appl_nationality_acquisition;
        $store->lived_in_country = $request->appl_lived_in_country;
        $store->passport_number = $request->passport_number;
        $store->place_of_issue = $request->passport_place_of_issue;
        $store->date_of_issue = $request->passport_date_of_issue;
        $store->date_of_expiry = $request->passport_date_of_expary;
        $store->another_passport= $request->other_passport;
        $store->another_passport_country = $request->second_passport_country;
        $store->another_passport_no = $request->second_passport_ic;
        $store->another_passport_issu_date = $request->second_passport_issu;
        $store->another_passport_issu_place = $request->second_passport_place_issue;
        $store->another_passport_nationality = $request->second_passport_nationality;
        $store->save();
        $applyid = $store->id;
        if ($store) {
            return view('frontant_with_extra_path.pages.visaditails.third', get_defined_vars());
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function therd(Request $request)
    {
        // dd($request->all());
        $applyid = $request->user_id;
        $store = VisaDataModel::find($applyid);
        $store->present_address_street = $request->house_no;
        $store->present_address_city = $request->village_name;
        $store->present_address_country = $request->appl_personal_country;
        $store->present_address_district = $request->appl_perosnal_distric;
        $store->present_address_zipcode = $request->appl_personal_post_code;
        $store->present_address_phone = $request->appl_personal_phone;
        $store->present_address_mobile= $request->appl_personal_mobile;
        $store->marital_status = $request->marid_status;
        $store->spouse_name = $request->spouse_name;
        $store->spouse_phone = $request->spouse_phone;
        $store->permanent_address_street = $request->appl_permanent_street;
        $store->permanent_address_city = $request->appl_permanent_village;
        $store->permanent_address_distric = $request->appl_permanent_distric;
        $store->father_name = $request->father_name;
        $store->father_phone = $request->father_phone;
        $store->mother_name = $request->monther_name; 
        $store->mother_phone = $request->monther_phone;
        $store->present_occupation = $request->appl_parents_ocipations; 
        $store->present_busibess_name = $request->app_business_name;
        $store->present_busibess_designation = $request->app_empolyee_designation; 
        $store->present_busibess_address = $request->app_company_address;
        $store->present_busibess_phone = $request->app_business_phone;
        $store->any_organigation = $request->yes_id;
        $store->other_orgnigation_name = $request->app_organigation_name;
        $store->other_orgnigation_degination = $request->app_organigation_designation;
        $store->other_orgnigation_rank = $request->app_organigation_rank;
        $store->other_orgnigation_post = $request->app_organigation_post; 
        $store->visited_any_country = $request->yes_visa_id;
        $store->privius_visa_address = $request->privius_visa_address; 
        $store->privius_visa_no = $request->privius_visa_no; 
        $store->privius_visa_country = $request->privius_visa_country; 
        $store->privius_visa_type = $request->privius_visa_type; 
        $store->privius_visa_place_issu = $request->privius_visa_place_issu; 
        $store->privius_visa_date_issu = $request->privius_visa_date_issu; 
        $store->privius_visa_expired_issu = $request->privius_visa_expired_issu; 
    
        $store->save();

        $agents = User::where('type','Agent')->get();
    
        if ($store) {
            return view('frontant_with_extra_path.pages.visaditails.final', get_defined_vars());
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function final(Request $request)
    {
        // dd($request->all());
        $applyid = $request->user_id;
        $store = VisaDataModel::find($applyid);
        if ($request->hasFile('personal_image')) {
            $logoname = time() . '_' . $request->personal_image->getClientOriginalName();
            $request->personal_image->move(public_path() . '/storage/customer/', $logoname);
            $store->photo = '/storage/customer/' . $logoname;
        }
        if ($request->hasFile('passport_image')) {
            $logoname = time() . '_' . $request->passport_image->getClientOriginalName();
            $request->passport_image->move(public_path() . '/storage/customer/', $logoname);
            $store->passport_photo = '/storage/customer/' . $logoname;
        }
        $visaImagesPaths = [];
        if ($request->hasFile('visa_image')) {
            foreach($request->visa_image as $visaImage)
            {
                $logoname = time() . '_' . $visaImage->getClientOriginalName();
                $visaImage->move(public_path() . '/storage/customer/', $logoname);
                $visaImagesPaths[] = '/storage/customer/' . $logoname;
            }   
        }
        if($request->refarance_person_name)
        {
            $store->reafarance_name = $request->refarance_person_name;
        }
        if($request->refarance_id)
        {
            $store->refarence_id = $request->refarance_id;
        }
        $store->another_passport_image = json_encode($visaImagesPaths);

        $store->save();

        if ($store) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
       
    }
}
