<?php
error_reporting(1); 
/* Set the correct include path to 'phpseclib'. Note that you will need 
   to change the path below depending on where you save the 'phpseclib' lib.
   The following is valid when the 'phpseclib' library is in the same 
   directory as the current file.
 */
require_once __DIR__ . '/vendor/autoload.php';




/*$sftp = new \phpseclib\Net\SFTP('64.235.33.89');
if (!$sftp->login('root', '2rmaP14.-!nRUbjpP')) {
    exit('Login Failed');
}
//echo $sftp->pwd() . "\r\n";
var_dump($sftp->is_dir('/var/www/html/datafiles/'));
var_dump($sftp->put('/var/www/html/sample/filename.ext', 'hello, world!'));*/
//print_r($sftp->nlist());
$ssh = new \phpseclib\Net\SSH2('64.235.37.224');
if (!$ssh->login('root', 'r0t!!r9HCdMX9?fsu')) {
    exit('Login Failed');
}
echo "<pre>";
$ssh->exec('pwd');
//echo $ssh->exec('cd /var/www/html/');
$output = $ssh->exec('wget -O /var/www/html/downloadeddat/Label_1_5010_ADT0001_050817.txt http://64.235.33.89/downloaddata/Label_1_5010_ADT0001_050817.txt');
if (preg_match('/saving to:.{4}([a-z0-9\.-_]*)/i', $output, $match)) {
    var_dump($match);
} else {
    echo "No match";
}
?>