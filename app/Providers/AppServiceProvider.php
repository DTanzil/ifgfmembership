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
            'Home' => array('url' => 'allfamily', 'icon' => 'fa-dashboard'),
            'Members' => array('url' => 'allmember', 'icon' => 'fa-user', 'child_urls' => array('allmember', 'addmember'),
                                'child' => array(
                                    'All Members' => array('url' => 'allmember', 'icon' => 'fa-home'), 
                                    'Add New Member' => array('url' => 'addmember', 'icon' => 'fa-home'))),
            'Kids' => array('url' => 'allmember', 'icon' => 'fa-child', 'child_urls' => array('allmember', 'addmember'),
                                'child' => array(
                                    'All Kids' => array('url' => 'allmember', 'icon' => 'fa-home'), 
                                    'Add New Kids' => array('url' => 'addmember', 'icon' => 'fa-home'))),
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
            'Establish' => array('url' => 'allengage', 'icon' => 'fa-book', 'child_urls' => array('allmember', 'addmember'),
                                'child' => array(
                                    'All Engage' => array('url' => 'allengage'), 
                                    'Add New Engage' => array('url' => 'allengage'))),
            'Equip' => array('url' => 'allengage', 'icon' => 'fa-book', 'child_urls' => array('allmember', 'addmember'),
                                'child' => array(
                                    'All Engage' => array('url' => 'allengage'), 
                                    'Add New Engage' => array('url' => 'allengage'))),
            'Empower' => array('url' => 'allengage', 'icon' => 'fa-book', 'child_urls' => array('allmember', 'addmember'),
                                'child' => array(
                                    'All Engage' => array('url' => 'allengage'), 
                                    'Add New Engage' => array('url' => 'allengage'))),
            'Override Membership' => array('url' => 'allfamily', 'icon' => 'fa-wrench', 'child_urls' => array('allmemberroles', 'addmemberroles'),
                                'child' => array(
                                    'All Member Roles' => array('url' => 'allmemberroles'), 
                                    'Add New Member Role' => array('url' => 'addmemberroles'))),
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
