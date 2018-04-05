<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(APPPATH.'libraries/ContentExtractor.php');
include(APPPATH.'libraries/wiky.inc.php');

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
	public function getNews()
	{	
		if( $this->input->post() ){
			$keyw = $this->input->post('Keyword');
			$keyw = ucfirst($keyw);
			$keyw = urlencode($keyw);
			
			
			// "https://www.bing.com/images/search?q=India"
			// var_dump($credentials); die;
			$this->load->view('outputPeople',$credentials);
			
		} else {
			$this->load->view('search');
		}	

	}
	
}


