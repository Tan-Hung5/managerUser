<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;

layouts('header','');

function printData($data=[],$islogin){
    foreach($data as $key=>$value){
       if($islogin){ echo '
                    <tr>
                        <td>'.$key.'</td>
                        <td>'.$value['ID'].'</td>
                        <td>'.$value['username'].'</td>
                        <td>'.$value['phone'].'</td>
                        <td>',$value['email'],'</td> 
                        <td  class=" text-end">               
                        	<div style="width:280px;" class="d-inline text-end" ">
		                        <a type="submit" name="btnAdd" href="?module=user&action=edit&id='.$value['ID'].'" class="btn btn-primary m-1" >
		                          Edit User
		                        </a>
		                          <a class="btn btn-danger" href="?module=user&action=delete&id='.$value['ID'].'" >Delete</a>
		                    </div>
                        </td>	               
                    </tr>';
       }else{
        echo '
        <tr>
            <td>'.$key.'</td>
            <td>'.$value['ID'].'</td>
            <td>'.$value['username'].'</td>
            <td>'.$value['phone'].'</td>
            <td>',$value['email'],'</td> 
            <td>',$value['role'],'</td> 
            <td></td>
                           
        </tr>';
       }
    }
}



?>




