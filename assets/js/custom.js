$(document).ready(function() {
    var cart = []; 

    $('.increment-btn').click(function(e) {
        e.preventDefault();
        var quantityInput = $(this).siblings('.input-quantity');
        var quantity = parseInt(quantityInput.val(), 10);
        quantity = isNaN(quantity) ? 0 : quantity;

        if (quantity < 10) {
            quantity++;
            quantityInput.val(quantity);
        }
    });

    $('.decrement-btn').click(function(e) {
        e.preventDefault();
        var quantityInput = $(this).siblings('.input-quantity');
        var quantity = parseInt(quantityInput.val(), 10);
        quantity = isNaN(quantity) ? 0 : quantity;

        if (quantity > 0) {
            quantity--;
            quantityInput.val(quantity);
        }
    });

    $(document).ready(function() {
        calculateTotalAmount();
    
        function calculateTotalAmount() {
            var totalAmount = 0;
            $('.net-amount').each(function() {
                totalAmount += parseFloat($(this).text());
            });
            $('#totalAmount').text(totalAmount.toFixed(2));
        }
    
        $('.btn-primary').click(function(e) {
            e.preventDefault();
            var button = $(this);
            var productId = button.val();
            var quantity = button.siblings('.input-quantity').val();
    
            $.ajax({
                url: 'add_to_sales',
                method: 'POST',
                data: { product_id: productId, quantity: quantity },
               
            success: function(response) {
            if (response.success) {
            $('#salesTable').append(response.row);
             alert(response.message);
        calculateTotalAmount();
    } else {
        
    }

                },
                error: function() {
                    alert('An error occurred.');
                }
            });
        });
    
        $(document).on('click', '.delete-btn', function() {
            var itemId = $(this).data('id');
            var row = $(this).closest('tr');
    
            $.ajax({
                url: 'delete_sale_item',
                method: 'POST',
                data: { item_id: itemId },
                success: function(response) {
                    response = JSON.parse(response);
    
                    if (response.success) {
                        row.remove();
                        alert(response.message);
                        calculateTotalAmount();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('An error occurred.');
                }
            });
        });
    });  

});


