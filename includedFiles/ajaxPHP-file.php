<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
  // $q = intval($_GET['q']);
  $q = strval($_GET['q']);

  $con = mysqli_connect('localhost','root','','dbProjectJS');
  if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
  }

  mysqli_select_db($con,"tbl_Ajax");
  $sql="SELECT * FROM tbl_Ajax WHERE name LIKE '%".$q."%' OR prename LIKE '%".$q."%'";
  $result = mysqli_query($con,$sql);

  echo "<table>
  <tr>
  <th class='col-md-4'>ID</th>
  <th class='col-md-4'>Firstname</th>
  <th class='col-md-4'>Lastname</th>
  </tr>";
  while($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['prename'] . "</td>";
      echo "<td>" . $row['name'] . "</td>";
      echo "</tr>";
  }
  echo "</table>";
  mysqli_close($con);
?>
</body>
</html>
