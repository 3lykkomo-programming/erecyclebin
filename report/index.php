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
    <meta charset="UTF-8">
    <title>E-RecycleBin / Αναφορά προβλημάτων</title>
    	<link rel='shortcut icon' type='image/x-icon' href='/erecyclebin/icon.ico' />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <div class="page-header">
                            <style type="text/css">
        body{ font: 14px sans-serif; }
    </style>
                        <h1 style="color:MediumSeaGreen;">E-RecycleBin</h1> 
                        <h2>Αναφορά προβλημάτων</h2>
                    </div>
                    <form action="r_print.php" method="get">
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
                            <label>Ονοματεπώνυμο</label>
                            <input type="text" name="fullname" class="form-control"> <br>
                            <label>E-mail</label> 
                            <input type="text" name="emailuser" class="form-control"> <br>
                            <label>Τηλέφωνο Επικοινωνίας</label>
                            <input type="text" name="phonenumber" class="form-control"> <br>
                           <div class="form-group">
    <label>Περιγραφή Προβλήματος</label>
    <textarea class="form-control" name="problem" rows="6"></textarea>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Εκτύπωση Αναφοράς">

                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>