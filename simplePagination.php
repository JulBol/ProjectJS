<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- own Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- font-awesome -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="icon" href="img/iconJS.ico" />
    <title>Simple Pagination</title>
  </head>
  <body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse bg-inverse text-white form-inline">
      <div class=" col-md-12 row">
        <div class="col-md-4 offset-md-4 text-center">
          <a class="navbar-brand" href="simplePagination.php" id="demo" style="font-family: 'Lobster', cursive;" >Simple Pagination</a>
        </div>
        <div class="ml-auto">
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="content row">
        <?php
          $conn = mysqli_connect('localhost', 'root', '', 'dbprojectjs') or die ('Error connecting to mysql');
          $limit = 2;
          if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
          $start_from = ($page-1) * $limit;

          $sql = "SELECT * FROM tbl_paging ORDER BY title ASC LIMIT $start_from, $limit";
          $rs_result = mysqli_query($conn, $sql);
        ?>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>title</th>
                <th>body</th>
              </tr>
            <thead>
          <tbody>
        <?php
          while($row = mysqli_fetch_assoc($rs_result)) {
              echo "<tr>";
              echo "<td>" . $row['title'] . "</td>";
              echo "<td>" . $row['body'] . "</td>";
              echo "</tr>";
          }
        ?>
            </tbody>
          </table>
        <?php
          $sql = "SELECT COUNT(id) FROM tbl_paging";
          $rs_result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_row($rs_result);
          $total_records = $row[0];
          $total_pages = ceil($total_records / $limit);

          $pageLink = "<nav aria-label='Page navigation example'>";
            $pageLink .= "<ul class='pagination'>";
                for ($i=1; $i<=$total_pages; $i++) {
                  if($i == 1){
                    $pageLink .= "<li class='page-item'><a class='page-link' href='simplePagination.php?page={$i}'>Previous</a></li>";
                  }else if($i == $total_pages){
                    $pageLink .= "<li class='page-item'><a class='page-link' href='simplePagination.php?page={$i}'>Next</a></li>";
                  }else{
                    $pageLink .= "<li class='page-item'><a class='page-link' href='simplePagination.php?page={$i}'>{$i}</a></li>";
                  }
                }
            $pageLink .= "</ul>";
          $pageLink .= "</nav>";
          echo $pageLink;
        ?>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/timer.js"></script>

    <script>

    </script>
    <!-- Footer -->
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
