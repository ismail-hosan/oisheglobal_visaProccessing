<?php

namespace App\Services\project;

use App\Repositories\newproject\ProjectRepositories;


class ProjectService
{


    private $systemRepositoriess;
    
    public function __construct(ProjectRepositories $ProjectRepositories)
    {
        $this->systemRepositoriess = $ProjectRepositories;
    }
    /**
     * @param $request
     * @return mixed
     */

    public function getAllList()
    {
        return $this->systemRepositoriess->getAllList();
    }
    /**
     * @param $request
     * @return mixed
     */
    public function getList($request)
    {
        return $this->systemRepositoriess->getList($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function statusUpdate($request, $id)
    {
        return $this->systemRepositoriess->statusUpdate($request, $id);
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

            'name' => 'required',
            'phone'=> 'required',
            'orderby' => 'required',
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function updateValidation($request, $id)
    {
        return [
            'name' => 'required',
            'orderby' => 'required',
        ];
    }

    /**
     * @param $request
     * @return \App\Models\Currency
     */
    public function store($request)
    {
        return $this->systemRepositoriess->store($request);
    }

    /**
     * @param $request
     * @return \App\Models\Currency
     */
    public function details($id)
    {

        return $this->systemRepositoriess->details($id);
    }


    /**
     * @param $request
     * @param $id
     */
    public function update($request, $id)
    {
        return $this->systemRepositoriess->update($request, $id);
    }

    

    /**
     * @param $request
     * @param $id
     */
    public function destroy($id)
    {
        return $this->systemRepositoriess->destroy($id);
    }
}
