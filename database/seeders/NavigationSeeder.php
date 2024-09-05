<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;
// use Faker\Generator as Faker;
use App\Models\UserRole;
use App\Models\RoleAccess;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Navigation::truncate();
        $parent_menu = array(

            (object) array(
                'label' => 'About Us',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(
                    (object) array(
                        'label' => 'About Us',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Customer', 'route' => 'aboutus.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Edit Customer', 'route' => 'aboutus.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Customer', 'route' => 'aboutus.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Customer', 'route' => 'aboutus.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                )
            ),
            // (object) array(
            //     'label' => 'Why Choose Us',
            //     'route' => null,
            //     'icon' => 'fa fa-users',
            //     'parent_id' => 0,
            //     'submenu' => (object) array(
            //         (object) array(
            //             'label' => 'Why Choose',
            //             'route' => null,
            //             'icon' => 'fa fa-home',
            //             'parent_id' => null,
            //             'childMenu' => (object) array(
            //                 (object) array('label' => 'All Why Choose', 'route' => 'why.why.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
            //                 (object) array('label' => 'Add New Why Choose', 'route' => 'why.why.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
            //                 (object) array('label' => 'Edit Why Choose', 'route' => 'why.why.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
            //                 (object) array('label' => 'Show Why Choose', 'route' => 'why.why.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
            //                 (object) array('label' => 'Destroy Why Choose', 'route' => 'why.why.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
            //             )
            //         ),

            //     )
            // ),
            (object) array(
                'label' => 'Frequently asked Qst',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(
                    (object) array(
                        'label' => 'FAQ',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Faq', 'route' => 'faq.faq.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Faq', 'route' => 'faq.faq.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Faq', 'route' => 'faq.faq.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Faq', 'route' => 'faq.faq.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Faq', 'route' => 'faq.faq.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                )
            ),
            (object) array(
                'label' => 'Our Service',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(

                    (object) array(
                        'label' => 'Service',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Service', 'route' => 'service.service.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add Service', 'route' => 'service.service.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Service', 'route' => 'service.service.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Service', 'route' => 'service.service.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Service', 'route' => 'service.service.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                )
            ),


            // (object) array(
            //     'label' => 'Products',
            //     'route' => null,
            //     'icon' => 'fa fa-users',
            //     'parent_id' => 0,
            //     'submenu' => (object) array(
            //         (object) array(
            //             'label' => 'Products',
            //             'route' => null,
            //             'icon' => 'fa fa-home',
            //             'parent_id' => null,
            //             'childMenu' => (object) array(
            //                 (object) array('label' => 'All Product', 'route' => 'products.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
            //                 (object) array('label' => 'Add New Product', 'route' => 'products.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
            //                 (object) array('label' => 'Edit Product', 'route' => 'products.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
            //                 // (object) array('label' => 'Show Product', 'route' => 'products.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
            //                 (object) array('label' => 'Destroy Product', 'route' => 'products.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
            //             )
            //         ),

            //     )
            // ),


            (object) array(
                'label' => 'Branch',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(
                    (object) array(
                        'label' => 'Branch',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Branch', 'route' => 'project.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Branch', 'route' => 'project.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Branch', 'route' => 'project.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Branch', 'route' => 'project.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Branch', 'route' => 'project.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),
                    (object) array(
                        'label' => 'Branch User',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Branch', 'route' => 'barnch-user-list.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Branch', 'route' => 'barnch-user-list.indexcreate', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Branch', 'route' => 'barnch-user-list.indexedit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            // (object) array('label' => 'Show Product', 'route' => 'products.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Branch', 'route' => 'barnch-user-list.indexdestroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    )

                )
            ),
            (object) array(
                'label' => 'Online Application',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(
                    (object) array(
                        'label' => 'Application List',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Application', 'route' => 'application-list.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Application', 'route' => 'application-list.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Application', 'route' => 'application-list.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Application', 'route' => 'application-list.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Application', 'route' => 'application-list.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                )
            ),
            (object) array(
                'label' => 'Agents',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(
                    (object) array(
                        'label' => 'Agents User',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Agent', 'route' => 'agent.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Agent', 'route' => 'agent.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Agent', 'route' => 'agent.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            // (object) array('label' => 'Show Product', 'route' => 'products.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Agent', 'route' => 'agent.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    )

                )
            ),
            (object) array(
                'label' => 'Visa Processing',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(
                    (object) array(
                        'label' => 'List',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All processing', 'route' => 'visaproccesing.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New processing', 'route' => 'visaproccesing.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit processing', 'route' => 'visaproccesing.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            // (object) array('label' => 'Show Product', 'route' => 'products.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy processing', 'route' => 'visaproccesing.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                )
            ),
            (object) array(
                'label' => 'Career',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(
                    (object) array(
                        'label' => 'Career',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Career', 'route' => 'career.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Career', 'route' => 'career.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Career', 'route' => 'career.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Career', 'route' => 'career.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                )
            ),



            (object) array(
                'label' => 'Customer ',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(
                    (object) array(
                        'label' => 'Customer',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Customer', 'route' => 'inventorySetup.customer.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Customer', 'route' => 'inventorySetup.customer.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Customer', 'route' => 'inventorySetup.customer.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Customer', 'route' => 'inventorySetup.customer.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Customer', 'route' => 'inventorySetup.customer.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),
                    (object) array(
                        'label' => 'Testimonials',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Testimonial', 'route' => 'testimonial.testimonial.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Testimonial', 'route' => 'testimonial.testimonial.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Testimonial', 'route' => 'testimonial.testimonial.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Testimonial', 'route' => 'testimonial.testimonial.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Testimonial', 'route' => 'testimonial.testimonial.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                    (object) array(
                        'label' => 'Our Client',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Client', 'route' => 'aboutUs.ourClient.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Client', 'route' => 'aboutUs.ourClient.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Client', 'route' => 'aboutUs.ourClient.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Client', 'route' => 'aboutUs.ourClient.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Client', 'route' => 'aboutUs.ourClient.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),

                        )
                    ),

                )
            ),

            (object) array(
                'label' => 'Blog',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(
                    (object) array(
                        'label' => 'Blog',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Blog', 'route' => 'blog.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Blog', 'route' => 'blog.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Blog', 'route' => 'blog.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Blog', 'route' => 'blog.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                )
            ),

            (object) array(
                'label' => 'Import/Export',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(   
                    (object) array(
                        'label' => 'List',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Project Image', 'route' => 'project.image.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Project Image', 'route' => 'project.image.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Project Image', 'route' => 'project.image.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Project Image', 'route' => 'project.image.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Project image', 'route' => 'project.image.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                )
            ),
            
              (object) array(
                'label' => 'Gallery',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(
                    (object) array(
                        'label' => 'Photos',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Photos', 'route' => 'photos.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Photos', 'route' => 'photos.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Photos', 'route' => 'photos.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Photos', 'route' => 'photos.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Photos', 'route' => 'photos.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                    
                    (object) array(
                        'label' => 'Videos',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Videos', 'route' => 'videos.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Videos', 'route' => 'videos.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Videos', 'route' => 'videos.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Videos', 'route' => 'videos.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Videos', 'route' => 'videos.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                )
            ),

            (object) array(
                'label' => 'Team',
                'route' => null,
                'icon' => 'fa fa-users',
                'parent_id' => 0,
                'submenu' => (object) array(
                    (object) array(
                        'label' => 'Our Team',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Team', 'route' => 'team.team.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Team', 'route' => 'team.team.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Team', 'route' => 'team.team.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Team', 'route' => 'team.team.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Team', 'route' => 'team.team.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                    (object) array(
                        'label' => 'Message',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Message', 'route' => 'message.message.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Message', 'route' => 'message.message.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Message', 'route' => 'message.message.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Message', 'route' => 'message.message.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Message', 'route' => 'message.message.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),
                    (object) array(
                        'label' => 'Our Expertises',
                        'route' => null,
                        'icon' => 'fa fa-home',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Expertises', 'route' => 'expertises.expertises.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Expertises', 'route' => 'expertises.expertises.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Expertises', 'route' => 'expertises.expertises.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Expertises', 'route' => 'expertises.expertises.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Expertises', 'route' => 'expertises.expertises.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                )
            ),


            (object) array(
                'label' => 'System Configuration',
                'route' => null,
                'icon' => 'fa fa-cogs',
                'parent_id' => 0,
                'submenu' => (object) array(

                    (object) array(
                        'label' => 'Menu & Sub-menu',
                        'route' => null,
                        'icon' => 'fa fa-th-large',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Category', 'route' => 'inventorySetup.category.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Category', 'route' => 'inventorySetup.category.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Category', 'route' => 'inventorySetup.category.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Category', 'route' => 'inventorySetup.category.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Category', 'route' => 'inventorySetup.category.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                    (object) array(
                        'label' => 'Company Setup ',
                        'route' => null,
                        'icon' => 'fa fa-eur',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Company', 'route' => 'settings.company.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Company', 'route' => 'settings.company.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Company', 'route' => 'settings.company.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Company', 'route' => 'settings.company.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Company', 'route' => 'settings.company.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),
                    (object) array(
                        'label' => 'Slider',
                        'route' => null,
                        'icon' => 'fa fa-eur',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Slider', 'route' => 'settings.slider.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                        )
                    ),
                    (object) array(
                        'label' => 'Admin Role',
                        'route' => null,
                        'icon' => 'fa fa-lock',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All Role', 'route' => 'usermanage.userRole.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New Role', 'route' => 'usermanage.userRole.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit Role', 'route' => 'usermanage.userRole.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show Role', 'route' => 'usermanage.userRole.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy Role', 'route' => 'usermanage.userRole.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                    (object) array(
                        'label' => 'User',
                        'route' => null,
                        'icon' => 'fa fa-lock',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All User', 'route' => 'usermanage.user.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New User', 'route' => 'usermanage.user.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit User', 'route' => 'usermanage.user.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show User', 'route' => 'usermanage.user.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy User', 'route' => 'usermanage.user.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                    (object) array(
                        'label' => 'SMTP',
                        'route' => null,
                        'icon' => 'fa fa-server',
                        'parent_id' => null,
                        'childMenu' => (object) array(
                            (object) array('label' => 'All SMPT', 'route' => 'settings.smpt.index', 'icon' => 'fa fa-dashboard', 'navigate_status' => 1),
                            (object) array('label' => 'Add New SMPT', 'route' => 'settings.smpt.create', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Edit SMPT', 'route' => 'settings.smpt.edit', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Show SMPT', 'route' => 'settings.smpt.show', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                            (object) array('label' => 'Destroy SMPT', 'route' => 'settings.smpt.destroy', 'icon' => 'fa fa-dashboard', 'navigate_status' => null),
                        )
                    ),

                )
            ),
        );

        $parentMenu = array();
        $childMenu = array();

        foreach ((object) $parent_menu as $key => $each_parent) :
            //dd($each_parent->label);
            $navigation = new Navigation();
            $navigation->parent_id = $each_parent->parent_id;
            $navigation->label = $each_parent->label;
            $navigation->route = '';
            $navigation->icon = $each_parent->icon;
            $navigation->object_class = '';
            $navigation->extra_attribute = '';
            $navigation->active = "1";
            $navigation->orderBy = "1";
            $navigation->updated_by = 1;
            $navigation->created_by = 1;
            $navigation->deleted_by = null;
            $navigation->save();

            if (!empty($each_parent->submenu))
                foreach ($each_parent->submenu as $key => $each_child) :
                    $navigation_submenu = new Navigation();
                    $navigation_submenu->parent_id = $navigation->id;
                    $navigation_submenu->label = $each_child->label;
                    $navigation_submenu->route = '';
                    $navigation_submenu->icon = $each_child->icon;
                    $navigation_submenu->object_class = '';
                    $navigation_submenu->extra_attribute = '';
                    $navigation_submenu->active = "1";
                    $navigation_submenu->orderBy = "1";
                    $navigation_submenu->updated_by = 1;
                    $navigation_submenu->created_by = 1;
                    $navigation_submenu->deleted_by = null;
                    $navigation_submenu->save();
                    array_push($parentMenu, $navigation_submenu->id);
                    foreach ($each_child->childMenu as $key => $each_menu) :
                        $navigation_child = new Navigation();
                        $navigation_child->parent_id = $navigation_submenu->id;
                        $navigation_child->label = $each_menu->label;
                        $navigation_child->route = $each_menu->route;
                        $navigation_child->navigate_status = $each_menu->navigate_status;
                        $navigation_child->icon = $each_menu->icon;
                        $navigation_child->object_class = '';
                        $navigation_child->extra_attribute = '';
                        $navigation_child->active = "1";
                        $navigation_child->orderBy = "1";
                        $navigation_child->updated_by = 1;
                        $navigation_child->created_by = 1;
                        $navigation_child->deleted_by = null;
                        $navigation_child->save();
                        array_push($childMenu, $navigation_child->id);
                    endforeach;
                endforeach;
        endforeach;


        $userRole = new UserRole();
        $userRole->role_name = 'AGB Admin';
        $userRole->parent_id = implode(",", $parentMenu);
        $userRole->navigation_id = implode(",", $childMenu);
        $userRole->branch_id = implode(",", array(1, 2, 3, 4, 5, 6));
        $userRole->status = 'Active';
        $userRole->save();
        $roleAccess =  new RoleAccess();
        $roleAccess->role_id = 1;
        $roleAccess->user_id = 1;
        $roleAccess->save();
    }
}
