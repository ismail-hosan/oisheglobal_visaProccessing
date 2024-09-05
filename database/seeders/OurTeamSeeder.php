<?php

namespace Database\Seeders;

use App\Models\OurTeam;
use Illuminate\Database\Seeder;

class OurTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $our_teams = array(
            array('serial' => 1, 'department_id' => 'Software Development Team',   'designation_id' => 'Sr. Software Engineer',            'name' => 'Saiful Islam', 'image' => 'WhatsApp Image 2021-11-06 at 4.55.37 PM.jpeg', 'status' => 'Active', 'updated_by' => NULL, 'created_by' => NULL, 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-26 05:41:48', 'updated_at' => '2021-12-26 05:41:48'),
            array('serial' => 2, 'department_id' => 'Software Development Team',   'designation_id' => 'Sr. Software Engineer',    'name' => 'Joyanta Kumar Sarkar', 'image' => 'sr.sw joynto.png', 'status' => 'Active', 'updated_by' => NULL, 'created_by' => NULL, 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-26 05:35:07', 'updated_at' => '2021-12-26 05:35:07'),
            array('serial' => 3, 'department_id' => 'Software Development Team',   'designation_id' => 'Software Developer',       'name' => 'Rabbi', 'image' => 'Rabbi.png', 'status' => 'Active', 'updated_by' => NULL, 'created_by' => NULL, 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-26 05:47:26', 'updated_at' => '2021-12-26 05:47:26'),
            array('serial' => 4, 'department_id' => 'Software Development Team',   'designation_id' => 'Web Developer',            'name' => 'Azaz Ahmed', 'image' => 'wordpress developer azaz.png', 'status' => 'Active', 'updated_by' => NULL, 'created_by' => NULL, 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-26 05:55:25', 'updated_at' => '2021-12-26 05:55:25'),
            array('serial' => 5, 'department_id' => 'Software Development Team',   'designation_id' => 'Web Developer',            'name' => 'MD. SHAHINUL ISLAM', 'image' => 'WordPress Developer 02.png', 'status' => 'Active', 'updated_by' => NULL, 'created_by' => NULL, 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-26 05:54:25', 'updated_at' => '2021-12-26 05:54:25'),
            array('serial' => 6, 'department_id' => 'Creative Team',               'designation_id' => 'Graphics Designer',        'name' => 'Ibrahim Khalil Ullah', 'image' => 'Graphics Designer.png', 'status' => 'Active', 'updated_by' => NULL, 'created_by' => NULL, 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-26 05:30:40', 'updated_at' => '2021-12-26 05:30:40'),
            array('serial' => 7, 'department_id' => 'Sales & Marketing Team',      'designation_id' => 'Executive',                'name' => 'MARJIA AKTER', 'image' => 'Customer Executive.png', 'status' => 'Active', 'updated_by' => NULL, 'created_by' => NULL, 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-26 05:52:21', 'updated_at' => '2021-12-26 05:52:21'),
        );

        OurTeam::insert($our_teams);
    }
}
