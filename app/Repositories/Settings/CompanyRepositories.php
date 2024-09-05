<?php

namespace App\Repositories\Settings;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Validator;

class CompanyRepositories
{
    /**
     * @var Company
     */
    private $company;
    /**
     * CourseRepository constructor.
     * @param companySetup $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }
    /**
     * @param $request
     * @return mixed
     */
    public function getList($request)
    {
        $columns = array(
            0 => 'id',
            1 => 'company_name',
            2 => 'website',
            3 => 'phone',
            4 => 'email',
            5 => 'address',
        );

        $edit = Helper::roleAccess('settings.company.edit') ? 1 : 0;
        $delete = Helper::roleAccess('settings.company.destroy') ? 1 : 0;
        $view = Helper::roleAccess('settings.company.show') ? 0 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->company::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $companys = $this->company::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                //->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->company::count();
        } else {
            $search = $request->input('search.value');
            $companys = $this->company::where('company_name', 'like', "%{$search}%")->orWhere('website', 'like', "%{$search}%")->orWhere('phone', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->company::where('company_name', 'like', "%{$search}%")->count();
        }



        $data = array();
        if ($companys) {
            foreach ($companys as $key => $company) {
                $nestedData['id'] = $key + 1;
                $nestedData['company_name'] = $company->company_name;
                $nestedData['logo'] = '<img width="50px" class="img-product" src="/backend/logo/' . $company->logo . '">';
                $nestedData['favicon'] = '<img width="50px" class="img-product" src="/backend/favicon/' . $company->favicon . '">';
                $nestedData['invoice_logo'] = '<img width="50px" class="img-product" src="/backend/invoicelogo/' . $company->invoice_logo . '">';
                $nestedData['website'] = $company->website;
                $nestedData['phone'] = $company->phone;
                $nestedData['email'] = $company->email;
                $nestedData['address'] = $company->address;
                $nestedData['task_identification_number'] = $company->task_identification_number;
                if ($company->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('settings.company.status', [$company->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('settings.company.status', [$company->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;

                if ($ced = !0) :
                    if ($edit = !0)
                        $edit_data = '<a href="' . route('settings.company.edit', $company->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view != 0)
                        $view_data = '<a href="' . route('settings.company.show', $company->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('settings.company.destroy', $company->id) . '" delete_id="' . $company->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $company->id . '"><i class="fa fa-times"></i></a>';
                    else
                        $delete_data = '';

                    $nestedData['action'] = $edit_data . ' ' . $delete_data . ' ' . $view_data;
                else :
                    $nestedData['action'] = '';
                endif;
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
    /**
     * @param $request
     * @return mixed
     */
    public function details($id)
    {
        $result = $this->company::find($id);
        return $result;
    }

    public function store($request)
    {

        if ($request->hasfile('logo')) {

            $logoname = $request->logo->getClientOriginalName();
            $invoice_logo = $request->invoice_logo->getClientOriginalName();
            $favicon = $request->favicon->getClientOriginalName();
            $request->logo->move(public_path() . '/backend/logo/', $logoname);
            $request->invoice_logo->move(public_path() . '/backend/invoicelogo/', $invoice_logo);
            $request->favicon->move(public_path() . '/backend/favicon/', $favicon);

            $company = new $this->company();
            $company->meta = $request->meta;
            $company->team_meta = $request->team_meta;
            $company->testimunials_meta = $request->testimunials_meta;
            $company->client_meta = $request->client_meta;
            $company->company_name = $request->company_name;
            $company->logo = $logoname;
            $company->invoice_logo = $invoice_logo;
            $company->favicon = $favicon;
            $company->website = $request->website;
            $company->phone = $request->phone;
            $company->email = $request->email;
            $company->address  = $request->address;
            $company->task_identification_number = $request->task_identification_number;

            $company->terms_and_conditions = $request->terms_and_conditions;
            $company->privacy_policy = $request->privacy_policy;
            $company->linkedin = $request->linkedin;
            $company->facebook = $request->facebook;
            $company->instagram = $request->instagram;
            $company->twitter = $request->twitter;

            $company->status = 'Active';
            $company->created_by = Auth::user()->id;
            $company->save();
            return $company;
        }
    }

    public function update($request, $id)
    {
        // dd($request->all());

        $company = $this->company::findOrFail($id);
        if ($request->logo) {
            $logoname = $request->logo->getClientOriginalName();
            $request->logo->move(public_path() . '/backend/logo/', $logoname);
            $company->logo = $logoname;
        }
        if ($request->invoice_logo) {
            $invoice_logo = $request->invoice_logo->getClientOriginalName();
            $request->invoice_logo->move(public_path() . '/backend/invoicelogo/', $invoice_logo);
            $company->invoice_logo = $invoice_logo;
        }
        if ($request->favicon) {
            $favicon = $request->favicon->getClientOriginalName();
            $request->favicon->move(public_path() . '/backend/favicon/', $favicon);
            $company->favicon = $favicon;
        }

        $company->company_name = $request->company_name;
        $company->meta = $request->meta;
        $company->team_meta = $request->team_meta;
        $company->testimunials_meta = $request->testimunials_meta;
        $company->client_meta = $request->client_meta;
        $company->blog_meta = $request->blog_meta;
        $company->career_meta = $request->career_meta;
        $company->contact_meta = $request->contact_meta;

        $company->alt = $request->alt;
        $company->website = $request->website;
        $company->phone = $request->phone;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->branch_address_1 = $request->branch_address_1;
        $company->branch_address_2 = $request->branch_address_2;
        $company->task_identification_number = $request->task_identification_number;

        $company->terms_and_conditions = $request->terms_and_conditions;
        $company->privacy_policy = $request->privacy_policy;
        $company->linkedin = $request->linkedin;
        $company->facebook = $request->facebook;
        $company->instagram = $request->instagram;
        $company->twitter = $request->twitter;

        //sales support hr info
        $company->sale_phone = $request->sale_phone;
        $company->sale_email = $request->sale_email;
        $company->hr_phone = $request->hr_phone;
        $company->hr_email = $request->hr_email;
        $company->support_phone = $request->support_phone;
        $company->support_email = $request->support_email;

        //sales support hr info
        $company->running_project = $request->running_project;
        $company->project_done = $request->project_done;
        $company->total_clients = $request->total_clients;
        $company->success_rate = $request->success_rate;





        $company->status = 'Active';
        $company->created_by = Auth::user()->id;
        $company->save();
        return $company;
    }

    public function statusUpdate($id, $status)
    {
        $company = $this->company::find($id);
        $company->status = $status;
        $company->save();
        return $company;
    }

    public function destroy($id)
    {
        $company = $this->company::find($id);
        $company->delete();
        return true;
    }
}
