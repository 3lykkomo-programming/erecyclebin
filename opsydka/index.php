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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
  <div class="container alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Προσοχή: </strong>Το Ο.Π.ΣΥ.Δ.Κ.Α ενημερώνει σε <u>πραγματικό χρόνο</u> την πύλη OpenData με τις αλλαγές που πραγματοποιούνται. <br>Ελέγξτε την εγκυρότητα τους πριν προβείτε σε οποιοδήποτε επεξεργασία ή διαγραφή.
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
                      <th>Ενέργειες</th>
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
                  <td>
                <a class="btn btn-primary" href="view.php?id=<?= $customer['id']; ?>" role="button"> <i class="fa fa-folder-open-o"></i></a>
                    <a class="btn btn-warning" href="update.php?id=<?= $customer['id']; ?>" role="button"> <i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger" href="delete.php?id=<?= $customer['id']; ?>" role="button"> <i class="fa fa-trash-o"></i></a>
                        </td>
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
<footer class="py-5 bg-dark">

  <!-- Footer Links -->
  <div class="container text-center text-md-left text-white">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-4 mx-auto">

        <!-- Content -->
        <h5 class="font-weight-bold mt-3 mb-4">GitHub</h5>
        <p>Μπορείτε να κατεβάσετε την τελευταία έκδοση του E-RecycleBin από το αποθετήριο της εφαρμογής στο
        GitHub</p>
        <a href="https://github.com/3lykkomo-programming/erecyclebin" target="_blank" class="btn btn-light" role="button">Δείτε περισσότερα στο GitHub...</a>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 mx-auto">

        <!-- Links -->
        <h5 class="font-weight-bold mt-3 mb-4">Social Media</h5>

        <ul class="list-unstyled">
          <li>
            <a href="https://www.instagram.com/erecyclebin/" target="_blank" class="text-white">Instagram</a>
          </li>
          <li>
          <a href="https://www.youtube.com/channel/UCTRn0fEKBaa_GrNvZNkb6jQ" target="_blank" class="text-white">Youtube</a>
          </li> 
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-6">

        <!-- Links -->
        <h5 class="font-weight-bold mt-3 mb-4">Χρήσιμες πληροφορίες...</h5>

        <ul class="list-unstyled" >
          <li>
            <a href="/erecyclebin/mediakit.html" class="text-white">Media Kit</a>
          </li>
          <li>
            <a href="/erecyclebin/license.html" class="text-white">Άδεια χρήσης</a>
          </li>
          <li>
            <a href="/erecyclebin/gdpr.html" class="text-white">Δήλωση προστασίας προσωπικών δεδομένων</a>
          </li>
          <li>
            <a href="/erecyclebin/contribute.html" class="text-white">Συνεισφορά</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 mx-auto">

        <!-- 

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

      <hr style="border-top: 1px solid #ccc; background: transparent;">


  <!-- Copyright -->
      <p class="m-0 text-center text-white"><b>Προγραμματισμός:</b> Άγγελος Μιχαήλ Χουβαρδάς</p>
      <p class="m-0 text-center text-white"><b>Υλοποίηση - Σχεδιασμός:</b> Βασίλειος Ευτυχιάκος, Άγγελος Μιχαήλ Χουβαρδάς
</p><br>

  <p class="m-0 text-center text-white">Έκδοση: 2.2</p>
      <p class="m-0 text-center text-white">&copy; 3ο Γενικό Λύκειο Κομοτηνής - <i>Ομάδα Ρομποτικής & Προγραμματισμού</i></p>
      <hr style="border-top: 1px solid #ccc; background: transparent;">
  </div>
  <!-- Copyright -->

</footer>
</html>