 <?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php
// Include database connection file
require_once "configedit.php";

    if(count($_POST)>0) {
    mysqli_query($conn,"UPDATE erecyclebin_opendata set  kadosaddress='" . $_POST['kadosaddress'] . "', lastcheckdate='" . $_POST['lastcheckdate'] . "' ,datafrom='" . $_POST['datafrom'] . "',lastuseredit='" . $_POST['lastuseredit'] . "' ,lastusereditdate='" . $_POST['lastusereditdate'] . "' WHERE id='" . $_POST['id'] . "'");
     
     header("location: index.php");
     exit();
    }
    $result = mysqli_query($conn,"SELECT * FROM erecyclebin_opendata WHERE id='" . $_GET['id'] . "'");
    $row= mysqli_fetch_array($result);
  
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Αναλυτική Αναφορά Κάδου</title>
</head>
<body>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h2>Αναλυτική Αναφορά Κάδου</h2>
                        <hr>
                    </div>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Διεύθυνση Κάδου</label>
                            <input type="text" name="kadosaddress" class="form-control" value="<?php echo $row["kadosaddress"]; ?>" readonly>
                            
                        </div>
                        <div class="form-group ">
                            <label>Ημερομηνία Καταχώρησης</label>
                            <input type="text" name="date" class="form-control" value="<?php echo $row["date"]; ?>" readonly> 
                        </div>
                        <div class="form-group ">
                            <label>Τελευταία Ενημέρωση</label>
                            <input type="text" name="lastcheckdateold" class="form-control" value="<?php echo $row["lastcheckdate"]; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Πηγή Δεδομένων</label>
                            <input type="text" name="datafrom" class="form-control" value="<?php echo $row["datafrom"]; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Τελευταία επεξεργασία από τον χρήστη:</label>
                            <input type="text" name="datafrom" class="form-control" value="<?php echo $row["lastuseredit"]; ?>" readonly> <br>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Προβολή Χρήστη
  </button>

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Στοιχεία Χρήστη: <?php echo $row["lastuseredit"]; ?> </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <iframe name="userdata" src="data.php?id=<?php echo $row["lastusereditid"]; ?>" style="height:285px;width:500;border:none;">
</iframe>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Κλείσιμο</button>
        </div>
    </div>
</div> 
</div>

                        </div>
                        <div class="form-group">
                            <label>Ημερομηνία τελευταίας επεξεργασίας:</label>
                            <input type="text" name="datafrom" class="form-control" value="<?php echo $row["lastusereditdate"]; ?>" readonly>
                        </div>
                       
                    </form>
                </div>
            </div>  
        </div>
</body>
</html>