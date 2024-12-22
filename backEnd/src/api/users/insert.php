<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
include_once "../../library/function.php";
include_once "./check_email.php";
include_once "./check_sign.php";
check_sign();
if(isset($_POST['use_name']) && isset($_POST['use_email']) && isset($_POST['use_password']) && isset($_POST['use_Cpassword'])){
    $use_name = $_POST['use_name'];
    $use_email = $_POST['use_email'];
    $use_password = $_POST['use_password'];
    $use_Cpassword = $_POST['use_Cpassword'];
    if(!emailChar($use_password)){
        $resultJson =  array("result"=>"fail","code"=>"300","message"=>"يجب ان تكون كلمة السر اكبر من 7 رموز");
        echo json_encode($resultJson,JSON_UNESCAPED_UNICODE);
        return;
    }
    elseif($use_password != $use_Cpassword)
    {
        $resultJson =  array("result"=>"fail","code"=>"300","message"=>"كلمات المرور غير متطابقة");
        echo json_encode($resultJson,JSON_UNESCAPED_UNICODE);
        return;
    }
    if(filter_var($use_email,FILTER_VALIDATE_EMAIL)){
    // $use_admin = $_POST['use_admin'];
        $insertArray = array();
        array_push($insertArray,check($use_name));
        array_push($insertArray,check($use_email));
        array_push($insertArray , check($use_password));
        //=====check from email==
          $check = check_email($use_email);
          if($check)
          {
            //$userAgent = $_SERVER['HTTP_USER_AGENT'];
            $resultJson =  array("result"=>"fail","code"=>"100","message"=>"يوجد لديك حساب مسبق!");
            echo json_encode($resultJson,JSON_UNESCAPED_UNICODE);
            return;
          }
        //======== link email==========
        $verification_code = md5($use_email . time());
        array_push($insertArray,$verification_code);
        //=verification
        sendVerificationEmail($use_name,$use_email , $verification_code);
        //==================
        $sql = "INSERT into users(use_name,use_email,use_password,use_token,use_created_at,use_updated_at)
        values(?,?,?,?,now(),now())";
        $result = dbExec($sql,$insertArray);
        $resultJson = array("result"=>"success","code"=>"200","message"=>"تم إرسال رابط الي بريدك الالكتروني");
        echo json_encode($resultJson,JSON_UNESCAPED_UNICODE);
        return;
    }
    else{
       $resultJson =  array("result"=>"fail","code"=>"300","message"=>"يرجى إدخال إيميل صحيح");
       echo json_encode($resultJson,JSON_UNESCAPED_UNICODE);
       return;
    }
}
else{
    $resultJson = array("result"=>"fail","code"=>"400","message"=>"هناك خطاء في البيانات!");
    echo json_encode($resultJson,JSON_UNESCAPED_UNICODE);
    return;
}
function emailChar($email){
   return strlen($email)>=8?true:false;
}
?>