<?php
(!defined('_CODE'))? die('Truy cap khong hop le'):false;

function query($sql, $data=[], $check=false){
    global $conn;
    $try = false;
    try {
        $stmt = $conn->prepare($sql);

        if(!empty($data)){
            $try = $stmt -> execute($data);
        }else{
            $try = $stmt -> execute();
        }
    }  catch (PDOException $e) {
        error_log("PDOException: " . $e->getMessage() . " ở " . $e->getFile() . " dòng " . $e->getLine());
        die($e->getMessage());
    }
    if($check=true){
        return $stmt;
    }
    return $try;
};

//INSERT DATA
function insert($table, $data){
    $key = array_keys($data);
    $truong = implode(',', $key);
    $value = ':'.implode(',:', $key);

    $sql = 'INSERT INTO ' . $table . ' (' . $truong . ') VALUES (' .$value. ')';

    $res = query($sql, $data);
    return $res;
} 

//UPDATE DATA
function update($table, $data, $condition=''){
    $update = '';
    foreach ($data as $key => $value) {
        $update .= $key .' = :'. $key .',';
    }
    $update = trim($update,',');
    if(!empty($condition)){
        $sql = 'UPDATE '. $table .' SET '.$update .' WHERE '. $condition;

    }else{
        $sql = 'UPDATE '. $table .' SET '.$update;
    }
     query($sql, $data);
} 

//DELETE DATA
function DeleteUser($table, $condition=''){
    if(empty($condition)){
        $sql = 'DELETE FROM '.$table;

    }else{
        $sql = 'DELETE FROM '. $table .' WHERE '. $condition;
    }
    $res = query($sql);
    return $res;
}


//SELECT DATA
function selectAllRaw($sql){
    $res = query($sql,'',true);
    if(is_object($res)){
        $res = $res -> fetchAll(PDO::FETCH_ASSOC);
        return $res;
    } 
}

//SELECT DATA 1 RAW
function select1Raw($sql){
    $res = query($sql,'',true);
    if(is_object($res)){
        $res = $res -> fetch(PDO::FETCH_ASSOC);
        return $res;
    } 
}

//GET ROW
function getRows($sql){
    $res = query($sql,'',true);
    if(!empty($res)){
        return $res -> rowCount();
    }
}
?>
