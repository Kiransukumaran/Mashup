<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	// Start page function.
	public function startPage()
	{	
		if ($this->input->post()){
		    var_dump($this->input->post()); die;
		} else {
			$this->load->view('index');
		}
	}
	// Gets data on a particular location.
	public function locationData()
	{	
		if($this->input->post()){
			// Receive the keyword from the form post.
			$key = $this->input->post('Keyword');
			// Get data on the keyword.
			$response = file_get_contents('https://en.wikipedia.org/w/api.php?action=query&titles='.$key.'&prop=revisions&rvprop=content&format=json&formatversion=2');
			// Decode the JSON data to array.
			$response = json_decode($response);
			// Extracting required content only.
			$response = $response->query->pages[0]->revisions[0]->content;
			$str = '\'\'\''.$key.'\'\'\'';
			$whatIWant = substr($response, strpos($response, $str) + 1);   
			$remove=substr($whatIWant,strpos($whatIWant,"==")+1);
			$data=str_replace($remove,"",$whatIWant); 
			// Display result of the module.
			echo preg_replace('/[\[{\(].*[\]}\)]/U' , '', $data); die;

			
			// Testing Usage.
			// $response = file_get_contents('/var/www/html/projectphp/assets/json/wiki_india.json');
			// echo $remove; die;
			// $data=$whatIWant-$remove;
			// echo $data;  die;
			// echo $whatIWant; die;
			// echo $pos; die;
			// var_dump(json_decode($response)); die;
		} else {

			$this->load->view('index');
		}
	}

	// public function userData()
	// {

	// }

	public function getCoordinates()
	{	
		if ( $this->input->post()){
			// Read input from form.
			$input = $this->input->post('Keyword');

			// Fetching datas from map api
			$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$input);
			// Decoding the data from JSON to array
			$response = json_decode($response);
			// Extracting Latitude and Longitude.
			$lat = $response->results[0]->geometry->location->lat;
			$lng = $response->results[0]->geometry->location->lng;
			// Storing data in an array
			$location = array(
				'latitude' => $lat,
				'longitude' => $lng);
			var_dump($location); die;
			// Sending data to view
			$this->load->view('map',$location);
		} else {

			$this->load->view('index');
		}
	} 



	


		// Testing Values
		// var_dump($response->results[0]->geometry->location);die;
	// public function getWeather()
	// {
	// 	$response = file_get_contents('http://www.google.com/ig/api?weather=');
	// }

	public function getStaticMap()
	{
		if($this->input->post()){
			$input = $this->input->post('Keyword');
			$this->load->view('staticmap',$input);
		} else {
			$this->load->view('index');
		}
	} 

	public function latestNews()
	{	
		if( $this->input->post() ){
			// Receive the keyword from. 
			$input = $this->input->post('Keyword');
			// Fetching data.
			$response = file_get_contents('https://newsapi.org/v2/everything?q='.$input.'&from=2017-12-30&to=2017-12-30&sortBy=popularity&apiKey=aaedff434f174c9fb0e600e176091b19');

			// Decode JSON data.
			$response = json_decode($response);
			// Taking necessary values.
			$source = $response->articles[0]->source->name;
			$author = $response->articles[0]->author;
			$title = $response->articles[0]->title;
			$description = $response->articles[0]->description;
			$urlToImage = $response->articles[0]->urlToImage;
			$publishedAt = $response->articles[0]->publishedAt;
			// Store that values to an array.
			$credentials=array(
				'source' => $source,
				'author' => $author,
				'title' => $title,
				'description' => $description,
				'urlToImage' => $urlToImage,
				'publishedAt' => $publishedAt);
			var_dump($credentials); die;
			
			// Transfer it to the view.
			$this->load->view('output');

			// Testing Purpose
			// var_dump($response->articles[0]->source->name); die;
		} else {
			$this->load->view('index');
		}	

	}
	
}
