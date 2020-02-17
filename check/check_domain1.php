<?php
set_time_limit(0);
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Pool;
use Yangqi\Htmldom\Htmldom;

function myFun($id, $dmlist)
{

/*--------------------------------------------------------------------------
| Constants
'-------------------------------------------------------------------------*/
$PROXIES_INPUT_FILE_NAME  = '../app-assets/proxy.txt';
$DOMAINS_OUTPUT_FILE_NAME = "../app-assets/download_files/Domains(Godaddy)".$id.".txt";
//if(file_exists($DOMAINS_OUTPUT_FILE_NAME))unlink($DOMAINS_OUTPUT_FILE_NAME);
/*--------------------------------------------------------------------------
| Proxies
'-------------------------------------------------------------------------*/
$proxies = array_unique(array_filter(array_map('trim', explode("\n", file_get_contents($PROXIES_INPUT_FILE_NAME)))));
shuffle($proxies);

/*--------------------------------------------------------------------------
| Get domains from txt file
'-------------------------------------------------------------------------*/
$domainCheckList = [];
$domainCheckList[] = $dmlist;
/*--------------------------------------------------------------------------
| Prepare the requests to check the domains through godaddy
'-------------------------------------------------------------------------*/
$jar      = new CookieJar();
$client   = new Client(['cookies' => $jar]);

$proxy = array_shift($proxies);
array_push($proxies, $proxy);


$requests = function ($domainList) use (&$proxies, $client) {
    $ycount = count($proxies);
    foreach ($domainList as $i => $domains){
        yield function () use (&$proxies, $client, $domains) {
            $proxy = array_shift($proxies);
            array_push($proxies, $proxy);
            $p=explode(":", $proxy);
            $proxyip=$p[0];
            $proxyport=$p[1];
            $pusername=$p[2];
            $ppassword=$p[3];
            $proxyurl=$pusername.":".$ppassword."@".$proxyip.":".$proxyport;
            
            return $client->postAsync('https://au.godaddy.com/domains/actions/dodomainbulksearch.aspx?source=/domains/bulk-domain-search.aspx', [
                'timeout'     => 60,
                'proxy'       => "http://".$proxyurl,
                //'query'       => ['source' => '/domains/bulk-domain-search.aspx'],
                'form_params' => ['domainNames' => join(',', $domains), 'dotTypes' => '', 'extrnl' => 1, 'bulk' => 1, 'redirectTo' => 'customize']
            ]);
        };
    }
};

/*--------------------------------------------------------------------------
| Run requests and parse the html response into a DomParser to get the domains
'-------------------------------------------------------------------------*/

$errors              = [];
$pool                = new Pool($client, $requests($domainCheckList), [
    'concurrency' => count($proxies),
    'fulfilled'   => function ($response) use (&$domainAvailableList) {
        $body = $response->getBody()->getContents();
        $html = new Htmldom($body);
        //echo $body;
        foreach ($html->find('.prevDomain') as $element){
            $domainAvailableList[] = $element->value;
        }
    },
    'rejected'    => function ($reason, $index) use (&$errors) {
        print_r($errors);
    }
]);

$pool->promise()->wait();

/*--------------------------------------------------------------------------
| Save available domains in a txt file and finish script
'-------------------------------------------------------------------------*/
if(count($domainAvailableList)>0){
    file_put_contents($DOMAINS_OUTPUT_FILE_NAME, join("\r\n", $domainAvailableList)."\n", FILE_APPEND);
    $count=count($domainAvailableList);
}else{
    $count=0;
}
//echo 'Finished!<br>';
//echo count($domainAvailableList) . ' available domains found<br><br>';
echo json_encode(["status"=>"success", "total"=>count($dmlist), "available"=>$count, "result_file"=>"Domains(Godaddy)".$id.".txt"]);

}

//$starttime = microtime(true);
if($_POST['action']=="delete"){
    $id=$_POST['id'];
    if(file_exists("../app-assets/download_files/Domains(Godaddy)".$id.".txt"))unlink("../app-assets/download_files/Domains(Godaddy)".$id.".txt");
}else{
$xtmp = (int)$_POST['action'];

$id = (int)$_POST['id'];
$file_name = $_POST['file_name'];
$domainlist = file("../app-assets/upload_files/".$file_name, FILE_IGNORE_NEW_LINES);

myFun($id, array_slice($domainlist,$xtmp*500,500));
}
//$endtime        = microtime(true);
//$execution_time = round(($endtime - $starttime), 2);
//echo "Total Execution Time: {$execution_time} Secs";