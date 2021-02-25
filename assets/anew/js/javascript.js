var url = window.location.origin + '/pnghill/';
var aurl = window.location.href;
var svg = '<svg class="animate-spin h-5 w-auto mr-3" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
function loader(target,text,onoff) {
  if (onoff == true) {
    $(target).html(svg + '<span>' + text +'</span>');
    $(target).prop('disabled', true);
  }else{
    $(target).html('<span>' + text +'</span>');
    $(target).prop('disabled', false);
  }
}
function toast(ac,text,link='#') {
  if (link != '#') {
    var alink = '<a target="_blank" class="font-bold text-blue-400 ml-3" href="'+link+'">View</a>'
  }else {
    var alink = '';
  }
  $('#toast').css("display", "block");
  var success_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="flex-none fill-current text-green-500 h-4 w-4 mt-0.5"> <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" /></svg>';
  var error_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="flex-none fill-current text-red-500 h-4 w-4 mt-0.5"> <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.597 17.954l-4.591-4.55-4.555 4.596-1.405-1.405 4.547-4.592-4.593-4.552 1.405-1.405 4.588 4.543 4.545-4.589 1.416 1.403-4.546 4.587 4.592 4.548-1.403 1.416z" /></svg>';
  var s_html = '<div style="width:270px;z-index:3;top:9px; right: 30px; margin-right: 0; margin-left: 0;" class="absolute bg-green-100 p-3 w-full sm:w-1/2 rounded"> <div class="flex justify-between"> <div class="flex space-x-3">'+success_svg+'<div class="flex-1 leading-tight text-sm text-green-700 font-medium">'+text+alink+'</div> </div> </div> </div>';
  var e_html = '<div style="width:270px;z-index:3;top:9px; right: 30px; margin-right: 0; margin-left: 0;" class="absolute bg-red-100 p-3 w-full sm:w-1/2 rounded"> <div class="flex justify-between"> <div class="flex space-x-3">'+error_svg+'<div class="flex-1 leading-tight text-sm text-red-700 font-medium">'+text+'</div> </div> </div> </div>';
  if (ac == true) {
    $('#toast').html(s_html);
    setTimeout(function() {
      $('#toast').fadeOut('fast');
    }, 2000);
  }else{
    $('#toast').html(e_html);
    setTimeout(function() {
      $('#toast').fadeOut('fast');
    }, 2000);
  }
}
  $('#imgeww').change(function () {
    var img = $(this).val();
    $('#prevImage').attr('src',img)
  })
  $('#imgmain').change(function () {
    var imge = URL.createObjectURL($(this)[0].files[0]);
    $('#prevImage').attr('src',imge);
  });
  $('#imgee').change(function () {
    var imge = URL.createObjectURL($(this)[0].files[0]);
    $('#prevImage').attr('src',imge);
  });
  $('#zipbtn').click(function () {
    $('#uploadzipm').fadeIn('fast');
  });
  $('#cancel').click(function () {
    $('#uploadzipm').fadeOut('fast');
  });
// Delete Post
$('a#dpost').click(function () {
  var thiss = $(this);
  loader(this,'Deleting..',true);
  var id = $(this).attr('did');
  var urle = url + 'Welcome/Edit?action=post&task=delete';
  $.ajax({
    url : urle,
    method: 'POST',
    data : {id:id},
    success : function (output) {
      returned =  JSON.parse(output)
      if(returned.action == true){
        loader(thiss,'Delete',false);
        toast(true,'post has been deleted');
        $(thiss).parent().parent().parent().parent().parent().parent().fadeOut('fast');
      }else{
        loader('a#dpost','Delete',false);
        toast(false,returned.msg);
      }
    }
  });
});
// Publish POST
$('#Publish').click(function (e) {
  loader('#Publish','Publishing..',true);
  var cats = [];
  var workWith = [];
  $.each($('#workWith input:checked'), function() {
    workWith.push($(this).val());
  });
  $.each($('#category input:checked'), function() {
    cats.push($(this).val());
  });
  if (cats == '') {
    cats = '';
  }
  var title = $('#title').val();
  var mTitle = $('#mTitle').val();
  var mDesc = $('#mDesc').val();
  var mTags = $('#mTags').val();
  var hash = $('#tagss').val();
  var ziplink = $('#d_link').val();
  e.preventDefault();
	var data = new FormData();
	data.append('file', $('#imgmain')[0].files[0]);
  data.append('action','post');
  data.append('title',title);
  data.append('mTitle',mTitle);
  data.append('mDesc',mDesc);
  data.append('mTags',mTags);
  data.append('cats',cats);
  data.append('tags',hash);
  data.append('workWith',workWith);
  data.append('ziplink', ziplink);
  $.ajax({
    url : url+'Welcome/publish',
    method: 'POST',
    data : data,
    contentType : false,
    processData : false,
    success : function (rdata) {
      returned =  JSON.parse(rdata)
      if(returned.action == true){
        loader('#Publish','Publish',false);
        toast(true,'Post Published',returned.link);
      }else{
        loader('#Publish','Publish',false);
        toast(false,returned.msg);
      }
    }
  });
});
// Updatin Images
$('#imgee').change(function (e) {
  e.preventDefault();
  var id = $(this).attr('did');
  var link = $(this).attr('x24');
  var orginal = $(this).attr('orignal');
	var data = new FormData();
	data.append('file', $(this)[0].files[0]);
  data.append('id',id);
  data.append('x24',link);
  data.append('orginal', orginal);
  $.ajax({
    url : url+'Welcome/editfe',
    method: 'POST',
    data : data,
    contentType : false,
    processData : false,
    success : function (rdata) {
      returned =  JSON.parse(rdata)
      if(returned.action == true){
        toast(true,'featured image updated');
      }else{
        toast(false,returned.msg);
      }
    }
  });
});
// Update post
$('#Update').click(function () {
  loader('#Update','Updating..',true);
  var cats = [];
  var workWith = [];
  $.each($('#workWith input:checked'), function() {
    workWith.push($(this).val());
  });
  $.each($('#category input:checked'), function() {
    cats.push($(this).val());
  });
  if (cats == '') {
    cats = '';
  }
  if (workWith == '') {
    workWith = '';
  }
  var id = $(this).attr('did');
  var title = $('#title').val();
  var mTitle = $('#mTitle').val();
  var mDesc = $('#mDesc').val();
  var mTags = $('#mTags').val();
  var hash = $('#tagss').val();
  var ziplink = $('#d_link').val();
  $.ajax({
    url : url+'admin-panel/edit?action=post&task=update',
    method: 'POST',
    data : {cats:cats,workWith:workWith,id:id,title:title,mTitle:mTitle,mDesc:mDesc,mTags:mTags,hash:hash,ziplink:ziplink},
    success : function (rdata) {
      returned =  JSON.parse(rdata)
      if(returned.action == true){
        loader('#Update','Update',false);
        toast(true,'Post has been updated',returned.link);
      }else{
        loader('#Update','Update',false);
        toast(false,returned.msg);
      }
    }
  });
});
// Zip Uploading
$('#submit').click(function () {
  var fdata = new FormData();
  fdata.append('img', $('#hidden-input').prop('files')[0]);
  $('#propar').css("display",'block');
  $.ajax({
    xhr: function() {
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener("progress", function(evt) {
        if (evt.lengthComputable) {
          var percentComplete = evt.loaded / evt.total;
          percentComplete = parseInt(percentComplete * 100);
          console.log(percentComplete);
          $('#progress').css("width",percentComplete + '%');
          $('#progress>span').text(percentComplete);
          if (percentComplete === 100) {
            $('#progress>span').text('upload completed');
            setTimeout(function() {
              $('#progress').fadeOut('fast');
            }, 2000);
          }
        }
      }, false);
  
      return xhr;
    },
    url: url+'Welcome/uploadZip',
    type: "POST",
    processData: false, // important
    contentType: false, // important
    data: fdata,
    dataType: "json",
    success: function(img) {
      if(img.action == true){
        $('#d_link').val(img.path);
        toast(true,'file has been uploaded');
        $('#uploadzipm').fadeOut('fast');
        while (gallery.children.length > 0) {
          gallery.lastChild.remove();
        }
        FILES = {};
        empty.classList.remove("hidden");
        gallery.append(empty);
      }else{
        $('#progress>span').text(img.msg);
        $('#uploadzipm').addClass('hidden');
        toast(false,img.msg);
      }
    }
  });
});
// PostPublish
$('#qPublish').click(function () {
  loader('#qPublish','Publishing..',true);
  var cats = [];
  var workWith = [];
  var hash = [];
	$.each($("#category input:checked"), function(){
		cats.push($(this).val());
	});
  $.each($('#workWith input:checked'), function() {
    workWith.push($(this).val());
  });
  if (cats == '') {
    cats = '';
  }
  if (workWith == '') {
    workWith = '';
  }
  var tags = $('#tagsw').val();
  var title = $('#title').val();
  var mTitle = $('#mTitle').val();
  var mDesc = $('#mDesc').val();
  var post_clink = $('#linkww').val();
  var mTags = $('#mTags').val();
  var ziplink = $('#d_link').val();
  var featuredImage = $('#prevImage').attr('src');
  if (featuredImage == url + 'assets/anew/images/upload.png') {
    var featuredImage = '';
  }
  var action = 'post';
  $.ajax({
    url : url+'Welcome/qpublish',
    method: 'POST',
    data : {post_clink:post_clink,action:action,title:title,mTitle:mTitle,mDesc:mDesc,mTags:mTags,cats:cats,tags:tags,workWith:workWith,ziplink:ziplink,featuredImage:featuredImage},
    success : function (rdata) {
      returned =  JSON.parse(rdata)
      if(returned.action == true){
        loader('#qPublish','Publish',false);
        toast(true,'Published Successfully',returned.link);
      }else{
        toast(false,returned.msg);
        loader('#qPublish','Publish',false);
      }
    }
  });
});
// QuickPost (PNGtree)
$('#checkit').click(function () {
  loader('#checkit','Checking..',true);
  var link = $('input#linkww').val();
  $.ajax({
    url : url+'Welcome/qp?link='+link,
    method: 'POST',
    success : function (rdata) {
      returned =  JSON.parse(rdata)
      if(returned.action == 'true'){
        $('#title').val(returned.title);
        var ss =$('#tagsw').val(returned.tags);
        $('main').removeClass('ddiv');
        loader('#checkit','Fetch',false);
        toast(true, 'Data has been fetched');
      }else{
        loader('#checkit','Fetch',false);
        toast(false, returned.msg);
      }
    }
  });
});
// AllPosts = Settings
  $('h1#blockonhover').mouseenter(function () {
    var main = $(this).attr('x-data');
    $('div[xs-data="'+main+'"]').attr('onclick','');
  });
  $('h1#blockonhover').mouseleave(function () {
    var main = $(this).attr('x-data');
    var id = $('div[xs-data="'+main+'"]').attr('post-id');
    var string = "editpost("+id+")";
    $('div[xs-data="'+main+'"]').attr('onclick',string);
  });
  $('span>a#dpost').mouseenter(function () {
    var main = $(this).attr('x-data');
    $('div[xs-data="'+main+'"]').attr('onclick','');
  });
  $('span>a#dpost').mouseleave(function () {
    var main = $(this).attr('x-data');
    var id = $('div[xs-data="'+main+'"]').attr('post-id');
    var string = "editpost("+id+")";
    $('div[xs-data="'+main+'"]').attr('onclick',string);
  });