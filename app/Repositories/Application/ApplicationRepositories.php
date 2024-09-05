<?php

namespace App\Repositories\Application;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\VisaDataModel;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\PseudoTypes\False_;

class ApplicationRepositories
{

    private $user_id;

    private $user;

    public function __construct(VisaDataModel $visadata)
    {
        $this->user = $visadata;
        $this->user_id = 1;
    }


    public function getAllList()
    {
        $result = $this->user::latest()->get();
        // dd($result);
        return $result;
    }


    /**
     * @param $request
     * @return mixed
     */

    public function getList($request)
    {

        $columns = array(
            0 => 'id',
            1 => 'name',
        );

        $edit = Helper::roleAccess('application-list.edit') ? 1 : 0;
        $delete = Helper::roleAccess('application-list.destroy') ? 1 : 0;
        $view = Helper::roleAccess('application-list.show') ? 1 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->user::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $customers = $this->user::offset($start)
                ->where('Action', 'Active')
                ->with(['branch', 'user'])
                ->orderBy('id', 'desc')
                ->limit($limit)
                ->orderBy($order, $dir);

            if (auth()->user()->type == "Agent") {
                $customers = $customers->where("user_id", auth()->id())->orWhere("refarence_id", auth()->id());
            }
            if (auth()->user()->type == "Branch") {
                $customers = $customers->where("branch_id", auth()->user()->branch_id);
            }

            $customers = $customers->get();
            $totalFiltered = $this->user::count();
        } else {
            $search = $request->input('search.value');
            $customers = $this->user::where('code', 'like', "%{$search}%")
                ->where('Action', 'Active')
                ->with(['branch', 'user'])
                ->orderBy('id', 'desc')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir);
            if (auth()->user()->type == "Agent") {
                $customers = $customers->where("user_id", auth()->id())->orWhere("refarence_id", auth()->id());
            };

            if (auth()->user()->type == "Branch") {
                $customers = $customers->where("branch_id", auth()->user()->branch_id);
            };
            $customers = $customers->get();
            $totalFiltered = $this->user::where('code', 'like', "%{$search}%")->count();
        }

        $data = array();
        if ($customers) {
            foreach ($customers as $key => $customer) {
                $nestedData['id'] = $key + 1;
                $nestedData['code'] = $customer->code;
                $nestedData['commission'] = $customer->commission;
                $nestedData['type'] = $customer->visa_type;
                $nestedData['branch'] = $customer['branch']['name'] ?? '';
                $nestedData['country'] = $customer['countryName']['name'];
                $nestedData['email'] = $customer->email;
                $nestedData['phone'] = $customer['user']['phone'] ?? '';
   
                if ($customer->status == 'Active') :
                    $status = '<p class="status_row" style="color:green">' . $customer->status . '</p>';
                else :
                    $status = '<p class="status_row" style="color:red">' . $customer->status . '</p>';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0 || auth()->user()->type == "Agent" || auth()->user()->type == "Branch" || auth()->user()->type == "Admin") {
                    
                    if ($edit != 0 || auth()->user()->type == "Admin") {
                        $edit_data = '<a href="' . route('application-list.edit', $customer->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    } elseif ($edit != 0 || auth()->user()->type == "Agent") {
                        $edit_data = '<a href="' . route('application-list.agentedit', $customer->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    }
                    else
                    {
                        $edit_data = '';
                    }

                    $view_data = '';
                    if ($view != 0 || auth()->user()->type == "Agent" || auth()->user()->type == "Branch") {
                        $view_data = '<a href="' . route('application-list.show', $customer->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    }

                    $delete_data = '';
                    if ($delete != 0) {
                        $delete_data = '<a delete_route="' . route('application-list.destroy', $customer->id) . '" delete_id="' . $customer->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $customer->id . '"><i class="fa fa-times"></i></a>';
                    }

                    $nestedData['action'] = $edit_data . ' ' . $view_data . ' ' . $delete_data;
                } else {
                    $nestedData['action'] = '';
                }

                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        return $json_data;
    }


    public function getListUser($request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
        );

        $edit = Helper::roleAccess('application-list.edit') ? 1 : 0;
        $delete = Helper::roleAccess('application-list.destroy') ? 1 : 0;
        $view = Helper::roleAccess('application-list.show') ? 1 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->user::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        if (empty($request->input('search.value'))) {
            $customers = $this->user::offset($start)
                ->where('Action', 'Active')
                ->where('user_id', Auth::user()->id)
                ->with(['branch', 'user'])
                ->orderBy('id', 'desc')
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->user::count();
        } else {
            $search = $request->input('search.value');
            $customers = $this->user::where('code', 'like', "%{$search}%")
                ->where('Action', 'Active')
                ->where('user_id', Auth::user()->id)
                ->with(['branch', 'user'])
                ->orderBy('id', 'desc')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->user::where('code', 'like', "%{$search}%")->count();
        }

        $data = array();
        if ($customers) {
            // dd($customers);
            foreach ($customers as $key => $customer) {
                $nestedData['id'] = $key + 1;
                $nestedData['code'] = $customer->code;
                $nestedData['type'] = $customer->visa_type;
                $nestedData['branch'] = $customer['branch']['name'] ?? '';
                $nestedData['country'] = $customer->b_country;
                $nestedData['email'] = $customer->email;
                $nestedData['phone'] = $customer['user']['phone'] ?? '';
                if ($customer->status == 'Active') :
                    $status = '<p class="status_row" style="color:green">' . $customer->status . '</p>';
                else :
                    $status = '<p class="status_row" style="color:red">' . $customer->status . '</p>';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0 || auth()->user()->type == "Agent" || auth()->user()->type == "Branch" || auth()->user()->type == "Admin") {
                    
                    if ($edit != 0 || auth()->user()->type == "Admin") {
                        $edit_data = '<a href="' . route('application-list.edit', $customer->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    } elseif ($edit != 0 || auth()->user()->type == "Admin") {
                        // dd(Auth::user()->type);
                        $edit_data = '<a href="' . route('application-list.agentedit', $customer->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    }
                    else
                    {
                        $edit_data = '';
                    }

                    $view_data = '';
                    if ($view != 0 || auth()->user()->type == "Agent" || auth()->user()->type == "Branch") {
                        $view_data = '<a href="' . route('application-list.show', $customer->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    }

                    $delete_data = '';
                    if ($delete != 0) {
                        $delete_data = '<a delete_route="' . route('application-list.destroy', $customer->id) . '" delete_id="' . $customer->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $customer->id . '"><i class="fa fa-times"></i></a>';
                    }

                    $nestedData['action'] = $edit_data . ' ' . $view_data . ' ' . $delete_data;
                } else {
                    $nestedData['action'] = '';
                }

                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        return $json_data;
    }

    public function details($id)
    {
        $result = $this->user::find($id);
        return $result;
    }

    public function store($request)
    {
        $customer = new $this->user();
        $customer->branch_id = $request->branch_id;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->password = Hash::make($request->input('password'));
        $customer->type = 'Branch';
        $customer->status = 'Active';
        $customer->created_by = Auth::user()->id;
        $customer->save();
        return $customer;
    }

    public function update($request, $id)
    {
        $store = $this->user::find($id);
        $store->user_id = $request->user_id;
        $store->country_id = $request->appl_countryname;
        $store->branch_id = $request->appl_branchcode;
        $store->nationality = $request->appl_nationality;
        $store->email = $request->appl_email;
        $store->journeydate = $request->appl_journeydate;
        $store->visa_type = $request->appl_visa_service_id;
        $store->birthday = $request->appl_birthdate;
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
        $store->date_of_expiry = $request->other_passport;
        $store->another_passport_country = $request->second_passport_country;
        $store->another_passport_no = $request->second_passport_ic;
        $store->another_passport_issu_date = $request->second_passport_issu;
        $store->another_passport_issu_place = $request->second_passport_place_issue;
        $store->another_passport_nationality = $request->second_passport_nationality;
        $store->present_address_street = $request->house_no;
        $store->present_address_city = $request->village_name;
        $store->present_address_country = $request->appl_personal_country;
        $store->present_address_district = $request->appl_perosnal_distric;
        $store->present_address_zipcode = $request->appl_personal_post_code;
        $store->present_address_phone = $request->appl_personal_phone;
        $store->present_address_mobile = $request->appl_personal_mobile;
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
        return $store;
    }

    public function statusUpdate($request, $id)
    {
        $customer = $this->user::find($id);
        $customer->status = $request->status;
        $customer->commission = $request->commission ?? 0;
        $customer->save();
        return $customer;
    }

    public function destroy($id)
    {
        $customer = $this->user::find($id);
        $customer->delete();
        return true;
    }
}
