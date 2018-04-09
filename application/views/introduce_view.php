<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<?php echo $headtag; ?>
<style>
.introduce {margin: 15px;}
.introduce h1, .introduce h2, .introduce h3, .introduce h4, .introduce h5, .introduce h6 {text-align: center;}
.introduce p {text-indent: 20px;}
</style>
</head>
<body style="padding-right:0!important">
<?php echo $browser; ?>
<?php echo $cart; ?>
<div class="container-fluid">

<?php echo ($banner_menu) ? $banner_menu : ''; ?>

<div class="row">
<div class="col-xxs-12">
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 col-xxs-12">
            <div class="introduce">
                <?php echo html_entity_decode($constants['introduce']); ?>
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
validateCookie();total();displayCart();
function total(){
    if(Cookies.getJSON("cart")){
        var _cookie_ = Cookies.getJSON("cart");
        var _cookie_len = _cookie_.length;
        var total = 0;
        for(var i=0 ; i<_cookie_len ; i++){
            total += parseInt(_cookie_[i].amount) * parseInt(_cookie_[i].price)*(100-_cookie_[i].discount)/100;
        }
        if(total > 0){
            if(document.getElementById("shopping-list").getElementsByClassName("pay").length){
                document.getElementById("shopping-list").getElementsByClassName("pay")[0].getElementsByTagName("div")[0].innerHTML = "<button type=\"button\" class=\"btn btn-default back\" data-dismiss=\"modal\"><i class=\"fa fa-chevron-left\"></i>&nbsp;Tiếp tục mua hàng</button><a href=\"/home/pay\" class=\"btn btn-primary\" id=\"pay\">Thanh toán</button>";
            }
            document.getElementById("shopping-list").getElementsByClassName("total")[0].innerHTML = "Tổng:  "+parseInt(total).format(0,3)+ " Đ";
        }else{
            if(document.getElementById("shopping-list").getElementsByClassName("pay").length){
                document.getElementById("shopping-list").getElementsByClassName("pay")[0].getElementsByTagName("div")[0].innerHTML = "";
            }
            document.getElementById("shopping-list").getElementsByClassName("total")[0].innerHTML = "";
        }
    }
}
$(function(){
    $("[data-target='#shopping-list']").click(function(){
        displayCart();
        total();
    });
    $(window).click(function(e){
        if($(e.target).is("#btn-search") || $(e.target).closest("#btn-search").length){
            $(".search-xs").toggle();
        }else if(!$(e.target).closest(".search-xs").length){
            $(".search-xs").hide();
        }else if($(e.target).closest(".back").length){
            $(".search-xs").hide();
        }
    });
    document.body.onresize = function(){
        var src = document.getElementsByClassName("google")[0].getElementsByTagName("iframe")[0].src;
        document.getElementsByClassName("google")[0].getElementsByTagName("iframe")[0].src = src;
    };
});
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692782-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-116692782-1');
</script>
</html>
