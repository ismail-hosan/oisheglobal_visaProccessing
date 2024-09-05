<?php

namespace App\Services\Branch;

use App\Repositories\Branch\BranchUserRepositories;
use App\Rules\PhoneNumberValidationRules;
use Illuminate\Support\Facades\Validator;

class BranchUserService
{


    private $systemRepositories;


    public function __construct(BranchUserRepositories $systemRepositories)
    {
        $this->systemRepositories = $systemRepositories;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getList($request)
    {
        return $this->systemRepositories->getList($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getAllList()
    {
        return $this->systemRepositories->getAllList();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function statusUpdate($request, $id)
    {
        return $this->systemRepositories->statusUpdate($request, $id);
    }

    public function statusValidation($request)
    {

        return [
            'id' => 'required',
            'status' => 'required',
        ];
    }


    /**
     * @param $request
     * @return array
     */
    public function storeValidation($request)
    {
        return [
            'branch_id' => 'required',
            'address'=>'required',
            'name' => 'required|max:100|min:2',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password'=> 'required',
            'status' => 'nullable',
            
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function updateValidation($request, $id)
    {
        // dd($request->all());
        return [
            'branch_id' => 'required',
            'address'=>'required',
            'name' => 'required|max:100|min:2',
            'email' => 'required',
            'phone' => 'required',
            'status' => 'nullable',    
        ];
    }

    /**
     * @param $request
     * @return \App\Models\Currency
     */
    public function store($request)
    {
        return $this->systemRepositories->store($request);
    }

    /**
     * @param $request
     * @return \App\Models\Currency
     */
    public function details($id)
    {

        return $this->systemRepositories->details($id);
    }

    /**
     * @param $request
     * @param $id
     */
    public function update($request, $id)
    {
        return $this->systemRepositories->update($request, $id);
    }

    /**
     * @param $request
     * @param $id
     */
    public function destroy($id)
    {
        return $this->systemRepositories->destroy($id);
    }
}
