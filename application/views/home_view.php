<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<?php echo $headtag; ?>
</head>
<body style="padding-right:0!important">
<div>
    <img class="example" style="width:200px;" src="" alt="" />
</div>
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
                            <div class="container-fluid">
                                <div class="row list">
<?php foreach($products as $row): ?>
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-xxs-12">
                                        <div>
                                            <div class="list-item" data-product-id="<?php echo $row['id']; ?>">
                                                <a href="javascript:void(0)"><strong title="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></strong></a>
                                                <div class="img-thumbnail" title="<?php echo $row['name']; ?>" style="background-image:url(<?php echo base_url()."product-image/".$row['id'].".png"; ?>);">
                                                </div>
                                                <p><b><?php echo number_format($row['price']); ?> đ</b></p>
                                                <div>
                                                    <a href="javascript:void(0)" class="btn btn-sm mybtn buy">Đặt mua</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<?php endforeach; ?>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12" style="text-align:center;">
                                        <ul class="pagination">
                                            <li><a href="javascript:void(0)" title="Trang trước"><i class="fa fa-chevron-left"></i></a></li>
                                            <li><a href="javascript:void(0)"><b>1</b></a></li>
                                            <li><a href="javascript:void(0)"><b>2</b></a></li>
                                            <li><a href="javascript:void(0)"><b>3</b></a></li>
                                            <li><a href="javascript:void(0)" title="Trang sau"><i class="fa fa-chevron-right"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
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
        if(!$(e.target).is(".search-xs")){
            if($(e.target).is("#btn-search") || $(e.target).closest("#btn-search").length){
                $(".search-xs").toggle();
            }
            else if(!$(e.target).closest(".search-xs").length){
                $(".search-xs").hide();
            }
            else if($(e.target).closest(".back").length){
                $(".search-xs").hide();
            }
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
