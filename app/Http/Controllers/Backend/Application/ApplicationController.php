<?php

namespace App\Http\Controllers\Backend\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\VisaApplication;
use App\Transformers\GeneralTransformer;
use App\Models\Navigation;
use App\Models\Customer;
use App\Models\Project;
use App\Models\VisaDataModel;
use App\Models\VisaProcesing;
use App\Services\Application\ApplicationService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{

    private $systemService;

    private $systemTransformer;


    public function __construct(ApplicationService $applicationService, GeneralTransformer $transformer)
    {
        $this->systemService = $applicationService;

        $this->systemTransformer = $transformer;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function agent(Request $request)
    {
        $title = 'Application List';
        return view('backend_extra_path.pages.application.index', get_defined_vars());
    }

    public function index(Request $request)
    {
        $title = 'Application List';
        return view('backend_extra_path.pages.application.index', get_defined_vars());
    }


    public function index_user()
    {
        $title = 'Application List';
        return view('customer.index', get_defined_vars());
    }

    public function dataProcessingApplication(Request $request)
    {
        $json_data = $this->systemService->getList($request);
        return json_encode($this->systemTransformer->dataTable($json_data));
    }


    public function dataProcessingUser(Request $request)
    {
        $json_data = $this->systemService->getListUser($request);
        return json_encode($this->systemTransformer->dataTable($json_data));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = 'Add New Application';
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
        $editInfo =   $this->systemService->details($id);
        if (!$editInfo) {
            session()->flash('error', 'Edit info is invalid!!');
            return redirect()->back();
        }
        $countryNames = VisaProcesing::all();
        $branchNames = Project::all();

        $title = 'Add New Customer';
        return view('backend_extra_path.pages.application.edit', get_defined_vars());
    }


    public function agentedit($id)
    {
        // dd($id);
        if (!is_numeric($id)) {
            session()->flash('error', 'Edit id must be numeric!!');
            return redirect()->back();
        }
        $editInfo = $this->systemService->details($id);
        if (!$editInfo) {
            session()->flash('error', 'Edit info is invalid!!');
            return redirect()->back();
        }
        $countryNames = VisaProcesing::all();
        $branchNames = Project::all();

        $title = 'Edit Application';
        return view('customer.edit', get_defined_vars());
    }

    public function show($id)
    {
        $data = VisaDataModel::with('countryName')->findOrfail($id);
        // dd($data);
        return view('backend_extra_path.pages.application.view', get_defined_vars());
    }


    public function agentupdate(Request $request,$id)
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
        try {
            $this->validate($request, $this->systemService->updateValidation($request, $id));
        } catch (ValidationException $e) {
            session()->flash('error', 'Validation error !!');
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        $this->systemService->update($request, $id);
        session()->flash('success', 'Data successfully updated!!');
        return redirect()->back();
    }



    public function update(Request $request, $id)
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
        try {
            $this->validate($request, $this->systemService->updateValidation($request, $id));
        } catch (ValidationException $e) {
            session()->flash('error', 'Validation error !!');
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        $this->systemService->update($request, $id);
        session()->flash('success', 'Data successfully updated!!');
        return redirect()->back();
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function statusUpdate(Request $request,$id)
    {
        if (!is_numeric($id)) {
            return response()->json($this->systemTransformer->invalidId($id), 200);
        }
        $detailsInfo =   $this->systemService->details($id);
        if (!$detailsInfo) {
            return response()->json($this->systemTransformer->notFound($detailsInfo), 200);
        }
        $statusInfo =  $this->systemService->statusUpdate($request,$id);

        $details = [
            'name' => $statusInfo->surname,
            'email' => $statusInfo->Email,
            'Passport_no' => $statusInfo->passport_number,
            'address' => $statusInfo->present_address_district,
            'status' => $statusInfo->status, 
        ];

        Mail::to($request->email)->send(new VisaApplication($details));

        if ($statusInfo) {
            session()->flash('success', 'Status Update Succefully!!');
            return redirect()->back();
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
        $detailsInfo =  $this->systemService->details($id);
        if (!$detailsInfo) {
            return response()->json($this->systemTransformer->notFound($detailsInfo), 200);
        }
        $deleteInfo =  $this->systemService->destroy($id);
        if ($deleteInfo) {
            return response()->json($this->systemTransformer->delete($deleteInfo), 200);
        }
    }
}
