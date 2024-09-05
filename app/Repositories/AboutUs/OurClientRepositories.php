<?php

namespace App\Repositories\AboutUs;

use App\Helpers\Helper;
use App\Models\OurClient;
use Illuminate\Support\Str;


class OurClientRepositories
{

    /**
     * @var OurClient
     */
    private $OurClient;

    /**
     * CourseRepository constructor.
     * @param OurClient $eOurClient
     */
    public function __construct(OurClient $OurClients)
    {
        $this->OurClient = $OurClients;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->OurClient::latest()->get();
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

        $totalData = $this->OurClient::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $OurClient = $this->OurClient::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->OurClient::count();
        } else {
            $search = $request->input('search.value');
            $OurClient = $this->OurClient::where('orderNo', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->OurClient::where('orderNo', 'like', "%{$search}%")->count();
        }

        $data = array();
        if ($OurClient) {
            foreach ($OurClient as $key => $eOurClient) {
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $eOurClient->name;
                $nestedData['logo'] = "<img src='" . asset('public/'.$eOurClient->logo) . "' width='70%' />"; 
                $nestedData['orderNo'] = $eOurClient->orderNo;
                if ($eOurClient->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('aboutUs.ourClient.status', [$eOurClient->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('aboutUs.ourClient.status', [$eOurClient->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;

                if ($ced != 0) :
                    if ($edit != 0) {
                        $edit_data = '<a href="' . route('aboutUs.ourClient.edit', $eOurClient->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    } else {
                        $edit_data = '';
                    }
                    if ($delete != 0) {
                        $delete_data = '<a delete_route="' . route('aboutUs.ourClient.destroy', $eOurClient->id) . '" delete_id="' . $eOurClient->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $eOurClient->id . '"><i class="fa fa-times"></i></a>';
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
        // dd($totalData);
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
        $result = $this->OurClient::find($id);
        return $result;
    }

    public function store($request)
    {
        $logoname = time() . '_' . $request->logo->getClientOriginalName();
        $logoname = time() . '_' . $request->image->getClientOriginalName();
        $request->logo->move(public_path() . '/storage/OurClient/', $logoname);
        $request->image->move(public_path() . '/storage/OurClient/image', $logoname);
        $OurClient = new OurClient();
        $OurClient->type = $request->type;
        $OurClient->name = $request->name;
        $OurClient->slug = Str::slug($request->name, '-');
        $OurClient->description = $request->description;
        $OurClient->logo = '/storage/OurClient/' . $logoname;
        $OurClient->image = '/storage/OurClient/image' . $logoname;
        $OurClient->orderNo = $request->orderby;
        $OurClient->alt = $request->alt;
        $OurClient->save();

        return true;
    }

    public function update($request, $id)
    {
        // dd($request->all());
        $OurClient = OurClient::find($id);
        if ($request->logo) {
            $logoname = time() . '_' . $request->logo->getClientOriginalName();
            $request->logo->move(public_path() . '/storage/OurClient/', $logoname);
            $path = public_path($OurClient->logo);
            if (file_exists($path)) {
                @unlink($path);
            }
            $OurClient->logo = '/storage/OurClient/' . $logoname;
        }
        if ($request->image) {
            $imagename = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path() . '/storage/OurClient/image/', $imagename);
            $path = public_path($OurClient->image);
            if (file_exists($path)) {
                @unlink($path);
            }
            $OurClient->image = '/storage/OurClient/image/' . $imagename;
        }

        
        $OurClient->type = $request->type;
        $OurClient->name = $request->name;
        $OurClient->slug = Str::slug($request->name, '-');
        $OurClient->description = $request->description;
        $OurClient->orderNo = $request->orderby;
        $OurClient->alt = $request->alt;
        $OurClient->save();

        return true;
    }

    public function statusUpdate($id, $status)
    {
        $eOurClient = $this->OurClient::find($id);
        $eOurClient->status = $status;
        $eOurClient->save();
        return $eOurClient;
    }

    public function destroy($id)
    {
        $result = $this->OurClient::find($id);
        $path = public_path($result->logo);
        if (file_exists($path)) {
            @unlink($path);
        }
        $result->delete();
        return true;
    }
}
