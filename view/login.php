<?php
//Đăng nhập
// if (isset($_POST['login'])){
if(isset($_POST['id_login']) && isset($_POST['pwd_login'])) {
  $id_user = $_POST['id_login'];
  $pwd = $_POST['pwd_login'];

  //Neu gia tri rong
  if (!$id_user || !$pwd ) {
        new Warning('','Vui lòng điền đầy đủ thông tin');
    } else {
        $sql_select_user = "SELECT idUser FROM user_auth WHERE idUser = '$id_user'";
        //Neu ton tai user
        if ($db->num_rows($sql_select_user)) {
            $sql_select_login = "SELECT idUser,pwd FROM user_auth WHERE idUser = '$id_user' AND pwd = '$pwd'";
            if ($db->num_rows($sql_select_login)) {
                $sql_check_stt = "SELECT idUser, pwd, status FROM user_auth WHERE idUser = '$id_user' AND pwd = '$pwd' AND status = 1";
                // Nếu username và password khớp và tài khoản không bị khoá (status = 1)
                if ($db->num_rows($sql_check_stt)) {
                      // Lưu session
                      $session->send($id_user);
                      // $db->close(); // Giải phóng

                      new Success($_DOMAIN,'Đăng nhập thành công'); // Trở về trang index
                } else {
                    new Warning('','Tài khoản của bạn đã bị khoá, vui lòng liên hệ quản trị viên để biết thêm thông tin chi tiết');
                }
              } else {
                    new Warning('','Mật khẩu không chính xác');
          }
      }
      // Ngược lại không tồn tại username
      else
      {
          new Danger('','Tên đăng nhập không tồn tại');
      }
    }
  }
  // // Nếu tồn tại POST act
  // if (isset($_POST['act']))
  // {
  //   $act = trim(addslashes(htmlspecialchars($_POST['act'])));
?>
    <div class="login-page"></div>
</body>
</html>
