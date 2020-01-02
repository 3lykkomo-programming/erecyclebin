<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<html>
<body>
    <link rel='shortcut icon' type='image/x-icon' href='/erecyclebin/icon.ico' />

<h3 style="text-align:center">Αναφορά Προβλημάτων Κάδων Ανακύκλωσης</h3>
<h4 style="text-align:center">E-Recycle Bin - 3ο Γενικό Λύκειο Κομοτηνής</h4>
<h4 style="text-align:center">robotics.sites.sch.gr/erecyclebin</h4>
<script type="text/JavaScript">
     
     window.print()
</script>
<div class="alert alert-warning" role="alert">
Το σύστημα δημιουργεί μόνο την αναφορά προβλήματος. <br>
Η αποστολή της αναφοράς είναι αποκλειστική ευθύνη του χρήστη<br>
</div>
<div class="card">
  <h5 class="card-header">Στοιχεία Φυσικού Προσώπου</h5>
  <div class="card-body">
    <p class="card-text"><b>Ονοματεπώνυμο:  </b><?php echo $_GET["fullname"]; ?></p>
    <p class="card-text"><b>E-mail: </b><?php echo $_GET["emailuser"]; ?></p>
    <p class="card-text"><b>Τηλέφωνο Επικοινωνίας:</b> <?php echo $_GET["phonenumber"]; ?></p>
  </div>
</div>
<br>
<div class="card">
  <h5 class="card-header">Στοιχεία Κάδου Ανακύκλωσης</h5>
  <div class="card-body">
    <p class="card-text"><b>Α/Α Κάδου Ανακύκλωσης: </b><?php echo $_GET["aakados"]; ?></p>
    <p class="card-text"><b>Διεύθυνση Κάδου Ανακύκλωσης (συντεταγμένες):</b> <?php echo $_GET["address"]; ?></p>
    <p class="card-text"><b>Πηγή Δεδομένων: </b> <?php echo $_GET["datafrom"]; ?> </p>
  </div>
</div>
<br>
<div class="card">
  <h5 class="card-header">Περιγραφή Προβλήματος</h5>
  <div class="card-body">
    <p class="card-text"><?php echo $_GET["problem"]; ?></p>
  </div>
  </div>
</div>
  <br>
<div class="alert alert-info" role="alert"><h5><b><u>Διευκρινίσεις</b></u></h5>Για τεχνικά προβλήματα της πλατφόρμας (π.χ λάθος σημείο κάδου, εντοπισμός σφάλματος κτλ.) να στείλετε την αναφορά προβλήματος στο <a href="mailto:robotics@3lyk-komot.rod.sch.gr" class="alert-link">robotics@3lyk-komot.rod.sch.gr</a>. <br><br>Για θέματα αρμοδίοτητας του Δήμου Κομοτηνής να στείλετε την αναφορά υπόψην του τμήματος <b>Περιβάλλοντος & Πολιτικής Προστασίας</b> του <b>Δήμου Κομοτηνής</b> στο <a href="mailto:dkomot@otenet.gr" class="alert-link">dkomot@otenet.gr</a>.
</div>
</body>
</html>