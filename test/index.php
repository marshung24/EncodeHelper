<?php
include_once '../vendor/autoload.php';

use marsapp\dev\tools\DevTools;
use marsapp\helper\encode\EncodeHelper;

echo '<pre>';

/**
 * Test snapshotEncode
 */
function testEncode() {
    $data = [
        ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
        ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
    ];
    
    $expected = '2i65WSo4vzlOyUko0NDRQ0lEqhfCSDMHsvHyQjIEBlJeYmwrkgyhDpVodXFqNEFqTDAyN0LUaKdXGAgA=';
    
    $result = EncodeHelper::snapshotEncode($data);
    
    $theSame = DevTools::theSame($result, $expected);
    DevTools::isTheSame($theSame, __FUNCTION__);
}

/**
 * Test snapshotDecode
 */
function testDecode() {
    $data = '2i65WSo4vzlOyUko0NDRQ0lEqhfCSDMHsvHyQjIEBlJeYmwrkgyhDpVodXFqNEFqTDAyN0LUaKdXGAgA=';
    
    $expected = [
        ['c_sn' => 'a110', 'u_sn' => 'b1', 'u_no' => 'a001', 'u_name' => 'name1'],
        ['c_sn' => 'a110', 'u_sn' => 'b2', 'u_no' => 'b012', 'u_name' => 'name2'],
    ];
    
    $result = EncodeHelper::snapshotDecode($data);
    
    $theSame = DevTools::theSame($result, $expected);
    DevTools::isTheSame($theSame, __FUNCTION__);
}



echo "<pre>";

// Test snapshotEncode
testEncode();

// Test snapshotDecode
testDecode();



