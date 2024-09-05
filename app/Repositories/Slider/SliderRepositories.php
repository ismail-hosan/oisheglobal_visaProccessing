<?php

namespace App\Repositories\Slider;

use App\Helpers\Helper;
use App\Models\Gallary;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SliderRepositories
{
    /**
     * @var product
     */
    private $Slider;
    /**
     * CourseRepository constructor.
     * @param product $product
     */
    public function __construct(Slider $Slider)
    {
        $this->Slider = $Slider;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->Slider::latest()->get();
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
             1 => 'orderNo',
         );
 
         $edit = Helper::roleAccess('aboutUs.ourClient.edit') ? 1 : 0;
         $delete = Helper::roleAccess('aboutUs.ourClient.destroy') ? 1 : 0;
         // $view = Helper::roleAccess('aboutUs.ourClient.show') ? 0 : 0;
         $ced = $edit + $delete;
 
         $totalData = $this->Slider::count();
 
         $limit = $request->input('length');
         $start = $request->input('start');
         $order = $columns[$request->input('order.0.column')];
         $dir = $request->input('order.0.dir');
 
         if (empty($request->input('search.value'))) {
             $OurClient = $this->Slider::offset($start)
                 ->limit($limit)
                 ->orderBy($order, $dir)
                 ->get();
             $totalFiltered = $this->Slider::count();
         } else {
             $search = $request->input('search.value');
             $OurClient = $this->Slider::where('orderNo', 'like', "%{$search}%")
                 ->offset($start)
                 ->limit($limit)
                 ->orderBy($order, $dir)
                 ->get();
             $totalFiltered = $this->Slider::where('orderNo', 'like', "%{$search}%")->count();
         }
 
         $data = array();
         if ($OurClient) {
             foreach ($OurClient as $key => $eOurClient) {
                 $nestedData['id'] = $key + 1;
                 $nestedData['logo'] = "<img src='" . asset('public/'.$eOurClient->img) . "' width='70%' />";
                 $nestedData['title'] = $eOurClient->title;
                 $nestedData['orderNo'] = $eOurClient->orderNo;
 
                 if ($eOurClient->status == 'Active') :
                     $status = '<input class="status_row" status_route="' . route('slider.status', [$eOurClient->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                 else :
                     $status = '<input  class="status_row" status_route="' . route('slider.status', [$eOurClient->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                 endif;
                 $nestedData['status'] = $status;
 
                 if ($ced != 0) :
                     if ($edit != 0) {
                         $edit_data = '<a href="' . route('slider.edit', $eOurClient->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                     } else {
                         $edit_data = '';
                     }
                     if ($delete != 0) {
                         $delete_data = '<a delete_route="' . route('slider.destroy', $eOurClient->id) . '" delete_id="' . $eOurClient->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $eOurClient->id . '"><i class="fa fa-times"></i></a>';
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

        $result = $this->Slider::findOrFail($id)->get();
        return $result;
    }

    public function store($request)
    {
        
        try {
            DB::beginTransaction();
            $slider = new $this->Slider();
            $slider->type = $request->type;
            $slider->title = $request->title;
            if ($request->hasFile('image')) {
                $logoname = time() . '_' . $request->image->getClientOriginalName();
                $request->image->move(public_path() . '/storage/slider/', $logoname);
                $slider->img = '/storage/slider/' . $logoname;
            }
            $slider->alt = $request->alt;
            $slider->order_by = $request->orderby;
            $slider->save();

            DB::commit();
            return $slider;
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error message: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());
        }
    }

    public function update($request, $id)
    {
        // dd($request->all());
        try {
                     
            $slider = Slider::find($id);
            if ($request->image) {
                $logoname = time() . '_' . $request->image->getClientOriginalName();
                $request->image->move(public_path() . '/storage/slider/', $logoname);
                $path = public_path($slider->img);
                if (file_exists($path)) {
                    @unlink($path);
                }
            }
             
            if ($request->image) {
                $slider->img = '/storage/slider/' . $logoname;
            }
            $slider->type = $request->type;
            $slider->title = $request->title;
            $slider->alt = $request->alt;
            $slider->order_by = $request->orderby;
            $slider->save();
            DB::commit();
            return $slider;
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error message: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());
        }
    }

    public function statusUpdate($id, $status)
    {
        $product = $this->Slider::find($id);
        $product->status = $status;
        $product->save();
        return $product;
    }

    public function destroy($id)
    {
        $product = $this->Slider::find($id);
        $path = public_path($product->image);
        if (file_exists($path)) {
            @unlink($path);
        }
        $product->delete();
        return true;
    }
}
