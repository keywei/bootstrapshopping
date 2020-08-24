<?php
// 連線資料庫資料庫
session_start();
require ("config.php");
$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
$result = mysqli_query ( $link, "set names utf8");
mysqli_select_db ( $link, $dbname );

// $commandText = <<<SqlQuery
// select id, fileName, imgTitle, imgContent, 
//   from productrs;
//   where id = $id
// SqlQuery;

$commandText = "select * from products where true";

// 搜尋欄關鍵字連線資料庫判斷
if($_GET['name']!='') {
  $commandText .= " and imgtitle like '%{$_GET['name']}%'";
};
// 分類欄關鍵字連線資料庫判斷
if ($_GET['category']) {
  $category = $_GET['category'];
  $commandText .= " and category = '$category'";
};

$result = mysqli_query ( $link, $commandText );
mysqli_close($link);
// while($rab = mysqli_fetch_assoc($result)){
//     echo $rab["id"]."__";
// }
$rows = [];
while($row = mysqli_fetch_assoc ( $result )) {
        $rows[]=$row;
};
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

        .jumbotron-bg {
            background-image: url('https://images.unsplash.com/photo-1477901492169-d59e6428fc90?w=1350');
            background-size: cover;
            background-position: center center;
            min-height: 400px;

        }

        .bg-lighter {
            background-color: rgba(255, 255, 255, .55)
        }

        .box-shadow {
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.16);
            transition: box-shadow .5s;
        }

        .box-shadow:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.36)
        }

        .btn.disabled {
            pointer-events: none;
        }

        .alert-rounded {
            border-radius: 50px !important;
        }

        .carousel .carousel-item {
            height: 300px;
        }

        .carousel .carousel-item img {
            min-height: 200px;
            max-height: 400px;
            width: 1140px;
            object-fit: fill;
        }

    </style>
</head>

<body>
    <!-- Image and text -->
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
                                <span id="cartqty" class="badge badge-pill badge-danger"></span>
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
                                                <td>Mercedes-AMG G63 AMG</td>
                                                <td>1件</td>
                                                <td class="text-right text-danger">＄1250000</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#removeModal"
                                                        data-title="古董商品"><i
                                                            class="far fa-trash-alt fa-1x text-danger"></i></a>
                                                </td>
                                                <td>平成の紙譜</td>
                                                <td>1件</td>
                                                <td class="text-right text-danger">$15000</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><a
                                                        href="＃"
                                                        type="submit" class="btn btn-info btn-block">送出</a></td>
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
                             <a class="btn btn-link pt-0" href="member.php" id="dLabe3" aria-haspopup="true"
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
    </div>
    <div class="container-fluid bg-dark py-3">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner ">
                <div class="carousel-item  active">
                    <img class="d-block ml-auto mr-auto" src="images/A2.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block ml-auto mr-auto" src="images/A4.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block ml-auto mr-auto" src="images/A3.jpg" alt="Third slide">
                </div>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group sticky-top">
                    <a href="bootstrapshopping.php?category=1" class="list-group-item list-group-item-action">
                        <i class="fab fa-accusoft"></i>汽機車精品百貨
                    </a>
                    <a href="bootstrapshopping.php?category=2" class="list-group-item list-group-item-action">
                        <i class="fas fa-address-card"></i>原創設計良品
                    </a>
                    <a href="bootstrapshopping.php?category=3" class="list-group-item list-group-item-action">
                        <i class="fab fa-adn"></i>女裝與服飾配件
                    </a>
                    <a href="bootstrapshopping.php?category=4" class="list-group-item list-group-item-action">
                        <i class="fas fa-air-freshener"></i>女包精品與女鞋
                    </a>
                    <a href="bootstrapshopping.php?category=5" class="list-group-item list-group-item-action">
                    <i class="fas fa-female"></i></i>美容保養與彩妝
                    </a>
                    <a href="bootstrapshopping.php?category=6" class="list-group-item list-group-item-action">
                    <i class="fas fa-user-tie"></i></i>男性精品與服飾
                    </a>
                    <a href="bootstrapshopping.php?category=7" class="list-group-item list-group-item-action">
                    <i class="fas fa-hat-wizard"></i></i>手錶與飾品配件
                    </a>
                    <a href="bootstrapshopping.php?category=8" class="list-group-item list-group-item-action">
                    <i class="fas fa-child"></i></i>嬰幼兒與孕婦
                    </a>
                    <a href="bootstrapshopping.php?category=9" class="list-group-item list-group-item-action">
                    <i class="fas fa-tv"></i></i>家電與影音視聽
                    </a>
                    <br>
                    <iframe class="sticky-top" width="261" height="315" src="https://www.youtube.com/embed/oV_i3Hsl_zg" frameborder="0"
            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                
            </div>
            <div class="col-md-9">
                <form method="get" class="form-inline">
                    <div class="input-group mb-3 mt-2">
                        <input type="text" name="name" class="form-control" placeholder="搜尋商品" aria-label="Recipient's username"
                            aria-describedby="basic-addon2">
                        <input type="hidden" name="category" value="<?php echo $_GET['category'];?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-info" type="submit"><i
                                    class="fas fa-search"></i>Search</button>
                        </div>
                    </div>
                </form>
                <div class="tab-content" id="nav-tabContent">
                    
                        <?php
                        $len = count($rows);
                        for($index = 0; $index < $len; $index++) {
                            $row = $rows[$index];
                            if($index % 3 == 0) {
                                echo '<div class="row">';
                            }
                        ?>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="images/<?=$row['imgfilename']?>" class="card-img-top" alt="..." style="height: 225px;object-fit: cover;">
                                        <div class="card-body" style="height:340px;">
                                            <h5 class="card-title"style="height:80px;"><?=$row['imgTitle']?></h5>
                                            <p class="card-text"><?=$row['imgContent']?></p>
                                        </div>
                                        <div class="card-footer align-middle">
                                            <button class="btn btn-warning"id="<?=$row['id'] ?>" onclick="addcart(this)">有意出售</button>
                                            <span style="font-size:15pt;color:red;float:right;">$<?=$row['m_price'] ?>元</span>
                                            <!-- <small class="text-muted"></small> -->
                                        </div>
                                    </div>
                                </div>
                        <?php 
                            if($index % 3 == 2 || $index == $len - 1) {
                                echo '</div>';
                            }
                        }
                        ?>
                                <!-- <div class="card">
                                    <img src="images/A2.jpg" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This card has supporting text below as a natural lead-in to
                                            additional
                                            content.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>
                                <div class="card">
                                    <img src="images/A5.jpg" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a
                                            natural lead-in to
                                            additional content. This card has even longer content than the first to show
                                            that equal
                                            height action.</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated 3 mins ago</small>
                                    </div>
                                </div>

                            </div> -->

                            

                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light text-muted py-2">
        <div class="container">
            <ul class="list-inline text-center">
                <li class="list-inline-item"> © Copright 2020 許願網</li>
                <li class="list-inline-item">
                    <a href="#" class="text-info">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" class="text-info">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" class="text-info">
                        <i class="fas fa-user-tag"></i> About
                    </a>
                </li>
            </ul>
        </div>
    </footer>
    <script>
    var cartqty=document.getElementById("cartqty");
    function addcart(myObj){
        if(cartqty.innerText==""){
            cartqty.innerText=1;
        }else{cartqty.innerText= parseInt(cartqty.innerText)+1;
        }
    }
    </script>
</body>

</html>