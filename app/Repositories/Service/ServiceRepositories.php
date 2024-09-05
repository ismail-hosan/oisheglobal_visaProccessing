<?php

namespace App\Repositories\Service;

use App\Helpers\Helper;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceRepositories
{

    /**
     * @var Service
     */
    private $Service;

    /**
     * CourseRepository constructor.
     * @param Service $eService
     */
    public function __construct(Service $Service)
    {
        $this->Service = $Service;
        $this->user_id = 1;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->Service::latest()->get();
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
            // 1 => 'category_id',
        );




        $edit = Helper::roleAccess('service.service.edit')  ? 1 : 0;
        $delete = Helper::roleAccess('service.service.destroy')  ? 1 : 0;
        $view = Helper::roleAccess('service.service.show') ? 1 : 0;
        $ced = $edit + $delete + $view;


        $totalData = $this->Service::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $Service = $this->Service::offset($start);
            $Service = $Service->limit($limit);
            $Service = $Service->orderBy($order, $dir);
            $Service = $Service->get();
            $totalFiltered = $this->Service::count();
        } else {
            $search = $request->input('search.value');
            $Service = $this->Service::where('title', 'like', "%{$search}%");
            $Service = $this->Service::offset($start);
            $Service = $Service->limit($limit);
            $Service = $Service->get();
            $totalFiltered = $this->Service::where('title', 'like', "%{$search}%")->count();
        }


        $data = array();
        if ($Service) {
            foreach ($Service as $key => $eService) {
                $nestedData['id'] = $key + 1;
                $nestedData['title'] = $eService->title;
                $nestedData['details'] = Str::words($eService->details, 20, '...');
                $nestedData['image'] = '<img width="50px" class="img-product" src="/backend/service/' . $eService->image . '">';

                $nestedData['order'] = $eService->order_by ?? 'N/A';
                $nestedData['show_in_nav'] = $eService->show_in_nav ? "Yes" : 'No';
                if ($eService->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('service.service.status', [$eService->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('service.service.status', [$eService->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0) {
                        $edit_data = '<a href="' . route('service.service.edit', $eService->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    } else {
                        $edit_data = '';
                    }

                    if ($view = !0) {
                        $view_data = '<a href="' . route('service.service.show', $eService->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    } else {
                        $view_data = '';
                    }

                    if ($delete != 0) {
                        $delete_data = '<a delete_route="' . route('service.service.destroy', $eService->id) . '" delete_id="' . $eService->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $eService->id . '"><i class="fa fa-times"></i></a>';
                    } else {
                        $delete_data = '';
                    }

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
        $result = $this->Service::find($id);
        return $result;
    }

    public function store($request)
    {
        $Service = new Service();
        $Service->details = $request->details;
        $Service->order_by = $request->order_by;
        $Service->title = $request->title;
        $Service->meta = $request->meta;
        $Service->alt = $request->alt;
        $Service->show_in_nav = $request->show_in_nav == 1 ? 1 : 0;
        if ($request->hasFile('image')) {
            $image = $request->image->getClientOriginalName();
            $request->image->move(public_path() . '/backend/service/', $image);
            $Service->image =  $image;
        }
        $Service->save();
        return $Service;
    }

    public function update($request, $id)
    {

        $Service = Service::findOrFail($id);
        $Service->details = $request->details;
        $Service->order_by = $request->order_by;
        $Service->title = $request->title;
        $Service->meta = $request->meta;
        $Service->alt = $request->alt;
        // dd($request->all(), $request->show_in_nav == 1);
        $Service->show_in_nav = $request->show_in_nav == 1 ? 1 : 0;
        if ($request->hasFile('image')) {
            $image = $request->image->getClientOriginalName();
            $request->image->move(public_path() . '/backend/service/', $image);
            $Service->image =  $image;
        } else {
            $Service->image =  $request->newimage;
        }

        $Service->save();
        return $Service;
    }

    public function statusUpdate($id, $status)
    {
        $eService = $this->Service::find($id);
        $eService->status = $status;
        $eService->save();
        return $eService;
    }

    public function destroy($id)
    {
        $eService = $this->Service::find($id);
        $eService->delete();
        return true;
    }
}
