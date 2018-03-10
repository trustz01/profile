<?php
 session_start();

if (!isset($_SESSION['mysesi']) || $_SESSION['mytype']!='admin')
{
	header('Location: ../login/index.php');
	exit;
  // echo "<script>window.location.assign('../login/index.php')</script>";
} 
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Admin</title>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>

<div class="container">
	<div class="page-header">
		<h3>Admin Panel</h3>
	</div>

	<form action="tambah.php">
	<button type="submit" class="btn btn-primary" style="float:left;">Tambah Data</button>
	</form><br/>

	<form action="../login/index.php">
	<button type="submit" class="btn btn-link" style="float:right;">Logout</button>
	</form><br/>
   
	<div class="row">
		<div class="col-lg-12">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>NIK</th>
						<th>Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					include "dbconfig.php";

					$sql = "SELECT * FROM biodata_it";
					$data = $conn->query($sql);
					while($row = $data->fetch_array()){
            
					 ?>
					 <tr>
					 	<td><?php echo $row['nik']."&nbsp;";?>
					 	</td>

					 	<td>
					 		<?php echo $row['fname']."&nbsp;".$row['lname'];?>
					 	</td>

					 	<td>
					 		<button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $row['id'];?>" id="getUser" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-envelope"> </i>View</button>&nbsp;

                            <button data-id="<?php echo $row['id'];?>" class="btn btn-sm delete_product"><i class="glyphicon glyphicon-trash"></i>Delete</button>&nbsp;

					 		<a role="button" href="#" class='open_modal btn btn-sm btn-primary' id='<?php echo  $row['nik']; ?>'> <i class="glyphicon glyphicon-pencil"></i> Edit</a>&nbsp;
        			 	</td>
						</tr>
					 <?php
					}
					?>
					
				</tbody>
			</table>
		</div>
	</div>

	<!-- Modal Popup untuk Edit--> 
	<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>

	<!-- Modal VIEW -->
	<div class="modal fade" id="view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: :none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
					<h4 class="modal-title">
	                	<i class="glyphicon glyphicon-user"></i> User Profile
	                </h4> 
				</div>
				<div class="modal-body">
					<div id="modal-loader" style="display: none; text-align: center;">
						<img src="">
					</div>
					
					<!--Content will be loaded here-->
					<div id="dynamic-content">
						<!-- Kalo Data Type JSON-->
					  <div class="row"> 
                            <div class="col-md-12"> 
                            	
                            	<div class="table-responsive">
                            	
                                <table class="table table-striped table-bordered">
                           		
                           		<tr>
                            	<th>NIK</th>
                            	<td id="txt_nik"></td>
                                </tr>

                           		<tr>
                            	<th>First Name</th>
                            	<td id="txt_fname"></td>
                                </tr>
                                     
                                <tr>
                            	<th>Last Name</th>
                            	<td id="txt_lname"></td>
                                </tr>
                                       		
                                <tr>
                                <th>Email</th>
                                <td id="txt_email"></td>
                                </tr>
                                       		
                                <tr>
                                <th>Mobile</th>
                                <td id="txt_mobile"></td>
                                </tr>

                                <tr>
                                <th>Position</th>
                                <td id="txt_position"></td>
                                </tr>

                                <tr>
                                <th>Division</th>
                                <td id="txt_division"></td>
                                </tr>
                                       		
                                </table>
                                
                                </div>
                                       
                            </div> 
                          </div>
                         <!--End Tabel Data Type JSON-->

					</div>

				</div>
			</div>
		</div>
	</div>


<script src="../assets/jquery-1.12.4.min.js"></script>
<script src="../assets/jquery-3.3.1.js"></script>
<script src="../assets/js/bootstrap.min.js(2).download"></script>
<script src="../assets/bootbox.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','#getUser', function(e){
		e.preventDefault();
		var uid = $(this).data('id');
		$('#dynamic-content').hide();

		$.ajax({
			type:'POST',
			url:'submit2.php',
			data:{id:uid},
			dataType:'json'
		}).done(function(data){
			console.log(data);
			$('#dynamic-content').show(); // show dynamic div
			$('#txt_nik').html(data.nik);
			$('#txt_fname').html(data.fname);
			$('#txt_lname').html(data.lname);
			$('#txt_email').html(data.email);
			$('#txt_mobile').html(data.phone);
			$('#txt_position').html(data.position);
			$('#txt_division').html(data.division);

		}).fail(function(){

			$('.modal-body').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
		});
	});
});
</script>

<!--Delete JavaScript-->

<script>
	$(document).ready(function(){
		
		$('.delete_product').click(function(e){
			
			e.preventDefault();
			
			var pid = $(this).attr('data-id');
			var parent = $(this).parent("td").parent("tr");
			
			bootbox.dialog({
			  message: "Are you sure you want to Delete ?",
			  title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
			  buttons: {
				success: {
				  label: "No",
				  className: "btn-success",
				  callback: function() {
					 $('.bootbox').modal('hide');
				  }
				},
				danger: {
				  label: "Delete!",
				  className: "btn-danger",
				  callback: function() {
					  
					  
					  $.post('delete.php', { 'delete':pid })
					  .done(function(response){
						  bootbox.alert(response);
						  parent.fadeOut('slow');
					  })
					  .fail(function(){
						  bootbox.alert('Something Went Wrong ....');
					  })
					  					  
				  }
				}
			  }
			});
			
			
		});
		
	});
</script>


<!-- Edit JavaScript --> 

<script type="text/javascript">
   $(document).ready(function () {
   $(".open_modal").click(function(e) {
      var m = $(this).attr("id");
		   $.ajax({
    			   url: "modal_edit.php",
    			   type: "GET",
    			   data : {nik: m,},
    			   success: function (ajaxData){
      			   $("#ModalEdit").html(ajaxData);
      			   $("#ModalEdit").modal('show',{backdrop: 'true'});

				}

    		   });
        });
      });
</script>

</body>
</html>