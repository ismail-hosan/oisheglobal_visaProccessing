<?php

namespace App\Services\InventorySetup;

use App\Repositories\InventorySetup\PurchaseRepositories;
use App\Rules\PhoneNumberValidationRules;
use Illuminate\Support\Facades\Validator;

class PurchaseService
{

    /**
     * @var PurchaseRepositories
     */
    private $systemRepositories;

    /**
     * AdminCourseService constructor.
     * @param PurchaseRepositories $branchRepositories
     */
    public function __construct(PurchaseRepositories $systemRepositories)
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
    public function getpvList($request)
    {
        return $this->systemRepositories->getpvList($request);
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
        // dd($request->all());
        return [
            'date' => 'required',
            'invoice_no' => 'required',
            'branch_id' => 'required',
            'supplier_id' => 'required',
            'status' => 'nullable',
        ];
    }


    public function prstoreValidation($request)
    {
        // dd($request->all());
        return [
            'date' => 'required',
            'invoice_no' => 'required',
            'branch_id' => 'required',
            'supplier_id' => 'required',
            'status' => 'nullable',
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function updateValidation($request, $id)
    {
        return [
            // 'name' => 'required|max:100|min:2',
            'date' => 'required',
            // 'invoice_no' => 'required',
            'branch_id' => 'required',
            'supplier_id' => 'required',
            'status' => 'nullable',
        ];
    }

    public function pvupdateValidation($request, $id)
    {
        return [
            // 'name' => 'required|max:100|min:2',
            'date' => 'required',
            // 'invoice_no' => 'required',
            'branch_id' => 'required',
            'supplier_id' => 'required',
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

    public function prstore($request)
    {
        return $this->systemRepositories->prstore($request);
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

    public function pvupdate($request, $id)
    {
        return $this->systemRepositories->pvupdate($request, $id);
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
