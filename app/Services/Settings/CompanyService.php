<?php

namespace App\Services\Settings;

use App\Repositories\Settings\CompanyRepositories;
use App\Rules\PhoneNumberValidationRules;
use Illuminate\Support\Facades\Validator;

class CompanyService
{

    /**
     * @var CompanyRepositories
     */
    private $systemRepositories;
    /**
     * AdminCourseService constructor.
     * @param CompanyRepositories $branchRepositories
     */
    public function __construct(CompanyRepositories $systemRepositories)
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
            'company_name'      => 'required|max:100|min:2',
            'logo'              => 'required|image|mimes:jpeg,png,jpg|max:1024',
            //    \\ 'favicon'           => 'required|mimes:ICO,ico|max:500',
            'invoice_logo'      => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'email'             => 'required|email|unique:companies,email',
            'phone'             => [
                'required',
                'unique:companies,phone',
                // 'numeric'
                // 'regex:/(^(01))[3-9]{1}(\d){8}$/', 
                // new PhoneNumberValidationRules($request)
            ],
            'address'           => 'nullable|max:200',
            'website'           => 'nullable|url',
            'status'            => 'nullable',
            'terms_and_conditions'  => 'nullable|string',
            'privacy_policy'        => 'nullable|string',
            'linkedin'              => 'nullable|string',
            'facebook'              => 'nullable|string',
            'instagram'             => 'nullable|string',
            'twitter'               => 'nullable|string',
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function updateValidation($request, $id)
    {
        return [
            'company_name'          => 'required|max:100|min:2',
            'logo'                  => 'image|mimes:jpeg,png,jpg|max:1024',
            // 'favicon'           => 'image|mimes:ICO,ico|max:500',
            'invoice_logo'          => 'image|mimes:jpeg,png,jpg|max:1024',
            'email'                 => 'required|email|unique:companies,email,' . $id,
            'phone'                 => [
                'required',
                'unique:companies,phone,' . $id,
                // 'numeric'
                // 'regex:/(^(01))[3-9]{1}(\d){8}$/'
            ],
            'address'               => 'nullable|max:200',
            'website'               => 'nullable|url',
            'status'                => 'nullable',
            'terms_and_conditions'  => 'nullable|string',
            'privacy_policy'        => 'nullable|string',
            'linkedin'              => 'nullable|string',
            'facebook'              => 'nullable|string',
            'instagram'             => 'nullable|string',
            'twitter'               => 'nullable|string',
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
