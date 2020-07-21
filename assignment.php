<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT first_name as firstname, last_name as lastname, email, comment,datetime FROM enquiries";
$result = $conn->query($sql);
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Enquiries</title>
	<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<style type="text/css">
a {
	color: #0254EB
}
a:visited {
	color: #0254EB
}
a.morelink {
	text-decoration:none;
	outline: none;
}
.morecontent span {
	display: none;
}
.comment {
	width: 400px;
	margin: 10px;
}
</style>
</head>
<body>
	<div class="m-4">
    <div class="table-responsive"> 
    	<h4 class="mb-4">Enquiry Data</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Row</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Datetime</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
            	<?php
				if ($result->num_rows > 0) { $i = 1; ?>  
                	 <?php while($row = $result->fetch_assoc()) { ?>			    
                 <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["firstname"]; ?></td>
                    <td><?php echo $row["lastname"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo date_format(date_create($row["datetime"]),"D d M Y"); ?></td>                   
                    <td class="comment more"><?php echo $row["comment"]; ?> </td>
                  
                    
                    <?php $i++;
                 }
				} else {
				  echo "0 results";
				}
				$conn->close(); ?>
                </tr>
               
            </tbody>
        </table>
    </div>    
</div>

</body>
<script type="text/javascript">
$(document).ready(function() {
	var showChar = 40;
	var ellipsestext = "...";
	var moretext = "more";
	var lesstext = "less";
	$('.more').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);

			var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
});</script>
</html>

 