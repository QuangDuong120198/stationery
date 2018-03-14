<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<?php echo $headtag; ?>
<style>
.sidebar{
    position:fixed;
    top:0;
    left:0;
    height:100%;
    overflow:auto;
    width:220px;
    background-color:#393939;
    color:#f5f5f0;
    z-index:100;
    transition:0.4s;
    word-wrap:break-word;
}
.main{
    margin-left:220px;
    transition:0.4s;
}
@media(max-width:992px){
    .sidebar{
        left:-220px;
    }
    .main{
        margin-left:0;
    }
}
</style>
</head>
<body>
<div class="sidebar">
    
</div>
<!-- divider -->
<div class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxs-12" style="background-color:#cccccc;">
                <div style="padding:5px 15px;">
                    <button id="sidebar-toggle" class="btn btn-default"><i class="fa fa-bars"></i></button>
                    <div style="display:inline;float:right;" class="dropdown">
                        <button type="button" id="dropdownMenu2" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                            <li><a href="javascript:void(0)">Item 1</a></li>
                            <li><a href="javascript:void(0)">Item 2</a></li>
                            <li><a href="javascript:void(0)">Item 3</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:void(0)">Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
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
            $(".sidebar").css({
                "left": "-220px"
            });
            $(".main").css({
                "margin-left": "0px"
            });
        }
        else{
            $(".sidebar").css({
                "left": "0px"
            });
            $(".main").css({
                "margin-left":"220px"
            });
        }
    });
    $(window).click(function(e){
        if(!$(e.target).closest(".sidebar").length)
        {
            if($(e.target).is("#sidebar-toggle"))
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
    });
});
</script>
</html>
