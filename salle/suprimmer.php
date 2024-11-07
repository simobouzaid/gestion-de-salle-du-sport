<?php
session_start();
 if(!isset($_SESSION['rsp'])){
header('location: connexion.php');}

include 'database/database.php';
require_once 'class.php';

$id=$_GET['id'];
$spm=new cm($pdo);
$spm->suprimmer($id);
header('location:index.php');











?>