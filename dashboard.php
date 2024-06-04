<?php
session_start();
include('conn.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: login.php");
        exit();
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Fetch Enquiries
$sql = "SELECT * FROM enquiry_tbl";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>Sina E-Bike Admin</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">

  </head>

<body>

   
  <!--header-->
  <header class="main-header clearfix" role="header">
    <div class="logo">
      <a href="index.php">
         <img src="assets/logo.jpg" style="width: 100px !important;">
      </a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
      <ul class="main-menu">
        <li><a href="#section1">Admin</a></li>
        <li><a href="?logout=true" class="btn btn-danger">Logout</a></li>
      </ul>
    </nav>
  </header>
<section class="section contact" data-section="section6">
    <div class="col-md-12">
        <div class="col-md-12">
            <h2>Contact / Enquiry List</h2>
            <br>
            <br>
            <table class="table">
                <thead>
                    <style type="text/css">
                        th , td
                        {
                            color: #fff !important;
                        }
                    </style>
                    <tr>
                        <th class="" style="color: red !important;">Sr.No</th>
                        <th class="" style="color: red !important;">Name</th>
                        <th class="" style="color: red !important;">Email</th>
                        <th class="" style="color: red !important;">Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . ++$i . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['message'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No enquiries found</td></tr>";
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <p><i class="fa fa-copyright"></i> Copyright 2024 by AD  
          
<!--            | Design: <a href="" rel="sponsored" target="_parent"></a><br>
           Distributed By: <a href="" rel="sponsored" target="_blank">ai</a> -->
          
          </p>
        </div>
        
      </div>
    </div>
  </footer>



  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>

