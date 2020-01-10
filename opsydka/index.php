  <?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <title>Ο.Π.ΣΥ.Δ.Κ.Α | E-RecycleBin</title>
	<link rel='shortcut icon' type='image/x-icon' href='/erecyclebin/icon.ico' />
<!-- Navigation -->
<br>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
  </a>
          <img src="opsydka_logo.png">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#">Αρχική
            </a>
            <span class="sr-only">(current)</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/erecyclebin/web">E-RecycleBin</a>
          </li>
          <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ο Λογαριασμός μου
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item-text">Όνομα Χρήστη: <b><?php echo htmlspecialchars($_SESSION["username"]); ?></a></b>
            <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="reset.php">Αλλαγή κωδικού</a>
          <a class="dropdown-item" href="logout.php">Αποσύνδεση</a>
        </div>
      </li>
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
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div class="container well">
    <div class="row">
      <div class="col-md-10">
			</div>
  </div>
<br>
<div id="accordion">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#useracc">
          Στοιχεία Χρήστη
        </a>
      </div>
      <div id="useracc" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <iframe name="userdata" src="data.php?id=<?php echo htmlspecialchars($_SESSION["id"]); ?>" style="height:285px;width:600px;border:none;">
</iframe>
</div>
  <div class="card-footer">
      <a href="edit_users.php?id=<?php echo htmlspecialchars($_SESSION["id"]); ?>" class="btn btn-info"  target="userdata">Επεξεργασία</a>
        </div>
      
</div>

      </div>
    </div>
<br>
  </div>
    <div class="container alert alert-warning alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Ενημέρωση: </strong>Ο Σύνδεσμος από την Διεύθυνση Κάδου (συντεταγμένες) ανοίγει στο Google Maps
  </div>
</div>

   <div class="container text-center">
      
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
</html>