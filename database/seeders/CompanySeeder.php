<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unixTimestamp = time();
        //  for ($i = 0; $i < 10; $i++) :
        $companySetUp = new Company();
        $companySetUp->logo = 'itwaybd-h.png';
        $companySetUp->favicon = 'itwaybd.ico';
        $companySetUp->invoice_logo = 'itwaybd-f.png';
        $companySetUp->company_name = 'IT WAY BD';
        $companySetUp->website = 'http://itwaybd.com/';
        $companySetUp->phone = '+8801844-690700';
        $companySetUp->email = 'info@itwaybd.com';
        $companySetUp->sale_phone = '+8801854-125454';
        $companySetUp->sale_email = 'sale@itwaybd.com';
        $companySetUp->hr_phone = '+8801958-480041';
        $companySetUp->hr_email = 'accounts@itwaybd.com';
        $companySetUp->support_phone = '+8801958-222208';
        $companySetUp->support_email = 'support@itwaybd.com';
        $companySetUp->address = 'House-9, Road-4, Sector-12, Uttara, Dhaka-1230, Bangladesh';
        $companySetUp->task_identification_number = '66526526';
        $companySetUp->updated_by = 1;
        $companySetUp->created_by = 1;
        $companySetUp->deleted_by = 1;
        $companySetUp->terms_and_conditions = '';
        $companySetUp->privacy_policy = '<p>IT WAY BD., a proactive digital marketing agency, has its Privacy Policy that governs and describes how IT WAY BD. gathers, uses, keeps tracks of and discloses user information (each, a “User”) of the http://itwaybd.com/ website (“Site”). This privacy policy is applicable to the Site as well as all its products and services.</p>
<p>Personal identification information<br>
We may collect Users’ personal identification information in different ways that might include but not be limited to, the time users visit the Site, signup with the Site, make an order, subscribe to our newsletter, provide response to any of our surveys, fill out any form, and in relation with other services, features, activities, or resources available on the Site.</p>
<p>We may ask Users for, as suitable, full name, email and mailing address, cell number, and credit card information. However, Users may visit the site anonymously. We will collect and store Users’ personal identification information only when they submit the information voluntarily. Users can avoid supplying personally identification information if they want, except that such avoidance may not allow them to participate in certain activities.</p>
<p>Non-personal identification information<br>
Non-personal identification information may be collected as Users do any interaction with the Site. Such information may include the device name, browser name, operating system, name of ISP, and other technical information.</p>
<p>Web Cookies:<br>
Cookies may be used to improve User experience. The web browsers used by Users put cookies on their personal computers’ hard drives for keeping records and at times to keep track of information about them. It is permitted that User can customize their browsers to refuse cookies, or to send them alerts as cookies are sent. If cookies are refused, some features of the Site may function inappropriately.</p>
<p>Use of the collected information:<br>
Following are the purposes IT WAY BD. may use the collected User information.</p>
<p>To improve User service and be able to respond to their queries or service requests efficiently.<br>
To be able to personalize user experience by understanding how Users use the resources or service on the Site.<br>
To improve the Site or its services using customers’ feedback as the guidance in particular.<br>
To process online payments as users, place orders and make payments. (Information is not shared with any outside party except the amount of information required compulsorily for the service)<br>
To make arrangement for a contest, survey, promotion, and similar online events.<br>
To offer Users resources or information as per their agreement to receive them about different topics that we find useful for them.<br>
To send users on a periodic basis.<br>
How to unsubscribe?<br>
If the User feels it is right to unsubscribe from getting our future emails regarding different digital marketing agency services and offers, he/she can go through our detailed unsubscribe guidelines located at the bottom of any email they received from us. However, the User may, if required, contact us directly via our Site.</p>
<p>Protection of User information:<br>
We follow appropriate and legitimate methods to collect, store, and process data. We adopt strong security measures to ensure maximum protection against any instance of alteration, unauthorized access, destruction of personal information, login credentials, transaction information, disclosure, and any sensitive data stored on the Site.</p>
<p>Sharing your personal information<br>
We do not sell, trade, or rent Users personal identification information to others. We may share generic aggregated demographic information not linked to any personal identification information regarding visitors and users with our business partners, trusted affiliates and advertisers for the purposes outlined above. We may use third party service providers to help us operate our business and the Site or administer activities on our behalf, such as sending out newsletters or surveys. We may share your information with these third parties for those limited purposes provided that you have given us your permission.</p>
<p>Compliance with children’s online privacy protection act<br>
Protecting the privacy of the very young is especially important. For that reason, we never collect or maintain information at our Site from those we actually know are under 13, and no part of our website is structured to attract anyone under 13.</p>
<p>Changes to this privacy policy<br>
IT WAY BD. has the discretion to update this privacy policy at any time. When we do, we will revise the updated date at the bottom of this page. We encourage Users to frequently check this page for any changes to stay informed about how we are helping to protect the personal information we collect. You acknowledge and agree that it is your responsibility to review this privacy policy periodically and become aware of modifications.</p>
<p>Your acceptance of these terms<br>
By using this Site, you signify your acceptance of this policy. If you do not agree to this policy, please do not use our Site. Your continued use of the Site following the posting of changes to this policy will be deemed your acceptance of those changes.</p>';
        $companySetUp->linkedin = null;
        $companySetUp->facebook = 'https://www.facebook.com/itwaybdfbo';
        $companySetUp->instagram = null;
        $companySetUp->twitter = null;
        $companySetUp->youtube = 'https://www.youtube.com/channel/UC0wTL2j_H4u-vriytWX-wCA';
        $companySetUp->success_rate = 100;
        $companySetUp->running_project = 25;
        $companySetUp->project_done = 1000;
        $companySetUp->total_clients = 700;

        // $companySetUp->deleted_at = $faker->dateTime($unixTimestamp);
        $companySetUp->save();
        //  endfor;
    }
}
