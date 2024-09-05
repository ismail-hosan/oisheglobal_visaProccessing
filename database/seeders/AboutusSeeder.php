<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class AboutusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutus = new  AboutUs();
        $aboutus->title = "Who we are?";
        $aboutus->slug = Str::slug("About Us");
        $aboutus->tagline = "Tag line";
        $aboutus->description = "<div>IT WAY BD has been a certified leading website, software product and services company in Bangladesh. Since 2018, IT WAY BD has successful track record of delivering innovative and cost-effective technical services to it’s valuable customers in both Corporate and public sectors undertakings.</div><div>We are always ready to take any types of&nbsp; challenge with confidence.IT WAY BD established with the mission to maintain the status of leading software solution provider ensuring benefit of customers, partner &amp; employees, IT WAY BD provide quality solutions to build The Digital Delta powered by innovation and guided by integrity. Like the remarkable growth of the economy of Bangladesh, IT WAY BD has also wondered its clients and partners with amazing results, by building world-class capacity to deliver world-wide solutions. IT WAY BD is now a world wide solution provider.</div><div><br></div><div>The solutions provided by IT WAY BD help its national &amp; global clientele to add unprecedented value to their businesses. As a company, we have contributed significantly to the digitalization of Bangladesh by designing and implementing critical projects like Enterprise Resource Planning, or complete Business Management Solution.&nbsp; IT WAY BD is the IT partner of many corporate &amp; public sectors in Bangladesh. IT WAY BD also touched the entrepreneur of Bangladesh by offering comprehensive solution by coast effective web solution &amp; services.</div><div>Today, IT WAY BD is a Leading website &amp; software development company in Bangladesh.</div><div>&nbsp;IT WAY BD pioneer of working with latest technologies that help us to imagine tomorrow world.</div>";
        $aboutus->m_title = "Mission";
        $aboutus->mission = "<div>To be the Technical Company of choice in by providing quality service and timely&nbsp;</div><div>solutions through professional delivery of services such as&nbsp; Website designing &amp;</div><div>development, Software&nbsp; development, Local &amp; International Server Integration,&nbsp;</div><div>Search engine optimization, IT consultancy and more.</div>";
        $aboutus->v_title = "VISION";
        $aboutus->vision = "To&nbsp; become&nbsp; the&nbsp; leading&nbsp; edge&nbsp; technology&nbsp; provider in Bangladesh&nbsp; by&nbsp; creating high quality IT&nbsp; &amp;&nbsp; ICTproducts&nbsp; and&nbsp; services&nbsp; and partnering&nbsp; withthe&nbsp; most&nbsp; renowned suppliers of IT &amp; ICT Servicesin order to fill our clients’ expectations and achieve measurable competitive advantage";
        $aboutus->video = "https://www.youtube.com/embed/HR65HUXl2Bg";
        $aboutus->status = "Active";
        $aboutus->save();
    }
}
