
<?php
require_once("./connMysql.php");
session_start();

if(isset($_POST["action"]) && $_POST["action"] == "edited"){
  $query_passwdSelect = "SELECT m_passwd, m_id FROM memberdata WHERE m_username='{$_SESSION["loginMember"]}'";
  $query_passwd = $db_link->query($query_passwdSelect);
  $passwd = $query_passwd->fetch_assoc();
  // print_r($passwd["m_passwd"]);
  if(password_verify($_POST["password"], $passwd["m_passwd"]) && $_POST["newPassword"] == $_POST["confirmPassword"]){
    $mpass = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
    // $query_update = "UPDATE memberdata SET m_passwd = ? WHERE m_id = ?";
    // $stmt = $db_link->prepare($query_update);
    // $stmt->bind_param("si", $mpass, $passwd["m_id"]);
    // $stmt->execute();
    // $stmt->close();
    $query_update = "UPDATE memberdata SET m_passwd = '{$mpass}' WHERE m_id = $passwd[m_id]";
    $db_link->query($query_update);
    echo "成功";
  }else{
    echo "未執行";
  }
}


include("./templates/loginHeader.php");
?>

    <main>
      <section id="login">
        <div class="login-wrap">
          <div class="container">
            <div class="login-content-wrap">
              <div class="login-content-header">
                <p>修改密碼</p>
                <a href="./personalInfo.php">
                  <i class="fa-solid fa-xmark"></i>
                </a>
              </div>
              <div class="login-content-body">
                <h5>請定期更改密碼以保護您的帳號。</h5>
                <form action="" method="POST">
                  <div class="change-text">
                  <label for="">目前使用密碼</label>
                  <input
                    type="password"
                    name="password"
                    placeholder="請輸入密碼"
                    value=""
                  />
                  </div>
                  <div class="change-text">
                  <label for="">新密碼</label>
                  <input
                    type="password"
                    name="newPassword"
                    placeholder="新密碼"
                    value=""
                  />
                  </div>
                  <div class="change-text">
                  <label for="">確認新密碼</label>
                  <input
                    type="password"
                    name="confirmPassword"
                    placeholder="確認新密碼"
                    value=""
                  />
                  </div>
                  <hr>
                  <input type="hidden" name="action" value="edited">
                  <input type="submit" value="修改" />
                </form>

              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include("./templates/loginFooter.php");?>