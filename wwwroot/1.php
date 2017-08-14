<?php
echo '<pre/>';
//$dom=new DOMDocument('1.0','utf-8');
//$dom->load('http://flash.weather.com.cn/wmaps/xml/sichuan.xml');
////var_dump($dom);
//$cityNodeList=$dom->getElementsBytagName('city');
////var_dump($cityNodeList);
//foreach($cityNodeList as $cityNode){
//    echo($cityNode->getAttribute('cityname').'==='.$cityNode->getAttribute('stateDetailed').'<br/>');
//}

$xml=simplexml_load_file('http://flash.weather.com.cn/wmaps/xml/sichuan.xml');
//var_dump($xml);exit;
foreach($xml->city as $city){
    echo ($city['cityname'].'==='.$city['stateDetailed'].'<br/>');
}










