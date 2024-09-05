<?php

namespace App\Repositories\Blog;

use App\Helpers\Helper;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlogRepositories
{
    /**
     * @var blog
     */
    private $blog;
    /**
     * CourseRepository constructor.
     * @param blog $blog
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->blog::latest()->get();
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

        $edit = Helper::roleAccess('blog.edit') ? 1 : 0;
        $delete = Helper::roleAccess('blog.destroy') ? 1 : 0;
        $view = Helper::roleAccess('blog.show') ? 0 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->blog::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $blogs = $this->blog::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->blog::count();
        } else {
            $search = $request->input('search.value');
            $blogs = $this->blog::where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->blog::where('title', 'like', "%{$search}%")->count();
        }


        $data = array();
        if ($blogs) {
            foreach ($blogs as $key => $blog) {
                $nestedData['id'] = $key + 1;
                $nestedData['title'] = $blog->title ?? "N/A";
                $nestedData['image'] = '<img width="50px" class="img-product" src="/backend/blog/' . $blog->image . '">';
                $nestedData['short_description'] = Str::words($blog->short_description, 20, '...');
                $nestedData['created_at'] = Carbon::parse($blog->created_at)->format('d-m-Y');
                if ($blog->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('blog.status', [$blog->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('blog.status', [$blog->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('blog.edit', $blog->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view != 0)
                        $view_data = '<a href="' . route('blog.show', $blog->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('blog.destroy', $blog->id) . '" delete_id="' . $blog->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $blog->id . '"><i class="fa fa-times"></i></a>';
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
        $result = $this->blog::find($id);
        return $result;
    }

    public function store($request)
    {
        $blog = new $this->blog();
        if ($request->has('category_id')) {
            $blog->category_id = $request->category_id;
        }
        $blog->title = $request->title;
        $blog->alt = $request->alt;
        if($request->filled('meta')){
            $blog->meta = $request->meta;
        }else{
            
            $blog->meta = "<title>".$blog->title."</title>";
        }

        if ($request->hasFile('image')) {
            $image = $request->image->getClientOriginalName();
            $request->image->move(public_path() . '/backend/blog/', $image);
            $blog->image =  $image;
        }

        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        $blog->created_by = auth()->id();
        $blog->save();
        return $blog;
    }

    public function update($request, $id)
    {
        $blog = $this->blog::findOrFail($id);
        if ($request->has('category_id')) {
            $blog->category_id = $request->category_id;
        }
        $blog->title = $request->title;
        $blog->alt = $request->alt;
        if($request->filled('meta')){
            $blog->meta = $request->meta;
        }else{
            
            $blog->meta = "<title>".$blog->title."</title>";
        }

        if ($request->hasFile('image')) {
            $image = $request->image->getClientOriginalName();
            $request->image->move(public_path() . '/backend/blog/', $image);
            $blog->image =  $image;
        }

        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        $blog->updated_by = auth()->id();
        $blog->save();
        return $blog;
    }

    public function statusUpdate($id, $status)
    {
        $blog = $this->blog::find($id);
        $blog->status = $status;
        $blog->save();
        return $blog;
    }

    public function destroy($id)
    {
        $blog = $this->blog::find($id);
        $blog->delete();
        return true;
    }
}
