<?php
include_once('fun.php');
function submitResponse($response, $question_id, $user_id){
    $connection = connect();
    $ip = getIP();
    
    if($user_id == -666){
        $user_id = getIDfromIP();
    }

    //Check to see if response is already there
    $sql = "SELECT * FROM responses WHERE response = '".$response."'";
    $result = $connection->query($sql);
    if($result->num_rows > 0) {
        $connection->close();
        return;
    }
     //Query to add the response to the master table.
    $sql = "INSERT INTO `responses`(`response`, `creator`) VALUES ('".$response."', '".$user_id."')";
    //Send query.
    if($connection->query($sql) == TRUE){
        echo("Sucessfully uploaded; ");   
    }else{
        die("Error: ".$sql."<br>".$connection->error);
    }
    $sql = "SELECT * FROM responses WHERE response = '".$response."'";
    $val = -666;
    $result = $connection->query($sql);
    //Send query.
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $val = $row['id'];
        }
        echo("Sucessfully uploaded2; ");   
    }else{
        die("Error: ".$sql."<br>".$connection->error);
    }
    
    $sql = "INSERT INTO `question-response` (`question_id`, `response_id`) VALUES (".$question_id.", ".$val.")";
    
    if($connection->query($sql) == TRUE){
        echo("Sucessfully uploaded3; ");   
    }else{
        die("Error: ".$sql."<br>".$connection->error);
    }
    $connection->close(); 
}
//Checks the post to see if it contains a question.
if($_POST['response'] && $_POST['question_id']){
    $user_id = -666;
    if($_POST['user_id']){
        $user_id = $_POST['user_id'];
    }
    submitResponse($_POST['response'], $_POST['question_id'], $user_id);
}