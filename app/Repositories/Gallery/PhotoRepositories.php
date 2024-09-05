<?php

namespace App\Repositories\Gallery;

use App\Helpers\Helper;
use App\Models\Photos;


class PhotoRepositories
{

    /**
     * @var OurClient
     */
    private $Photos;

    /**
     * CourseRepository constructor.
     * @param OurClient $photo
     */
    public function __construct(Photos $Photos)
    {
        $this->Photos = $Photos;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->Photos::latest()->get();
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

        $edit = Helper::roleAccess('photos.edit') ? 1 : 0;
        $delete = Helper::roleAccess('photos.destroy') ? 1 : 0;
        // $view = Helper::roleAccess('photos.show') ? 0 : 0;
        $ced = $edit + $delete;

        $totalData = $this->Photos::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $OurClient = $this->Photos::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->Photos::count();
        } else {
            $search = $request->input('search.value');
            $OurClient = $this->Photos::where('orderNo', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->Photos::where('orderNo', 'like', "%{$search}%")->count();
        }

        $data = array();
        if ($OurClient) {
            foreach ($OurClient as $key => $photo) {
                $nestedData['id'] = $key + 1;
                $nestedData['image'] = "<img src='" . asset('public/images/'.$photo->image) . "' width='30%' />";
                $nestedData['title'] = $photo->title;
                $nestedData['orderNo'] = $photo->orderNo;

                // if ($photo->status == 'Active') :
                //     $status = '<input class="status_row" status_route="' . route('photos.status', [$photo->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                // else :
                //     $status = '<input  class="status_row" status_route="' . route('photos.status', [$photo->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                // endif;
                // $nestedData['status'] = $status;

                if ($ced != 0) :
                    if ($edit != 0) {
                        $edit_data = '<a href="' . route('photos.edit', $photo->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    } else {
                        $edit_data = '';
                    }

                    if ($delete != 0) {
                        $delete_data = '<a href="' . route('photos.destroy', $photo->id) . '" onclick="return confirm(`Are You Sure You Want To Delete??`)" title="Delete" class="btn btn-xs btn-default "><i class="fa fa-times"></i></a>';
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
        $result = $this->Photos::find($id);
        return $result;
    }

    public function store($request)
    {
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        Photos::create([
            'image' => $imageName,
            'title' => $request->title,
            'meta' => $request->meta,
            'orderNo' => $request->orderNo,
        ]);

        return true;
    }

    public function update($request, $id)
    {
        $photos = Photos::find($id);
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $photos->image = $imageName;
        }

        $photos->update([
            'title' => $request->title,
            'meta' => $request->meta,
            'orderNo' => $request->orderNo,
        ]);

        return true;
    }

    public function statusUpdate($id, $status)
    {
        $photo = $this->Photos::find($id);
        $photo->status = $status;
        $photo->save();
        return $photo;
    }

    public function destroy($id)
    {
        $result = $this->Photos::find($id);
        $path = public_path($result->image);
        if (file_exists($path)) {
            @unlink($path);
        }
        $result->delete();
        return true;
    }
}
