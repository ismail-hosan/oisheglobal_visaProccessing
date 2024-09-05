<?php

namespace App\Http\Controllers\Backend\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;


use App\Models\User;
use App\Models\UserRole;
use App\Models\VisaDataModel;
use App\Models\VisaProcesing;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $visasApplications = VisaDataModel::where("user_id",$user->id)->orWhere("refarence_id",$user->id)->get();

        $visasApplicationsadmin = VisaDataModel::get();

        $agents = User::where("type","Agent")->count();

        $customers = User::where("type","Customer")->count();

        $commission = VisaDataModel::where("refarence_id",$user->id)->sum('commission');
        $totalCommission = VisaDataModel::sum('commission');

        $user = User::with('branchData')->find(Auth::user()->id);

        $visasApplicationsBranch = VisaDataModel::where("branch_id", auth()->user()->branch_id)->get();
        $customersbranch = User::where("type","Customer")->where("branch_id", auth()->user()->branch_id)->count();
        $agenetbranch = User::where("type","Agent")->where("branch_id", auth()->user()->branch_id)->count();
        $agenetbranchlist = User::where("type","Agent")->where("branch_id", auth()->user()->branch_id)->pluck("id");
        $branchcommission = VisaDataModel::whereIn("refarence_id",$agenetbranchlist)->sum('commission');
        
        return view('backend_extra_path.pages.dashboard.index', get_defined_vars());
    }
}
