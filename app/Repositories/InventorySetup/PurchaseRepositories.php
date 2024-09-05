<?php

namespace App\Repositories\InventorySetup;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use App\Models\PurchaseOrder;
use App\Models\Purchases;
use App\Models\PurchasesDetails;
use App\Models\Stock;
use App\Models\StockSummary;
use App\Models\supplierLedger;
use App\Models\Transection;
use App\Models\SupplierPayment;
use Illuminate\Support\Facades\DB;

class PurchaseRepositories
{

    /**
     * @var user_id
     */
    private $user_id;

    /**
     * @var Brand
     */
    private $purchases;

    /**
     * CourseRepository constructor.
     * @param brand $purchase
     */
    public function __construct(purchases $purchases)
    {
        $this->purchases = $purchases;
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
        $result = $this->purchases::latest()->get();
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
            1 => 'invoice_no',
        );

        $edit = Helper::roleAccess('inventorySetup.purchase.edit') ? 1 : 0;
        $delete = Helper::roleAccess('inventorySetup.purchase.destroy') ? 1 : 0;
        $view = Helper::roleAccess('inventorySetup.purchase.show') ? 1 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->purchases::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $auth = Auth::user();

        if (empty($request->input('search.value'))) {
            $purchases = $this->purchases::where('purchase_type', 'Direct')->offset($start);
            if ($auth->branch_id !== null) {
                $purchases = $purchases->where('branch_id', $auth->branch_id);
            }
            $purchases =  $purchases->limit($limit)
                ->orderBy($order, $dir)
                //->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->purchases::count();
        } else {
            $search = $request->input('search.value');
            $purchases = $this->purchases::where('invoice_no', 'like', "%{$search}%");
            if ($auth->branch_id !== null) {
                $purchases = $purchases->where('branch_id', $auth->branch_id);
            }
            $purchases = $purchases->where('purchase_type', 'Direct')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->purchases::where('invoice_no', 'like', "%{$search}%")->count();
        }



        $data = array();
        if ($purchases) {
            foreach ($purchases as $key => $purchase) {
                // dd($purchase->branch);
                $nestedData['id'] = $key + 1;
                $nestedData['invoice_no'] = $purchase->invoice_no;
                $nestedData['date'] = $purchase->date;
                $nestedData['branch'] = $purchase->branch->name ?? 'N/A';
                $nestedData['supplier'] = $purchase->supplier->name ?? 'N/A';
                $nestedData['payment_type'] = $purchase->payment_type;
                $nestedData['subtotal'] = $purchase->subtotal;
                $nestedData['discount'] = $purchase->discount;
                $nestedData['grand_total'] = $purchase->grand_total;
                if ($purchase->status == 'Active') :
                    $status = '<input class="status_row" status_route="' . route('inventorySetup.purchase.status', [$purchase->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                else :
                    $status = '<input  class="status_row" status_route="' . route('inventorySetup.purchase.status', [$purchase->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                endif;
                $nestedData['status'] = $status;
                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('inventorySetup.purchase.edit', $purchase->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view = !0)
                        $view_data = '<a href="' . route('inventorySetup.purchase.show', $purchase->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('inventorySetup.purchase.destroy', $purchase->id) . '" delete_id="' . $purchase->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $purchase->id . '"><i class="fa fa-times"></i></a>';
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
    public function getpvList($request)
    {
        $columns = array(
            0 => 'id',
            1 => 'invoice_no',
        );

        $edit = Helper::roleAccess('inventorySetup.purchase.edit') ? 1 : 0;
        $delete = Helper::roleAccess('inventorySetup.purchase.destroy') ? 1 : 0;
        $view = Helper::roleAccess('inventorySetup.purchase.show') ? 1 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->purchases::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $auth = Auth::user();
        if (empty($request->input('search.value'))) {
            $purchases = $this->purchases::where('purchase_type', 'Manual')->offset($start);
            if ($auth->branch_id !== null) {
                $purchases = $purchases->where('branch_id', $auth->branch_id);
            }
            $purchases = $purchases->limit($limit)
                ->orderBy($order, $dir)
                //->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->purchases::count();
        } else {
            $search = $request->input('search.value');
            $purchases = $this->purchases::where('invoice_no', 'like', "%{$search}%");
            if ($auth->branch_id !== null) {
                $purchases = $purchases->where('branch_id', $auth->branch_id);
            }
            $purchases = $purchases->where('purchase_type', 'Manual')
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                // ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = $this->purchases::where('invoice_no', 'like', "%{$search}%")->count();
        }

        $data = array();
        if ($purchases) {
            foreach ($purchases as $key => $purchase) {
                // dd($purchase->branch);
                $nestedData['id'] = $key + 1;
                $nestedData['invoice_no'] = $purchase->invoice_no;
                $nestedData['date'] = $purchase->date;
                $nestedData['branch'] = $purchase->branch->name ?? 'N/A';
                $nestedData['supplier'] = $purchase->supplier->name ?? 'N/A';
                $nestedData['payment_type'] = $purchase->payment_type;
                $nestedData['subtotal'] = $purchase->subtotal;
                $nestedData['discount'] = $purchase->discount;
                $nestedData['grand_total'] = $purchase->grand_total;

                if ($purchase->status == 'Active') :
                    $nestedData['status'] = '<button class="btn btn-success btn-sm">Accepted</button>';
                elseif ($purchase->status == 'Pending') :
                    $nestedData['status'] = '<button class="btn btn-warning btn-sm">Pending</button>';
                elseif ($purchase->status ==  "Close") :
                    $nestedData['status'] = '<button class="btn btn-danger btn-sm pvaction" statusId="Reopen" rowID="' . $purchase->id . '" >Close</button>';
                elseif ($purchase->status ==  "Reopen") :
                    $nestedData['status'] = '<button class="btn btn-warning btn-sm pvaction" statusId="Close" rowID="' . $purchase->id . '">Reopen</button>';
                endif;

                if ($ced != 0) :
                    if ($edit != 0)
                        $edit_data = '<a href="' . route('inventorySetup.purchase.pvedit', $purchase->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view = !0)
                        $view_data = '<a href="' . route('inventorySetup.purchase.pvinvoice', $purchase->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('inventorySetup.purchase.pvdestroy', $purchase->id) . '" delete_id="' . $purchase->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $purchase->id . '"><i class="fa fa-times"></i></a>';
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
        $result = $this->purchases::find($id);
        return $result;
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $purchase = new $this->purchases();
            $purchase->invoice_no = $request->invoice_no;
            $purchase->date = $request->date;
            $purchase->branch_id = $request->branch_id;
            $purchase->supplier_id = $request->supplier_id;
            $purchase->quantity = array_sum($request->qty);
            $purchase->purchase_type = 'Direct';
            $purchase->subtotal = array_sum($request->unitprice);
            $purchase->grand_total = array_sum($request->total);
            $purchase->status = 'Active';
            $purchase->payment_type = $request->payment_type;
            $purchase->discount = $request->discount;
            $purchase->paid_amount = $request->paid_amount;
            $purchase->due_amount = $request->cart_due;
            $purchase->created_by = Auth::user()->id;
            $purchase->narration = $request->narration;

            if ($request->has('chart_of_account_id')) {
                $purchase->chart_of_account_id = $request->chart_of_account_id;
            }
            if ($request->has('account_number')) {
                $purchase->account_number = $request->account_number;
            }
            if ($request->has('check_number')) {
                $purchase->check_number = $request->check_number;
            }
            if ($request->has('bank')) {
                $purchase->bank = $request->bank;
            }
            if ($request->has('bank_branch')) {
                $purchase->bank_branch = $request->bank_branch;
            }
            if ($request->has('input_net_total')) {
                $purchase->net_total = $request->input_net_total;
            }
            $purchase->save();
            $purchases_id = $purchase->id;

            $category_id = $request->catName;
            $proName = $request->proName;
            $subtotal = $request->unitprice;
            $grand_total = $request->total;
            $qty = $request->qty;



            for ($i = 0; $i < count($category_id); $i++) {
                $purchaseDetail = new PurchasesDetails();
                $purchaseDetail->product_id = $proName[$i];
                $purchaseDetail->category_id = $category_id[$i];
                $purchaseDetail->quantity = $qty[$i];
                $purchaseDetail->branch_id = $request->branch_id;
                $purchaseDetail->unit_price = $subtotal[$i];
                $purchaseDetail->total_price = $grand_total[$i];
                $purchaseDetail->purchases_id = $purchases_id;
                $purchaseDetail->date = $request->date;
                $purchaseDetail->created_by = Auth::user()->id;
                $purchaseDetail->save();

                $stock = new Stock();
                $stock->product_id = $proName[$i];
                $stock->quantity = $qty[$i];
                $stock->branch_id = $request->branch_id;
                $stock->unit_price = $subtotal[$i];
                $stock->total_price = $grand_total[$i];
                $stock->general_id = $purchases_id;
                $stock->date = $request->date;
                $stock->status = 'Purchase';
                $stock->created_by = Auth::user()->id;
                $stock->save();

                $existingCheck = StockSummary::where('product_id', $proName[$i])->where('branch_id', $request->branch_id)->where('type', 'Branch')->first();
                if (!empty($existingCheck)) :
                    $newQty = $existingCheck->quantity + $qty[$i];
                    StockSummary::where('product_id', $proName[$i])->where('branch_id', $request->branch_id)->where('type', 'Branch')->update(array('quantity' => $newQty));
                else :
                    $stockSummary = new StockSummary();
                    $stockSummary->branch_id = $request->branch_id;
                    $stockSummary->product_id = $proName[$i];
                    $stockSummary->quantity = $qty[$i];
                    $stockSummary->type = "Branch";
                    $stockSummary->save();
                endif;
            }

            //ledger check korte hobe
            // transections table e data jabe

            if ($request->payment_type == 'cash' || $request->payment_type == 'check') {
                $supplierLedger = new SupplierLedger();
                $supplierLedger->date = $request->date;
                $supplierLedger->purchase_id = $purchases_id;
                $supplierLedger->supplier_id = $request->supplier_id;
                $supplierLedger->branch_id =  $request->branch_id;
                $supplierLedger->account_id =  $request->chart_of_account_id;
                $supplierLedger->payment_type = $request->payment_type;
                $supplierLedger->debit = array_sum($request->total);
                $supplierLedger->created_by = Auth::user()->id;
                $supplierLedger->save();

                $supplierLedger = new SupplierLedger();
                $supplierLedger->date = $request->date;
                $supplierLedger->purchase_id = $purchases_id;
                $supplierLedger->supplier_id = $request->supplier_id;
                $supplierLedger->branch_id =  $request->branch_id;
                $supplierLedger->account_id =  $request->chart_of_account_id;
                $supplierLedger->payment_type = $request->payment_type;
                $supplierLedger->credit = $request->paid_amount;
                $supplierLedger->created_by = Auth::user()->id;
                $supplierLedger->save();
            } else {
                if (!empty($request->paid_amount)) {
                    $supplierLedger = new SupplierLedger();
                    $supplierLedger->date = $request->date;
                    $supplierLedger->purchase_id = $purchases_id;
                    $supplierLedger->supplier_id = $request->supplier_id;
                    $supplierLedger->branch_id =  $request->branch_id;
                    $supplierLedger->account_id =  $request->chart_of_account_id;
                    $supplierLedger->payment_type = $request->payment_type;
                    $supplierLedger->debit = $request->input_net_total;
                    $supplierLedger->created_by = Auth::user()->id;
                    $supplierLedger->save();

                    $supplierLedger = new SupplierLedger();
                    $supplierLedger->date = $request->date;
                    $supplierLedger->purchase_id = $purchases_id;
                    $supplierLedger->supplier_id = $request->supplier_id;
                    $supplierLedger->branch_id =  $request->branch_id;
                    $supplierLedger->account_id =  $request->chart_of_account_id;
                    $supplierLedger->payment_type = $request->payment_type;
                    $supplierLedger->credit = $request->paid_amount;
                    $supplierLedger->created_by = Auth::user()->id;
                    $supplierLedger->save();
                } else {
                    $supplierLedger = new SupplierLedger();
                    $supplierLedger->date = $request->date;
                    $supplierLedger->purchase_id = $purchases_id;
                    $supplierLedger->supplier_id = $request->supplier_id;
                    $supplierLedger->branch_id =  $request->branch_id;
                    $supplierLedger->account_id =  $request->chart_of_account_id;
                    $supplierLedger->payment_type = $request->payment_type;
                    $supplierLedger->debit = array_sum($request->total);
                    $supplierLedger->created_by = Auth::user()->id;
                    $supplierLedger->save();
                }
            }


            if ($request->payment_type == 'cash') {
                $transection = new Transection();
                $transection->date = $request->date;
                $transection->account_id = $request->chart_of_account_id;
                $transection->payment_id = $purchases_id;
                $transection->branch_id = $request->branch_id;
                $transection->type =  11;
                $transection->note = $request->note;
                $transection->amount =  array_sum($request->total) - $request->discount;
                $transection->credit = array_sum($request->total) - $request->discount;
                $transection->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            redirect('inventory-purchase-create')->with('error', 'Something Wrong Please try again');
        }
        return $purchase;
    }
    public function prstore($request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $purchase = new $this->purchases();
            $purchase->invoice_no = $request->invoice_no;
            $purchase->date = $request->date;
            $purchase->purchase_order_id = $request->purchase_order_id;
            $purchase->branch_id = $request->branch_id;
            $purchase->supplier_id = $request->supplier_id;
            $purchase->quantity = array_sum($request->qty);
            $purchase->purchase_type = 'Manual';
            $purchase->subtotal = array_sum($request->unitprice);
            $purchase->grand_total = array_sum($request->total);
            $purchase->status = 'Close';
            $purchase->payment_type = $request->payment_type;
            $purchase->discount = $request->discount;
            $purchase->paid_amount = $request->paid_amount + $request->advance_payment; // payment and advance pay addition
            $purchase->due_amount = $request->cart_due;
            $purchase->created_by = Auth::user()->id;
            $purchase->narration = $request->narration;

            if ($request->has('chart_of_account_id')) {
                $purchase->chart_of_account_id = $request->chart_of_account_id;
            }
            if ($request->has('account_number')) {
                $purchase->account_number = $request->account_number;
            }
            if ($request->has('check_number')) {
                $purchase->check_number = $request->check_number;
            }
            if ($request->has('bank')) {
                $purchase->bank = $request->bank;
            }
            if ($request->has('bank_branch')) {
                $purchase->bank_branch = $request->bank_branch;
            }
            if ($request->has('input_net_total')) {
                $purchase->net_total = $request->input_net_total;
            }
            $purchase->save();
            $purchases_id = $purchase->id;

            $category_id = $request->category_nm;
            $proName = $request->product_nm;
            $subtotal = $request->unitprice;
            $grand_total = $request->total;
            $qty = $request->qty;
            for ($i = 0; $i < count($category_id); $i++) {
                $purchaseDetail = new PurchasesDetails();
                $purchaseDetail->product_id = $proName[$i];
                $purchaseDetail->category_id = $category_id[$i];
                $purchaseDetail->quantity = $qty[$i];
                $purchaseDetail->branch_id = $request->branch_id;
                $purchaseDetail->unit_price = $subtotal[$i];
                $purchaseDetail->total_price = $grand_total[$i];
                $purchaseDetail->purchases_id = $purchases_id;
                $purchaseDetail->date = $request->date;
                $purchaseDetail->created_by = Auth::user()->id;
                $purchaseDetail->save();
            }

            $purchaseorder['approved_by'] = Auth::user()->id;
            $purchaseorder['approved_at'] = date('Y-m-d');
            $purchaseorder['status'] = 'Accepted';
            PurchaseOrder::where('id', $request->purchase_order_id)->update($purchaseorder);


            if ($request->payment_type == 'cash' || $request->payment_type == 'check') {
                $supplierLedger = new SupplierLedger();
                $supplierLedger->date = $request->date;
                $supplierLedger->purchase_id = $purchases_id;
                $supplierLedger->supplier_id = $request->supplier_id;
                $supplierLedger->branch_id =  $request->branch_id;
                $supplierLedger->account_id =  $request->chart_of_account_id;
                $supplierLedger->payment_type = $request->payment_type;
                $supplierLedger->debit = array_sum($request->total);
                $supplierLedger->created_by = Auth::user()->id;

                $supplierLedger->save();

                $supplierLedger = new SupplierLedger();
                $supplierLedger->date = $request->date;
                $supplierLedger->purchase_id = $purchases_id;
                $supplierLedger->supplier_id = $request->supplier_id;
                $supplierLedger->branch_id =  $request->branch_id;
                $supplierLedger->account_id =  $request->chart_of_account_id;
                $supplierLedger->payment_type = $request->payment_type;
                $supplierLedger->credit = $request->paid_amount;
                $supplierLedger->created_by = Auth::user()->id;
                $supplierLedger->save();
            } else {
                if (!empty($request->paid_amount)) {
                    $supplierLedger = new SupplierLedger();
                    $supplierLedger->date = $request->date;
                    $supplierLedger->purchase_id = $purchases_id;
                    $supplierLedger->supplier_id = $request->supplier_id;
                    $supplierLedger->branch_id =  $request->branch_id;
                    $supplierLedger->account_id =  $request->chart_of_account_id;
                    $supplierLedger->payment_type = $request->payment_type;
                    $supplierLedger->debit = $request->input_net_total;
                    $supplierLedger->created_by = Auth::user()->id;
                    $supplierLedger->save();

                    $supplierLedger = new SupplierLedger();
                    $supplierLedger->date = $request->date;
                    $supplierLedger->purchase_id = $purchases_id;
                    $supplierLedger->supplier_id = $request->supplier_id;
                    $supplierLedger->branch_id =  $request->branch_id;
                    $supplierLedger->account_id =  $request->chart_of_account_id;
                    $supplierLedger->payment_type = $request->payment_type;
                    $supplierLedger->credit = $request->paid_amount;
                    $supplierLedger->created_by = Auth::user()->id;
                    $supplierLedger->save();
                } else {
                    $supplierLedger = new SupplierLedger();
                    $supplierLedger->date = $request->date;
                    $supplierLedger->purchase_id = $purchases_id;
                    $supplierLedger->supplier_id = $request->supplier_id;
                    $supplierLedger->branch_id =  $request->branch_id;
                    $supplierLedger->account_id =  $request->chart_of_account_id;
                    $supplierLedger->payment_type = $request->payment_type;
                    $supplierLedger->debit = array_sum($request->total);
                    $supplierLedger->created_by = Auth::user()->id;
                    $supplierLedger->save();
                }
            }


            if ($request->payment_type == 'cash') {
                $transection = new Transection();
                $transection->date = $request->date;
                $transection->account_id = $request->chart_of_account_id;
                $transection->payment_id = $purchases_id;
                $transection->branch_id = $request->supplier_id;
                $transection->type =  11;
                $transection->note = $request->note;
                $transection->amount =  array_sum($request->total) - $request->discount;
                $transection->credit = array_sum($request->total) - $request->discount;
                $transection->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            redirect('inventory-purchase-create')->with('error', 'Something Wrong Please try again');
        }
        return $purchase;
    }

    public function pvupdate($request, $id)
    {
        // dd($request->all());
        // DB::beginTransaction();
        // try {
        $purchase =  $this->purchases::find($id);
        $purchase->date = $request->date;
        $purchase->purchase_order_id = $request->purchase_order_id;
        $purchase->branch_id = $request->branch_id;
        $purchase->supplier_id = $request->supplier_id;
        $purchase->quantity = array_sum($request->qty);
        $purchase->purchase_type = 'Manual';
        $purchase->subtotal = array_sum($request->unitprice);
        $purchase->grand_total = array_sum($request->total);
        $purchase->status = 'Close';
        $purchase->payment_type = $request->payment_type;
        $purchase->discount = $request->discount;
        $purchase->paid_amount = $request->paid_amount + $request->advance_payment; // payment and advance pay addition
        $purchase->due_amount = $request->cart_due;
        $purchase->updated_by = Auth::user()->id;
        $purchase->narration = $request->narration;

        if ($request->has('chart_of_account_id')) {
            $purchase->chart_of_account_id = $request->chart_of_account_id;
        }
        if ($request->has('account_number')) {
            $purchase->account_number = $request->account_number;
        }
        if ($request->has('check_number')) {
            $purchase->check_number = $request->check_number;
        }
        if ($request->has('bank')) {
            $purchase->bank = $request->bank;
        }
        if ($request->has('bank_branch')) {
            $purchase->bank_branch = $request->bank_branch;
        }
        if ($request->has('input_net_total')) {
            $purchase->net_total = $request->input_net_total;
        }
        $purchase->save();
        $purchases_id = $purchase->id;

        $category_id = $request->category_nm;
        $proName = $request->product_nm;
        $subtotal = $request->unitprice;
        $grand_total = $request->total;
        $qty = $request->qty;

        PurchasesDetails::where('purchases_id', $id)->forceDelete();

        for ($i = 0; $i < count($category_id); $i++) {
            $purchaseDetail = new PurchasesDetails();
            $purchaseDetail->product_id = $proName[$i];
            $purchaseDetail->category_id = $category_id[$i];
            $purchaseDetail->quantity = $qty[$i];
            $purchaseDetail->branch_id = $request->branch_id;
            $purchaseDetail->unit_price = $subtotal[$i];
            $purchaseDetail->total_price = $grand_total[$i];
            $purchaseDetail->purchases_id = $purchases_id;
            $purchaseDetail->date = $request->date;
            $purchaseDetail->updated_by = Auth::user()->id;
            $purchaseDetail->save();
        }

        $purchaseorder['approved_by'] = Auth::user()->id;
        $purchaseorder['approved_at'] = date('Y-m-d');
        $purchaseorder['status'] = 'Accepted';
        PurchaseOrder::where('id', $request->purchase_order_id)->update($purchaseorder);

        supplierLedger::where('purchase_id', $purchases_id)->delete();
        if ($request->payment_type == 'cash' || $request->payment_type == 'check') {
            $supplierLedger = new SupplierLedger();
            $supplierLedger->date = $request->date;
            $supplierLedger->purchase_id = $purchases_id;
            $supplierLedger->supplier_id = $request->supplier_id;
            $supplierLedger->branch_id =  $request->branch_id;
            $supplierLedger->account_id =  $request->chart_of_account_id;
            $supplierLedger->payment_type = $request->payment_type;
            $supplierLedger->debit = array_sum($request->total);
            $supplierLedger->created_by = Auth::user()->id;
            $supplierLedger->save();

            $supplierLedger = new SupplierLedger();
            $supplierLedger->date = $request->date;
            $supplierLedger->purchase_id = $purchases_id;
            $supplierLedger->supplier_id = $request->supplier_id;
            $supplierLedger->branch_id =  $request->branch_id;
            $supplierLedger->account_id =  $request->chart_of_account_id;
            $supplierLedger->payment_type = $request->payment_type;
            $supplierLedger->credit = $request->paid_amount;
            $supplierLedger->created_by = Auth::user()->id;
            $supplierLedger->save();
        } else {
            if (!empty($request->paid_amount)) {
                $supplierLedger = new SupplierLedger();
                $supplierLedger->date = $request->date;
                $supplierLedger->purchase_id = $purchases_id;
                $supplierLedger->supplier_id = $request->supplier_id;
                $supplierLedger->branch_id =  $request->branch_id;
                $supplierLedger->account_id =  $request->chart_of_account_id;
                $supplierLedger->payment_type = $request->payment_type;
                $supplierLedger->debit = $request->input_net_total;
                $supplierLedger->updated_by = Auth::user()->id;
                $supplierLedger->save();

                $supplierLedger = new SupplierLedger();
                $supplierLedger->date = $request->date;
                $supplierLedger->purchase_id = $purchases_id;
                $supplierLedger->supplier_id = $request->supplier_id;
                $supplierLedger->branch_id =  $request->branch_id;
                $supplierLedger->account_id =  $request->chart_of_account_id;
                $supplierLedger->payment_type = $request->payment_type;
                $supplierLedger->credit = $request->paid_amount;
                $supplierLedger->updated_by = Auth::user()->id;
                $supplierLedger->save();
            } else {
                $supplierLedger = new SupplierLedger();
                $supplierLedger->date = $request->date;
                $supplierLedger->purchase_id = $purchases_id;
                $supplierLedger->supplier_id = $request->supplier_id;
                $supplierLedger->branch_id =  $request->branch_id;
                $supplierLedger->account_id =  $request->chart_of_account_id;
                $supplierLedger->payment_type = $request->payment_type;
                $supplierLedger->debit = array_sum($request->total);
                $supplierLedger->updated_by = Auth::user()->id;
                $supplierLedger->save();
            }
        }


        if ($request->payment_type == 'cash') {
            $transection['date'] = $request->date;
            $transection['account_id'] = $request->chart_of_account_id;
            $transection['payment_id'] = $purchases_id;
            $transection['branch_id'] = $request->branch_id;
            $transection['type'] =  11;
            $transection['note'] = $request->note;
            $transection['amount'] =  array_sum($request->total) - $request->discount;
            $transection['credit'] = array_sum($request->total) - $request->discount;
            Transection::where('payment_id', $purchases_id)->where('type', 11)->update($transection);
        }

        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     redirect('inventory-purchase-create')->with('error', 'Something Wrong Please try again');
        // }
        return $purchase;
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $purchase = $this->purchases::findOrFail($id);
            $purchase->date = $request->date;
            $purchase->branch_id = $request->branch_id;
            $purchase->supplier_id = $request->supplier_id;
            $purchase->quantity = array_sum($request->qty);
            $purchase->subtotal = array_sum($request->unitprice);
            $purchase->grand_total = array_sum($request->total);
            $purchase->payment_type = $request->payment_type;
            $purchase->discount = $request->discount;
            $purchase->paid_amount = $request->paid_amount;
            $purchase->due_amount = $request->cart_due;
            $purchase->created_by = Auth::user()->id;
            $purchase->narration = $request->narration;

            if ($request->has('chart_of_account_id')) {
                $purchase->chart_of_account_id = $request->chart_of_account_id;
            }
            if ($request->has('account_number')) {
                $purchase->account_number = $request->account_number;
            }
            if ($request->has('check_number')) {
                $purchase->check_number = $request->check_number;
            }
            if ($request->has('bank')) {
                $purchase->bank = $request->bank;
            }
            if ($request->has('bank_branch')) {
                $purchase->bank_branch = $request->bank_branch;
            }
            if ($request->has('input_net_total')) {
                $purchase->net_total = $request->input_net_total;
            }
            $purchase->save();
            $purchases_id = $purchase->id;


            $category_id = $request->catName;
            $oldproName =  $request->oldproName;
            $oldqty =  $request->oldqty;
            $proName = $request->proName;
            $subtotal = $request->unitprice;
            $grand_total = $request->total;
            $qty = $request->qty;

            for ($w = 0; $w < count($oldproName); $w++) {
                // echo $oldproName[$i];
                $mywhereCondition = array(
                    'branch_id' => $request->old_branch_id,
                    'product_id' => $oldproName[$w],
                    'type' => 'Branch',
                );

                $oldstockupdate = StockSummary::where($mywhereCondition)->first();
                // dd($oldstockupdate);

                DB::table('stock_summaries')
                    ->where($mywhereCondition)
                    ->update(
                        ['quantity' => $oldstockupdate->quantity - $oldqty[$w]],
                    );
            }

            PurchasesDetails::where('purchases_id', $purchase->id)->forceDelete();
            Stock::where('general_id', $purchase->id)->where('status', 'Purchase')->forceDelete();

            for ($i = 0; $i < count($category_id); $i++) {
                $purchaseDetail = new PurchasesDetails();
                $purchaseDetail->product_id = $proName[$i];
                $purchaseDetail->quantity = $qty[$i];
                $purchaseDetail->branch_id = $request->branch_id;
                $purchaseDetail->unit_price = $subtotal[$i];
                $purchaseDetail->total_price = $grand_total[$i];
                $purchaseDetail->purchases_id = $purchases_id;
                $purchaseDetail->date = $request->date;
                $purchaseDetail->created_by = Auth::user()->id;
                $purchaseDetail->save();

                $stock = new Stock();
                $stock->product_id = $proName[$i];
                $stock->quantity = $qty[$i];
                $stock->branch_id = $request->branch_id;
                $stock->unit_price = $subtotal[$i];
                $stock->total_price = $grand_total[$i];
                $stock->general_id = $purchases_id;
                $stock->date = $request->date;
                $stock->status = 'Purchase';
                $stock->created_by = Auth::user()->id;
                $stock->save();

                $existingCheck = StockSummary::where('product_id', $proName[$i])->where('branch_id', $request->branch_id)->where('type', 'Branch')->first();

                if (!empty($existingCheck) && $existingCheck->quantity >= 0) :
                    // dd('1');
                    $newQty = $existingCheck->quantity + $qty[$i];
                    StockSummary::where('product_id', $proName[$i])->where('branch_id', $request->branch_id)->where('type', 'Branch')->update(array('quantity' => $newQty));
                else :
                    // dd('2');
                    $stockSummary = new StockSummary();
                    $stockSummary->branch_id = $request->branch_id;
                    $stockSummary->product_id = $proName[$i];
                    $stockSummary->quantity = $qty[$i];
                    $stockSummary->type = 'Branch';
                    $stockSummary->save();
                endif;
            }

            supplierLedger::where('purchase_id', $purchases_id)->delete();
            if ($request->payment_type == 'cash' || $request->payment_type == 'check') {
                $supplierLedger = new SupplierLedger();
                $supplierLedger->date = $request->date;
                $supplierLedger->purchase_id = $purchases_id;
                $supplierLedger->supplier_id = $request->supplier_id;
                $supplierLedger->branch_id =  $request->branch_id;
                $supplierLedger->account_id =  $request->chart_of_account_id;
                $supplierLedger->payment_type = $request->payment_type;
                $supplierLedger->debit = array_sum($request->total);
                $supplierLedger->updated_by = Auth::user()->id;
                $supplierLedger->save();

                $supplierLedger = new SupplierLedger();
                $supplierLedger->date = $request->date;
                $supplierLedger->purchase_id = $purchases_id;
                $supplierLedger->supplier_id = $request->supplier_id;
                $supplierLedger->branch_id =  $request->branch_id;
                $supplierLedger->account_id =  $request->chart_of_account_id;
                $supplierLedger->payment_type = $request->payment_type;
                $supplierLedger->credit = $request->paid_amount;
                $supplierLedger->updated_by = Auth::user()->id;
                $supplierLedger->save();
            } else {
                if (!empty($request->paid_amount)) {
                    $supplierLedger = new SupplierLedger();
                    $supplierLedger->date = $request->date;
                    $supplierLedger->purchase_id = $purchases_id;
                    $supplierLedger->supplier_id = $request->supplier_id;
                    $supplierLedger->branch_id =  $request->branch_id;
                    $supplierLedger->account_id =  $request->chart_of_account_id;
                    $supplierLedger->payment_type = $request->payment_type;
                    $supplierLedger->debit = $request->input_net_total;
                    $supplierLedger->updated_by = Auth::user()->id;
                    $supplierLedger->save();

                    $supplierLedger = new SupplierLedger();
                    $supplierLedger->date = $request->date;
                    $supplierLedger->purchase_id = $purchases_id;
                    $supplierLedger->supplier_id = $request->supplier_id;
                    $supplierLedger->branch_id =  $request->branch_id;
                    $supplierLedger->account_id =  $request->chart_of_account_id;
                    $supplierLedger->payment_type = $request->payment_type;
                    $supplierLedger->credit = $request->paid_amount;
                    $supplierLedger->updated_by = Auth::user()->id;
                    $supplierLedger->save();
                } else {
                    $supplierLedger = new SupplierLedger();
                    $supplierLedger->date = $request->date;
                    $supplierLedger->purchase_id = $purchases_id;
                    $supplierLedger->supplier_id = $request->supplier_id;
                    $supplierLedger->branch_id =  $request->branch_id;
                    $supplierLedger->account_id =  $request->chart_of_account_id;
                    $supplierLedger->payment_type = $request->payment_type;
                    $supplierLedger->debit = array_sum($request->total);
                    $supplierLedger->updated_by = Auth::user()->id;
                    $supplierLedger->save();
                }
            }

            if ($request->payment_type == 'cash') {
                $transection['date'] = $request->date;
                $transection['account_id'] = $request->chart_of_account_id;
                $transection['payment_id'] = $purchases_id;
                $transection['branch_id'] = $request->branch_id;
                $transection['type'] =  11;
                $transection['note'] = $request->note;
                $transection['amount'] =  array_sum($request->total) - $request->discount;
                $transection['credit'] = array_sum($request->total) - $request->discount;
                Transection::where('payment_id', $purchases_id)->where('type', 11)->update($transection);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            redirect('inventory-purchase-create')->with('error', 'Something Wrong Please try again');
        }
        return $purchase;
    }

    public function statusUpdate($id, $status)
    {
        $purchase = $this->purchases::find($id);
        $purchase->status = $status;
        $purchase->save();
        return $purchase;
    }

    public function destroy($id)
    {
        $purchase = $this->purchases::find($id);
        if ($purchase->status == "Accepted") {
            session()->flash('error', "Sorry, you couldn't delete!!");
            return false;
        } else {
            $purchase->forceDelete();
            PurchasesDetails::where('purchases_id', $id)->forceDelete();
            SupplierLedger::where('purchase_id', $id)->delete();
            Transection::where('payment_id', $id)->where('type', 11)->forceDelete();
            $purchaseorder['status'] = "Pending";
            PurchaseOrder::where('id', $purchase->purchase_order_id)->update($purchaseorder);
            return true;
        }

        return true;
    }
}
