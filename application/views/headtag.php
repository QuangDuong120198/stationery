<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="X-UA-Compatible" content="IE=edge" />
<title>Văn phòng phẩm Xuân Thủy</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="icon" href="<?php echo 'data:image/png;base64,'.($constants['logo'] ? $constants['logo'] : ''); ?>" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dancing+Script" />
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."bootstrap/css/bootstrap.min.css"; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."bootstrap/css/bootstrap-theme.min.css"; ?>" />
<script src="<?php echo base_url()."bootstrap/js/JSONpolyfill.js"; ?>"></script>
<script src="<?php echo base_url()."bootstrap/js/cookie.js"; ?>"></script>
<script src="<?php echo base_url()."bootstrap/js/bootstrap.min.js"; ?>"></script>
<style>
@media(min-width:768px){.navbar-nav{float:none;margin:0 auto;display:block;text-align:center;}.navbar-nav>li{display:inline-block;float:none;}}
.banner{position:relative;}
.banner .contact{position:absolute;z-index:1;top:40px;right:15px;}
.banner, .banner .logo{height:180px;}
.banner .title{width:100%;padding-top:20px;padding-left:10px;padding-bottom:20px;font-family:"Dancing Script", "Palatino Linotype", "Linotype", "Book-Antiqua", serif;font-weight:bold;font-style:italic;}
.banner .title a{color:#0000cc;font-size:40px;}
.banner .title a:hover, .banner .title a:focus{text-decoration:none;}
.banner .stuffs .search, .banner .stuffs .cart{padding-left:10px;padding-right:10px;float:left;text-align:center;}
.banner .stuffs .search{width:70%;}
.banner .stuffs .cart{width:30%;}
.mybtn, .mybtn:hover, .mybtn:focus{font-weight:bold!important;background:linear-gradient(#8080ff,#0000cc);color:#ffffff;outline:0!important;}
.banner .stuffs .search input, .banner .stuffs .search button{border-radius:0;outline:0;}
.banner-xs{height:80px;position:relative;}
.banner-xs img{margin-left:-30px;padding:10px 0;width:60px;}
.banner-xs > span{position:absolute;right:15px;top:23px;z-index: 1;}
.banner-xs > div > span a{color:#0000cc;}
.banner-xs > div > span a:hover, .banner-xs > div > span a:focus{text-decoration:none;}
.banner-xs > .search-xs{display:none;position:absolute;width:100%;left:0;top:23px;z-index: 10;}
.banner-xs .back{position:absolute;z-index:10;left:-40px;top:0;}
@media(min-width:768px){.banner-xs{display:none;}}
.menu{background:linear-gradient(#8080ff,#0000cc);color:#ffffff;}
.menu ul li a, .menu button{color:#ffffff;text-transform:uppercase;font-weight:bold;font-size:12px;padding:10px 15px;margin:5px;border-radius:5px;}
.menu ul li a:hover, .menu button:hover, .menu ul li a:focus, .menu button:focus{color:#ffffff;background-color:#333399;border-radius:5px;transition:0.4s;}
.category{border-radius:3px;border:1px solid #8080ff;margin-bottom:15px;}
.category div a{display:block;padding:8px 10px;}
.category div a:hover, .category div a:focus{background-color:#f5f5f0;text-decoration:none!important;transition:0.4s;}
.mybtn{background:linear-gradient(#8080ff,#0000cc)!important;}
.panel{margin-left:15px;margin-right:15px;}
.panel.mypanel{border:1px solid #8080ff;outline:0!important;}
.panel.mypanel .panel-header{background:linear-gradient(#8080ff,#0000cc);padding:5px 10px;color:#fff;font-weight:bold;}
.panel.mypanel .panel-body{padding:8px;}
.panel.mypanel.tagspanel .panel-body{padding:5px 10px;}
.panel.mypanel.tagspanel .panel-body{height:60px;overflow:auto;}
.panel.mypanel .panel-body a.badge{margin:2px 0;padding:4px 15px;background-color:#8080ff;}
.panel.mypanel .panel-body a.badge:hover, .panel.mypanel .panel-body a.badge:focus{background-color:#333399;}
@media(max-width:992px){.category-item{display:none;}}
.all-items{margin-top:20px;margin-bottom:20px;}
.list .img-thumbnail{width:100%;padding-top:75%;}
@keyframes ringing{0%{transform:rotate(0deg);}50%{transform:rotate(45deg);}60%{transform:rotate(-45deg);}70%{transform:rotate(0deg);}80%{transform:rotate(45deg);}90%{transform:rotate(0deg);}}
.contact{text-align:right;font-size:12px;color:#0000cc;font-weight:bold;margin-bottom:15px;}
.contact:hover div .fa-phone{animation-name:ringing;animation-iteration-count: infinite;animation-duration:0.4s;}
.list-item{padding:8px 5px;margin:15px 0;border:1px solid #cccccc;border-radius:5px;text-align:center;font-weight:bold;}
.list-item img{margin:8px 0;width:100%;}
.list-item a{font-weight:bold;}
.list-item > a{width:140px;display:inline-block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.list-item .img-thumbnail{width:100%;cursor:pointer;background-position:center;background-repeat:no-repeat;background-size:contain;}
.footer h2{font-family:'Dancing Script','Book-Antiqua',serif;font-weight:bold;text-align:center;color:#0000cc;}
.footer h4, .footer p{color:#0000cc;}
.footer div{font-weight:bold;color:#0000cc;margin-bottom:3px;}
.google{padding:0 30px;}
#advertisement{margin-top:36px;}
#advertisement .item-inner{background-position:center;width:100%;height:360px;}
@media(max-width:768px){.center-xs{text-align:center;}.navbar-nav li a{text-align:center;}}
@media(max-width:992px){.center-sm{text-align:center;}.google, .facebook{padding-top:15px;}}
.all-items .contact{display:none;}
@media(max-width:991px){.banner .contact{display:none;}.all-items .contact{display:block;}#advertisement .item-inner{height:auto;padding-top:40%;}#advertisement{margin-top:0;}}
</style>
