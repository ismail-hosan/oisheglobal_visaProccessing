<?php

namespace App\Http\Controllers\Backend\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AgentRegisterData;
use App\Transformers\GeneralTransformer;
use App\Models\Branch;
use App\Models\Navigation;
use App\Models\Customer;
use App\Models\Project;
use App\Models\User;
use App\Services\Agent\AgentService;
use App\Services\Settings\BranchService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;





class AgentController extends Controller
{

   
    private $systemService;
  
    private $systemTransformer;

 
    public function __construct(AgentService $agentService, GeneralTransformer $transformer)
    {
        $this->systemService = $agentService;

        $this->systemTransformer = $transformer;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = 'Agent List';
        return view('backend_extra_path.pages.agent.index', get_defined_vars());
    }


    public function dataProcessingAgent(Request $request)
    {
        $json_data = $this->systemService->getList($request);
        return json_encode($this->systemTransformer->dataTable($json_data));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Add New Agent';
        $customertLastData = Customer::latest('id')->first();
        if ($customertLastData) :
            $customerData = $customertLastData->id + 1;
        else :
            $customerData = 1;
        endif;
        $customerCode = 'CU' . str_pad($customerData, 5, "0", STR_PAD_LEFT);

        // $branch = Branch::get()->where('status', 'Active');
        return view('backend_extra_path.pages.customer.create', get_defined_vars());
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, $this->systemService->storeValidation($request));
        } catch (ValidationException $e) {
            session()->flash('error', 'Validation error !!');
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        $this->systemService->store($request);
        session()->flash('success', 'Data successfully save!!');
        return redirect()->route('inventorySetup.customer.index');
    }
    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (!is_numeric($id)) {
            session()->flash('error', 'Edit id must be numeric!!');
            return redirect()->back();
        }
        $editInfo = $this->systemService->details($id);
        if (!$editInfo) {
            session()->flash('error', 'Edit info is invalid!!');
            return redirect()->back();
        }

        $branchs = Project::all();
        $title = 'Add New Customer';
        return view('backend_extra_path.pages.agent.edit', get_defined_vars());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        if (!is_numeric($id)) {
            session()->flash('error', 'Edit id must be numeric!!');
            return redirect()->back();
        }
        $editInfo = $this->systemService->details($id);
        if (!$editInfo) {
            session()->flash('error', 'Edit info is invalid!!');
            return redirect()->back();
        }
        try {
            $this->validate($request, $this->systemService->updateValidation($request, $id));
        } catch (ValidationException $e) {
            session()->flash('error', 'Validation error !!');
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        $this->systemService->update($request, $id);
        session()->flash('success', 'Data successfully updated!!');
        return redirect()->route('agent.index');
    }

    public function show($id)
    {
        
        $data = User::with('agentData')->findOrFail($id);
        $title= 'Agent Data';
        return view('backend_extra_path.pages.agent.view', get_defined_vars());
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function statusUpdate($id, $status)
    {
        // dd($status);
        if (!is_numeric($id)) {
            return response()->json($this->systemTransformer->invalidId($id), 200);
        }
        $detailsInfo =   $this->systemService->details($id);
        if (!$detailsInfo) {
            return response()->json($this->systemTransformer->notFound($detailsInfo), 200);
        }
        $statusInfo =  $this->systemService->statusUpdate($id, $status);
        // dd($statusInfo);
        if ($statusInfo) {
            return response()->json($this->systemTransformer->statusUpdate($statusInfo), 200);
        }
    }


    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy($id)
    {
        if (!is_numeric($id)) {
            return response()->json($this->systemTransformer->invalidId($id), 200);
        }
        $detailsInfo =   $this->systemService->details($id);
        if (!$detailsInfo) {
            return response()->json($this->systemTransformer->notFound($detailsInfo), 200);
        }
        $deleteInfo =  $this->systemService->destroy($id);
        if ($deleteInfo) {
            return response()->json($this->systemTransformer->delete($deleteInfo), 200);
        }
    }
}
