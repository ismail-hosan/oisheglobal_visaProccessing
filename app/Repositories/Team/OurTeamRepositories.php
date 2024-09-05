<?php

namespace App\Repositories\Team;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\OurTeam;

use App\Models\Transection;
use phpDocumentor\Reflection\PseudoTypes\False_;

class OurTeamRepositories
{
    /**
     * @var user_id
     */
    /**
     * @var Brand
     */
    private $OurTeam;
    /**
     * CourseRepository constructor.
     * @param team $team
     */
    public function __construct(OurTeam $OurTeam)
    {
        $this->OurTeam = $OurTeam;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->OurTeam::latest()->get();
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

        $totalData = $this->OurTeam::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $OurTeam = $this->OurTeam::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->OurTeam::count();
        } else {
            $search = $request->input('search.value');
            $OurTeam = $this->OurTeam::where('account_id', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->OurTeam::where('account_id', 'like', "%{$search}%")->count();
        }



        $data = array();
        if ($OurTeam) {
            foreach ($OurTeam as $key => $team) {
                $nestedData['id'] = $key + 1;
                $nestedData['serial'] = $team->serial;
                $nestedData['department_id'] = $team->department_id;
                $nestedData['designation_id'] = $team->designation_id;
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
        $result = $this->OurTeam::find($id);
        return $result;
    }

   public function store($request)
    {
        $OurTeam = new OurTeam();
        $OurTeam->name = $request->name;
        $OurTeam->alt = $request->alt;
        $OurTeam->serial = $request->serial;
        $OurTeam->department_id = $request->department_id;
        $OurTeam->designation_id = $request->designation_id;
        $OurTeam->s_degination = $request->s_degination;

        $image = $request->image->getClientOriginalName();
        $request->image->move(public_path() . '/backend/team/', $image);
        $OurTeam->image =  $image;
        $OurTeam->save();
        return $OurTeam;
    }

   public function update($request, $id)
    {

        $OurTeam = OurTeam::findOrFail($id);
        $OurTeam->name = $request->name;
        $OurTeam->alt = $request->alt;
        $OurTeam->serial = $request->serial;
        $OurTeam->department_id = $request->department_id;
        $OurTeam->designation_id = $request->designation_id;
        $OurTeam->s_degination = $request->s_degination;

        if ($request->hasFile('image')) {
            $image = $request->image->getClientOriginalName();
            $request->image->move(public_path() . '/backend/team/', $image);
            $OurTeam->image =  $image;
        } else {
            $OurTeam->image =  $request->newimage;
        }

        $OurTeam->save();
        return $OurTeam;
    }

    public function statusUpdate($id, $status)
    {
        $team = $this->OurTeam::find($id);
        $team->status = $status;
        $team->save();
        return $team;
    }

    public function destroy($id)
    {
        $team = $this->OurTeam::find($id);
        $team->delete();
        return true;
    }
}
