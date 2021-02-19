<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeIgniter Contact Form Example</title>
    <!--load bootstrap css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">

    <style>
        .container{
            padding:5%;
        }
        .modal .modal-body{
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 57px 0px 57px 0px;
        }
        .modal .modal-title{
            text-align:center;
        }
        .custom-file-control{
            overflow:hidden;
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            z-index: 5;
            height: 2.5rem;
            padding: .5rem 1rem;
            line-height: 1.5;
            color: #555;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: .25rem;
        }
        .custom-file-control::before{
            content:"Browse";
            position: absolute;
            top: -1px;
            right: -1px;
            bottom: -1px;
            z-index: 6;
            display: block;
            height: 2.5rem;
            padding: .5rem 1rem;
            line-height: 1.5;
            color: #555;
            background-color: #eee;
            border: 1px solid #ddd;
            border-radius: 0 .25rem .25rem 0;
        }
        .custom-file-control::after{
            content:attr(data-attr);
        }
        .flex-center-cont{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        #img-prev-cont{
            text-align:center;
            width:100%;
            height:150px;
            overflow: hidden;
            background-color:#ccc;
            border: 2px dashed #a6afa7;
            line-height: 150px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>var base_url = "<?=base_url();?>";</script>
</head>
<body>
    <div class="container">
        <div class="row flex-items-xs-center flex-center-cont">
            <div class="col-xs-4">
                <form action="#" id="upload-form">
                    <div id="img-prev-cont" class="form-group">
                        <img style="width:400px;height:auto" src="https://placehold.it/190x150" alt="Image Preview" id="img-prev" class="img-fluid">
                    </div>
                    <div class="form-group">
                        <label class="custom-file col-xs-12">
                            <input type="file" id="file" class="custom-file-input" name="myfile" placeholder="Choose file">
                            <span class="custom-file-control" data-attr="Choose file..."></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <select name="watermark_type" class="form-control">
                            <option value="text">Text</option>
                            <option value="overlay">Image Overlay</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="submit" type="submit" class="btn btn-lg btn-outline-success btn-block" value="Submit" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://www.atlasestateagents.co.uk/javascript/tether.min.js"></script><!-- Tether for Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $('input[name="myfile"]').on('change',function(e){
                var filename = document.getElementById("file").files[0].name;
                $(this).next().attr('data-attr',filename);
                $('input[name="myfile"]').closest('.form-group.has-error').removeClass('has-error').find('span.text-danger').remove();
                readURL(this);
            })
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var file = input.files[0];
                    var fileType = file["type"];
                    var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        if ($.inArray(fileType, ValidImageTypes) > 0) {
                            $('#img-prev').attr('src', e.target.result);
                        }
                        else{
                        }
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#upload-form').on('submit',function(e){
                e.preventDefault();
                var $btn = $(this).find('input[type="submit"]');
                var formdata = new FormData(this);
                $.ajax({
                    url: base_url+'upload/do_upload',
                    type: 'POST',
                    dataType: 'JSON',
                    data:formdata,
                    cache:false,
                    contentType: false,
                    processData: false,
                    beforeSend:function(){
                        $btn.button('loading');
                    },
                    success:function(response){
                        $('.form-group.has-error').removeClass('has-error').find('span.text-danger').remove();
                        switch(response.status){
                            case 'form-incomplete':
                                $.each(response.errors, function(key,val){
                                    if(val.error!=''){
                                        $(val.field).closest('.form-group').addClass('has-error').append(val.error);
                                    }
                                })
                            break;
                            case 'success':
                                // window.location.reload(true);
                                var data = 
                                    "<div class='col-xs'>"+
                                        "<div class='text-center'>Watermarked Image</div>"+
                                        "<img style='width:400px' src='"+base_url+'uploads/files/img/'+response.data.file_name+"'>"+
                                        "<table class='table'>"+
                                             "<thead class='thead-inverse'>"+
                                                "<tr>"+
                                                    "<th>"+
                                                        "Key"+
                                                    "</th>"+
                                                    "<th>"+
                                                        "Value"+
                                                    "</th>"+
                                                "</tr>"+
                                             "</thead>";
                                $.each(response.data,function(key,val){
                                    data+=
                                    "<tr>"+
                                        "<td>"+
                                            key+
                                        "</td>"+
                                        "<td>"+
                                            val+
                                        "</td>"+
                                    "<tr>";
                                })
                                data+="</table></div>";
                                $(".flex-center-cont").append(data);
                            break;
                            case 'error':
                                $('input[name="myfile"]').closest('.form-group').addClass('has-error').append("<span class='text-danger'>"+response.errors+"</span>");
                                console.log(response.message);
                            break;
                        }
                    },
                    error: function(jqXHR,textStatus,error){
                        console.log('Unable to send request!');
                    }
                }).always(function(){
                    $btn.button('reset');
                });
            })
        })
    </script>
</body>
</html>