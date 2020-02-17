<?php
set_time_limit(0);
require 'vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Pool;
use Yangqi\Htmldom\Htmldom;

$proxy_file  = '../app-assets/proxy.txt';
$proxy_check_file= '../app-assets/proxy_check.txt';
if(file_exists($proxy_check_file))unlink($proxy_check_file);
$proxies = array_unique(array_filter(array_map('trim', explode("\n", file_get_contents($proxy_file)))));
foreach ($proxies as $key => $proxy) {
    $proxyurl=generate_proxy_url($proxy);
    $jar      = new CookieJar();
    $client   = new Client(
        [
            'cookies' => $jar,
            'headers' => [
                'User-Agent' => 'RHC/v1.0',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Encoding' => 'gzip, deflate, br',
            ],
            'proxy'=>$proxyurl
        ]
    );

    $url="https://au.godaddy.com/domains/actions/dodomainbulksearch.aspx";
    try {
        $response=$client->get($url);
        echo "enable proxy:".$proxy."<br>";
        file_put_contents($proxy_check_file, $proxy."\n", FILE_APPEND);
    } catch (Exception $e) {
        echo "disable proxy:".$proxy."<br>";
    }
    
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
