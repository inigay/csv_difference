<?php

// Just output the form
// HACKATHON WAY

?>

<html>
<head>
	<title>CSV Difference Checker</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="container">
<div class="row">
	<header class="col-lg-12 col-md-12">
		<h1 class="text-center">Upload Your Data Sets Below</h1>
	</header>


	<div class="col-lg-12 col-md-12">
		<form id="diffCalcForm" class="form-group" method="POST" enctype= "multipart/form-data" action="CalculateDifference.php">
			<div class="col-lg-5 form-group">
				<input class="fileInput form-control" type="file"  name="file1" id="file1" />
			</div>
			<div class="col-lg-2 col-md-2 hidden-sm hidden-xs"></div>
			<div class="col-lg-5 form-group">
				<input class="fileInput form-control" type="file"  name="file2" id="file2" />
			</div>
			<div class="col-lg-12 form-group" class="options">
				<h3>Concerns:</h3>
				<label for="subscriber_count">Subscriber Count</label>
				<input type="radio" value="subs" class="optionInput" name="concern" id="subscriber_count" />
				<br>
				<label for="channel_owner">Channel Owner</label>
				<input type="radio" value="channel" class="optionInput" name="concern" id="channel_owner" />
			</div>
			<div class="col-lg-12">
				<input type="submit" id="submitForm" class="btn btn-default" value="submit" name="submit" />
			</div>
		</form>
	</div>

</div>


<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</body>
</html>