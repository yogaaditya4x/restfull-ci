<html>
<head>
	<title>Web FrameWork</title> 
	<script src="<?php echo base_url('praktik/restfull-ci/asset/jquery.min.js') ?>"></script>
	<link rel="stylesheet" href="<?php echo base_url('praktik/restfull-ci/asset/icon.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('praktik/restfull-ci/asset/bootstrap.min.css') ?>" />
	<script src="<?php echo base_url('praktik/restfull-ci/asset/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('praktik/restfull-ci/asset/popper.min.js') ?>"></script>
	<link src="<?php echo base_url('praktik/restfull-ci/asset/all.css') ?>" integrity="sha384-
	UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
	crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<br />
		<h3 align="center">Web FrameWork</h3>
		<br />
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-6">
						<h3 class="panel-title">Webservice REST API in Codeigniter</h3>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<span id="success_message"></span>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>NIM</th>
							<th>Nama</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				<div class="col-md-13" align="right">
					<button type="button" id="add_button" class="btn btn-info "> <i class="materialicons" style="font-size:15px">add_circle</i> Add</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Data</h4>
				</div>
				<div class="modal-body">
					<label>Masukkan NIM</label>
					<input type="text" name="nim" id="nim" class="form-control" />
					<span id="nim_error" class="text-danger"></span>
					<br />
					<label>Masukkan Nama Lengkap</label>
					<input type="text" name="nama" id="nama" class="form-control" />
					<span id="nama_error" class="text-danger"></span>
					<br />
				</div>
				<div class="modal-footer">
					<!-- <input type="hidden" name="user_id" id="user_id" /> -->
					<input type="hidden" name="data_action" id="data_action" value="Insert" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add"
					/>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript" language="javascript" >
	$(document).ready(function(){
		function fetch_data()
		{
			$.ajax({
				url:"<?php echo base_url(); ?>praktik/restfull-ci/test_api/action",
				method:"POST",
				data:{data_action:'fetch_all'},
				success:function(data)
				{
					$('tbody').html(data);
				}
			});
		}
		fetch_data();
		$('#add_button').click(function(){
			$('#user_form')[0].reset();
			$('.modal-title').text("Add User");
			$('#action').val('Add');
			$('#data_action').val("Insert");
			$('#userModal').modal('show');
		});
		$(document).on('submit', '#user_form', function(event){
			event.preventDefault();
			$.ajax({
				url:"<?php echo base_url() . 'praktik/restfull-ci/test_api/action' ?>",
				method:"POST",
				data:$(this).serialize(),
				dataType:"json",
				success:function(data)
				{
					if(data.success)
					{
						$('#user_form')[0].reset();
						$('#userModal').modal('hide');
						fetch_data();
						if($('#data_action').val() == "Insert")
						{
							$('#success_message').html('<div class="alert alert-success">Data Inserted</div>');
						}
					}
					if(data.error)
					{
						$('#nama_error').html(data.nama_error);
						$('#nim_error').html(data.nim_error);
					}
				}
			})
		});
		$(document).on('click', '.edit', function(){
			document.getElementById('nim').readOnly = true;
			var nim = $(this).attr('id');
			$.ajax({
				url:"<?php echo base_url(); ?>praktik/restfull-ci/test_api/action",
				method:"POST",
				data:{nim:nim, data_action:'fetch_single'},
				dataType:"json",
				success:function(data)
				{
					$('#userModal').modal('show');
					$('#nim').val(data.nim);
					$('#nama').val(data.nama);
					$('.modal-title').text('Edit Data');
 // $('#user_id').val(user_id);
 $('#action').val('Edit');
 $('#data_action').val('Edit');
}
})
		});
		$(document).on('click', '.delete', function(){
			var nim = $(this).attr('id');
			if(confirm("Are you sure you want to delete this?"))
			{
				$.ajax({
					url:"<?php echo base_url(); ?>praktik/restfull-ci/test_api/action",
					method:"POST",
					data:{nim:nim, data_action:'Delete'},
					dataType:"JSON",
					success:function(data)
					{
						if(data.success)
						{
							$('#success_message').html('<div class="alert alert-success">Data Deleted</div>');
							fetch_data();
						}
					}
				})
			}
		});

	});
</script>