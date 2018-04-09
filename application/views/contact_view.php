<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<?php echo $headtag; ?>
<style>
.contact-content {
    padding: 10px 15px;
}
.contact-content h1, .contact-content h2, .contact-content h3, .contact-content h4, .contact-content h5, .contact-content h6 {
    text-align: center;
}
.contact-content input, .contact-content textarea {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.contact-content textarea {
    height: 68px;
}
.contact-content input:focus, .contact-content textarea:focus {
    border-color: #66afe9;
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
}
.contact-content button {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 4px;
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
</style>
</head>
<body>
<?php echo $cart; ?>
<div class="container-fluid">
<?php echo $banner_menu; ?>

<div class="row">
    <div class="col-xxs-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 col-xxs-12">
                    <div class="contact-content">
                        <div>
                            <?php echo html_entity_decode($constants['contact_content']); ?>
                        </div>
                        <p>Khách hàng, đối tác có thể liên hệ với cửa hàng qua form dưới đây: </p>
                        <p>
                            <p>
                                <label for="contact-name">Họ tên <sup><b>(*)</b></sup> :</label>
                                <input type="text" id="contact-name" />
                            </p>
                            <p>
                                <label for="contact-address">Địa chỉ :</label>
                                <input type="text" id="contact-address" />
                            </p>
                            <p>
                                <label for="contact-tel">Điện thoại <sup><b>(*)</b></sup> :</label>
                                <input type="tel" id="contact-tel" />
                            </p>
                            <p>
                                <label for="contact-email">Email <sup><b>(*)</b></sup> :</label>
                                <input type="email" id="contact-email" />
                            </p>
                            <p>
                                <label for="contact-detail">Nội dung <sup><b>(*)</b></sup> :</label>
                                <textarea id="contact-detail"></textarea>
                            </p>
                            <p>
                                <button id="contact-send">Gửi</button>
                            </p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>
</div>
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
document.getElementById("contact-send").onclick = function(){
    if(document.getElementById("contact-name").value==="" || !/[\S]/.test(document.getElementById("contact-name").value)){
        Snackbar.show({
            text: 'Không được để trống họ tên',
            width: '300px',
            pos: 'bottom-center',
            showAction: false,
            duration: 3000,
            backgroundColor: '#333333',
            textColor: '#f5f5f0'
        });
    }else if(document.getElementById("contact-tel").value==="" || !/[\S]/.test(document.getElementById("contact-tel").value)){
        Snackbar.show({
            text: 'Không được để trống số điện thoại',
            width: '300px',
            pos: 'bottom-center',
            showAction: false,
            duration: 3000,
            backgroundColor: '#333',
            textColor: '#f5f5f0'
        });
    }else if(!/^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/.test(document.getElementById("contact-tel").value)){
        Snackbar.show({
            text: 'Số điện thoại không hợp lệ',
            width: '300px',
            pos: 'bottom-center',
            showAction: false,
            duration: 3000,
            backgroundColor: '#333333',
            textColor: '#f5f5f0'
        });
    }else if(document.getElementById("contact-email").value==="" || !/[\S]/.test(document.getElementById("contact-email").value)){
        Snackbar.show({
            text: 'Không được để trống email',
            width: '300px',
            pos: 'bottom-center',
            showAction: false,
            duration: 3000,
            backgroundColor: '#333333',
            textColor: '#f5f5f0'
        });
    }else if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(document.getElementById("contact-email").value)){
        Snackbar.show({
            text: 'Email không hợp lệ',
            width: '300px',
            pos: 'bottom-center',
            showAction: false,
            duration: 3000,
            backgroundColor: '#333333',
            textColor: '#f5f5f0'
        });
    }else if(document.getElementById("contact-detail").value==="" || !/[\S]/.test(document.getElementById("contact-detail").value)){
        Snackbar.show({
            text: 'Không được để trống nội dung',
            width: '300px',
            pos: 'bottom-center',
            showAction: false,
            duration: 3000,
            backgroundColor: '#333333',
            textColor: '#f5f5f0'
        });
    }
    else if(document.getElementById("contact-detail").value.trim().length < 50){
        Snackbar.show({
            text: 'Nội dung phải dài ít nhất 50 kí tự',
            width: '300px',
            pos: 'bottom-center',
            showAction: false,
            duration: 3000,
            backgroundColor: '#333333',
            textColor: '#f5f5f0'
        });
    }else{
        var contact = {
            id: "contact"+(new Date()).getTime(),
            name: document.getElementById("contact-name").value.trim(),
            address: document.getElementById("contact-address").value.trim(),
            tel: document.getElementById("contact-tel").value,
            email: document.getElementById("contact-email").value,
            detail: document.getElementById("contact-detail").value
        };
        $.ajax({
            url: '<?php echo base_url()."contact/mail"; ?>',
            type: 'POST',
            dataType: 'html',
            data: {
                contact: JSON.stringify(contact)
            },
            success: function(){
                $("input").val("");
                $("textarea").val("");
                Snackbar.show({
                    text: 'Đã gửi liên hệ!',
                    width: '300px',
                    pos: 'bottom-center',
                    showAction: false,
                    duration: 3000,
                    backgroundColor: '#333333',
                    textColor: '#f5f5f0'
                });
            },
            error: function(){
                Snackbar.show({
                    text: 'Có lỗi xảy ra khi gửi, vui lòng thử lại',
                    width: '300px',
                    pos: 'bottom-center',
                    showAction: false,
                    duration: 3000,
                    backgroundColor: '#333333',
                    textColor: '#f5f5f0'
                });
            }
        });
    }
};
$(function(){
    $("[data-target='#shopping-list']").click(function(){
        displayCart();
        total();
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
</body>
</html>
