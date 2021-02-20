var url = window.location.origin + '/';
var aurl = window.location.href;
$('.chips').chips();
$('.modal').modal();
$('#table_id').DataTable();
$('.materialboxed').materialbox();
// add active class to sidenav
$('a#nvlinks').each(function(){
  var href = $(this).attr('href');
  if(href == aurl){
    $(this).addClass('active');
    $(this).parent().parent().parent().parent().addClass('active');
  }
});
// Check All posts
var clicked = false;
$("#checkall").on("click", function() {
  $("input#paction").prop("checked", !clicked);
  clicked = !clicked;
  $('#pac').toggleClass('none');
});

$('nav li a').filter(function(){
  return this.href === location.href;
}).addClass('active');

function loader(action){
  if(action==true){
    $('.loading').show();
    // $('.sidenav-overlay').show();
  }else{
    $('.loading').hide();
    $('.sidenav-overlay').hide();
  }
}
// Ajax Function
function callAjax(data,urle,handleData) {
  return $.ajax({
    url : url+'Welcome/'+urle,
    method: 'POST',
    data : data,
    success : function (rdata) {
      handleData(rdata);
    }
  });
}

// AJAX Image Upload Function
function UploadImage(data,urle,handleData) {
  $.ajax({
    url : url+'Welcome/'+urle,
    method: 'POST',
    data : data,
    success : function (rdata) {
      handleData(rdata);
    }
  });
}
// Toast Function
function toast(msg){
  M.toast({html: msg});
}

// Preview Featured Image
$('#img').change(function () {
  var imge = URL.createObjectURL($(this)[0].files[0]);
  $('#prevImage').attr('src',imge);
});
$('#imgee').change(function () {
  var imge = URL.createObjectURL($(this)[0].files[0]);
  $('#prevImage').attr('src',imge);
});
// Publish Post
$('#Publish').click(function (e) {
  loader(true);
  var cats = [];
  var workWith = [];
  var hash = [];
  var chips = M.Chips.getInstance($('.chips')).chipsData;
	$.each($("#category input:checked"), function(){
		cats.push($(this).val());
	});
  $.each($('#workWith input:checked'), function() {
    workWith.push($(this).val());
  });
  $.each(chips, function(key, value) {
    hash.push(value.tag);
  })
  if (hash == '') {
    hash = '';
  }
  if (cats == '') {
    cats = '';
  }
  var title = $('#title').val();
  var about = $('#about').val();
  var mTitle = $('#mTitle').val();
  var mDesc = $('#mDesc').val();
  var mTags = $('#mTags').val();
  var ziplink = $('#d_link span').text();
  e.preventDefault();
	var data = new FormData();
	data.append('file', $('#img')[0].files[0]);
  data.append('about',about);
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
        loader(false);
        toast('Post Published <a target="_blank" href="'+returned.link+'" class="btn-flat toast-action">View Post</a>');
      }else{
        toast(returned.msg);
        loader(false);
      }
    }
  });
});
$('#qPublish').click(function () {
  loader(true);
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
  var about = $('#about').val();
  var mTitle = $('#mTitle').val();
  var mDesc = $('#mDesc').val();
  var post_clink = $('#linkww').val();
  var mTags = $('#mTags').val();
  var ziplink = $('#d_link span').text();
  var featuredImage = $('#prevImage').attr('src');
  var action = 'post'
  $.ajax({
    url : url+'Welcome/qpublish',
    method: 'POST',
    data : {post_clink:post_clink,about:about,action:action,title:title,mTitle:mTitle,mDesc:mDesc,mTags:mTags,cats:cats,tags:tags,workWith:workWith,ziplink:ziplink,featuredImage:featuredImage},
    success : function (rdata) {
      returned =  JSON.parse(rdata)
      if(returned.action == true){
        loader(false);
        toast('Post Published <a target="_blank" href="'+returned.link+'" class="btn-flat toast-action">View Post</a>');
      }else{
        toast(returned.msg);
        loader(false);
      }
    }
  });
});
// Publish Zip Url link
$(document).ready(function () {
    $('#uploadform').submit(function (e) {
         var progress = $('.progress-bar');
         var progressCon = $('#progress');
         $('#uploadimage2').attr('src', url + 'assets/loading.gif');
        e.preventDefault();
        if ($('#uploadimage_src').val() == '') {
            alert('Please selet file');
            return;
        }
        $.ajax({
            type: "POST",
            url: url+'Welcome/uploadZip',
            data: new FormData(uploadform),
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: () => {
                 console.log('file processing');
                 $(progressCon).slideDown();
            },
            xhr: function() {
             var xhr = new window.XMLHttpRequest();
             xhr.upload.addEventListener("progress", function(evt) {
                 if (evt.lengthComputable) {
                     var percentComplete = (evt.loaded / evt.total) * 100;
                     console.log(percentComplete);
                     //Do something with upload progress here
                     $(progress).attr("aria-valuenow", percentComplete.toFixed(0));
                     $(progress).width(percentComplete.toFixed(0)+'%');
                     $(progress).text('Uploading ('+percentComplete.toFixed(2)+'%)');
                 }
             }, false);
             return xhr;
             },
            success: function (response) {
                $(progress).text('Uploaded (100%)');
                $(progress).addClass('bg-success');
                $('#uploadimage2').attr('src', url + 'assets/loading.gif');
                setTimeout(() => {
                    $(progressCon).fadeOut(() => {
                     $(progress).removeClass('bg-success');
                     $(progress).addClass('bg-primary');
                     $(progress).attr("aria-valuenow", '0');
                     $(progress).width('0%');
                     $(progress).text('Uploading (0%)');
                     $('#uploadimage2').attr('src', url + 'assets/uploadicon.png');
                    });
                }, 1000);
                img =  JSON.parse(response)
                if(img.action == true){
                  $('#d_link span').text(img.path);
                  toast('file uploaded successfully');
                  $('#modal1').modal('close');
                }else{
                  toast(img.msg);
                }
            }
        });
    });
});
$(document).ready(function () {
    $('#changezip').submit(function (e) {
         var progress = $('.progress-bar');
         var progressCon = $('#progress');
         $('#uploadimage2').attr('src', url + 'assets/loading.gif');
        e.preventDefault();
        if ($('#uploadimage_src').val() == '') {
            alert('Please selet file');
            return;
        }
        var zip = $('#dataup').attr('zip');
        var id = $('#dataup').attr('did');
        $.ajax({
            type: "POST",
            url: url+'Welcome/changezip?id='+id+'&zip='+zip,
            data: new FormData(changezip),
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: () => {
                 console.log('file processing');
                 $(progressCon).slideDown();
            },
            xhr: function() {
             var xhr = new window.XMLHttpRequest();
             xhr.upload.addEventListener("progress", function(evt) {
                 if (evt.lengthComputable) {
                     var percentComplete = (evt.loaded / evt.total) * 100;
                     console.log(percentComplete);
                     //Do something with upload progress here
                     $(progress).attr("aria-valuenow", percentComplete.toFixed(0));
                     $(progress).width(percentComplete.toFixed(0)+'%');
                     $(progress).text('Uploading ('+percentComplete.toFixed(2)+'%)');
                 }
             }, false);
             return xhr;
             },
            success: function (response) {
                $(progress).text('Uploaded (100%)');
                $(progress).addClass('bg-success');
                $('#uploadimage2').attr('src', url + 'assets/loading.gif');
                setTimeout(() => {
                    $(progressCon).fadeOut(() => {
                     $(progress).removeClass('bg-success');
                     $(progress).addClass('bg-primary');
                     $(progress).attr("aria-valuenow", '0');
                     $(progress).width('0%');
                     $(progress).text('Uploading (0%)');
                     $('#uploadimage2').attr('src', url + 'assets/uploadicon.png');
                    });
                }, 1000);
                img =  JSON.parse(response)
                if(img.action == true){
                  $('#d_link span').text(img.path);
                  toast('file uploaded successfully');
                  $('#modal1').modal('close');
                }else{
                  toast(img.msg);
                }
            }
        });
    });
});

// Extra
$('#PublishE').click(function () {
  var imgurl = $('#prevImage').attr('src');
  var title = 'new';
  var data = {img:imgurl,title:title};
  callAjax(data,'test', function handleData(output) {
    toast(output);
  });
});

// Delete Bulk posts
$('button#pac').click(function() {
  loader(true);
  $.each($("input#paction:checked"), function(){
    var id = $(this).val();
    var data = {id:id};
    var url = "Edit?action=post&task=delete";
    callAjax(data,url, function handleData(output) {
      returned = JSON.parse(output);
      if(returned.action == true){
        loader(false);
        toast('Post Deleted Successfully');
      }else{
        toast(returned.msg);
        loader(false);
      }
    });
  });
  location.reload();
});

$('a#dpost').click(function () {
  var id = $(this).attr('did');
  console.log(id);
  var data = {id:id};
  var url = "Edit?action=post&task=delete";
  callAjax(data,url, function handleData(output) {
    returned = JSON.parse(output);
    if(returned.action == true){
      loader(false);
      toast('Post Deleted Successfully');
      console.log(aurl);
      location.replace(aurl);
    }else{
      toast(returned.msg);
      loader(false);
    }
  });
});

// Update Post
$('#Update').click(function () {
  loader(true);
  var cats = [];
  var workWith = [];
  var hash = [];
  var chips = M.Chips.getInstance($('.chips')).chipsData;
  console.log(chips);
	$.each($("#category input:checked"), function(){
		cats.push($(this).val());
	});
  $.each($('#workWith input:checked'), function() {
    workWith.push($(this).val());
  });
  $.each(chips, function(key, value) {
    hash.push(value.tag);
  });
  console.log(hash);
  if (hash == '') {
    hash = '';
  }
  if (cats == '') {
    cats = '';
  }
  if (workWith == '') {
    workWith = '';
  }
  var id = $(this).attr('did');
  var title = $('#title').val();
  var about = $('#about').val();
  var mTitle = $('#mTitle').val();
  var mDesc = $('#mDesc').val();
  var mTags = $('#mTags').val();
  var ziplink = $('#d_link span').text();
  $.ajax({
    url : url+'admin-panel/edit?action=post&task=update',
    method: 'POST',
    data : {id:id,hash:hash,workWith:workWith,cats:cats,about:about,title:title,mTitle:mTitle,mDesc:mDesc,mTags:mTags,ziplink:ziplink},
    success : function (rdata) {
      returned =  JSON.parse(rdata)
      if(returned.action == true){
        loader(false);
        toast('Post Updated <a target="_blank" href="'+returned.link+'" class="btn-flat toast-action">View Post</a>');
      }else{
        toast(returned.msg);
        loader(false);
      }
    }
  });
});
$('#imgee').change(function (e) {
  loader(true);
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
        loader(false);
        toast('Feature Image Updated');
      }else{
        toast(returned.msg);
        loader(false);
      }
    }
  });
});



// check id post dublicate
$('a#checkit').click(function () {
  var link = $('input#linkww').val();
  var ww = "http://localhost/git/PNGhill/application/Welcome/qp?link=" + link ;
  ln = '';
  data = {ln:ln};
  callAjax(data,ww, function handleData(output) {
    returned = JSON.parse(output);
    if(returned.action == true){
      loader(false);
      toast('Post Deleted Successfully');
      location.reload();
    }else{
      toast(returned.msg);
      loader(false);
    }
  });
});

$('#imgeww').change(function () {
  var img = $(this).val();
  $('#prevImage').attr('src',img)
})

$('a#checkit').click(function (e) {
  loader(true);
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
        loader(false);
      }else{
        toast(returned.msg);
        loader(false);
      }
    }
  });
});





