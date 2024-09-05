<?php

namespace App\Repositories\InventorySetup;

use App\Helpers\Helper;
use App\Models\Brand;
use App\Models\PrDetails;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\PurchaseRequisition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderRepositories
{
    /**
     * @var user_id
     */
    private $user_id;
    /**
     * @var Brand
     */
    private $purchaseorder;
    /**
     * CourseRepository constructor.
     */
    public function __construct(PurchaseOrder $purchaseorder)
    {
        $this->purchaseorder = $purchaseorder;
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
        $result = $this->purchaseorder::latest()->get();
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
            1 => 'order_date',
            2 => 'invoice_no',
        );

        $edit = Helper::roleAccess('inventorySetup.purchaseorder.edit') && $this->purchaseorder->status != "Accepted" ? 1 : 0;
        $delete = Helper::roleAccess('inventorySetup.purchaseorder.destroy') ? 1 : 0;
        $invoice = Helper::roleAccess('inventorySetup.purchaseorder.invoice') ? 1 : 0;
        $ced = $edit + $delete + $invoice;

        // dd($approve);

        $totalData = $this->purchaseorder::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $auth = Auth::user();
        if (empty($request->input('search.value'))) {
            $purchaseorders = $this->purchaseorder::offset($start);
            if ($auth->branch_id !== null) {
                $purchaseorders = $purchaseorders->where('branch_id', $auth->branch_id);
            }
            $purchaseorders = $purchaseorders->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->purchaseorder::count();
        } else {
            $search = $request->input('search.value');
            $purchaseorders = $this->purchaseorder::where('invoice_no', 'like', "%{$search}%");
            if ($auth->branch_id !== null) {
                $purchaseorders = $purchaseorders->where('branch_id', $auth->branch_id);
            }
            $purchaseorders = $purchaseorders->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->purchaseorder::where('invoice_no', 'like', "%{$search}%")->count();
        }

        $data = array();
        if ($purchaseorders) {
            foreach ($purchaseorders as $key => $value) {
                $nestedData['id'] = $key + 1;
                $nestedData['order_date'] = $value->order_date;
                $nestedData['invoice_no'] = $value->invoice_no;
                $nestedData['supplier_id'] = $value->supplier->supplierCode . ' - ' . $value->supplier->name;
                $nestedData['purchase_requisition_id'] = $value->purchaseRequisition->invoice_no;
                $nestedData['branch_id'] = $value->branch->branchCode . ' - ' . $value->branch->name;
                $nestedData['total_bill'] = $value->total_bill;
                if ($value->status == 'Accepted') {
                    $nestedData['status'] = '<a class="btn btn-success">' . $value->status . '</a>';
                } elseif ($value->status == 'Pending') {
                    $nestedData['status'] = '<a class="btn btn-warning">' . $value->status . '</a>';
                } else {
                    $nestedData['status'] = '<a class="btn btn-danger">' . $value->status . '</a>';
                }

                if ($ced != 0) :
                    if ($edit != 0) {
                        $edit_data = '<a href="' . route('inventorySetup.purchaseorder.edit', $value->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    } else {
                        $edit_data = '';
                    }
                    if ($invoice != 0) {
                        $invoice_data = '<a href="' . route('inventorySetup.purchaseorder.invoice', $value->id) . '" class="btn btn-xs btn-default"><i class="fas fa-eye"></i></a>';
                    } else {
                        $invoice_data = '';
                    }

                    if ($delete != 0) {
                        $delete_data = '<a delete_route="' . route('inventorySetup.purchaseorder.destroy', $value->id) . '" delete_id="' . $value->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $value->id . '"><i class="fa fa-times"></i></a>';
                    } else {
                        $delete_data = '';
                    }

                    $nestedData['action'] = $edit_data . ' ' . $invoice_data . ' ' . $delete_data;
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

    public function store($request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $purchaseorder = new $this->purchaseorder();
            $purchaseorder->order_date = $request->date;
            $purchaseorder->invoice_no = $request->orderCode;
            $purchaseorder->supplier_id = $request->subblier_id;
            $purchaseorder->purchase_requisition_id = $request->purchase_requisition;
            // $purchaseorder->branch_id = $request->purchase_requisition;
            $purchaseorder->advance_payment = $request->paid_amount;
            $purchaseorder->branch_id = $request->branch_id;
            $purchaseorder->total_bill = array_sum($request->total);
            $purchaseorder->note = $request->note;
            $purchaseorder->save();
            $purchaseOr_id = $purchaseorder->id;

            $category = $request->category_nm;
            $product = $request->product_nm;
            $qty = $request->qty;
            $unitprice = $request->unitprice;
            $total = $request->total;
            for ($i = 0; $i < count($category); $i++) {
                $purchaseOrderDetails = new PurchaseOrderDetail();
                $purchaseOrderDetails->purchase_order_id = $purchaseOr_id;
                $purchaseOrderDetails->category_id = $category[$i];
                $purchaseOrderDetails->branch_id = $request->branch_id;
                $purchaseOrderDetails->product_id = $product[$i];
                $purchaseOrderDetails->qty = $qty[$i];
                $purchaseOrderDetails->unit_price = $unitprice[$i];
                $purchaseOrderDetails->total_price = $total[$i];
                $purchaseOrderDetails->save();
            }

            $purchasereq['approve_by'] = Auth::user()->id;
            $purchasereq['approve_at'] = date('Y-m-d');
            $purchasereq['status'] = 'Accepted';
            PurchaseRequisition::where('id', $request->purchase_requisition)->update($purchasereq);

            $prDetails['status'] = 'Accepted';
            PrDetails::where('pr_id', $request->purchase_requisition)->update($prDetails);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            redirect('inventory-purchase-create')->with('error', 'Something Wrong Please try again');
        }

        return  $purchaseorder;
    }

    public function update($request, $id)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $purchaseorder = $this->purchaseorder::find($id);
            $purchaseorder->order_date = $request->date;
            $purchaseorder->supplier_id = $request->subblier_id;
            $purchaseorder->purchase_requisition_id = $request->purchase_requisition;
            $purchaseorder->advance_payment = $request->paid_amount;
            $purchaseorder->total_bill = array_sum($request->total);
            $purchaseorder->note = $request->note;
            $purchaseorder->save();

            PurchaseOrderDetail::where('purchase_order_id', $id)->delete();

            $category = $request->category_nm;
            $product = $request->product_nm;
            $qty = $request->qty;
            $unitprice = $request->unitprice;
            $total = $request->total;
            for ($i = 0; $i < count($category); $i++) {
                $purchaseOrderDetails = new PurchaseOrderDetail();
                $purchaseOrderDetails->purchase_order_id = $id;
                $purchaseOrderDetails->category_id = $category[$i];
                $purchaseOrderDetails->branch_id = $request->branch_id;
                $purchaseOrderDetails->product_id = $product[$i];
                $purchaseOrderDetails->qty = $qty[$i];
                $purchaseOrderDetails->unit_price = $unitprice[$i];
                $purchaseOrderDetails->total_price = $total[$i];
                $purchaseOrderDetails->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            redirect('inventory-purchase-create')->with('error', 'Something Wrong Please try again');
        }
    }

    public function destroy($id)
    {
        $purchaseorder = $this->purchaseorder::find($id);
        if ($purchaseorder->status == "Accepted") {
            session()->flash('error', "Sorry, you couldn't delete!!");
            return false;
        } else {
            $purchaseorder->delete();
            PurchaseOrderDetail::where('purchase_order_id', $id)->delete();
            $purchaserequpdate['status'] = "Pending";
            PurchaseRequisition::where('id', $purchaseorder->purchase_requisition_id)->update($purchaserequpdate);
            return true;
        }
    }
    public function details($id)
    {
        return  $this->purchaseorder::find($id);
    }

    public function getprList($request)
    {
        $data = '';
        $prDetails = PrDetails::where('pr_id', $request->id);

        $purchaserequi = PurchaseRequisition::find($request->id);
        $branch = '<option selected value="' . $purchaserequi->branch_id  . '"> ' . $purchaserequi->branch->branchCode . ' - ' .  $purchaserequi->branch->name . '</option>';

        foreach ($prDetails->get() as $value) {
            $data .= '<tr class="delrow new_item' . $value->product_id . '">
        <td >
           ' . $value->category->name . '
            <input type="hidden" name="category_nm[]" value="' . $value->category_id . '">
        </td>
        <td class="text-right">' . $value->product->name . '<input type="hidden" name="product_nm[]" value="' . $value->product_id . '"></td>
        <td class="text-right">' . ' <input class="ttlqty qnty form-control" type="number"  name="qty[]" value="' . $value->qty . '"></td>
        <td class="text-right">' . $value->unit_price . ' <input class="ttlunitprice unitprice" id="unitprice" type="hidden" name="unitprice[]" value="' . $value->unit_price . '"></td>
        <td class="text-right">' . ' <input class="total form-control" id="total" type="text" readonly name="total[]" value="' . $value->total_price . '"></td>
        <td>
                <a del_id="' . $value->product_id . '" class="delete_item btn form-control btn-danger" href="javascript:;" title="">
                    <i class="fa fa-times"></i>
                </a>
        </td>
    </tr>';
        }

        return ['prdetails' => $data, 'branch' => $branch];
    }
}
