
<?php

require_once("./connMysql.php");
session_start();

if(isset($_SESSION["loginMember"]) && $_SESSION["loginMember"] != ""){
  $query_member = "SELECT m_id, m_username, m_email, m_phone, m_birthday, m_sex, m_jointime,  m_level FROM  memberdata WHERE m_username = ?";
  $stmt = $db_link->prepare($query_member);
  $stmt->bind_param("s", $_SESSION["loginMember"]);
  $stmt->execute();
  $stmt->bind_result($id, $username, $email, $phone, $birthday, $sex, $jointime,  $level);
  $stmt->fetch();
  $stmt->close();
}

?>
<?php include("./templates/loginHeader.php");?>


    <main>
      <section id="login">
        <div class="login-wrap">
          <div class="container">
            <div class="login-content-wrap">
              <div class="login-content-header">
                <p>會員資料</p>
              </div>
              <div class="login-content-body">
                <h5>為了保障資料安全，請會員確認下方資料</h5>
                <div class="personal-text">
                  <span>帳號</span>
                  <strong><?php echo $username;?></strong>
                </div>
                <div class="personal-text">
                  <span>電子郵件</span>
                  <strong><?php echo $email;?></strong>
                </div>
                <div class="personal-text">
                  <span>手機</span>
                  <strong><?php echo $phone;?></strong>
                </div>
                <div class="personal-text">
                  <span>出生日期</span>
                  <strong><?php echo $birthday;?></strong>
                </div>
                <div class="personal-text">
                  <span>性別</span>
                  <strong><?php echo $sex;?></strong>
                </div>
                <div class="personal-text">
                  <span>加入日期</span>
                  <strong><?php echo $jointime;?></strong>
                </div>
                <div class="personal-text">
                  <span>會員等級</span>
                  <strong><?php if($level == "member") echo "普通會員"; ?></strong>
                </div>
                <hr>
                <a href="./dataModify.php?id=<?php echo $id?>" class="modify-confirm">
                  修改 / 確認
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include("./templates/loginFooter.php");?>