 $(document).ready(function() {

    // calculator functional goes here
     $('#calculatorModal').on('hidden.bs.modal', function() {

         $(".price-details").html('');
         $(this).removeClass('results');
         $(this).find('input[type="text"]').val('');
     });


     $('#calculatorModal .bot-actions .btn-again').on('click', function(e) {
         e.preventDefault();
         $(".price-details").html('');
         $(this).parents('.modal').removeClass('results');
         $(this).parents('.modal').find('input[type="text"]').val('');
     });

     //onclicking the calculate button we will perform the follwoing task
     $(".calculate_button").click(function(event) {
         event.preventDefault();
         $('#calculatorModal').addClass('results');
         //application logic goes here
         $(".price-details").html(function() {
             var usd_price = Number($("[name='usd_price']").val()), //no need to change it
                 weight = Number($("[name='weight']").val()), //no need to change it
                 custom_price = 0, //no need to change it
                 shipping_charge = 0, //no need to change it
                 fees = 5, //change it if you want
                 usd2jod = 0.71, //change it if you want
                 sales_tax = usd_price * 0.16; //change it if you want. its just the ammount of tax

             if (usd_price > 50) { //you can set it as your wish
                 custom_price = usd_price * 0.3; //you can set it as your wish
             }
             if (weight <= 0.5) {
                 shipping_charge = 12; //you can set it as your wish
             } else if (weight == 1) { //you can set it as your wish
                 shipping_charge = 20; //you can set it as your wish
             } else if (weight > 1) { //you can set it as your wish
                 shipping_charge = 20 + (weight - 1) * 2 * 9; //extra 9 dollar for each half to the main price
             }
             var total_price_usd = usd_price + custom_price + shipping_charge + fees + sales_tax;
             var total_price_jod = total_price_usd * 0.71;



             /***
              * NOTE: calculation process is completed here
              * so you can now use the above variables to your desired 
              * application. just use the above variables.
              * But if you want only two digits after the decimal point
              * then use the given bellow exmaple.
              * Here,
              * the variables are "usd_price, weight, custom_price, shipping_charge, fees, salse_tax, total_price_usd, total_price_jod"
              * 
              * The script must be processed first. and then you can use it to your application.
              */

             return "<div class='calculator-nav'>\
                      </div>\
                      <div class='price-details-container active'>\
                        <div class='price-details-box'>\
                          <div class='row calc-row'>\
                            <div class='col-xs-9'><b>Item Price:</b></div>\
                            <div class='col-xs-3 align-right'>$" + usd_price.toFixed(2) + "</div>\
                          </div>\
                          <div class='row calc-row'>\
                            <div class='col-xs-9'><b>Sales Tax (16%):</b></div>\
                            <div class='col-xs-3 align-right'>$" + sales_tax.toFixed(2) + "</div>\
                          </div>\
                          <div class='row calc-row'>\
                            <div class='col-xs-9'><b>Customs:</b></div>\
                            <div class='col-xs-3 align-right'><span class='red'><b>$" + custom_price.toFixed(2) + "</b></span></div>\
                          </div>\
                          <div class='row calc-row'>\
                            <div class='col-xs-9'><b>International Shipping:</b></div>\
                            <div class='col-xs-3 align-right'>$" + shipping_charge.toFixed(2) + "</div>\
                          </div>\
                          <div class='row calc-row'>\
                            <div class='col-xs-9'><b>Fees:</b></div>\
                            <div class='col-xs-3 align-right'>$" + fees.toFixed(2) + "</div>\
                          </div>\
                          <div class='row calc-row'>\
                            <div class='col-xs-9'><b>USD to JOD Rate:</b></div>\
                            <div class='col-xs-3 align-right'>" + usd2jod.toFixed(2) + "</div>\
                          </div>\
                          <div class='row calc-row'>\
                            <div class='col-xs-8'><b>Total Price:</b></div>\
                            <div class='col-xs-4 align-right'><b>" + total_price_jod.toFixed(2) + " JOD</b></div>\
                          </div>\
                      </div>";
         });
     });
 });