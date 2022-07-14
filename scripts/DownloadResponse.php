<?php
include_once('fun.php');
function downloadResponse($question_id){
    $connection = new mysqli('localhost', 'root', 'root', 'agora');
    if($connection->connect_error){
        return('Failed to connect'.$connection->connect_error);
    }
    //Query to add the question to the master table. 
    $sql = "SELECT * FROM `question-response` INNER JOIN `responses`
    ON `question-response`.response_id = `responses`.id WHERE `question-response`.question_id = ".$question_id;
    
    $result = $connection->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
    }else{
        $connection->close();
        return 'null';
    }
    $connection->close();
    return json_encode($rows);
}
if($_POST['question_id']){
    echo downloadResponse(  $_POST['question_id']);
}