<?
/*	OXID SweepTemp
	Author: jonas.hess@revier.de
	Licence: GPLv3
*/

$tmp_folder = 'tmp';
$tmp_garbage = Array();

$tmp_garbage[] = '^[0-9a-z\^%A-Z]*\.tpl\.php$';




$files = scandir($tmp_folder . '/');
foreach($files as $file) {
  echo $file . "\n<br />";
}


?>