<?php
include_once '../../vendor/autoload.php';

/**
 * Need Unit Test
 */

use \marshung\helper\ArrayHelper;
use \marshung\helper\DatetimeHelper;
use \marshung\helper\EncodeHelper;


function indexBy() {
    $data = [
        ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
        ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
    ];
    
    $expected = [
        'a110' => [
            'b1' => ['a001' => ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1']],
            'b2' => ['b012' => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2']],
        ],
    ];
    
    ArrayHelper::indexBy($data, ['c_sn','u_sn','u_no']);
    
    $theSame = theSame($data, $expected);
    if ($theSame) {
        echo __FUNCTION__ . ': OK...'."\n\n";
    } else {
        echo __FUNCTION__ . ': Different !!!'."\n\n";
    }
}

function groupBy()
{
    $data = [
        ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
        ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
        ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'user name 3'],
    ];
    
    $expected = [
        'a110' => [
            'b1' => ['a001' => [
                0 => ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1']
            ]
            ],
            'b2' => ['b012' => [
                0 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
                1 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'user name 3']
            ]
            ],
        ],
    ];
    
    ArrayHelper::groupBy($data, ['c_sn','u_sn','u_no']);
    $theSame = theSame($data, $expected);
    if ($theSame) {
        echo __FUNCTION__ . ': OK...'."\n\n";
    } else {
        echo __FUNCTION__ . ': Different !!!'."\n\n";
    }
}


function indexOnly()
{
    $data = [
        ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
        ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
    ];
    
    $expected = [
        'a110' => [
            'b1' => [
                'a001' => ''
            ],
            'b2' => [
                'b012' => ''
            ],
        ],
    ];
    
    ArrayHelper::indexOnly($data, ['c_sn','u_sn','u_no']);
    
    $theSame = theSame($data, $expected);
    if ($theSame) {
        echo __FUNCTION__ . ': OK...'."\n\n";
    } else {
        echo __FUNCTION__ . ': Different !!!'."\n\n";
    }
}

function getContent()
{
    $data = ['user' => ['name' => 'Mars', 'birthday' => '2000-01-01']];
    
    $theSame = true;
    
    $output = ArrayHelper::getContent($data);
    // $output: ['user' => ['name' => 'Mars', 'birthday' => '2000-01-01']];
    $theSame = $theSame && theSame($output, ['user' => ['name' => 'Mars', 'birthday' => '2000-01-01']]);
    
    
    $output = ArrayHelper::getContent($data, 'user');
    $theSame = $theSame && theSame($output, ['name' => 'Mars', 'birthday' => '2000-01-01']);
    // or
    $output = ArrayHelper::getContent($data, ['user']);
    // $output: ['name' => 'Mars', 'birthday' => '2000-01-01'];
    $theSame = $theSame && theSame($output, ['name' => 'Mars', 'birthday' => '2000-01-01']);
    
    $output = ArrayHelper::getContent($data, ['user', 'name']);
    // $outpu: Mars
    $theSame = $theSame && $output==='Mars';
    
    $output = ArrayHelper::getContent($data, ['user', 'name', 'aaa']);
    // $outpu: []
    $theSame = $theSame && theSame($output, []);
    
    if ($theSame) {
        echo __FUNCTION__ . ': OK...'."\n\n";
    } else {
        echo __FUNCTION__ . ': Different !!!'."\n\n";
    }
}


function gather()
{
    $data = [
        0 => ['sn' => '1785','m_sn' => '40','d_sn' => '751','r_type' => 'staff','manager' => '1','s_manager' => '1','c_user' => '506'],
        1 => ['sn' => '1371','m_sn' => '40','d_sn' => '583','r_type' => 'staff','manager' => '61','s_manager' => '0','c_user' => '118'],
        2 => ['sn' => '1373','m_sn' => '40','d_sn' => '584','r_type' => 'staff','manager' => '61','s_manager' => '0','c_user' => '118'],
        3 => ['sn' => '7855','m_sn' => '40','d_sn' => '2303','r_type' => 'staff','manager' => '71','s_manager' => '0','c_user' => '61'],
        4 => ['sn' => '7856','m_sn' => '40','d_sn' => '2304','r_type' => 'staff','manager' => '75','s_manager' => '0','c_user' => '61']
    ];
    
    $theSame = true;
    
    $ssnList1 = ArrayHelper::gather($data, array('manager', 's_manager','c_user'), 1);
    $ssnList2 = ArrayHelper::gather($data, array('manager' => array('manager'), 'other' => array('s_manager','c_user')), 1);
    
    $theSame = $theSame && theSame($ssnList1, [1 => '1',506 => '506',61 => '61',0 => '0',118 => '118',71 => '71',75 => '75']);
    $theSame = $theSame && theSame($ssnList2, [
        'manager' => [1 => '1',61 => '61',71 => '71',75 => '75'],
        'other' => [1 => '1',506 => '506',0 => '0',118 => '118',61 => '61']
    ]);
    
    if ($theSame) {
        echo __FUNCTION__ . ': OK...'."\n\n";
    } else {
        echo __FUNCTION__ . ': Different !!!'."\n\n";
    }
}

function diffRecursive()
{
    $data1 = [
        0 => ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
        1 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
        2 => ['c_sn' => 'a110', 'u_sn' => null, 'u_no' => 'c024', 'u_name' => 'name3'],
    ];
    $data2 = [
        0 => ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
        1 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2222'],
        2 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'c024', 'u_name' => 'user name 3'],
    ];
    
    $expected = [
        1 => ['u_name' => 'name2'],
        2 => ['u_sn' => NULL,'u_name' => 'name3']
    ];
    
    
    $arrayDiff = ArrayHelper::diffRecursive($data1, $data2);
    
    $theSame = theSame($arrayDiff, $expected);
    if ($theSame) {
        echo __FUNCTION__ . ': OK...'."\n\n";
    } else {
        echo __FUNCTION__ . ': Different !!!'."\n\n";
    }
}

function sortRecursive()
{
    $data1 = [
        'b1' => [
            0 => ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1']
        ],
        'b2' => [
            0 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
            1 => ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'user name 3']
        ],
    ];
    
    $data2 = $data1;
    
    $expected1 = [
        'b1' => [
            0 => ['c_sn' => 'a110','u_name' => 'name1','u_no' => 'a001','u_sn' => 'b1']
        ],
        'b2' => [
            0 => ['c_sn' => 'a110','u_name' => 'name2','u_no' => 'b012','u_sn' => 'b2'],
            1 => ['c_sn' => 'a110','u_name' => 'user name 3','u_no' => 'b012','u_sn' => 'b2']
        ]
    ];
    
    $expected2 = [
        'b2' => [
            1 => ['u_sn' => 'b2','u_no' => 'b012','u_name' => 'user name 3','c_sn' => 'a110'],
            0 => ['u_sn' => 'b2','u_no' => 'b012','u_name' => 'name2','c_sn' => 'a110']
        ],
        'b1' => [
            0 => ['u_sn' => 'b1','u_no' => 'a001','u_name' => 'name1','c_sn' => 'a110']
        ]
    ];
    
    ArrayHelper::sortRecursive($data1, 'ksort');
    ArrayHelper::sortRecursive($data2, 'krsort');
    
    $theSame = true;
    
    $theSame = $theSame && theSame($data1, $expected1);
    $theSame = $theSame && theSame($data2, $expected2);
    if ($theSame) {
        echo __FUNCTION__ . ': OK...'."\n\n";
    } else {
        echo __FUNCTION__ . ': Different !!!'."\n\n";
    }
}



function theSame($obj1, $obj2)
{
    return json_encode($obj1) == json_encode($obj2);
}


echo "<pre>";

indexBy();
groupBy();
indexOnly();
getContent();
gather();
diffRecursive();
sortRecursive();





