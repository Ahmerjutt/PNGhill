<?php 
$wrong = FALSE;
if (isset($_POST['login'])) {
	$this->load->model('checks');
  $ch = $this->checks->Fetch('sigma',array('u_email' => $_POST['username'], 'u_pass' => md5($_POST['password']) ),'UID');
  if ($ch->num_rows() > 0) {
    $detail = $ch->result()[0];
		if ($detail->u_role) {
			$cookie_name = md5(base_url());
			$cookie_value = md5($detail->email);
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
			redirect(base_url('admin-panel'));
		}else{
			$wrong = TRUE;
		}
  }else{
    $wrong = TRUE;
  }
}
 ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="msapplication-tap-highlight" content="no">
      <meta name="robots" content="noindex">
      <meta name="description" content="">
      <title>Login - Admin</title
      <!-- Materialize-->
      <link href="<?=base_url('assets/files/')?>admin-materialize.min.css" rel="stylesheet">
   </head>
   <body>
<main>
  <div class="container">
  <div class="row">
    <div class="col s8 offset-s2">

      <div class="card card-login">
        <div class="card-login-splash">
          <div class="wrapper">
            <h3>Admin Login</h3>
          </div>

          <img src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/geometric-cave.jpg?v=13127282243134125143" alt="">
        </div>
        <div class="card-content">
          <span class="card-title">Log In</span>
          <?php if ($wrong): ?>
            <blockquote style="border-color:red;">
              Username & Password Not Matched
            </blockquote>
          <?php endif; ?>
          <form action="" method="POST">
            <div class="input-field">
              <input name="username" type="text" class="validate" placeholder="Email">
            </div>
            <div class="input-field">
              <input name="password" type="password" class="validate" placeholder="Password">
            </div>

            <a href="#!">Forgot Password?</a>

            <br><br>
            <div>
              <input class="btn right" type="submit" name="login" value="Log In">
              <a href="#!" class="btn-flat">Back</a>
            </div>

          </form>
        </div>
      </div>

    </div>
  </div>

</div>

    </main>