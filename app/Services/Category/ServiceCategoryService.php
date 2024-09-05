<?php

namespace App\Services\Category;

use App\Repositories\Category\ServiceCategoryRepositories;


class ServiceCategoryService
{

    /**
     * @var ProjectRepositories
     */
    private $systemRepositories;

    /**
     * AdminCourseService constructor.
     * @param ProjectRepositories $branchRepositories
     */
    public function __construct(ServiceCategoryRepositories $systemRepositories)
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
            'title' => 'required',

        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function updateValidation($request, $id)
    {
        return [
            'title' => 'required',

        ];
    }

    /**
     * @param $request
     * @return \App\Models\Currency
     */
    public function store($request)
    {
        // dd($request->all());
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
