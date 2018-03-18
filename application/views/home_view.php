<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<?php echo $headtag; ?>
</head>
<body style="padding-right:0!important">
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
                            <div class="container-fluid">
                                <div class="row list">
<?php $j=0; foreach($products as $row): ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-xxs-12">
                                        <div data-toggle="modal" data-target="#view-product" data-slide-index="<?php echo $j; ?>">
                                            <div class="list-item">
                                                <div class="img-thumbnail" title="<?php echo $row['name']; ?>" style="background-image:url();">
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
                <div class="carousel" id="inner-view-product" data-ride="carousel" data-interval="false">
                    <div class="carousel-inner" role="listbox">
<?php $i=0; foreach($products as $row): ?>
                        <div class="item <?php echo $i==0? 'active' : ''; ?>">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-7 col-xs-7 col-xxs-12">
                                        <div class=""></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-5 col-xxs-12">
                                        <?php echo $row['name']; ?>
                                        <?php echo $row['price']; ?>
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
    $("#view-product").on("shown.bs.modal",function(){
        $(window).keydown(function(e){
            if(e.keyCode===37){
                $("#inner-view-product").carousel('prev');
            }else if(e.keyCode===39){
                $("#inner-view-product").carousel('next');
            }
        });
    });
    $("[data-target='#view-product']").click(function(){
        var index = parseInt($(this).attr("data-slide-index"));
        $("#inner-view-product").carousel(index);
    });
    $("[data-page]").click(function(){
        var page = $(this).attr('data-page');
        $.ajax({
            url: "<?php echo base_url().'home/get_products/'?>" + page,
            type: "GET",
            dateType: "html",
            data: {
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
                window.location.href = "<?php echo base_url().'home/index/'; ?>" + page;
            }
        });
    });
});
</script>
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
$(document).ready(function(){
    /*
    $("#prev, #next").click(function(){
        $('html, body').animate({
            scrollTop: $(".all-products").offset().top
        }, 500);
    });
    */
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
    $(window).click(function(e){
        if($(e.target).is("#btn-search") || $(e.target).closest("#btn-search").length){
            $(".search-xs").toggle();
        }
        else if(!$(e.target).closest(".search-xs").length){
            $(".search-xs").hide();
        }
        else if($(e.target).closest(".back").length){
            $(".search-xs").hide();
        }
    });
    $("#category-toggle").click(function(){
        if($(window).width()<992){
            $(".category-item").toggle();
        }else{
            $(".category-item").show();
        }
    });
});
</script>
</html>
