<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Goutte;
class MainController extends Controller
{
    public function list()
    {
    	$listUrl = app('db')->table('link')->orderBy('created_at', 'desc')->get();
    	return view('list')->with('data', $listUrl);
    }

    public function linkDetail($id)
    {
    	$link = app('db')->table('link')->where('id', $id)->first();
    	$comments = app('db')->table('comments')->where('link_id', $id)->orderBy('created_at', 'desc')->get();
    	return view('detail')->with('data', $link)
    						->with('comments', $comments);
    }
    public function process()
    {
	    $input = request()->get('url', 'https://fabelio.com/cp/dekorasi-rumah/hiasan/keranjang.html');
	    $crawler = Goutte::request('GET', $input);
	    $data = [];
	    try {
	    	$data = $this->checkDetail($crawler);
	    } catch (\InvalidArgumentException $e) {
	    	$data = [];
	    }
	    app('db')->table('link')->insert([
	    	'url' => $input, 
	    	'product_name' => trim($data['name']),
	    	'product_desc' => trim($data['description']),
	    	'product_price' => (int) str_replace('.', '', str_replace('Rp ', '', $data['price'])),
	    	'created_at' => date('Y-m-d H:i:s')
	    ]);
    	// return view('result', $data)->with('data', $data);
    }

    public function checkCondition1($crawler)
    {
    	$data = $crawler->filter('.product-item')->each(function (Crawler $node) {
    		$name = $node->filter('.product.name')->text();
          	$price = (int) str_replace('.', '', str_replace('Rp ', '', trim($node->filter('.price')->text())));
          	$description = $node->filter('.product-item-name__secondary')->text();
          	$images = $node->filter('.product-image-photo')->attr('src');
	         return [
	    		'name' => $name, 
	    		'price' => $price, 
	    		'description' => $description, 
	    		'images' => $images
	    	];
	    });
	    return $data;
    }

    public function checkDetail($crawler)
    {
    	$name = $crawler->filter('.page-title')->text();
    	$price = $crawler->filter('.price')->text();
    	$description = $crawler->filter('#description')->text();
    	$secondaryName = $crawler->filter('.page-title__secondary')->html();
    	// $image2 = $crawler->filter('.fotorama__img')->attr('src');
    	try {
    		$images = $crawler->filter('.fotorama__nav')->each(function(Crawler $node){
    			$image = $node->filter('fotorama__thumb .fotorama_img')->attr('src');
    			return $image;
    		});
    	} catch (\InvalidArgumentException $e) {
    		$images = [];
    	}
    	return [
    		'name' => $name, 
    		'price' => $price, 
    		'description' => $description,
    		'secondaryName' => $secondaryName,
    		// 'images' => $image2
    	];
    	// return $image;
    }
}