<?php

namespace App\Repositories\Products;

use App\Helpers\Helper;
use App\Models\Gallary;
use App\Models\Module;
use App\Models\Package;
use App\Models\PackageDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsRepositories
{
    /**
     * @var product
     */
    private $product;
    /**
     * CourseRepository constructor.
     * @param product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        $result = $this->product::latest()->get();
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
            1 => 'name',
        );

        $edit = Helper::roleAccess('products.edit') ? 1 : 0;
        $delete = Helper::roleAccess('products.destroy') ? 1 : 0;
        $view = Helper::roleAccess('products.show') ? 0 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->product::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $products = $this->product::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                //->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->product::count();
        } else {
            $search = $request->input('search.value');
            $products = $this->product::where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->product::where('title', 'like', "%{$search}%")->count();
        }


        $data = array();
        if ($products) {
            foreach ($products as $key => $product) {
                $nestedData['id'] = $key + 1;
                $nestedData['title'] = $product->title;
                $nestedData['description'] = Str::words($product->description, 20, '...');
                if ($product->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('products.status', [$product->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('products.status', [$product->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('products.edit', $product->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view != 0)
                        $view_data = '<a href="' . route('products.show', $product->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('products.destroy', $product->id) . '" delete_id="' . $product->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $product->id . '"><i class="fa fa-times"></i></a>';
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

        $result = $this->product::with(["modules", "gallaries", "packages.details"])->find($id);
        return $result;
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $product = new $this->product();
            $product->title = $request->title;

            $product->slug = Str::slug($request->title);
            $product->subtitle = $request->subtitle;
            $product->description = $request->description;
            $product->tecnology = $request->tecnology;
            $product->video_title = $request->video_title;
            $product->video_link = $request->video_link;
            $product->service_id = $request->service_id;
            $product->module_title = $request->module_title;
            $product->gallary_title = $request->gallary_title;
            $product->meta = $request->meta;
            $product->alt = $request->alt;
            $product->created_by = Auth::user()->id;
            $product->save();

            if ($request->has('module_item')) {
                foreach ($request->module_item as $index => $module) {
                    if (!empty($module)) {
                        Module::create([
                            "product_id" => $product->id,
                            "name" => $module,
                            "created_by" => auth()->id(),
                        ]);
                    }
                }
            }

            if ($request->hasFile('image')) {
                foreach ($request->image as $i => $imageObg) {
                    if ($imageObg) {
                        $image = $imageObg->getClientOriginalName();
                        $imageObg->move(public_path() . '/backend/products/', $image);
                        Gallary::create([
                            'image' => $image,
                            'product_id' => $product->id,
                            'created_by' => auth()->id(),
                        ]);
                    }
                }
            }

            if ($request->filled('name')) {
                foreach ($request->name as $i => $name) {
                    $pack = Package::create([
                        'name' => $name,
                        'product_id' => $product->id,
                        'onetime_amount' => $request->onetime_amount[$i] ?? null,
                        'monthly_amount' => $request->monthly_amount[$i] ?? null,
                        'created_by' => auth()->id(),
                    ]);

                    if ($request->filled('package_features') && isset($request->package_features[$i])) {
                        foreach ($request->package_features[$i] as $key => $feature) {
                            if ($feature) {
                                PackageDetail::create([
                                    'product_id' => $product->id,
                                    "package_id" => $pack->id,
                                    "name" => $feature
                                ]);
                            }
                        }
                    }
                }
            }
            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error message: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());
        }
    }

    public function update($request, $id)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $product = $this->product::findOrFail($id);
            $product->title = $request->title;
            $product->slug = Str::slug($request->title);
            $product->subtitle = $request->subtitle;
            $product->description = $request->description;
            $product->tecnology = $request->tecnology;
            $product->video_title = $request->video_title;
            $product->video_link = $request->video_link;
            $product->service_id = $request->service_id;
            $product->module_title = $request->module_title;
            $product->gallary_title = $request->gallary_title;
            $product->meta = $request->meta;
            $product->alt = $request->alt;
            $product->created_by = Auth::user()->id;
            $product->save();

            if ($request->has('module_item')) {
                Module::where('product_id', $product->id)->delete();
                foreach ($request->module_item as $index => $module) {
                    if (!empty($module)) {
                        Module::create([
                            "product_id" => $product->id,
                            "name" => $module,
                            "order_by" => $index,
                            "created_by" => auth()->id(),
                        ]);
                    }
                }
            }

            if ($request->hasFile('image')) {
                Gallary::where('product_id', $product->id)->delete();
                foreach ($request->image as $i => $imageObg) {
                    if ($imageObg) {
                        $image = $imageObg->getClientOriginalName();
                        $imageObg->move(public_path() . '/backend/products/', $image);
                        Gallary::create([
                            'image' => $image,
                            "order_by" => $i,
                            'product_id' => $product->id,
                            'created_by' => auth()->id(),
                        ]);
                    }
                }
            }

            if ($request->filled('name')) {
                Package::where('product_id', $product->id)->delete();
                PackageDetail::where('product_id', $product->id)->delete();
                foreach ($request->name as $i => $name) {
                    $pack = Package::create([
                        'name' => $name,
                        'product_id' => $product->id,
                        'onetime_amount' => $request->onetime_amount[$i] ?? null,
                        'monthly_amount' => $request->monthly_amount[$i] ?? null,
                        "order_by" => $i,
                        'created_by' => auth()->id(),
                    ]);

                    if ($request->filled('package_features') && isset($request->package_features[$i])) {
                        foreach ($request->package_features[$i] as $key => $feature) {
                            if ($feature) {
                                PackageDetail::create([
                                    'order_by' => $key,
                                    'product_id' => $product->id,
                                    "package_id" => $pack->id,
                                    "name" => $feature
                                ]);
                            }
                        }
                    }
                }
            }
            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error message: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());
        }
    }

    public function statusUpdate($id, $status)
    {
        $product = $this->product::find($id);
        $product->status = $status;
        $product->save();
        return $product;
    }

    public function destroy($id)
    {
        $product = $this->product::find($id);
        $product->delete();
        return true;
    }
}
