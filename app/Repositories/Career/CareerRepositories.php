<?php

namespace App\Repositories\Career;

use App\Helpers\Helper;
use App\Models\Career;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CareerRepositories
{
    /**
     * @var Career
     */
    private $career;
    /**
     * CourseRepository constructor.
     * @param career $career
     */
    public function __construct(Career $career)
    {
        $this->career = $career;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->career::latest()->get();
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
            1 => 'title',
        );

        $edit = Helper::roleAccess('career.edit') ? 1 : 0;
        $delete = Helper::roleAccess('career.destroy') ? 1 : 0;
        $view = Helper::roleAccess('career.show') ? 0 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->career::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $careers = $this->career::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->career::count();
        } else {
            $search = $request->input('search.value');
            $careers = $this->career::where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->career::where('title', 'like', "%{$search}%")->count();
        }


        $data = array();
        if ($careers) {
            foreach ($careers as $key => $career) {
                $nestedData['id'] = $key + 1;
                $nestedData['title'] = $career->title ?? "N/A";
                $nestedData['vacancy'] = $career->vacancy ?? "N/A";
                $nestedData['published_at'] = Carbon::parse($career->published_at)->format('d-m-Y');
                $nestedData['application_deadline'] = Carbon::parse($career->application_deadline)->format('d-m-Y');
                $nestedData['short_description'] = Str::words($career->short_description, 20, '...');
                if ($career->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('career.status', [$career->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('career.status', [$career->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('career.edit', $career->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view != 0)
                        $view_data = '<a href="' . route('career.show', $career->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('career.destroy', $career->id) . '" delete_id="' . $career->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $career->id . '"><i class="fa fa-times"></i></a>';
                    else
                        $delete_data = '';
                    $nestedData['action'] = $edit_data . ' ' . $view_data . ' ' . $delete_data;
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
        $result = $this->career::find($id);
        return $result;
    }

    public function store($request)
    {
        $career = new $this->career($request->all());
        $career->save();
        return $career;
    }

    public function update($request, $id)
    {
        $career = $this->career::findOrFail($id);
        // dd($request->all(), $id, $career);
        $career->title = $request->title;
        $career->meta = $request->meta;
        $career->alt = $request->alt;
        $career->vacancy = $request->vacancy;
        $career->email = $request->email;
        $career->short_description = $request->short_description;
        $career->description = $request->description;
        $career->published_at = $request->published_at;
        $career->employment_status = $request->employment_status;
        $career->experience = $request->experience;
        $career->gender = $request->gender;
        $career->job_location = $request->job_location;
        $career->salary = $request->salary;
        $career->application_deadline = $request->application_deadline;
        $career->updated_by = auth()->id();
        $career->save();
        return $career;
    }

    public function statusUpdate($id, $status)
    {
        $career = $this->career::find($id);
        $career->status = $status;
        $career->save();
        return $career;
    }

    public function destroy($id)
    {
        $career = $this->career::find($id);
        $career->delete();
        return true;
    }
}
