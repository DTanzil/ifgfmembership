<?php

/*********************************  PARENT  *********************************/

// Home
Breadcrumbs::register('allfamily', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('allfamily'));
});

/*********************************  iCARES  *********************************/

// Home > All iCares 
Breadcrumbs::register('allicare', function($breadcrumbs)
{
    $breadcrumbs->parent('allfamily');
    $breadcrumbs->push('All iCares', route('allicare'));
});
// Home > All iCares > Add iCare  
Breadcrumbs::register('addicare', function($breadcrumbs)
{
    $breadcrumbs->parent('allicare');
    $breadcrumbs->push('Add New iCare', route('addicare'));
});
// Home > All iCares > iCare 
Breadcrumbs::register('editicare', function($breadcrumbs, $fellowship)
{
    $breadcrumbs->parent('allicare');
    $breadcrumbs->push($fellowship->name, route('editicare', $fellowship->id));
});
// Home > All iCares > iCare > View
Breadcrumbs::register('viewicare', function($breadcrumbs, $fellowship)
{
    $breadcrumbs->parent('allicare');
    $breadcrumbs->push($fellowship->name, route('editicare', $fellowship->id));
    $breadcrumbs->push("View {$fellowship->name}", route('viewicare', $fellowship->id));
});
// Home > All iCares > iCare > Assign
Breadcrumbs::register('assignicarerole', function($breadcrumbs, $fellowship, $role)
{
    $breadcrumbs->parent('allicare');
    $breadcrumbs->push($fellowship->name, route('editicare', $fellowship->id));
    $breadcrumbs->push(" Assign", route('assignicarerole', $fellowship->id, $role));
});

/*********************************  MEMBER ROLES  *********************************/
// Home > All Members
Breadcrumbs::register('allmember', function($breadcrumbs)
{
    $breadcrumbs->parent('allfamily');
    $breadcrumbs->push('All Members', route('allmember'));
});
// Home > All Members > Member
Breadcrumbs::register('editmember', function($breadcrumbs, $fellowship)
{
    $breadcrumbs->parent('allmember');
    $breadcrumbs->push($fellowship->name, route('editmember', $fellowship->id));
});












/*********************************  MEMBER ROLES  *********************************/

// Home > All Members 
Breadcrumbs::register('allmember', function($breadcrumbs)
{
    $breadcrumbs->parent('allfamily');
    $breadcrumbs->push('All Members', route('allmember'));
});
// Home > All Member Roles
Breadcrumbs::register('allmemberroles', function($breadcrumbs)
{
    $breadcrumbs->parent('allfamily');
    $breadcrumbs->push('Member Roles', route('allmemberroles'));
});
// Home > All Member Roles > Add
Breadcrumbs::register('addmemberroles', function($breadcrumbs)
{
    $breadcrumbs->parent('allmemberroles');
    $breadcrumbs->push('Add New Role', route('addmemberroles'));
});

// Breadcrumbs::register('/', function($breadcrumbs)
// {

// });

// // Home
// Breadcrumbs::register('home', function($breadcrumbs)
// {
// 	// $breadcrumbs->parent('/');
//     $breadcrumbs->push('Home', route('addicare'));
// });

// // Home > All iCares
// Breadcrumbs::register('allicare', function($breadcrumbs)
// {
//     $breadcrumbs->parent('home');
//     $breadcrumbs->push('All iCares', route('allicare'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::register('editicare', function($breadcrumbs, $icare)
// {	
// 	$breadcrumbs->parent('allicare');
// 	$breadcrumbs->push('IOJEAOIRJAOI', route('editicare', $icare->id));	

// });

// // Home > Blog > [Category]
// Breadcrumbs::register('viewicare', function($breadcrumbs, $icare)
// {
//     $breadcrumbs->parent('editicare', $icare);
//     $breadcrumbs->push('View', route('viewicare', $icare->id));
// });


// // Home > Blog > [Category] > [Page]
// Breadcrumbs::register('viewicare', function($breadcrumbs, $page)
// {
//     $breadcrumbs->parent('category', $page->category);
//     $breadcrumbs->push($page->name, route('viewicare', $page->id));
// });


?>