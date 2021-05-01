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
    $sql2 = "insert into deducciones (id) values($id)";
    $sql3 = "insert into devengados (id) values($id)";
    $result = mysqli_query($link,$sql) or die ("error en la consulta $sql ".mysqli_error($link));
    mysqli_query($link,$sql2) or die ("error en la consulta $sql ".mysqli_error($link));
    mysqli_query($link,$sql3) or die ("error en la consulta $sql ".mysqli_error($link));
    return $result;
}

function EditarDevengados(){
    $link = conectar();
    $id = $_REQUEST['SelEmp'];
    if($_REQUEST['InputVD'] != ''){
        $vaca = $_REQUEST['InputVD'];
    }else if($_REQUEST['InputVC'] != ''){
        $vaca = $_REQUEST['InputVC'];
    }else{
        $vaca = 0; 
    }

    if($_REQUEST['InputDE'] != ''){
        $inc = $_REQUEST['InputDE'];
        $tipo = 'd';
    }else if($_REQUEST['InputEE'] != ''){
        $inc = $_REQUEST['InputEE'];
        $tipo = 'e';
    }else{
        $inc = 0;
        $tipo = 'n'; 
    }

    if($_REQUEST['InputHE'] != ''){
        $he = $_REQUEST['InputHE'];
    }else{
        $he = 0;
    }

    if($_REQUEST['InputRC'] != ''){
        $rc = $_REQUEST['InputRC'];
    }else{
        $rc = 0;
    }

    if($_REQUEST['InputHD'] != ''){
        $do = $_REQUEST['InputHD'];
    }else{
        $do = 0;
    }
    $sql = "update devengados
    set dias_v = $vaca, dias_i = $inc, tipo_i = '$tipo', extra = $he,recargo = $rc, dominicales = $do 
    WHERE id = $id";
    $result = mysqli_query($link,$sql) or die ("error en la consulta $sql ".mysqli_error($link));
}
?>

