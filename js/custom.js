/**
 * handling Custom Jquery and Javascript Featuers
 * @author Nadeem <www.webtechapps.com>
 */
 
 $('document').ready(function(){
 	// deleting item from the cart
 	$('.order-delete.order-onl-del').click(function(){
 		var thisId = $(this).attr('id');
 		if(confirm("Are you sure you want to delete this Link?")){
			thisId = thisId.split("-");
	 		thisId = thisId[1];
	 		$.ajax({
	            type: "POST",
	            url: "ajax-requests/handle-ajax.php",
	            data: {"updatecart":1, orderId: thisId}
	        })
	        .done(function(data) {
	            if(data == "ok"){
					$('#list_num_'+thisId).fadeOut();
				}
	        })
	        .fail( function(xhr, textStatus, errorThrown) {
	            alert("Error Occured, Please try again later.");
	        });
	        return false;	
		}
 	});	
 	
 	// deleting item from the Edit cart 
 	$('.order-delete.edit-del').click(function(){
 		var thisId = $(this).attr('id');
 		if(confirm("Are you sure you want to delete this Link?")){
 			
			thisId = thisId.split("-");
	 		thisId = thisId[1];
	 		$.ajax({
	            type: "POST",
	            url: "../ajax-requests/handle-ajax.php",
	            data: {"updatecartEdit":1, orderId: thisId, orderIdOrig: $('#list_prodcut_id_'+thisId).val()}
	        })
	        .done(function(data) {
				$('#list_num_'+thisId).fadeOut();
	        })
	        .fail( function(xhr, textStatus, errorThrown) {
	            alert("Error Occured, Please try again later.");
	        });
	        return false;	
		}
 	});	
 	
 	//order page, update URL field on show add-model 
 	$('#add-modal').on('shown.bs.modal', function() {
        //$('#add-modal #product-item').val($('.url_data').val());
    });
 	//order page, update URL field on hide add-model 
 	$('#add-modal').on('hidden.bs.modal', function() {
	 	$('#add-modal #edit').val("0");
	 	$('#add-modal #edit_id').val("");
	 	$('#add-modal #product-item').val("");
	 	$('#add-modal textarea').text("");
	 	$('#add-modal .quantity-wrap li').removeClass("active");
	 	$('#add-modal .quantity-wrap li:eq( 0 )').addClass("active");
    });
    
    // closing a message box when clicked on the x button
    $('.close-error i').click(function(){
    	$(this).closest('.message-box').fadeOut();
    });
    
    // order edit, onclick show model
    $('button.order-edit').click(function(){
    	var thisId = $(this).attr('id');
    	thisId = thisId.split("-");
	 	thisId = thisId[1];
	 	var quant = parseInt($('#list_quant_info_'+thisId).val());
	 	
	 	$('#add-modal #edit').val("1");
	 	$('#add-modal #edit_id').val(thisId);
	 	$('#add-modal .quantity-wrap li').removeClass("active");
	 	$('#add-modal .quantity-wrap li:eq( '+(quant-1)+' )').addClass("active");
	 	
	 	$('#add-modal #product-item').val($('#list_url_info_'+thisId).val());
	 	$('#add-modal textarea').text($('#list_extra_info_'+thisId).val());
	 	$('#add-modal #quantity-input').val(quant);
    	$('#add-modal').modal();
    });
 });