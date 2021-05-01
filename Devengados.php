<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script type="text/javascript" content="text/javascript" src="./Js/Funciones.js"></script>
    <title>Lista devengados</title>
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
                    if(isset($_POST['Agregar'])){
                        $resultado = EditarDevengados();
                        if($resultado){                     
                        }
                    }
                ?>
                "method="post" class="p-3">
                    <div class="row row g-0">
                        <div class="col-12">
                            <p class="fs-5 mt-2 text-center font-weight-normal">Agregar datos devengados del empleado</p>
                        </div>
                        <div class="col-12">
                            <select id="SelEmp" name="SelEmp" required class="form-select">
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
                        <label class="col-12 mb-2 fs-6 text-muted fw-bold" for="">El empleado tuvo vacaciones? seleccione una de las dos opciones</label>
                        <div class="col-12 col-mb-5 input-group mb-2">    
                            <div class=" input-group-text">
                                <input class="form-check-input mt-0" onclick="desactivar('CmbVD','CmbVC','InputVD');" type="checkbox" value="" id="CmbVD" name="CmbVD">
                            </div>
                            <input type="number" class="form-control" readonly="true" placeholder="Vacaciones disfrutadas (dias)" id="InputVD" name="InputVD">
                        </div>
                        <div class="col-12 col-mb-5 input-group mb-2">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" onclick="desactivar('CmbVD','CmbVC','InputVC');" type="checkbox" value="" id="CmbVC" name="CmbVC">
                            </div>
                            <input type="number" class="form-control"  readonly="true" placeholder="Vacaciones compensadas (dias)" id="InputVC" name="InputVC" >
                        </div>
                        <label class="col-12 mb-2 text-muted fw-bold" for="">El empleado tuvo horas extras? digite en horas</label>
                        <div class="col-12 input-group mb-3">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" onclick="inputs('CmbHE','InputHE','1');" type="checkbox" value="" id="CmbHE" name="CmbHE">
                            </div>
                            <input type="number" class="form-control"  readonly="true" placeholder="Horas extra (horas)" id="InputHE" name="InputHE" >
                        </div>
                        <div class="col-12 input-group mb-3">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" onclick="inputs('CmbRC','InputRC','1');" type="checkbox" value="" id="CmbRC" name="CmbRC">
                            </div>
                            <input type="number" class="form-control"  readonly="true" placeholder="Recargo nocturno (horas)" id="InputRC" name="InputRC" >
                        </div>
                        <div class="col-12 input-group mb-3">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" onclick="inputs('CmbHD','InputHD','1');" type="checkbox" value="" id="CmbHD" name="CmbHD">
                            </div>
                            <input type="number" class="form-control" readonly="true" placeholder="Dominicales (horas)" id="InputHD" name="InputHD" >
                        </div>
                        <label class="col-12 mb-2 text-muted fw-bold" for="">El empleado tuvo alguna incapacidad? seleccione una de las dos opciones</label>
                        <div class="col-12 col-mb-5 input-group mb-2">    
                            <div class=" input-group-text">
                                <input class="form-check-input mt-0" onclick="desactivar('CmbDE','CmbEE','InputDE');" type="checkbox" value="" id="CmbDE" name="CmbDE">
                            </div>
                            <input type="number" class="form-control" readonly="true" placeholder="Dentro de la empresa (dias)" id="InputDE" name="InputDE">
                        </div>
                        <div class="col-12 col-mb-5 input-group mb-2">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" onclick="desactivar('CmbDE','CmbEE','InputEE');" type="checkbox" value="" id="CmbEE" name="CmbEE">
                            </div>
                            <input type="number" class="form-control"  readonly="true" placeholder="Externo a la empresa (dias)" id="InputEE" name="InputEE" >
                        </div>
                        <div class="col-12 mb-4">
                            <input type="submit" class="form-control btn btn-outline-danger text-center" id="Agregar" name="Agregar" value="Agregar">
                        </div> 
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-9">
                <p>aqui es para poner la tabla de los devengados</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>