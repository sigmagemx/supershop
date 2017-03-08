$(window).on('load',function() {

    //home page slider

    function homePageFlexSlider ($selector) {
        $($selector).flexslider({
            animation: "slide",
            animationLoop: true,
            itemMargin: 0
        });
    }

    homePageFlexSlider('#flexslider-home');
    homePageFlexSlider('#flexslider-popular-goods-homepage');

    // The slider being synced must be initialized first

    $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel"
    });

    flexSliderCarusel ('.another-goods-carusel');
    smallFlexSliderCarusel ('#carousel');

    function smallFlexSliderCarusel ($selector) {
        $($selector).flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: true,
            slideshow: false,
            itemWidth: 55,
            itemMargin: 20,
            minItems: 4,
            maxItems: 4,
            asNavFor: '#slider'
        });
    }


    function flexSliderCarusel ($selector) {
        $($selector).flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 55,
            itemMargin: 2,
            minItems: 4,
            maxItems: 4
        });
    }

    // scroll to top

    $('#up-page').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });

    //Динамічна зміна чисел в корзині basket.html

    decNumber('.basket .number-count .minus');
    incNumber('.basket .number-count .plus');

    function decNumber($selector) {
        $($selector).click(function() {
            var $this = $(this);
            var $basketSizeDefault = $this.next().val();

            if ($basketSizeDefault > 1) {
                var itemId = $this.closest('.good').children('input').val();

                $.get(urlReduce + '/' + itemId, function(data) {
                    $basketSizeDefault -= 1;
                    $this.next().val($basketSizeDefault);
                    $('.price').html(data.cartTotal + ' <span>руб.</span>');
                    $('.count').text(data.cartCount + ' предмета');
                    $this.closest('.good').children('.result').html(data.itemTotal + '<span>руб.</span>');
                    $('.summary span').text(data.cartTotal + 'руб.');
                });
            } else {
                return false;
            }
        });
    }

    function incNumber ($selector) {
        $($selector).click(function () {
            var $this = $(this);
            var $basketSizeDefault = $this.prev().val();
            var itemId = $this.closest('.good').children('input').val();

            $.get(urlIncrease + '/' + itemId, function(data) {
                //для преобразования string в number
                $basketSizeDefault -= 0;
                //Кінець
                $basketSizeDefault += 1;
                $this.prev().val($basketSizeDefault);
                $('.price').html(data.cartTotal + ' <span>руб.</span>');
                $('.count').text(data.cartCount + ' предмета');
                $this.closest('.good').children('.result').html(data.itemTotal + '<span>руб.</span>');
                $('.summary span').text(data.cartTotal + 'руб.');
            });
        });
    }

    $('.qty').bind('change keyup', function() {
        var $this = $(this);
        var qty = parseInt($this.val());
        var itemId = $this.closest('.good').children('input').val();

        if (qty < 1 || !qty) {
            qty = 1;
        }

        $.ajax({
            method: 'POST',
            url: urlUpdate + '/' + itemId,
            data: {qty: qty, _token: token},
            success: function(data) {
                $this.val(qty);
                $('.price').html(data.cartTotal + ' <span>руб.</span>');
                $('.count').text(data.cartCount + ' предмета');
                $this.closest('.good').children('.result').html(data.itemTotal + '<span>руб.</span>');
                $('.summary span').text(data.cartTotal + 'руб.');
            }
        })
    });


    /* login.html validate form */

    var field = new Array("email", "password");//поля обязательные

    $(".login form").submit(function() {// обрабатываем отправку формы
        var error=0; // индекс ошибки
        $(".login form").find(":input").each(function() {// проверяем каждое поле в форме
            for(var i=0;i<field.length;i++){ // если поле присутствует в списке обязательных
                if($(this).attr("name")==field[i]){ //проверяем поле формы на пустоту

                    if(!$(this).val()){// если в поле пустое
                        $(this).css('border', 'red 1px solid');// устанавливаем рамку красного цвета
                        error=1;// определяем индекс ошибки

                    }
                    else{
                        $(this).css('border', 'transparent 1px solid');// устанавливаем рамку обычного цвета
                    }

                }
            }

        })

        var email = $("#email").val();
        if(!isValidEmailAddress(email)){
            error=2;
        }

        if(error==2) {
            err_text="Введен некорректный e-mail!";
            $('#email').css('border', 'red 1px solid');

        }

        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
        }


        if(error==0){ // если ошибок нет то отправляем данные
            return true;
        }
        else{
            if(error==1) var err_text = "Не все обязательные поля заполнены!";
            $("#messenger").html(err_text);
            $("#messenger").fadeIn("slow");
            return false; //если в форме встретились ошибки , не  позволяем отослать данные на сервер.
        }



    });
    /* /login.html validate form */

    /* register.html validate form */

    var field1 = new Array("name", "email", "password", "password_confirmation");//поля обязательные

    $(".register form").submit(function() {// обрабатываем отправку формы
        var error=0; // индекс ошибки
        $(".register form").find(":input").each(function() {// проверяем каждое поле в форме
            for(var i=0;i<field1.length;i++){ // если поле присутствует в списке обязательных
                if($(this).attr("name")==field1[i]){ //проверяем поле формы на пустоту

                    if(!$(this).val()){// если в поле пустое
                        $(this).css('border', 'red 1px solid');// устанавливаем рамку красного цвета
                        error=1;// определяем индекс ошибки

                    }
                    else{
                        $(this).css('border', 'transparent 1px solid');// устанавливаем рамку обычного цвета
                    }

                }
            }

        })

        var email = $("#email").val();
        if(!isValidEmailAddress(email)){
            error=2;
        }

        //провека совпадения паролей
        var pas1 = $("#password").val();
        var pas2 = $("#password_confirm").val();
        if(pas1!=pas2){
            error=3;
            $("#password").css('border', 'red 1px solid');// устанавливаем рамку красного цвета
            $("#password_confirm").css('border', 'red 1px solid');// устанавливаем рамку красного цвета
        }

        if(error==2) {
            err_text="Введен некорректный e-mail!";
            $('#email').css('border', 'red 1px solid');
        }

        if(error==3)  err_text="Пароли не совпадают";


        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
        }


        if(error==0){ // если ошибок нет то отправляем данные
            return true;
        }
        else{
            if(error==1) var err_text = "Не все обязательные поля заполнены!";
            $("#messenger").html(err_text);
            $("#messenger").fadeIn("slow");
            return false; //если в форме встретились ошибки , не  позволяем отослать данные на сервер.
        }



    });


    /* /register.html validate form */

    /* checkout.html new users validate form */
    var field2 = new Array("name", "phone", "email");//поля обязательные

    $(".checkout-1 .left form").submit(function() {// обрабатываем отправку формы
        var error=0; // индекс ошибки
        $(".checkout-1 .left form").find(":input").each(function() {// проверяем каждое поле в форме
            for(var i=0;i<field2.length;i++){ // если поле присутствует в списке обязательных
                if($(this).attr("name")==field2[i]){ //проверяем поле формы на пустоту

                    if(!$(this).val()){// если в поле пустое
                        $(this).css('border', 'red 1px solid');// устанавливаем рамку красного цвета
                        error=1;// определяем индекс ошибки

                    }
                    else{
                        $(this).css('border', 'transparent 1px solid');// устанавливаем рамку обычного цвета
                    }

                }
            }

        })

        var email = $("#register-email").val();
        if(!isValidEmailAddress(email)){
            error=2;
        }

        if(error==2) {
            err_text="Введен некорректный e-mail!";
            $('#register-email').css('border', 'red 1px solid');

        }

        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
        }


        if(error==0){ // если ошибок нет то отправляем данные
            return true;
        }
        else{
            if(error==1) var err_text = "Не все обязательные поля заполнены!";
            $(".checkout-1 .left .messenger").html(err_text);
            $(".checkout-1 .left .messenger").fadeIn("slow");
            return false; //если в форме встретились ошибки , не  позволяем отослать данные на сервер.
        }



    });
    /* /checkout.html new users validate form */

    /* checkout.html login users validate form */
    var field3 = new Array("login_email", "password");//поля обязательные

    $(".checkout-1 .right form").submit(function() {// обрабатываем отправку формы
        var error=0; // индекс ошибки
        $(".checkout-1 .right form").find(":input").each(function() {// проверяем каждое поле в форме
            for(var i=0;i<field3.length;i++){ // если поле присутствует в списке обязательных
                if($(this).attr("name")==field3[i]){ //проверяем поле формы на пустоту

                    if(!$(this).val()){// если в поле пустое
                        $(this).css('border', 'red 1px solid');// устанавливаем рамку красного цвета
                        error=1;// определяем индекс ошибки

                    }
                    else{
                        $(this).css('border', 'transparent 1px solid');// устанавливаем рамку обычного цвета
                    }

                }
            }

        })

        var email = $("#email").val();
        if(!isValidEmailAddress(email)){
            error=2;
        }

        if(error==2) {
            err_text="Введен некорректный e-mail!";
            $('#email').css('border', 'red 1px solid');

        }

        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
        }


        if(error==0){ // если ошибок нет то отправляем данные
            return true;
        }
        else{
            if(error==1) var err_text = "Не все обязательные поля заполнены!";
            $(".checkout-1 .right .messenger").html(err_text);
            $(".checkout-1 .right .messenger").fadeIn("slow");
            return false; //если в форме встретились ошибки , не  позволяем отослать данные на сервер.
        }



    });
    /* /checkout.html login users validate form */

    /* checkout.html checkout-2 validate form */
    var field4 = new Array("city", "street", "house", "apt", "delivery");//поля обязательные

    $("#checkout2-form").submit(function() {// обрабатываем отправку формы
        var error=0; // индекс ошибки
        $("#checkout2-form").find(":input").each(function() {// проверяем каждое поле в форме
            for(var i=0;i<field4.length;i++){ // если поле присутствует в списке обязательных
                if($(this).attr("name")==field4[i]){ //проверяем поле формы на пустоту

                    if(!$(this).val()){// если в поле пустое
                        $(this).css('border', 'red 1px solid');// устанавливаем рамку красного цвета
                        error=1;// определяем индекс ошибки

                    }
                    else{
                        $(this).css('border', 'transparent 1px solid');// устанавливаем рамку обычного цвета
                    }

                }
            }

        })
        
        if(error==0){ // если ошибок нет то отправляем данные
            return true;
        }
        else{
            if(error==1) var err_text = "Не все обязательные поля заполнены!";
            $("#checkout2-form .messenger").html(err_text);
            $("#checkout2-form .messenger").fadeIn("slow");
            return false; //если в форме встретились ошибки , не  позволяем отослать данные на сервер.
        }



    });
    /* /checkout.html checkout-2 validate form */

    /* account.html validate form */
    var field5 = new Array("name", "phone", "email", "city", "street", "house", "apt");//поля обязательные

    $(".account form").submit(function() {// обрабатываем отправку формы
        var error=0; // индекс ошибки
        $(".account form").find(":input").each(function() {// проверяем каждое поле в форме
            for(var i=0;i<field5.length;i++){ // если поле присутствует в списке обязательных
                if($(this).attr("name")==field5[i]){ //проверяем поле формы на пустоту

                    if(!$(this).val()){// если в поле пустое
                        $(this).css('border', 'red 1px solid');// устанавливаем рамку красного цвета
                        error=1;// определяем индекс ошибки

                    }
                    else{
                        $(this).css('border', 'transparent 1px solid');// устанавливаем рамку обычного цвета
                    }

                }
            }

        })

        var email = $("#email").val();
        if(!isValidEmailAddress(email)){
            error=2;
        }

        //провека совпадения паролей
        var pas1 = $("#password").val();
        var pas2 = $("#password_confirm").val();
        if(pas1!=pas2){
            error=3;
            $("#password").css('border', 'red 1px solid');// устанавливаем рамку красного цвета
            $("#password_confirm").css('border', 'red 1px solid');// устанавливаем рамку красного цвета
        }





        if(error==2) {
            err_text="Введен некорректный e-mail!";
            $('#email').css('border', 'red 1px solid');
        }

        if(error==3)  err_text="Пароли не совпадают";

        function isValidEmailAddress(emailAddress) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(emailAddress);
        }


        if(error==0){ // если ошибок нет то отправляем данные
            return true;
        }
        else{
            if(error==1) var err_text = "Не все обязательные поля заполнены!";
            $("#messenger").html(err_text);
            $("#messenger").fadeIn("slow");
            return false; //если в форме встретились ошибки , не  позволяем отослать данные на сервер.
        }



    });
    /* /account.html validate form */

});

/** Стилизация radio and checkbox */
var d = document;
var safari = (navigator.userAgent.toLowerCase().indexOf('safari') != -1) ? true : false;
var gebtn = function(parEl,child) { return parEl.getElementsByTagName(child); };
onload = function() {

    var body = gebtn(d,'body')[0];
    body.className = body.className && body.className != '' ? body.className + ' has-js' : 'has-js';

    if (!d.getElementById || !d.createTextNode) return;
    var ls = gebtn(d,'label');
    for (var i = 0; i < ls.length; i++) {
        var l = ls[i];
        if (l.className.indexOf('label_') == -1) continue;
        var inp = gebtn(l,'input')[0];
        if (l.className == 'label_check') {
            l.className = (safari && inp.checked == true || inp.checked) ? 'label_check c_on' : 'label_check c_off';
            l.onclick = check_it;
        };
        if (l.className == 'label_radio') {
            l.className = (safari && inp.checked == true || inp.checked) ? 'label_radio r_on' : 'label_radio r_off';
            l.onclick = turn_radio;
        };
    };
};
var check_it = function() {
    var inp = gebtn(this,'input')[0];
    if (this.className == 'label_check c_off' || (!safari && inp.checked)) {
        this.className = 'label_check c_on';
        if (safari) inp.click();
    } else {
        this.className = 'label_check c_off';
        if (safari) inp.click();
    };
};
var turn_radio = function() {
    var inp = gebtn(this,'input')[0];
    if (this.className == 'label_radio r_off' || inp.checked) {
        var ls = gebtn(this.parentNode,'label');
        for (var i = 0; i < ls.length; i++) {
            var l = ls[i];
            if (l.className.indexOf('label_radio') == -1)  continue;
            l.className = 'label_radio r_off';
        };
        this.className = 'label_radio r_on';
        if (safari) inp.click();
    } else {
        this.className = 'label_radio r_off';
        if (safari) inp.click();
    };
};

/** /Стилизация radio and checkbox */


/** fancybox script for product.html */

$(document).ready(function() {
    $(".product-slider a").fancybox();
});

/** /fancybox script for product.html */

$('.product .photos .small-carusel .slides li').click(function() {
    $('li.active').removeClass('active');
    $(this).addClass('active');
});