<?
/*	OXID SweepTemp
	Author: jonas.hess@revier.de
	Licence: GPLv3
*/

$tmp_folder = 'tmp';
$tmp_garbage = Array();

//alowed_ips
$allowed_ips = array(
    '111.222.333.444',
    '555.666.777.888',
    '999.111.222.333'
);

//Function to determine ip
function getip() {
    $ipaddress = 'UNKNOWN'; // Set the ipaddress to unknown
    if ($_SERVER['HTTP_CLIENT_IP']) // Start capturing his ip
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN'; // If it can't catch it

    return $ipaddress;
}

if (!in_array($_SERVER['REMOTE_ADDR'], $allowed_ips))
{
    exit('Your IP is not allowed to sweep!');
}

//Define the Files to sweep by Regex
$tmp_garbage[] = '^[0-9a-z\^\%A-Z_]*oxforgotpw[0-9a-z\^\%A-Z_]*\.php$';
$tmp_garbage[] = '^[0-9a-z\^%A-Z_]*oxcontent[0-9]*oxbaseshop\.php$';
$tmp_garbage[] = '^[0-9a-z\^\%A-Z_]*\.tpl\.php$';
$tmp_garbage[] = '^[0-9a-z\^%A-Z_]*\_i18n\.txt$';
$tmp_garbage[] = '^[0-9a-z\^%A-Z_]*\_allfields\_1\.txt$';
$tmp_garbage[] = '^oxpec\_[0-9a-z\^%A-Z_]*seo\.txt$';
$tmp_garbage[] = '^oxpec\_[0-9a-z\^%A-Z_]*allviews\.txt$';
$tmp_garbage[] = '^oxpec\_[0-9a-z\^%A-Z_]*\_allfields\_\.txt$';
$tmp_garbage[] = '^oxpec\_langcache\_[0-9a-z\^%A-Z_]*\_default\.txt$';
$tmp_garbage[] = '^oxpec\_[0-9a-z\^%A-Z_]*Cache\.txt$';
$tmp_garbage[] = '^oxpec\_menu\_[0-9a-z\^%A-Z_]*\_xml\.txt$';
$tmp_garbage[] = '^oxpec\_oxuser\_[0-9a-z\^%A-Z_]*\.txt$';
$tmp_garbage[] = '^oxpec\_oxshops\_[0-9a-z\^%A-Z_]*\.txt$';

//Scan folder an delete

$files = scandir($tmp_folder . '/');
$count = 0;
foreach ($tmp_garbage as $regex)
{
	foreach($files as $file) {
		if (preg_match('/' . $regex . '/', $file) && file_exists($tmp_folder . '/' . $file)) {
			unlink($tmp_folder . '/' . $file);
			$count++;
		}
	}
}

echo $count . ' File(s) deleted!';

?>