<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com    @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Simple email inbox page - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Datatable CSS -->
	<link href='https://cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.css' rel='stylesheet' type='text/css'>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row">
	<!-- BEGIN INBOX -->
	<div class="col-md-12">
		<div class="grid email">
			<div class="grid-body">
				<div class="row">
					<!-- BEGIN INBOX MENU -->
					<div class="col-md-3">
						<h2 class="grid-title"><i class="fa fa-inbox"></i> Inbox</h2>
						<!--<a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i>&nbsp;&nbsp;NEW MESSAGE</a>-->
						<hr>

					</div>
					<!-- END INBOX MENU -->
					
					<!-- BEGIN INBOX CONTENT -->
					<div class="col-md-9">

						<div class="padding"></div>
						
						<div class="table-responsive">
						<!-- Table -->
						<table id='empTable' class='display dataTable'>
						<thead>
								<tr>
									<th>Id</th>
									<th>Name</th>
									<th>Subject</th>
									<th>Time</th>
								</tr>
							</thead>
						</table>						
					</div>
					<!-- END INBOX CONTENT -->
					
					<!-- BEGIN COMPOSE MESSAGE -->
					<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-wrapper">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-blue">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h4 class="modal-title"><i class="fa fa-envelope"></i> Compose New Message</h4>
									</div>
									<form action="#" method="post">
										<div class="modal-body">
											<div class="form-group">
												<input name="to" id="to" type="email" class="form-control" placeholder="To">
											</div>
											<div class="form-group">
												<input name="subject" id="subject" type="text" class="form-control" placeholder="Subject">
											</div>
											<div class="form-group">
												<textarea name="message" id="email_message" class="form-control" placeholder="Message" style="height: 120px;"></textarea>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
											<button type="submit" id="send" class="btn btn-primary pull-right"><i class="fa fa-envelope"></i> Send Message</button>
										</div>
									</form>
								</div>
								<div id="result"></div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="subject">title</h5>
							</div>
							<div class="modal-body">
								<div id="body"></div>
								<input id="id_email" name="id_email" type="hidden">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary" id="btn-confirm">Delete message!</button>
							</div>
							</div>
						</div>
					</div>
					<div class="modal fade bd-example-modal-lg" id="loading" data-backdrop="static" data-keyboard="false" tabindex="-1">
						<div class="modal-dialog modal-sm">
							<div class="modal-content" style="width: 48px">
								<span class="fa fa-spinner fa-spin fa-3x"></span>
							</div>
						</div>
					</div>

					<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Are you sure to delete the message?</h4>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" id="delete">Yes</button>
								<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
							</div>
							</div>
						</div>
					</div>
					<!-- /.modal -->
					<!-- END COMPOSE MESSAGE -->

				</div>
			</div>
		</div>
	</div>
	<!-- END INBOX -->
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
	<script type="text/javascript" language="javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"></script>

<!-- BS JavaScript -->
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"></script>
<!-- Have fun using Bootstrap JS -->
<script type="text/javascript">
$(document).ready(function(){
	$('#loading').modal("show");
	$.post("include/functions.php", {'param':'get_emails'}, function(data) {
			const emails = data;
			$('#empTable').DataTable( {
				"order": [[ 0, 'desc' ]],
				"data": data,
				"columns": [
					{ data: "Id" },
					{ data: "Name" },
					{ data: "Subject" },
					{ data: "Time" }
				]
			});
			$('#empTable').on('click', 'tr', function () {
				var id = $('td', this).eq(0).text();
				var email = emails.findIndex(x => parseInt(x.Id) === parseInt(id));
				console.log(email);
				if(email != -1){
					var modal = $("#exampleModal");
					modal.find('.modal-title').text(emails[email].Subject);
					modal.modal();
					$('#exampleModal').modal("show");
					$('#body').html(emails[email].body);
					$('#id_email').val(emails[email].Id);
				}
			});
		})
		.fail(function() {
			//alert("error");
		})
		.always(function() {
			$('#loading').modal("hide");
		});
	$("#btn-confirm").on("click", function(){
    	$("#mi-modal").modal('show');
  	});

	$("#delete").click( function(){
		$('#mi-modal').modal("hide");
		$('#exampleModal').modal("hide");
		$('#loading').modal("show");
		$.post("include/functions.php", {"id" : $("#id_email").val(),'param':'delete_email'}, function(data) {
			location.reload();			
		})
		.fail(function() {
			//alert("error");
		})
		.always(function() {
			$('#loading').modal("hide");
		});
    });



	$("#send").click( function(){
        var params = {
            "to" : $("#to").val(),
            "subject" : $("#subject").val(),
			"message" : $("#message").val()
        };
        $.ajax({
            data:  params,
            url:   'imap.php',
            type:  'post',
            beforeSend: function () {
                $("#result").html("Sending, Please wait the moment...");
            },
            success:  function (response) {
                $("#result").html(response);
            }
        });
    });
});
</script>
</body>
</html>