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
    <div class="modal" id="best-seller">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-dark">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-check"></i>&nbsp;Bán chạy</h4>
                </div>
                <div class="modal-body">
                    <div class="carousel" id="inner-best-seller">
                        <div class="carousel-inner" role="listbox" data-interval="false">
<?php $k=0; foreach($top as $row): ?>
                        <div class="item <?php echo $k==0? 'active' : ''; ?>" data-product-id="<?php echo $row['id']; ?>" data-product-price="<?php echo $row['price']; ?>" data-product-discount="<?php echo $row['discount']; ?>" data-product-name="<?php echo $row["name"]; ?>">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7 col-xxs-12">
                                        <div class="text-center">
                                            <img src="" alt="<?php echo $row['name']; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 col-xxs-12 center-xxs" style="padding-top:15px;">
                                        <h4><strong><?php echo $row['name']; ?></strong></h4>
                                <?php if($row['discount']>0): ?>
                                        <p>
                                            <div class="product-price"><i class="fa fa-usd"></i>&nbsp;&nbsp;<?php echo number_format($row['price']*(100-$row['discount'])/100); ?>&nbsp;Đ</div>
                                            <div><del><?php echo number_format($row['price']); ?>&nbsp;Đ</del></div>
                                        </p>
                                <?php else:?>
                                        <p class="product-price"><i class="fa fa-usd"></i>&nbsp;&nbsp;<?php echo number_format($row['price']); ?>&nbsp;Đ</p>
                                <?php endif; ?>
                                        <p class="product-style"><i class="fa fa-archive"></i>&nbsp;&nbsp;Cách đóng gói: <?php echo $row['style']; ?></p>
                                        <p class="product-unit"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Đơn vị: <?php echo $row['unit']; ?></p>
                                <?php if(!$row['status']): ?>
                                        <button class="btn btn-danger">Đã hết hàng</button>
                                <?php else: ?>
                                        <button class="btn btn-primary btn-cart"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Đặt mua</button>
                                        <p class="add-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Đã thêm vào giỏ hàng</p>
                                <?php endif; ?>
                                        <div class="product-type">
                                            <i class="fa fa-tags"></i>&nbsp;&nbsp;<a href="<?php echo base_url()."home/tag/".$row['type']['id']; ?>"><?php echo $row['type']['name']; ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php $k++; endforeach; ?>
                        </div>
                        <a class="left carousel-control custom" href="#inner-best-seller" role="button" data-slide="prev"><span class="fa fa-chevron-left" aria-hidden="true"></span></a>
                        <a class="right carousel-control custom" href="#inner-best-seller" role="button" data-slide="next"><span class="fa fa-chevron-right" aria-hidden="true"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxs-12">
            <div class="best-seller">
                <div class="panel mypanel">
                    <div class="panel-header"><i class="fa fa-check-circle-o"></i>&nbsp;Bán chạy</div>
                    <div class="panel-body">
                        <div class="inner-best-seller list">
<?php $l=0; foreach($top as $row):?>
                            <div class="outer-item">
                                <div class="list-item" data-product-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#best-seller" data-slide-index="<?php echo $l; ?>">
                                    <div class="img-thumbnail" title="<?php echo $row['name']; ?>" style="background-image:url(<?php echo $row['image']; ?>);">
<?php if($row['discount']>0):?>
                                        <span class="discount"><?php echo -$row['discount'].'%'; ?></span>
<?php endif; ?>
                                    </div>
                                    <a href="javascript:void(0)" class="product-name"><strong title="<?php echo $row['name']?>"><?php echo $row['name']?></strong></a>
                                    <p class="price"><b><?php echo $row['price'].' Đ'; ?></b></p>
                                </div>
                            </div>
<?php $l++; endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxs-12">
            <div class="all-products">
                <div class="panel mypanel">
                    <div class="panel-header"><i class="fa fa-gift"></i>&nbsp;Sản phẩm</div>
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
function total(){
    var _cookie_ = Cookies.getJSON("cart");
    var _cookie_len = _cookie_.length;
    var total = 0;
    for(var i=0 ; i<_cookie_len ; i++){
        total += parseInt(_cookie_[i].amount) * _cookie_[i].price;
    }
    if(total > 0){
        document.getElementById("shopping-list").getElementsByClassName("total")[0].innerHTML = "Tổng:  "+total+ " Đ";
    }else{
        document.getElementById("shopping-list").getElementsByClassName("total")[0].innerHTML = "";
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
            str += "<div><i class=\"fa fa-tag\"></i>&nbsp;&nbsp;<span class=\"price\">"+_cookie_[i].price*(100-_cookie_[i].discount)/100+"</span> Đ</div>";
            if(_cookie_[i].discount>0){
                str += "<div><small><del>"+_cookie_[i].price+" Đ</del></small></div>";
            }
            str += "<input class=\"amount\" type=\"number\" min=\"1\" value=\""+_cookie_[i].amount+"\" />";
            str += "<p><strong>Thành tiền: <span class=\"multiple\">"+_cookie_[i].amount * _cookie_[i].price *(100-_cookie_[i].discount)/100+"</span> Đ</strong></p>";
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
                    item.find(".multiple").html(price * amount);
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
        autoplay: false,
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
