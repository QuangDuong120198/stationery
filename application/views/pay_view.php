<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<?php echo $headtag; ?>
<style>
.datetime {
    margin-top: 10px;
}
#custom-time + .datetime {
    display: none;
}
#custom-time:checked + .datetime {
    display: block;
}
</style>
</head>
<body style="padding-right:0!important">
<?php echo $browser; ?>
<?php echo $cart; ?>
<div class="container-fluid">

<?php echo ($banner_menu) ? $banner_menu : ''; ?>

<div class="row">
<div class="col-xxs-12">
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 col-xxs-12">
            <h4 style="text-transform: uppercase;font-weight:bold;margin-top: 15px;">Thông tin khách hàng</h4>
            <div>
                <label for="customer-name">Họ tên <sup><b>(*)</b></sup>:</label>
                <input type="text" class="form-control" placeholder="Nhập họ tên" id="customer-name" required="required" />
                <br />
                <label for="customer-tel">Số điện thoại <sup><b>(*)</b></sup>:</label>
                <input type="text" class="form-control" placeholder="Nhập số điện thoại" id="customer-tel" required="required" />
                <br />
                <label for="customer-email">Email :</label>
                <input type="text" class="form-control" id="customer-email" placeholder="Nhập email" />
                <br />
                <label for="customer-company">Tên công ty :</label>
                <input type="text" class="form-control" id="customer-company" placeholder="Nhập tên công ty" />
                <br />
                <label for="customer-address">Địa chỉ nhận hàng <sup><b>(*)</b></sup>:</label>
                <textarea class="form-control" id="customer-address" placeholder="Nhập địa chỉ" required="required"></textarea>
                <br />
                <label>Thời gian nhận hàng <sup><b>(*)</b></sup> :</label>
                <div><label><input type="radio" name="time" value="0" />&nbsp;Ngay bây giờ</label></div>
                <div><label><input type="radio" name="time" value="1" checked="checked" />&nbsp;Trong ngày</label></div>
                <div>
                    <label style="display: block;">
                        <input type="radio" name="time" id="custom-time" value="2" />&nbsp;Tự chọn
                        <div class="datetime">
                            <input type="text" style="font-weight: normal" class="form-control" id="custom-detail" placeholder="Nhập thời gian nhận hàng" />
                        </div>
                    </label>
                </div>
                <br />
                <div style="text-align: center;">
                    <button class="btn btn-primary form-control" style="width: 60%;font-weight: bold;" type="button" data-target="#shopping-list" data-toggle="modal">Kiểm tra đơn hàng</button>
                </div>
                <div style="text-align: center;margin-top:15px; margin-bottom:15px;">
                    <button class="btn btn-success form-control" style="width: 60%;font-weight: bold;" id="btn-pay" type="button">Chốt hóa đơn</button>
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
validateCookie();total();displayCart();
function total(){
    if(Cookies.getJSON("cart")){
        var _cookie_ = Cookies.getJSON("cart");
        var _cookie_len = _cookie_.length;
        var total = 0;
        for(var i=0 ; i<_cookie_len ; i++){
            total += parseInt(_cookie_[i].amount) * parseInt(_cookie_[i].price)*(100-_cookie_[i].discount)/100;
        }
        if(total > 0){
            if(document.getElementById("shopping-list").getElementsByClassName("pay").length){
                document.getElementById("shopping-list").getElementsByClassName("pay")[0].getElementsByTagName("div")[0].innerHTML = "<button type=\"button\" class=\"btn btn-default back\" data-dismiss=\"modal\"><i class=\"fa fa-chevron-left\"></i>&nbsp;Tiếp tục mua hàng</button><a href=\"/home/pay\" class=\"btn btn-primary\" id=\"pay\">Thanh toán</button>";
            }
            document.getElementById("shopping-list").getElementsByClassName("total")[0].innerHTML = "Tổng:  "+parseInt(total).format(0,3)+ " Đ";
        }else{
            if(document.getElementById("shopping-list").getElementsByClassName("pay").length){
                document.getElementById("shopping-list").getElementsByClassName("pay")[0].getElementsByTagName("div")[0].innerHTML = "";
            }
            document.getElementById("shopping-list").getElementsByClassName("total")[0].innerHTML = "";
        }
    }
}
$(function(){
    $(".pay").remove();
    $("[data-target='#shopping-list']").click(function(){
        total();
        displayCart();
    });
    $(window).click(function(e){
        if($(e.target).is("#btn-search") || $(e.target).closest("#btn-search").length){
            $(".search-xs").toggle();
        }else if(!$(e.target).closest(".search-xs").length){
            $(".search-xs").hide();
        }else if($(e.target).closest(".back").length){
            $(".search-xs").hide();
        }
    });
    $("#btn-pay").click(function(){
        validateCookie();
        if(Cookies.getJSON("cart").length<=0){
            Snackbar.show({
                text: 'Giỏ hàng của bạn đang trống',
                width: '300px',
                pos: 'bottom-center',
                showAction: false,
                duration: 3000,
                backgroundColor: '#333333',
                textColor: '#f5f5f0'
            });
        }else if(!/[\S]/.test(document.getElementById("customer-name").value) || document.getElementById("customer-name").value===''){
            Snackbar.show({
                text: 'Không được để trống họ tên',
                width: '300px',
                pos: 'bottom-center',
                showAction: false,
                duration: 3000,
                backgroundColor: '#333333',
                textColor: '#f5f5f0'
            });
        }else if(!/[\S]/.test(document.getElementById("customer-tel").value) || document.getElementById("customer-tel").value===''){
            Snackbar.show({
                text: 'Không được để trống số điện thoại',
                width: '300px',
                pos: 'bottom-center',
                showAction: false,
                duration: 3000,
                backgroundColor: '#333333',
                textColor: '#f5f5f0'
            });
        }
        else if(!/^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/.test(document.getElementById("customer-tel").value)){
            Snackbar.show({
                text: 'Số điện thoại không hợp lệ',
                width: '300px',
                pos: 'bottom-center',
                showAction: false,
                duration: 3000,
                backgroundColor: '#333333',
                textColor: '#f5f5f0'
            });
        }
        else if(document.getElementById("customer-email").value!=='' && !/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(document.getElementById("customer-email").value)){
            Snackbar.show({
                text: 'Email không hợp lệ',
                width: '300px',
                pos: 'bottom-center',
                showAction: false,
                duration: 3000,
                backgroundColor: '#333333',
                textColor: '#f5f5f0'
            });
        }
        else if(!/[\S]/.test(document.getElementById("customer-address").value) || document.getElementById("customer-address").value===''){
            Snackbar.show({
                text: "Không được để trống địa chỉ",
                width: "300px",
                pos: "bottom-center",
                showAction: false,
                duration: 3000,
                backgroundColor: "#333333",
                textColor: "#f5f5f0"
            });
        }
        else if(document.getElementById("custom-time").checked && (document.getElementById("custom-detail").value==="" || !/[\S]/.test(document.getElementById("custom-detail").value))){
            Snackbar.show({
                text: "Không được để trống thời gian nhận hàng",
                width: "300px",
                pos: "bottom-center",
                showAction: false,
                duration: 3000,
                backgroundColor: "#333333",
                textColor: "#f5f5f0"
            });
        }
        else{
            var customer = {
                id: "bill"+(new Date().getTime()),
                name: document.getElementById("customer-name").value,
                tel: document.getElementById("customer-tel").value,
                email: document.getElementById("customer-email").value,
                company: document.getElementById("customer-company").value,
                address: document.getElementById("customer-address").value,
                list: Cookies.getJSON("cart"),
                status: false,
                time: {}
            };
            for(var i=0;i<document.getElementsByName("time").length;i++)
            {
                if(document.getElementsByName("time")[i].checked){
                    switch(parseInt(document.getElementsByName("time")[i].value))
                    {
                        case 0:
                            customer.time.type = "default";
                            customer.time.content = "Ngay bây giờ";
                            break;
                        case 1:
                            customer.time.type = "default";
                            customer.time.content = "Trong ngày";
                            break;
                        case 2:
                            customer.time.type = "custom";
                            customer.time.content = document.getElementById("custom-detail").value.trim();
                            break;
                        default:
                            customer.time.type = "default";
                            customer.time.content = "Trong ngày";
                    }
                    break;
                }
            }
            $.ajax({
                url: "/home/pay_ajax/",
                type: "POST",
                dataType: "html",
                data: {
                    bill: JSON.stringify(customer)
                },
                beforeSend: function(){
                    $("#btn-pay").attr("disabled","disabled");
                },
                success: function(e){
                    Snackbar.show({
                        text: "<i class=\"fa fa-check\"></i> Đã gửi đơn hàng thành công<br /> Bạn sẽ nhận hàng theo yêu cầu là:&nbsp;<strong>"+customer.time.content+"</strong>",
                        width: "300px",
                        pos: "bottom-center",
                        showAction: false,
                        duration: 3000,
                        backgroundColor: "#333333",
                        textColor: "#f5f5f0"
                    });
                    Cookies.remove("cart", {path: "/"});
                    validateCookie();total();displayCart();
                    $(".products-in-cart").text(0);
                    $("input, textarea").val("");
                    $("#btn-pay").removeAttr("disabled");
                },
                error: function(){
                    Snackbar.show({
                        text: "Đã có lỗi xảy ra khi gửi đơn hàng",
                        width: "300px",
                        pos: "bottom-center",
                        showAction: false,
                        duration: 3000,
                        backgroundColor: "#333333",
                        textColor: "#f5f5f0"
                    });
                    $("#btn-pay").removeAttr("disabled");
                }
            }).always(function(){
                $("#btn-pay").removeAttr("disabled");
            });
        }
    });
    document.body.onresize = function(){
        var src = document.getElementsByClassName("google")[0].getElementsByTagName("iframe")[0].src;
        document.getElementsByClassName("google")[0].getElementsByTagName("iframe")[0].src = src;
    };
});
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692782-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-116692782-1');
</script>
</html>
