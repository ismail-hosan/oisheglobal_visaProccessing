<?php

namespace App\Repositories\Faq;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\Faq;

use App\Models\Transection;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Illuminate\Support\Str;

class FaqTeamRepositories
{
    /**
     * @var user_id
     */
    private $user_id;
    /**
     * @var Brand
     */
    private $Faq;
    /**
     * CourseRepository constructor.
     * @param team $team
     */
    public function __construct(Faq $Faq)
    {
        $this->Faq = $Faq;
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
        $result = $this->Faq::latest()->get();
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
            1 => 'category_id',
            2 => 'serial',
        );

        $edit = Helper::roleAccess('faq.faq.edit') ? 1 : 0;
        $delete = Helper::roleAccess('faq.faq.destroy') ? 1 : 0;
        $view = Helper::roleAccess('faq.faq.show') ? 1 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->Faq::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $Faq = $this->Faq::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                //->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->Faq::count();
        } else {
            $search = $request->input('search.value');
            $Faq = $this->Faq::where('category_id', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->Faq::where('category_id', 'like', "%{$search}%")->count();
        }



        $data = array();
        if ($Faq) {
            foreach ($Faq as $key => $team) {
                $nestedData['id'] = $key + 1;
                $nestedData['category_id'] = $team->serviceCategory->title;
                $nestedData['menu_id'] = $team->menu_id;
                $nestedData['question'] = Str::words($team->question, 20, '...');
                $nestedData['answer'] = Str::words($team->answer, 20, '...');

                if ($team->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('faq.faq.status', [$team->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('faq.faq.status', [$team->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('faq.faq.edit', $team->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view = !0)
                        $view_data = '<a href="' . route('faq.faq.show', $team->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('faq.faq.destroy', $team->id) . '" delete_id="' . $team->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $team->id . '"><i class="fa fa-times"></i></a>';
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
        $result = $this->Faq::find($id);
        return $result;
    }

    public function store($request)
    {
        $Faq = new Faq();
        $Faq->menu_id = $request->menu_id;
        $Faq->category_id = $request->category_id;
        $Faq->designation_id = $request->designation_id;
        $Faq->serial = $request->serial;
        $Faq->question = $request->question;
        $Faq->answer = $request->answer;
        $Faq->save();
        return $Faq;
    }

    public function update($request, $id)
    {
        Faq::where('id', $id)->delete();
        $Faq = new Faq();
        $Faq->menu_id = $request->menu_id;
        $Faq->category_id = $request->category_id;
        $Faq->designation_id = $request->designation_id;
        $Faq->serial = $request->serial;
        $Faq->question = $request->question;
        $Faq->answer = $request->answer;
        $Faq->save();
        return $Faq;
    }

    public function statusUpdate($id, $status)
    {
        $team = $this->Faq::find($id);
        $team->status = $status;
        $team->save();
        return $team;
    }

    public function destroy($id)
    {
        $team = $this->Faq::find($id);
        $team->delete();
        return true;
    }
}
