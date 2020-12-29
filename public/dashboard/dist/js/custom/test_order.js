$(document).ready(function(){

    //add product btn

    $('.add-product-btn').on('click',function (e) {

        e.preventDefault();

        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $.number($(this).data('price'), 2);

        $(this).removeClass('btn-success').addClass('btn-default disabled');


    // <input type="hidden" name="product_ids[]" value="${id}">

        var  html =

            `<tr> 
           <td>${name}</td> 
           <td><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
           <td class="product-price">${price}</td>
           <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button> </td>
           </tr>`;

        $('.order-list').append(html);

        // to calculate total price
        calculateTotal();


    });

    // disabled btn

    $('body').on('click','.disabled',function (e) {

        e.preventDefault();
    });

    //remove product btn

    $('body').on('click','.remove-product-btn',function (e) {

        e.preventDefault();
        var id = $(this).data('id');

        $(this).closest('tr').remove();
        $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');

        // to calculate total price
        calculateTotal();

    }); // end remove

    //chang product quantity

    $('body').on('keyup change', '.product-quantity',function () {

        var quantity = parseInt($(this).val());//2
        var unitPrice = parseFloat($(this).data('price').replace(/,/g, ''));//150

        $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice , 2));

        calculateTotal();

    });

    $('.order-products').on('click',function (e) {

        e.preventDefault();

        $('#loading').css('display','flex');

        var url = $(this).data('url');
        var method = $(this).data('method');


        $.ajax({

            url: url,
            method: method,
            success: function (data) {

                $('#loading').css('display','none');
                $('#order-product-list').empty();
                $('#order-product-list').append(data);

            }
        })

        
    });//end of order products click

    //print order
    $(document).on('click','.print-btn', function () {

        $('#print-area').printThis();
    });


}); // end document


// calculate total
function calculateTotal() {

    var price = 0;

    $('.order-list .product-price').each(function (index) {

        price += parseFloat($(this).html().replace(/,/g, ''));


    }); // end of product price

    $('.total-price').html($.number(price , 2));


    if ( price > 0 ) {



        $('#add-order-form-btn').removeClass('disabled')


    }

    else {

        $('#add-order-form-btn').addClass('disabled')

    }

}


