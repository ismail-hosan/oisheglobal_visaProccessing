<?php

namespace App\Repositories\Settings;

use App\Helpers\Helper;
use App\Models\Opening;
use App\Models\Transection;
use Illuminate\Support\Facades\Auth;

class OpeningRepositories
{
    /**
     * @var user_id
     */
    private $user_id;
    /**
     * @var Opening
     */
    private $Transection;
    /**
     * CourseRepository constructor.
     * @param opening $opening
     */
    public function __construct(Transection $Transection)
    {
        $this->Transection = $Transection;
        //$this->middleware(function ($request, $next) {
        $this->user_id = 1; //auth()->user()->id;
        //  return $next($request);
        //});
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllOpening()
    {
        return $this->Transection::get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getList($request)
    {

        $columns = array(
            0 => 'id',
            1 => 'amount',
        );

        $edit = Helper::roleAccess('settings.openingbalance.edit') ? 1 : 0;
        $delete = Helper::roleAccess('settings.openingbalance.destroy') ? 1 : 0;
        $view = Helper::roleAccess('settings.openingbalance.show') ? 0 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->Transection::count();
        // dd($totalData);
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $Transection = $this->Transection::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->where('type', 1)
                ->get();
            $totalFiltered = $this->Transection::count();
        } else {
            $search = $request->input('search.value');
            $Transection = $this->Transection::where('account_id', 'like', "%{$search}%")->orWhere('amount', 'like', "%{$search}%")->orWhere('date', 'like', "%{$search}%")->orWhere('branch_id', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->where('type', 1)
                ->get();
            $totalFiltered = $this->Transection::where('amount', 'like', "%{$search}%")->count();
        }

        $data = array();
        if ($Transection) {
            foreach ($Transection as $key => $opening) {
                $nestedData['id'] = $key + 1;
                $nestedData['account_id'] = $opening->account->accountCode . ' - ' . $opening->account->account_name;
                $nestedData['amount'] = $opening->amount;
                $nestedData['note'] = $opening->note;
                $nestedData['date'] = $opening->date;
                $nestedData['branch_id'] = $opening->branch->branchCode . ' - ' . $opening->branch->name;
                //                if ($opening->status == 'Active') :
                //                    $status = '<input class="status_row" status_route="' . route('settings.openingbalance.status', [$opening->id, 'Inactive']) . '"   id="toggle-demo" type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                //                else :
                //                    $status = '<input  class="status_row" status_route="' . route('settings.openingbalance.status', [$opening->id, 'Active']) . '"  id="toggle-demo" type="checkbox" name="my-checkbox"  data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                //                endif;
                //                $nestedData['status'] = $status;

                if ($ced != 0) :
                    if ($edit != 0) {
                        $edit_data = '<a href="' . route('settings.openingbalance.edit', $opening->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    } else {
                        $edit_data = '';
                    }

                    if ($view != 0) {
                        $view_data = '<a href="' . route('settings.openingbalance.show', $opening->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    } else {
                        $view_data = '';
                    }

                    if ($delete != 0) {
                        $delete_data = '<a delete_route="' . route('settings.openingbalance.destroy', $opening->id) . '" delete_id="' . $opening->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $opening->id . '"><i class="fa fa-times"></i></a>';
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
        $result = $this->Transection::find($id);
        return $result;
    }

    public function store($request)
    {

        $transection = new transection();
        $transection->account_id = $request->to_account_id;
        $transection->branch_id = $request->branch_id;
        $transection->debit = $request->amount;
        $transection->amount = $request->amount;
        $transection->note = $request->note;
        $transection->date = $request->date;
        $transection->type = 1;
        $transection->created_by = Auth::user()->id;
        $transection->save();

        return $transection;
    }

    public function update($request, $id)
    {
        // dd($request->all());
        $transection = Transection::find($id);
        $transection->account_id = $request->to_account_id;
        $transection->branch_id = $request->branch_id;
        $transection->debit = $request->amount;
        $transection->amount = $request->amount;
        $transection->note = $request->note;
        $transection->date = $request->date;
        $transection->type = 1;
        $transection->created_by = Auth::user()->id;
        $transection->save();

        return $transection;
    }

    public function statusUpdate($id, $status)
    {
        $opening = $this->Transection::find($id);
        $opening->status = $status;
        $opening->save();
        return $opening;
    }

    public function destroy($id)
    {
        $opening = $this->Transection::find($id);
        $opening->delete();
        return true;
    }
}
