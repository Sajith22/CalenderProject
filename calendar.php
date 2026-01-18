<?php
//We ahve tp include the onnection.php file to connect to the DB
include "connection.phpr";

$successMsg ='';
$errorMsg ='';
$eventsFromDB =[]; // new array to fetch events

#Handle Add Appiontment
if($_SERVER["REQUEST_METHOD"] ==="POST" && ($_POST['action']??'')==="add"){
    
    $coures = trim($_POST["course_name"]??'');
    $instructor =trim($_POST['instructor_name']??'');
    $start =$_POST["start_date"]??'';
    $end =$_POST["end_date"]??';'

    if(){
        
    }


}