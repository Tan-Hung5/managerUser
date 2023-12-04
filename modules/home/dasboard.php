<?php

(!defined('_CODE'))? die('Truy cap khong hop le'):false;


require_once('modules/user/lisuser.php');
layouts("header",'dasboard');

$res = queryData();
$login = getSession('islogin');

if(!isset($_GET['page'])){
    $page = 1;
}else{
    $page = $_GET['page'];
}
setFlashData('page', $page);

$len = count($res);
$resPerPage = 5;
$start =$page*5-$resPerPage;
$data = array_slice($res, $start,$resPerPage);


?>
<hr>
<div class="container-fluid mt-4">
    <div style="" class=" header-table">
        <div class="text-center">
            <h1>Manager Users</h1>
        </div>
        <div class="row justify-content-end">
            <?php if($login){

             echo '

                    <div class="col-4 text-end">
                        <a href="?module=user&action=adduser" class="btn btn-primary m-1" >
                          Add User
                        </a>
                    </div>
                    <div class="col-3">
                        
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import csv
                    </button>
                        <a href="?module=export&action=export" class="btn btn-danger m-1">export</a>
                    </div>';
            }?>
        </div>
    </div>
    <table style="z-index: 1;" class="table table-info table-striped">
        <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">PhoneNumber</th>
        <th scope="col">Email</th> 
        <th style="width:240px;" ></th>      
        </tr>
    </thead>
    <tbody>
           <?php printData($data,$login);?> 
        
    </tbody>
    </table>
    
    <hr>
<div class="d-flex justify-content-center ">
    <nav aria-label="Page navigation example">
      <ul class="pagination text-center">
        <li class="page-item">
          <a class="page-link" href=<?php if($page>1){
            echo "?module=&action=&page=".$page-1;
            }else echo "?module=&action=&page=".$page;
        ?> aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <?php for($i=1; $i<=ceil($len/$resPerPage);$i++){
            echo '<li class="page-item"><a class="page-link" href="?module=&action=&page='.$i.'">'.$i.'</a></li>';
        } ?>
        
        <li class="page-item">
          <a class="page-link" href=<?php
                if($page<ceil($len/$resPerPage)){
                    echo"?module=&action=&page=".$page+1;
                }else{
                    echo "?module=&action=&page=".$page;
                }
            ?> aria-label="Next" >
            <span aria-hidden="true">&raquo;</span>
          </a>

        </li>
      </ul>
    </nav>
</div>
</div>





<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Import file</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form action="?module=upload&action=upload" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3">
                <label for="formFile" class="form-label"></label>
              
                  <label for="file">Choose a file:</label>
                  <input class="form-control" type="file" name="file" id="file">
                  <br>   
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            
              <input class="btn btn-primary" type="submit" name="submit" value="Upload">
        </form>   
      </div>
    </div>
  </div>
</div>



<?php
layouts('footer','');
?>