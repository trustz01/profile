<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html">
	<title>Tambah</title>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<style>
		.wrapper{
			padding-top: 50px;
		}
	
		#alert{
			width: 500px;
		}
	</style>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a href="#" class="navbar-brand">Tambah Data</a>
		</div>
		<!--Nav Menu Here-->
		<div class="navbar-collapse collapse" id="navbar">
			<ul class="nav navbar-nav">
				
			</ul>
		</div>
	</div>
</nav>

<div class="wrapper">
	<div class="container">
		<div class="page-header">
			<h1>
				Add new data
			</h1>
		</div>
		

		<div class="col-lg-5">
			<div class="row">
				<div id="alert">
			
				</div>
				<div id="form-content">
					<form method="post" id="reg-form" autocomplete="off">
						<div class="form-group">
							<input type="text" class="form-control" name="txt_nik" id="nik" placeholder="NIK" required/>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="txt_fname" id="fname" placeholder="First Name" required/>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="txt_lname" id="lname" placeholder="Last Name" required/>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="txt_email" id="email" placeholder="Your Mail" required/>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="txt_mobile" id="phone" placeholder="Mobile" required/>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="txt_position" id="position" placeholder="Position" required/>
						</div>
						<div class="form-group">
							<label for="sel1"> Select Divison : </label>
							<select class="form-control" id="sel1" name="txt_division" id="sel1">
								<option>IT Support</option>
								<option>IT Infrastruktur</option>
								<option>IT Electronic Data Processing</option>
								<option>IT Solution</option>
							</select>
						</div>
						<hr/>

						<div class="form-group">
							<button class="btn btn-primary">
								Submit
							</button>

							&nbsp; &nbsp;
							<a href="admin.php">View all Data</a>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="../assets/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>

<script type="text/javascript">

	$(document).ready(function(){// script akan dijalankan setelah page selesai di load

	//submit form dengan $.ajax() method
	$('#reg-form').submit(function(e){//submit form dengan id reg-form
		e.preventDefault(); //Prevent Default Submission

		$.ajax({

			url:'submit.php',//url target
			type:'POST',//tipe
			data:$(this).serialize()//mengambil semua data dari form
		}).done(function(data){
			$('#alert').html(data);
			$(':input').val(''); //clean form
		})
		.fail(function(){
			alert('Ajax Failed');
		});
	});

	});
</script>

</body>
</html>