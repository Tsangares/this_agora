<?
include_once('fun.php');

function allQuestions(){
    $connection = connect();
    //Query to add the question to the master table. 
    $sql = "SELECT * FROM questions";
    $result_questions = $connection->query($sql);
    //Send query.
    if($result_questions->num_rows > 0){
        while($row = $result_questions->fetch_assoc()){
            $sql = "SELECT responses.* FROM `question-response` INNER JOIN `responses`
                    ON `question-response`.response_id = `responses`.id WHERE `question-response`.question_id = ".$row['id'];
            $result_response = $connection->query($sql);
            while($response = $result_response->fetch_assoc()){
                $responses[] = $response;
            }
            $row['responses'] = $responses;
            unset($responses);
            $rows[] = $row;
        }
    }else{
        die("Error: ".$sql."<br>".$connection->error);
    }
    $connection->close();
    return json_encode($rows);
}
