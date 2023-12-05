<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;
layouts('header', '');
$id = $_GET['id'];

  $sql = "SELECT * FROM user WHERE ID=".$id;
  $res = select1Raw($sql);

 if($_SERVER["REQUEST_METHOD"] == "POST") {
  $page = getFlashData('page');
  if(isset($_POST["cancel"])){
    
    $url= _WEB_HOST.'/?module=&action=&page='.$page;
            echo '<script>
                
                    window.location.href = "'.$url.'";
               
            </script>';
  }

  if(isset($_POST["delete"])){
    
    DeleteUser('user', 'ID = '.$id);
    $url= _WEB_HOST.'/?module=&action=&page='.$page;
            echo '<script>
                
                    window.location.href = "'.$url.'";
               
            </script>';
  }
}
?>



<body>
  <div class=" " >
    <div class="container-sm conatinerdelete ">
      <div class="row text-center">
        <h5>
        Are you sure you want to delete this user?
        </h5>	
      </div>
      <hr>
      <div class="row" >
        <div class="col-6" >
          <h6>Name:</h6> 
          <p><?php echo $res['username']?></p>
        </div>
        <div class="col-6" >
          <h6>Email:</h6>
          <p><?php echo $res['email']?></p>
        </div>
      </div>
      <div class="row" >
        <div>
          <h6>Phone Number:</h6>
          <p><?php echo $res['phone']?></p>
        </div>
      </div>
      <hr>
      <div class="row" >
        <div class="justify-content-between" >
          <form method="post" class="d-flex justify-content-between" >
            <button name="cancel" type="submit" class="btn btn-secondary" >Cancel</button>
            <button name="delete" type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</body>

<?php
layouts('footer', '');
?>
