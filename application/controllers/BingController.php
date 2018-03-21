<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH.'libraries/elasticsearch.php');


class BingController extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        if ($this->input->post('Keyword')) {
            
            $term = $this->input->post('Keyword');
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
                $elasticsearch = new Elasticsearch;
                // $id = 1337;
                // $data = array("name"=>"nisse", "age"=>"14", "sex"=>"male");
                // var_dump($elasticsearch->add("people", $id, $data));
                // die;

                // $res = $this->elasticsearch->add("abc","Hello Worlds");
                // echo "$res"; die;

                // print "\nJSON Response:\n\n";
                $data = json_encode(json_decode($json), JSON_PRETTY_PRINT);
                $data = json_decode($data);
                var_dump($data); die;
                
                $urls = array();
                $url_data = array();
                // $l = $data->webPages;
                for ($i=0; $i <10 ; $i++) { 
                $url = $data->webPages->value[$i]->url;
                $d = file_get_contents($url);
                array_push($urls, $url);    
                array_push($url_data, $d);
                }
                
                $id = 1;
                var_dump($elasticsearch->add("data",$id,$url_data)); die;
                // var_dump(json_last_error()); die; 
                var_dump($data); die;
            } else {

                print("Invalid Bing Search API subscription key!\n");
                print("Please paste yours into the source code.\n");

            }
        } else {
            $this->load->view('search');
        }
    }
}