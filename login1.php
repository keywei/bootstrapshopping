<?php

// 連線資料庫
session_start();
require_once("config.php");
$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8");
mysqli_select_db ( $link, $dbname );

// 判斷是否登出 刪除SESSION
if($_GET["logout"]==1){
    unset($_SESSION["loginMember"]);
    unset($_SESSION["m_id"]);
    header("Location: bootstrapshopping.php");

}

// 判斷是否已登入
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
    
        header("Location: bootstrapshopping.php");
    
}

// 判斷是否輸入帳號密碼 有的話與資料庫比對是否正確
if(isset($_POST["email"]) && isset($_POST["passWd"])){

    $query_RecLogin = "SELECT m_name, m_email, m_passwd, m_id FROM memberdata WHERE m_email='{$_POST["email"]}'";
    $result = mysqli_query ( $link, $query_RecLogin );
    $row = mysqli_fetch_assoc ( $result );
// 密碼正確的話 賦予SESSION
    if($row["m_email"]){
            // if(password_verify($_POST["passWd"]==$row["m_passwd"]){  //加密演算
                if($_POST["passWd"]==$row["m_passwd"]){
                    $_SESSION["loginMember"]=$row["m_name"];
                    $_SESSION["m_id"]=$row["m_id"];
                    header("Location: bootstrapshopping.php");

                }else{
                    echo 
                    "<script>alert('密碼有誤!!!');
                    window.location.href='bootstrapshopping.php';
                    </script>";
                   }
    }else{
         echo 
        "<script>alert('帳號有誤!!!');
        window.location.href='bootstrapshopping.php';
        </script>";
    }
 }
    mysqli_close($link);
