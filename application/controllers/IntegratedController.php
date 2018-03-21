<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH.'libraries/wiky.inc.php');
$GLOBALS['key'] = "";
class IntegratedController extends CI_Controller {

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
		$this->load->view('outputLocation');
	}
	public function dataRecognize()
	{	
		if($this->input->post()){
			//Getting the input
			$key = $this->input->post('Keyword');
			// echo $key;die;
			$sel = $this->input->post('select');
			if ($sel == "Location") {
				
				/*The data retrieval part.*/
				$res = file_get_contents("https://en.wikipedia.org/w/api.php?action=query&prop=revisions&titles=API|".$key."&rvprop=timestamp|user|comment|content&formatversion=2&format=json");
				$res = json_decode($res);
				$wikidata = $res->query->pages[0]->revisions[0]->content;
				$str = '\'\'\''.$key.'\'\'\'';
				$whatIWant = substr($wikidata, strpos($wikidata, $str) + 1);   
				$remove = substr($whatIWant,strpos($whatIWant,"==")+1);
				$data = str_replace($remove,"",$whatIWant);
				$wiky = new wiky;
				$input = $data;
				$input = htmlspecialchars($input);
				$result = $wiky->parse($input);
				$result = str_replace("[[", "" ,$result);
				$result = str_replace("]]", "" ,$result);
				$result = str_replace("=", "" ,$result);
				$result = str_replace("(", "" ,$result);
				$result = str_replace(")", "" ,$result);
				$result = str_replace("|", "," ,$result);
				$result = str_replace("<!--", "(" ,$result);
				$result = str_replace("-->", ")" ,$result);
				$result = preg_replace("({{[a-zA-Z0-9| [\].=(|):\/_-]+}})", " ", $result);
				$result = preg_replace('/{(.*?)}/', '', $result);
				$result = str_replace("}", "" ,$result);
				$data = $result;
				

				// Fetching datas from map api
				$response = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCjMDx-ZnkOy9YRyC7bYsKK6us6E7BYKsE&address='.$key);
				$response = json_decode($response);
				$lat = $response->results[0]->geometry->location->lat;
				$lng = $response->results[0]->geometry->location->lng;
				$location = array(
					'latitude' => $lat,
					'longitude' => $lng);

				
				/*Fetching news part*/
				$c_date = date("Y-m-d");
				$arrContextOptions=array(
			    	"ssl"=>array(
			        "verify_peer"=>false,
			        "verify_peer_name"=>false,
	    			),
				);  
				$response = file_get_contents('https://newsapi.org/v2/everything?q='.$key.'&from=2017-12-30&to=2018-02-27&sortBy=popularity&apiKey=a094589fed0a4f029ddb3c4d264084c7', false, stream_context_create($arrContextOptions));
				// &sources=google-news

				// Decode JSON data.&sortBy=popularity
				$response = json_decode($response);
				// Taking necessary values.
				$source = $response->articles[0]->source->name;
				$author = $response->articles[0]->author;
				$title = $response->articles[0]->title;
				$description = $response->articles[0]->description;
				$url = $response->articles[0]->url;
				$urlToImage = $response->articles[0]->urlToImage;
				$publishedAt = $response->articles[0]->publishedAt;
				// Store that values to an array.
				$news = array(
					'source' => $source,
					'author' => $author,
					'title' => $title,
					'description' => $description,
					'urlToImage' => $urlToImage,
					'publishedAt' => $publishedAt,
					'url' => $url);

				/* Data for the view */ 	
				$credentials = array(
					'key' => $key,
					'data' => $data,
					'location' => $location,
					'news' => $news);

				/*Loading view */
				$this->load->view('outputLocation',$credentials);
			} elseif ($sel == "People") {

				// echo "People"; die;
				$res = file_get_contents("https://en.wikipedia.org/w/api.php?action=query&prop=revisions&titles=API|".$key."&rvprop=timestamp|user|comment|content&formatversion=2&format=json");
			$res = json_decode($res);
			$wikidata = $res->query->pages[0]->revisions[0]->content;
			$str = '\'\'\''.$key.'\'\'\'';
			$whatIWant = substr($wikidata, strpos($wikidata, $str) + 1);   
			$remove = substr($whatIWant,strpos($whatIWant,"==")+1);
			$data = str_replace($remove,"",$whatIWant);
			$wiky = new wiky;
			$input = $data;
			$input = htmlspecialchars($input);
			$result = $wiky->parse($input);
			$result = str_replace("[[", "" ,$result);
			$result = str_replace("]]", "" ,$result);
			$result = str_replace("=", "" ,$result);
			$result = str_replace("(", "" ,$result);
			$result = str_replace(")", "" ,$result);
			$result = str_replace("|", "," ,$result);
			$result = str_replace("<!--", "(" ,$result);
			$result = str_replace("-->", ")" ,$result);
			$result = preg_replace("({{[a-zA-Z0-9| [\].=(|):\/_-]+}})", " ", $result);
			$result = preg_replace('/{(.*?)}/', '', $result);
			$result = str_replace("}", "" ,$result);
			$data = $result;

			/* Grabing news */
			$c_date = date("Y-m-d");
			$arrContextOptions=array(
		    	"ssl"=>array(
		        "verify_peer"=>false,
		        "verify_peer_name"=>false,
    			),
			);  
			$response = file_get_contents('https://newsapi.org/v2/everything?q='.$key.'&from=2017-12-30&to=2018-02-27&sortBy=popularity&apiKey=a094589fed0a4f029ddb3c4d264084c7', false, stream_context_create($arrContextOptions));
			// &sources=google-news

			// Decode JSON data.&sortBy=popularity
			$response = json_decode($response);
			// Taking necessary values.
			$source = $response->articles[0]->source->name;
			$author = $response->articles[0]->author;
			$title = $response->articles[0]->title;
			$description = $response->articles[0]->description;
			$url = $response->articles[0]->url;
			$urlToImage = $response->articles[0]->urlToImage;
			$publishedAt = $response->articles[0]->publishedAt;
			// Store that values to an array.
			$news = array(
				'source' => $source,
				'author' => $author,
				'title' => $title,
				'description' => $description,
				'urlToImage' => $urlToImage,
				'publishedAt' => $publishedAt,
				'url' => $url);

			// Store that values to an array.
			$news = array(
				'source' => $source,
				'author' => $author,
				'title' => $title,
				'description' => $description,
				'urlToImage' => $urlToImage,
				'publishedAt' => $publishedAt);

			$credentials = array(
				'key' => $key,
				'data' => $data,
				'news' => $news);
			// var_dump($credentials); die;
			$this->load->view('outputPeople',$credentials);

			} elseif ($sel == "Email") {
				// echo "Email";die;
				$response = file_get_contents('/var/www/html/project/assets/json/sreenath.json');

			// Decode JSON data.
			$response = json_decode($response);
			// var_dump($response); die;
			$name = $response->person->names[0]->display;
			$phone = $response->person->phones[0]->display_international;
			$gender = $response->person->gender->content;
			$address = $response->person->addresses[0]->display;
			$imgUrl = array();
			foreach ($response->person->images as $key) {
				array_push($imgUrl,$key->url);
			}
			// $domain = $response->person->urls->name;
			// $sites = array();
			$social = array();
			foreach ($response->person->urls as $key) {
				array_push($social, $key->url);
			}
			// var_dump($social); die;
			$data = array(
				'key' => $key,
				'name' => $name,
				'phone' => $phone,
				'gender' => $gender,
				'address' => $address,
				'imgUrl' => $imgUrl,
				'social' => $social);
			var_dump($data); die;
			}

		} else {
			$this->load->view('index');
		}
	}
}
			// var_dump($credentials); die;
			// $data=$this->wikitexttohtml->convertWikiTextToHTML($data);
			// $data = preg_replace('/\{\{\}\}/', '', $data);  
			// echo $data; die; 
			// Display result of the module.
			// echo preg_replace('/[\[{\(].*[\]}\)]/U' , '', $name);
// $this->load->libraries('wiky.inc.php');			
			// Data collection part
			// 
			// // Get data on the keyword.
			// $wikidata = file_get_contents('https://en.wikipedia.org/w/api.php?action=query&titles='.$key.'&prop=revisions&rvprop=content&redirects&format=json&formatversion=2');
			// // api.php?action=query&prop=revisions&titles=API|'.$key.'&rvprop=timestamp|user|comment|content&formatversion=2&format=json 
			// // Decode the JSON data to array.
			
			// $wikidata = json_decode($wikidata);
			// // Extracting required content only.
			// $wikidata = $wikidata->query->pages[0]->revisions[0]->content;
			// // $whatIWant = $wikidata;
			// $str = '\'\'\''.$key.'\'\'\'';
			// $whatIWant = substr($wikidata, strpos($wikidata, $str) + 1);   
			// $remove = substr($whatIWant,strpos($whatIWant,"==")+1);
			// $data = str_replace($remove,"",$whatIWant);
			// $wiky=new wiky;
			// $input = $data;
			// $input=htmlspecialchars($input);
			// $result = $wiky->parse($input);
			// $result = str_replace("[[","",$result);
			// $result = str_replace("]]","",$result);
			// $result = preg_replace("({{[a-zA-Z0-9| [\].=(|):\/_-]+}})", " ", $result);
			// $data = str_replace("|",", ",$result);
			// $data = str_replace("=",", ",$data);
			// $data = str_replace("#",", ",$data);
			// $data = preg_replace('/<!--(.|\s)*?-->/', '', $data);
			// $data = preg_replace('/[{\(].*.[}\)]/U' , '', $data);
			// Location access part
			// $input = $this->input->post('Keyword');
			// News fetching part
			// $input = $this->input->post('Keyword');
			// Fetching data.
