<?php

namespace App\Repositories\Why;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\WhyChoose;
use Illuminate\Support\Str;
use App\Models\Transection;
use phpDocumentor\Reflection\PseudoTypes\False_;

class WhyChooseRepositories
{
    /**
     * @var user_id
     */
    private $user_id;
    /**
     * @var Brand
     */
    private $WhyChoose;
    /**
     * CourseRepository constructor.
     * @param team $team
     */
    public function __construct(WhyChoose $WhyChoose)
    {
        $this->WhyChoose = $WhyChoose;
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
        $result = $this->WhyChoose::latest()->get();
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
            1 => 'tile',
            2 => 'details',
            3 => 'serial',
        );

        $edit = Helper::roleAccess('why.why.edit') ? 1 : 0;
        $delete = Helper::roleAccess('why.why.destroy') ? 1 : 0;
        $view = Helper::roleAccess('why.why.show') ? 1 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->WhyChoose::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $WhyChoose = $this->WhyChoose::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                //->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->WhyChoose::count();
        } else {
            $search = $request->input('search.value');
            $WhyChoose = $this->WhyChoose::where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->WhyChoose::where('title', 'like', "%{$search}%")->count();
        }



        $data = array();
        if ($WhyChoose) {
            foreach ($WhyChoose as $key => $team) {
                $nestedData['id'] = $key + 1;
                $nestedData['title'] = $team->title;
                $nestedData['details'] =  Str::words($team->details, 20, '...');;
                $nestedData['serial'] = $team->serial;


                if ($team->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('why.why.status', [$team->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('why.why.status', [$team->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('why.why.edit', $team->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view = !0)
                        $view_data = '<a href="' . route('why.why.show', $team->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('why.why.destroy', $team->id) . '" delete_id="' . $team->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $team->id . '"><i class="fa fa-times"></i></a>';
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
        $result = $this->WhyChoose::find($id);
        return $result;
    }

    public function store($request)
    {
        $WhyChoose = new WhyChoose();
        $WhyChoose->title = $request->title;
        $WhyChoose->fa_icon = $request->fa_icon;
        $WhyChoose->serial = $request->serial;
        $WhyChoose->details = $request->details;
        $WhyChoose->save();
        return $WhyChoose;
    }

    public function update($request, $id)
    {

        WhyChoose::where('id', $id)->delete();
        $WhyChoose = new WhyChoose();
        $WhyChoose->title = $request->title;
        $WhyChoose->fa_icon = $request->fa_icon;
        $WhyChoose->serial = $request->serial;
        $WhyChoose->details = $request->details;
        $WhyChoose->save();
        return $WhyChoose;
    }

    public function statusUpdate($id, $status)
    {
        $team = $this->WhyChoose::find($id);
        $team->status = $status;
        $team->save();
        return $team;
    }

    public function destroy($id)
    {
        $team = $this->WhyChoose::find($id);
        $team->delete();
        return true;
    }
}
