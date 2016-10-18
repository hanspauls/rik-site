$('.one-slot').on('click', function(e) {
    var dataQuantity = $(this).data('quantity');
    console.log(dataQuantity);
    e.preventDefault();
    $('.one-slot').parent('li').removeClass('active');
    $(this).parent('li').addClass('active');
    $('#quantity-input').val(dataQuantity);
    console.log($('#quantity-input').val());
});

function isUrlValid(url) {

    var myVariable = url;
    if (/^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(myVariable)) {
        return 1;
    } else {
        return -1;
    }
}


$('#subscribe_email').on('paste', function(ev) {
    var _this = $(this);

    setTimeout(function() {
        var $thisValue = _this.val();
        $('#product-item').val($thisValue);
        if ($('#subscribe').valid()) {
            $('#add-modal').modal();
        }

    }, 500);

});


