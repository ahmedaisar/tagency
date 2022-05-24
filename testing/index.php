<?php
 
require 'vendor/autoload.php';
 
$httpClient = new \Goutte\Client();
$response = $httpClient->request('GET', 'https://www.goway.com/trips/dest/asia/cntry/maldives/');
// get titles into an array
$data = [];
$titles = [];
$titleIndex = 0;
$ti = $response->filter('#primary-content > div > ul > li > div > div > h3 > a')->each(function ($node) use (&$titles) {
$titles[] = $node->text();
});

// get imgs into an array
$imgs = [];
$imgIndex = 0;
$allimgs = $response->filter('#primary-content > div > ul > li > div')->each(function ($node) use (&$imgs) {
$text = $node->filter('a')->html();
 
preg_match("<img.*?src=[\"\"'](?<url>.*?)[\"\"'].*?>",$text,$output);

for ($i=0; $i < count($output) ; $i++) { 
    $imgs[] = $output['url'];
}

});


// build final array

 $final = $response->filter('#primary-content > div > ul > li > div > div')->each(function ($node) use ($titles, &$titleIndex, &$imgs, &$data, &$imgIndex) {
 $data[]['title'] = $titles[$titleIndex];
 $data[]['content'] = $node->text();
 $data[]['img'] = $imgs[$imgIndex];
$titleIndex++;
$imgIndex++;

});


var_dump($data);
 
?>