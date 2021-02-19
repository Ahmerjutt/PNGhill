<?php $slim =& get_instance();?>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title><?=$title?></title>
      <link rel="stylesheet" href="<?=base_url('assets/front/materialize.min.css')?>">
      <!-- <link rel="stylesheet" href="assets/front/style.css"> -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- <link rel="stylesheet" href="assets/front/masnory.css"> -->
      <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/front/favicon-16x16.png')?>">
      <link rel="apple-touch-icon" sizes="57x57" href="<?=base_url('assets/front/apple-icon-57x57.png')?>">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <?php echo "<meta name='keywords' content='".$keywords."' >"; ?>
      <?php echo "<meta name='description' content='".$description."' >"; ?>
      <!-- <meta name="robots" content="$index"> -->
      <meta name="robots" content="noindex">
      <meta name="google-signin-scope" content="profile email">
      <meta name="google-signin-client_id" content="926628310751-gghhmvep345pmcd9a1l8v8bifdc1kr02.apps.googleusercontent.com">
      <script src="https://apis.google.com/js/platform.js" async defer></script>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-6N7YCJNLLL"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
      
        gtag('config', 'G-6N7YCJNLLL');
      </script>
      
<style media="screen">
  *{outline:0}body{background:#f7f7f7}.shdow_36{box-shadow:0 3px 6px #0000000f}nav .brand-logo{padding:13px 0}.black_tp{color:#707070A6!important}.bold{font-weight:700}.uppercase{text-transform:uppercase}.pm0{margin:0;padding:20px 10px}.headerbg{background-repeat:no-repeat!important;background-size:cover!important;height:449px!important;min-height:392px!important;background-position:bottom!important}.headc{max-width:932px;width:100%;margin:auto}.headc h1{color:#707070;font-size:30px;font-weight:500;margin:0}.headc p{color:#707070}.searchform input{width:100%;border:none;padding:17px 10px;border-radius:5px;border-radius:5px}.searchform{max-width:932px;width:100%;margin:auto}.flex{display:flex;flex-wrap:nowrap}.searchform{background:#fff 0 0 no-repeat padding-box;box-shadow:0 3px 6px #00000029;border-radius:5px}.dropdd a{background:red}.btnwhite{display:flex;height:auto;padding:7px 10px;background:0 0;color:#707070;line-height:36px;box-shadow:none!important;font-weight:700}.da{line-height:36px}input.select-dropdown.dropdown-trigger,input.select-dropdown.dropdown-trigger:focus{border:none;padding:0 14px;height:100%}.searchform input,.select-wrapper ul li span,input.select-dropdown.dropdown-trigger{color:#707070;font-weight:500;text-transform:uppercase}.searchform input{text-transform:unset;padding-right:50px;text-shadow:none}.searchbox{position:relative}.searchbox i{position:absolute;right:5px;top:6px;bottom:0;font-size:43px;color:#11acef}.tags{padding:20px 0;text-align:center}.tags a{background:#fffFFFF0 0 0 no-repeat padding-box;box-shadow:0 3px 6px #0000001A;border-radius:5px;padding:5px 20px;color:#707070;margin:0 10px;font-weight:500;text-align:center;line-height:40px}.breadcrumb{font-size:14px;font-weight:700;font-family:Montserrat}.breadcrumb:before{margin:0 4px 0 4px;font-size:16px;color:#707070A6!important;top:-1px}.pngheading p{font-weight:700;letter-spacing:0;color:#707070;padding:10px}.mainView{border-radius:5px;box-shadow:0 3px 6px #00000029;margin-bottom:20px}.mainImage img{display:block;width:100%;max-height:500px;height:auto;margin:auto;overflow:hidden;object-fit:contain}.mainFooter>.ones{padding:10px;padding-left:30px;padding-right:30px}.headfp{margin-top:10px;margin-bottom:0;padding-left:10px;font-weight:700}.embedcode{background:#dadada;border:none;border-radius:5px;height:115px;padding:7px;overflow:hidden;resize:none}.lightbtn{width:100%!important;display:block;background:#fff;color:#707070;border-radius:5px;box-shadow:0 3px 6px #00000029;font-weight:700;line-height:50px;height:50px;font-size:17px}.lightbtn:hover{background-color:#fff!important;box-shadow:0 3px 6px #00000029}.lightbtn:focus{background-color:#fff!important}.waves-effect.waves-brown .waves-ripple{background-color:rgba(17,172,239,.644)}.downbtns{margin-bottom:10px}.lbbtn,.lbbtn:hover{background-color:#11acef!important;color:#fff!important}.lbbtn:focus{background-color:#11acef!important}.ssh{width:33.333%;text-align:center}.ssh .flex{display:inline-flex;line-height:23px;color:#707070!important;font-weight:700}.ssh .flex i{margin-right:2px;color:#707070;font-size:17px;line-height:25px}.f2 .ssh{width:25%}.containerp{max-width:1080px;width:95%;margin:auto}.shrw{text-align:center;margin:10px 0}.blue i{background-color:#11acef!important}.collection-item{background-color:transparent!important;color:#707070!important;font-weight:700}.collection-item .badge{font-weight:400}.ymal a img{width:100%;background-color:#fff;border-radius:5px;height:120px;object-fit:cover}.ymal{margin:10px auto}.downloadmBox{background:#fff 0 0 no-repeat padding-box;box-shadow:0 3px 8px #0000001C;border-radius:5px;max-width:932px;margin:20px auto;height:150px}.prebm{width:300px;text-align:center;height:100%}.logo-footer{height:50px}.overlayee{display:block;position:absolute;height:500px;width:100%;opacity:.2}.recc{box-shadow:0 3px 6px #00000029}.ddtop{position:absolute;background:#fff;max-width:300px;width:186px;color:#000;padding:5px;right:0;border-radius:0 0 5px 5px;box-shadow:3px 5px 6px 0 #0000000f;border-top:2px solid #69bbed}.inbtn{background:#fff;box-shadow:0 3px 6px #00000029;border-radius:5px;height:40px;line-height:40px;color:#11acef;margin:12px 0;font-weight:700;margin-left:10px}.lgtn{background:#11acef;color:#fff}nav ul a.inbtn:hover{background-color:#f3f3f3}nav ul a.lgtn:hover{background-color:#11acefc2}.ddtop ul li{width:100%}.ddtop ul li a{display:block;height:30px;line-height:30px;color:#000}.navbar-fixed{background:#fff}.sticky{position:fixed;top:0;width:100%;background:#fff}.logmod{max-width:450px;width:90%;border-radius:10px}.abcRioButton.abcRioButtonLightBlue{width:100%!important}p.logtext{font-size:19px;color:#333;text-align:center;margin-top:25px;font-weight:500}.logform input,.logform textarea{background:#fff!important;border:none!important;box-shadow:0 2px 4px 0 rgba(0,0,0,.25)!important;margin-top:20px!important;border-radius:5px!important;padding:0 10px!important;box-sizing:border-box!important}.fbtn{display:block!important;box-shadow:0 2px 4px 0 rgba(0,0,0,.25)!important;text-align:center!important;margin-left:0!important}.logform input:hover{-webkit-box-shadow:0 0 3px 3px rgba(66,133,244,.3)!important;box-shadow:0 0 3px 3px rgba(66,133,244,.3)!important}.logoC{width:100px;height:100px;border-radius:50px;background:#fff;left:0;right:0;margin:0 auto;top:-52px;text-align:center;box-shadow:0 0 6px 0 rgba(0,0,0,.14),0 9px 46px 8px rgba(0,0,0,.12),0 11px 15px -7px rgba(0,0,0,.2)}.logoC img{width:100%;text-align:center!important;width:76px;margin:auto;vertical-align:middle;margin:35px auto}.modal .modal-content{padding:15px}.imgimg{height:250px;width:250px;object-fit:cover;text-align:center;margin:auto}.list-item{border-radius:10px}.deeman{background:#fff;border-radius:5px;box-sizing:border-box;box-shadow:0 3px 8px #0000001C;margin-bottom:20px}img.prevdimg{text-align:center;border-radius:5px;height:150px;border:2px solid #478cde;object-fit:cover;width:200px}.ttdd{padding:33px 0}.chere{color:#478cde}.modal{max-height:100%!important}li.mobielusermenu{display:none}.ddtop2{top:64px}@media only screen and (max-width:993px){li.mobielusermenu{display:block}}.clearfix:after{content:"";display:block;height:0;clear:both;visibility:hidden}*{box-sizing:border-box}.fl{float:left}.fr{float:right}.body-bg{background:#f5f5f5}.logo-box{text-align:center;margin-top:100px;padding-bottom:20px}.span-btn{display:inline-block;width:0;height:0;border-width:6px;border-style:solid;border-color:#ddd transparent transparent transparent;position:relative;top:5px}.title-h1{text-align:center;font-size:42px;color:#666;padding-top:60px;padding-bottom:10px}.img-list-box{margin-top:20px;margin-left:-5px;margin-right:-5px}.img-list{float:left;height:auto;position:relative;transition:all .2s}.img-list .img-show{margin:10px 10px 0;position:relative;max-height:1000px;overflow:hidden;text-align:center}.img-list .img-show img{display:inline;width:100%;max-width:260px}.img-list .img-bg{position:absolute;left:0;top:0;background:#000;width:100%;height:100%;opacity:.4;display:none}.img-list:hover .img-bg{display:block}.img-btn-box{position:absolute;top:10px;right:5px;z-index:5}.img-btn-box a:nth-child(1){margin-right:5px}.img-btn-box a{display:block;width:46px;height:22px;font-weight:700;line-height:22px;text-align:center;color:#fff;margin-bottom:10px;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;opacity:0;-webkit-transform:scale(0);-moz-transform:scale(0);-ms-transform:scale(0);-o-transform:scale(0);transform:scale(0);-webkit-transition:all .5s;-moz-transition:all .5s;-ms-transition:all .5s;-o-transition:all .5s;transition:all .5s;background:#d9091e}.img-btn-box i{display:inline-block;width:16px;height:16px;background:url(/images/down-white.png) no-repeat;background-size:contain;position:relative;top:3px;margin-right:8px}.img-list:hover .img-btn-box a{-webkit-transform:scale(1);-moz-transform:scale(1);-ms-transform:scale(1);-o-transform:scale(1);transform:scale(1);opacity:1}.img-detail{height:auto;transition:all .2s;margin:10px 10px 12px;margin-bottom:6px;width:93%}.img-detail .img-detail-title{color:#5f5f5f;padding-bottom:12px;border-bottom:1px solid #e4e4e4;margin-bottom:9px}.img-list-pd{background:#fbfbfb 0 0 no-repeat padding-box;box-shadow:0 3px 6px #00000029;border-radius:10px}.info-title{color:#7e7e7e}.download-info{color:#7e7e7e}.download-info p{margin-right:10px}.download-info-p{margin:0;padding:0}.download-info img{display:inline;margin-right:3px}.download-info span{position:relative;top:-2px}.div-h{height:50px}.tag-list-box{width:100%;max-width:1480px}.tag-title{text-align:center;padding-bottom:20px;font-size:48px;color:#666;font-weight:700}.text-p{font-size:20px;color:#333;font-weight:700;padding-top:20px}@-webkit-keyframes swiper-preloader-spin{100%{-webkit-transform:rotate(360deg)}}@keyframes swiper-preloader-spin{100%{transform:rotate(360deg)}}.tag-icon-box{float:left}.tag-icon-div{float:left;height:24px;line-height:24px;color:#666;margin-top:5px;padding-right:20px;cursor:pointer;position:relative}.tag-icon-div span{color:#999;float:left}.tag-icon-i{float:left;display:block;width:24px;height:24px;position:relative;top:-2px;opacity:.3}.tag-icon-div:hover .tag-icon-i{opacity:.6}.download-img{margin:auto;position:absolute;left:0;right:0;top:0;bottom:0}@media only screen and (min-width:1525px){.img-list{width:283px;margin-bottom:20px;margin-right:16px;background-color:#fff}.pic-info{padding:0 0 10px 0}.img-list:hover{transform:translate3d(0,-2px,0)}}@media only screen and (max-width:1524px){.img-list{width:20%;margin-bottom:10px}.pic-info{padding:0}.img-list-pd{margin:0 5px;background-color:#fff;padding:2px}.img-list-pd:hover{transform:translate3d(0,-2px,0)}}@media only screen and (max-width:1240px){.img-list{width:25%}}@media only screen and (max-width:992px){.logo-box{margin-top:20px}.logo-box-img{height:65px}.div-h{height:50px}.div-h2{height:117px}.title-h1{font-size:28px;padding-top:30px}.download-info,.info-title{display:block}.img-list{width:33.333%}.tag-list-box{width:100%;min-width:100%;max-width:100%}.tag-title{font-size:32px}}@media only screen and (max-width:830px){.img-list .img-show{background:0 0}.img-list:hover .img-bg{background:0 0}}@media only screen and (max-width:680px){.img-list{width:50%}}@media only screen and (max-width:424px){.img-list{width:100%}}div#masList{width:95%;margin:auto}.img-detail-title{margin:0;padding:0;border:0;font:inherit;font-size:100%;vertical-align:baseline;color:#000}.img-detail-title a{color:#000}blockquote{border-color:#57adef}.material-icons{font-family:'Material Icons';font-weight:400;font-style:normal;font-size:24px;line-height:1;letter-spacing:normal;text-transform:none;display:inline-block;white-space:nowrap;word-wrap:normal;direction:ltr;-webkit-font-smoothing:antialiased}.pagination a{color:#444;display:inline-block;font-size:1.2rem;padding:0 15px;line-height:30px;margin:0 5px}li.active{background-color:#11acef!important;margin:0 5px!important;box-shadow:0 3px 6px #00000029;border-radius:5px}a.pdes{box-shadow:0 3px 6px #00000029;background:#fff;border-radius:5px}.head-sec{padding:0 30px}.user_img{width:40px;margin:12px auto}
</style>
   </head>
   <body id="body">
      <!-- Navbar -->
      <nav class="shdow_36 navbar-fixed" id="navbar-fixed">
         <div class="head-sec">
         <div class="nav-wrapper">
         <a href="<?=base_url()?>" class="brand-logo"><img src="<?=base_url('assets/logo.png')?>" alt="PNGhill Logo" width="100"
            title=""></a>
         <a href="#" data-target="mobile-demo" class="sidenav-trigger none"><i class="material-icons black_tp">menu</i></a>
         <!-- <a href="#" class="sidenav-trigger right"><i class="material-icons black_tp">menu</i></a> -->
         <?php if ($slim->isUser()): ?>
         <?php if ($slim->getCurrentUser() != false): ?>
         <?php $user = $slim->getCurrentUser()[0] ?>
         <li class="position-relative mobielusermenu">
            <a class="black_tp bold sidenav-trigger right" onclick="ddt2()" href="#"><img src="<?=$user->u_img?>" alt="<?=$user->u_name?>" class="circle responsive-img user_img"></a>
            <div class="ddtop ddtop2" id="ddt2" style="display:none">
            <ul>
               <!-- <li> <a href="#">Settings</a></li> -->
               <li> <a href="#" onclick="sout()">Log Out</a></li>
            </ul>
          </div>
         </li>
         <?php endif; ?>
         <?php else: ?>
         <a href="#login" class="sidenav-trigger right modal-trigger"><i class="material-icons black_tp">person</i></a>
         <?php endif; ?>
         <ul class="right hide-on-med-and-down" id="appen">
            <li><a class="black_tp bold" href="<?=base_url('c/png')?>">PNG Images</a></li>
            <li><a class="black_tp bold" href="<?=base_url('c/backgrounds')?>">Backgrounds</a></li>
            <li><a class="black_tp bold" href="<?=base_url('c/templates')?>">Templates</a></li>
            <li><a class="black_tp bold" href="<?=base_url('c/illustrations')?>">Illustrations</a></li>
            <?php if ($slim->isUser()): ?>
            <?php if ($slim->getCurrentUser() != false): ?>
            <?php $user = $slim->getCurrentUser()[0] ?>
            <li class="position-relative">
               <a class="black_tp bold" onclick="ddt()" href="#"><img src="<?=$user->u_img?>" alt="<?=$user->u_name?>" class="circle responsive-img user_img"></a>
               <div class="ddtop" id="ddt" style="display:none">
               <ul>
                  <!-- <li> <a href="#">Settings</a></li> -->
                  <li> <a href="#" onclick="sout()">Log Out</a></li>
               </ul>
               <div>
            </li>
            <?php endif; ?>
            <?php else: ?>
            <span id="logsys">
              <li><a href="#signup" class="inbtn waves-effect modal-trigger">SIGNUP</a></li>
              <li><a href="#login" class="inbtn lgtn waves-effect modal-trigger" id="demo">LOGIN</a></li>
            </span>
            <?php endif; ?>
         </ul>
         </div>
         <ul class="sidenav" id="mobile-demo">
           <li><a class="black_tp bold" href="<?=base_url('c/png')?>">PNG Images</a></li>
           <li><a class="black_tp bold" href="<?=base_url('c/backgrounds')?>">Backgrounds</a></li>
           <li><a class="black_tp bold" href="<?=base_url('c/templates')?>">Templates</a></li>
           <li><a class="black_tp bold" href="<?=base_url('c/illustrations')?>">Illustrations</a></li>
         </ul>
      </nav>