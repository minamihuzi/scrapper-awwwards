<?php
set_time_limit(0);
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Pool;
use Yangqi\Htmldom\Htmldom;

function myFun($dmlist)
{

/*--------------------------------------------------------------------------
| Constants
'-------------------------------------------------------------------------*/
$PROXIES_INPUT_FILE_NAME  = 'proxy.txt';
$DOMAINS_INPUT_FILE_NAME  = 'domains-input.txt';
$DOMAINS_OUTPUT_FILE_NAME = 'domains-output.txt';

/*--------------------------------------------------------------------------
| Proxies
'-------------------------------------------------------------------------*/
$proxies = array_unique(array_filter(array_map('trim', explode("\n", file_get_contents($PROXIES_INPUT_FILE_NAME)))));
shuffle($proxies);

/*--------------------------------------------------------------------------
| Get domains from txt file
'-------------------------------------------------------------------------*/
$domainCheckList = $dmlist;


/*--------------------------------------------------------------------------
| Prepare the requests to check the domains through godaddy
'-------------------------------------------------------------------------*/
$jar      = new CookieJar();
$client   = new Client(['cookies' => $jar]);

$proxy = array_shift($proxies);
array_push($proxies, $proxy);

// $res = $client->postAsync('https://au.godaddy.com/domains/actions/dodomainbulksearch.aspx', [
//     'timeout'     => 10,
//     'proxy'       => ['http' => "http://$proxy:3128", 'https' => "https://$proxy:3128"],
//     'query'       => ['source' => '/domains/bulk-domain-search.aspx'],
//     'form_params' => ['domainNames' => join(",", $dmlist), 'dotTypes' => '', 'extrnl' => 1, 'bulk' => 1, 'redirectTo' => 'customize']
// ]);
// $res->then(
//     function (ResponseInterface $res) {
//         echo 1;
//         echo $res->getStatusCode() . "\n";
//     },
//     function (RequestException $e) {
//         echo 2;
//         echo $e->getMessage() . "\n";
//         echo $e->getRequest()->getMethod();
//     }
// );
// exit;


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
            
            return $client->postAsync('https://au.godaddy.com/domains/actions/dodomainbulksearch.aspx', [
                'timeout'     => 30,
                'proxy'       => "http://".$proxyurl,
                'query'       => ['source' => '/domains/bulk-domain-search.aspx'],
                'form_params' => ['domainNames' => join(',', $domains), 'dotTypes' => '', 'extrnl' => 1, 'bulk' => 1, 'redirectTo' => 'customize']
            ]);
        };
    }
};

/*--------------------------------------------------------------------------
| Run requests and parse the html response into a DomParser to get the domains
'-------------------------------------------------------------------------*/
$domainAvailableList = [];
$errors              = [];
$pool                = new Pool($client, $requests($domainCheckList), [
    'concurrency' => count($proxies),
    'fulfilled'   => function ($response) use (&$domainAvailableList) {
        $html = new Htmldom($response->getBody()->getContents());
        foreach ($html->find('.prevDomain') as $element){
            $domainAvailableList[] = $element->value;
        }
    },
    'rejected'    => function ($reason, $index) use (&$errors) {
        $error = substr($reason, 0, strpos($reason, '('));
        echo $error."<br><br>";
    }
]);

$pool->promise()->wait();

/*--------------------------------------------------------------------------
| Save available domains in a txt file and finish script
'-------------------------------------------------------------------------*/
file_put_contents("domains-output.txt", join("\r\n", $domainAvailableList), FILE_APPEND);
//echo 'Finished!<br>';
//echo count($domainAvailableList) . ' available domains found<br><br>';
echo count($domainAvailableList);

}



$domainlist = file("domains-input.txt", FILE_IGNORE_NEW_LINES);

myFun(array_chunk($domainlist,500));
//$endtime        = microtime(true);
//$execution_time = round(($endtime - $starttime), 2);
//echo "Total Execution Time: {$execution_time} Secs";