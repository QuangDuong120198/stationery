function validateCookie(){
    var _cookie_ = Cookies.getJSON("cart");
    if(!Array.isArray(_cookie_)){
        Cookies.set("cart",JSON.stringify([]),{ expires:30, path:"/" });
    }else{
        if(_cookie_.length !== 0){
            var _cookie_len = _cookie_.length;
            for(var i=0 ; i<_cookie_len ; i++){
                if(typeof _cookie_[i] !=="object" || !_cookie_[i].hasOwnProperty('amount') || !_cookie_[i].hasOwnProperty("price") || !_cookie_[i].hasOwnProperty("name") || !_cookie_[i].hasOwnProperty("discount") || !_cookie_[i].hasOwnProperty("image") || !_cookie_[i].hasOwnProperty("id")){
                    Cookies.set("cart",JSON.stringify([]),{expires:30, path:"/"});
                }
            }
        }
    }
}
function displayCart(){
    validateCookie();
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
            str += "<div><i class=\"fa fa-tag\"></i>&nbsp;&nbsp;<span class=\"price\">"+parseInt(_cookie_[i].price*(100-_cookie_[i].discount)/100).format(0,3)+"</span> Đ</div>";
            if(_cookie_[i].discount>0){
                str += "<div><small><del>"+parseInt(_cookie_[i].price).format(0,3)+" Đ</del></small></div>";
            }
            str += "<input class=\"amount\" type=\"number\" min=\"1\" value=\""+_cookie_[i].amount+"\" />";
            str += "<p><strong>Thành tiền: <span class=\"multiple\">"+(_cookie_[i].amount * _cookie_[i].price *(100-_cookie_[i].discount)/100).format(0,3)+"</span> Đ</strong></p>";
            str += "<p><button class=\"btn btn-danger remove-from-cart\"><i class=\"fa fa-times\"></i>&nbsp;&nbsp;Xóa khỏi giỏ hàng</button></p>";
            str += "</div>";
            str += "</div>";
            $(".inner-cart").append(str);
        }
        $(".amount").change(function(){
            validateCookie();
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
                    item.find(".multiple").html((price * amount).format(0,3));
                }
            }
            Cookies.set("cart",JSON.stringify(_cookie_),{expires: 30,path: "/"});
            total();
        });
        $(".remove-from-cart").click(function(){
            validateCookie();
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
