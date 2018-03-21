<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsController extends CI_Controller {

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
	public function index()
	{	
		if ($this->input->post()){
		    var_dump($this->input->post()); die;
		} else {
			$this->load->view('index');
		}
	}
	public function callApi()
	{	
		if( $this->input->post() ){
			// Receive the keyword from. 
			$input = $this->input->post('Keyword');
			// Fetching data.
			$response = file_get_contents('/var/www/html/project/assets/json/apple_news.json');

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
			$this->load->view('news');
		}	

	}
	
}
