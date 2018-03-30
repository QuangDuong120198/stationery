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
validateCookie();
total();
displayCart();
function total(){
    if(Cookies.getJSON("cart")){
        var _cookie_ = Cookies.getJSON("cart");
        var _cookie_len = _cookie_.length;
        var total = 0;
        for(var i=0 ; i<_cookie_len ; i++){
            total += parseInt(_cookie_[i].amount) * parseInt(_cookie_[i].price)*(100-_cookie_[i].discount)/100;
        }
        if(total > 0){
            document.getElementById("shopping-list").getElementsByClassName("pay")[0].getElementsByTagName("div")[0].innerHTML = "<button type=\"button\" class=\"btn btn-default back\" data-dismiss=\"modal\"><i class=\"fa fa-chevron-left\"></i>&nbsp;Tiếp tục mua hàng</button><a href=\"<?php echo base_url()."products/pay"; ?>\" class=\"btn btn-primary\" id=\"pay\">Thanh toán</button>";
            document.getElementById("shopping-list").getElementsByClassName("total")[0].innerHTML = "Tổng:  "+parseInt(total).format(0,3)+ " Đ";
        }else{
            document.getElementById("shopping-list").getElementsByClassName("pay")[0].getElementsByTagName("div")[0].innerHTML = "";
            document.getElementById("shopping-list").getElementsByClassName("total")[0].innerHTML = "";
        }
    }
}
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
            if(window.history.pushState){
                window.history.pushState(null,null,redirect+category_id+page);
            }
        },
        error: function(){
            window.location.href = redirect + category_id + page;
        }
    });
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
