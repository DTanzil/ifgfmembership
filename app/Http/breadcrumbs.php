<?php

/*********************************  PARENT  *********************************/

// Home
Breadcrumbs::register('boboho', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('boboho'));
});

/*********************************  iCARES  *********************************/

// Home > All iCares 
Breadcrumbs::register('allicare', function($breadcrumbs)
{
    $breadcrumbs->parent('boboho');
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
    $breadcrumbs->push("Assign", route('assignicarerole', $fellowship->id, $role));
});

/*********************************  FAMILY  *********************************/

// Home > All Family 
Breadcrumbs::register('allfamily', function($breadcrumbs)
{
    $breadcrumbs->parent('boboho');
    $breadcrumbs->push('All Families', route('allfamily'));
});
// Home > All Family > Add Family
Breadcrumbs::register('addfamily', function($breadcrumbs)
{
    $breadcrumbs->parent('allfamily');
    $breadcrumbs->push('Add New Family', route('addfamily'));
});
// Home > All Family > Family 
Breadcrumbs::register('editfamily', function($breadcrumbs, $fellowship)
{
    $breadcrumbs->parent('allfamily');
    $breadcrumbs->push($fellowship->name, route('editfamily', $fellowship->id));
});
// Home > All Family > Family > View
Breadcrumbs::register('viewfamily', function($breadcrumbs, $fellowship)
{
    $breadcrumbs->parent('allfamily');
    $breadcrumbs->push($fellowship->name, route('editfamily', $fellowship->id));
    $breadcrumbs->push("View {$fellowship->name}", route('viewfamily', $fellowship->id));
});
// Home > All Family > Family > Assign
Breadcrumbs::register('assignfamrole', function($breadcrumbs, $fellowship, $role)
{
    $breadcrumbs->parent('allfamily');
    $breadcrumbs->push($fellowship->name, route('editfamily', $fellowship->id));
    $breadcrumbs->push("Assign", route('assignfamrole', $fellowship->id, $role));
});

/*********************************  MINISTRY  *********************************/

// Home > All Ministry 
Breadcrumbs::register('allministry', function($breadcrumbs)
{
    $breadcrumbs->parent('boboho');
    $breadcrumbs->push('All Ministry', route('allministry'));
});
// Home > All Ministry > Add Ministry
Breadcrumbs::register('addministry', function($breadcrumbs)
{
    $breadcrumbs->parent('allministry');
    $breadcrumbs->push('Add New Ministry', route('addministry'));
});
// Home > All Ministry > Ministry 
Breadcrumbs::register('editministry', function($breadcrumbs, $fellowship)
{
    $breadcrumbs->parent('allministry');
    $breadcrumbs->push($fellowship->name, route('editministry', $fellowship->id));
});
// Home > All Ministry > Ministry > View
Breadcrumbs::register('viewministry', function($breadcrumbs, $fellowship)
{
    $breadcrumbs->parent('allministry');
    $breadcrumbs->push($fellowship->name, route('editministry', $fellowship->id));
    $breadcrumbs->push("View {$fellowship->name}", route('viewministry', $fellowship->id));
});
// Home > All Ministry > Ministry > Assign
Breadcrumbs::register('assignmstrole', function($breadcrumbs, $fellowship, $role)
{
    $breadcrumbs->parent('allministry');
    $breadcrumbs->push($fellowship->name, route('editministry', $fellowship->id));
    $breadcrumbs->push("Assign", route('assignmstrole', $fellowship->id, $role));
});




/*********************************  KIDS  *********************************/

// Home > All Kids 
Breadcrumbs::register('allkids', function($breadcrumbs)
{
    $breadcrumbs->parent('boboho');
    $breadcrumbs->push('All Kids', route('allkids'));
});
// // Home > All Ministry > Add Ministry
// Breadcrumbs::register('addministry', function($breadcrumbs)
// {
//     $breadcrumbs->parent('allministry');
//     $breadcrumbs->push('Add New Ministry', route('addministry'));
// });
// // Home > All Ministry > Ministry 
// Breadcrumbs::register('editministry', function($breadcrumbs, $fellowship)
// {
//     $breadcrumbs->parent('allministry');
//     $breadcrumbs->push($fellowship->name, route('editministry', $fellowship->id));
// });
// // Home > All Ministry > Ministry > View
// Breadcrumbs::register('viewministry', function($breadcrumbs, $fellowship)
// {
//     $breadcrumbs->parent('allministry');
//     $breadcrumbs->push($fellowship->name, route('editministry', $fellowship->id));
//     $breadcrumbs->push("View {$fellowship->name}", route('viewministry', $fellowship->id));
// });
// // Home > All Ministry > Ministry > Assign
// Breadcrumbs::register('assignmstrole', function($breadcrumbs, $fellowship, $role)
// {
//     $breadcrumbs->parent('allministry');
//     $breadcrumbs->push($fellowship->name, route('editministry', $fellowship->id));
//     $breadcrumbs->push("Assign", route('assignmstrole', $fellowship->id, $role));
// });










/*********************************  MEMBERS *********************************/

// Home > All Members
Breadcrumbs::register('allmember', function($breadcrumbs)
{
    $breadcrumbs->parent('boboho');
    $breadcrumbs->push('All Members', route('allmember'));
});
// Home > All Members > Edit Member 
Breadcrumbs::register('editmember', function($breadcrumbs, $fellowship)
{
    $breadcrumbs->parent('allmember');
    $breadcrumbs->push("Edit {$fellowship->name} ", route('editmember', $fellowship->id));
});

// Home > All Members > Edit Member > View
Breadcrumbs::register('viewmember', function($breadcrumbs, $fellowship)
{
    $breadcrumbs->parent('allmember');
    $breadcrumbs->push($fellowship->name, route('editmember', $fellowship->id));
    $breadcrumbs->push("View {$fellowship->name}", route('viewmember', $fellowship->id));
});







/*********************************  APPROVE MEMBER  *********************************/

// Home > All Members Status
Breadcrumbs::register('mymember', function($breadcrumbs)
{
    $breadcrumbs->parent('boboho');
    $breadcrumbs->push('All Membership Status', route('mymember'));
});
// Home > All Members Status > Edit Member Status
Breadcrumbs::register('editmymember', function($breadcrumbs, $fellowship)
{
    $breadcrumbs->parent('mymember');
    $breadcrumbs->push("Edit {$fellowship->name} Membership Status", route('editmymember', $fellowship->id));
});











/*********************************  MEMBER ROLES  *********************************/

Breadcrumbs::register('allmemberroles', function($breadcrumbs)
{
    $breadcrumbs->parent('boboho');
    $breadcrumbs->push('Member Roles', route('allmemberroles'));
});
// Home > All Member Roles > Add
Breadcrumbs::register('addmemberroles', function($breadcrumbs)
{
    $breadcrumbs->parent('allmemberroles');
    $breadcrumbs->push('Add New Role', route('addmemberroles'));
});


/*********************************  ENGAGE  *********************************/
// Home > All Engage
Breadcrumbs::register('allengage', function($breadcrumbs)
{
    $breadcrumbs->parent('boboho');
    $breadcrumbs->push('All Engage', route('allengage'));
});

// Home > All Engage > Add Engage
Breadcrumbs::register('addengage', function($breadcrumbs)
{
    $breadcrumbs->parent('allengage');
    $breadcrumbs->push('Add New Engage', route('addengage'));
});

// Home > All Engage > Engage
Breadcrumbs::register('editengage', function($breadcrumbs, $fellowship)
{
    $breadcrumbs->parent('allengage');
    $breadcrumbs->push($fellowship->name, route('editengage', $fellowship->id));
});


// Home > All Engage > Engage > View 
Breadcrumbs::register('viewengage', function($breadcrumbs, $fellowship)
{
    $breadcrumbs->parent('allengage');
    $breadcrumbs->push($fellowship->name, route('editengage', $fellowship->id));
    $breadcrumbs->push("View $fellowship->name", route('viewengage', $fellowship->id));
});

// Home > All Engage > Engage > Assign 
Breadcrumbs::register('assignengrole', function($breadcrumbs, $fellowship, $role)
{
    $breadcrumbs->parent('allengage');
    $breadcrumbs->push($fellowship->name, route('editengage', $fellowship->id));
    $breadcrumbs->push("Assign", route('assignengrole', $fellowship->id, $role));
});

// Home > All Engage > Engage > Assign Teacher
Breadcrumbs::register('assignengteacher', function($breadcrumbs, $fellowship, $class)
{
    $breadcrumbs->parent('allengage');
    $breadcrumbs->push($fellowship->name, route('editengage', $fellowship->id));
    $breadcrumbs->push("Assign Teacher - $class", route('assignengteacher', $fellowship->id, $class));
});

// Home > All Engage > Engage > Assign Teacher
Breadcrumbs::register('attendengage', function($breadcrumbs, $fellowship, $class)
{
    $breadcrumbs->parent('allengage');
    $breadcrumbs->push($fellowship->name, route('editengage', $fellowship->id));
    $breadcrumbs->push("Class Attendance - $class", route('attendengage', $fellowship->id, $class));
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