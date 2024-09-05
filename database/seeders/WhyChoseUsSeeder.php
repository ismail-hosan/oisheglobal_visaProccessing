<?php

namespace Database\Seeders;

use App\Models\WhyChoose;
use Illuminate\Database\Seeder;

class WhyChoseUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            [
                'title' => '24/7 Support',
                'details' => 'The number one skill required for the success of custom software in tandem with technology.',
                'fa_icon' => 'fa fa-clock-o'
            ],
            [
                'title' => 'Creative Idea',
                'details' => 'We collaborate with clients with ideas with our skilled team. Our goal is to make the client happy.',
                'fa_icon' => 'fa fa-lightbulb-o'
            ],
            [
                'title' => 'Fast Delivery',
                'details' => 'We are more capable than permits making a completed arrangement quicker with better caliber.',
                'fa_icon' => 'fa fa-check-square-o'
            ],
            [
                'title' => 'Skilled',
                'details' => 'We are more experienced that allows creating a finished solution faster with higher quality.',
                'fa_icon' => 'fa fa-gears'
            ],
            [
                'title' => 'Dedication',
                'details' => 'We ensure transparency will be able to provide you with all of the information needed to take action.',
                'fa_icon' => 'fa fa-sign-language'
            ],
            [
                'title' => 'Safe & Secure',
                'details' => 'We follow strong information security systems that will ensure an associations data resources cybercriminal exercises.',
                'fa_icon' => 'fa fa-lock'
            ],
        ];
        foreach ($array as $i => $item) {
            $client = new WhyChoose();
            $client->title = $item['title'];
            $client->details = $item['details'];
            $client->fa_icon = $item['fa_icon'];
            $client->serial = $i;
            $client->save();
        }
    }
}
