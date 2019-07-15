$(document).on('click', function(){
     $(".myPopup").removeClass("show");
});

function addToCart(productId) {
    quantity = $('#quantity-' + productId).val();
    var getUrl = window.location;
    var rootUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    $.ajax({
        type: 'post',
        url: rootUrl + "/products/add",
        data: {
            'id': productId,
            'quantity': quantity,
        },
        dataType: 'json',
        success: function (data) {
            // According to status we create a pop-up for with the message;
            $("#myPopup-" + productId).addClass("show");
        },
        error: function (data) {
            alert('Eroare interna! Incercati din nou!');
        }
    })
}

function submitCart(productId) {
    var getUrl = window.location;
    var rootUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
    var quantity = $('#quantity-' + productId).val();
    var price = $('#product-price-' + productId).text();
    // M: TODO: Break the url;
    $.ajax({
        type: 'post',
        url: rootUrl + "/products/change",
        data: {
            'id': productId,
            'quantity': quantity
        },
        dataType: 'json',
        success: function (data) {
            if (data.data == 0) {
                window.location.reload();
                return;
            }
            if (quantity == 0) {
                $('#product-' + productId).remove();
            } else {
                $('#subtotal-' + productId).html(quantity * price);
            }
            $('td[name=total-sum]').html('<strong>Total: $' + data.data + '</strong>');
        },
        error: function (data) {
            alert('Eroare interna! Incercati din nou!');
        }
    })
}