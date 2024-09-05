<?php

namespace App\Services\InventorySetup;

use App\Repositories\InventorySetup\GrnRepositories;

class GrnService
{


    private $systemRepositories;

    public function __construct(GrnRepositories $systemRepositories)
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
        // dd();
        return [
            'grnCode' => 'required',
            'date' => 'required',
            'purchase_voucher' => 'required',
            'subblier_id' => 'required',
            'branch_id' => 'required',
            'category_nm' => 'required',
            'unitprice' => 'required',
            'total_price' => 'total',
            'product_nm' => 'required',
            'qty' => 'required',
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function updateValidation($request, $id)
    {
        return [
            'grnCode' => 'required',
            'date' => 'required',
            'purchase_voucher' => 'required',
            'subblier_id' => 'required',
            'branch_id' => 'required',
            'category_nm' => 'required',
            'product_nm' => 'required',
            'qty' => 'required',
        ];
    }

    public function approveValidation($request, $id)
    {
        return [
            'date' => 'required',
            'branch_id' => 'required',
            'category_nm' => 'required',
            'product_nm' => 'required',
            'qty' => 'required',
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
