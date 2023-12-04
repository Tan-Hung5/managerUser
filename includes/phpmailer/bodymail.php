<?php
function bodyMail($code) {
    
return   '<hr>
            <div style=" text-align: center;">
                <div class="row r"><p>Please dont share this code for anyone</p></div>
                <div class="row "><p>This code is valid for 3 minutes</p></div>
            </div>
            <div class="" style=" border: 1px solid black; 
            padding: 10px;
            border-radius: 20px;
            height: fit-content;
            width: fit-content;
            background-color: rgba(245, 244, 244, 0.991);
            display: flex;
            justify-content: center;
            align-items: center;
            ">
                <div style=" width:600px; height:200px ; " >
                    <div class="row justify-content-center text-center" style="
                    justify-content: center;
                    align-items: center;
                    text-align: center;
                    ">
                        <h1 style=" color:blue; " >Your Active Code</h1>
                        <h2 class="m-5 " style="font-weight: 900;letter-spacing: 4px;" id="">'.$code.'</h2> 
                    </div>
                    
                </div>
            </div>
        <hr> ';
}
?>