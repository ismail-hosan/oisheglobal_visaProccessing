<?php

namespace App\Repositories\Team;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\Designation;

use App\Models\Transection;
use phpDocumentor\Reflection\PseudoTypes\False_;

class DesignationRepositories
{
    /**
     * @var user_id
     */
    /**
     * @var Brand
     */
     
    private $designation;
    /**
     * CourseRepository constructor.
     * @param team $team
     */
    public function __construct(Designation $designation)
    {
        $this->Designation = $designation;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->Designation::latest()->get();
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
            1 => 'department_id',
            2 => 'designation_id',
            3 => 'name',
        );

        $edit = Helper::roleAccess('team.team.edit') ? 1 : 0;
        $delete = Helper::roleAccess('team.team.destroy') ? 1 : 0;
        $view = Helper::roleAccess('team.team.show') ? 1 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->Designation::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $designation = $this->Designation::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->Designation::count();
        } else {
            $search = $request->input('search.value');
            $designation = $this->Designation::where('account_id', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->Designation::where('account_id', 'like', "%{$search}%")->count();
        }



        $data = array();
        if ($designation) {
            foreach ($designation as $key => $team) {
                $nestedData['id'] = $key + 1;
                $nestedData['serial'] = $team->serial;
                $nestedData['name'] = $team->name;
                $nestedData['image'] = '<img width="50px" class="img-product" src="/backend/team/' . $team->image . '">';

                if ($team->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('team.team.status', [$team->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('team.team.status', [$team->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('team.team.edit', $team->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view = !0)
                        $view_data = '<a href="' . route('team.team.show', $team->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('team.team.destroy', $team->id) . '" delete_id="' . $team->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $team->id . '"><i class="fa fa-times"></i></a>';
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
        $result = $this->Designation::find($id);
        return $result;
    }

    public function store($request)
    {
        Designation::create(['name'=>$request->name]);
        return true;
    }

    public function update($request, $id)
    {

        $designation = Designation::find($id);
        $designation->name = $request->name;
        $designation->save();
        return $designation;
    }

    public function destroy($id)
    {
        $team = $this->Designation::find($id);
        $team->delete();
        return true;
    }
}
