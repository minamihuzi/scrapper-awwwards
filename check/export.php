<?php
set_time_limit(0);
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Pool;
use Yangqi\Htmldom\Htmldom;

$id=$_POST['id'];

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,"analysis");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($_POST['action']=="delete"){
    //if(file_exists($out_domain_file_path))unlink($out_domain_file_path);
    echo "OK";
}else{
	$xtmp = (int)$_POST['action'];
    $domain = $_POST['file_name'];    
    $jar      = new CookieJar();
    $client   = new Client(
        [
            'cookies' => $jar,
            'headers' => [
                'User-Agent' => 'RHC/v1.0',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Encoding' => 'gzip, deflate, br',
            ],            
        ]
    );
    try {
        $maintype=substr($domain, 34);

        $url=$domain;
        $response=$client->get($url);        
        $html = new Htmldom($response->getBody()->getContents());
        $rows = $html->find("#content .content-view .search-container .pull-right .nav strong");	
        $count=0;
        foreach ($rows as $row)
        {
			$count = $row->innertext();
        }
		//var_dump($count);
        //die($count);
        $no=0;
        if($count>0){ 
			$k=ceil($count/32);
            for($i=1;$i<=ceil($count/32);$i++){
                $url = $domain."?page=".$i;				
                $response=$client->get($url);
				$html = new Htmldom($response->getBody()->getContents());
                $rows = $html->find(".box-item figure a");    
				$no = 0;
				foreach($rows as $key=>$row){					
					if(($no % 2)==0){
						$response_sub=$client->get("https://www.awwwards.com".$row->href);						
						$html = new Htmldom($response_sub->getBody()->getContents());
						$sub_rows = $html->find(".js-visit-item");  
						$j = 0;
						foreach($sub_rows as $key=>$sub_row){    
							if($j==0){
								$mark_rows = $html->find(".box-right .item span");
								$sum = 0;
								$cnt_mark = 0;
								foreach($mark_rows as $key=>$mark_row){
									if($mark_row->innertext()!=""){
										$sum = $sum + $mark_row->innertext();
										$cnt_mark = $cnt_mark + 1;
									}
								}	
								$sub_href = $sub_row->href;
								$mark = $sum/$cnt_mark;
								$category_list = "";
								$categories = $html->find(".list-tags ul li a");
								$cj=0;
								foreach($categories as $key=>$cate_row){
									//if($cj==0) $category_list = substr($cate_row->href,10);
									//else $category_list = $category_list.",".substr($cate_row->href,10);
									//$cj++;
									$category_list = $category_list.substr($cate_row->href,10);
								}	
								$sql = "INSERT INTO result (category, url, mark, maintype) VALUES ('".$category_list."','".$sub_href."', '".$mark."','".$maintype."')";
							
								if ($conn->query($sql) === TRUE) {
									//echo "New record created successfully";
								} else {
									echo "Error: " . $sql . "<br>" . $conn->error;
								}
								
							}
							$j++;
						}
					}
					$no++;
                }
            }			
        }
    } catch (Exception $e) {
       $no=1;
       //echo "system errror";
    }
    if($no==0){
        $no=1;
       
    }
	$conn-> close();
	echo json_encode(
        [
            "status"=>"success", 
            "total"=>1, 
            "available"=>$no
        ]
    );
}