<!-- Modal -->
    <div id="calculatorModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-custom">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal-begeeb-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Calculator</h4>
                    <h4 class="modal-title when-results">Price Details</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <br />
                        <div class="col-md-12 well">
                            <h4 class="mgt0">Your calculator title</h4>
                            <!--<div id="calculator_error_explanation"></div>-->
                            <form action="/en/update_calculator" method="post">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group"> <span class="input-group-addon" id="calc-item-price">$</span>
                                                <input aria-describedby="calc-item-price" autocomplete="off" class="form-control input-xlg calc-input" name="usd_price" placeholder="Item&#39;s Price" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="input-group"> <span class="input-group-addon" id="calc-item-weight">KG</span>
                                                <input aria-describedby="calc-item-weight" autocomplete="off" class="form-control input-xlg" name="weight" placeholder="Item Weight in KG" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="calculate_button btn btn-one btn-block btn-xlg mgb12 " type="submit"> <i class="fa fa-calculator"></i> </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <br />
                            <div class="price-details"> </div>
                            <div class="when-results bot-info row">
                                <div class="col-sm-12">
                                    <p class="small">* Additional clearence charge might apply based on the item category:</p>
                                    <ul>
                                        <li>
                                            <p class="small">Wireless/Mobile: $35 to get an approval from the ministry of communincations</p>
                                        </li>
                                        <li>
                                            <p class="small">Supplement or medical equipment: $20 to get an approval from the ministry of health</p>
                                        </li>
                                    </ul>
                                    <p class="small">** There are no additional costs when you receive your order.</p>
                                </div>
                                <div class="col-sm-12 bot-actions">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-small btn-primary btn-again">Calculate Again</a>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-small btn-primary btn-subscribe">Subscribe</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal body-->
                <!--  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
            </div>
        </div>
    </div>
    <div class="clearfix"></div>