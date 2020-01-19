  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <title>E-RecycleBin</title>
	<link rel='shortcut icon' type='image/x-icon' href='/erecyclebin/icon.ico' />
<!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
    <img src="/erecyclebin/icon.ico" width="30" height="30" alt="">
  </a>
      <a class="navbar-brand" href="#">E-RecycleBin</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="/erecyclebin">Αρχική
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/erecyclebin/web">Web Version</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Android App</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Open Data</a>
                        <span class="sr-only">(current)</span>
                         <li class="nav-item">
            <a class="nav-link" href="/erecyclebin/opsydka">Ο.Π.ΣΥ.Δ.Κ.Α</a></li>
          <li class="nav-item">
            <a class="nav-link" href="/erecyclebin/contact">Επικοινωνία</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<?php 
	include 'conn.php';
	$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
	$result = $conn->query("SELECT * FROM erecyclebin_opendata LIMIT $start, $limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
	$result1 = $conn->query("SELECT count(id) AS id FROM erecyclebin_opendata");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit );
	$Previous = $page - 1;
	$Next = $page + 1;
 ?>
<!DOCTYPE html>
<html>
<head>
	<br>
	<br>
	<title>E-RecycleBin - Open Data</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
	<div class="container text-center">
		 <img src="logo.png" class="center" width="250" height="250" > 
        <h2 style="color:Tomato;">Open Data</h1>
    <p>
        <a href="erecyclebin_opendata.xlsx" class="btn btn-success">Εξαγωγή στο Excel</a>
        <a href="erecyclebin_opendata.sql" class="btn btn-primary">Εξαγωγή σε SQL</a>
    </p>
  </div>
    <div class="container alert alert-warning alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Ενημέρωση: </strong>Ο Σύνδεσμος από την Διεύθυνση Κάδου (συντεταγμένες) ανοίγει στο Google Maps
  </div>
</div>
<div class="container well">
		<div class="row">
			<div class="col-md-10">
				
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
    <li class="page-item"><a class="page-link" href="?page=2">2</a></li>
   <li class="page-item"><a class="page-link" href="?page=3">3</a></li>
   <li class="page-item"><a class="page-link" href="?page=4">4</a></li>
  <li class="page-item"><a class="page-link" href="?page=5">5</a></li>
    <li class="page-item"><a class="page-link" href="?page=6">6</a></li>
      <li class="page-item"><a class="page-link" href="?page=7">7</a></li>
        <li class="page-item"><a class="page-link" href="?page=8">8</a></li>
        <li class="page-item"><a class="page-link" href="?page=9">9</a></li>
        <li class="page-item"><a class="page-link" href="?page=10">10</a></li>
       <li class="page-item"><a class="page-link" href="?page=11">11</a></li>
         <li class="page-item"><a class="page-link" href="?page=12">12</a></li>
        <li class="page-item"><a class="page-link" href="?page=13">13</a></li>
    </li>
  </ul>
</nav>








			</div>
			<div class="text-center" style="margin-top: 20px; " class="col-md-2">
				<form method="post" action="#">
					</form>
				</div>
		</div>
		<div style="overflow-y: auto;">
			<table id="" class="table table-striped table-bordered">
	        	<thead>
	                <tr>
	                    <th>Α/Α</th>
	                    <th>Διεύθυνση Κάδου</th>
	                    <th>Ημερομηνία Καταχώρησης</th>
	                    <th>Τελευταία Ενημέρωση</th>
	                    <th>Πηγή Δεδομένων</th>
	              	</tr>
	          	</thead>
	        	<tbody>
	        		<?php foreach($customers as $customer) :  ?>
		        		<tr>
		        			<td><?= $customer['id']; ?></td>
		        			<td><a href="https://www.google.com/maps/search/<?= $customer['kadosaddress']; ?> " target="_blank"><?= $customer['kadosaddress']; ?></a></td>
		        			<td><?= $customer['date']; ?></td>
		        			<td><?= $customer['lastcheckdate']; ?></td>
		        			<td><?= $customer['datafrom']; ?></td>
		        		</tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>
      		<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
    <li class="page-item"><a class="page-link" href="?page=2">2</a></li>
   <li class="page-item"><a class="page-link" href="?page=3">3</a></li>
   <li class="page-item"><a class="page-link" href="?page=4">4</a></li>
  <li class="page-item"><a class="page-link" href="?page=5">5</a></li>
    <li class="page-item"><a class="page-link" href="?page=6">6</a></li>
      <li class="page-item"><a class="page-link" href="?page=7">7</a></li>
        <li class="page-item"><a class="page-link" href="?page=8">8</a></li>
        <li class="page-item"><a class="page-link" href="?page=9">9</a></li>
        <li class="page-item"><a class="page-link" href="?page=10">10</a></li>
       <li class="page-item"><a class="page-link" href="?page=11">11</a></li>
         <li class="page-item"><a class="page-link" href="?page=12">12</a></li>
        <li class="page-item"><a class="page-link" href="?page=13">13</a></li>
    </li>
  </ul>
</nav>



		</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#limit-records").change(function(){
			$('form').submit();
		})
	})
</script>
</body>
<?php include "footer.html"; ?>
</html>