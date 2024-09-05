<?php

namespace App\Repositories\Project;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\Opening;
use Illuminate\Support\Facades\DB;
use App\Models\ExpenseCategory;
use App\Models\ProjectExpense;
use App\Models\Transection;
use App\Models\Project;

use phpDocumentor\Reflection\PseudoTypes\False_;

class ProjectExpenseRepositories
{
    /**
     * @var user_id
     */
    private $user_id;
    /**
     * @var Opening
     */
    private $ProjectExpense;
    /**
     * CourseRepository constructor.
     * @param opening $opening
     */
    public function __construct(ProjectExpense $ProjectExpense)
    {
        $this->ProjectExpense = $ProjectExpense;
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
        return  $this->ProjectExpense::get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getList($request)
    {
        $userid = auth()->user()->id;
        $usertype = auth()->user()->type;

        if ($usertype == 'Project') {
            $projectDetails = Project::where('manager_id', $userid)->firstOrFail();
        } else {
            $projectDetails = '';
        }

        $user = Auth::user();
        $project = Project::where('manager_id', $user->id)->pluck('condition')->first();
        $condition = $project ? $project : "Complete";

        $columns = array(
            0 => 'id',
            1 => 'amount',
        );

        $edit = Helper::roleAccess('project.projectexpense.edit') && $condition !== "Complete"  ? 1 : 0;
        $delete = Helper::roleAccess('project.projectexpense.destroy') && $condition !== "Complete" ? 1 : 0;
        $view = Helper::roleAccess('project.projectexpense.show') ? 0 : 0;
        $ced = $edit + $delete + $view;

        $totalData = $this->ProjectExpense::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if ($usertype == 'Project') {

            if (empty($request->input('search.value'))) {
                $ProjectExpense = $this->ProjectExpense::offset($start)
                    ->where('project_id', $projectDetails->id)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
                $totalFiltered = $this->ProjectExpense::count();
            } else {
                $search = $request->input('search.value');
                $ProjectExpense = $this->ProjectExpense::where('amount', 'like', "%{$search}%")
                    ->where('project_id', $projectDetails->id)
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
                $totalFiltered = $this->ProjectExpense::where('amount', 'like', "%{$search}%")->count();
            }
        } else {

            if (empty($request->input('search.value'))) {
                $ProjectExpense = $this->ProjectExpense::offset($start)

                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
                $totalFiltered = $this->ProjectExpense::count();
            } else {
                $search = $request->input('search.value');
                $ProjectExpense = $this->ProjectExpense::where('amount', 'like', "%{$search}%")

                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
                $totalFiltered = $this->ProjectExpense::where('amount', 'like', "%{$search}%")->count();
            }
        }




        $data = array();
        if ($ProjectExpense) {
            foreach ($ProjectExpense as $key => $expens) {
                // dd($expens->projects);
                $nestedData['id'] = $key + 1;
                $nestedData['project_id'] = $expens->projects->name;
                $nestedData['categorie_id'] = $expens->expenseCategory->name;
                $nestedData['subcategorie_id'] = $expens->subCategory->name;
                $nestedData['amount'] = $expens->amount;
                $nestedData['note'] = $expens->note;

                if ($ced != 0) :

                    if ($edit != 0)
                        $edit_data = '<a href="' . route('project.projectexpense.edit', $expens->id) . '" class="btn btn-xs btn-default"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                    else
                        $edit_data = '';
                    if ($view != 0)
                        $view_data = '<a href="' . route('project.projectexpense.show', $expens->id) . '" class="btn btn-xs btn-default"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                    else
                        $view_data = '';
                    if ($delete != 0)
                        $delete_data = '<a delete_route="' . route('project.projectexpense.destroy', $expens->id) . '" delete_id="' . $expens->id . '" title="Delete" class="btn btn-xs btn-default delete_row uniqueid' . $expens->id . '"><i class="fa fa-times"></i></a>';
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
        $result = $this->ProjectExpense::find($id);
        return $result;
    }

    public function store($request)
    {
        //         dd($projectDetails->id);

        // dd($request->all());


        $ProjectExpense = new ProjectExpense();
        $ProjectExpense->categorie_id = $request->category_id;
        $ProjectExpense->subcategorie_id = $request->subcategory_id;
        $ProjectExpense->project_id = $request->project_id;
        $ProjectExpense->date = $request->date;
        $ProjectExpense->amount = $request->amount;
        $ProjectExpense->note = $request->note;
        $ProjectExpense->save();


        // $transection = new transection();
        // $transection->account_id = $request->account_id;
        // $transection->branch_id = $request->branch_id;
        // $transection->credit = $request->amount;
        // $transection->amount = $request->amount;
        // $transection->note = $request->note;
        // $transection->date = $request->date;
        // $transection->payment_id = $ProjectExpense->id;
        // $transection->type = 4;
        // $transection->user_id = Auth::user()->id;
        // $transection->created_by = Auth::user()->id;
        // $transection->save();

        return $ProjectExpense;
    }

    public function update($request, $id)
    {
        // $ProjectExpense = [
        //     'caterorie_id'=>$request->category_id,
        //     'sub_caterorie_id'=>$request->sub_caterorie_id,
        //     'project_id'=>$request->project_id,
        //     'date'=>$request->date,
        //     'amount'=>$request->amount,
        //     'note'=>$request->note,
        // ];
        // DB::table('ProjectExpenses')->where('id',$id)->update($ProjectExpense);

        $ProjectExpense = ProjectExpense::find($id);
        $ProjectExpense->categorie_id = $request->category_id;
        $ProjectExpense->subcategorie_id = $request->subcategory_id;
        $ProjectExpense->date = $request->date;
        $ProjectExpense->amount = $request->amount;
        $ProjectExpense->note = $request->note;
        $ProjectExpense->save();


        // $transection['account_id'] = $request->account_id;
        // $transection['branch_id'] = $request->branch_id;
        // $transection['credit'] = $request->amount;
        // $transection['amount'] = $request->amount;
        // $transection['note'] = $request->note;
        // $transection['date'] = $request->date;
        // $transection['updated_by'] = Auth::user()->id;
        // Transection::where('payment_id',$id)->orWhere('type',4)->update($transection);

        return $ProjectExpense;
    }

    public function statusUpdate($id, $status)
    {
        $opening = $this->ProjectExpense::find($id);
        $opening->status = $status;
        $opening->save();
        return $opening;
    }

    public function destroy($id)
    {
        $opening = $this->ProjectExpense::find($id);
        $opening->delete();
        Transection::where('type', 4)->where('payment_id', $id)->delete();
        return true;
    }
}
