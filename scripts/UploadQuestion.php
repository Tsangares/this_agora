<!-- William Wyatt 10-3-15 
    Only used to send a insert query to a database.
    Used to add a new question to the table. -->

<?php
include_once('fun.php');
    
function submitQuestion($question, $user_id){
    $connection = connect();
    $ip = getIP();
    if($user_id == -666){
        $user_id = getIDfromIP();
    }
    echo $user_id;

    //Check to see if question is already there
    $sql = "SELECT * FROM `questions` WHERE `question` = '".$question."'";
    $result = $connection->query($sql);
    if($result->num_rows > 0) {
        $connection->close();
        return;
    }

    //Query to add the question to the master table. 
    $sql = "INSERT INTO `questions`(`question`, `creator`) VALUES ('".$question."', '".$user_id."')";
    
    //Send query.
    if($connection->query($sql) == TRUE){
        echo("Sucessfully uploaded");   
    }else{
        die("Error: ".$sql."<br>".$connection->error);
    }
    $connection->close(); 
}

//Checks the post to see if it contains a question.
if($_POST['question']){
    $user_id ='-666;
    if($_POST['user_id']){
        $user_id = $_POST['user_id'];
    }
    submitQuestion($_POST['question'], $user_id);
}