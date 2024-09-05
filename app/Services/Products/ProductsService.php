<?php

namespace App\Services\Products;

use App\Repositories\Products\ProductsRepositories;

class ProductsService
{

    /**
     * @var ProductsRepositories
     */
    private $systemRepositories;
    /**
     * AdminCourseService constructor.
     * @param ProductsRepositories $systemRepositories
     */
    public function __construct(ProductsRepositories $systemRepositories)
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
            "title" => 'required|string|max:255',
            "subtitle" => 'nullable|string|max:255',
            "description" => 'nullable|string',
            "tecnology" => 'nullable|string',
            "video_title" => 'nullable|string',
            "video_link" => 'nullable|string|max:100',
            "module_title" => 'nullable|string|max:100',
            "gallary_title" => 'nullable|string|max:100',
            "service_id" => 'nullable',
            "module_item.*" => 'nullable|string',
            "image.*" => 'nullable|image',
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function updateValidation($request, $id)
    {
        return [
            "title" => 'required|string|max:255',
            "service_id" => 'nullable',
            "subtitle" => 'nullable|string|max:255',
            "description" => 'nullable|string',
            "tecnology" => 'nullable|string',
            "video_title" => 'nullable|string',
            "video_link" => 'nullable|string|max:100',
            "module_title" => 'nullable|string|max:100',
            "gallary_title" => 'nullable|string|max:100',
            "module_item.*" => 'nullable|string',
            "image.*" => 'nullable|image',
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
