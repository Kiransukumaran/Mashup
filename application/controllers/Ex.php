<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH.'libraries/Google.php');

class Ex extends CI_Controller {

	
	public function loadPage()
	{	
		$google = new Google;
		$data = $google->news('India');
		var_dump($data); die;
	}
}
