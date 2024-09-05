<?php

namespace App\Repositories\Visa;

use App\Helpers\Helper;
use App\Models\VisaProcesing;
use App\Models\Stock;
use App\Models\StockSummary;
use App\Models\VisaSlider;
use App\Models\VisaVisited;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VisaProcessingRepositories
{

    /**
     * @var user_id
     */
    private $user_id;

    /**
     * @var Production
     */
    private $visaProcesing;

    /**
     * CourseRepository constructor.
     * @param Production $eProduction
     */
    public function __construct(VisaProcesing $visaProcesing)
    {
        $this->visaProcesing = $visaProcesing;
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
        $result = $this->visaProcesing::latest()->get();
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
            1 => 'VisaCode',
        );

        $edit = Helper::roleAccess('visaproccesing.edit') ? 1 : 0;
        $delete = Helper::roleAccess('visaproccesing.destroy') ? 1 : 0;
        $ced = $edit + $delete;

        $totalData = $this->visaProcesing::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $Visas = $this->visaProcesing::offset($start)
                ->with('user')
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->visaProcesing::count();
        } else {
            $search = $request->input('search.value');
            $Visas = $this->visaProcesing::where('VisaCode', 'like', "%{$search}%")
                ->with('user')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->visaProcesing::where('VisaCode', 'like', "%{$search}%")->count();
        }

        $data = array();
        if ($Visas) {
            foreach ($Visas as $key => $Visa) {
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $Visa->name;
                $nestedData['continent'] = $Visa->continent;
                $nestedData['image'] = "<img src='" . asset('public/' . $Visa->image) . "' width='70%' />";
                $nestedData['created_by'] = $Visa->user['name'];

                if ($Visa->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('visaproccesing.status', [$Visa->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('visaproccesing.status', [$Visa->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;

                if ($ced != 0) :
                    if ($edit != 0) {
                        $edit_data = '<a href="' . route('visaproccesing.edit', $Visa->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    } else {
                        $edit_data = '';
                    }
                    if ($delete != 0) {
                        $delete_data = '<a delete_route="' . route('visaproccesing.destroy', $Visa->id) . '" delete_id="' . $Visa->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $Visa->id . '"><i class="fa fa-times"></i></a>';
                    } else {
                        $delete_data = '';
                    }
                    $nestedData['action'] = $edit_data . '' . '' . $delete_data;
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
            "data" => $data,
        );

        return $json_data;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function details($id)
    {
        $result = $this->visaProcesing::find($id);
        return $result;
    }

    public function store($request)
    {
        // dd($request->all());
        $visaprocessing = new VisaProcesing();
        $visaprocessing->name = $request->name;
        $visaprocessing->slug = Str::slug($request->name);
        $visaprocessing->continent = $request->continent;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/visas/'), $imageName);
            $visaprocessing->image = 'backend/visas/' . $imageName;
        }

        $visaprocessing->ditails = $request->description;
        $visaprocessing->meta = $request->to_product_id;
        $visaprocessing->created_by = Auth::user()->id;
        $visaprocessing->save();
        if ($request->hasFile('slider_image')) {
            foreach ($request->file('slider_image') as $slider) {
                $imageName = time() . '_' . $slider->getClientOriginalName();
                $slider->move(public_path('backend/visas/slider/'), $imageName);
                VisaSlider::create([
                    'visa_id' => $visaprocessing->id,
                    'image' => 'backend/visas/slider/' . $imageName,
                ]);
            }
        }


        if ($request->hasFile('visited_image')) {
            foreach ($request->file('visited_image') as $visted) {
                $imageName = time() . '_' . $visted->getClientOriginalName();
                $visted->move(public_path('backend/visas/visited/'), $imageName);
                VisaVisited::create([
                    'visa_id' => $visaprocessing->id,
                    'image' => 'backend/visas/visited/' . $imageName,
                ]);
            }
        }
        return $visaprocessing;
    }

    public function update($request, $id)
    {
        // dd($request->all());

        $visaprocessing = VisaProcesing::find($id);
        $visaprocessing->name = $request->name;
        $visaprocessing->slug = Str::slug($request->name);
        $visaprocessing->continent = $request->continent;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('backend/visas/'), $imageName);
            $visaprocessing->image = 'backend/visas/' . $imageName;
        }

        $visaprocessing->ditails = $request->description;
        $visaprocessing->meta = $request->to_product_id;
        $visaprocessing->created_by = Auth::user()->id;
        $visaprocessing->save();
        VisaSlider::whereNotIn('id', $request->slider_id ?? [])->delete();

        if ($request->hasFile('slider_image')) {
            foreach ($request->file('slider_image') as $key => $slider) {
                $imageName = time() . '_' . $slider->getClientOriginalName();
                $slider->move(public_path('backend/visas/slider/'), $imageName);

                if (isset($request->slider_id[$key])) {
                    $existingSlider = VisaSlider::find($request->slider_id[$key]);

                    if ($existingSlider && file_exists(public_path($existingSlider->image))) {
                        unlink(public_path($existingSlider->image));
                    }
                    VisaSlider::where('id', $request->slider_id[$key])->update([
                        'image' => 'backend/visas/slider/' . $imageName,
                    ]);
                } else {
                    VisaSlider::create([
                        'visa_id' => $visaprocessing->id,
                        'image' => 'backend/visas/slider/' . $imageName,
                    ]);
                }
            }
        }

        VisaVisited::whereNotIn('id', $request->visited_id ?? [])->delete();

        if ($request->hasFile('visited_image')) {
            foreach ($request->file('visited_image') as $key => $visited) {
                $imageName = time() . '_' . $visited->getClientOriginalName();
                $visited->move(public_path('backend/visas/visas/'), $imageName);

                if (isset($request->visited_id[$key])) {
                    $existingVisited = VisaVisited::find($request->visited_id[$key]);
                    
                    if ($existingVisited && file_exists(public_path($existingVisited->image))) {
                        unlink(public_path($existingVisited->image));
                    }

                    VisaVisited::where('id', $request->visited_id[$key])->update([
                        'image' => 'backend/visas/visas/' . $imageName,
                    ]);
                } else {
                    VisaVisited::create([
                        'visa_id' => $visaprocessing->id,
                        'image' => 'backend/visas/visas/' . $imageName,
                    ]);
                }
            }
        }

        return $visaprocessing;
    }

    public function statusUpdate($id, $status)
    {
        $eProduction = $this->visaProcesing::find($id);
        $eProduction->status = $status;
        $eProduction->save();
        return $eProduction;
    }

    public function destroy($id)
    {
        $eProduction = $this->visaProcesing::find($id);
        $eProduction->delete();

        $visaSliders = VisaSlider::where('visa_id', $id)->get();
        foreach ($visaSliders as $visaSlider) {
            $visaSlider->delete();
            $path = public_path($visaSlider->image);
            if (file_exists($path)) {
                @unlink($path);
            }
        }
        return true;
    }
}
