<html>
<head>
	<title>Unslise</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header class='top-header'>
		<span class='menu-m-show'>&ensp;</span>
		<span class='logo-m-wrap'><a href="index.html">&ensp;</a></span>
		<div class='right' id='user-nav-m'>
			<span class='userIco'><img src="images/profileImg.jpeg"></span> 
			<span class='userText'>mickael.costache@gmail.com</span>
		</div>
	</header>
	<aside id='sidebar'>
		<div id='logo-wrap'>
			<a href="index.html">&ensp;</a>
		</div>
		<nav id='main-nav'>
			<ul id='nav-ul'>
				<li><a href="team.html" class='team'>Team</a></li>
				<li><a href="new-orders.php" class='question'>Questions</a></li>
				<li><a href="reports.html" class='reports'>Reports</a></li>
				<li class='active'><a href="settings.php" class='settings'>Account Settings</a></li>
				<li><a href="billing.html" class='billing'>Billing</a></li>
				<li><a href="help.html" class='info'>Help</a></li>
			</ul>
		</nav>
	</aside>
	<section id='main-content'>
		<header id='main-head-wrap'>
			<div class='bold18 left' id='user-st'>Happy Sunday, Mickael!</div>
			<div class='right' id='user-nav'>
				<span class='userIco'><img src="images/userIco.png"></span> 
				<span class='userText'>mickael.costache@gmail.com</span>
			</div>
		</header>
		<div id='content-wrap'>
			<div class='large-content'>
				<div class='content-head'>
					Account settings
				</div>
				<div class='contents'>
					<div class='content-box padding'>
						<form action='' class='full-width'>
							<div class='field'>
								<label>First name</label>
								<input type='text' placeholder='First Name' value=''>
							</div>
							<div class='field'>
								<label>Last name</label>
								<input type='text' placeholder='Last Name' value=''>
							</div>
							<div class='field'>
								<label>Email</label>
								<input type='email' placeholder='name@example.com' value=''>
							</div>
							<div class='sep15'></div>
							<div class='field'>
								<label>Password</label>
								<input type='password' class='small-input hide' id='password'>
								<span id='pass-hint'>********* </span>
								<button onclick='showPassField()' type='button' class='btn btn-grey btn-smaller' id='pass-btn'>Change</button>
							</div>
							<div class='sep25'></div>
							<div class='field'>
								<label class='label-top'>Picture</label>
								<input type='file' class='small-input hide' id='file'>
								<span id='file-hint'>
									<img src="images/user.png">
								</span>
								<button onclick='showFileField()' type='button' class='btn btn-grey btn-smaller centered' id='file-btn'>Change</button>
							</div>
							<div class='sep15'></div>
							<div class='field'>
								<label>Title</label>
								<input type='text' placeholder='Enter Title' value=''>
							</div>
							<div class='sep25'></div>
							<div class='button-wrap'>
								<button type='submit' class='btn btn-green'>Save</button>
								<div class='clear'></div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer></footer>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
	function showPassField()
	{
		$('#password').removeClass('hide');
		$('#pass-hint').addClass('hide');
		$('#pass-btn').addClass('hide');
	}
	function showFileField()
	{
		$('#file').removeClass('hide');
		$('#file-hint').addClass('hide');
		$('#file-btn').addClass('hide');
	}
	</script>
	<script type="text/javascript">
	function menuHide(){
		windowsize = $(window).width();
	  	if (windowsize < 1024)
	  	{
	  		$("#main-nav").hide();
			$('#main-content').css('margin-left','0px');
			$('body').css('overflow','auto');
	  	}
	}
	function menuShow(){
		windowsize = $(window).width();
	  	if (windowsize < 1024)
	  	{
			$("#main-nav").show();
			$('#main-content').css('margin-left','240px');
			$('body').css('overflow','hidden');
	  	}
	}
	$(document).mouseup(function (e)
	{
	    var container = $("#main-nav");
	    var container2 = $('.menu-m-show');

	    if (!container.is(e.target) // if the target of the click isn't the container...
	        && container.has(e.target).length === 0 && !container2.is(e.target)) // ... nor a descendant of the container
	    {
	        //container.hide();
	        menuHide();
	    }
	});
	$('.menu-m-show').click(function(){
		if($("#main-nav").css('display') == 'none')
		{
			menuShow();
		}
		else
		{
			menuHide();
		}	
		//$('#main-nav').toggle();
		
	});
	var windowsize = $(window).width();

	$(window).resize(function() {
	  windowsize = $(window).width();
	  if (windowsize > 1024) {
	    //if the window is greater than 440px wide then turn on jScrollPane..
	      $('#main-nav').css('display','block');
	      $('body').css('overflow','auto');
	      $('#main-content').css('margin-left','240px');
	  }
	  if (windowsize < 1024) {
	    //if the window is greater than 440px wide then turn on jScrollPane..
	      $('#main-nav').css('display','none');
	      $('body').css('overflow','auto');
	      $('#main-content').css('margin-left','0px');
	  }
	});
	</script>
</body>
</html>