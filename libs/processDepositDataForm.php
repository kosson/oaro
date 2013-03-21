<?php
require_once('homeRes.php');
require_once ('../db/connect.php');

//echo '<pre>';
//var_dump($_POST);
//echo '</pre>';
$unit = $_POST['units'];    // deposit.id_str_unit
$struct = $_POST['structura'];  //deposit.id_structure
$name = $_POST['name'];     // deposit.name
$acronym = $_POST['acronim'];   //deposit.acronym
$desc = $_POST['descr'];    //deposit.descr
$link = $_POST['link']; //deposit.link
$email = $_POST['email'];   //deposit.email
$acc_p1 = $_POST['access_point1'];  //deposit.access_point1
$acc_p2 = $_POST['access_point2'];  //deposit.access_point2
$clasif1 = $_POST['clasif1'];   //deposit.clasif1
$clasif2 = $_POST['clasif2'];   //deposit.clasif2
$issn = $_POST['issn']; //deposit.issn
$oa = $_POST['oa']; //deposit.oa
$fa = $_POST['fa']; //deposit.fa
$cr = $_POST['cr']; //deposit.cr
$idxs = $_POST['idxs'];  //deposit.idxs
$doaj = $_POST['doaj']; //deposit.doaj
$roar = $_POST['roar']; //deposit.roar

?>
