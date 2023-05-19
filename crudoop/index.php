<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

  <div class="container self-algin-center-">
    <div class="row"></div>
       <form action=""  class="mt-5" method="POST">
        

        <div class="col  ">
        EMAIL : <input type="text" name="email">
        </div>
        <div class="col mt-2 ">
            password : <input type="text" name="password">
        </div>
        

        <div class="col mt-3">
         <input type="file" name="fil">
        </div>
      <button type= "submit"  name="submit" class="mt-3 "> submit</button>
      </form> 
    
  </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>


<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 'On');
 
 class databs{
  private $db= "localhost";
  private $dbs = "root";
  private $dbp ="";
  private $dbn ="damo";
 
  private $con = false;
  private $re = array();
   public  $mysqli ="";
  public function __construct(){
//  echo $this->re;
    if(!$this->con){

    $this->mysqli = new mysqli($this->db,$this->dbs,$this->dbp,$this->dbn);

    if($this->mysqli->connect_error){
      array_push($this->re,$this->mysqli->connect_error);
      return false;
    }
  }else{
    return true;
  } 
    
  }

}


$show = new databs();

    if(isset($_POST['submit'])){
      $email = $_POST['email'];
      $passd = $_POST['password'];
      $file = $_FILES['fil'];

      // $start = date('Y-m-d',strtotime($_POST['']));
      // $end = date('Y-m-d',strtotime($_POST['']));
      // $dest= $_POST[''];
      // $phone= $_POST[''];
      // $addres= $_POST[''];
      // $pincode= $_POST[''];
     
  
      $query = mysqli_query($show = $this->mysqli,"INSERT INTO new (email,passd,file)
       VALUES('$email','$passd','$file')");
    // header ("Location: ");  
  
  
     }


 ?>