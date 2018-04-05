<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH.'libraries/wiky.inc.php');

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
			/*The data retrieval part.*/
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
			$data = $result;

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
                foreach ($headers as $k => $v) {
                    print $k . ": " . $v . "\n";
                }
                // $this->load->library('elasticsearch');
                // $elasticsearch = new Elasticsearch;
                // $id = 1337;
                // $data = array("name"=>"nisse", "age"=>"14", "sex"=>"male");
                // var_dump($elasticsearch->add("people", $id, $data));
                // die;

                // $res = $this->elasticsearch->add("abc","Hello Worlds");
                // echo "$res"; die;

                // print "\nJSON Response:\n\n";
                $dataz = json_encode(json_decode($json), JSON_PRETTY_PRINT);
                // var_dump($dataz); die;
                $dataz = json_decode($dataz	);
                // var_dump($dataz); die;
                $name = array();
                $desc = array();
                $url = array();
                for ($i=0; $i <10 ; $i++) { 
                    $n = $dataz->value[$i]->name;
                    $d = $dataz->value[$i]->description;
                    $u = $dataz->value[$i]->url;
                    array_push($name, $n);
                    array_push($desc, $d);
                    array_push($url, $u);
                }

                // var_dump($name); die;
            } else {

                print("Invalid Bing Search API subscription key!\n");
                print("Please paste yours into the source code.\n");

            }

			$credentials = array(
				'key' => $keyw,
				'data' => $data,
				'name' => $name,
				'desc' => $desc,
				'url' => $url);
			// var_dump($credentials); die;
			$this->load->view('outputLocation',$credentials);
		} else {
			$this->load->view('search');
		}
	}
}
			/*
			$news = array();
			foreach( $response->article as $key){
				$source = $key->source->name;
				$author = $key->author;
				$title = $key->title;
				$description = $key->description;
				$urlToImage = $key->urlToImage;
				$publishedAt = $key->publishedAt;

				$new = array(
				'source' => $source,
				'author' => $author,
				'title' => $title,
				'description' => $description,
				'urlToImage' => $urlToImage,
				'publishedAt' => $publishedAt);
				array_push($news,$new);
			}
			*/
