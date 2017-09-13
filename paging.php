<?php
    require_once 'Classes/Paginator.class.php';

    $conn       = new mysqli( 'localhost', 'root', '', 'dbproje6ctjs');

    $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 25;
    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
    $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
    $query      = "SELECT City.Name, City.CountryCode, Country.Code, Country.Name AS Country, Country.Continent, Country.Region FROM City, Country WHERE City.CountryCode = Country.Code";

    $Paginator  = new Paginator($conn, $query);

    $results    = $Paginator->getData( $page, $limit );
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- own Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- font-awesome -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="icon" href="img/iconJS.ico" />
    <title>Paging</title>
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse bg-inverse text-white form-inline">
      <div class=" col-md-12 row">
        <div class="col-md-4 offset-md-4 text-center">
          <a class="navbar-brand" href="paging.php" id="demo" style="font-family: 'Lobster', cursive;" >Paging</a>
        </div>
        <div class="ml-auto">
        </div>
      </div>
    </nav>

    <div class="content row">
      <div class="col-md-10 col-md-offset-1">
        <h1>PHP Pagination</h1>
        <table class="table table-striped table-condensed table-bordered table-rounded">
                <thead>
                        <tr>
                        <th>City</th>
                        <th width="20%">Country</th>
                        <th width="20%">Continent</th>
                        <th width="25%">Region</th>
                </tr>
                </thead>
                <tbody>
                  <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
                        <tr>
                          <td><?php echo $results->data[$i]['Name']; ?></td>
                          <td><?php echo $results->data[$i]['Country']; ?></td>
                          <td><?php echo $results->data[$i]['Continent']; ?></td>
                          <td><?php echo $results->data[$i]['Region']; ?></td>
                        </tr>
                  <?php endfor; ?>
                </tbody>
        </table>
        <!-- Paginator-Link -->
        <?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?>
      </div>
    </div>

    <script>
    </script>
    <!-- Footer -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
      $(function(){
        $('#footer').load("includedFiles/footer.html");
      })
    </script>
    <div id="footer"></div>
    <!-- /Footer -->
  </body>
</html>
