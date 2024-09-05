<?php

namespace App\Repositories\InventorySetup;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use phpDocumentor\Reflection\PseudoTypes\False_;

class ProductRepositories
{
    /**
     * @var user_id
     */
    private $user_id;
    /**
     * @var Product
     */
    private $product;
    /**
     * CourseRepository constructor.
     * @param product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
        //$this->middleware(function ($request, $next) {
        $this->user_id = 1; //auth()->user()->id;
        //  return $next($request);
        //});
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
            2 => 'productCode',
        );

        $edit = Helper::roleAccess('inventorySetup.product.edit') ? 1 : 0;
        $delete = Helper::roleAccess('inventorySetup.product.destroy') ? 1 : 0;
        $view = Helper::roleAccess('inventorySetup.product.show') ? 0 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->product::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $products = $this->product::with('brand', 'productUnit')->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                //->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->product::count();
        } else {
            $search = $request->input('search.value');
            $products = $this->product::with('brand', 'productUnit')->where('name', 'like', "%{$search}%")->orWhere('productCode', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->product::where('name', 'like', "%{$search}%")->count();
        }



        $data = array();
        if ($products) {
            foreach ($products as $key => $product) {
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $product->name;
                $nestedData['productCode'] = $product->productCode;
                // $nestedData['category'] = $product->category->name;
                $nestedData['brand'] = $product->brand->name;
                $nestedData['productUnit'] = $product->productUnit->name;
                $nestedData['purchases_price'] = $product->purchases_price;
                $nestedData['sale_price'] = $product->sale_price;
                $nestedData['low_stock'] = $product->low_stock;
                if ($product->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('inventorySetup.product.status', [$product->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('inventorySetup.product.status', [$product->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('inventorySetup.product.edit', $product->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view != 0)
                        $view_data = '<a href="' . route('inventorySetup.product.show', $product->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('inventorySetup.product.destroy', $product->id) . '" delete_id="' . $product->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $product->id . '"><i class="fa fa-times"></i></a>';
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

        return $json_data;
    }
    /**
     * @param $request
     * @return mixed
     */
    public function details($id)
    {
        $result = $this->product::find($id);
        return $result;
    }

    public function store($request)
    {
        $product = new $this->product();
        $product->name = $request->name;
        $product->productCode = $request->productCode;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->unit_id = $request->unit_id;
        $product->purchases_price = $request->purchases_price;
        $product->sale_price = $request->sale_price;
        $product->low_stock = $request->low_stock;
        $product->status = 'Active';
        $product->created_by = Auth::user()->id;
        $product->save();
        return $product;
    }

    public function update($request, $id)
    {
        $product = $this->product::findOrFail($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->unit_id = $request->unit_id;
        $product->purchases_price = $request->purchases_price;
        $product->sale_price = $request->sale_price;
        $product->low_stock = $request->low_stock;
        $product->status = 'Active';
        $product->updated_by = Auth::user()->id;
        $product->save();
        return $product;
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
