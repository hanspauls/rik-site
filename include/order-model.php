<!-- Modal -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            	<form id="product-add" action="order.php" method="post">
	                <div class="modal-body">
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                    <div class="row">
	                        <div class="col-md-12">
	                            
	                            <div class="form-group">
	                                <label for="product-item">Product Item</label>
	                                <input class="form-control" type="url" name="product_url" required id="product-item" placeholder="http://www.amazon.com/gp/product/B00EOE0WKQ">
	                            </div>
	                            <div class="form-group">
	                                <label for="quantity">How many do you need?</label>
	                                <ul class="quantity-wrap clearfix">
	                                    <li class="active">
	                                        <a href="#" class="one-slot" data-quantity="1">
	                                          1
	                                        </a>
	                                    </li>
	                                    <li>
	                                        <a href="#" class="one-slot" data-quantity="2">
	                                          2
	                                        </a>
	                                    </li>
	                                    <li>
	                                        <a href="#" class="one-slot" data-quantity="3">
	                                          3
	                                        </a>
	                                    </li>
	                                    <li>
	                                        <a href="#" class="one-slot" data-quantity="4">
	                                          4
	                                        </a>
	                                    </li>
	                                    <li>
	                                        <a href="#" class="one-slot" data-quantity="5">
	                                          5
	                                        </a>
	                                    </li>
	                                </ul>
	                                <input class="hidden" id="quantity-input" name="quant" value="1">
	                            </div>
	                            <div class="form-group">
	                                <label for="spec">Is there a specific size, color or style, or anything you'd like to let us know about this product?</label>
	                                <textarea class="form-control" id="spec" id="product_extras" name="product_extras" placeholder="e.g. (Color: Red; Size: Small;)"></textarea>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                	<input value="0" name="edit" id="edit" type="hidden"/>
	                	<input value="" name="edit_id" id="edit_id" type="hidden"/>
	                    <button type="submit" class="btn btn-primary add-btn">Add</button>
	                </div>
                </form>
            </div>
        </div>
    </div>