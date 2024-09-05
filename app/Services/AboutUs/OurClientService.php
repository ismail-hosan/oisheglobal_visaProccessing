<?php

namespace App\Services\AboutUs;

use App\Repositories\AboutUs\OurClientRepositories;

class OurClientService
{

    /**
     * @var Our Client
     */
    private $systemRepositories;

    /**
     * AdminCourseService constructor.
     * @param Our Client 
     */
    public function __construct(OurClientRepositories $systemRepositories)
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
            'type' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'name' => 'required',
            'alt' => 'nullable|string',

        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function updateValidation($request)
    {
        return [
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'name' => 'required',
            'alt' => 'nullable|string',
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
