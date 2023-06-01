
<?php
require_once("./connMysql.php");
session_start();
if(isset($_GET["id"])){
  $query_member = "SELECT m_username, m_email, m_phone, m_birthday, m_sex, m_jointime,  m_level FROM  memberdata WHERE m_id= ?";
  $stmt = $db_link->prepare($query_member);
  $stmt->bind_param("s", $_GET["id"]);
  $stmt->execute();
  $stmt->bind_result($username, $email, $phone, $birthday, $sex, $jointime,  $level);
  $stmt->fetch();

  $year = substr($birthday, 0, 4);
  $month = substr($birthday, 5, 2);
  $day = substr($birthday, 8, 2);

  $stmt->close();

}
// echo $_POST["birth-year"]."-".$_POST["birth-month"]."-".$_POST["birth-day"];
if(isset($_POST["action"]) && $_POST["action"] == "modify"){
  $query_memberUpdate = "UPDATE memberdata SET m_email=?, m_birthday=?, m_sex=?";
  $stmt = $db_link->prepare($query_memberUpdate);
  $date = $_POST["birth-year"]."-".$_POST["birth-month"]."-".$_POST["birth-day"];
  $stmt->bind_param("sss", $_POST["email"], $date, $_POST["sex"]);
  $stmt->execute();
  $stmt->close();
  header("Location: personalInfo.php");
}

include("./templates/loginHeader.php");
?>

    <main>
      <section id="login">
        <div class="login-wrap">
          <div class="container">
            <div class="login-content-wrap">
              <div class="login-content-header">
                <p>會員資料</p>
                <a href="./personalInfo.php">
                  <i class="fa-solid fa-xmark"></i>
                </a>
              </div>
              <div class="login-content-body">
                <h5>修改會員資料。將會是我們提高客户服務的寶貴資料。</h5>
                <form action="" method="POST">
                  <div class="personal-text">
                    <span>帳號</span>
                    <strong><?php echo $username;?></strong>
                  </div>
                  <div class="personal-text">
                  <label for="">電子郵件</label>
                  <input
                    type="email"
                    name="email"
                    value="<?php echo $email;?>"
                  />
                  </div>
                  <div class="personal-text">
                    <span>手機</span>
                    <strong><?php echo $phone;?></strong>
                  </div>
                  <div class="personal-text">
                    <label for="">出生日期</label>
                    <span>
                      <select name="birth-year" value="2001" id="">
                        <?php for($y=1987; $y<2024; $y++){
                          if($y == $year){
                            echo "<option value='{$y}' selected>{$y}</option>";
                          }else{
                            echo "<option value='{$y}'>{$y}</option>";
                          }
                        }?>
                      </select>
                      年 &nbsp;&nbsp;
                      <select name="birth-month" id="">
                      <?php for($m=1; $m<=12; $m++){
                        if($m<10){
                          $m = "0" . $m;
                          if($m == $month){
                            echo "<option value='{$m}' selected>{$m}</option>";
                          }else{
                            echo "<option value='{$m}'>{$m}</option>";
                          }
                        }else{
                          if($m == $month){
                            echo "<option value='{$m}' selected>{$m}</option>";
                          }else{
                            echo "<option value='{$m}'>{$m}</option>";
                          }
                        }
                        }?>
                      </select>
                      月 &nbsp;&nbsp;
                      <select name="birth-day" id="">
                      <?php for($d=1; $d<=31; $d++){
                        if($d<10){
                          $d = "0" . $d;
                          if($d == $day){
                            echo "<option value='{$d}' selected>{$d}</option>";
                          }else{
                            echo "<option value='{$d}'>{$d}</option>";
                          }
                        }else{
                          if($d == $day){
                            echo "<option value='{$d}' selected>{$d}</option>";
                          }else{
                            echo "<option value='{$d}'>{$d}</option>";
                          }
                        }
                        }?>
                      </select>
                      日 &nbsp;&nbsp;
                    </span>
                  </div>
                  <div class="personal-text">
                    <label for="">性別</label>
                  <select name="sex" id="">
                        <option value="男">男</option>
                        <option value="女" <?php if($sex == "女") echo "selected";?>>女</option>
                  </select>
                  </div>
                  <hr>
                  <input type="hidden" name="action" value="modify">
                  <input type="submit" value="修改完成" />
                </form>

              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include("./templates/loginFooter.php");?>