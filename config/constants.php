<?php 

return [
    'GLOBAL' => [
        'version' => 'v1.0',
        'en' => 'www.domain.us',
        'product_name' => 'IFGF Bandung Membership System'
        // etc
    ],
    'DAYS' => [
    	'Monday' => 'Monday',
    	'Tuesday' => 'Tuesday',
		'Wednesday' => 'Wednesday',
    	'Thursday' => 'Thursday',
		'Friday' => 'Friday',
    	'Saturday' => 'Saturday',
        'Sunday' => 'Sunday'
    ],
    'GENDER' => [
        'male' => 'Male',
        'female' => 'Female'
    ],
    'MARITAL_STATUS' => [
        'single' => 'Single',
        'married' => 'Married'
    ],
    'IBADAH' => [
        'umum1' => 'Ibadah Umum 1 (@7:30)',
        'umum2' => 'Ibadah Umum 2 (@9:30)',
        'teens' => 'Teens',
        'kids' => 'Kids',
        'mandarin' => 'Mandarin Service'
    ],
    'KIDS_CLASSES' => [
        'ls' => 'Little Star (Age #-#)',
        'rainbow' => 'Rainbow (Age #-#)',
        'spectrum' => 'Spectrum (Age #-#)'
    ],
    'GROUPS' => [
        'family' => 'Family',
        'ministry' => 'Ministry',
        'icare' => 'iCare'
    ],
    'GROUPS_MODELS' => [
        'family' => 'App\Family',
        'ministry' => 'App\Ministry',
        'icare' => 'App\Icare'
    ],
    'GROUPS_ICONS' => [
        'family' => 'home',
        'ministry' => 'university',
        'icare' => 'users'
    ],

    'ENGAGE_CLASSES' => [
        '0' => 'Keselamatan',
        '1' => 'Transformasi Kehidupan',
        '2' => 'Baptisan Air',
        '3' => 'Setiap Hari Bersama Kristus',
        '4' => 'Ikatan Perjanjian',
        '5' => 'Spiritual Formation',
        '6' => 'IFGF DNA Dan Icare Group'
    ],
    'FINISH_ENGAGE' => 6,

    'ESTABLISH_CLASSES' => [
        '0' => 'Session',
        '1' => 'Session',
        '2' => 'Session Air',
        '3' => 'Session Hari Bersama Kristus',
        '4' => 'Session Perjanjian',
        '5' => 'Session Formation',
        '6' => 'Session DNA Dan Icare Group'
    ],
    'FINISH_ESTABLISH' => 6,

    
    'TEACHERS_MAX_NUM' => 2,
    
    'JOIN_START' => '2000',
    'JOIN_END' => '2016',
    'VALID_IMAGE_TYPES' => 'jpeg,bmp,png'
];

?>