<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImageController extends CI_Controller {

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
		// if ($this->input->post()) {

		// 	$data = $this->input->post('fname');
		// 	var_dump($data); die;
		// 	# code...
				$urln = "";
				$api_key = 'simiRphs/AvKneH6kJtjyMHyCuE1';
				$algorithm = 'ocr/RecognizeCharacters/0.3.0';
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
				// var_dump($response); die;->result
				$lnews = $response;
				var_dump($lnews); die;
		// } else {
		// 	$this->load->view('image');
		// }
	}
}



