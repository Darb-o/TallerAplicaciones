<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script type="text/javascript" content="text/javascript" src="./Js/Funciones.js"></script>
    <title>Registro Empleado</title>
</head>
<body>
    <main class="container-fluid">
        <nav class="navbar navbar-expand-sm navbar-dark bg-danger mx-auto" id="navbar">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="./Registro.php">Registro Empleado</a></li>
                <li class="nav-item"><a class="nav-link" href="./Devengados.php">Devengados</a></li>
                <li class="nav-item"><a class="nav-link" href="./Deducciones.php">Deducciones</a></li>
                <li class="nav-item"><a class="nav-link" href="./Liquidacion.php">Liquidacion Aportes SOI</a></li>
                <li class="nav-item"><a class="nav-link" href="./Prestaciones.php">Prestaciones Sociales</a></li>
                <li class="nav-item"><a class="nav-link" href="./Reportes.php">Reportes</a></li>
                <li class="nav-item"><a class="nav-link" href="./Nomina.php">Nomina</a></li>
            </ul>
        </nav>
    </main>
    <div class="container-fluid border-3 h-100">
                <?php 
                    include("./Conexionbd.php"); 
                    $id = consulta("id","select id from empleado");
                    $ite = consulta("ite","select ite from empleado");
                    $clase_r = consulta("clase_r","select clase_r from empleado");
                    $centro_t = consulta("centro_t","select centro_t from empleado");
                    $sueldo= consulta("sueldo","select sueldo from empleado");
                    $dias_vc=consulta("dias_vc","select dias_vc from devengados");
                    $extra=consulta("extra","select extra from devengados");
                ?>
                <table class="table table-danger table-striped table-bordered border-dark">
                    <tr>
                        <td colspan=4></td><th colspan=8>LIQUIDACION APORTES SOI</th>
                    </tr>
                    <tr>
                    <th>Cedula</th><th>Indicador tarifa Especial (pensión)</th><th>Clase de Riesgo</th><th>Centro de Trabajo</th><th>BASE PARA LOQUIDACION DE APORTES</th><th>APORTES EPS EMPLEADO 4%</th><th>FSP 1%</th><th>APORTES PENSION EMPLEADO 4%</th><th>APORTES PENSION HERMES 12%</th><th>APORTES HERMES ARL</th><th>APORTE HERMES CAJA DE COM 4%</th><th>TOTALES</th>
                    </tr>
                    <?php
                        $baseT=0;
                        $AporteEPST=0;
                        $FSPT=0;
                        $AportePensionT=0;
                        $AportePensionHT=0;
                        $AporteARLT=0;
                        $AporteCajaT=0;
                        $totales=0;
                        for($i = 0; $i<count($id) ; $i++){
                            $base=$sueldo[$i]+($hExtra=(round((((($sueldo[$i]/30)/8)*25)/100)+(($sueldo[$i]/30)/8)))*$extra[$i])+(round(($sueldo[$i]/30)*$dias_vc[$i]));
                            $AporteEPS=round(($base*4)/100);
                            if($sueldo[$i]>3634104){
                                $FSP=round(($sueldo[$i]*1)/100);
                            }else if($sueldo[$i]>18170520){
                                $FSP=round(($sueldo[$i]*2)/100);
                            }else{
                                $FSP=0;
                            }
                            $AportePension=round(($base*4)/100);
                            $AportePensionH=round(($base*12)/100);
                            $AporteARL=round(($base*0.525)/100);
                            $AporteCaja=round(($base*4)/100);
                            $total=$AporteEPS+$FSP+$AportePension+$AportePensionH+$AporteARL+$AporteCaja;

                            echo"<tr>
                                <td>".$id[$i]."</td>
                                <td>".$ite[$i]."</td>
                                <td>".$clase_r[$i]."</td>
                                <td>".$centro_t[$i]."</td>
                                <td>".$base."</td>
                                <td>".$AporteEPS."</td>
                                <td>".$FSP."</td>
                                <td>".$AportePension."</td>
                                <td>".$AportePensionH."</td>
                                <td>".$AporteARL."</td>
                                <td>".$AporteCaja."</td>
                                <th>".$total."</th>  
                                </tr>";
                            $baseT+=$base;
                            $AporteEPST+=$AporteEPS;
                            $FSPT+=$FSP;
                            $AportePensionT+=$AportePension;
                            $AportePensionHT+=$AportePensionH;
                            $AporteARLT+=$AporteARL;
                            $AporteCajaT+=$AporteCaja;
                            $totales+=$total;
                        }
                        echo"<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>".$baseT."</th>
                            <th>".$AporteEPST."</th>
                            <th>".$FSPT."</th>
                            <th>".$AportePensionT."</th>
                            <th>".$AportePensionHT."</th>
                            <th>".$AporteARLT."</th>
                            <th>".$AporteCajaT."</th>
                            <th>".$totales."</th>  
                            </tr>";
                    ?>
                    
                </table>
    </div>
</body>
</html>