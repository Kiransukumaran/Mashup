<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH.'libraries/wiky.inc.php');
include(APPPATH.'libraries/ContentExtractor.php');


class PeopleController extends CI_Controller {

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
		$this->load->view('welcome_message');
	}
	public function getPeopleData()
	{
		if($this->input->post()){


			
			$keyw = $this->input->post('Keyword');
			$keyw = ucwords($keyw);
			
			/*The data retrieval part.*/
			if ($this->input->post('option') == 'Location') {
				# code...
				$res = file_get_contents("https://en.wikipedia.org/w/api.php?action=query&prop=revisions&titles=API|".urlencode($keyw)."&rvprop=timestamp|user|comment|content&formatversion=2&format=json");
				$res = json_decode($res);
				$wikidata = $res->query->pages[0]->revisions[0]->content;
				$str = '\'\'\''.$keyw.'\'\'\'';
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
				$dataw = $result;	
			} else {
				$api_key = 'simiRphs/AvKneH6kJtjyMHyCuE1';
				$algorithm = 'web/WikipediaParser/0.1.2';
				$data = $keyw;
				$data_json = json_encode($data);
				$ch = curl_init();
				$headers = array(
				  'Content-Type: application/json',
				  'Authorization: Simple ' . $api_key,
				  'Content-Length: ' . strlen($data_json)
				);
				curl_setopt_array($ch, array(
				  CURLOPT_URL => 'https://api.algorithmia.com/v1/algo/' . $algorithm,
				  CURLOPT_HTTPHEADER => $headers,
				  CURLOPT_POSTFIELDS => $data_json,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_POST => true
				));
				$response_json = curl_exec($ch);
				curl_close($ch);
				$response = json_decode($response_json);
				$dataw = $response->result->content;
				// var_dump($dataw); die;
				$api_key = 'simiRphs/AvKneH6kJtjyMHyCuE1';
				$algorithm = 'nlp/Summarizer/0.1.7';
				$data = $dataw;
				$data_json = json_encode($data);
				$ch = curl_init();
				$headers = array(
				  'Content-Type: application/json',
				  'Authorization: Simple ' . $api_key,
				  'Content-Length: ' . strlen($data_json)
				);
				curl_setopt_array($ch, array(
				  CURLOPT_URL => 'https://api.algorithmia.com/v1/algo/' . $algorithm,
				  CURLOPT_HTTPHEADER => $headers,
				  CURLOPT_POSTFIELDS => $data_json,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_POST => true
				));
				$response_json = curl_exec($ch);
				curl_close($ch);
				$response = json_decode($response_json);
				// var_dump($response); die;
				$lnews = $response->result;
				$dataw = $lnews;
			}

            /*------------------------------------------------------------------------------------*/
            /*------------------------------------------------------------------------------------*/
            /*------------------------------------------------------------------------------------*/

            $location = array();

            if($this->input->post('option') == "Location"){
            	$response = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyCjMDx-ZnkOy9YRyC7bYsKK6us6E7BYKsE&address='.$keyw);
				$response = json_decode($response);
				$lat = $response->results[0]->geometry->location->lat;
				$lng = $response->results[0]->geometry->location->lng;
				$location = array(
					'latitude' => $lat,
					'longitude' => $lng);
            }

            /*------------------------------------------------------------------------------------*/
            /*------------------------------------------------------------------------------------*/
            /*------------------------------------------------------------------------------------*/

            $news = simplexml_load_file('https://news.google.com/news?pz=1&cf=all&ned=us&hl=en&topic=India&output=rss&q='.$keyw.'');

			$feeds = array();

			$i = 0;

			foreach ($news->channel->item as $item) 
			{
			    preg_match('@src="([^"]+)"@', $item->description, $match);
			    $parts = explode('<font size="-1">', $item->description);

			    $feeds[$i]['title'] = (string) $item->title;
			    $feeds[$i]['link'] = (string) $item->link;
		
			    $i++;
			}
			$inputData = "";
			

			for ($i=1; $i <=10 ; $i++) { 
				
				$link = substr($feeds[$i]['link'],strpos($feeds[$i]['link'],"&url=")+1);
				$urln = str_replace("url=","",$link);
				// $data = file_get_contents($urln);
				$api_key = 'simiRphs/AvKneH6kJtjyMHyCuE1';
				$algorithm = 'nlp/SummarizeURL/0.1.4';
				$data = $urln;
				$data_json = json_encode($data);
				$ch = curl_init();
				$headers = array(
				  'Content-Type: application/json',
				  'Authorization: Simple ' . $api_key,
				  'Content-Length: ' . strlen($data_json)
				);
				curl_setopt_array($ch, array(
				  CURLOPT_URL => 'https://api.algorithmia.com/v1/algo/' . $algorithm,
				  CURLOPT_HTTPHEADER => $headers,
				  CURLOPT_POSTFIELDS => $data_json,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_POST => true
				));
				$response_json = curl_exec($ch);
				curl_close($ch);
				$response = json_decode($response_json);
				// var_dump($response); die;
				$lnews = $response->result;
				$inputData = $inputData."<br/><br/>".$lnews;
			}


			$lnews = $inputData;
			
		
			

            /*------------------------------------------------------------------------------------*/
            /*------------------------------------------------------------------------------------*/
            /*------------------------------------------------------------------------------------*/

			// Data Summeriser.( Using LDA and NLPA Algorithm).
			// $api_key = 'simiRphs/AvKneH6kJtjyMHyCuE1';
			// $algorithm = 'nlp/Summarizer/0.1.7';
			// $data = $inputData;
			// $data_json = json_encode($data);
			// $ch = curl_init();
			// $headers = array(
			//   'Content-Type: application/json',
			//   'Authorization: Simple ' . $api_key,
			//   'Content-Length: ' . strlen($data_json)
			// );
			// curl_setopt_array($ch, array(
			//   CURLOPT_URL => 'https://api.algorithmia.com/v1/algo/' . $algorithm,
			//   CURLOPT_HTTPHEADER => $headers,
			//   CURLOPT_POSTFIELDS => $data_json,
			//   CURLOPT_RETURNTRANSFER => true,
			//   CURLOPT_POST => true
			// ));
			// $response_json = curl_exec($ch);
			// curl_close($ch);
			// $response = json_decode($response_json);
			// // var_dump($response); die;
			// $lnews = $response->result;


            /*------------------------------------------------------------------------------------*/
            /*------------------------------------------------------------------------------------*/
            /*------------------------------------------------------------------------------------*/
            
			/* Grabing news */
			$term = $keyw;
            $accessKey = '6faa87ec09014447b209029c68f5b20c';
            $endpoint = 'https://api.cognitive.microsoft.com/bing/v7.0/news';

            

            function BingWebSearch ($url, $key, $query) {
                // Prepare HTTP request
                // NOTE: Use the key 'http' even if you are making an HTTPS request. See:
                // http://php.net/manual/en/function.stream-context-create.php
                $headers = "Ocp-Apim-Subscription-Key: $key\r\n";
                $options = array ('http' => array (
                                      'header' => $headers,
                                       'method' => 'GET'));

                // Perform the Web request and get the JSON response
                $context = stream_context_create($options);
                $result = file_get_contents($url . "?q=" . urlencode($query).'&responseFilter=news%2Cimages&value='.urlencode($query).'', false, $context);

                // Extract Bing HTTP headers
                $headers = array();
                foreach ($http_response_header as $k => $v) {
                    $h = explode(":", $v, 2);
                    if (isset($h[1]))
                        if (preg_match("/^BingAPIs-/", $h[0]) || preg_match("/^X-MSEdge-/", $h[0]))
                            $headers[trim($h[0])] = trim($h[1]);
                }

                return array($headers, $result);
            }

            if (strlen($accessKey) == 32) {

                // print "Searching the Web for: " . $term . "\n";

                list($headers, $json) = BingWebSearch($endpoint, $accessKey, $term);

                // print "\nRelevant Headers:\n\n";
                // foreach ($headers as $k => $v) {
                //     print $k . ": " . $v . "\n";
                // }
                
            	$dataz = json_encode(json_decode($json), JSON_PRETTY_PRINT);
            	$dataz = json_decode($dataz	);
                $name = array();
                $desc = array();
                $url = array();
                for ($i=0; $i <5 ; $i++) { 
                    $n = $dataz->value[$i]->name;
                    $d = $dataz->value[$i]->description;
                    $u = $dataz->value[$i]->url;
                    array_push($name, $n);
                    array_push($desc, $d);
                    array_push($url, $u);
                }
            
            } else {

                print("Invalid Bing Search API subscription key!\n");
                print("Please paste yours into the source code.\n");

            }

            /*------------------------------------------------------------------------------------*/
            /*------------------------------------------------------------------------------------*/
            /*------------------------------------------------------------------------------------*/


            if(!empty($location)){

				$credentials = array(
					'key' => $keyw,
					'data' => $dataw,
					'name' => $name,
					'desc' => $desc,
					'url' => $url,
					'location' => $location,
					'lnews' =>$lnews
				);

            } else {

				$credentials = array(
					'key' => $keyw,
					'data' => $dataw,
					'name' => $name,
					'desc' => $desc,
					'url' => $url,
					'lnews' =>$lnews

				);
            }
			// var_dump($credentials); die;
			$this->load->view('outputPeople',$credentials);
		} else {
			$this->load->view('search');
		}
	}
}
			