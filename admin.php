<?php 
require_once("connMysql.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: index.php");
}
//檢查權限是否足夠
if($_SESSION["memberLevel"]=="member"){
	header("Location: member_center.php");
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	unset($_SESSION["memberLevel"]);
	header("Location: index.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
  </head>
  <body class="bg-dark text-white">
  <nav class="navbar bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand"><img src="https://sfonline.cosmosinfra.net/sf_favicon.ico" alt="logo"/>後台管理</a>
      <div class="navbar-nav">
        <a href="?logout=true" class="nav-link">登出</a>

      </div>
    </div>
  </nav>

  <ul class="nav nav-tabs bg-dark border-bottom border-bottom-dark" data-bs-theme="dark" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">客戶資料</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false">Disabled</button>
  </li>
</ul>
<div class="tab-content container" id="myTabContent">
  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
  <?php
  //刪除會員
  if(isset($_GET["action"])&&($_GET["action"]=="delete")){
    $query_delMember = "DELETE FROM memberdata WHERE m_id=?";
    $stmt=$db_link->prepare($query_delMember);
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();
    $stmt->close();
    header("Location: admin.php");
  }
  //選取管理員資料
  $query_RecAdmin = "SELECT m_id, m_name, m_logintime FROM memberdata WHERE m_username=?";
  $stmt=$db_link->prepare($query_RecAdmin);
  $stmt->bind_param("s", $_SESSION["loginMember"]);
  $stmt->execute();
  $stmt->bind_result($mid, $mname, $mlogintime);
  $stmt->fetch();
  $stmt->close();
  //選取所有一般會員資料
  //預設每頁筆數
  $pageRow_records = 5;
  //預設頁數
  $num_pages = 1;
  //若已經有翻頁，將頁數更新
  if (isset($_GET['page'])) {
    $num_pages = $_GET['page'];
  }
  //本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
  $startRow_records = ($num_pages -1) * $pageRow_records;
  //未加限制顯示筆數的SQL敘述句
  $query_RecMember = "SELECT * FROM memberdata WHERE m_level<>'admin' ORDER BY m_jointime DESC";
  //加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
  $query_limit_RecMember = $query_RecMember." LIMIT {$startRow_records}, {$pageRow_records}";
  //以加上限制顯示筆數的SQL敘述句查詢資料到 $resultMember 中
  $RecMember = $db_link->query($query_limit_RecMember);
  //以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_resultMember 中
  $all_RecMember = $db_link->query($query_RecMember);
  //計算總筆數
  $total_records = $all_RecMember->num_rows;
  //計算總頁數=(總筆數/每頁筆數)後無條件進位。
  $total_pages = ceil($total_records/$pageRow_records);
  ?>
  <table class="table table-dark table-striped">
  <thead>
    <tr>
      <th width="10%">&nbsp;</th>
      <th width="20%"><p>姓名</p></th>
      <th width="20%"><p>帳號</p></th>
      <th width="20%"><p>加入時間</p></th>
      <th width="20%"><p>上次登入</p></th>
      <th width="10%"><p>登入</p></th>
    </tr>
  </thead>
  <tbody>
    <?php while($row_RecMember=$RecMember->fetch_assoc()){ ?>
      <tr>
        <td><p><a href="member_adminupdate.php?id=<?php echo $row_RecMember["m_id"];?>">修改</a><br>
          <a href="?action=delete&id=<?php echo $row_RecMember["m_id"];?>" onClick="return deletesure();">刪除</a></p></td>
        <td><p><?php echo $row_RecMember["m_name"];?></p></td>
        <td><p><?php echo $row_RecMember["m_username"];?></p></td>
        <td><p><?php echo $row_RecMember["m_jointime"];?></p></td>
        <td><p><?php echo $row_RecMember["m_logintime"];?></p></td>
        <td><p><?php echo $row_RecMember["m_login"];?></p></td>
      </tr>
    <?php }?>

  </tbody>
</table>
<div class="d-flex justify-content-between align-items-center">
  <p>資料筆數：<?php echo $total_records;?></p></


  <nav aria-label="...">
    <ul class="pagination">
    <?php
      for($i=1;$i<=$total_pages;$i++){
        if($i==$num_pages){
          echo "<li class=\"page-item active \"><a class=\"page-link\" href=\"#\">$i</a></li>";
        }else{
          echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=$i\">$i</a></li>";
        }
      }
    ?>
    </ul>
  </nav>

</div>

  </div>
  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
  <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
  <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
</div>
  </body>
</html>