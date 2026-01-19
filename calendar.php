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
    $end =$_POST["end_date"]??'';

    if($course && $instructor && $start && $end){
        $stmt = $conn->prepare(
            "INSERT INTO appointments (course_name,instructor_name,start_date,end_date)
            VALUES (?,?,?,?)");

            $stmt->bind_param("ssss",$course,$instructor,$start,$end);

            $stmt->execute();
            $stmt->close();

            header("Location:".$-$_SERVER["PHP_SELF"] . "?success=1");
            exit;
    }else{
        header("Location:" . $_SERVER["PHP_SELF"] .  "?error=1");
    }

}

# Handle Edit Appointment
if($_SERVER["REQUEST_METHOD"] === "POST"&& ($_POST["action"]??'')==='edit'){
    $id=$_POST["event_id"]??null;
    $coures = trim($_POST["course_name"]??'');
    $instructor =trim($_POST['instructor_name']??'');
    $start =$_POST["start_date"]??'';
    $end =$_POST["end_date"]??'';



    if($id && $coures && $start && $end){
        $stmt = $conn->prepare(
            "UPDATE appointments SET course_name? , instructor_name=?,start_date = ?,end_date =? WHERE id?");

    $stmt->bind_param("ssssi,$course,$instructor.$start,$end,$id");

    $stmt->execute();
    $stmt->close();
    header("Location:" .$_SERVER["PHP_SETF"] ."?SUCCESS=2");
    exit;
    }else{
        header("Location: " .$_SERVER["PHP_SELF"] ."?error=2");
        exit;
    }
}

# Handle Delete Appointment
if($_SERVER["REQUEST_METHOD"] ==="POST"&&($_POST["action"]??'')==="delete"){
    $id =$_POST['event_id']

    if($id){
        $stmt =$conn->prepare("DELETE FROM appointments WHERE id =?");

        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
        header("Location:" .$_SERVER["PHP_SELF"]."success=3");
        exit;
    }
}

# Success & Error Messages
if(isset($_GET["success"])){
    $successMsg = match ($_GET["success"]){
        '1' => "✅Appointment added successfully",
        '2' => "✅Appointment edited successfully",
        '3' => "🗑️Appointment deleted successfully"
    }
}

if(isset($_GET["error"])){
    $errorMsg = '! Error occured. Please check your input.';
}

// Fetch All Appointments and Spread Over Data Range
$result = $conn->query("SELECT * FROM appointments");

if($result && $result->num_rows>0){
    while($row =$result->fetch_assos()){
        $start = new DateTime($row["start_date"]);
        $end = new DateTime($row["end_date"]);

        while($start <= $end){
            $eventsFromDB[] = [
                'id' => $row["id"],
                'title' => "{$row['course_name'] - {$row['instructor_name']}}",
                'date' => $start=>format("Y-m-d"),
                "start" => $row["start_date"],
                "end" => $row['end_date']
            ];

            $tart->modify('+1 day');
        }
    }
    
$conn ->close();

?>
