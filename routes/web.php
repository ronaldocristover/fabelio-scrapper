<?php

Route::get('/', function () {
    return view('index');
});
use Symfony\Component\DomCrawler\Crawler;
Route::post('process', 'MainController@process');
Route::get('link', 'MainController@list');
Route::get('link/{id}', 'MainController@linkDetail');
Route::post('comment/create', 'CommentController@create');
Route::get('vote/{id}/{type}', 'CommentController@vote');

Route::post('scrapper/process', function() {

    $input = request()->get('url', 'https://fabelio.com/cp/dekorasi-rumah/hiasan/keranjang.html');
    $crawler = Goutte::request('GET', $input);

    $returnArr = [];
    $data = $crawler->filter('.product-item')->each(function (Crawler $node) {
    	// div.product.details.product-item-details > strong > a > span
    	$name = ($node->filter('.product.details.product-item-details > strong > a > span')->text()) ? '': $node->filter('.product.details.product-item-details > strong > a > span')->text();
          $price = (int) str_replace('.', '', str_replace('Rp ', '', trim($node->filter('.special-price')->text())));
          $description = $node->filter('.product-item-name__secondary')->text();
          $images = $node->filter('.product-image-photo')->text();

    	return [
    		'name' => $name, 
    		'price' => $price, 
    		'description' => $description, 
    		'images' => $images
    	];
    	// dump($node->text());
    	// dump($node);
    });
    dump($data);
});