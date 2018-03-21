<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends CI_Controller {

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
	public function getEmailContent()
	{
		if ( $this->input->post() ){
			$input = $this->input->post('Keyword');
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
				'input' => $input,
				'name' => $name,
				'phone' => $phone,
				'gender' => $gender,
				'address' => $address,
				'imgUrl' => $imgUrl,
				'social' => $social);
			var_dump($data); die;
			


			

		} else {
			$this->load->view('index');
		}
	}
}
