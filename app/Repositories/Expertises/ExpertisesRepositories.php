<?php

namespace App\Repositories\Expertises;

use App\Helpers\Helper;
use App\Models\Expertise;

class ExpertisesRepositories
{
    /**
     * @var user_id
     */
    private $user_id;
    /**
     * @var Brand
     */
    private $Expertise;
    /**
     * CourseRepository constructor.
     * @param team $team
     */
    public function __construct(Expertise $Expertise)
    {
        $this->Expertise = $Expertise;
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
        $result = $this->Expertise::latest()->get();
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
            1 => 'image',

        );

        $edit = Helper::roleAccess('expertises.expertises.edit') ? 1 : 0;
        $delete = Helper::roleAccess('expertises.expertises.destroy') ? 1 : 0;
        $view = Helper::roleAccess('expertises.expertises.show') ? 1 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->Expertise::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $Expertise = $this->Expertise::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                //->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->Expertise::count();
        } else {
            $search = $request->input('search.value');
            $Expertise = $this->Expertise::where('image', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->Expertise::where('image', 'like', "%{$search}%")->count();
        }



        $data = array();
        if ($Expertise) {
            foreach ($Expertise as $key => $team) {
                $nestedData['id'] = $key + 1;

                $nestedData['image'] = '<img width="50px" class="img-product" src="/backend/Expertise/' . $team->image . '">';

                if ($team->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('expertises.expertises.status', [$team->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('expertises.expertises.status', [$team->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('expertises.expertises.edit', $team->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view = !0)
                        $view_data = '<a href="' . route('expertises.expertises.show', $team->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('expertises.expertises.destroy', $team->id) . '" delete_id="' . $team->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $team->id . '"><i class="fa fa-times"></i></a>';
                    else
                        $delete_data = '';
                    $nestedData['action'] = $edit_data . '  ' . $delete_data;
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
        $result = $this->Expertise::find($id);
        return $result;
    }

    public function store($request)
    {
        $Expertise = new Expertise();
        $Expertise->alt =  $request->alt;
        $image = $request->image->getClientOriginalName();
        $request->image->move(public_path() . '/backend/Expertise/', $image);
        $Expertise->image =  $image;
        $Expertise->save();
        return $Expertise;
    }

    public function update($request, $id)
    {
        Expertise::where('id', $id)->delete();
        $Expertise = new Expertise();
        $Expertise->alt =  $request->alt;

        if ($request->hasFile('image')) {
            $image = $request->image->getClientOriginalName();
            $request->image->move(public_path() . '/backend/Expertise/', $image);
            $Expertise->image =  $image;
        } else {
            $Expertise->image =  $request->newimage;
        }

        $Expertise->save();
        return $Expertise;
    }

    public function statusUpdate($id, $status)
    {
        $team = $this->Expertise::find($id);
        $team->status = $status;
        $team->save();
        return $team;
    }

    public function destroy($id)
    {
        $team = $this->Expertise::find($id);
        $team->delete();
        return true;
    }
}
