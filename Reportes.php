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
                    $dias_l=consulta("dia_l","select dia_l from empleado");
                    $sueldo= consulta("sueldo","select sueldo from empleado");
                    $dias_vd=consulta("dias_vd","select dias_vd from devengados");
                    $dias_vc=consulta("dias_vc","select dias_vc from devengados");
                    $dias_i=consulta("dias_i","select dias_i from devengados");
                    $tipo_i=consulta("tipo_i","select tipo_i from devengados");
                    $extra=consulta("extra","select extra from devengados");
                    $recargo=consulta("recargo","select recargo from devengados");
                    $dominicales=consulta("dominicales","select dominicales from devengados");
                ?>
                <table class="table table-danger table-striped table-bordered border-dark">
                    <tr>
                        <th colspan=4>REPORTES</th>
                    </tr>
                    <tr>
                    <th>Cedula</th><th>COSTOS A CARGO DE LA EMPRESA DIARIO</th><th>COSTOS A CARGO DE LA EMPRESA MENSUAL</th><th>COSTOS A CARGO DE LA EMPRESA ANUAL</th>
                    </tr>
                    <?php
                    $totalD=0;
                    $totalM=0;
                    $totalA=0;
                        for($i = 0; $i<count($id) ; $i++){
                            $salariod=round(($sueldo[$i]/30)*$dias_l[$i]);
                            if($dias_vd != 0){
                                $vacacionesd=round(($sueldo[$i]/30)*$dias_vd[$i]);
                            }else{
                                $vacacionesd=0;
                            }
                            if($dias_vc != 0){
                                $vacacionesc=round(($sueldo[$i]/30)*$dias_vc[$i]);
                            }else{
                                $vacacionesc=0;
                            }
                            if($sueldo[$i]<1817052){
                               $auxilioT=round((106454/30)*$dias_l[$i]);
                            }else{
                                $auxilioT=0;
                            }
                            if(strcmp($tipo_i[$i],"d")){
                                //ARl
                                $Iemp=0;
                                $IEPS=0;
                                $IARL=round(($sueldo[$i]/30)*$dias_i[$i]);
                            }else{
                                //EPS y empleador
                                if($dias_i>2){
                                    $Iemp=round(($sueldo[$i]/30)*2);
                                    $IEPS=round(((($sueldo[$i]/30)*($dias_i[$i]-2))*66.6)/100);
                                    $IARL=0;
                                }else{
                                    $Iemp=round(($sueldo[$i]/30)*2);
                                    $IEPS=0;
                                    $IARL=0;
                                }
                            }
                            if($extra[$i]>0){
                               $hExtra=(round((((($sueldo[$i]/30)/8)*25)/100)+(($sueldo[$i]/30)/8)))*$extra[$i];
                            }else{
                                $hExtra=0;
                            }
                            //recargo nocturno
                            if($recargo[$i]>0){
                                $nocturno=(round((((($sueldo[$i]/30)/8)*35)/100)+(($sueldo[$i]/30)/8)))*$recargo[$i];
                            }else{
                                $nocturno=0;
                            }
                            //dominicales
                            if($dominicales>0){
                                $dom=(round((((($sueldo[$i]/30)/8)*75)/100)+(($sueldo[$i]/30)/8)))*$dominicales[$i];
                            }else{
                                $dom=0;
                            }
                            //Auxilio de alimentacion
                            if($sueldo[$i]<1817052){
                                $auxilioA=round((150000/30)*$dias_l[$i]);
                            }else{
                                $auxilioA=0;
                            }
                            $devengadoT=$salariod+$vacacionesd+$vacacionesc+$auxilioT+$Iemp+$IEPS+$IARL+$hExtra+$nocturno+$dom+$auxilioT;
                            //Aporte pension Hermes
                            $base=$sueldo[$i]+($hExtra=(round((((($sueldo[$i]/30)/8)*25)/100)+(($sueldo[$i]/30)/8)))*$extra[$i])+(round(($sueldo[$i]/30)*$dias_vc[$i]));
                            $AportePensionH=round(($base*12)/100);
                            $AporteARL=round(($base*0.525)/100);
                            $AporteCaja=round(($base*4)/100);
                            $prima=round((($hExtra+$auxilioT+$sueldo[$i])*8.33)/100);
                            $cesantias=round((($hExtra+$auxilioT+$sueldo[$i])*8.33)/100);
                            $interesC=round($cesantias*(($dias_l[$i]*12)/100)/360);
                            $vacaciones=round($sueldo[$i]*4.17)/100; 
                            $total=$prima+$cesantias+$interesC+$vacaciones;
                            $reporteM=$devengadoT+$AportePensionH+$AporteCaja+$AporteARL+$total;
                            $reporteD=round($reporteM/30);
                            $reporteA=$reporteM*12;
                            $totalD+=$reporteD;
                            $totalM+=$reporteM;
                            $totalA+=$reporteA;
                            echo"<tr>
                            <td>".$id[$i]."</td>
                            <td>".$reporteD."</td>
                            <td>".$reporteM."</td>
                            <td>".$reporteA."</td>
                            </tr>";
                        }
                        echo"<tr>
                            <td></td>
                            <th>".$totalD."</th>
                            <th>".$totalM."</th>
                            <th>".$totalA."</th>
                            </tr>";
                        
                    ?>
                    
                </table>
    </div>
</body>
</html>