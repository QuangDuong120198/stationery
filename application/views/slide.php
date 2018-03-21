<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row slide">
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-xxs-12" style="padding-bottom:15px;">
        <div class="category hidden-sm hidden-xs">
            <div>
                <a href="javascript:void(0)" class="category-header mybtn"><span>DANH MỤC&nbsp;<i class="fa fa-chevron-down" style="float:right;"></i></span></a>
            </div>
            <div class="inner-category">
<?php foreach($category as $row){ ?>
                <div class="category-item-lg"><a href="javascript:void(0)"><?php echo $row; ?></a></div>
<?php }?>
            </div>
        </div>
        <div class="category visible-sm visible-xs">
            <div id="category-toggle">
                <a href="javascript:void(0)" class="category-header mybtn"><span>DANH MỤC&nbsp;<i class="fa fa-chevron-down" style="float:right;"></i></span></a>
            </div>
            <div class="inner-category">
<?php foreach($category as $row){ ?>
                <div class="category-item"><a href="javascript:void(0)"><?php echo $row; ?></a></div>
<?php } ?>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 col-xxs-12">
        <div class="contact" style="margin-bottom:20px;">
            <div style="font-size:16px;"><i class="fa fa-phone"></i>&nbsp;<?php echo $constants['phone']? $constants['phone'] : ''; ?></div>
            <div><i class="fa fa-envelope"></i>&nbsp;<?php echo $constants['mail']? $constants['mail'] : ''; ?></div>
        </div>
        <div id="advertisement" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#advertisement" data-slide-to="0" class="active"></li>
                <li data-target="#advertisement" data-slide-to="1"></li>
                <li data-target="#advertisement" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="item-inner" style="background-color:red;"></div>
                    <div class="carousel-caption"></div>
                </div>
                <div class="item">
                    <div class="item-inner" style="background-color:blue;"></div>
                    <div class="carousel-caption"></div>
                </div>
                <div class="item">
                    <div class="item-inner" style="background-color:lime;"></div>
                    <div class="carousel-caption"></div>
                </div>
            </div>
            <a class="left carousel-control" href="#advertisement" role="button" data-slide="prev">
                <span class="fa fa-chevron-left" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);" aria-hidden="true"></span>
            </a>
            <a class="right carousel-control" href="#advertisement" role="button" data-slide="next">
                <span class="fa fa-chevron-right" style="position:absolute;right:10px;top:50%;transform:translateY(-50%)" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>
