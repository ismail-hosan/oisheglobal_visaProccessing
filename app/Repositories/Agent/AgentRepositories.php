<?php

namespace App\Repositories\Agent;

use App\Helpers\Helper;
use App\Mail\AgentRegistration;
use App\Models\AgentRegisterData;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\PseudoTypes\False_;

class AgentRepositories
{
    
    private $user_id;
    
    private $customer;

    public function __construct(User $user)
    {
        $this->customer = $user;
        //$this->middleware(function ($request, $next) {
        $this->user_id = 1; //auth()->user()->id;
        //  return $next($request);
        //});
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->customer::latest()->get();
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

        $edit = Helper::roleAccess('inventorySetup.customer.edit') ? 1 : 0;
        $delete = Helper::roleAccess('inventorySetup.customer.destroy') ? 1 : 0;
        $view = Helper::roleAccess('inventorySetup.customer.show') ? 1 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->customer::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $customers = $this->customer::offset($start)
                ->where('type', 'Agent')
                ->with("branch")
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->customer::count();
        } else {
            $search = $request->input('search.value');
            $customers = $this->customer::where('code', 'like', "%{$search}%")
                ->where('type', 'Agent')
                ->with("branch")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->customer::where('code', 'like', "%{$search}%")->where('type', 'Agent')->count();
        }

        $data = array();
        if ($customers) {
            foreach ($customers as $key => $customer) {
                $nestedData['id'] = $key + 1;
                $nestedData['code'] = $customer->code;
                $nestedData['name'] = $customer->name;
                $nestedData['branch'] = $customer['branch']['name'] ?? '';
                $nestedData['customerCode'] = $customer->type;
                $nestedData['email'] = $customer->email;
                $nestedData['phone'] = $customer->phone;
                $nestedData['address'] = $customer->address;
                if ($customer->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('agent.status', [$customer->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('agent.status', [$customer->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('agent.edit', $customer->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view != 0)
                        $view_data = '<a href="' . route('agent.show', $customer->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('agent.destroy', $customer->id) . '" delete_id="' . $customer->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $customer->id . '"><i class="fa fa-times"></i></a>';
                    else
                        $delete_data = '';
                    $nestedData['action'] = $edit_data . ' ' . $view_data . ' ' . $delete_data;
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
        $result = $this->customer::with('agentData')->find($id);
        return $result;
    }

    public function store($request)
    {
        $customer = new $this->customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->customerCode = $request->customerCode;
        // $customer->branch_id = $request->branch_id;
        $customer->status = 'Active';
        $customer->created_by = Auth::user()->id;
        $customer->save();
        return $customer;
    }

    public function update($request, $id)
    {
        $customer = $this->customer::findOrFail($id);
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->branch_id = $request->input('branch_id');
        $customer->phone = $request->input('mobile');
        $customer->address = $request->input('address');
        if ($request->input('password')) {
            $customer->password = Hash::make($request->input('password'));
        }
        $customer->code = $request->input('agent_code');
        $customer->status = 'Active';
        $customer->updated_by = Auth::user()->id;
        $customer->save();
    
        $agent = AgentRegisterData::where('agent_id', $customer->id)->first();
    
        if (!$agent) {
            // Create a new agent record if none exists
            $agent = new AgentRegisterData();
            $agent->agent_id = $customer->id;
        }
    
        $agent->mobile = $request->input('phone');
        $agent->nid_no = $request->input('nid');
        $agent->father_name = $request->input('father_name');
        $agent->mother_name = $request->input('mother_name');
        $agent->rl_no = $request->input('rl_no');
        $agent->passport_no = $request->input('passport_no');
        $agent->permanent_address = $request->input('permanent_address');
        $agent->company_name = $request->input('company_name');
        $agent->tin_number = $request->input('tin_number');
        $agent->company_address = $request->input('company_address');
        $agent->trade_license_no = $request->input('trade_license_no');
        $agent->bin_number = $request->input('bin_number');
        $agent->bussiness_year = $request->input('business_year');
    
        // Handle image uploads...
        $this->handleImageUpload($request, 'personal_image', 'backend/agent/personal/', $agent);
        $this->handleImageUpload($request, 'rl_image', 'backend/agent/rld_image/', $agent);
        $this->handleImageUpload($request, 'tin_image', 'backend/agent/tin/', $agent);
        $this->handleImageUpload($request, 'trade_image', 'backend/agent/trade/', $agent);
        $this->handleImageUpload($request, 'nid_front', 'backend/agent/nid-front/', $agent);
        $this->handleImageUpload($request, 'nid_back', 'backend/agent/nid-back/', $agent);
        $this->handleImageUpload($request, 'passport_image', 'backend/agent/passport/', $agent);
        $this->handleImageUpload($request, 'bin_image', 'backend/agent/bin/', $agent);
    
        $agent->save();
    
        return $customer;
    }
    
    private function handleImageUpload($request, $fieldName, $path, $agent)
    {
        if ($request->hasFile($fieldName)) {
            if ($agent->$fieldName && file_exists(public_path($agent->$fieldName))) {
                unlink(public_path($agent->$fieldName));
            }
    
            $image = $request->file($fieldName);
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path($path), $imageName);
            $agent->$fieldName = $path . $imageName;
        }
    }
    
    public function statusUpdate($id, $status)
    {
        $customer = $this->customer::find($id);
        $customer->status = $status;
        $customer->save();

        $details = ([
            'name' => $customer->name,
            'phone'=> $customer->phone,
            'email'=> $customer->email,
        ]);
      
        Mail::to($customer->email)->send(new AgentRegistration($details));
        return $customer;
    }

    public function destroy($id)
    {
        $customer = $this->customer::find($id);
        if ($customer) {
            $customer->delete();
        }

        $agentData = AgentRegisterData::where('agent_id', $id)->first();

        if ($agentData) {
            // Unlink personal_image if it exists
            if (!empty($agentData->personal_image)) {
                $personal_image = public_path($agentData->personal_image);
                if (file_exists($personal_image)) {
                    @unlink($personal_image);
                }
            }

            // Unlink rld_image if it exists
            if (!empty($agentData->rld_image)) {
                $rld_image = public_path($agentData->rld_image);
                if (file_exists($rld_image)) {
                    @unlink($rld_image);
                }
            }

            // Unlink tin_image if it exists
            if (!empty($agentData->tin_image)) {
                $tin_image = public_path($agentData->tin_image);
                if (file_exists($tin_image)) {
                    @unlink($tin_image);
                }
            }

            // Unlink trade_image if it exists
            if (!empty($agentData->trade_image)) {
                $trade_image = public_path($agentData->trade_image);
                if (file_exists($trade_image)) {
                    @unlink($trade_image);
                }
            }

            // Unlink nid_front if it exists
            if (!empty($agentData->nid_front)) {
                $nid_front = public_path($agentData->nid_front);
                if (file_exists($nid_front)) {
                    @unlink($nid_front);
                }
            }

            // Unlink nid_back if it exists
            if (!empty($agentData->nid_back)) {
                $nid_back = public_path($agentData->nid_back);
                if (file_exists($nid_back)) {
                    @unlink($nid_back);
                }
            }

            // Unlink passport_image if it exists
            if (!empty($agentData->passport_image)) {
                $passport_image = public_path($agentData->passport_image);
                if (file_exists($passport_image)) {
                    @unlink($passport_image);
                }
            }

            // Finally, delete the agent data record
            $agentData->delete();
        }

        return true;
    }
}
