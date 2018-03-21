<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<?php echo $headtag; ?>
</head>
<body style="padding-right:0!important">
<?php echo $cart; ?>
<div class="container-fluid">

<?php echo $banner_menu; ?>

<div class="row">
<div class="col-xxs-12">
<div class="container">
    <?php echo $slide; ?>
    <div class="row">
        <div class="col-xxs-12">
            <div class="all-products">
                <div class="panel mypanel">
                    <div class="panel-header"><i class="fa fa-gift"></i>&nbsp;Sản phẩm</div>
                        <div class="panel-body">
<!-- START HERE -->
<?php echo $display_products; ?>
<!-- END HERE -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php echo $footer; ?>
</div>

</div>
</body>
<script>
    if($(window).width()>=768){
        $(".catgory-item").show();
    }else{
        $(".category-item").hide();
    }
    $("body").resize(function(){
        $(".google").attr("src","https://www.google.com/maps/embed/v1/place?q=21.009265%2C%20105.824699&center=21.009265%2C%20105.824699&zoom=15&key=AIzaSyCv9KaAtbFQzS6sU0e4KrvdquCsklmm1Uc");
        if($(window).width()>=768){
            $(".catgory-item").show();
        }else{
            $(".category-item").hide();
        }
    });
    window.onclick = function(e){
        if(e.target === document.getElementById("btn-search") || e.target.parentNode === document.getElementById("btn-search") || e.target.parentNode.parentNode === document.getElementById("btn-search")){
            if(document.getElementsByClassName("search-xs")[0].style.display !== "none"){
                document.getElementsByClassName("search-xs")[0].style.display = "none";
            }else{
                document.getElementsByClassName("search-xs")[0].style.display = "block";
            }
        }else if(e.target !== document.getElementsByClassName("search-xs")[0] && e.target.parentNode !== document.getElementsByClassName("search-xs")[0] && e.target.parentNode.parentNode !== document.getElementsByClassName("search-xs")[0] && e.target.parentNode.parentNode.parentNode !== document.getElementsByClassName("search-xs")[0]){
            document.getElementsByClassName("search-xs")[0].style.display = "none";
        }else if(e.target === document.getElementsByClassName("back")[0] || e.target.parentNode === document.getElementsByClassName("back")[0] ||e.target.parentNode.parentNode === document.getElementsByClassName("back")[0]){
            document.getElementsByClassName("back")[0].style.display = "none";
        }
    };
    $("#category-toggle").click(function(){
        if($(window).width()<992){
            $(".category-item").toggle();
        }else{
            $(".category-item").show();
        }
    });
</script>
</html>
