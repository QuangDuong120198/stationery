<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
    <div class="row list">
<?php $j=0; foreach($products as $row): ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-xxs-12">
            <div data-toggle="modal" data-target="#view-product" data-slide-index="<?php echo $j; ?>">
                <div class="list-item" data-product-id="<?php echo $row['id']; ?>">
                    <div class="img-thumbnail" title="<?php echo $row['name']; ?>" style="background-image:url(<?php echo $row['image']; ?>);">
<?php if($row['discount']>0):?>
                        <span class="discount"><?php echo -$row['discount'].'%'; ?></span>
<?php endif; ?>
                    </div>
                    <a href="javascript:void(0)" class="product-name"><strong title="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></strong></a>
                    <p class="price"><b><?php echo number_format($row['price']); ?> đ</b></p>
                </div>
            </div>
        </div>
<?php $j++; endforeach; ?>
    </div>
    <div class="row">
        <div class="col-xxs-12" style="text-align:center;">
            <ul class="pagination">
                <li><a href="javascript:void(0)" data-page="<?php echo $cur_page<=1? 1 : $cur_page - 1; ?>" title="Trang trước"><i class="fa fa-chevron-left"></i></a></li>
<?php foreach($display_page as $row):?>
                <li><a href="javascript:void(0)" data-page="<?php echo $row; ?>" <?php echo $row==$cur_page ? 'style="background-color:#0366d6;color:#fff;"' : ''; ?>><?php echo $row; ?></a></li>
<?php endforeach; ?>
                <li><a href="javascript:void(0)" data-page="<?php echo $cur_page>=$pages? $pages : $cur_page + 1; ?>" title="Trang sau"><i class="fa fa-chevron-right"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="modal" id="view-product">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-dark">
            <div class="modal-body">
                <div style="text-align:right;">
                    <a href="javascript:void(0)" style="color:#f5f5f0;" data-dismiss="modal"><i class="fa fa-times"></i></a>
                </div>
                <div class="carousel" id="inner-view-product" data-ride="carousel" data-interval="false">
                    <div class="carousel-inner" role="listbox">
<?php $i=0; foreach($products as $row): ?>
                        <div class="item <?php echo $i==0? 'active' : ''; ?>" data-product-id="<?php echo $row['id']; ?>" data-product-price="<?php echo $row['price']; ?>" data-product-discount="<?php echo $row['discount']; ?>" data-product-name="<?php echo $row["name"]; ?>">
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
                                            <div><i class="fa fa-tag"></i>&nbsp;&nbsp;<?php echo number_format($row['price']*(100-$row['discount'])/100); ?>&nbsp;Đ</div>
                                            <small><del><?php echo number_format($row['price']); ?>&nbsp;Đ</del></small>
                                        </p>
<?php else:?>
                                        <p><i class="fa fa-tag"></i>&nbsp;&nbsp;<?php echo number_format($row['price']); ?>&nbsp;Đ</p>
<?php endif; ?>
<?php if(!$row['status']): ?>
                                        <button class="btn btn-danger">Đã hết hàng</button>
<?php else: ?>
                                        <button class="btn btn-primary btn-cart"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Đặt mua</button>
                                        <p class="add-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Đã thêm vào giỏ hàng</p>
<?php endif; ?>
                                        <p class="product-type"><?php echo $row['type']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php $i++; endforeach; ?>
                    </div>
                    <a class="left carousel-control custom" href="#inner-view-product" role="button" data-slide="prev">
                        <span class="fa fa-chevron-left" aria-hidden="true"></span>
                    </a>
                    <a class="right carousel-control custom" href="#inner-view-product" role="button" data-slide="next">
                        <span class="fa fa-chevron-right" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    function displayCart(){
        if(Cookies.get("cart") && Cookies.getJSON("cart").length>0){
            var _cookie_ = Cookies.getJSON("cart");
            var _cookie_len = _cookie_.length;
            $(".inner-cart").html("");
            for(var i=0 ; i<_cookie_len ; i++)
            {
                var str = "<div class=\"row cart-item\" data-product-id=\""+_cookie_[i].id+"\">";
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
                var amount = $(this).val();
                var item = $(this).closest(".cart-item");
                var _cookie_ = Cookies.getJSON("cart");
                var _cookie_len = _cookie_.length;
                for(var i=0 ; i<_cookie_len ; i++)
                {
                    if(_cookie_[i].id === item.attr("data-product-id"))
                    {
                        _cookie_[i].amount = amount;
                        var price = parseInt(item.find(".price").html());
                        item.find(".multiple").html(price * amount);
                    }
                }
                Cookies.set("cart",JSON.stringify(_cookie_),{
                    expires: 30,
                    path: "/"
                });
            });
            $(".remove-from-cart").click(function(){
                var cur_item = $(this).closest(".cart-item");
                var id = cur_item.attr("data-product-id");
                var _cookie_ = Cookies.getJSON("cart");
                var _cookie_len = _cookie_.length;
                for(var i=0 ; i<_cookie_len ; i++)
                {
                    if(_cookie_[i].id === id)
                    {
                        _cookie_.splice(i,1);
                        cur_item.remove();
                        Cookies.set("cart",JSON.stringify(_cookie_),{
                            expires: 30,
                            path: "/"
                        });
                    }
                }
                $(".products-in-cart").html(Cookies.getJSON("cart").length);
            });
        }else{
            $(".inner-cart").html("Giỏ hàng của bạn hiện đang trống.");
        }
    };
    displayCart();
    $("#view-product").on("shown.bs.modal",function(){
        $(window).keydown(function(e){
            if(e.keyCode===37){
                $("#inner-view-product").carousel('prev');
            }else if(e.keyCode===39){
                $("#inner-view-product").carousel('next');
            }else if(e.keyCode===27){
                $("#view-product").modal('hide');
            }
        });
    });
    /* begin add to cart */
    $(".btn-cart").click(function(e){
        var item = $(e.target).closest(".item");
        var product = {
            id: item.attr("data-product-id"),
            name: item.attr("data-product-name"),
            price: item.attr("data-product-price"),
            discount: item.attr("data-product-discount"),
            image: item.find("img").eq(0).attr("src")
        };
        if(!Cookies.get("cart"))
        {
            var cart = [];
            product.amount = 1;
            cart.push(product);
            Cookies.set("cart",JSON.stringify(cart),{
                expires: 30,
                path: "/"
            });
        }
        else
        {
            var _cookie_ = Cookies.getJSON("cart");
            var _cookie_length = _cookie_.length;
            if((function(){
                for(var i=0 ; i<_cookie_length ; i++)
                {
                    if(_cookie_[i].id === product.id)
                    {
                        return true;
                    }
                }
                return false;
            })())
            {
                for(var i=0 ; i<_cookie_length ; i++)
                {
                    if(_cookie_[i].id === product.id)
                    {
                        _cookie_[i].amount++;
                    }
                }
            }
            else
            {
                product.amount = 1;
                _cookie_.push(product);
            }
            Cookies.set("cart",JSON.stringify(_cookie_),{
                expires: 30,
                path: "/"
            });
        }
        item.find(".add-success").eq(0).show();
        setTimeout(function(){
            item.find(".add-success").eq(0).hide();
        },1000);

        if(Cookies.get("cart")){
            $(".products-in-cart").html(Cookies.getJSON("cart").length);
        }else{
            $(".products-in-cart").html(0);
        }
        displayCart();
    });
    /* end add to cart */
    $("[data-target='#view-product']").click(function(){
        /* open modal and slide to selected index */
        var index = parseInt($(this).attr("data-slide-index"));
        $("#inner-view-product").carousel(index);
    });
    $("[data-page]").click(function(){
    /* pagination with AJAX */
        var page = $(this).attr('data-page');
        $.ajax({
            url: "<?php echo base_url().'home/get_products/'?>" + page,
            type: "GET",
            dateType: "html",
            data:{
                to_page: page
            },
            beforeSend: function(){
                $('.img-thumbnail, .discount, .product-name, .price').addClass('placeholder-loading');
                $('.img-thumbnail, .discount, .product-name, .price').css('color','transparent');
                $('html, body').animate({
                    scrollTop: $(".all-products").offset().top
                }, 500);
            },
            success: function(e){
                $(".panel-body").html(JSON.parse(e).products_view);
            },
            error: function(){
                window.location.href = "<?php echo base_url().'home/index/'; ?>"+page;
            }
        });
    });
});
</script>
