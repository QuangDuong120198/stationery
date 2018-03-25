<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<?php echo $headtag; ?>
</head>
<body style="padding-right:0!important">
<?php echo $cart; ?>
<div class="container-fluid">

<?php echo ($banner_menu) ? $banner_menu : ''; ?>

<div class="row">
<div class="col-xxs-12">
<div class="container">
    <?php echo ($slide) ? $slide : ''; ?>
    <?php echo ($best_seller) ? $best_seller : ''; ?>
    <div class="row">
        <div class="col-xxs-12">
            <div class="all-products">
                <div class="panel mypanel">
                    <div class="panel-header"><i class="fa fa-gift"></i>&nbsp;<?php echo $product_type; ?></div>
                    <div class="panel-body" id="loadProduct">
<?php echo $display_products; ?>
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
function loadPage(page = 1, url = '', redirect = '', category_id = ''){
    $.ajax({
        url: url,
        type: "GET",
        dateType: "html",
        data:{
            to_page: page,
            category_id: "<?php echo ($category_id)? $category_id : ""; ?>"
        },
        timeout: 10000,
        beforeSend: function(){
            $('.all-products .discount, .all-products .product-name, .all-products .price').addClass('placeholder-loading').css('color','transparent');
            $('html, body').animate({ scrollTop: $(".all-products").offset().top }, 500);
        },
        success: function(e){
            $("#loadProduct").html(JSON.parse(e).products_view);
        },
        error: function(){
            window.location.href = redirect + page;
        }
    });
}
function total(){
    if(Cookies.getJSON("cart")){
        var _cookie_ = Cookies.getJSON("cart");
        var _cookie_len = _cookie_.length;
        var total = 0;
        for(var i=0 ; i<_cookie_len ; i++){
            total += parseInt(_cookie_[i].amount) * parseInt(_cookie_[i].price)*(100-_cookie_[i].discount)/100;
        }
        if(total > 0){
            document.getElementById("shopping-list").getElementsByClassName("total")[0].innerHTML = "Tổng:  "+parseInt(total).format(0,3)+ " Đ";
        }else{
            document.getElementById("shopping-list").getElementsByClassName("total")[0].innerHTML = "";
        }
    }
}
function displayCart(){
    if(Cookies.get("cart") && Cookies.getJSON("cart").length>0){
        var _cookie_ = Cookies.getJSON("cart");
        var _cookie_len = _cookie_.length;
        $(".inner-cart").html("");
        for(var i=0 ; i<_cookie_len ; i++){
            var str = "<div class=\"row cart-item\" data-product-id=\""+_cookie_[i].id+"\" data-product-price=\""+_cookie_[i].price+"\" data-product-discount=\""+_cookie_[i].discount+"\">";
            str += "<div class=\"col-lg-8 col-md-8 col-sm-7 col-xs-6 col-xxs-12 text-center\">";
            str += "<img src=\""+_cookie_[i].image+"\" alt=\""+_cookie_[i].name+"\">";
            str += "</div>";
            str += "<div class=\"col-lg-4 col-md-4 col-sm-5 col-xs-6 col-xxs-12 center-xxs\">";
            str += "<h4><strong>"+_cookie_[i].name+"</strong></h4>";
            str += "<div><i class=\"fa fa-tag\"></i>&nbsp;&nbsp;<span class=\"price\">"+parseInt(_cookie_[i].price*(100-_cookie_[i].discount)/100).format(0,3)+"</span> Đ</div>";
            if(_cookie_[i].discount>0){
                str += "<div><small><del>"+parseInt(_cookie_[i].price).format(0,3)+" Đ</del></small></div>";
            }
            str += "<input class=\"amount\" type=\"number\" min=\"1\" value=\""+_cookie_[i].amount+"\" />";
            str += "<p><strong>Thành tiền: <span class=\"multiple\">"+(_cookie_[i].amount * _cookie_[i].price *(100-_cookie_[i].discount)/100).format(0,3)+"</span> Đ</strong></p>";
            str += "<p><button class=\"btn btn-danger remove-from-cart\"><i class=\"fa fa-times\"></i>&nbsp;&nbsp;Xóa khỏi giỏ hàng</button></p>";
            str += "</div>";
            str += "</div>";
            $(".inner-cart").append(str);
        }
        $(".amount").change(function(){
            if($(this).val()<=0 || $(this).val()===""){
                $(this).val(1);
            }
            var amount = parseInt($(this).val())>0 ? parseInt($(this).val()) : 1;
            var item = $(this).closest(".cart-item");
            var _cookie_ = Cookies.getJSON("cart");
            var _cookie_len = _cookie_.length;
            for(var i=0 ; i<_cookie_len ; i++){
                if(_cookie_[i].id === item.attr("data-product-id")){
                    _cookie_[i].amount = amount;
                    var price = parseInt(item.attr("data-product-price"))*(100 - parseInt(item.attr("data-product-discount")))/100;
                    item.find(".multiple").html((price * amount).format(0,3));
                }
            }
            Cookies.set("cart",JSON.stringify(_cookie_),{expires: 30,path: "/"});
            total();
        });
        $(".remove-from-cart").click(function(){
            var cur_item = $(this).closest(".cart-item");
            var id = cur_item.attr("data-product-id");
            var _cookie_ = Cookies.getJSON("cart");
            var _cookie_len = _cookie_.length;
            for(var i=0 ; i<_cookie_len ; i++){
                if(_cookie_[i].id === id){
                    _cookie_.splice(i,1);
                    cur_item.remove();
                    Cookies.set("cart",JSON.stringify(_cookie_),{expires: 30,path: "/"});
                    break;
                }
            }
            $(".products-in-cart").html(Cookies.getJSON("cart").length);
            total();
            if(Cookies.getJSON("cart").length===0){
                var message = "";
                message += "<h4 style=\"font-weight:bold;text-align:center;margin-top:30px;\">";
                message += "Giỏ hàng của bạn hiện đang trống.";
                message += "<div style=\"margin-top:15px;margin-bottom:30px;\"><button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\"><i class=\"fa fa-shopping-cart\"></i>&nbsp;&nbsp;Tiếp tục mua hàng</button></div>";
                message += "</h4>";
                $(".inner-cart").html(message);
            }
        });
    }else{
        var message = "";
        message += "<h4 style=\"font-weight:bold;text-align:center;margin-top:30px;\">";
        message += "Giỏ hàng của bạn hiện đang trống.";
        message += "<div style=\"margin-top:15px;margin-bottom:30px;\"><button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\"><i class=\"fa fa-shopping-cart\"></i>&nbsp;&nbsp;Tiếp tục mua hàng</button></div>";
        message += "</h4>";
        $(".inner-cart").html(message);
    }
}
$(function(){
    $(".inner-best-seller").slick({
        slidesToShow: 4,
        autoplay: true,
        autoplaySpeed: 5000,
        slidesToScroll: 4,
        centerMode: true,
        centerPadding: '15px',
        dots: true,
        dotsClass: "myClass",
        responsive: [
            {
                breakpoint: 1200,
                settings: { slidesToShow: 3, slidesToScroll: 3 }
            },
            {
                breakpoint: 992,
                settings: { slidesToShow: 2, slidesToShow: 2 }
            },
            {
                breakpoint: 480,
                settings: { slidesToShow: 1, slidesToScroll: 1 }
            }
        ]
    });
    $("[data-target='#best-seller']").click(function(){
        var index = parseInt($(this).attr("data-slide-index"));
        $("#inner-best-seller").carousel(index);
    });
    if($(window).width()>=768){
        if(document.getElementsByClassName("inner-category")[1].offsetTop){
            document.getElementsByClassName("inner-category")[1].style.display = "none";
        }else{
            document.getElementsByClassName("inner-category")[1].style.display = "block";
        }
    }else{
        document.getElementsByClassName("inner-category")[0].style.display = "none";
        document.getElementsByClassName("inner-category")[1].style.display = "none";
    }
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
        document.getElementsByClassName("google")[0].src = "https://www.google.com/maps/embed/v1/place?q=21.009265%2C%20105.824699&center=21.009265%2C%20105.824699&zoom=15&key=AIzaSyCv9KaAtbFQzS6sU0e4KrvdquCsklmm1Uc";
        if($(window).width()>=992){
            document.getElementsByClassName("inner-category")[0].style.display = "block";
            document.getElementsByClassName("inner-category")[1].style.display = "block";
        }else{
            document.getElementsByClassName("inner-category")[1].style.display = "none";
        }
    };
    document.getElementById("category-toggle").onclick = function(){
        if($(window).width()<992){
            $(".inner-category").toggle();
        }else{
            $(".inner-category").show();
        }
    };
});
</script>
</html>
