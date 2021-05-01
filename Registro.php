<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script type="text/javascript" content="text/javascript" src="./Js/Funciones.js"></script>
    <title>Ejercicio</title>
</head>
<body>
    <main class="container-fluid">
        <nav class="navbar navbar-expand-sm navbar-dark bg-danger mx-auto" id="navbar">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="./Registro.php">Registro Empleado</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Lista Empleados</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Devengados</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Deducciones</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Liquidacion Aportes SOI</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Prestaciones Sociales</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Reportes</a></li>
            </ul>
        </nav>
    </main>
    <div class="container d-flex align-items-center justify-content-center p-5">
        <form action="
        <?php 
            include("./Conexionbd.php"); 
            if(isset($_POST['Registro'])){
                $resultado = InsertarEmpleado();
                if($resultado){
                    
                }
            }
        ?>
            " method="post" class="px-5 mx-4 row g-3 border border-3 rounded-3" style="max-width:500px;">
            <div class="col-12">
                <p class="fs-4 text-center font-weight-normal">Registro empleado</p>
            </div>       
            <div class="col-12 col-sm-6">
                <input type="text" placeholder="Nombre" required class="form-control" id="Nombre" name="Nombre">
            </div>
            <div class="col-12 col-sm-6">
                <input type="text" placeholder="Apellido" required class="form-control" id="Apellido" name="Apellido">
            </div>
            <div class="col-12 col-sm-6">
                <input type="number" placeholder="Identificacion" required class="form-control" id="Id" name="Id">
            </div>
            <div class="col-12 col-sm-6">
                <input type="number" placeholder="Sueldo"required class="form-control" id="Sueldo" name="Sueldo">
            </div>                 
            <div class="col-12 col-sm-6 input-group">
                <select id="SelCargo" name="SelCargo" required class="form-select" onchange="seleccionOtro('SelCargo','InputCargo');">
                    <option selected>Seleccione cargo</option>
                    <?php               
                        $sql = "select distinct cargo from empleado";
                        $result = consulta("cargo",$sql);
                        for($i = 0; $i<count($result) ; $i++){
                            echo"<option value='".$result[$i]."'>".$result[$i]."</option>";    
                        }                        
                    ?> 
                    <option value="Otro">Otro</option>                          
                </select>
                <input type="text" readonly="true" required class="input-group-text" id="InputCargo" name="InputCargo">
            </div> 
            <div class="col-12 col-sm-6 input-group">
                <select id="SelCosto" name="SelCosto" required class="form-select" onchange="seleccionOtro('SelCosto','InputCosto');">
                    <option selected>Seleccione costo</option>
                    <?php
                        $sql = "select distinct costo from empleado";
                        $result = consulta("costo",$sql);
                        for($i = 0; $i<count($result) ; $i++){
                            echo"<option value='".$result[$i]."'>".$result[$i]."</option>";    
                        }                        
                    ?>
                    <option value="Otro">Otro</option>                                             
                </select>
                <input type="text" readonly="true" required class="input-group-text" id="InputCosto" name="InputCosto"> 
            </div>
            <div class="col-12 col-sm-6">
                <input type="number" placeholder="Dias laborados" required class="form-control" id="Dias" name="Dias">
            </div>
            <div class="col-12 col-sm-6">
                <select id="SelIndicador" name="SelIndicador" class="form-select">
                    <option selected>Seleccione indicador de Riesgo</option>
                    <option value="Otro">Bajo</option>
                    <option value="Medio">Medio</option>
                    <option value="Alto">Alto</option> 
                </select>
            </div>
            <div class="col-12 col-sm-6">
                <select id="SelClase" name="SelClase" class="form-select">
                    <option selected>Seleccione clase de riesgo</option>
                    <option value="I">I</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="IV">IV</option>
                    <option value="V">V</option> 
                </select>
            </div>
            <div class="col-12 col-sm-6">
                <select id="SelCentro" name="SelCentro" class="form-select">
                    <option selected>Seleccione clase de trabajo</option>
                    <option value="1">1</option>
                    <option value="2">2</option> 
                </select>
            </div>
            <div class="col-12 mb-4">
                <input type="submit" class="form-control btn btn-outline-danger text-center" id="Registro" name="Registro" value="Registrar">
            </div>                   
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>