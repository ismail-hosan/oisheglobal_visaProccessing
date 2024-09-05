<?php

namespace App\Services\Career;

use App\Repositories\Career\CareerRepositories;

class CareerService
{

    /**
     * @var CareerRepositories
     */
    private $careerRepositories;
    /**
     * AdminCourseService constructor.
     * @param CareerRepositories $careerRepositories
     */
    public function __construct(CareerRepositories $careerRepositories)
    {
        $this->careerRepositories = $careerRepositories;
    }
    /**
     * @param $request
     * @return mixed
     */

    public function getAllList()
    {
        return $this->careerRepositories->getAllList();
    }
    /**
     * @param $request
     * @return mixed
     */
    public function getList($request)
    {
        return $this->careerRepositories->getList($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function statusUpdate($request, $id)
    {
        return $this->careerRepositories->statusUpdate($request, $id);
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
            "vacancy" => 'nullable|string|max:255',
            "email" => 'nullable|string|max:255',
            "short_description" => 'required|string|max:255',
            "description" => 'required|string',
            "meta" => 'required|string',
            "published_at" => 'nullable|string|max:255',
            "employment_status" => 'nullable|string|max:255',
            "experience" => 'nullable|string|max:255',
            "gender" => 'nullable|string|max:255',
            "job_location" => 'nullable|string|max:255',
            "salary" => 'nullable|string|max:255',
            "application_deadline" => 'nullable|string|max:255',
        ];
    }

    /**
     * @return array
     */
    public function updateValidation($request, $id)
    {
        return [
            "title" => 'required|string|max:255',
            "vacancy" => 'nullable|string|max:255',
            "email" => 'nullable|string|max:255',
            "short_description" => 'required|string|max:255',
            "description" => 'required|string',
            "published_at" => 'required|string|max:255',
            "employment_status" => 'nullable|string|max:255',
            "experience" => 'nullable|string|max:255',
            "gender" => 'nullable|string|max:255',
            "job_location" => 'nullable|string|max:255',
            "salary" => 'nullable|string|max:255',
            "application_deadline" => 'required|string|max:255',
            "meta" => 'required|string',
        ];
    }

    /**
     * @param $request
     * @return \App\Models\Currency
     */
    public function store($request)
    {
        return $this->careerRepositories->store($request);
    }

    /**
     * @param $request
     * @return \App\Models\Currency
     */
    public function details($id)
    {

        return $this->careerRepositories->details($id);
    }


    /**
     * @param $request
     * @param $id
     */
    public function update($request, $id)
    {
        return $this->careerRepositories->update($request, $id);
    }




    /**
     * @param $request
     * @param $id
     */
    public function destroy($id)
    {
        return $this->careerRepositories->destroy($id);
    }
}
