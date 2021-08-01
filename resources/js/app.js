require('./bootstrap');


$(document).ready(function (){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   let productsList = function () {

   }

    $('#createBtn').click(function () {
        if(validateCreateForm()) {
            $('#inputError').text("");

            $.ajax({
                url: '/products',
                type: 'post',
                dataType: 'json',
                data: $('#createProductForm').serialize(),
                success: function (data) {
                    const pName = data.name;
                    const pPrice = Number.parseFloat(data.price).toFixed(2);
                    const pId = data.id;
                    $('#closeBtn').trigger('click');
                    $('#productsTable > tbody:last-child').append(`<tr><td>${pName}</td><td>${pPrice} kr.</td><td><a class="del-product-action" href="javascript:;" data-product-id="${pId}">Delete</a></td></tr>`);
                }
            });
        }else {
            $('#inputError').text("Please fill both fields with appropriate values");
        }
    });

    $(document).on('click','.del-product-action',function () {
        var pId = $(this).attr('data-product-id');
        var rowToBeDeleted = $(this).parent().parent();
        $.ajax({
            url: "/products/".concat(pId),
            type: 'delete',
            success: function success() {
                $(rowToBeDeleted).remove();
            },
            error: function error(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    })


    function validateCreateForm() {
        const nameValue = $('#formInputName').val();
        const priceValue = $('#formInputPrice').val();
        return !isNaN(priceValue) && priceValue > 0 && nameValue && nameValue.length !== 0;

    }

});

