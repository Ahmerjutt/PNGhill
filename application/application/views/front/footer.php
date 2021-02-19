<?php 
$Editable = FALSE;
if (isset($isEditable)) {
  $post = $post->result()[0]; 
  $Editable = TRUE;
}
 ?>
<?php $controller =& get_instance();?>
<!-- Gitter Chat Link -->
<div class="fixed-action-btn">
  <a class="btn-floating btn-small blue" href="#body"><i class="large material-icons">keyboard_arrow_up</i></a>
  <?php if ($Editable): ?>
    <?php if ($controller->isAdmin()): ?>
      <a class="btn-floating btn-small red" href="<?=base_url('admin-panel/edit?action=post&task=edit&id='.$post->ID)?>"><i class="large material-icons">edit</i></a>
    <?php endif; ?>
  <?php endif; ?>
  <?php if ($controller->isAdmin()): ?>
    <?php echo '<a class="btn btn-small green" href="'.base_url('admin-panel').'">Admin Dashboard</a>' ?>
  <?php endif; ?>
</div>
<div id="signup" class="modal logmod sup">
  <div class="modal-content center-align">
    <p class="text-center logtext">Register and start download</p>
    <div class="g-signin2" data-onsuccess="onSignIn" data-theme="light"></div>
    <p class="center-align bold" style="margin-bottom:0px;">or</p>
    <form class="logform" action="" method="post">
      <input id="uname" type="text" placeholder="username" required>
      <input id="email" type="email" placeholder="Email" required>
      <input id="password" type="password" placeholder="password" required>
      <a href="#" onclick="signupfun()" class="inbtn lgtn fbtn waves-effect modal-trigger">SIGN UP</a>
      <p>By creating an account, I agree to Pnghill's <a href="#">Terms of Service</a>, <a href="#">Privacy Policy</a></p>
      <p>Already have an account? <a href="#" class="bold" onclick="forma('login')">Log in</a> </p>
    </form>
  </div>
</div>
<div id="login" class="modal logmod log">
  <div class="modal-content center-align">
    <p class="text-center logtext">Login pnghill</p>
    <div class="g-signin2" data-onsuccess="onSignIn" data-theme="light"></div>
    <p class="center-align bold" style="margin-bottom:0px;">or</p>
    <form class="logform" action="" method="post">
      <input id="lemail" type="email" placeholder="Email">
      <input id="lpassword" type="password" placeholder="password">
      <a href="#" onclick="logfun()" class="inbtn lgtn fbtn waves-effect modal-trigger">LOGIN</a> <hr>
      <p><a href="#" class="bold" onclick="forma('forgotpass')">Forgot Password ?</a> </p>
      <p>Don't hava an account <a href="#" class="bold" onclick="forma('signup')">Sign up</a> </p>
    </form>
  </div>
</div>
<div id="forgotpass" class="modal logmod log">
  <div class="modal-content center-align">
    <img src="<?=base_url('assets/logo.png')?>" alt="pnghill logo" width="160">
    <p class="text-center logtext">Forgot Password ?</p>
    <form class="logform" action="" method="post">
      <input type="email" placeholder="Email">
      <a href="#" class="inbtn lgtn fbtn waves-effect modal-trigger">Send Email</a> <hr>
      <p><a href="#" class="bold" onclick="forma('login')">Go to Login</a> </p>
    </form>
  </div>
</div>
<!-- Modal Structure -->
<div id="contactuss" class="modal">
  <div class="modal-content">
    <p class="text-center logtext">Contact US</p>
    <form class="logform" action="" method="post">
      <input type="text" placeholder="Your Name">
      <input type="email" placeholder="Email">
      <textarea style="padding:13px !important;height:80px" rows="8" cols="80" placeholder="Your Message"></textarea>
      <a href="#" class="inbtn lgtn fbtn waves-effect">Send Message</a>
      <br>
    </form>
  </div>
</div>
<!-- Footer -->
<section>
   <footer class="page-footer white">
      <div class="container">
         <div class="row">
            <div class="col l6 s12">
               <h5 class="black_tp"><img class="logo-footer" src="<?=base_url('assets/logo.png')?>" alt="pnghill logo"></h5>
               <p class="text-lighten-4 black_tp">get free unlimited graphics designs, Backgrounds, PNG images, Wallpapers, Text Fonts, & Everything about designing with copy right and source file to use in your project.</p>
            </div>
            <div class="col l4 offset-l2 s12">
               <h5 class="black_tp">Site Links</h5>
               <ul>
                  <li><a class="black_tp text-lighten-3" href="<?=base_url('about')?>">About</a></li>
                  <li><a class="black_tp text-lighten-3 modal-trigger" href="#contactuss">Contact</a></li>
                  <li><a class="black_tp text-lighten-3" href="<?=base_url('privacy-policy')?>">Privacy-Policy</a></li>
               </ul>
            </div>
         </div>
      </div>
      <br>
      <div class="footer-copyright light-blue darken-1">
         <div class="container">© <?=date('Y')?> All Rights Reserved
            <a class="right white-text" href="mailto:info@pnghill.com">info@pnghill.com</a>
         </div>
      </div>
   </footer>
</section>
<script src="<?=base_url('assets/front/jquery-3.5.1.min.js')?>"></script>
<script src="<?=base_url('assets/front/materialize.min.js')?>"></script>
<script src="<?=base_url('assets/front/masonry.pkgd.js')?>"></script>
<?php $fiit =& get_instance();?>
<script type="text/javascript">
    function logfun(){
      var email = document.getElementById('lemail').value;
      var password = document.getElementById('lpassword').value;
      var hash =  {"email":email,"password":password,"action":"login"};
      var encoded = btoa(JSON.stringify(hash));
      const Http = new XMLHttpRequest();
      Http.open("GET", "<?=base_url('login')?>?hash=" + encoded);
      Http.send();
      Http.onreadystatechange = (e) => {
        var res = JSON.parse(Http.responseText);
        if (res.action == true) {
            location.reload();
        }else{
            M.toast({html: res.msg});
        }
      }
    }
    function signupfun(){
      var uname = document.getElementById('uname').value;
      var email = document.getElementById('email').value;
      var password = document.getElementById('password').value;
      var hash =  {"uname":uname,"email":email,"password":password,"action":"signup"};
      var encoded = btoa(JSON.stringify(hash));
      const Http = new XMLHttpRequest();
      Http.open("GET", "<?=base_url('login')?>?hash=" + encoded);
      Http.send();
      Http.onreadystatechange = (e) => {
        var res = JSON.parse(Http.responseText);
        if (res.action == true) {
            location.reload();
        }else{
            M.toast({html: res.msg});
        }
      }
    }
    function forma(param) {
      var signup = document.getElementById("signup");
      var login = document.getElementById("login");
      var forgotpass = document.getElementById("forgotpass");
      var signup_ins = M.Modal.getInstance(signup);
      var login_ins = M.Modal.getInstance(login);
      var forgotpass_ins = M.Modal.getInstance(forgotpass);
      if (param == 'login') {
        signup_ins.close();
        forgotpass_ins.close();
        login_ins.open();
      }else if (param == 'signup') {
        signup_ins.open();
        forgotpass_ins.close();
        login_ins.close();
      }else if (param == 'forgotpass') {
        signup_ins.close();
        login_ins.close();
        forgotpass_ins.open();
      }
    }
    window.onscroll = function() {fixedHeader()};
      var header = document.getElementById("navbar-fixed");
      var sticky = header.offsetTop;
      function fixedHeader() {
        if (window.pageYOffset > sticky) {
          header.classList.add("sticky");
        } else {
          header.classList.remove("sticky");
        }
      }
      function ddt() {
        var x = document.getElementById("ddt");
        if (x.style.display === "none") {
          x.style.display = "block";
        } else {
          x.style.display = "none";
        }
      }
      function ddt2() {
        var x = document.getElementById("ddt2");
        if (x.style.display === "none") {
          x.style.display = "block";
        } else {
          x.style.display = "none";
        }
      }
    function sout(){
      document.cookie = "<?=md5(base_url())?>=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      location.reload();
    }
    function setlogvalue(image) {
      var html = '<li class="position-relative"> <a class="black_tp bold" href="#"><img src="'+image+'" class="circle responsive-img user_img"></a> <div class="ddtop" style="display:none"> <ul><li> <a href="#" onclick="sout()">Log Out</a></li> </ul> <div> </li>';
      document.getElementById("logsys").innerHTML = html;
    }
    var isLoged = "<?=$fiit->isUser()?>";
   // document.addEventListener('DOMContentLoaded', function () {
   //   var elems = document.querySelectorAll('.sidenav');
   //   var instances = M.Sidenav.init(elems);
   // });
   // document.addEventListener('DOMContentLoaded', function () {
   //   var elems = document.querySelectorAll('select');
   //   var instances = M.FormSelect.init(elems);
   // });
   // document.addEventListener('DOMContentLoaded', function() {
   //    var elems = document.querySelectorAll('.modal');
   //    var instances = M.Modal.init(elems);
   //  });
   // $('.modal').modal();
</script>
<script masnory="script">
  // $('#masList').masonry({
  //   itemSelector: '.list-item',
  //   singleMode: true,
  //   isAnimated: true,
  //   resizeable: true,
  // });

// $(document).ready(function () {
//   $(".img-list").each(function () {
//     var height = $(this).find(".img-show").find('.imgmain').css("height");
//     var et = height.slice(0, -2)
//     var fheight = Math.round(et)+ 'px';
//     // var fh = (fheight-20) + 'px';
//     // console.log(fheight);
//     $(this).find(".img-show").css("height", fheight);
//   });
// });
 function masonryNew() {
   var _width = $(window).width();
   var reg = new RegExp("px", "g");
   $(".img-list").each(function () {
     var imgLength = $(this).find(".img-show").find("img").length;
     if (imgLength != 0) {
       var sqlimgWidth = 300;
       var TimgWidth = $(this).find(".img-part").find("img").css("width");
       var TimgWidthNum = TimgWidth.replace(reg, "");
       var thanNum = (TimgWidthNum / sqlimgWidth).toFixed(2);
       var TimgHeigth = $(this).find(".img-show").css("height");
       var TimgHeigthNum = TimgHeigth.replace(reg, "");
       var TdivHeight = (TimgHeigthNum * thanNum).toFixed(2);
       var sheight = TdivHeight + "px";
       $(this).find(".img-show").css("height", TimgHeigth);
       var $masList = $('#masList');
       $masList.masonry({
         itemSelector: '.list-item',
         singleMode: true,
         isAnimated: true,
         resizeable: true,
         // fitWidth: true
       });
     }
   });
 }
 
 masonryNew();

</script>
<!-- Google Auto Login -->
<script src="https://accounts.google.com/gsi/client" async defer></script>
<script>
   window.onload = function() {
     if(isLoged == ''){
      console.log('not signed in');
       google.accounts.id.initialize({
         client_id: '926628310751-gghhmvep345pmcd9a1l8v8bifdc1kr02.apps.googleusercontent.com',
         callback: rese
       });
         google.accounts.id.prompt();
         google.accounts.id.prompt((notification) => {
           if (notification.isNotDisplayed() || notification.isSkippedMoment()) {
               // console.log('Just Away!');
           }
       });
       function rese(param){
         var hash =  param.credential;
         const Http = new XMLHttpRequest();
         Http.open("GET", "<?=base_url('glogin')?>?hash=" + hash);
         Http.send();
         Http.onreadystatechange = (e) => {
           var user = JSON.parse(Http.responseText);
           setlogvalue(user.img);
           location.reload();
         }
       } 
     }else {
      console.log('No Way');
     }
   };
</script>
<script>
   function onSignIn(googleUser) {
     var profile = googleUser.getBasicProfile();
     var id_token = googleUser.getAuthResponse().id_token;
     const Http = new XMLHttpRequest();
     Http.open("GET", "<?=base_url('glogin')?>?hash=" + id_token);
     Http.send();
     Http.onreadystatechange = (e) => {
       var signup = document.getElementById("signup");
       var login = document.getElementById("login");
       var forgotpass = document.getElementById("forgotpass");
       var signup_ins = M.Modal.getInstance(signup);
       var login_ins = M.Modal.getInstance(login);
       var forgotpass_ins = M.Modal.getInstance(forgotpass);
       signup_ins.close();
       forgotpass_ins.close();
       login_ins.close();
       // var user = JSON.parse(Http.responseText);
       // setlogvalue(user.img);
       // location.reload();
     }
   }
</script>

</body>
</html>