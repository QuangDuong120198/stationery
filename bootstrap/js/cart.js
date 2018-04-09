function validateCookie(){
    var _cookie_ = Cookies.getJSON("cart");
    if(!Array.isArray(_cookie_)){
        Cookies.set("cart",JSON.stringify([]),{ expires:30, path:"/" });
        return false;
    }else{
        if(_cookie_.length !== 0){
            var _cookie_len = _cookie_.length;
            for(var i=0 ; i<_cookie_len ; i++){
                if(typeof _cookie_[i] !=="object" || !_cookie_[i].hasOwnProperty('amount') || !_cookie_[i].hasOwnProperty("price") || !_cookie_[i].hasOwnProperty("name") || !_cookie_[i].hasOwnProperty("discount") || !_cookie_[i].hasOwnProperty("image") || !_cookie_[i].hasOwnProperty("id")){
                    Cookies.set("cart",JSON.stringify([]),{expires:30, path:"/"});
                    return false;
                }
            }
            return true;
        }else{
            return false;
        }
    }
}
function displayCart(selector = ".inner-cart"){
    validateCookie();
    if(Cookies.get("cart") && Cookies.getJSON("cart").length>0){
        var _cookie_ = Cookies.getJSON("cart");
        var _cookie_len = _cookie_.length;
        $(".products-in-cart").html(Cookies.getJSON("cart").length);
        $(".inner-cart").html("");
        for(var i=0 ; i<_cookie_len ; i++){
            var str = "<div class=\"row cart-item\" data-product-id=\""+_cookie_[i].id+"\" data-product-price=\""+_cookie_[i].price+"\" data-product-discount=\""+_cookie_[i].discount+"\">";
            str += "<div class=\"col-lg-8 col-md-8 col-sm-7 col-xs-6 col-xxs-12 text-center\">";
            str += "<img src=\""+_cookie_[i].image+"\" alt=\""+_cookie_[i].name+"\" />";
            str += "</div>";
            str += "<div class=\"col-lg-4 col-md-4 col-sm-5 col-xs-6 col-xxs-12 center-xxs\">";
            str += "<h4><strong>"+_cookie_[i].name+"</strong></h4>";
            str += "<div><i class=\"fa fa-dollar\"></i>&nbsp;&nbsp;<b><span class=\"price\">"+parseInt(_cookie_[i].price*(100-_cookie_[i].discount)/100).format(0,3)+"</span> Đ</b></div>";
            if(_cookie_[i].discount>0){
                str += "<div><small><del>"+parseInt(_cookie_[i].price).format(0,3)+" Đ</del></small>&nbsp;&nbsp;&nbsp;<b style=\"color:#f00;\">-"+parseInt(_cookie_[i].discount)+"%</b></div>";
            }
            str += "<div class=\"input-group\" style=\"margin: 10px 20px;\"><span class=\"input-group-btn decrease\"><button class=\"btn btn-primary\"><i class=\"fa fa-minus\"></i></button></span><input class=\"form-control text-center amount\" type=\"text\" value=\""+_cookie_[i].amount+"\" /><span class=\"input-group-btn increase\"><button class=\"btn btn-primary\"><i class=\"fa fa-plus\"></i></button></span></div>";
            str += "<p><strong>Thành tiền: <span class=\"multiple\">"+(_cookie_[i].amount * _cookie_[i].price *(100-_cookie_[i].discount)/100).format(0,3)+"</span> Đ</strong></p>";
            str += "<p><button class=\"btn btn-danger remove-from-cart\"><i class=\"fa fa-times\"></i>&nbsp;&nbsp;Xóa khỏi giỏ hàng</button></p>";
            str += "</div>";
            str += "</div>";
            $(selector).append(str);
        }
        $(".amount").change(function(){
            validateCookie();
            if($(this).val()<=0 || $(this).val()==="" || isNaN($(this).val())){
                $(this).val(1);
            }else{
                $(this).val(parseInt($(this).val()));
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
            $(".products-in-cart").html(Cookies.getJSON("cart").length);
        });
        $(".decrease").click(function(){
            var input = $(this).siblings("input").eq(0);
            var num = isNaN(parseInt(input.val())) || (parseInt(input.val())<1) ? 1 : parseInt(input.val());
            if(num>1){
                input.val(--num);
            } else{
                input.val(1);
            }
            validateCookie();
            var amount = isNaN(parseInt($(this).siblings("input").eq(0).val())) ? 1 : parseInt($(this).siblings("input").eq(0).val());
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
            $(".products-in-cart").html(Cookies.getJSON("cart").length);
        });
        $(".increase").click(function(){
            var input = $(this).siblings("input").eq(0);
            var num = isNaN(parseInt(input.val())) || (parseInt(input.val())<1) ? 1 : parseInt(input.val());
            input.val(++num);
            validateCookie();
            var amount = isNaN(parseInt($(this).siblings("input").eq(0).val())) ? 1 : parseInt($(this).siblings("input").eq(0).val());
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
            $(".products-in-cart").html(Cookies.getJSON("cart").length);
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
                if((location.pathname.split("/").indexOf("home")<0 && location.pathname!=='') || location.pathname.split("/").indexOf("pay")>=0){
                    message += "<h4 style=\"font-weight:bold;text-align:center;margin-top:30px;margin-bottom:30px;\">";
                    message += "Giỏ hàng của bạn hiện đang trống.";
                    message += "<div style=\"margin-top:15px;margin-bottom:30px;\"><a href=\"/home\" class=\"btn btn-primary\"><i class=\"fa fa-shopping-cart\"></i>&nbsp;&nbsp;Tiếp tục mua hàng</a></div>";
                    message += "</h4>";
                }else{
                    message += "<h4 style=\"font-weight:bold;text-align:center;margin-top:30px;margin-bottom:30px;\">";
                    message += "Giỏ hàng của bạn hiện đang trống.";
                    message += "<div style=\"margin-top:15px;margin-bottom:30px;\"><button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\"><i class=\"fa fa-shopping-cart\"></i>&nbsp;&nbsp;Tiếp tục mua hàng</button></div>";
                    message += "</h4>";
                }
                $(selector).html(message);
            }
        });
    }else{
        var message = "";
        if((location.pathname.split("/").indexOf("home")<0 && location.pathname!=='') || location.pathname.split("/").indexOf("pay")>=0){
            message += "<h4 style=\"font-weight:bold;text-align:center;margin-top:30px;margin-bottom:30px;\">";
            message += "Giỏ hàng của bạn hiện đang trống.";
            message += "<div style=\"margin-top:15px;margin-bottom:30px;\"><a href=\"http://localhost/stationery/home\" class=\"btn btn-primary\"><i class=\"fa fa-shopping-cart\"></i>&nbsp;&nbsp;Tiếp tục mua hàng</a></div>";
            message += "</h4>";
        }else{
            message += "<h4 style=\"font-weight:bold;text-align:center;margin-top:30px;margin-bottom:30px;\">";
            message += "Giỏ hàng của bạn hiện đang trống.";
            message += "<div style=\"margin-top:15px;margin-bottom:30px;\"><button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\"><i class=\"fa fa-shopping-cart\"></i>&nbsp;&nbsp;Tiếp tục mua hàng</button></div>";
            message += "</h4>";
        }
        $(".inner-cart").html(message);
        $(".products-in-cart").html(Cookies.getJSON("cart").length);
    }
}
