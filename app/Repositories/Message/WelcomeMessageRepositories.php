<?php

namespace App\Repositories\Message;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\WelcomeMessage;

use phpDocumentor\Reflection\PseudoTypes\False_;

class WelcomeMessageRepositories
{
    /**
     * @var user_id
     */
    private $user_id;
    /**
     * @var Brand
     */
    private $WelcomeMessage;
    /**
     * CourseRepository constructor.
     * @param team $team
     */
    public function __construct(WelcomeMessage $WelcomeMessage)
    {
        $this->WelcomeMessage = $WelcomeMessage;
        $this->user_id = 1;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->WelcomeMessage::latest()->get();
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
            1 => 'type_id',
            2 => 'name',
            3 => 'message',
        );

        $edit = Helper::roleAccess('message.message.edit') ? 1 : 0;
        $delete = Helper::roleAccess('message.message.destroy') ? 1 : 0;
        $view = Helper::roleAccess('message.message.show') ? 1 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->WelcomeMessage::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $WelcomeMessage = $this->WelcomeMessage::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                //->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->WelcomeMessage::count();
        } else {
            $search = $request->input('search.value');
            $WelcomeMessage = $this->WelcomeMessage::where('account_id', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->WelcomeMessage::where('account_id', 'like', "%{$search}%")->count();
        }



        $data = array();
        if ($WelcomeMessage) {
            foreach ($WelcomeMessage as $key => $team) {
                $nestedData['id'] = $key + 1;
                $nestedData['type_id'] = $team->type_id;
                $nestedData['name'] = $team->name;
                $nestedData['message'] = $team->message;
                $nestedData['image'] = '<img width="50px" class="img-product" src="/backend/message/' . $team->image . '">';

                if ($team->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('message.message.status', [$team->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('message.message.status', [$team->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('message.message.edit', $team->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view = !0)
                        $view_data = '<a href="' . route('message.message.show', $team->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('message.message.destroy', $team->id) . '" delete_id="' . $team->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $team->id . '"><i class="fa fa-times"></i></a>';
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
        $result = $this->WelcomeMessage::find($id);
        return $result;
    }

    public function store($request)
    {

        $WelcomeMessage = new WelcomeMessage();
        $WelcomeMessage->name = $request->name;
        $WelcomeMessage->type_id = $request->type_id;
        $WelcomeMessage->message = $request->message;


        $image = $request->image->getClientOriginalName();
        $request->image->move(public_path() . '/backend/message/', $image);
        $WelcomeMessage->image =  $image;
        $WelcomeMessage->save();
        return $WelcomeMessage;
    }

    public function update($request, $id)
    {

        WelcomeMessage::where('id', $id)->delete();
        $WelcomeMessage = new WelcomeMessage();
        $WelcomeMessage->name = $request->name;
        $WelcomeMessage->type_id = $request->type_id;
        $WelcomeMessage->message = $request->message;

        if ($request->hasFile('image')) {
            $image = $request->image->getClientOriginalName();
            $request->image->move(public_path() . '/backend/message/', $image);
            $WelcomeMessage->image =  $image;
        } else {
            $WelcomeMessage->image =  $request->newimage;
        }

        $WelcomeMessage->save();
        return $WelcomeMessage;
    }

    public function statusUpdate($id, $status)
    {
        $team = $this->WelcomeMessage::find($id);
        $team->status = $status;
        $team->save();
        return $team;
    }

    public function destroy($id)
    {
        $team = $this->WelcomeMessage::find($id);
        $team->delete();
        return true;
    }
}
