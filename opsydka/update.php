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
    mysqli_query($conn,"UPDATE erecyclebin_opendata set  kadosaddress='" . $_POST['kadosaddress'] . "', lastcheckdate='" . $_POST['lastcheckdate'] . "' ,datafrom='" . $_POST['datafrom'] . "',lastuseredit='" . $_POST['lastuseredit'] . "' ,lastusereditdate='" . $_POST['lastusereditdate'] . "' ,lastusereditid='" . $_POST['lastusereditid'] . "' WHERE id='" . $_POST['id'] . "'");
     
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
    <title>Ενημέρωση Κάδου</title>
</head>
<body>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h2>Ενημέρωση Κάδου</h2>
                        <hr>
                    </div>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Διεύθυνση Κάδου</label>
                            <input type="text" name="kadosaddress" class="form-control" value="<?php echo $row["kadosaddress"]; ?>">
                            
                        </div>
                        <div class="form-group ">
                            <label>Ημερομηνία Καταχώρησης</label>
                            <input type="text" name="date" class="form-control" value="<?php echo $row["date"]; ?>" readonly> 
                        </div>
                        <div class="form-group ">
                            <label>Τελευταία Ενημέρωση (στο σύστημα)</label>
                            <input type="text" name="lastcheckdateold" class="form-control" value="<?php echo $row["lastcheckdate"]; ?>" readonly> <br>
                            <label>Τελευταία Ενημέρωση (μετά την υποβολή)</label>
                            <input type="text" name="lastcheckdate" class="form-control" value="<?php echo date('d-m-Y'); ?>">
                        </div>
                        <div class="form-group">
                            <label>Πηγή Δεδομένων</label>
                            <input type="text" name="datafrom" class="form-control" value="<?php echo $row["datafrom"]; ?>" readonly>
                        </div>
                        <input type="hidden" name="lastuseredit" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>"/>
                        <input type="hidden" name="lastusereditid" value="<?php echo htmlspecialchars($_SESSION["id"]); ?>"/>
                        <input type="hidden" name="lastusereditdate" class="form-control" value="<?php echo date('d-m-Y / H:i:s'); ?>">
                        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Υποβολή">
                        <a href="index.php" class="btn btn-default">Ακύρωση</a>
                    </form>
                </div>
            </div>  
        </div>
</body>
</html>