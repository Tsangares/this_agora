<?php
include_once ('fun.php');
function flag($question_id, $user_id){

}

if($_POST['question_id']){
    $user_id = -666;
    if($_POST['user_id']){
        $user_id = $_POST['user_id'];
    }
    flag($_POST['question_id'], $user_id);
}