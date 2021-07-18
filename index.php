<?php
$insert = false;
$username="root";
$passwd="Trimax@123";
$servername="localhost";
$db="notes";

$conn = mysqli_connect($servername,$username,$passwd,$db);

if(!$conn){

    die("The connection is denied due to ".mysqli_connect_error($conn));
    echo "<br>";
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $title =$_POST['title']; 
    $desc =$_POST['desc']; 
    $insquery="INSERT INTO `notes` (`sno`, `title`, `description`) VALUES (NULL, '$title', '$desc')
  ";
  $insres = mysqli_query($conn,$insquery);
 if($insres){

  $insert = true;
 }
 else{
  echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
 }


  // INSERT INTO `notes` (`sno`, `title`, `description`) VALUES (NULL, 'Read c++', 'Please read c++ it is very imp to us.');

}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <title>iNotes - A Note Taking App </title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">iNotes</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact US</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
  <?php  
 if($insert){
 echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success !!</strong> Your data is inserted Cheers !!.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
 }
 
?>

      <div class="container my-4">
        <form action="/crud/index.php" method="post">
            <h2>Add a Note</h2>
            <div class="mb-3">
              <label for="forTitle" class="form-label">Note Title</label>
              <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="forDescription" class="form-label">Note Description</label>
              <textarea class="form-control" id="desc" name = "desc"rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>

      <div class="container">
      <table class="table" id = "myTable"> <thead> <th scope='col'>S.No</th>
        <th scope='col'>Title</th>
        <th scope='col'>Description</th>
        <th scope='col'>Action</th>
        </thead>
        <tbody>
        <?php
        $selquery="SELECT * FROM `notes`";
        $res= mysqli_query($conn,$selquery);
        $sno=0;
        while($row=mysqli_fetch_assoc($res)){
        $sno++;
        echo "
        <tr>
        <td>".$sno."</td>
        <td>".$row['title']."</td>
        <td>".$row['description']."</td>
        <td> Action </td>
        
          </tr>";
        }
    ?>
    
        </tbody> </table>


      </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  </body>

</html>