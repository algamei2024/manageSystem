<?php
include_once "../../library/function.php";
function check_email($email){
    $sql = "SELECT * from users where use_email=?";
    $insert_array = array();
    array_push($insert_array , $email);
    $result = dbExec($sql , $insert_array);
    if($result->rowCount() > 0)
    {
        return true;
    }
    return false;
}
?>