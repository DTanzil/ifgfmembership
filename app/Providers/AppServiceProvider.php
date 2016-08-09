<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            if(\Request::route() instanceof \Illuminate\Routing\Route) {
                $current_route = \Request::route()->getName();
                $view->with('current_route', $current_route);
            }
        });

        // Generate Sidebar Menu
        $menu = array(
            // 'Home' => array('url' => 'allfamily', 'icon' => 'fa-dashboard'),
            'Members' => array('url' => 'allmember', 'icon' => 'fa-user', 'child_urls' => array('allmember', 'addmember', 'editmember', 'viewmember'),
                                'child' => array(
                                    'All Members' => array('url' => 'allmember', 'icon' => 'fa-home'), 
                                    'Add New Member' => array('url' => 'addmember', 'icon' => 'fa-home'))),
            'Kids' => array('url' => 'allkids', 'icon' => 'fa-child', 'child_urls' => array('allkids'),
                                'child' => array(
                                    'All Kids' => array('url' => 'allkids', 'icon' => 'fa-home'))),
            'Family' => array('url' => 'allfamily', 'icon' => 'fa-home', 'child_urls' => array('allfamily', 'addfamily', 'editfamily', 'viewfamily'),
                                'child' => array(
                                    'All Family' => array('url' => 'allfamily', 'icon' => 'fa-home'), 
                                    'Add New Family' => array('url' => 'addfamily', 'icon' => 'fa-home'))),
            'iCare' => array('url' => 'allicare', 'icon' => 'fa-users', 'child_urls' => array('allicare', 'addicare', 'editicare', 'viewicare'),
                                'child' => array(
                                    'All iCare' => array('url' => 'allicare', 'icon' => 'fa-home'), 
                                    'Add New iCare' => array('url' => 'addicare', 'icon' => 'fa-home'))),
            'Ministry' => array('url' => 'allministry', 'icon' => 'fa-university', 'child_urls' => array('allministry', 'addministry', 'editministry', 'viewministry'), 
                                'child' => array(
                                    'All Ministry' => array('url' => 'allministry', 'icon' => 'fa-home'), 
                                    'Add New Ministry' => array('url' => 'addministry', 'icon' => 'fa-home'))),
            'Engage' => array('url' => 'allengage', 'icon' => 'fa-book', 'child_urls' => array('allengage', 'addengage', 'editengage', 'viewengage'),
                                'child' => array(
                                    'All Engage' => array('url' => 'allengage', 'icon' => 'fa-home'), 
                                    'Add New Engage' => array('url' => 'addengage', 'icon' => 'fa-home'))),
            'Establish' => array('url' => 'allestablish', 'icon' => 'fa-book', 'child_urls' => array('allestablish', 'addestablish', 'editestablish', 'viewestablish'),
                                'child' => array(
                                    'All Establish' => array('url' => 'allestablish'), 
                                    'Add New Establish' => array('url' => 'addestablish'))),
            'Equip' => array('url' => 'allequip', 'icon' => 'fa-book', 'child_urls' => array('allequip', 'addequip', 'editequip', 'viewequip'),
                                'child' => array(
                                    'All Equip' => array('url' => 'allequip'), 
                                    'Add New Equip' => array('url' => 'addequip'))),
            'Empower' => array('url' => 'allempower', 'icon' => 'fa-book', 'child_urls' => array('allempower', 'addempower', 'editempower', 'viewempower'),
                                'child' => array(
                                    'All Empower' => array('url' => 'allempower'), 
                                    'Add New Empower' => array('url' => 'addempower'))),
            'Override Membership' => array('url' => 'mymember', 'icon' => 'fa-wrench', 'child_urls' => array('mymember', 'editmymember'),
                                'child' => array(
                                    'All Membership Status' => array('url' => 'mymember'), 
                                    'Edit Membership Status' => array('url' => 'editmymember'))),
            'Roles' => array('url' => 'allmemberroles', 'icon' => 'fa-wrench', 'child_urls' => array('allmemberroles', 'addmemberroles'),
                                'child' => array(
                                    'All Member Roles' => array('url' => 'allmemberroles'), 
                                    'Add New Member Role' => array('url' => 'addmemberroles'))),
        );
        view()->share('mymenu', $menu);


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
