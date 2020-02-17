<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct() {
          // Construct the parent class
        parent::__construct();
        
    }
    
    public function index(){       
        $this->load->view('header', array('page_code'=>'dashboard'));
        $this->load->view('dashboard');
        $this->load->view('footer');
    }
}
