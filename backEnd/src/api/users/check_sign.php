<?php
include_once "../../library/function.php";
session_start();
function check_sign(){
    if(isset($_SESSION['use_email']) && isset($_SESSION['use_token']))
    {
        $email = $_SESSION['use_email'];
        $token = $_SESSION['use_token'];
        $sql = "SELECT * from users where use_email=? and use_token=?";
        $select_user = array();
        array_push($select_user , $email);
        array_push($select_user , $token);
        $result = dbExec($sql , $select_user);
        if($result->rowCount()>0){
            $user = $result->fetch(PDO::FETCH_ASSOC);
            $new_token = newToken($user['use_email'] , $user['use_token']);
            $sql = "UPDATE users set use_token=? where use_email=? and use_token=?";
            $update_user = array();
            array_push($update_user , $new_token);
            array_push($update_user , $user['use_email']);
            array_push($update_user , $user['use_token']);
            dbExec($sql , $update_user);
            $_SESSION['use_token'] = $new_token;
            echo `<script>
                sessionStorage.setItem("lsign", "$new_token");
            </script>`;
            return true;
        }
    }
}
?>