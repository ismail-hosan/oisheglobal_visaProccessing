<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;
// use Faker\Generator as Faker;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i = 1; $i < 10; $i++) :
        //     $customer = new Testimonial();
        //     $customer->customer_id = 1;
        //     $customer->message = "<p> I would recommend IT WAY BD for those who need help to increase bid approval and fight for timely submission of work. The team brought me the required amount of lead and made the transition easier. Their s...</p>";
        //     $customer->image = 'testimonial-3.jpg';
        //     $customer->created_by = 1;
        //     $customer->save();
        // endfor;
        $testimonials = array(
            array('customer_id' => '1', 'message' => 'Amazing people to work with who really care about each other – they only hire for culture / personality -train for any missing skills . Lots of opportunity to learn new technology/skills – most of their clients are running current hardware.', 'image' => 'img 07.png', 'status' => 'Active', 'updated_by' => NULL, 'created_by' => NULL, 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-27 05:15:48', 'updated_at' => '2021-12-27 05:15:48'),
            array('customer_id' => '2', 'message' => 'IT way bd is very professional and maintain time schedule for the deadline. Their work is very responsive and managable. I have a very good experience with them. The members of development team are hard worker and potential.', 'image' => 'img 09.png', 'status' => 'Active', 'updated_by' => NULL, 'created_by' => NULL, 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-27 05:24:43', 'updated_at' => '2021-12-27 05:24:43'),
            array('customer_id' => '3', 'message' => 'I wanted to take a moment to thank you for the services your team has provided. Your team has been a pleasure to work with, professional and timely. The only delay in work that we have experienced has been due to our own lack of organization managing our projects, not yours. Job well done and I hope we can continue to grow together.', 'image' => 'img-08.jpg', 'status' => 'Active', 'updated_by' => NULL, 'created_by' => NULL, 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-27 05:34:19', 'updated_at' => '2021-12-27 05:34:19'),
            array('customer_id' => '4', 'message' => 'When our own skills did not manage to get where we wanted, IT way bd took care of the rest. The expertise, customer service, and "follow up" we experienced from IT way bd was simply flawless.', 'image' => 'img 02.jpg', 'status' => 'Active', 'updated_by' => NULL, 'created_by' => NULL, 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-27 05:39:58', 'updated_at' => '2021-12-27 05:39:58'),
            array('customer_id' => '5', 'message' => 'We have worked with IT way bd on various projects, and find that they provide quality service and expertise for our programming needs. It is rare to find a service provider with such professional consistency - they are a valued service provider to our business!', 'image' => 'img 10.png', 'status' => 'Active', 'updated_by' => NULL, 'created_by' => NULL, 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-27 05:42:09', 'updated_at' => '2021-12-27 05:42:09')
        );
        Testimonial::insert($testimonials);
    }
}
