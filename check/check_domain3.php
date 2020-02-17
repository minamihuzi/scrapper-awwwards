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
$out_domain_file_name="Domains(Netim)".$id.".txt";
$out_domain_file_path=$out_domain_dir.$out_domain_file_name;
$proxy_file  = '../app-assets/proxy.txt';

if($_POST['action']=="delete"){
    if(file_exists($out_domain_file_path))unlink($out_domain_file_path);
    file_put_contents($out_domain_file_path, "Natim Available domains:\n", FILE_APPEND);
    echo "OK";
}else{
    $xtmp = (int)$_POST['action'];
    $input_domain_file_name = $_POST['file_name'];
    $inpput_domain_file_path = $input_domain_dir.$input_domain_file_name;
    $domainlist = file($inpput_domain_file_path, FILE_IGNORE_NEW_LINES);

    $dmlist=array_slice($domainlist,$xtmp*50,50);
    $proxies = array_unique(array_filter(array_map('trim', explode("\n", file_get_contents($proxy_file)))));
    shuffle($proxies);

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
        ]
    );

    $proxy = array_shift($proxies);
    array_push($proxies, $proxy);

    $url="https://www.netim.com/domain-name/search-registration.html";
    $form_params=array(
        "rech-dom"=>implode("\r\n", $dmlist),
        "rech-tld"=>"",
        "rech-cat"=>""
    );
    $response=$client->post($url, ["form_params"=>$form_params]);
    //echo $response->getBody()->getContents();
    $url="https://www.netim.com/ajax/panier.php";
    $response=$client->post($url, ["form_params"=>["set-session-recherche-CRE"=>1]]);
    $url="https://www.netim.com/ajax/panier.php";
    $response=$client->post($url, ["form_params"=>["get-recherche-panier-CRE"=>1, "lang"=>"EN"]]);
    $e=explode("#",$response->getBody()->getContents());
    $available=array();
    if("ok" == $e[0]){
        $resultat = explode("|",$e[1]);
        foreach($resultat as $e) {
            if("" != $e){
                $d = explode(";",$e);
                $domain = $d[0];
                $status = $d[1];
                $prix = $d[2];
                $nbannee = $d[3];
                if($status==1){
                    $available[$domain]=1;
                }
            }
        }
    }
    $domainAvailableList=array();
    foreach($dmlist as $d){
        if(array_key_exists($d, $available)){
            $domainAvailableList[] = $d;
        }
    }
    
    if(count($domainAvailableList)>0)
        file_put_contents($out_domain_file_path, join("\n", $domainAvailableList)."\n", FILE_APPEND);
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
