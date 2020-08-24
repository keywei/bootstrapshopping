<?php
require ("check.php");
require ("config.php");

if(isset($_POST["action"])&&($_POST["action"]=="join")){
	
	//找尋帳號是否已經註冊
	$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
	$result = mysqli_query ( $link, "set names utf8");
	mysqli_select_db ( $link, $dbname );
	$query_RecFindUser = "SELECT m_email FROM memberdata WHERE m_email='{$_POST["m_email"]}'";
	$result = mysqli_query ( $link, $query_RecFindUser );
	$row = mysqli_fetch_assoc ( $result );
	if ($row){
		header("Location:join.php?errMsg=1&username={$_POST["m_email"]}");
	}else{
	//若沒有執行新增的動作
			$ckname = GetSQLValueString($_POST["m_name"], 'string');
		// 加密演算	$ckpassword = password_hash($_POST["m_passwd"], PASSWORD_DEFAULT);
			$ckpassword = GetSQLValueString($_POST["m_passwd"], 'string');
			$cksex = GetSQLValueString($_POST["m_sex"], 'string');
			$ckbirthday = GetSQLValueString($_POST["m_birthday"], 'string');
			$ckemail = GetSQLValueString($_POST["m_email"], 'email');
			$ckphone = GetSQLValueString($_POST["m_phone"], 'string');
			$ckaddress = GetSQLValueString($_POST["m_address"], 'string');	
			$query_insert = "INSERT INTO memberdata 
			(m_name, m_passwd, m_sex, m_birthday, m_email, m_cellphone, m_address, m_joinDate) VALUES 
			('$ckname','$ckpassword', '$cksex','$ckbirthday','$ckemail' , '$ckphone', '$ckaddress', NOW())";			
			mysqli_query ( $link, $query_insert );
			header("Location: join.php?loginStats=1");
			mysqli_close($link);
		
		
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
        <style>
            strong{
                color:red;
            }
            .errDiv {
            font-size: 15pt;
            color: #FFFFFF;
            background-color: #FF0000;
            padding: 4px;
            text-align: center;
            }
            .heading {
            font-family: "微軟正黑體";
            font-size: 13pt;
            color: #0066CC;
            line-height: 150%;
            font-weight: bold;
            }
            .smalltext {
            font-size: 11px;
            color: #999999;
            font-family: Georgia, "Times New Roman", Times, serif;
            vertical-align: middle;
            }

        </style>
        <script>
            function checkForm() {
                if (!check_passwd(document.formJoin.m_passwd.value, document.formJoin.m_passwdrecheck.value)) {
                    document.formJoin.m_passwd.focus();
                    return false;
                }
                if (document.formJoin.m_name.value == "") {
                    alert("請填寫姓名!");
                    document.formJoin.m_name.focus();
                    return false;
                }
                if (document.formJoin.m_birthday.value == "") {
                    alert("請填寫生日!");
                    document.formJoin.m_birthday.focus();
                    return false;
                }
                if (document.formJoin.m_email.value == "") {
                    alert("請填寫電子郵件!");
                    document.formJoin.m_email.focus();
                    return false;
                }
                if (!checkmail(document.formJoin.m_email)) {
                    document.formJoin.m_email.focus();
                    return false;
                }
                return confirm('確定送出嗎？');
            }
            function check_passwd(pw1, pw2) {
                if (pw1 == '') {
                    alert("密碼不可以空白!");
                    return false;
                }
                for (var idx = 0; idx < pw1.length; idx++) {
                    if (pw1.charAt(idx) == ' ' || pw1.charAt(idx) == '\"') {
                        alert("密碼不可以含有空白或雙引號 !\n");
                        return false;
                    }
                    if (pw1.length < 5 || pw1.length > 10) {
                        alert("密碼長度只能5到10個字母 !\n");
                        return false;
                    }
                    if (pw1 != pw2) {
                        alert("密碼二次輸入不一樣,請重新輸入 !\n");
                        return false;
                    }
                }
                return true;
            }
            function checkmail(myEmail) {
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (filter.test(myEmail.value)) {
                    return true;
                }
                alert("電子郵件格式不正確");
                return false;
            }
        </script>
</head>

<body>
    <?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
        <script language="javascript">
        alert('會員新增成功\n請用申請的帳號密碼登入。');
        window.location.href='bootstrapshopping.php';		  
        </script>
        <?php }?>
    
    <div class="container float-left">
    <img src="images/Welcome.jpg" alt="會員系統" width="164" height="67">
        <form action="" method="POST" name="formJoin" id="formJoin" onSubmit="return checkForm()";>
            <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
                <div class="errDiv">帳號 <?php echo $_GET["username"];?> 已經有人使用！</div>
                <?php }?>
            <h5>帳號資料</h5>
            <div class="form-row">
                <div class="col">
                    <label class="font-weight-bold mb-0" for="m_email"><strong>*</strong>電子郵件：</label>
                    <input type="text" class="form-control p-0" name="m_email" id="m_email" value="" required>
                    <span class="smalltext">請確定此電子郵件為可使用狀態，以方便未來系統使用，如補寄會員密碼信。</span>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label class="font-weight-bold mb-0" for="m_passwd"><strong>*</strong>使用密碼：</label>
                    <input type="password" class="form-control p-0" name="m_passwd" id="m_passwd" value="" required>
                    <span class="smalltext">請填入5~10個字元以內的英文字母、數字、以及各種符號組合，</span>

                </div>
                <div class="col">
                    <label class="font-weight-bold mb-0" for="m_passwdrecheck"><strong>*</strong>確認密碼：</label>
                    <input type="password" class="form-control p-0" name="m_passwdrecheck" id="m_passwdrecheck" value=""
                        required><span class="smalltext">再輸入一次密碼</span>
                </div>
            </div>
            <h5>個人資料</h5>
            <div class="form-row">

                <div class="col">
                    <label class="font-weight-bold mb-0" for="m_name"><strong>*</strong>真實姓名：</label>
                    <input type="text" class="form-control p-0" name="m_name" id="m_name" value="" required>
                </div>

                <div class="col">
                    <label class="font-weight-bold mb-0" for="m_sex"><strong>*</strong>性　　別：</label>
                    <select class="custom-select pl-0" name="m_sex" id="m_sex" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="M">男</option>
                        <option value="F">女</option>
                    </select>
                </div>
            </div>
            <div class="form-row" style="margin-top:12px">
                <div class="col">
                    <label class="font-weight-bold mb-0" for="m_birthday"><strong>*</strong>生　　日：</label>
                    <input type="text" class="form-control p-0" name="m_birthday" id="m_birthday" value="" required>
                    <span class="smalltext">為西元格式(YYYY-MM-DD)。</span>
                </div>


                <div class="col">
                    <label class="font-weight-bold mb-0" for="m_phone">電　　話：</label>
                    <input type="text" class="form-control p-0" name="m_phone" id="m_phone" value="" >
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label class="font-weight-bold mb-0" for="m_address">住　　址：</label>
                    <input type="text" class="form-control p-0" id="m_address" name="m_address" value="" >
                </div>
            </div>
            <strong>*</strong>表示為必填的欄位
            <div class="form-row mt-2 justify-content-end">
                <input name="action" type="hidden" id="action" value="join">
                <button class="btn btn-primary px-0 mr-1" type="submit">送出資料</button>
                <button class="btn btn-primary px-0 mr-1" type="reset">重設資料</button>
                <button class="btn btn-primary px-0" type="button" onClick="window.history.back();">回上一頁</button>
            </div>

        </form>
    </div>
    <div class="container float-left ">
    <div class="d-inline ">
          <p class="heading"><strong>填寫資料注意事項：</strong></p>
          <ol>
            <li> 請提供您本人正確、最新及完整的資料。 </li>
            <li> 在欄位後方出現「*」符號表示為必填的欄位。</li>
            <li>填寫時請您遵守各個欄位後方的補助說明。</li>
            <li>關於您的會員註冊以及其他特定資料，本系統不會向任何人出售或出借你所填寫的個人資料。</li>
            <li>在註冊成功後，除了「使用帳號」外您可以在會員專區內修改您所填寫的個人資料。</li>
          </ol>
    </div>
    

    </div>
</body>

</html>