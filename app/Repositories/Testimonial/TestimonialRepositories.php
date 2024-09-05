<?php

namespace App\Repositories\Testimonial;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimonial;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Illuminate\Support\Str;

class TestimonialRepositories
{
    /**
     * @var user_id
     */
    private $user_id;
    /**
     * @var Brand
     */
    private $Testimonial;
    /**
     * CourseRepository constructor.
     * @param team $team
     */
    public function __construct(Testimonial $Testimonial)
    {
        $this->Testimonial = $Testimonial;
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
        $result = $this->Testimonial::latest()->get();
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
            1 => 'customer_id',
            2 => 'message',
        );

        $edit = Helper::roleAccess('testimonial.testimonial.edit') ? 1 : 0;
        $delete = Helper::roleAccess('testimonial.testimonial.destroy') ? 1 : 0;
        $view = Helper::roleAccess('testimonial.testimonial.show') ? 1 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->Testimonial::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $Testimonial = $this->Testimonial::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                //->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->Testimonial::count();
        } else {
            $search = $request->input('search.value');
            $Testimonial = $this->Testimonial::where('customer_id', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->Testimonial::where('customer_id', 'like', "%{$search}%")->count();
        }



        $data = array();
        if ($Testimonial) {
            foreach ($Testimonial as $key => $team) {
                $nestedData['id'] = $key + 1;
                $nestedData['customer_id'] = $team->customer->customerCode . '-' . $team->customer->name;
                $nestedData['message'] = Str::words($team->message, 20, '...');
                $img = asset('public/backend/testimonial/' . $team->image);
                $nestedData['image'] = '<img width="50px" class="img-product" src="' . $img . '">';

                if ($team->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('testimonial.testimonial.status', [$team->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('testimonial.testimonial.status', [$team->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('testimonial.testimonial.edit', $team->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';

                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('testimonial.testimonial.destroy', $team->id) . '" delete_id="' . $team->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $team->id . '"><i class="fa fa-times"></i></a>';
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
        $result = $this->Testimonial::find($id);
        return $result;
    }

    public function store($request)
    {
        // dd($request->all());
        $Testimonial = new Testimonial();
        $Testimonial->message = $request->message;
        $Testimonial->alt = $request->alt;
        $Testimonial->customer_id = $request->customer_id;
        if ($request->hasFile('image')) {
            $image = $request->image->getClientOriginalName();
            $request->image->move(public_path() . '/backend/testimonial/', $image);
            $Testimonial->image =  $image;
        } else {
            $Testimonial->image =  "dummy.jpg";
        }
        $Testimonial->save();
        return $Testimonial;
    }

    public function update($request, $id)
    {
        Testimonial::where('id', $id)->delete();
        $Testimonial = new Testimonial();
        $Testimonial->message = $request->message;
        $Testimonial->alt = $request->alt;
        $Testimonial->customer_id = $request->customer_id;

        if ($request->hasFile('image')) {
            $image = $request->image->getClientOriginalName();
            $request->image->move(public_path() . '/backend/testimonial/', $image);
            $Testimonial->image =  $image;
        } else {
            $Testimonial->image =  $request->newimage;
        }

        $Testimonial->save();
        return $Testimonial;
    }

    public function statusUpdate($id, $status)
    {
        $team = $this->Testimonial::find($id);
        $team->status = $status;
        $team->save();
        return $team;
    }

    public function destroy($id)
    {
        $team = $this->Testimonial::find($id);
        $team->delete();
        return true;
    }
}
