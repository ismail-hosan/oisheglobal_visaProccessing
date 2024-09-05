<?php

namespace App\Services\AboutUs;

use App\Repositories\AboutUs\AboutusRepositories;

class AboutusService
{

    /**
     * @var AboutusRepositories
     */
    private $systemRepositories;
    /**
     * AdminCourseService constructor.
     * @param AboutusRepositories $systemRepositories
     */
    public function __construct(AboutusRepositories $systemRepositories)
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
            "image" => 'nullable|image',
            "icon" => 'nullable|image',
            "tagline" => 'required|string|max:100',
            "description" => 'required|string',
            "m_title" => 'required|string|max:100',
            "m_icon" => 'nullable|image',
            "mission" => 'required|string',
            "v_title" => 'required|string',
            "v_icon" => 'nullable|string',
            "vision" => 'required|string',
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
            "image" => 'nullable|image',
            "icon" => 'nullable|image',
            "tagline" => 'required|string|max:100',
            "description" => 'required|string',
            "m_title" => 'required|string|max:100',
            "m_icon" => 'nullable|image',
            "mission" => 'required|string',
            "v_title" => 'required|string',
            "v_icon" => 'nullable|string',
            "vision" => 'required|string',
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
