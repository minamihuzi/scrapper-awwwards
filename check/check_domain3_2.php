<?php
set_time_limit(0);
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Pool;
use Yangqi\Htmldom\Htmldom;

$id=$_POST['id'];
$out_domain_dir="../app-assets/download_files/";
$input_domain_dir="../app-assets/upload_files/";
$out_domain_file_name="Domains(Netim)".$id.".csv";
$out_domain_file_path=$out_domain_dir.$out_domain_file_name;
$proxy_file  = '../app-assets/proxy.txt';

if($_POST['action']=="delete"){
    if(file_exists($out_domain_file_path))unlink($out_domain_file_path);
    echo "OK";
}else{
    $xtmp = (int)$_POST['action'];
    $input_domain_file_name = $_POST['file_name'];
    $inpput_domain_file_path = $input_domain_dir.$input_domain_file_name;
    $domainlist = file($inpput_domain_file_path, FILE_IGNORE_NEW_LINES);

    $dmlist=array_slice($domainlist,$xtmp*200,200);
    $proxies = array_unique(array_filter(array_map('trim', explode("\n", file_get_contents($proxy_file)))));
    shuffle($proxies);
    //$proxyurl="http://ash:ash@104.223.70.28:12345";

    $domainCheckList = [];
    $domainCheckList[] = $dmlist;


    $jar      = new CookieJar();
    $client   = new Client(
        [
            'cookies' => $jar,
            'headers' => [
                'User-Agent' => 'RHC/v1.0',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Encoding' => 'gzip, deflate, br',
            ],
            //'proxy'=>$proxyurl
        ]
    );

    $proxy = array_shift($proxies);
    array_push($proxies, $proxy);

    $url="https://www.onlydomains.com/domain/frontBulkSearch";
    $response = $client->get($url);
    $body = $response->getBody()->getContents();
    $html = new Htmldom($body);
    $csrfToken=$html->find("input[name='csrfToken']");
    $form_params=array(
        "bulkDomain"=>join("\n", $dmlist),
        "csrfToken"=>$csrfToken[0]->value
    );
    $response=$client->post("https://www.onlydomains.com/domain/frontSearch", ["form_params"=>$form_params]);
    $html = new Htmldom($response->getBody()->getContents());
    $rows = $html->Find("script");
    $contents="";
    $domainAvailableList=array();
    foreach ($rows as $row)
    {
        if (strpos($row->innertext(),"setDomainStatus(") !== false){
            $str=$row->innertext();
            $str=substr($str, 16, -2);
            $str=array_map("trim", explode(",", $str));
            $domain=substr($str[0], 1, -1);
            $available=substr($str[1], 1, -1);
            if($available=="Available"){
                $contents.=$domain."\n";
                $domainAvailableList[] = $domain;
            }
        }
    }
    
    if($contents!="")
        file_put_contents($out_domain_file_path, $contents, FILE_APPEND);
    echo json_encode(
        [
            "status"=>"success", 
            "total"=>count($dmlist), 
            "available"=>count($domainAvailableList), 
            "result_file"=>$out_domain_file_name
        ]
    );

}

function generate_proxy_url($proxy){
    $p=explode(":", $proxy);
    $proxyip=$p[0];
    $proxyport=$p[1];
    $pusername=$p[2];
    $ppassword=$p[3];
    $proxyurl="http://".$pusername.":".$ppassword."@".$proxyip.":".$proxyport;
    return $proxyurl;
}
