<?php

namespace App\Services\Visa;

use App\Repositories\Visa\VisaProcessingRepositories;

class VisaProcessingService
{

    
    private $systemRepositories;
    
    public function __construct(VisaProcessingRepositories $systemRepositories)
    {
        $this->systemRepositories = $systemRepositories;
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
    public function getList($request)
    {
        return $this->systemRepositories->getList($request);
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
            'id'                   => 'required',
            'status'               => 'required',
        ];
    }
    /**
     * @param $request
     * @return array
     */
    public function storeValidation($request)
    {

        return [
            "name" => 'required|string|max:255',
            "continent" => 'nullable|string|max:255',
            "image" => 'nullable|image',
            "description" => 'nullable|string',
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function updateValidation($request, $id)
    {
        return [
            "name" => 'required|string|max:255',
            "continent" => 'nullable|string|max:255',
            "image" => 'nullable|image',
            "description" => 'nullable|string',
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
