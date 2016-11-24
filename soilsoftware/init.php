<?php
session_start();
ini_set("register_globals", "off");
ini_set("upload_max_filesize", "20M");
ini_set("post_max_size", "40M");
ini_set("memory_limit", "80M");

require_once("data/conn.php");
require_once("data/users.php");

$conn 					= new Dbconn();		
$users	 				= new Users();	

require_once("data/phtexture.php");
$ph_texture = new Phtexture();

require_once("data/recommendation.php");
$recommendation = new Recommendation();

require_once("data/reportform.php");
$report_form = new Reportform();

require_once("data/constants.php");
require_once("data/sqlinjection.php");

require_once("data/helper.php");