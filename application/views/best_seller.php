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
                                        <button class="btn btn-primary btn-cart"><i class="fa fa-cart-plus"></i>&nbsp;&nbsp;Đặt mua</button>
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
                                <p class="price"><b><?php echo number_format($row['price']).' Đ'; ?></b></p>
                            </div>
                        </div>
<?php $l++; endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
