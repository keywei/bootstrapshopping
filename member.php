<?php
session_start();
require ("config.php");
require ("check.php");
        $link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
        $result = mysqli_query ( $link, "set names utf8");
        mysqli_select_db ( $link, $dbname );

  if(isset($_POST["action"])&&($_POST["action"]=="add")){
        if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
    
            // for ($i=0; $i<count($_FILES["m_picture"]["name"]); $i++) {

                if   ($_FILES["m_picture"]["tmp_name"] != "") {
                      $pcategory = GetSQLValueString($_POST["category"], "int");
                      $pimgContent = GetSQLValueString($_POST["m_imgcontent"], "string");
                      $pimgTitle = GetSQLValueString($_POST["m_imgtitle"], "string");
                      $pfileName = GetSQLValueString($_FILES["m_picture"]["name"], "string");
                      $pprice = GetSQLValueString($_POST["m_price"], "int");
                      $query_insert = "INSERT INTO products (id, category, imgContent, imgTitle, imgfilename,m_price) VALUES (Null, '$pcategory', '$pimgContent', '$pimgTitle', '$pfileName',$pprice)";
                      mysqli_query ( $link, $query_insert );
                      $_GET['showmsg']="新增成功";
                      };
                if(!move_uploaded_file($_FILES["m_picture"]["tmp_name"] , "images/" . $_FILES["m_picture"]["name"])) die("檔案上傳失敗！");
            // }

        }else{      echo "<script>alert('請先登入!!!');</script>";
  
    }
  }


  if(isset($_POST["action_pdc"])&&($_POST["action_pdc"]=="add_pdc")){
         if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){

        // for ($i=0; $i<count($_FILES["m_picture"]["name"]); $i++) {

                    if   ($_POST["pdc_title"] != "") {
                          $pdc_title = GetSQLValueString($_POST["pdc_title"], "string");
                          $pdc_content = GetSQLValueString($_POST["pdc_content"], "string");
                          $pdc_category = GetSQLValueString($_POST["pdc_category"], "string");
                          $pdc_price = GetSQLValueString($_POST["pdc_price"], "string");
                          $pdc_m_id = GetSQLValueString($_SESSION["m_id"], "int");
                          $query_insertpdc = "INSERT INTO productsdc (pdc_id, pdc_title, pdc_content, pdc_category, pdc_price, m_id) VALUES (Null, '$pdc_title', '$pdc_content', '$pdc_category', '$pdc_price',$pdc_m_id)";
                          mysqli_query ( $link, $query_insertpdc );
                          $_GET['showmsg_pdc']="新增成功";
                          echo $_SESSION["m_id"];

                          };
        // }

        }else{      echo "<script>alert('請先登入!!!');</script>";

              }
  }
          
    mysqli_close($link);



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css"
        integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
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
      .btn-cart {
            background-color: transparent;
            position: relative;
        }

        .btn-cart .badge {
            position: absolute !important;
            top: 0 !important;
            right: 0;
        }
    </style>
</head>

<body>
  <div class="container px-0">
<nav class="navbar navbar-expand-lg navbar-light bg-light px-0">
            <a class="navbar-brand" href="bootstrapshopping.php">
                <img src="images/Welcome.jpg" width="60" height="30" class="d-inline-block align-top" alt=""
                    loading="lazy">
                許願網
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse align-items-start" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <div class="dropdown ml-auto">

                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <button class="btn btn-sm btn-cart" data-toggle="dropdown">
                                <i class="fas fa-clipboard-list fa-3x"></i>
                                <span class="badge badge-pill badge-danger">12</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" style="min-width:300px">
                                <div class="px-4 py-3">
                                    <table class="table table-sm">
                                        <thead>
                                            <th colspan="4" class="text-center">已選擇出售商品</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#removeModal"
                                                        data-title="品牌汽車"><i
                                                            class="far fa-trash-alt fa-1x text-danger"></i></a>
                                                </td>
                                                <td>Benz 汽車</td>
                                                <td>1件</td>
                                                <td class="text-right text-danger">$520</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#removeModal"
                                                        data-title="古董商品"><i
                                                            class="far fa-trash-alt fa-1x text-danger"></i></a>
                                                </td>
                                                <td>骨董 翠玉白菜</td>
                                                <td>1件</td>
                                                <td class="text-right text-danger">$480</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><a
                                                        href="https://hsiangfeng.github.io/ShoppingCart/Checkout.html"
                                                        type="submit" class="btn btn-primary btn-block">送出</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <?php if(isset($_SESSION["loginMember"])){
                            echo $_SESSION["loginMember"].'<a class="btn btn-link pt-0 pl-1" id="dLabe1"
                            href="login1.php?logout=1" aria-haspopup="true" aria-expanded="false">登出</a>';
                            }else{?>
                            <button class="btn btn-link pt-0" id="dLabe2" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                會員登入
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" style="min-width:300px">
                                <form method="post" action="login1.php" class="px-4 py-3 mt-1 h-100">
                                    <div class="form-group">
                                        <label for="Email">Email address</label>
                                        <input type="email" name="email" class="form-control" id="Email"
                                            placeholder="email@example.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="Password">Password</label>
                                        <input type="password" name="passWd" class="form-control" id="Password"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                        <label class="form-check-label" for="dropdownCheck">Remember me</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                </form>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="join.php">還沒加入?註冊帳號!</a>
                            </div>
                        </li>
                        <?php }?>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">會員登入</a>
                        </li> -->
                        <li class="nav-item">
                        <?php if(isset($_SESSION["loginMember"])){?>
                             <a class="btn btn-link pt-0" href="login1.php?logout=1" id="dLabe3" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                會員中心
                            </a>
                            <?php }else{ ?>
                            <button class="btn btn-link pt-0" id="dLabe3" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                服務說明
                            </button>
                            <?php } ?>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
  <div class="container row">
  <div class="container col">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
      <span class="font-weight-bold">商品上傳:</span>
        <input type="file" class="form-control-file" name="m_picture" id="m_picture" required>
        商品名稱:
        <input type="text" class="form-control" name="m_imgtitle" id="m_imgtitle" required>
        商品內容:
        <textarea class="form-control" name="m_imgcontent" id="m_imgcontent" required></textarea>
        預計價格:
        <input type="text" class="form-control" name="m_price" id="m_price" required>
      </div>
      <div class="input-group mb-3">
        <select class="custom-select" name="category" required>
          <option disabled selected value="">請選擇類別</option>
          <option value="1">汽機車精品百貨</option>
          <option value="2">原創設計良品</option>
          <option value="3">女裝與服飾配件</option>
          <option value="4">女包精品與女鞋</option>
          <option value="5">美容保養與彩妝</option>
          <option value="6">男性精品與服飾</option>
          <option value="7">手錶與飾品配件</option>
          <option value="8">嬰幼兒與孕婦</option>
          <option value="9">家電與影音視聽</option>
        </select>
      </div>
      <!-- <div class="form-group">
        商品上傳:
        <input type="file" class="form-control-file" name="m_picture[]" id="m_picture[]" required>
        商品名稱:
        <input type="text" class="form-control" name="m_imgtitle[]" id="m_imgtitle[]" required>
        商品內容:
        <textarea class="form-control" name="m_imgcontent[]" id="m_imgcontent[]" required></textarea>
      </div>
      <div class="input-group mb-3">
        <select class="custom-select" name="category[]" required>
          <option disabled selected value="">Choose...</option>
          <option value="1">汽機車精品百貨</option>
          <option value="2">原創設計良品</option>
          <option value="3">女裝與服飾配件</option>
          <option value="4">女包精品與女鞋</option>
          <option value="5">美容保養與彩妝</option>
          <option value="6">男性精品與服飾</option>
          <option value="7">手錶與飾品配件</option>
          <option value="8">嬰幼兒與孕婦</option>
          <option value="9">家電與影音視聽</option>
        </select>
      </div> -->
      <input name="action" type="hidden" id="action" value="add">
      <input type="submit" name="button" id="button" value="確定新增" />
      <span class="text-success" style="font-size:25pt;margin-left:25px;margin-top:5px;">
            <?php echo $_GET['showmsg']?>
      </span>
    </form>
  </div>

  <div class="container col">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <p class="font-weight-bold" style="margin-top:0px;margin-bottom:29px">文本敘述:</p>
        商品名稱:
        <input type="text" class="form-control" name="pdc_title" id="pdc_title" required>
        商品內容:
        <textarea class="form-control" name="pdc_content" id="pdc_content" required></textarea>
        預計價格:
        <input type="text" class="form-control" name="pdc_price" id="pdc_price" required>
      </div>
      <div class="input-group mb-3">
        <select class="custom-select" name="pdc_category" required>
          <option disabled selected value="">請選擇類別</option>
          <option value="1">汽機車精品百貨</option>
          <option value="2">原創設計良品</option>
          <option value="3">女裝與服飾配件</option>
          <option value="4">女包精品與女鞋</option>
          <option value="5">美容保養與彩妝</option>
          <option value="6">男性精品與服飾</option>
          <option value="7">手錶與飾品配件</option>
          <option value="8">嬰幼兒與孕婦</option>
          <option value="9">家電與影音視聽</option>
        </select>
      </div>
      <!-- <div class="form-group">
        商品上傳:
        <input type="file" class="form-control-file" name="m_picture[]" id="m_picture[]" required>
        商品名稱:
        <input type="text" class="form-control" name="m_imgtitle[]" id="m_imgtitle[]" required>
        商品內容:
        <textarea class="form-control" name="m_imgcontent[]" id="m_imgcontent[]" required></textarea>
      </div>
      <div class="input-group mb-3">
        <select class="custom-select" name="category[]" required>
          <option disabled selected value="">Choose...</option>
          <option value="1">汽機車精品百貨</option>
          <option value="2">原創設計良品</option>
          <option value="3">女裝與服飾配件</option>
          <option value="4">女包精品與女鞋</option>
          <option value="5">美容保養與彩妝</option>
          <option value="6">男性精品與服飾</option>
          <option value="7">手錶與飾品配件</option>
          <option value="8">嬰幼兒與孕婦</option>
          <option value="9">家電與影音視聽</option>
        </select>
      </div> -->
      <input name="action_pdc" type="hidden" id="action" value="add_pdc">
      <input type="submit" name="button" id="button" value="確定新增" />
      <span class="text-success" style="font-size:25pt;margin-left:25px;margin-top:5px;">
            <?php echo $_GET['showmsg_pdc']?>
      </span>
    </form>
  </div>


  </div>
  </div>
</body>

</html>