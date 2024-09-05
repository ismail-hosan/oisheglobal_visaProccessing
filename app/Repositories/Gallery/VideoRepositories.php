<?php

namespace App\Repositories\Gallery;

use App\Helpers\Helper;
use App\Models\Photos;
use App\Models\Video;

class VideoRepositories
{

    /**
     * @var OurClient
     */
    private $video;

    /**
     * CourseRepository constructor.
     * @param OurClient $photo
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->video::latest()->get();
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

        $edit = Helper::roleAccess('videos.edit') ? 1 : 0;
        $delete = Helper::roleAccess('videos.destroy') ? 1 : 0;
        // $view = Helper::roleAccess('videos.show') ? 0 : 0;
        $ced = $edit + $delete;

        $totalData = $this->video::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $videos = $this->video::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->video::count();
        } else {
            $search = $request->input('search.value');
            $videos = $this->video::where('orderNo', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->video::where('orderNo', 'like', "%{$search}%")->count();
        }

        $data = array();

        if ($videos) {
            foreach ($videos as $key => $video) {
                $nestedData['id'] = $key + 1;
                $nestedData['title'] = $video->title;
                if(preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video->link, $matches)){
                  $videoLink = '<iframe width="200" height="150" src="https://www.youtube.com/embed/'. $matches[1] .'" frameborder="0" allowfullscreen></iframe>';
                }
                
                $nestedData['link'] = $videoLink ?? $video->link;
                $nestedData['meta'] = $video->orderNo;
                $nestedData['orderNo'] = $video->orderNo;

                // if ($video->status == 'Active') :
                //     $status = '<input class="status_row" status_route="' . route('videos.status', [$video->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                // else :
                //     $status = '<input  class="status_row" status_route="' . route('videos.status', [$video->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                // endif;
                // $nestedData['status'] = $status;

                if ($ced != 0) :
                    if ($edit != 0) {
                        $edit_data = '<a href="' . route('videos.edit', $video->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    } else {
                        $edit_data = '';
                    }

                    if ($delete != 0) {
                        $delete_data = '<a href="' . route('videos.destroy', $video->id) . '" onclick="return confirm(`Are You Sure You Want To Delete??`)" title="Delete" class="btn btn-xs btn-default "><i class="fa fa-times"></i></a>';
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
        $result = $this->video::find($id);
        return $result;
    }

    public function store($request)
    {
        Video::create($request->all());

        return true;
    }

    public function update($request, $id)
    {
        $video = Video::find($id);
        $video->update($request->all());

        return true;
    }

    public function statusUpdate($id, $status)
    {
        $photo = $this->video::find($id);
        $photo->status = $status;
        $photo->save();
        return $photo;
    }

    public function destroy($id)
    {
        $result = $this->video::find($id);
        $path = public_path($result->image);
        if (file_exists($path)) {
            @unlink($path);
        }
        $result->delete();
        return true;
    }
}
