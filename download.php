<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//**************************************************************
function WriteIPStatistic()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
    $ip = $_SERVER['REMOTE_ADDR'];
    }
    $browser  =$_SERVER['HTTP_USER_AGENT']; // get the browser name
    $curr_page=$_SERVER['PHP_SELF'];// get page name
    $from_page = $_SERVER['HTTP_REFERER'];//  page from which visitor
    $page=$_SERVER['PHP_SELF'];//get current page

// write     
    $myFile = "DownloadStatistic.txt";
    $fh = fopen($myFile, 'a') or die("can't open file");
    $stringData =  "\r\n<li>".date("Y/m/d G:i:s")."; IP=".$ip.";Browser=".$browser.";Current page = ".$curr_page.";From page = ".$from_page.";Page = ".$page."</li>";
    fwrite($fh, $stringData);
    fclose($fh);
}

$file = 'Tangenta_001_setup.exe';
$basefilename = $file;
$file = 'FilesToDownload/'.$file; 
if(!$file)
{ // file does not exist
    die('file not found');
} 
else 
{
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$basefilename");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");
    readfile($file);
    WriteIPStatistic();
//Insert the data in the table…
}

?>

