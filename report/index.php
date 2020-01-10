<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an update statement
        $sql = "UPDATE erecyclebin_opendata SET name=?, address=?, salary=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_salary, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM erecyclebin_opendata WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["id"];
                    $address = $row["kadosaddress"];
                    $salary = $row["datafrom"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 <!DOCTYPE html>
<html lang="en">
    <head>
        <title>E-RecycleBin | Αναφορά προβλημάτων</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>
    </head>
    <body>

        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-lg-offset-2">

                    <h1>E-RecycleBin | Αναφορά προβλημάτων</h1>


<form action="r_print.php" method="get">
                        <div class="messages"></div>

                        <div class="controls">

                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group">
                            <label>Α/Α Κάδου Ανακύκλωσης</label>
                            <input type="text" name="aakados" class="form-control" value="<?php echo $name; ?>"readonly>
                        </div>
                        <div class="form-group">
                            <label>Διεύθυνση Κάδου Ανακύκλωσης (συντεταγμένες)</label>
                            <input type="text" name="address" class="form-control" value="<?php echo $address; ?>"readonly>
                        </div>
                            <label>Πηγή Χαρτογράφησης</label>
                            <input type="text" name="datafrom" class="form-control" value="<?php echo $salary; ?>" readonly> <br>
                        </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form_name">Ονοματεπώνυμο</label>
                                        <input id="form_name" type="text" name="fullname" class="form-control" placeholder="Παρακαλώ εισάγετε το όνομα σας" required="required" data-error="Το ονοματεπώνυμο είναι υποχρεωτικό.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
     
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_email">Email</label>
                                        <input id="form_email" type="email" name="emailuser" class="form-control" placeholder="Εισαγάγετε το email σας" required="required" data-error="Απαιτείται έγκυρη διεύθυνση ηλεκτρονικού ταχυδρομείου.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_phone">Τηλέφωνο Επικοινωνίας</label>
                                        <input id="form_phone" type="tel" name="phonenumber" class="form-control" placeholder="Εισαγάγετε το τηλέφωνo σας" required="required">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group">
                            <label>Κατηγορία Προβλήματος</label>
                            <select type="text" class="form-control" name="mp1">
                                <option>[Π01] - Τεχνικό πρόβλημα εφαρμογής</option>
                                <option>[Π02] - Λάθος τοποθεσία Κάδου Ανακύκλωσης στην εφαρμογή</option>
                                <option>[Π03] - Εκ παραδρομής καταχώρηση Κάδου Ανακύκλωσης</option>
                                <option>[Π04] - Ζητήματα σχετικά με το άδειασμα του Κάδου Ανακύκλωσης</option>
                                <option>[Π05] - Αναφορά καταστροφής του Κάδου Ανακύκλωσης</option>
                                <option>[Π06] - Άλλο ζήτημα</option>
                            </select> </div>
                             <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group">
                                        <label for="form_message">Περιγραφή Προβλήματος</label>
                                        <textarea id="form_message" name="problem" class="form-control" placeholder="Εισάγεται μια όσο το δυνατόν αναλυτικότερη περιγραφή" rows="4" required="required" data-error="Η Περιγραφή προβλήματος είναι υποχρεωτική"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-success btn-send" value="Εκτύπωση Αναφοράς">
                                </div>
                            </div>
                            </div>
                        </div>

                    </form>

                </div><!-- /.8 -->

            </div> <!-- /.row-->

        </div> <!-- /.container-->

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    </body>
</html>
