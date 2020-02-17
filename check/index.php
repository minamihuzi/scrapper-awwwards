<?php
set_time_limit(0);
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Pool;
use Yangqi\Htmldom\Htmldom;

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,"analysis");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if($_GET['action']=="delete"){
    //if(file_exists($out_domain_file_path))unlink($out_domain_file_path);
    echo "OK";
}else{
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
        $url="https://www.awwwards.com/sitemap.category.xml";
        $response=$client->get($url);        
        $html = new Htmldom($response->getBody()->getContents());
        $rows = $html->find("url loc");	
        $domain_urls = "";
		foreach($rows as $key=>$row){    
			$domain_urls = $domain_urls.$row->innertext()."\r\n";
		}
		$sql = "INSERT INTO an_export (name, domains) VALUES ('awwwards','".$domain_urls."')";
		if ($conn->query($sql) === TRUE) {
			//echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
    } catch (Exception $e) {
       //$no=1;
       //echo "system errror";
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