<?php

namespace App\Http\Controllers\Backend\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Services\Gallery\VideoService;
use App\Transformers\GeneralTransformer;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    private $systemTransformer;
    private $systemService;

    public function __construct(VideoService $VideoService, GeneralTransformer $transformer)
    {
        $this->systemService = $VideoService;
        $this->systemTransformer = $transformer;
    }


    public function index()
    {
        $title = "Video List";
        return view('backend_extra_path.pages.gallery.videos.index', get_defined_vars());
    }


    public function dataProcessingVideos(Request $request)
    {
        $json_data = $this->systemService->getList($request);
        return json_encode($this->systemTransformer->dataTable($json_data));
    }


    public function create()
    {
        $title = "Video List";
        return view('backend_extra_path.pages.gallery.videos.create', get_defined_vars());
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
        return redirect()->route('videos.index');
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
        $editInfo =   $this->systemService->details($id);

        if (!$editInfo) {
            session()->flash('error', 'Edit info is invalid!!');
            return redirect()->back();
        }

        $title = "Edit CLient";
        $video = Video::find($id);
        return view('backend_extra_path.pages.gallery.videos.create', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
        return redirect()->route('videos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteInfo =  $this->systemService->destroy($id);
        if ($deleteInfo) {
            session()->flash('success', "Delete Successfully");
            return redirect()->route('videos.index');
        }
    }
}
