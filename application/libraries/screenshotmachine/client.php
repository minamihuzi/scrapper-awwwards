<?php
include('ScreenshotMachine.php');

$customer_key = "c18e9b";
$secret_phrase = ""; //leave secret phrase empty, if not needed

$machine = new ScreenshotMachine($customer_key, $secret_phrase);

//mandatory parameter
$options['url'] = "https://web.archive.org/web/20200201065104/https://www.upwork.com/";

// all next parameters are optional, see our website screenshot API guide for more details
$options['dimension'] = "1024x800";  // or "1366xfull" for full length screenshot
$options['device'] = "desktop";
$options['format'] = "png";
$options['cacheLimit'] = "0";
$options['delay'] = "200";
$options['zoom'] = "100";

$api_url = $machine->generate_screenshot_api_url($options);

//put link to your html code
//echo '<img src="' . $api_url . '">' . PHP_EOL;

//or save screenshot as an image
$output_file = Date("U").'.png';
file_put_contents($output_file, file_get_contents($api_url));
echo 'Screenshot saved as ' . $output_file . PHP_EOL;

$remain_url ="https://www.screenshotmachine.com/status.php?key=c18e9b";
