/** Зміна кольору в nav ul li коли знаходимся на потрібній сторінці */
$(document).ready(function () {
    $('nav ul li a').each(function () {
        if ($(this).attr("href").toLowerCase() == window.location.pathname.toLowerCase()) {
            $(this).parents("li").addClass("active");
            return;
        }
    });

    var $path = window.location.pathname.toLowerCase();

    // (change color in header nav li якщо данної ссилки немає в nav ul li но вона відноситься до певного пункта) працює лише якщо header динамічний

    function activeLiNavMenu (path, number) {
        if ( $path == path ) {
            $('nav ul li:nth-child(' + number ).addClass('active');
        }
    }

    activeLiNavMenu('user_information.html', 2);
    activeLiNavMenu('item_information.html', 3);
    activeLiNavMenu('order_information.html', 1);

    // /(change color in header nav li) працює лише якщо header динамічний

});
/** /Зміна кольору в nav ul li коли знаходимся на потрібній сторінці */


/** dropdown list in order.php */
$(document).ready(function () {

    $('body').on('click', '.selected', function(e) {
        e.stopPropagation();
        var list = $(this).next('.status');
        if (list.is(':hidden')) {
            list.stop().slideDown();
        } else {
            list.stop().slideUp();
        }
    });

    // Hides drop-down list when user click at the somewhere not on list
    $('body').on('click', this, function() {
        var list = $('table.table .dropdown-cont .status');
        if (list.is(':visible')) {
            $('.status').stop().slideUp();
        }
    });

    // Change content

    $('.status').on('click', 'li', function () {
        $this = $(this);
        var orderId = $this.parent().attr('id');
        var status = $this.html()
        $.ajax({
            type: 'PUT',
            url: urlStatus + '/' + orderId,
            data: {status: status, _token: token},
            success: function() {
                $this.parent().prev().html(status);
            }
        });
    });

});
/** /dropdown list in order.php */


/**
 * Стилизация radio and checkbox
 */
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


//тимчасове рішення проблеми з зміною кольору при клікі на елементи випадаючого списку

$('.selected').css('color','rgb(160, 27, 162)');

$(function(){
    $("td").on('click', '.upload_link', function(e){
        e.preventDefault();
        $(this).siblings(".upload:hidden").trigger('click');
    });
});

$(function(){
    $("td").on('click', '.delete', function(e){
        e.preventDefault();
        $(this).siblings(".upload:hidden").val('');
        $(this).siblings('.cont').addClass('empty').children('img').attr({src: '', alt: ''});
        $(this).siblings('.delete-image').val($(this).siblings('.cont').attr('id'));
        $(this).siblings('.rename').remove();
        $(this).replaceWith('<a class="load upload_link" href="#">Загрузить</a>');
    });
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var f = input.files[0];

        reader.onload = function (e) {
            $(input).siblings('.cont').removeClass('empty').children('img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".upload").change(function(){
    readURL(this);
    $(this).siblings('.delete-image').val('');
    $(this).siblings('.load').replaceWith('<a class="rename upload_link" href="#">Изменить</a><a class="delete" href="#">Удалить</a>');
});

$('.delete a').on('click', function(e) {
    e.preventDefault();
    $(this).closest('tr').remove();
});