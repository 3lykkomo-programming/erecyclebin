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
        <link rel='shortcut icon' type='image/x-icon' href='/erecyclebin/icon.ico' />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href='custom.css' rel='stylesheet' type='text/css'>
    </head>
    <body>

        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-lg-offset-2">

                    <h1>E-RecycleBin | Αναφορά προβλημάτων</h1>
<br>
<div class="alert alert-info">
  <strong>Κατηγορίες Προβλημάτων:</strong>
                                <br>[Π01] - Τεχνικό πρόβλημα εφαρμογής
                                <br>[Π02] - Λάθος τοποθεσία Κάδου Ανακύκλωσης στην εφαρμογή
                                <br>[Π03] - Εκ παραδρομής καταχώρηση Κάδου Ανακύκλωσης
                                <br>[Π04] - Ζητήματα σχετικά με το άδειασμα του Κάδου Ανακύκλωσης
                                <br>[Π05] - Αναφορά καταστροφής του Κάδου Ανακύκλωσης
                                <br>[Π06] - Άλλο ζήτημα

</div>
<div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Προβλήματα αρμοδιότητας του Δήμου Κομοτηνής (<i>Π04, Π05, Π06</i>)</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">
            <form id="contact-form" method="post" action="contact-3.php" role="form">

                        

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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_name">Όνομα *</label>
                                        <input id="form_name" type="text" name="name" class="form-control" placeholder="Παρακαλώ εισάγετε το όνομα σας" required="required" data-error="Το όνομα είναι υποχρεωτικό.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_lastname">Επώνυμο *</label>
                                        <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Παρακαλώ εισάγετε το επώνυμο σας" required="required" data-error="Το επώνυμο είναι υποχρεωτικό.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_email">Email *</label>
                                        <input id="form_email" type="email" name="email" class="form-control" placeholder="Εισαγάγετε το email σας" required="required" data-error="Απαιτείται έγκυρη διεύθυνση ηλεκτρονικού ταχυδρομείου.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_phone">Τηλέφωνο Επικοινωνίας</label>
                                        <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Εισαγάγετε το τηλέφωνo σας">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group">
                            <label>Κατηγορία Προβλήματος</label>
                            <select type="text" class="form-control" name="mp1">
                                <option>[Π04] - Ζητήματα σχετικά με το άδειασμα του Κάδου Ανακύκλωσης</option>
                                <option>[Π05] - Αναφορά καταστροφής του Κάδου Ανακύκλωσης</option>
                                <option>[Π06] - Άλλο ζήτημα (αρμοδιότητας του Δήμου Κομοτηνής)</option>
                            </select> </div>
                             <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group">
                                        <label for="form_message">Περιγραφή Προβλήματος *</label>
                                        <textarea id="form_message" name="message" class="form-control" placeholder="Εισάγεται μια όσο το δυνατόν αναλυτικότερη περιγραφή" rows="4" required="required" data-error="Η Περιγραφή προβλήματος είναι υποχρεωτική"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                <label><input type="checkbox" value="" required="required">Συμφωνώ με την επεξεργασία των πληροφοριών μου όπως περιγράφεται και όπως εξηγείται στην <a data-toggle="modal" href="#exampleModal">δήλωση προστασίας προσωπικών δεδομένων</a></label>
                                    </div>
                                    <input type="submit" class="btn btn-success btn-send" value="ΥΠΟΒΟΛΗ ΑΝΑΦΟΡΑΣ">
                                    <br>
                                    <br>
                                    <div class="messages"></div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    </form>

        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Τεχνικά προβλήματα (<i>Π01, Π02, Π03, Π06</i>) </a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="panel-body">
            <form id="contact-formkom" method="post" action="contact-4.php" role="form">

                        

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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_name">Όνομα *</label>
                                        <input id="form_name" type="text" name="name" class="form-control" placeholder="Παρακαλώ εισάγετε το όνομα σας" required="required" data-error="Το όνομα είναι υποχρεωτικό.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_lastname">Επώνυμο *</label>
                                        <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Παρακαλώ εισάγετε το επώνυμο σας" required="required" data-error="Το επώνυμο είναι υποχρεωτικό.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_email">Email *</label>
                                        <input id="form_email" type="email" name="email" class="form-control" placeholder="Εισαγάγετε το email σας" required="required" data-error="Απαιτείται έγκυρη διεύθυνση ηλεκτρονικού ταχυδρομείου.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_phone">Τηλέφωνο Επικοινωνίας</label>
                                        <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Εισαγάγετε το τηλέφωνo σας">
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
                                <option>[Π06] - Άλλο ζήτημα (τεχνικής υποστήριξης)</option>
                            </select> </div>
                             <div class="row">
                                <div class="col-md-12">
                                   <div class="form-group">
                                        <label for="form_message">Περιγραφή Προβλήματος *</label>
                                        <textarea id="form_message" name="message" class="form-control" placeholder="Εισάγεται μια όσο το δυνατόν αναλυτικότερη περιγραφή" rows="4" required="required" data-error="Η Περιγραφή προβλήματος είναι υποχρεωτική"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                <label><input type="checkbox" value="" required="required">Συμφωνώ με την επεξεργασία των πληροφοριών μου όπως περιγράφεται και όπως εξηγείται στην <a data-toggle="modal" href="#exampleModal">δήλωση προστασίας προσωπικών δεδομένων</a></label>
                                    </div>
                                    <input type="submit" class="btn btn-success btn-send" value="ΥΠΟΒΟΛΗ ΑΝΑΦΟΡΑΣ">
                                    <br>
                                    <br>
                                    <div class="messageskom"></div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    </form>

</div>

        </div>
      </div>
    </div>
    <br>
                    

                </div><!-- /.8 -->

            </div> <!-- /.row-->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="exampleModalLabel">Δήλωση προστασίας προσωπικών δεδομένων</h3>
        
      </div>
      <div class="modal-body">
        Η Εφαρμογή «E-RecycleBin» συμμορφώνεται απόλυτα με τις απαιτήσεις του κανονισμού 2016/679 της ΕΕ γνωστού ως GDPR περί προστασίας των Προσωπικών σας δεδομένων. <br><br>

Το «E-RecycleBin» διαθέτει τα προσωπικά σας δεδομένα στο αρμόδιο τμήμα του Δήμου Κομοτηνής και στην ομάδα ανάπτυξης της εφαρμογής για την παροχή εξυπηρέτησης και των υπηρεσιών της προς εσάς. <br><br>

Ο σκοπός της επεξεργασίας είναι ανάλογος της εκάστοτε επιτελούμενης λειτουργίας και δεν υπάρχουν δευτερεύουσες χρήσεις, δηλαδή τα προσωπικά δεδομένα χρησιμοποιούνται αποκλειστικά για τον δηλωθέντα σκοπό. <br><br>

Το «E-RecycleBin» εφαρμόζει όλα τα κατάλληλα τεχνικά και οργανωτικά μέτρα ώστε να διασφαλίζεται υψηλό επίπεδο ασφαλείας όσον αφορά στην επεξεργασία των δεδομένων προσωπικού χαρακτήρα, και ενδεικτικά εφαρμόζουν κάθε προληπτικό μέτρο με σκοπό:<br>
 <i>α) απαγορεύουν την πρόσβαση μη εξουσιοδοτημένων προσώπων σε εξοπλισμό επεξεργασίας που χρησιμοποιείται για την επεξεργασία<br>
 β) αποφεύγουν τη μη επιτρεπόμενη ανάγνωση / αντιγραφή / τροποποίηση / αφαίρεση υποθεμάτων δεδομένων <br>
 γ) αποφεύγουν τη μη επιτρεπόμενη εισαγωγή δεδομένων προσωπικού χαρακτήρα <br>
 δ) αποφεύγουν τη χρήση συστημάτων αυτοματοποιημένης επεξεργασίας από μη εξουσιοδοτημένα πρόσωπα που χρησιμοποιούν εξοπλισμό επικοινωνίας δεδομένων<br>
 ε) εξασφαλίζουν ότι τα εξουσιοδοτημένα προς επεξεργασία πρόσωπα έχουν πρόσβαση μόνο στα δεδομένα που καλύπτει η εξουσιοδότηση πρόσβασής τους κ.α.<br><br> </i>

Δεν μεταβιβάζει τα προσωπικά σας δεδομένα σε τρίτους εκτός εάν το ζητήσετε εσείς, χρειάζεται για την παροχή των υπηρεσιών της προς εσάς και απαιτηθεί εκ του νόμου. <br><br>

Καθ’ όλη τη διάρκεια που τηρούμε τα δεδομένα σας, έχετε τη δυνατότητα πρόσβασης σε αυτά με σκοπό την ενημέρωση τους, τη διόρθωσή τους , την διαγραφή τους καθώς επίσης και τη φορητότητα τους. Έχετε το δικαίωμα να αλλάξετε τις παρακάτω συγκαταθέσεις σας οποιαδήποτε στιγμή επιθυμείτε ενημερώνοντας με email στο robotics@3lyk-komot.rod.sch.gr




      </div>
    </div>
  </div>
</div>
        </div> <!-- /.container-->

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js" integrity="sha256-dHf/YjH1A4tewEsKUSmNnV05DDbfGN3g7NMq86xgGh8=" crossorigin="anonymous"></script>
        <script src="contact-3.js"></script>
        <script src="contact-4.js"></script>
    </body>
</html>
