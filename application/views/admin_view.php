<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<?php echo $headtag; ?>
<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/4.10.1/firebase-storage.js"></script>
<script>
var config = {
    apiKey: "AIzaSyCA1ZKoTSN4GidqkKffosreoU27KndTgJo",
    authDomain: "newfirebase-e8f02.firebaseapp.com",
    databaseURL: "https://newfirebase-e8f02.firebaseio.com",
    storageBucket: "newdatabase-e8f02.appspot.com"
};
firebase.initializeApp(config);
</script>
<style>
.sidebar{position:fixed;top:0;left:0;height:100%;overflow:auto;width:220px;background-color:#393939;color:#f5f5f0;z-index:100;transition:0.4s;word-wrap:break-word;box-shadow:0 0 5px #000000;}
.sidebar > a{display:block;padding:8px 10px;color:#f5f5f0!important;position:relative;padding-right:30px;}
.sidebar a:focus, .sidebar a:hover{text-decoration: none;}
.sidebar-collapse{position:absolute;z-index:101;top:0;right:8px;display:none;}
.sub-menu a{display:block;color:#000000;background-color:blue;padding:8px 15px 8px 30px;background-color:#f5f5f0;}
.sub-menu a:hover{background-color:#0073aa;color:#f5f5f0;}
.main{margin-left:220px;transition:0.4s;}
@media(max-width:992px){.sidebar{left:-220px;}.main{margin-left:0;}.sidebar-collapse{display:inline;}}
</style>
</head>
<body>
<div class="sidebar">
    <div style="position:relative;padding:0 8px;">
        <span class="sidebar-collapse"><i style="font-weight:bold;font-size:150%;cursor:pointer;">&times;</i></span>
    </div>
    <div style="text-align:center;font-weight:bold;border-bottom:1px solid #cccccc;padding-bottom:15px;padding-left:8px;padding-right:8px;">
        <img src="<?php echo $constants['logo']; ?>" style="width:120px;" /><br />Văn phòng phẩm Xuân Thủy
    </div>
    <a href="javascript:void(0)" data-toggle="collapse" data-target="#item1" aria-expanded="true" aria-controls="item1">
        <i class="fa fa-home"></i>&nbsp;Trang chủ
        <span style="position:absolute;z-index:101;right:5px;top:5px;"><i class="fa fa-chevron-down"></i></span>
    </a>
    <div class="collapse" id="item1">
        <div class="sub-menu">
            <a href="javascript:void(0)">&#9675;&nbsp;Item 1</a>
        </div>
        <div class="sub-menu">
            <a href="javascript:void(0)">&#9675;&nbsp;Item 2</a>
        </div>
        <div class="sub-menu">
            <a href="javascript:void(0)">&#9675;&nbsp;Item 3</a>
        </div>
        <div class="sub-menu">
            <a href="javascript:void(0)">&#9675;&nbsp;Item 4</a>
        </div>
    </div>
    <a href="javascript:void(0)" data-toggle="collapse" data-target="#item2" aria-expanded="true" aria-controls="item2">
        <i class="fa fa-gift"></i>&nbsp;Sản phẩm
        <span style="position:absolute;z-index:101;right:5px;top:5px;"><i class="fa fa-chevron-down"></i></span>
    </a>
    <div class="collapse" id="item2">
        <div class="sub-menu">
            <a href="javascript:void(0)">&#9675;&nbsp;Danh sách</a>
        </div>
        <div class="sub-menu">
            <a href="javascript:void(0)">&#9675;&nbsp;Thêm</a>
        </div>
        <div class="sub-menu">
            <a href="javascript:void(0)">&#9675;&nbsp;Sửa</a>
        </div>
        <div class="sub-menu">
            <a href="javascript:void(0)">&#9675;&nbsp;Xóa</a>
        </div>
    </div>
    <a href="javascript:void(0)" data-toggle="collapse" data-target="#item3" aria-expanded="true" aria-controls="item3">
        <i class="fa fa-pencil-square-o"></i>&nbsp;Nội dung
        <span style="position:absolute;z-index:101;right:5px;top:5px;"><i class="fa fa-chevron-down"></i></span>
    </a>
    <div class="collapse" id="item3">
        <div class="sub-menu">
            <a href="javascript:void(0)">&#9675;&nbsp;Logo</a>
        </div>
        <div class="sub-menu">
            <a href="javascript:void(0)">&#9675;&nbsp;Slide</a>
        </div>
        <div class="sub-menu">
            <a href="javascript:void(0)">&#9675;&nbsp;Thông tin</a>
        </div>
    </div>
</div>
<!-- divider -->
<div class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxs-12" style="background-color:#cccccc;">
                <div style="padding:5px 15px;">
                    <button id="sidebar-toggle" class="btn btn-default"><i class="fa fa-bars"></i></button>
                    <div style="display:inline;float:right;" class="dropdown">
                        <button type="button" id="dropdownMenu2" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                            <li><a href="javascript:void(0)">Item 1</a></li>
                            <li><a href="javascript:void(0)">Item 2</a></li>
                            <li><a href="javascript:void(0)">Item 3</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:void(0)" style="font-weight:bold;"><i class="fa fa-sign-out"></i>&nbsp;Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xxs-12">
            </div>
        </div>
    </div>
</div>
</body>
<script>
$(document).ready(function(){
    $(window, "body").resize(function(){
        if($(window).width()<=992)
        {
            $(".sidebar").css({"left": "-220px"});
            $(".main").css({"margin-left": "0px"});
            $(".sidebar-collapse").show();
        }
        else
        {
            $(".sidebar").css({"left": "0px"});
            $(".main").css({"margin-left":"220px"});
            $(".sidebar-collapse").hide();
        }
    });
    $(window).click(function(e){
        if(!$(e.target).closest(".sidebar").length)
        {
            if($(e.target).closest("#sidebar-toggle").length)
            {
                if($(window).width()<=992)
                {
                    if($(".sidebar").css("left")===0)
                    {
                        $(".sidebar").css({"left":"-220px"});
                    }
                    else
                    {
                        $(".sidebar").css({"left":"0px"});
                    }
                }
            }
            else
            {
                if($(window).width()<=992)
                {
                    if($(".sidebar").css("left")==="0px")
                    {
                        $(".sidebar").css({"left":"-220px"});
                    }
                }
            }
        }
        else if($(e.target).closest(".sidebar-collapse").length)
        {
            if($(window).width()<=992)
            {
                if($(".sidebar").css("left")==="0px")
                {
                    $(".sidebar").css({"left":"-220px"});
                }
            }
        }
    });
});
</script>
</html>
