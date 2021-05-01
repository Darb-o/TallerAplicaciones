<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script type="text/javascript" content="text/javascript" src="./Js/Funciones.js"></script>
    <title>Lista deducciones</title>
</head>
<body>
    <main class="container-fluid">
        <nav class="navbar navbar-expand-sm navbar-dark bg-danger mx-auto" id="navbar">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="./Registro.php">Registro Empleado</a></li>
                <li class="nav-item"><a class="nav-link" href="./Devengados.php">Devengados</a></li>
                <li class="nav-item"><a class="nav-link" href="./Deducciones.php">Deducciones</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Liquidacion Aportes SOI</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Prestaciones Sociales</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Reportes</a></li>
            </ul>
        </nav>
    </main>
    <div class="container-fluid border border-3 h-100">
        <div class="row">
            <div class="col-12 col-md-3">
                <form action="
                <?php 
                    include("./Conexionbd.php");
                    if(isset($_POST['Editar'])){
                        $resultado = EditarDeducciones();
                        if($resultado){                     
                        }
                    }
                ?>
                "method="post" class="p-3">
                    <div class="row row g-0">
                        <div class="col-12">
                            <p class="fs-5 mt-2 text-center font-weight-normal">Agregar deducciones del empleado</p>
                        </div>
                        <div class="col-12">
                            <select id="SelEmpleado" name="SelEmpleado" required class="form-select">
                                <option selected>Seleccione empleado</option>
                                <?php                                                 
                                    $sql = "select id from empleado";
                                    $result = consulta("id",$sql);
                                    for($i = 0; $i<count($result) ; $i++){
                                        echo"<option value='".$result[$i]."'>".$result[$i]."</option>";    
                                    }                        
                                ?>
                            </select>
                        </div>
                        <label class="col-12 mb-2 fs-6 text-muted fw-bold" for="">El empleado solicito anticipacion de nomina?</label>               
                        <div class="col-12 input-group mb-3">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" onclick="inputs('CmbAN','InputAN','1');" type="checkbox" value="" id="CmbAN" name="CmbAN">
                            </div>
                            <input type="number" class="form-control"  readonly="true" placeholder="Valor del anticipo (COP)" id="InputAN" name="InputAN" >
                        </div>
                        <label class="col-12 mb-2 fs-6 text-muted fw-bold" for="">El empleado solicito un prestamo?</label>
                        <div class="col-12 input-group mb-3">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" onclick="inputs('CmbPR','InputPR','2');" type="checkbox" value="" id="CmbPR" name="CmbPR">
                            </div>
                            <input type="number" class="form-control"  readonly="true" placeholder="Valor del prestamo (COP)" id="InputPR" name="InputPR" >
                        </div>
                        <div class="col-12 input-group mb-3">
                            <input type="date"  readonly="true" class="form-control" id="InputFecha" name="InputFecha">
                        </div>
                        <div class="col-12 input-group mb-3">
                            <input type="number" readonly="true" placeholder="A cuantas cuotas" class="form-control" id="InputCuota" name="InputCuota">
                        </div>
                        <div class="col-12 mb-4">
                            <input type="submit" class="form-control btn btn-outline-danger text-center" id="Editar" name="Editar" value="Agregar">
                        </div> 
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-9">
                <p>aqui es para poner la tabla de las deducciones</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>