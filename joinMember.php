<?php
function GetSQLValueString($theValue, $theType) {
  switch ($theType) {
    case "string":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_SPECIAL_CHARS) : "";
      break;
    case "int":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_SANITIZE_NUMBER_INT) : "";
      break;
    case "email":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_EMAIL) : "";
      break;
    case "url":
      $theValue = ($theValue != "") ? filter_var($theValue, FILTER_VALIDATE_URL) : "";
      break;      
  }
  return $theValue;
}

if(isset($_POST["action"])&&($_POST["action"]=="join")){
	require_once("connMysql.php");
	//找尋帳號是否已經註冊
	$query_RecFindUser = "SELECT m_username FROM memberdata WHERE m_username='{$_POST["m_username"]}'";
	$RecFindUser=$db_link->query($query_RecFindUser);
	if ($RecFindUser->num_rows>0){
		header("Location: member_join.php?errMsg=1&username={$_POST["m_username"]}");
	}else{
	//若沒有執行新增的動作	
		$query_insert = "INSERT INTO memberdata (m_username, m_passwd, m_email, m_jointime) VALUES (?, ?, ?, NOW())";
		$stmt = $db_link->prepare($query_insert);
		$stmt->bind_param("sss", 
			GetSQLValueString($_POST["m_username"], 'string'),
			password_hash($_POST["m_passwd"], PASSWORD_DEFAULT),
			GetSQLValueString($_POST["m_email"], 'email'));
		$stmt->execute();
		$stmt->close();
		$db_link->close();
		header("Location: login.php");
	}
}
?>
<?php include("./templates/loginHeader.php");?>
    <main>
      <section id="login">
        <div class="login-wrap join-member-wrap">
          <div class="container">
            <div class="login-content-wrap">
              <div class="login-content-header">
                <p>加入會員</p>
                <a href="./login.html">
                  <i class="fa-solid fa-xmark"></i>
                </a>
              </div>
              <div class="login-content-body">
                <h5>您好，開始創建帳號</h5>
                <form action="" method="POST">
                  <label for="">帳號</label>
                  <input
                    type="text"
                    name="m_username"
                    placeholder="須包含8-16位的英文+數字混合，不可使用符號"
                  />
                  <label for="">密碼</label>
                  <input
                    type="password"
                    name="m_passwd"
                    placeholder="須包含8-16位的英文+數字混合，不可使用符號"
                  />
                  <label for="">確認密碼</label>
                  <input
                    type="password"
                    name="passwd"
                    placeholder="須包含8-16位的英文+數字混合，不可使用符號"
                  />
                  <label for="">電子郵件</label>
                  <input
                    type="email"
                    name="m_email"
                    placeholder="一組帳號請使用一組電子信箱"
                  />
                  <hr>
                  <label for="checkAll" >
                    <input type="checkbox" id="checkAll"  class="checkAll"/>
                    <span>我同意以下所有條款</span>
                  </label>
                  <div class="checks">
                    <label for="serve" class="serve" >
                      <input type="checkbox" id="serve" />
                      <span>服務條款 <a href="#">[ 內容確認 ]</a></span>
                    </label>
                    <label for="privacy" class="privacy" >
                      <input type="checkbox" id="privacy" />
                      <span>隱私條款 <a href="#">[ 內容確認 ]</a></span>
                    </label>
                  </div>
                  <hr>
                  <input type="hidden" name="action" value="join">
                  <input type="submit" class="join" value="加入" />
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php include("./templates/loginFooter.php");?>
