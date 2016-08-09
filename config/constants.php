<?php 

return [
    'GLOBAL' => [
        'version' => 'v1.0',
        'en' => 'www.domain.us',
        'product_name' => 'IFGF Bandung Membership'
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
        'umum1' => 'Ibadah Umum 1 (@9:00)',
        'umum2' => 'Ibadah Umum 2 (@7:30)',
        'teens' => 'Teens',
        'kids' => 'Kids',
        'mandarin' => 'Mandarin Service'
    ],
    'KIDS_CLASSES' => [
        'ls' => 'Little Star (Age 0-4)',
        'rainbow' => 'Rainbow (Age 4-6)',
        'sunbeams' => 'Sunbeams (Age 6-8) (1-2 SD)',        
        'spectrum' => 'Spectrum (Age 8-10) (3-4 SD)',
        'dynamite' => 'Dynamite (Age 10-12) (5-6 SD)'
    ],
    'GROUPS' => [
        'family' => ['name' => 'Family', 'model' => 'App\Family', 'icons' => 'home', 'url' => 'family'],
        'ministry' => ['name' => 'Ministry', 'model' => 'App\Ministry', 'icons' => 'university', 'url' => 'ministry'],
        'icare' => ['name' => 'iCare', 'model' => 'App\Icare', 'icons' => 'users', 'url' => 'icares'],
        'engage' => ['name' => 'Engage', 'model' => 'App\Engage', 'icons' => 'book', 'url' => 'engage'],
        'establish' => ['name' => 'Establish', 'model' => 'App\Establish', 'icons' => 'book', 'url' => 'establish'],
        'equip' =>  ['name' => 'Equip', 'model' => 'App\Equip', 'icons' => 'book', 'url' => 'equip'],
        'empower' =>  ['name' => 'Empower', 'model' => 'App\Empower', 'icons' => 'book', 'url' => 'empower']
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
    'FINISH_ENGAGE' => [
        'minimum' => 6,
        'classes' => ['Keselamatan', 'Transformasi Kehidupan', 'Baptisan Air']
    ],
    'ESTABLISH_CLASSES' => [
        '0' => 'Pemuridan dan Kepemimpinan',
        '1' => 'Iman dan Pengharapan',
        '2' => 'Doa dan Penyembahan',
        '3' => 'Firman Tuhan',
        '4' => 'Kemakmuran dan Kemurahan Hati',
        '5' => 'Penginjilan dan Misi',
        '6' => 'Kebangkitan dan Penghakiman'
        ],
    'FINISH_ESTABLISH' => [
        'minimum' => 5,
    ],
    'EQUIP_CLASSES' => [
        '0' => 'Starting Point',
        '1' => 'Discovery Your Personality',
        '2' => 'Created for Relationship',
        '3' => 'Finding Your Strength and Strength at play',
        '4' => 'Vision and Holy Discontent',
        '5' => 'Resource Management',
        '6' => 'SMAART Planning'
    ],
    'FINISH_EQUIP' => [
        'minimum' => 5,
        'classes' => ['Starting Point']
    ],
    'EMPOWER_CLASSES' => [
        '0' => 'DISCIPLESHIP PROCESS 1',
        '1' => 'DISCIPLESHIP PROCESS 2 ',
        '2' => 'WHY ICAREGROUP?',
        '3' => 'LEADERSHIP CULTURE',
        '4' => 'LEADING IN ICAREGROUP',
        '5' => 'THE FLOW IN ICAREGROUP',
        '6' => 'CONFLICT MANAGEMENT'
    ],
    'FINISH_EMPOWER' => [
        'minimum' => 3,
        'classes' => ['DISCIPLESHIP PROCESS 1', 'DISCIPLESHIP PROCESS 2', 'WHY ICAREGROUP?']
    ],
    'KIDS_AGE' => 14,
    'TEACHERS_MAX_NUM' => 2,
    'JOIN_START' => '2000',
    'JOIN_END' => \Carbon\Carbon::now()->year,
    'VALID_IMAGE_TYPES' => 'jpeg,bmp,png'
];

?>