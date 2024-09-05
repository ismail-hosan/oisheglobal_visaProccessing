<?php

namespace App\Http\Controllers\Backend\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\project\PimageService;
use App\Transformers\GeneralTransformer;
use Dotenv\Exception\ValidationException;
use App\Models\Projectimage;
use App\Models\project;
use App\Models\Service;

class PimageController extends Controller
{
    private $PimageService;

    private $systemTransformer;

    public function __construct(PimageService $pimageService, GeneralTransformer $transformer)
    {
        $this->PimageService = $pimageService;
        $this->systemTransformer = $transformer;
    }
    public function index()
    {
        $title = 'Project List';
        return view('backend_extra_path.pages.project.project-image.index', get_defined_vars());
    }


    public function dataProcessingProjectImage(Request $request)
    {
        // dd('ok');
        $json_data = $this->PimageService->getList($request);
        return json_encode($this->systemTransformer->dataTable($json_data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add New Import/Export";
        $projects = Project::where('status', 'Active')->get();
        $services = Service::where('status', 'Active')->get();
        return view('backend_extra_path.pages.project.project-image.create', get_defined_vars());
    }


    public function store(Request $request)
    {
        
        
        try {  
            $this->validate($request, $this->PimageService->storeValidation($request));
        } catch (ValidationException $e) {
            session()->flash('error', 'Validation error !!');
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        $this->PimageService->store($request);
        session()->flash('success', 'Data successfully save!!');
        return redirect()->route('project.image.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!is_numeric($id)) {
            session()->flash('error', 'Edit id must be numeric!!');
            return redirect()->back();
        }
        $editInfo =  $this->PimageService->details($id);

        if (!$editInfo) {
            session()->flash('error', 'Edit info is invalid!!');
            return redirect()->back();
        }

        $title = "Edit Project Image";
        $projectimg = Projectimage::find($id);
        $projects = Project::where('status', 'Active')->get();
        $sevices = Service::where('status', 'Active')->get();
        return view('backend_extra_path.pages.project.project-image.edit', get_defined_vars());
    }

    
    public function update(Request $request, $id)
    {
        
        if (!is_numeric($id)) {
            session()->flash('error', 'Edit id must be numeric!!');
            return redirect()->back();
        }
        $editInfo = $this->PimageService->details($id);
        if (!$editInfo) {
            session()->flash('error', 'Edit info is invalid!!');
            return redirect()->back();
        }
        try {
            $this->validate($request, $this->PimageService->updateValidation($request, $id));
        } catch (ValidationException $e) {
            session()->flash('error', 'Validation error !!');
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
        $this->PimageService->update($request, $id);
        session()->flash('success', 'Data successfully updated!!');
        return redirect()->route('project.image.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!is_numeric($id)) {
            return response()->json($this->systemTransformer->invalidId($id), 200);
        }
        $detailsInfo = $this->PimageService->details($id);
        if (!$detailsInfo) {
            return response()->json($this->systemTransformer->notFound($detailsInfo), 200);
        }
        $deleteInfo = $this->PimageService->destroy($id);
        if ($deleteInfo) {
            return response()->json($this->systemTransformer->delete($deleteInfo), 200);
        }
    }
}
