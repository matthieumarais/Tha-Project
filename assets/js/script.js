$(document).ready(function () {

    $('.aniimated-thumbnials').lightGallery({
        selector: '.light-link',
        thumbnail: true
    });

    validator();

    $(document).on('change', '#city', function () {
        var pixelKey = $(this).find('option:selected').attr('data-pixel');
        console.log(pixelKey);

        var NoScriptTag = 'noscript';
        var scriptTag = 'script';

        loadJS(pixelScript(pixelKey), document.body, scriptTag);
        loadJS(pixelNoScript(pixelKey), document.body, NoScriptTag);
    })

    $(document).on('change', '#numberSeat', function () {
        var idProductSeat = 99;
        var val = parseInt($(this).val());
        var nbStudentBloc = $('.studentBloc').length;
        var price1 = 399;
        var price2 = 299;
        var price3 = 199;
        var priceTotal;


        $('#NumberOfSeat').val(val);

        if (val > 0 && val <= 3) {
            priceTotal = val * price1;
        } else if (val > 3 && val <= 9) {
            priceTotal = val * price2;
        } else if (val > 9) {
            priceTotal = val * price3;
        } else {
            priceTotal = 0;
        }
        $('#totalSeat').html(priceTotal);

        if ($('.studentBloc').length > 1 && val > nbStudentBloc) {

            // add bloc
            var startIndex = nbStudentBloc + 1;
            addBloc(startIndex, val);

        } else if ($('.studentBloc').length > 1 && val < nbStudentBloc) {

            // remove bloc
            if (val == 0) {
                val = 1;
            }
            var index = nbStudentBloc - val;
            for (let i = 0; i < index; i++) {
                $('.studentBloc').last().remove();
            }

        } else {

            // first add
            var startIndex = 2;
            addBloc(startIndex, val);

        }

        // Cart part
        if ($(this).val() > 0) {
            $('#city').attr('data-validation', 'required');
            $.ajax({
                type: "POST",
                url: "ajax/ajax-cart.php",
                data: {
                    event: 'addSeat',
                    id_product: idProductSeat,
                    qty_product: val
                },
                success: function (response) {
                    $('#contentCart').load('../modules/cart.php');

                    $('header').append(`<div class="alert alert-success cart">added to cart !</div>`);
                    $('.alert-success.cart').delay(2000).fadeOut('slow');
                }
            });
        } else {
            $('#city').attr('data-validation', '');
            deleteSeatIntoCart();
        }


    })


    if ($('#numberSeat').val() == 0) {
        deleteSeatIntoCart();

    }

    /************************************************************** CART **************************************************************/


    $('.add-to-cart').on('click', function (e) {
        e.preventDefault();

        var $btn = $(this);
        var id = $btn.attr('data-id');
        var card = $('#product-' + id);
        var qty = card.find('#qty select').val();
        var colorSelect = card.find('select[data-type="color"]');
        var sizeSelect = card.find('select[data-type="size"]');
        var color = card.find('select[data-type="color"]').val();
        var size = card.find('select[data-type="size"]').val();

        if (colorSelect.length == 0) {
            color = null;
        }
        if (sizeSelect.length == 0) {
            size = null;
        }

        $.ajax({
            type: "POST",
            url: "ajax/ajax-cart.php",
            data: {
                event: 'add',
                id_product: id,
                qty_product: qty,
                color_product: color,
                size_product: size
            },
            success: function (response) {
                $('#contentCart').load('../modules/cart.php');

                $('header').append(`<div class="alert alert-success cart">added to cart !</div>`);
                $('.alert-success.cart').delay(2000).fadeOut('slow');
            }
        });
    });

    $(document).on('click', '.del-to-cart', function () {
        var $btn = $(this);
        var id = $btn.attr('data-id');
        var color = $btn.attr('data-color').length > 0 ? $btn.attr('data-color') : null;
        var size = $btn.attr('data-size').length > 0 ? $btn.attr('data-size') : null;
        $btn.parents('tr').slideUp();

        $.ajax({
            type: "POST",
            url: "ajax/ajax-cart.php",
            data: {
                event: 'del',
                id_del: id,
                color_del: color,
                size_del: size
            },
            success: function (response) {
                $('#contentCart').load('../modules/cart.php');
                $('header').append(`<div class="alert alert-success cart">deleted product !</div>`);
                $('.alert-success.cart').delay(2000).fadeOut('slow');
                if (id == 99) {
                    $("#numberSeat").val("0");
                    $('#numberSeat').change();
                }

            }
        });
    });
$(document).on('submit','#formStudents',function (e) {
    console.log('recaptcha');
                e.preventDefault();
        
                    var widgetId1 = grecaptcha.render('recaptcha_form', {
                        'sitekey': '6LdA4bsUAAAAAMGN5QasHMd8yOj2KvguT_d2sH0y',
                        'callback': onSubmit1,
                        'size': "invisible"
                    });
        
                grecaptcha.reset(widgetId1);
        
                grecaptcha.execute(widgetId1);
        
            });

}); /* END OF READY FUNCTION */
var validator = () => {
    $.validate({
        form: '#formStudents',
        lang: 'en',
        borderColorOnError: '#ff0000',
        modules: 'security',
        onSuccess: function ($form) {
            $('button[type="submit"]').addClass('load');
            console.log('rdy');
            
        }
    });
}

var addBloc = (startIndex, val) => {
    for (let i = startIndex; i <= val; i++) {
        $('#nextUsers').append(`
    <div id='student-${i}' class='col-12 py-20 studentBloc'>
        <h3>นักเรียน คนที่ ${i} (Student n°${i})</h3>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="_prefix${i}" id="mr" value="นาย (Mr)" checked>
            <label class="form-check-label" for="mr">
            นาย (Mr)
            </label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="_prefix${i}" id="mme" value="นางสาว (Miss)">
            <label class="form-check-label" for="mme">
            นางสาว (Miss)
            </label>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="fullName">ชื่อ สกุล (ภาษาไทย) | (Full name)</label>
                <input type="text" class="form-control" id="fullName" name='_fullName${i}' placeholder="" data-validation="required" data-validation-error-msg=" ">
            </div>
            <div class="col-md-6">
                <label for="englishName">ชื่อ สกุล (ภาษาอังกฤษ) | (English name)</label>
                <input type="text" class="form-control" id="englishName" name='_englishName${i}' placeholder="ชื่อ/นามสกุล (ภาษอังกฤษ)" data-validation="required" data-validation-error-msg=" ">
            </div>
        </div>
        <div class="mb-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="_class${i}" id="m3" value="M.3" checked>
                <label class="form-check-label" for="m3">
                ม.3 (M.3)
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="_class${i}" id="m4" value="M.4" >
                <label class="form-check-label" for="m4">
                ม.4 (M.4)
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="_class${i}" id="m5" value="M.5" >
                <label class="form-check-label" for="m5">
                ม.5 (M.5)
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="_class${i}" id="m6" value="M.6" >
                <label class="form-check-label" for="m6">
                ม.6 (M.6)
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="_class${i}" id="other" value="other" ><input type="text" name="_classOther${i}" />
                <label class="form-check-label" for="other">
                อื่น ๆ (Other)
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="schoolName">โรงเรียน (School Name)</label>
                <input type="text" class="form-control" id="schoolName" name='_schoolName${i}' placeholder="" data-validation="required" data-validation-error-msg=" ">
            </div>
            <div class="col-md-6">
                <label for="lineId">ไอดีไลน์ (Line ID)</label>
                <input type="text" class="form-control" id="lineId" name='_lineId${i}' placeholder="" data-validation="required" data-validation-error-msg=" ">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="phoneNumber">เบอร์โทรศัพท์ที่ติดต่อได้ (Phone Number)</label>
                <input type="text" class="form-control" id="phoneNumber" name='_phoneNumber${i}' placeholder="" data-validation="required" data-validation-error-msg=" ">
            </div>
            <div class="col-md-6">
                <label for="email">อีเมล์ (Email)</label>
                <input type="mail" class="form-control" id="email" name='_email${i}' placeholder="">
            </div>
        </div>
    </div>
    `);
    }
    validator();
}

var deleteSeatIntoCart = () => {
    var id = 99;

    $.ajax({
        type: "POST",
        url: "ajax/ajax-cart.php",
        data: {
            event: 'delSeatOnLoad',
            id_del_seat: id,
        },
        success: function (response) {
            if (response == 'true') {
                $('#contentCart').load('../modules/cart.php');
            }

        }
    });
}

var uploadField = document.getElementById("userfile");

uploadField.onchange = function () {
    var ext = this.files[0].name.split('.').pop();
    if (ext != 'jpg' && ext != 'JPG' && ext != 'jpeg' && ext != 'JPEG' && ext != 'png' && ext != 'docx' && ext != 'doc' && ext != 'pdf') {
        alert("wrong file format !");
        this.value = "";
    } else if (this.files[0].size > 2097152) {
        alert("File is too big !");
        this.value = "";
    };

};




var loadJS = function (implementationCode, location, balise) {
    //url is URL of external file, implementationCode is the code
    //to be called from the file, location is the location to 
    //insert the <script> element
    var scriptTag = document.createElement(balise);
    //scriptTag.src = url;

    scriptTag.onload = implementationCode;
    scriptTag.onreadystatechange = implementationCode;

    location.appendChild(scriptTag);
};
var pixelScript = function (pixelKey) {
    !function (f, b, e, v, n, t, s) {
        if (f.fbq) return; n = f.fbq = function () {
            n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
        n.queue = []; t = b.createElement(e); t.async = !0;
        t.src = v; s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', pixelKey);
    fbq('track', 'PageView');
}
var pixelNoScript = function (pixelKey) {
    return '<img height="1" width="1" style="display:none"src="https://www.facebook.com/tr?id=' + pixelKey + '&ev=PageView&noscript=1"/>';
}

function onSubmit1(token) {
    document.getElementById("formStudents").submit();
};