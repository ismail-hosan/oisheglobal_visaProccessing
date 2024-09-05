<?php

namespace App\Repositories\Sale;

use App\Helpers\Helper;
use App\Models\Brand;
use App\Models\customerLedger;
use App\Models\Sale;
use App\Models\sales_Details;
use App\Models\Stock;
use App\Models\StockSummary;
use App\Models\Transection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleRepositories
{

    /**
     * @var user_id
     */
    private $user_id;

    /**
     * @var Brand
     */
    private $Sale;

    /**
     * CourseRepository constructor.
     * @param brand $esale
     */
    public function __construct(Sale $sales)
    {
        $this->Sale = $sales;
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
        $result = $this->Sale::latest()->get();
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

        $edit = Helper::roleAccess('sale.sale.edit') ? 1 : 0;
        $delete = Helper::roleAccess('sale.sale.destroy') ? 1 : 0;
        $view = Helper::roleAccess('sale.sale.show') ? 1 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->Sale::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $auth = Auth::user();
        if (empty($request->input('search.value'))) {
            $Sale = $this->Sale::offset($start);
            if ($auth->branch_id !== null) {
                $Sale = $Sale->where('branch_id', $auth->branch_id);
            }
            $Sale = $Sale->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->Sale::count();
        } else {
            $search = $request->input('search.value');
            $Sale = $this->Sale::where('invoice_no', 'like', "%{$search}%");
            if ($auth->branch_id !== null) {
                $Sale = $Sale->where('branch_id', $auth->branch_id);
            }
            $Sale = $Sale->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = $this->Sale::where('invoice_no', 'like', "%{$search}%")->count();
        }

        $data = array();
        if ($Sale) {
            foreach ($Sale as $key => $esale) {
                $nestedData['id'] = $key + 1;
                $nestedData['invoice_no'] = $esale->invoice_no;
                $nestedData['date'] = $esale->date;
                $nestedData['branch_id'] = $esale->branch->branchCode . ' - ' . $esale->branch->name;
                if (!empty($esale->customer_id)) {
                    $nestedData['customer_id'] = $esale->customer->customerCode . ' _ ' . $esale->customer->name;
                } else {
                    $nestedData['customer_id'] = '';
                }


                $nestedData['sub_total'] = $esale->sub_total;
                $nestedData['discount'] = $esale->discount;
                $nestedData['net_total'] = $esale->net_total;
                $nestedData['partialPayment'] = $esale->partialPayment;
                $nestedData['grand_total'] = $esale->grand_total;
                // if ($esale->sale_type == 'Regular') {
                //     $nestedData['sale_type'] = '<span class="btn btn-info">' . $esale->sale_type . '</span>';
                // } else {
                //     $nestedData['sale_type'] = '<span class="btn btn-success">' . $esale->sale_type . '</span>';
                // }

                //  $nestedData['sale_type'] = $esale->sale_type;

                if ($ced != 0 && $esale->sale_type == 'Regular') :
                    if ($edit != 0) {
                        $edit_data = '<a href="' . route('sale.sale.edit', $esale->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    } else {
                        $edit_data = '';
                    }

                    if ($view = !0) {
                        $view_data = '<a href="' . route('sale.sale.show', $esale->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    } else {
                        $view_data = '';
                    }

                    if ($delete != 0) {
                        $delete_data = '<a delete_route="' . route('sale.sale.destroy', $esale->id) . '" delete_id="' . $esale->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $esale->id . '"><i class="fa fa-times"></i></a>';
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
        $result = $this->Sale::find($id);
        return $result;
    }

    public function store($request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $esale = new $this->Sale();
            $esale->invoice_no = $request->invoice_no;
            $esale->date = $request->date;
            // $esale->account_id = $request->account_id ? $request->account_id : '';
            $esale->branch_id = $request->branch_id;
            $esale->customer_id = $request->customer_id;
            $esale->payment_type = $request->payment_type;
            $esale->qty = array_sum($request->qty);
            $esale->sub_total = array_sum($request->total);
            $esale->discount = $request->discount;
            $esale->net_total = array_sum($request->total) - $request->discount;
            $esale->partialPayment = $request->partialPayment;
            $esale->grand_total = array_sum($request->total) - $request->partialPayment - $request->discount;
            $esale->narration = $request->narration;
            $esale->created_by = Auth::user()->id;
            $esale->save();
            $Sale_id = $esale->id;

            $category_id = $request->catName;
            $proName = $request->proName;
            $subtotal = $request->unitprice;
            $grand_total = $request->total;
            $qty = $request->qty;

            for ($i = 0; $i < count($category_id); $i++) {
                $esaleDetail = new sales_Details();
                $esaleDetail->product_id = $proName[$i];
                $esaleDetail->qty = $qty[$i];
                $esaleDetail->category_id = $category_id[$i];
                $esaleDetail->branch_id = $request->branch_id;
                $esaleDetail->rate = $subtotal[$i];
                $esaleDetail->price = $grand_total[$i];
                $esaleDetail->Sale_id = $Sale_id;
                $esaleDetail->date = $request->date;
                $esaleDetail->save();

                $stock = new Stock();
                $stock->product_id = $proName[$i];
                $stock->quantity = $qty[$i];
                $stock->branch_id = $request->branch_id;
                $stock->unit_price = $subtotal[$i];
                $stock->total_price = $grand_total[$i];
                $stock->general_id = $Sale_id;
                $stock->date = $request->date;
                $stock->status = 'Sale';
                $stock->save();

                $existingCheck = StockSummary::where('product_id', $proName[$i])->first();
                if (!empty($existingCheck->quantity) && $existingCheck->quantity > 0) :
                    $newQty = $existingCheck->quantity - $qty[$i];
                    StockSummary::where('product_id', $proName[$i])->update(array('quantity' => $newQty));
                endif;
            }

            if ($request->payment_type == 'Cash') {
                $customerLedger = new customerLedger();
                $customerLedger->date = $request->date;
                $customerLedger->sale_id = $Sale_id;
                $customerLedger->customer_id = $request->customer_id;
                // $customerLedger->branch_id = $request->account_branch_id;
                $customerLedger->branch_id = $request->branch_id;
                $customerLedger->payment_type = $request->payment_type;
                $customerLedger->account_id = $request->account_id;
                // $customerLedger->discount = $request->discount;
                $customerLedger->debit = array_sum($request->total);
                // $customerLedger->total_pay = $request->partialPayment;
                // $customerLedger->total_due = array_sum($request->total) - $request->partialPayment - $request->discount;
                // $customerLedger->amount = $grand_total;
                $customerLedger->save();


                $customerLedger = new customerLedger();
                $customerLedger->date = $request->date;
                $customerLedger->sale_id = $Sale_id;
                $customerLedger->customer_id = $request->customer_id;
                // $customerLedger->branch_id = $request->account_branch_id;
                $customerLedger->branch_id = $request->branch_id;
                $customerLedger->payment_type = $request->payment_type;
                $customerLedger->account_id = $request->account_id;
                // $customerLedger->discount = $request->discount;
                $customerLedger->credit = array_sum($request->total);
                // $customerLedger->total_pay = $request->partialPayment;
                // $customerLedger->total_due = array_sum($request->total) - $request->partialPayment - $request->discount;
                // $customerLedger->amount = $grand_total;
                $customerLedger->save();
            } else {
                $customerLedger = new customerLedger();
                $customerLedger->date = $request->date;
                $customerLedger->sale_id = $Sale_id;
                $customerLedger->customer_id = $request->customer_id;
                // $customerLedger->branch_id = $request->account_branch_id;
                $customerLedger->branch_id = $request->branch_id;
                $customerLedger->payment_type = $request->payment_type;
                $customerLedger->account_id = $request->account_id;
                // $customerLedger->discount = $request->discount;
                // $customerLedger->amount = array_sum($request->total);
                $customerLedger->credit = array_sum($request->total);
                // $customerLedger->total_due = array_sum($request->total) - $request->partialPayment - $request->discount;
                // $customerLedger->amount = $grand_total;
                $customerLedger->save();
            }



            if ($request->payment_type == 'Cash') {
                $transection = new Transection();
                $transection->date = $request->date;
                $transection->account_id = $request->account_id;
                $transection->payment_id = $Sale_id;
                $transection->branch_id = $request->branch_id;
                $transection->type = 11;
                // $transection->to_account =  $request->account_id;
                $transection->note = $request->narration;
                $transection->amount = array_sum($request->total) - $request->discount;
                $transection->debit = array_sum($request->total) - $request->discount;
                $transection->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            redirect('inventory-purchase-create')->with('error', 'Something Wrong Please try again');
        }
        return $esale;
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $esale = $this->Sale::find($id);
            $esale->invoice_no = $request->invoice_no;
            $esale->date = $request->date;
            $esale->account_id = $request->account_id ? $request->account_id : '';
            $esale->branch_id = $request->branch_id;
            $esale->customer_id = $request->customer_id;
            $esale->payment_type = $request->payment_type;
            $esale->qty = array_sum($request->qty);
            $esale->sub_total = array_sum($request->total);
            $esale->discount = $request->discount;
            $esale->net_total = array_sum($request->total) - $request->discount;
            $esale->partialPayment = $request->partialPayment;
            $esale->grand_total = array_sum($request->total) - $request->partialPayment - $request->discount;
            $esale->narration = $request->narration;
            $esale->updated_by = Auth::user()->id;
            $esale->save();
            $Sale_id = $esale->id;

            $category_id = $request->catName;
            $proName = $request->proName;
            $subtotal = $request->unitprice;
            $grand_total = $request->total;
            $qty = $request->qty;
            $slDetails = sales_Details::where('sale_id', $id)->get();
            foreach ($slDetails as $slDetail) {
                $quantitys =  StockSummary::where('product_id', $slDetail->product_id)->pluck('quantity')->first();
                $stocksum['quantity'] = abs($quantitys + $slDetail->qty);
                StockSummary::where('product_id', $slDetail->product_id)->update($stocksum);
            }
            Stock::where('general_id', $id)->Where('status', 'Sale')->forceDelete();
            sales_Details::where('sale_id', $id)->delete();

            for ($i = 0; $i < count($category_id); $i++) {
                $esaleDetail = new sales_Details();
                $esaleDetail->product_id = $proName[$i];
                $esaleDetail->qty = $qty[$i];
                $esaleDetail->category_id = $category_id[$i];
                $esaleDetail->branch_id = $request->branch_id;
                $esaleDetail->rate = $subtotal[$i];
                $esaleDetail->price = $grand_total[$i];
                $esaleDetail->Sale_id = $Sale_id;
                $esaleDetail->date = $request->date;
                $esaleDetail->save();

                $stock = new Stock();
                $stock->product_id = $proName[$i];
                $stock->quantity = $qty[$i];
                $stock->branch_id = $request->branch_id;
                $stock->unit_price = $subtotal[$i];
                $stock->total_price = $grand_total[$i];
                $stock->general_id = $Sale_id;
                $stock->date = $request->date;
                $stock->status = 'Sale';
                $stock->save();

                $existingCheck = StockSummary::where('product_id', $proName[$i])->first();
                if (!empty($existingCheck->quantity) && $existingCheck->quantity > 0) :
                    $newQty = $existingCheck->quantity - $qty[$i];
                    StockSummary::where('product_id', $proName[$i])->update(array('quantity' => $newQty));
                endif;
            }

            $customerLedger['date'] = $request->date;
            $customerLedger['sale_id'] = $Sale_id;
            $customerLedger['customer_id'] = $request->customer_id;
            $customerLedger['account_branch_id'] = $request->account_branch_id;
            $customerLedger['customer_branch_id'] = $request->branch_id;
            $customerLedger['payment_type'] = $request->payment_type;
            $customerLedger['account_id'] = $request->account_id;
            $customerLedger['discount'] = $request->discount;
            $customerLedger['amount'] = array_sum($request->total);
            $customerLedger['total_pay'] = $request->partialPayment;
            $customerLedger['total_due'] = array_sum($request->total) - $request->partialPayment - $request->discount;
            // $customerLedger->amount = $grand_total;
            customerLedger::where('sale_id', $id)->update($customerLedger);

            if ($request->payment_type == 'Cash') {
                $transection['date'] = $request->date;
                $transection['account_id'] = $request->account_id;
                $transection['payment_id'] = $Sale_id;
                $transection['branch_id'] = $request->branch_id;
                $transection['type'] = 11;
                // $transection->to_account =  $request->account_id;
                $transection['note'] = $request->narration;
                $transection['amount'] = array_sum($request->total) - $request->discount;
                $transection['debit'] = array_sum($request->total) - $request->discount;
                Transection::where('type', 11)->orWhere('payment_id', $id)->update($transection);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            redirect('inventory-purchase-create')->with('error', 'Something Wrong Please try again');
        }
        return $esale;
    }

    public function statusUpdate($id, $status)
    {
        $esale = $this->Sale::find($id);
        $esale->status = $status;
        $esale->save();
        return $esale;
    }

    public function destroy($id)
    {
        $esale = $this->Sale::find($id);
        $esale->delete();
        return true;
    }
}
