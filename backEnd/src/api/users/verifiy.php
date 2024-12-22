<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html; charset=UTF-8');
include_once "../../library/function.php";
session_start();
if(isset($_GET['token']))
{
    $use_token = check($_GET['token']);
    $sql = "SELECT * from users where use_token=?";
    $insert_array = array();
    array_push($insert_array, $use_token);
    $result = dbExec($sql,$insert_array);
    if($result->rowCount() > 0)
    {
        $user = $result->fetch(PDO::FETCH_ASSOC);
        // function in file function
        $new_token = newToken($user['use_email'] , $use_token);
        //======
        $update_token = array();
        array_push($update_token , $new_token);
        array_push($update_token , $user['use_email']);
        array_push($update_token , $user['use_token']);
        $sql = "UPDATE users set use_verified=now(),use_token=? where use_email=? and use_token=?";
        dbExec($sql , $update_token);
        $_SESSION['use_email'] = $user['use_email'];
        $_SESSION['use_token'] = $new_token;
        success($new_token);
        //    $resultJson = array("result"=>"success","code"=>"400","message"=>$user["use_email"]);
        // echo json_encode($resultJson,JSON_UNESCAPED_UNICODE);
    }
    else{
        noemail();
    }
}
else{
    echo "try again";
}
?>
<?php
function success($new_token){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>التحقق من البريد</title>
        <script>
            window.onload = function(){ 
                sessionStorage.setItem("lsign",<?php echo json_encode($new_token)?>);
            }
        </script>
    </head>
    <body>
        <div>
            <p>
                تم التحقق من البريد الالكتروني سيتم تحويلك الان الي الصفحة الرئيسية
            </p>
        </div>
    </body>
    </html>
<?php
}
?>

<?php
function noemail(){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التحقق من البريد</title>
    <script>
        if(sessionStorage.getItem("lsign")){
           window.location.href = 'https://www.google.com';
        }
    </script>
</head>
<body>
    <div>
        <h1>يرجى التحقق من بريدك الالكتروني</h1>
    </div>
</body>
</html>
<?php
}
?>