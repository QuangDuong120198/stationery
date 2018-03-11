<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
    <div class="container">
        <div class="row banner hidden-xs">
            <div class="col-lg-3 col-md-3 col-sm-3 hidden-xs" style="text-align:center">
                <img class="logo" alt="Văn phòng phẩm Xuân Thủy" src="<?php echo 'data:image/png;base64,'.$constants['logo']; ?>" />
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 hidden-xs">
                <span class="contact">
                    <div style="font-size:16px;"><i class="fa fa-phone"></i>&nbsp;<?php echo $constants['phone']; ?></div>
                    <div><i class="fa fa-envelope"></i>&nbsp;<?php echo $constants['mail']; ?></div>
                </span>
                <h2 class="title"><a href="javascript:void(0)">Văn phòng phẩm Xuân Thủy</a></h2>
                <div class="stuffs">
                    <div class="search">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Nhập từ tìm kiếm..." autocomplete="off" />
                                <span class="input-group-btn">
                                    <button class="btn mybtn" type="submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="cart">
                        <a class="btn btn-md mybtn" href="javascript:void(0)" data-toggle="modal" data-target="#shopping-list" style="position:relative;">
                            <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Giỏ hàng
                            <span style="position:absolute;z-index:5;background-color:#ff0000;border-radius:5px;font-weight:bold;padding:0 5px;top:-10px;right:-8px;">0</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="container">
        <div class="row" style="padding-left:10px;margin-left:30px;margin-right:2px">
            <div class="col-xxs-12 banner-xs">
                    <img src="<?php echo 'data:image/png;base64,'.$constants['logo']; ?>" alt="" />
                    <span>
                        <a href="javascript:void(0)" class="btn btn-md mybtn" id="btn-search"><i class="fa fa-search"></i></a>
                        <a href="javascript:void(0)" class="btn btn-md mybtn" data-toggle="modal" data-target="#shopping-list" type="button" style="position:relative">
                            <i class="fa fa-shopping-cart"></i>
                            <span style="position:absolute;z-index:5;background-color:#ff0000;border-radius:5px;font-weight:bold;padding:0 5px;top:-10px;right:-8px;">0</span>
                        </a>
                    </span>
                <div class="search-xs">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xxs-12">
                                <div class="back">
                                    <button type="button" class="btn mybtn"><i class="fa fa-arrow-left"></i></button>
                                </div>
                                <form method="get" action="">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="keyword" placeholder="Nhập từ tìm kiếm..." />
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn mybtn"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row menu">
    <div class="container">
        <div class="navbar-header">
            <button type="button" style="float:left;" class="navbar-toggle" data-toggle="collapse" data-target="#menu"><i class="fa fa-bars"></i></button>
        </div>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="nav navbar-nav">
                <li><a href="javascript:void(0)">Sản phẩm</a></li>
                <li><a href="javascript:void(0)">Giới thiệu</a></li>
                <li><a href="javascript:void(0)">Bảng giá</a></li>
                <li><a href="javascript:void(0)">Khuyến mại</a></li>
                <li><a href="javascript:void(0)">Liên hệ</a></li>
            </ul>
        </div>
    </div>
</div>
