<?php
  
  
  if(isset($_GET["logout"]) && $_GET["logout"]==1){
    unset($_SESSION["loginMember"]);
    unset($_SESSION["memberLevel"]);
    header("./index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CosmosInfra</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    <link rel="stylesheet" href="./css/login.css" />
    <style>

    </style>
    <script
      src="https://code.jquery.com/jquery-1.12.0.min.js"
      integrity="sha256-Xxq2X+KtazgaGuA2cWR1v3jJsuMJUozyIXDB3e793L8="
      crossorigin="anonymous"
    ></script>
    <script src="./js/login.js" defer></script>
  </head>
  <body>
    <header>
      <div class="header-wrap">
        <div class="container">
          <div class="header-logo">
            <a href="#">
              <img src="https://www.cosmosinfra.net/img/logo/cosmosinfra_w.png"  alt="logo" width="40"/>
              <h1>CosmosInfra</h1>
            </a>
          </div>
          <nav class="header-nav">
            <div class="header-nav-list">
              <span>
                <a href="#">
                  <img src="https://www.cosmosinfra.net/img/flags/tw.png"  alt="flags" width="16"/>
                </a>
              </span>
              <span>
                <a href="#">
                  <img src="https://www.cosmosinfra.net/img/flags/ko.png" alt="flags" width="16" />
                </a>
              </span>
              <span>
                <a href="#">遊戲 <i class="fa-solid fa-caret-down"></i></a>
                <div class="header-nav-list-drop-down">
                  <span><a href="./index.php" target="_blank">SF Online</a></span>
                </div>
              </span>
              <span>
                <a href="#">服務 <i class="fa-solid fa-caret-down"></i></a>
                <div class="header-nav-list-drop-down">
                  <span><a href="">網咖活動</a></span>
                </div>
              </span>
              <span>
                <a href="#">客服中心 <i class="fa-solid fa-caret-down"></i></a>
                <div class="header-nav-list-drop-down">
                  <span><a href="">FAQ</a></span>
                  <span><a href="">問題回報</a></span>
                  <span><a href="">查看我的回報</a></span>
                </div>
              </span>
          <?php if(isset($_SESSION["loginMember"])){?>
              <span><a href="#">現金儲值</a></span>
              <span>
                <a href="#">帳號:<?php echo $_SESSION["loginMember"]?>&nbsp;  <i class="fa-solid fa-caret-down"></i></a>
                  <div class="header-nav-list-drop-down">
                    <span><a href="./personalInfo.php">個人資料</a></span>
                    <span><a href="">可用金額</a></span>
                    <span><a href="./changePasswd.php">修改密碼</a></span>
                    <span><a href="./index.php?logout=1">登出</a></span>
                  </div>
              </span>
          <?php }else{?>
            <span>
              <a href="./login.php">登入</a>
            </span>
            <span>
              <a href="./joinMember.php">加入會員</a>
            </span>
          <?php }?>
        </div>
          </nav>
          <div class="header-mobile-burger">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
        <div class="container">
          <nav class="header-nav header-mobile-nav">
            <div class="header-nav-list header-mobile-nav-list">
              <span
                ><a href="#"
                  ><img
                    src="https://www.cosmosinfra.net/img/flags/tw.png"
                    alt="flags"
                    width="16" /></a
              ></span>
              <span
                ><a href="#"
                  ><img
                    src="https://www.cosmosinfra.net/img/flags/ko.png"
                    alt="flags"
                    width="16" /></a
              ></span>
              <span>
                <a href="#">遊戲 <i class="fa-solid fa-caret-down"></i></a>
                <div
                  class="header-nav-list-drop-down header-mobile-nav-list-drop-down"
                >
                  <span><a href="./index.php" target="_blank">SF Online</a></span>
                </div>
              </span>
              <span>
                <a href="#">服務 <i class="fa-solid fa-caret-down"></i></a>
                <div
                  class="header-nav-list-drop-down header-mobile-nav-list-drop-down"
                >
                  <span><a href="">網咖活動</a></span>
                </div>
              </span>
              <span>
                <a href="#">客服中心 <i class="fa-solid fa-caret-down"></i></a>
                <div
                  class="header-nav-list-drop-down header-mobile-nav-list-drop-down"
                >
                  <span><a href="">FAQ</a></span>
                  <span><a href="">問題回報</a></span>
                  <span><a href="">查看我的回報</a></span>
                </div>
              </span>
              <?php if(isset($_SESSION["loginMember"])){?>
                <span><a href="#">現金儲值</a></span>
                <span>
                  <a href="#">帳號:<?php echo $_SESSION["loginMember"]?>&nbsp;  <i class="fa-solid fa-caret-down"></i></a>
                    <div class="header-nav-list-drop-down header-mobile-nav-list-drop-down">
                      <span><a href="./personalInfo.php">個人資料</a></span>
                      <span><a href="">可用金額</a></span>
                      <span><a href="./changePasswd.php">修改密碼</a></span>
                      <span><a href="./index.php?logout=1">登出</a></span>
                    </div>
                </span>
          <?php }else{?>
            <span>
              <a href="./login.php">登入</a>
            </span>
            <span>
              <a href="./joinMember.php">加入會員</a>
            </span>
          <?php }?>
            </div>
          </nav>
        </div>
      </div>
    </header>