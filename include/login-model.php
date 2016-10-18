<!-- Modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            	<form id="signup" action="login.php" method="post">
	                <div class="modal-body">
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                    <div class="row">
	                        <div class="col-md-12">
	                            <h3>Login Below</h3>
                                <div class="form-group">
                                    <label>
                                        Email *
                                        <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
                                    </label>
                                    <input type="text" name="email" id="email" size="30" value="" required class="text login_input form-control" placeholder="Email Address">
                                    <div class="clearfix"></div>
                                </div>
                        		<div class="form-group">
                                    <label>
                                        Password
                                        <span class="glyph-item icon-arrow-right" aria-hidden="true"></span>
                                    </label>
                                    <input type="password" name="password" id="password" required size="30" value="" class="text login_input form-control" placeholder="Mobile number">
                                </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="modal-footer">
	                	<input type="hidden" name="login_model" value="1"/>
	                    <input type="submit" value="Login" name="login_process" class="btn btn-primary add-btn" />
	                </div>
                </form>
            </div>
        </div>
    </div>