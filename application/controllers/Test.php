<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH.'libraries/elasticsearch.php');

class Test extends CI_Controller {

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
            $elasticsearch = new Elasticsearch;
                $id = 1337;
                $data = array("name"=>"nisse", "age"=>"14", "sex"=>"male");
                var_dump($elasticsearch->add("people", $id, $data));
                echo "\n";
                var_dump($elasticsearch->get("people", $id));
                die;
        } else {
            $this->load->view('search');
       }
    }


    public function entitySearch()
    {
        if($this->input->post()){
            $key = $this->input->post('Keyword');
            $subscriptionKey = 'efd99fb68a4945929e8f88ece04ce594';

            $host = "https://api.cognitive.microsoft.com";
            $path = "/bing/v7.0/entities";

            $mkt = "en-US";
            $query = "".$key."";

            function search ($host, $path, $key, $mkt, $query) {

                $params = '?mkt=' . $mkt . '&q=' . urlencode ($query);

                $headers = "Ocp-Apim-Subscription-Key: $key\r\n";

                // NOTE: Use the key 'http' even if you are making an HTTPS request. See:
                // http://php.net/manual/en/function.stream-context-create.php
                $options = array (
                    'http' => array (
                        'header' => $headers,
                        'method' => 'GET'
                    )
                );
                $context  = stream_context_create ($options);
                $result = file_get_contents ($host . $path . $params, false, $context);
                return $result;
            }

            $result = search ($host, $path, $subscriptionKey, $mkt, $query);

            $data = json_encode (json_decode ($result), JSON_PRETTY_PRINT);
            var_dump($data); die;
        } else {
            $this->load->view('search');
        }

    }
}
