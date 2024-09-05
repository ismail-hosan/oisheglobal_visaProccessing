<?php

namespace App\Repositories\AboutUs;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\AboutUs;
use Illuminate\Support\Str;

class AboutusRepositories
{
    /**
     * @var AboutUs
     */
    private $aboutus;
    /**
     * CourseRepository constructor.
     * @param aboutus $aboutus
     */
    public function __construct(AboutUs $aboutus)
    {
        $this->aboutus = $aboutus;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->aboutus::latest()->get();
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

        $edit = Helper::roleAccess('aboutus.edit') ? 1 : 0;
        $delete = Helper::roleAccess('aboutus.destroy') ? 1 : 0;
        $view = Helper::roleAccess('aboutus.show') ? 0 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->aboutus::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $aboutuss = $this->aboutus::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                //->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->aboutus::count();
        } else {
            $search = $request->input('search.value');
            $aboutuss = $this->aboutus::where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->aboutus::where('title', 'like', "%{$search}%")->count();
        }


        // dd(get_defined_vars());
        $data = array();
        if ($aboutuss) {
            foreach ($aboutuss as $key => $aboutus) {
                $nestedData['id'] = $key + 1;
                $nestedData['image'] = '<img width="50px" class="img-product" src="'.asset('/public/backend/aboutus/'.$aboutus->image).'">';
                $nestedData['title'] = $aboutus->title;
                $nestedData['description'] = Str::words($aboutus->description, 20, '...');
                $nestedData['mission'] = Str::words($aboutus->mission, 20, '...');
                $nestedData['vision'] = Str::words($aboutus->vision, 20, '...');
                if ($aboutus->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('aboutus.status', [$aboutus->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('aboutus.status', [$aboutus->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('aboutus.edit', $aboutus->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view != 0)
                        $view_data = '<a href="' . route('aboutus.show', $aboutus->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    // if ($delete != 0)
                    //     $delete_data = '<a delete_route="' . route('aboutus.destroy', $aboutus->id) . '" delete_id="' . $aboutus->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $aboutus->id . '"><i class="fa fa-times"></i></a>';
                    // else
                    // $delete_data = '';
                    $nestedData['action'] = $edit_data . ' ' . $view_data;
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
        // dd($json_data);
        return $json_data;
    }
    /**
     * @param $request
     * @return mixed
     */
    public function details($id)
    {
        $result = $this->aboutus::find($id);
        return $result;
    }

    public function store($request)
    {
        $aboutus = new $this->aboutus();
        $aboutus->save();
        return $aboutus;
    }

    public function update($request, $id)
    {
        $aboutus = $this->aboutus::findOrFail($id);
        $aboutus->meta = $request->meta;
        $aboutus->title = $request->title;
        $aboutus->tagline = $request->tagline;
        $aboutus->description = $request->description;
        $aboutus->m_title = $request->m_title;
        $aboutus->mission = $request->mission;
        $aboutus->v_title = $request->v_title;
        $aboutus->vision = $request->vision;
        $aboutus->video = $request->video;
        $aboutus->alt = $request->alt;


        if ($request->hasFile('image')) {
            $image = $request->image->getClientOriginalName();
            $request->image->move(public_path() . '/backend/aboutus/', $image);
            $aboutus->image =  $image;
        }
        if ($request->hasFile('m_image')) {
            $image = $request->image->getClientOriginalName();
            $request->m_image->move(public_path() . '/backend/aboutus/', $image);
            $aboutus->m_image =  $image;
        }
        if ($request->hasFile('v_image')) {
            $image = $request->image->getClientOriginalName();
            $request->v_image->move(public_path() . '/backend/aboutus/', $image);
            $aboutus->v_image =  $image;
        }

        $aboutus->updated_by = Auth::user()->id;
        $aboutus->save();
        return $aboutus;
    }

    public function statusUpdate($id, $status)
    {
        $aboutus = $this->aboutus::find($id);
        $aboutus->status = $status;
        $aboutus->save();
        return $aboutus;
    }

    public function destroy($id)
    {
        $aboutus = $this->aboutus::find($id);
        $aboutus->delete();
        return true;
    }
}
