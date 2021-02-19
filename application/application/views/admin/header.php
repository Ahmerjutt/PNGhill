<?php 
  if (!isset($_COOKIE[md5(base_url())])) {
    redirect(base_url('admin-panel/login'));exit();
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
      <title>Dashboard - Admin</title>
      <link href="<?=base_url('assets/files/')?>datatables.min.css" rel="stylesheet">
        <!-- Materialize-->
        <link href="<?=base_url('assets/files/')?>admin-materialize.min.css" rel="stylesheet">
        <!-- Material Icons-->
        <style>
          /* fallback */
            @font-face {
              font-family: 'Material Icons';
              font-style: normal;
              font-weight: 400;
              src: url(<?=base_url('assets/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2')?>) format('woff2');
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
            }
        </style>
   <style media="screen">
   
   .character-counter{
     display: none !important;
   }
     .uprev{
       background: #cacaca;
       height: 300px;
       text-align: center;
       line-height: 370px;
       margin: 20px 0px;
       margin-top: 0px;
       cursor: pointer;
       position: relative;
     }.uprev i{
       font-size: 100px;
     }.uprev:hover{
       cursor: pointer;
     }.uprev img{
       height: 250px;
        position: absolute;
        left: 0px;
        right: 0px;
        margin-left: 0px;
        margin-right: 0px;
        margin: auto;
        object-fit: contain !important;
        top: 23px;
     }.left-align.cats {
        overflow: auto;
        height: 220px;
      }
      /* width */
      ::-webkit-scrollbar {
        width: 8px;
      }

      /* Track */
      ::-webkit-scrollbar-track {
        background: #f1f1f1;
      }

      /* Handle */
      ::-webkit-scrollbar-thumb {
        background: #88888873;
        border-radius: 10px;
      }

      /* Handle on hover */
      ::-webkit-scrollbar-thumb:hover {
        background: #555;
      }.none{
        display: none;
      }
      input:focus{
        box-shadow: none !important;
      }.chips input{
          width: 100% !important;
      }.input {
          border: none !important;
      }
      #modded .progress {
        min-height: 36px;
        overflow: hidden;
        position: relative;
      }
      #category p {
          padding: 0px;
          margin: 0px;
      }
      #modded .progress span {
        position: relative;
        float: left;
        color: #fff;
        padding: 8px;
        z-index: 99999;
      }
      #modded .progress span i {
        width: inherit;
        font-size: inherit;
        position: relative;
        top: 2px;
        margin-left: 8px;
      }
      #modded .progress .determinate {
        width: 0;
        -webkit-transition: width 1s ease-in-out;
        transition: width 1s ease-in-out;
        padding: 8px;
        position: relative;
        color: #fff;
        text-align: right;
        white-space: nowrap;
      }
      #modded ul.collapsible {
        padding: 0;
        border: none;
        border-radius: 0;
        box-shadow: none;
      }
      #modded ul.collapsible li {
        margin-bottom: 14px;
      }
      #modded ul.collapsible .collapsible-header {
        padding: 0;
        border-bottom: 0;
      }
      #modded ul.collapsible .collapsible-header .progress {
        margin: 0;
        border-radius: 0;
      }
      #modded ul.collapsible .collapsible-body {
        padding: 16px;
        box-shadow: rgba(0, 0, 0, 0.137255) 0px 2px 2px 0px, rgba(0, 0, 0, 0.117647) 0px 3px 1px -2px, rgba(0, 0, 0, 0.2) 0px 1px 5px 0px;
      }

      @-webkit-keyframes grow {
        from {
          width: 0;
        }
      }

      @keyframes grow {
        from {
          width: 0;
        }
      }

   </style>
   </head>
   <body class="has-fixed-sidenav">
      <header>
        <div class="none loading" style=";
    position: fixed;
    z-index: 22222222;
    width: 100% !important;">
          <div class="progress" style="margin:0px;">
              <div class="indeterminate"></div>
          </div>
        </div>
         <div class="navbar-fixed">
            <nav class="navbar white">
               <div class="nav-wrapper">
                  <a href="<?=base_url()?>" target="_blank" class="brand-logo grey-text text-darken-4 waves-effect">View Site <i class="material-icons">open_in_new</i></a>
                  <button id="pac" class="btn waves-effect red none" style="margin-left: 10px;">Delete</button>
                  <ul id="nav-mobile" class="right">
                     <li class="hide-on-med-and-down"><a href="#!" data-target="dropdown1" class="dropdown-trigger waves-effect"><i class="material-icons">notifications</i></a></li>
                     <li><a href="#!" data-target="chat-dropdown" class="dropdown-trigger waves-effect"><i class="material-icons">settings</i></a></li>
                  </ul>
                  <a href="#!" data-target="sidenav-left" class="sidenav-trigger left"><i class="material-icons black-text">menu</i></a>
               </div>
            </nav>
         </div>
         <ul id="sidenav-left" class="sidenav sidenav-fixed white" style="box-shadow: 0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.3);">
            <li><a href="/pages/admin-dashboard" class="logo-container">PNGhill Dashboard</a></li>
            <li class="no-padding">
               <ul class="collapsible collapsible-accordion">
                  <li class="bold waves-effect">
                     <a href="<?=base_url('admin-panel')?>" class="collapsible-header">Dashboard</a>
                  </li>
                  <li class="bold waves-effect">
                     <a href="<?=base_url('admin-panel/quickpost')?>" class="collapsible-header">Quick Post</a>
                  </li>
                  <li class="bold waves-effect">
                     <a class="collapsible-header">Posts<i class="material-icons chevron">chevron_left</i></a>
                     <div class="collapsible-body">
                        <ul>
                          <li><a href="<?=base_url('admin-panel/posts')?>" class="waves-effect" id="nvlinks">All Post<i class="material-icons">select_all</i></a></li>
                           <!-- <li><a href="admin-panel/add/post" class="waves-effect" id="nvlinks">Add Post<i class="material-icons">add_box</i></a></li> -->
                           <li><a href="<?=base_url('admin-panel/add/category')?>" class="waves-effect" id="nvlinks">Add Category<i class="material-icons">add</i></a></li>
                        </ul>
                     </div>
                  </li>
               </ul>
            </li>
         </ul>
         <div id="dropdown1" class="dropdown-content notifications">
            <div class="notifications-title">notifications</div>
            <div class="card">
               <div class="card-content">
                  <span class="card-title">Joe Smith made a purchase</span>
                  <p>Content</p>
               </div>
               <div class="card-action"><a href="#!">view</a><a href="#!">dismiss</a></div>
            </div>
            <div class="card">
               <div class="card-content">
                  <span class="card-title">Daily Traffic Update</span>
                  <p>Content</p>
               </div>
               <div class="card-action"><a href="#!">view</a><a href="#!">dismiss</a></div>
            </div>
            <div class="card">
               <div class="card-content">
                  <span class="card-title">New User Joined</span>
                  <p>Content</p>
               </div>
               <div class="card-action"><a href="#!">view</a><a href="#!">dismiss</a></div>
            </div>
         </div>
         <div id="chat-dropdown" class="dropdown-content dropdown-tabbed">
            <ul class="tabs tabs-fixed-width">
               <li class="tab col s3"><a href="#settings">Settings</a></li>
               <li class="tab col s3"><a href="#friends" class="active">Friends</a></li>
            </ul>
            <div id="settings" class="col s12">
               <div class="settings-group">
                  <div class="setting">
                     Night Mode
                     <div class="switch right">
                        <label>
                        <input type="checkbox"><span class="lever"></span>
                        </label>
                     </div>
                  </div>
                  <div class="setting">Beta Testing
                     <label class="right">
                     <input type="checkbox"><span></span>
                     </label>
                  </div>
               </div>
            </div>
            <div id="friends" class="col s12">
               <ul class="collection flush">
                  <li class="collection-item avatar">
                     <div class="badged-circle online"><img src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/portrait1.jpg?v=1218798423999129079" alt="avatar" class="circle"></div>
                     <span class="title">Jane Doe</span>
                     <p class="truncate">Lo-fi you probably haven't heard of them</p>
                  </li>
                  <li class="collection-item avatar">
                     <div class="badged-circle"><img src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/portrait2.jpg?v=15342908036415923195" alt="avatar" class="circle"></div>
                     <span class="title">John Chang</span>
                     <p class="truncate">etsy leggings raclette kickstarter four dollar toast</p>
                  </li>
                  <li class="collection-item avatar">
                     <div class="badged-circle"><img src="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/portrait3.jpg?v=4679613373594475586" alt="avatar" class="circle"></div>
                     <span class="title">Lisa Simpson</span>
                     <p class="truncate">Raw denim fingerstache food truck chia health goth synth</p>
                  </li>
               </ul>
            </div>
         </div>
      </header>
