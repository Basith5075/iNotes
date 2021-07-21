<?php

// In this PHP section we are creating the connection to the MySql DB notes

$insert = false;
$update = false;
$delete = false; 
$username="root";
$passwd="Trimax@123";
$servername="localhost";
$db="notes";

$conn = mysqli_connect($servername,$username,$passwd,$db);

if(!$conn){

    die("The connection is denied due to ".mysqli_connect_error($conn));
    echo "<br>";
}

// Logic to delete the rows.

if(isset($_GET['delete'])){

  $sno=$_GET['delete'];
  $delquery="DELETE FROM `notes` WHERE `sno` = $sno";
  $res=mysqli_query($conn,$delquery);
  if($res){
    $delete=true;
  }
  else{

    echo "Deletion Operation failed.";
  }


}

// Logic to insert and update the table

if($_SERVER['REQUEST_METHOD']=="POST"){

  if(isset($_POST['snoEdit'])){ 

      // Updating the record
    $snoEdit = $_POST["snoEdit"];
    $titleEdit = $_POST["titleEdit"];
    $descEdit = $_POST["descriptionEdit"];
    $sql = "UPDATE `notes` SET `title` = '$titleEdit' , `description` = '$descEdit' WHERE `notes`.`sno` = $snoEdit";
    $result = mysqli_query($conn, $sql);
    if($result){
      $update = true;
  }
  else{
      echo "We could not update the record successfully";
  }

  }
  else{

    // Inserting the record
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
}
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

  // Modal for the edit Option.

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        // Form of Edit modal we can get from bootstrap called as live modal

        <form action="/crud/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

// This is the navbar which we can get from bootstrap
 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="https://www.php.net/images/logos/new-php-logo.svg" height="28px" alt="">iNotes</a>
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

  // this is section for writing the logic for the success prompts for insert, delete and update

 if($insert){
 echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success !!</strong> Your data is inserted Cheers !!.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
 }
 if($update){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
   <strong>Success !!</strong> Your data is Updates successfully!!.
   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
     <span aria-hidden='true'>&times;</span>
   </button>
 </div>";
  }

  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
     <strong>Success !!</strong> Your row is deleted successfully Cheers !!.
     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span>
     </button>
   </div>";
    }
 
?>

      // From here our container containing our form structue starts.
      <div class="container my-4">
        <form action="/crud/index.php" method="post">
            <h2>Add a Note</h2>
            <div class="mb-3">
              <label for="forTitle" class="form-label">Note Title</label>
              <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="forDescription" class="form-label">Note Description</label>
              <textarea class="form-control" id="description" name = "desc"rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>

      // From here our container containing the result of select query starts.
      // We are using the datatable here to display our results 

      <div class="container">
      <table class="table" id = "myTable"> <thead> 
      <tr>  
        <th scope='col'>S.No</th>
        <th scope='col'>Title</th>
        <th scope='col'>Description</th>
        <th scope='col'>Action</th>
      </tr>
        </thead>
        <tbody>
          
        // Below is the PHP code used for displaying the result in the table. 
        
        <?php
        $selquery="SELECT * FROM `notes`";
        $res= mysqli_query($conn,$selquery);
        $sno=0;
        while($row=mysqli_fetch_assoc($res)){
        $sno++;
        echo "
        <tr>
        <th scope ='row'>".$sno."</th>
        <td>".$row['title']."</td>
        <td>".$row['description']."</td>
    <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>  </td>
        
          </tr>";
        }
    ?>
    
        </tbody> </table>


      </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

  <script>
    // Below JavaScript is used for datatable used for displaying the results on page.
  $(document).ready(function () {
      $('#myTable').DataTable();

    });
    </script>
    <script>
      // Below JavaScript is used for taking the "title" and "description" from the table row of datatable and sending it in the Edit modal.
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    // Below JS is used to get the "sno" from the table and send it to the /crud/index.php?delete=${sno} 

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
    </script>

  </body>

</html>