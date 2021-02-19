
<?php $slim =& get_instance();?>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>Millions of Premium Graphics Download For Free </title>
      <link rel="stylesheet" href="<?=base_url('assets/front/materialize.min.css')?>">
      <link rel="stylesheet" href="<?=base_url('assets/front/style.css')?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?=base_url('assets/front/masnory.css')?>">
      <meta name="robots" content="noindex">
      <meta name="google-signin-scope" content="profile email">
      <meta name="google-signin-client_id" content="926628310751-gghhmvep345pmcd9a1l8v8bifdc1kr02.apps.googleusercontent.com">
      <script src="https://apis.google.com/js/platform.js" async defer></script>
      <!-- Global site tag (gtag.js) - Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-44X0FV6RXM"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
      
        gtag('config', 'G-44X0FV6RXM');
      </script>
      <style>
         /* fallback */
         @font-face {
         font-family: 'Material Icons';
         font-style: normal;
         font-weight: 400;
         src: url(<?=base_url('/assets/front/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2')?>) format('woff2');
         }
         blockquote{
         border-color: #57adef;
         }
         .material-icons {
         font-family: 'Material Icons';
         font-weight: normal;
         font-style: normal;
         font-size: 24px;
         line-height: 1;
         letter-spacing: normal;
         text-transform: none;
         display: inline-block;
         white-space: nowrap;
         word-wrap: normal;
         direction: ltr;
         -webkit-font-smoothing: antialiased;
         }.pagination a {
         color: #444;
         display: inline-block;
         font-size: 1.2rem;
         padding: 0 15px;
         line-height: 30px;
         margin: 0px 5px;
         }li.active {
         background-color: #11ACEF !important;
         margin: 0px 5px !important;
         box-shadow: 0px 3px 6px #00000029;
         border-radius: 5px; 
         }a.pdes {
         box-shadow: 0px 3px 6px #00000029;
         background: #FFFFFF;
         border-radius: 5px;
         }.head-sec{
         padding: 0px 30px;
         }.user_img {
         width: 40px;
         margin: 12px auto;
         }
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