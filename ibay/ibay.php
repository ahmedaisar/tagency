<?php
 
require 'vendor/autoload.php';
 
$httpClient = new \Goutte\Client();
$response = $httpClient->request('GET', 'https://ibay.com.mv/apartments-houses-for-rent-b25_0.html');
// get titles into an array
$index = 0;
$data = [];
$titles = [];

$x = $response->filterXpath('//*[@id="iw-mid-container"]/div/div//div//div/div/div/div/div//h5/a')->each(function ($node) use (&$titles) {
$titles[] = $node->text();
});

$imgs = [];

$v = $response->filter('div.col.m3.s4 > div > a > img')->each(function ($node) use (&$imgs, &$titles, &$index, &$data) {
    
$imgs[] = $node->attr('src');   

$data['title'][] = $titles[$index];
$data['img'][] = $imgs[$index];

 
$index++;
});

$links = [];
$href = $response->filter('div.col.m7.s8 > h5 > a')->each(function ($node) use (&$links) {
  $links[] = $node->attr('src');
     

});

 
var_dump($links);
 
?>