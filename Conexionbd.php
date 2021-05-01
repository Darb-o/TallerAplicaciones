<?php
function conectar(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db_name="empresabd";
    $link = mysqli_connect($host,$user,$pass) or die("error al conectar la bd".mysqli_error($link));
    mysqli_select_db($link,$db_name) or die ("Error al seleccionar la base de datos".mysqli_error($link));
    return $link;
}

function consulta($consulta,$sql){  
    $link = conectar();
    $result = mysqli_query($link,$sql) or die ("error en la consulta $sql ".mysqli_error($link));
    $i = 0;
    while($row = mysqli_fetch_array($result)){
        $resultado[$i] = $row[$consulta];
        $i++;
    }
    return $resultado;
}

function InsertarEmpleado(){
    $link = conectar();
    $nombre = $_REQUEST['Nombre'];
    $apellido = $_REQUEST['Apellido'];
    $id = $_REQUEST['Id'];
    $sueldo = $_REQUEST['Sueldo'];
    if($_REQUEST['SelCargo']=='Otro'){
        $cargo = $_REQUEST['InputCargo'];
    }else{
        $cargo = $_REQUEST['SelCargo'];
    }
    if($_REQUEST['SelCosto']=='Otro'){
        $costo = $_REQUEST['InputCosto'];
    }else{
        $costo = $_REQUEST['SelCosto'];
    }
    $dias = $_REQUEST['Dias'];
    $indicador = $_REQUEST['SelIndicador'];
    $clase = $_REQUEST['SelClase'];
    $centro = $_REQUEST['SelCentro'];
    $sql = "insert into empleado values($id,'$nombre','$apellido',$sueldo,'$cargo','$costo',$dias,'$indicador','$clase',$centro)";
    $result = mysqli_query($link,$sql) or die ("error en la consulta $sql ".mysqli_error($link));
    return $result;
}
?>

