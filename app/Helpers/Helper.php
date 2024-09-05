<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Branch;
use App\Models\Navigation;
use App\Models\project;
use App\Models\Projectimage;
use DB;

class Helper
{

    /**
     * This method is for get current user role name
     * @return string
     */

    public static function getUserRole()
    {
        $roleInfo =  User::select('user_roles.role_name')->join('role_accesses', 'users.id', 'role_accesses.user_id')
            ->join('user_roles', 'user_roles.id', 'role_accesses.role_id')
            ->where('users.id', self::userId())->first();

        return $roleInfo->role_name ?? '';
    }
    /**
     * This method is for get current  user role access list
     * @return string
     */
    public static function getRoleAccessNavigation()
    {
        $roleInfo =  User::select('user_roles.navigation_id')
            ->join('role_accesses', 'users.id', 'role_accesses.user_id')
            ->join('user_roles', 'user_roles.id', 'role_accesses.role_id')
            ->where('users.id', self::userId())->first();
        return $roleInfo->navigation_id ?? '';
    }

    /**
     * This method is for get current admin user details
     * @return object
     */
    public static function getRoleAccessParent()
    {
        $roleInfo =  User::select('user_roles.parent_id')
            ->join('role_accesses', 'users.id', 'role_accesses.user_id')
            ->join('user_roles', 'user_roles.id', 'role_accesses.role_id')
            ->where('users.id', self::userId())->first();
        return $roleInfo->parent_id ?? '';
    }


    /**
     * This method is for get current admin user details
     * @return object
     */
    public static function getMenuParent(string $route)
    {
        $routeChildInfo =  Navigation::where('route', $route)->first();
        if (!empty($routeChildInfo))
            $routeSubMenuInfo =  Navigation::where('id', $routeChildInfo->parent_id)->first();
        if (!empty($routeSubMenuInfo))
            $routeParentInfo =  Navigation::where('id', $routeSubMenuInfo->parent_id)->first();
        if (!empty($routeParentInfo))
            return str_replace(" ", "_", $routeParentInfo->label);
    }



    /**
     * This method is for get current admin user details
     * @return object
     */
    public static function getRoleRootList()
    {
        $roleInfo =  Navigation::select('parent_id')->whereIn('id', explode(",", self::getRoleAccessParent()))->distinct()->get();
        $rootList = array();
        foreach ($roleInfo as $key => $eachRole) :
            array_push($rootList, $eachRole->parent_id);
        endforeach;
        return $rootList ?? '';
    }

    /**
     * This method is for get current admin user details
     * @return object
     */
    public static function getUserNavigations()
    {
        $allNavigation =  Navigation::whereIn('id', explode(",", self::getRoleAccessNavigation()))->get();
        return $allNavigation ?? '';
    }


    /**
     * This method is for get current admin user details
     * @return object
     */
    public static function roleAccess(string $route)
    {
   
        $allNavigation = self::getUserNavigations();

        $accessExits = $allNavigation->where('route', $route);
// dd($route);
        if (count($accessExits) > 0) {
           
            return true;
        } else {
      
            return false;
        }
    }

    /**
     * This method is for get current admin user details
     * @return object
     */
    public static function getRoleAccessBranch()
    {
        $roleInfo =  User::select('user_roles.branch_id')
            ->join('role_accesses', 'users.id', 'role_accesses.user_id')
            ->join('user_roles', 'user_roles.id', 'role_accesses.role_id')
            ->where('users.id', self::userId())->first();

        return $roleInfo->branch_id ?? '';
    }

    /**
     * This method is for get current admin user details
     * @return object
     */
    public static function userBranch()
    {


        $branchList =  Branch::whereIn('id', explode(",", self::getRoleAccessBranch()))->get();
        return $branchList ?? '';
    }

    /**
     * This method is for get current admin user details
     * @return object
     */
    public static function userDetails()
    {
        if (auth()->check()) {
            return auth()->user();
        }
    }

    /**
     *  This method will provide curret user id
     * @return int id
     */
    public static function userId()
    {
        if (isset(self::userDetails()['id'])) {
            return self::userDetails()['id'];
        } else {
            return 0;
        }
    }

    /**
     *  This method will provide curret username
     * @return string username
     */
    public static function userFullname()
    {
        return self::userDetails()['name'];
    }
    /**
     *  This method will provide curret user email
     * @return string email
     */
    public static function userEmail()
    {
        return self::userDetails()['email'];
    }

    public static function getProject($id,$type = null){
        $project = Projectimage::where('status','Active')->where("project_id",$id);
        if($type){
            $project =  $project->where("type",$type);
        }
        $project =  $project->get();
        return $project;
    }
}