
<?php
  session_start();
  
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
    <title>SF Online</title>
    <link rel="icon" href="https://sfonline.cosmosinfra.net/sf_favicon.ico" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/all.css">
    <script
      src="https://code.jquery.com/jquery-1.12.0.min.js"
      integrity="sha256-Xxq2X+KtazgaGuA2cWR1v3jJsuMJUozyIXDB3e793L8="
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>
    <script src="./js/all.js" defer></script>
  </head>
  <body>
    <header>
      <div class="header-wrap">
        <div class="container">
          <div class="header-mobile-burger">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <nav class="header-mobile-nav">
            <div class="header-mobile-nav-list">
              <span><a href="./index.php">Home</a></span>
              <span>
                <a href="#">最新消息 <span>V</span></a>
                <div class="header-mobile-nav-list-drop-down">
                  <span><a href="./announcement.php">公告</a></span>
                  <span><a href="./event.php">活動</a></span>
                </div>
              </span>
              <span>
                <a href="#">遊戲介紹 <span>V</span></a>
                <div class="header-mobile-nav-list-drop-down">
                  <span><a href="./introduction.php">介紹</a></span>
                  <span><a href="">新手指南</a></span>
                  <span><a href="">操作鍵</a></span>
                  <span><a href="">腳色</a></span>
                  <span><a href="">地圖</a></span>
                  <span><a href="">軍階</a></span>
                  <span><a href="">遊戲規章</a></span>
                </div>
              </span>
              <span><a href="./download.php">下載</a></span>
              <span>
                <a href="#">遊客中心 <span>V</span></a>
                <div class="header-mobile-nav-list-drop-down">
                  <span><a href="">FAQ</a></span>
                  <span><a href="">問題回報</a></span>
                  <span><a href="">查看我的回報</a></span>
                  <span><a href="">終止合約名單</a></span>
                </div>
              </span>
              <span>
                <a href="#">加值服務 <span>V</span></a>
                <div class="header-mobile-nav-list-drop-down">
                  <span><a href="">轉盤活動</a></span>
                  <span><a href="">改名服務</a></span>
                  <span><a href="">80萬大樂透</a></span>
                  <span><a href="">槍枝贖回</a></span>
                  <span><a href="">改造一階初始化</a></span>
                  <span><a href="">LaMate商城</a></span>
                </div>
              </span>
            </div>
          </nav>

          <div class="header-logo">
            <a href="./index.php">
              <img
                src="https://sfonline.cosmosinfra.net/img/logo.png"
                alt="logo"
              />
            </a>
          </div>

          <nav class="header-nav">
            <div class="header-nav-list">
              <span><a href="./index.php">Home</a></span>
              <span>
                <a href="#">最新消息 V</a>
                <div class="header-nav-list-drop-down">
                  <span><a href="./announcement.php">公告</a></span>
                  <span><a href="./event.php">活動</a></span>
                </div>
              </span>
              <span>
                <a href="#">遊戲介紹 V</a>
                <div class="header-nav-list-drop-down">
                  <span><a href="./introduction.php">介紹</a></span>
                  <span><a href="">新手指南</a></span>
                  <span><a href="">操作鍵</a></span>
                  <span><a href="">腳色</a></span>
                  <span><a href="">地圖</a></span>
                  <span><a href="">軍階</a></span>
                  <span><a href="">遊戲規章</a></span>
                </div>
              </span>
              <span><a href="./download.php">下載</a></span>
              <span>
                <a href="#">遊客中心 V</a>
                <div class="header-nav-list-drop-down">
                  <span><a href="">FAQ</a></span>
                  <span><a href="">問題回報</a></span>
                  <span><a href="">查看我的回報</a></span>
                  <span><a href="">終止合約名單</a></span>
                </div>
              </span>
              <span>
                <a href="#">加值服務 V</a>
                <div class="header-nav-list-drop-down">
                  <span><a href="">轉盤活動</a></span>
                  <span><a href="">改名服務</a></span>
                  <span><a href="">80萬大樂透</a></span>
                  <span><a href="">槍枝贖回</a></span>
                  <span><a href="">改造一階初始化</a></span>
                  <span><a href="">LaMate商城</a></span>
                </div>
              </span>
            </div>
          </nav>

          <?php if(isset($_SESSION["loginMember"])){?>
            <div class="header-member header-member-info">
              <span>
                <a href="#">帳號: <?php echo $_SESSION["loginMember"]?> &nbsp;<span>V</span></a>
                  <div class="header-nav-list-drop-down">
                    <span><a href="./personalInfo.php">個人資料</a></span>
                    <span><a href="">可用金額</a></span>
                    <span><a href="./changePasswd.php">修改密碼</a></span>
                    <span><a href="./index.php?logout=1">登出</a></span>
                  </div>
              </span>
            </div>
          <?php }else{ ?>
          <div class="header-member">
            <span><a href="./login.php">登入</a></span>
            <span><a href="./joinMember.php">加入會員</a></span>
          </div>
          <?php }?>
        </div>
      </div>
    </header>