<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."libraries/support/web_browser.php";
require_once APPPATH."libraries/support/tag_filter.php";

class ExportData extends CI_Controller {

    public function __construct() {
        // Construct the parent class
      parent::__construct();
      $this->load->model('mainModel', 'main');
      $this->main->setTb('export');
  }

  private function respJSON( $data='') {
      header("Content-Type: application/json; charset=UTF-8");
      if(empty($data)) $data = array('result'=>0);
      echo json_encode($data);
  }
  
  public function index(){       
	$this->main->setTb('export');
      $data = array(
          'page_title' => 'Awwwards Export Data Project List',
          'list'=>$this->main->get_list()
      );
      $this->load->view('header', array('page_code'=>'export_list'));
      $this->load->view('export_list', $data);
      $this->load->view('footer');
  }
  
  public function add(){       
      $data = array('page_title'=>'Awwwards Export Data Project Add');
      $this->load->view('header', array('page_code'=>'export_add'));
      $this->load->view('add', $data);
      $this->load->view('footer');
  }

  public function update_process() { 
    $this->main->setTb('export');
	$id = $this->input->post('id');
    $data = array(
        'name' => $this->input->post('name'),
        'domains' => $this->input->post('domains'),
        'username' => $this->input->post('username'),
        'password' => $this->input->post('password'),
        's_date' => date('Y-m-d H:i:s')
    );        
    $result = $this->main->update($data, $id);
    
    $this->respJSON(array('result'=>$result));
  }

  public function edit($id) {
      $this->main->setTb('export');
	  $data = array(
          'page_title'=>'Awwwards Export Data Project Edit',
          'item'=>$this->main->get($id)
      );
      $this->load->view('header', array('page_code'=>'export_add'));
      $this->load->view('add', $data);
      $this->load->view('footer');
  }

  public function update_status() { 
        $id=$this->input->post('id');
        $result_file="";
        if(!file_exists("./app-assets/download_files/export".$id.".csv")){
            $status="No download file exists! Please run it.";
        }else{
            $result_file="export".$id.".csv";
            $status=1;
        }
        
        $res=["result"=>$status, "result_file"=>$result_file];
        echo json_encode($res);
  }

  public function update_status1() { 
    $this->main->setTb('export');
	$id = $this->input->post('id');
    $row=$this->main->get($id);
    $result_file="";
    if($row->status==0){
        $domains=$row->domains;
        $domains=explode("\n", $domains);
        $email=$row->username;
        $password=$row->password;
        $main_url = "https://www.awwwards.com/websites/";
        
        // Turn on the automatic forms extraction option.  Note that Javascript is not executed.
        $web = new WebBrowser(array("extractforms" => true));
        
        $contents="";
        foreach($domains as $domain_url){
            $domain_url=trim($domain_url);
            $htmloptions = TagFilter::GetHTMLOptions();
            $url = $domain_url;
            $result = $web->Process($url);

            if (!$result["success"])
            {
                echo "Error retrieving URL.  " . $result["error"] . "\n";
                exit();
            }

            if ($result["response"]["code"] != 200)
            {
                echo "Error retrieving URL.  Server returned:  " . $result["response"]["code"] . " " . $result["response"]["meaning"] . "\n";
                exit();
            }
            sleep(30);
            $contents.=$result['body'];
        }
        
        $result_file=Date("U").".csv";
        $fp = fopen("./app-assets/download_files/".$result_file, 'w');
        fwrite($fp, $contents);
        fclose($fp);
        $data=["status"=>1, "result_file"=>$result_file];
        $status = $result = $this->main->update($data, $id);
    }else{
        $result_file=$row->result_file;
        $status=1;
    }
    $this->respJSON(array('result'=>$status, 'result_file'=>$result_file));
  }

  public function delete() {
      $this->main->setTb('export');
	  $ids = $this->input->post('ids');
      $result = $this->main->delete($ids);
      $this->respJSON(array('result'=>$result));
  }
  
   public function mark(){       
      $data = array('page_title'=>'Awwwards Export Data Project Mark');
      $this->load->view('header', array('page_code'=>'export_mark'));
      $this->load->view('mark', $data);
      $this->load->view('footer');
  }
  public function update_mark() { 
		$mark_text = $this->input->post('domains');
		$list=$this->main->get_marklist();
		$result_file="";
		$id = 0;
		$cnt = 0;
		$this->main->setTb('result_mark');
		if(!empty($list)){			
			foreach($list as $item) {
				$no=$item->no;
				//$categories = $item->category;
				$mark = 0;
				$categories = explode("/", $item->category);
				 foreach($categories as $category){
					$category=str_replace("-"," ",trim($category));
					if($mark_text!="" && $category!=""){
						$mark = $mark + substr_count($mark_text, $category);
					}
				 }
				 $data = array(
					'category' => $item->category,
					'url' => $item->url,
					'mark' => $mark,
					'maintype' => $item->maintype
				);   
				$result = $this->main->update($data, $id);
				$cnt = $cnt + 1;
			}
			
		}
		$this->respJSON(array('result'=>"1", 'result_cnt'=>$cnt));
  }
}
