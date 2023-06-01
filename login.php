<?php
require_once("./connMysql.php");
session_start();

if(isset($_SESSION["loginMember"]) && $_SESSION["loginMember"] != ""){
  if($_SESSION["loginLevel"] == "member"){
    header("Location: index.php");
  }else{
    // header("Location: member_admin.php");
  }
}
if(isset($_POST["username"]) && isset($_POST["passwd"])){
  $query_RecLogin = "SELECT m_username, m_passwd, m_level FROM memberdata WHERE m_username=?";
  $stmt = $db_link->prepare($query_RecLogin);
  $stmt->bind_param("s", $_POST["username"]);
  $stmt->execute();
  $stmt->bind_result($username, $passwd, $level);
  $stmt->fetch();
  $stmt->close();

  if(password_verify($_POST["passwd"], $passwd)){
    $query_RecLoginUpdate = "UPDATE memberdata SET m_login = m_login+1, m_logintime=NOW() WHERE m_username=?";
    $stmt = $db_link->prepare($query_RecLoginUpdate);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();
    
    $_SESSION["loginMember"] = $username;
    $_SESSION["memberLevel"] = $level;
    
    if(isset($_POST["rememberme"]) && $_POST["rememberme"] == "true"){
      setcookie("remUser", $_POST["username"], time()+365*24*60);
      setcookie("remPass", $_POST["passwd"], time()+365*24*60);
    }else{
      if(isset($_COOKIE["remUser"])){
        setcookie("remUser", $_POST["username"], time()-100);
        setcookie("remPass", $_POST["passwd"], time()-100);
      }
    }
    if($_SESSION["memberLevel"] == "member"){
      header("Location: index.php");
    }else{
      header("Location: admin.php");
    }
  }else{
    header("Location: login.php?errMsg=1");
  }
}
?>
<?php include("./templates/loginHeader.php");?>
    <main>
      <section id="login">
        <div class="login-wrap">
          <div class="container">
            <div class="login-content-wrap">
              <div class="login-content-header">
                <p>登入</p>
                <a href="./joinMember.html">
                  <i class="fa-solid fa-xmark"></i>
                </a>
              </div>
              <div class="login-content-body">
                <h5>
                  <?php 
                    if(isset($_GET["errMsg"]) && $_GET["errMsg"]==1){
                      echo "登入帳號或密碼錯誤";
                    }else{
                      echo "您好，請登入您的帳號";
                    }
                  ?>
                </h5>
                <form action="" method="POST">
                  <label for="">帳號</label>
                  <input
                    type="text"
                    name="username"
                    placeholder="請輸入您的帳號"
                    value="<?php if(isset($_COOKIE["remUser"]) && ($_COOKIE["remUser"]!="")) echo $_COOKIE["remUser"];?>"
                  />
                  <label for="">密碼</label>
                  <input
                    type="password"
                    name="passwd"
                    placeholder="請輸入您的密碼"
                    value="<?php if(isset($_COOKIE["remPass"]) && ($_COOKIE["remUser"]!="")) echo $_COOKIE["remPass"];?>"
                  />
                  <label for="save" class="save">
                    <input type="checkbox" id="save" name="rememberme" value="true" checked/>
                    <span>儲存登入資料</span>
                  </label>
                  <hr>
                  <input type="submit" value="登入" />
                </form>
                <div class="login-content-body-btns">
                  <a href="#">查詢帳號</a>
                  <a href="#">忘記密碼</a>
                  <a href="#">加入會員</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include("./templates/loginFooter.php");?>