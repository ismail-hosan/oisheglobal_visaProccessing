<?php

namespace App\Repositories\newproject;

use App\Helpers\Helper;
use App\Models\Gallary;
use App\Models\Projectimage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PimageRepositories
{
    /**
     * @var product
     */
    private $projectimage;
    /**
     * CourseRepository constructor.
     * @param product $product
     */
    public function __construct(Projectimage $projectimage)
    {
        $this->projectimage = $projectimage;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->projectimage::latest()->get();
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

        $totalData = $this->projectimage::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $OurClient = $this->projectimage::offset($start)
                ->with('project')
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->projectimage::count();
        } else {
            $search = $request->input('search.value');
            $OurClient = $this->projectimage::where('orderNo', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->projectimage::where('orderNo', 'like', "%{$search}%")->count();
        }

        $data = array();
        
        if ($OurClient) {
            foreach ($OurClient as $key => $eOurClient) {
                $nestedData['id'] = $key + 1;
                $nestedData['type'] = $eOurClient->type;
                $nestedData['title'] = $eOurClient->title;
                $nestedData['desc'] = $eOurClient->short_desc;
                $nestedData['image'] =  "<img src='" . asset('public/' . $eOurClient->image) . "' width='70%' />";
                $nestedData['orderby'] = $eOurClient->order_by;

                if ($eOurClient->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('slider.status', [$eOurClient->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('slider.status', [$eOurClient->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;

                if ($ced != 0) :
                    if ($edit != 0) {
                        $edit_data = '<a href="' . route('project.image.edit', $eOurClient->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    } else {
                        $edit_data = '';
                    }
                    if ($delete != 0) {
                        $delete_data = '<a delete_route="' . route('project.image.destroy', $eOurClient->id) . '" delete_id="' . $eOurClient->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $eOurClient->id . '"><i class="fa fa-times"></i></a>';
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

        $result = $this->projectimage::findOrFail($id)->get();
        return $result;
    }

    public function store($request)
    {
        // dd($request->all());

        try {
            DB::beginTransaction();
            $projectimg = new $this->projectimage();
            $projectimg->type = $request->type;
            $projectimg->title = $request->title;
            $projectimg->slug = Str::slug($request->title);
            $projectimg->order_by = $request->orderby;
            $projectimg->short_desc = $request->short_description;
            $projectimg->desc = $request->description;
            if ($request->hasFile('image')) {
                $logoname = time() . '_' . $request->image->getClientOriginalName();
                $request->image->move(public_path() . '/storage/project/', $logoname);
                $projectimg->image = '/storage/project/' . $logoname;
            }
            $projectimg->created_by = Auth::user()->name;
            $projectimg->save();

            DB::commit();

            return $projectimg;
        } catch (\Exception $e) {

            DB::rollback();
            return back()->with('error', 'Error message: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());
        }
    }

    public function update($request, $id)
    {
        // dd($request->all());
        try {

            $projectimg = Projectimage::find($id);
            $projectimg->type = $request->type;
            $projectimg->title = $request->title;
            $projectimg->slug = Str::slug($request->title);
            $projectimg->order_by = $request->orderby;
            $projectimg->short_desc = $request->short_description;
            $projectimg->desc = $request->description;
            if ($request->hasFile('image')) {
                $logoname = time() . '_' . $request->image->getClientOriginalName();
                $request->image->move(public_path() . '/storage/project/', $logoname);
                $projectimg->image = '/storage/project/' . $logoname;
            }
            $projectimg->created_by = Auth::user()->name;
            $projectimg->save();
            DB::commit();
            return $projectimg;
        } catch (\Exception $e) {
            DB::rollback();
            // dd('error');
            return back()->with('error', 'Error message: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());
        }
    }

    public function statusUpdate($id, $status)
    {
        $product = $this->projectimage::find($id);
        $product->status = $status;
        $product->save();
        return $product;
    }

    public function destroy($id)
    {
        $projectimg = $this->projectimage::find($id);
        $projectimg->delete();
        $path = public_path($projectimg->image);
        if (file_exists($path)) {
            @unlink($path);
        }
        return true;
    }
}
