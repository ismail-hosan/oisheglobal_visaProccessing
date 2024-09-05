<?php

namespace App\Http\Controllers\Backend\Aboutus;

use App\Models\OurClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AboutUs\OurClientService;
use App\Transformers\GeneralTransformer;
use Illuminate\Validation\ValidationException;

class OurClientController extends Controller
{

    /**
     * @var ProductionService
     */
    private $systemService;

    /**
     * @var ProductionTransformer
     */
    private $systemTransformer;

    /**
     * ProductionController constructor.
     * @param ProductionService $systemService
     * @param ProductionService $systemTransformer
     */
    public function __construct(OurClientService $OurClientService, GeneralTransformer $transformer)
    {
        $this->systemService = $OurClientService;
        $this->systemTransformer = $transformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Client List";
        return view('backend_extra_path.pages.About_us.index', get_defined_vars());
    }


    public function dataProcessingOurclient(Request $request)
    {
        $json_data = $this->systemService->getList($request);
        return json_encode($this->systemTransformer->dataTable($json_data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Client List";
        return view('backend_extra_path.pages.About_us.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
        return redirect()->route('aboutUs.ourClient.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OurClient  $ourClient
     * @return \Illuminate\Http\Response
     */
    public function show(OurClient $ourClient)
    {
        //
    }

    public function statusUpdate($id, $status)
    {
        if (!is_numeric($id)) {
            return response()->json($this->systemTransformer->invalidId($id), 200);
        }
        $detailsInfo =   $this->systemService->details($id);
        if (!$detailsInfo) {
            return response()->json($this->systemTransformer->notFound($detailsInfo), 200);
        }
        $statusInfo =  $this->systemService->statusUpdate($id, $status);
        if ($statusInfo) {
            return response()->json($this->systemTransformer->statusUpdate($statusInfo), 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OurClient  $ourClient
     * @return \Illuminate\Http\Response
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

        $title = "Edit CLient";
        $ourClient = OurClient::find($id);
        return view('backend_extra_path.pages.About_us.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OurClient  $ourClient
     * @return \Illuminate\Http\Response
     */
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
        return redirect()->route('aboutUs.ourClient.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OurClient  $ourClient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!is_numeric($id)) {
            return response()->json($this->systemTransformer->invalidId($id), 200);
        }
        $detailsInfo = $this->systemService->details($id);
        if (!$detailsInfo) {
            return response()->json($this->systemTransformer->notFound($detailsInfo), 200);
        }
        $deleteInfo = $this->systemService->destroy($id);
        if ($deleteInfo) {
            return response()->json($this->systemTransformer->delete($deleteInfo), 200);
        }
    }
}
