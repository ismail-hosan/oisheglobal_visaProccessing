<?php

namespace App\Services\Blog;

use App\Repositories\Blog\BlogRepositories;

class BlogService
{

    /**
     * @var BlogRepositories
     */
    private $blogRepositories;
    /**
     * AdminCourseService constructor.
     * @param BlogRepositories $blogRepositories
     */
    public function __construct(BlogRepositories $blogRepositories)
    {
        $this->blogRepositories = $blogRepositories;
    }
    /**
     * @param $request
     * @return mixed
     */

    public function getAllList()
    {
        return $this->blogRepositories->getAllList();
    }
    /**
     * @param $request
     * @return mixed
     */
    public function getList($request)
    {
        return $this->blogRepositories->getList($request);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function statusUpdate($request, $id)
    {
        return $this->blogRepositories->statusUpdate($request, $id);
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
            "category_id" => 'nullable|string|max:255',
            "image" => 'nullable|image|max:1000',
            "short_description" => 'nullable|string',
            "description" => 'nullable|string',
        ];
    }

    /**
     * @return array
     */
    public function updateValidation($request, $id)
    {
        return [
            "title" => 'required|string|max:255',
            "category_id" => 'nullable|string|max:255',
            "image" => 'nullable|image|max:1000',
            "short_description" => 'nullable|string',
            "description" => 'nullable|string',
        ];
    }

    /**
     * @param $request
     * @return \App\Models\Currency
     */
    public function store($request)
    {
        return $this->blogRepositories->store($request);
    }

    /**
     * @param $request
     * @return \App\Models\Currency
     */
    public function details($id)
    {

        return $this->blogRepositories->details($id);
    }


    /**
     * @param $request
     * @param $id
     */
    public function update($request, $id)
    {
        return $this->blogRepositories->update($request, $id);
    }


    /**
     * @param $request
     * @param $id
     */
    public function destroy($id)
    {
        return $this->blogRepositories->destroy($id);
    }
}
