<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script type="text/javascript" content="text/javascript" src="./Js/Funciones.js"></script>
    <title>Registro Empleado</title>
</head>
<style type="text/css">
    table th {
        text-align: center;
    }
</style>
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
                    $nombre = consulta("nombre","select nombre from empleado");
                    $apellido = consulta("apellido","select apellido from empleado");
                    $sueldo= consulta("sueldo","select sueldo from empleado");
                    $cargo=consulta("cargo","select cargo from empleado");
                    $costo=consulta("costo","select costo from empleado");
                    $dias_l=consulta("dia_l","select dia_l from empleado");
                    $ite = consulta("ite","select ite from empleado");
                    $clase_r = consulta("clase_r","select clase_r from empleado");
                    $centro_t = consulta("centro_t","select centro_t from empleado");
                    $dias_vd=consulta("dias_vd","select dias_vd from devengados");
                    $dias_vc=consulta("dias_vc","select dias_vc from devengados");
                    $dias_i=consulta("dias_i","select dias_i from devengados");
                    $tipo_i=consulta("tipo_i","select tipo_i from devengados");
                    $extra=consulta("extra","select extra from devengados");
                    $recargo=consulta("recargo","select recargo from devengados");
                    $dominicales=consulta("dominicales","select dominicales from devengados");
                    $anticipo=consulta("anticipo","select anticipo from deducciones");
                    $valor_p=consulta("valor_p","select valor_p from deducciones");
                    $cuota=consulta("cuota","select cuota from deducciones");
                    $cuotaA=consulta("cuotaAc","select cuotaAc from deducciones");
                    $fecha=consulta("fecha","select fecha from deducciones");
                ?>
                <div class="overflow-auto">
                <!-- -->
                <table class="table table-danger table-striped table-bordered border-dark">
                <tr>
                        <th colspan=6 rowspan=2 style="background-color: aliceblue ;">INFORMACION GENERAL</th><th colspan=13 rowspan=2>DEVENGADOS</th><th colspan=14>DEDUCCIONES</th><th rowspan=2></th><td colspan=3 rowspan=2></td><th colspan=8 rowspan=2>LIQUIDACION APORTES SOI</th><th colspan=5 rowspan=2>PRESTACIONES SOCIALES</th><th colspan=4 rowspan=2>REPORTES</th>
                     </tr>
                     <tr>
                        <th colspan=5>Deducciones Nominales</th><th colspan=9>Deduciones Por Prestamos</th>
                     </tr>
                    <tr>
                        <th>Nombre</th><th>Apellido</th><th>Costo</th><th>Cargo</th><th>Identificaci&oacuten</th><th>Sueldo</th><th>Dias Laborados</th><th>Salario segun dias laborados</th><th>Vacaciones disfrutadas</th><th>Vacaciones compensadas</th><th>Auxilio de transporte</th><th>Auxilio monetario por incapacidad (empleador)</th><th>Pago incapacidad EPS</th><th>Pago incapacidad ARL</th>
                        <th>Extra Turno</th><th>Recargo nocturno</th><th>H. Dominicales</th><th>Aux. Alimentacion no prestacional</th><th>Total devengado</th><th>Salud</th><th>Pension</th><th>Fondo de Solidaridad Pensional</th><th>Anticipos de nomina</th><th>Pago vacaciones</th><th>Monto de desembolso</th><th>No de Cuotas a descontar</th><th>Fecha del desembolso</th><th>No de cuota pagada</th><th>Cuotas por descontar</th><th>Nomina en que termina el prestamo</th><th>Valor cuota</th><th>Saldo Prestamo</th><th>Total Deducciones</th>
                        <th>TOTAL NOMINA</th><th>Indicador tarifa Especial (pensión)</th><th>Clase de Riesgo</th><th>Centro de Trabajo</th><th>BASE PARA LOQUIDACION DE APORTES</th><th>APORTES EPS EMPLEADO 4%</th><th>FSP 1%</th><th>APORTES PENSION EMPLEADO 4%</th><th>APORTES PENSION HERMES 12%</th><th>APORTES HERMES ARL</th><th>APORTE HERMES CAJA DE COM 4%</th><th>TOTALES</th>
                        <th>PRIMA</th><th>CESANTIAS</th><th>INTERES DE CESANTIAS</th><th>VACACIONES</th><th>TOTALES</th><th>COSTOS A CARGO DE LA EMPRESA DIARIO</th><th>COSTOS A CARGO DE LA EMPRESA MENSUAL</th><th>COSTOS A CARGO DE LA EMPRESA ANUAL</th>
                    </tr>
                    <?php
                    $salariodT=0;
                    $vacacionescT=0;
                    $vacacionesdT=0;
                    $auxilioTT=0;
                    $IempT=0;
                    $IEPST=0;
                    $IARLT=0;
                    $hExtraT=0;
                    $nocturnoT=0;
                    $domT=0;
                    $auxilioAT=0;
                    $TotalDevendagosT=0;
                    $saludT=0;
                    $pensionT=0;
                    $fondopT=0;
                    $anticipoT=0;
                    $pagoVT=0;
                    $valorcuotaT=0;
                    $totalDeducciones=0;
                    $totalNominaT=0;
                    $baseT=0;
                    $AporteEPST=0;
                    $FSPT=0;
                    $AportePensionT=0;
                    $AportePensionHT=0;
                    $AporteARLT=0;
                    $AporteCajaT=0;
                    $totalesLiquidacionT=0;
                    $primaT=0;
                    $cesantiasT=0;
                    $interesCT=0;
                    $vacacionesT=0; 
                    $totalPrestacionesT=0;
                    $totalD=0;
                    $totalM=0;
                    $totalA=0;
                    for($i = 0; $i<count($id) ; $i++){
                        echo"<tr>
                            <td>".$nombre[$i]."</td>
                            <td>".$apellido[$i]."</td>
                            <td>".$costo[$i]."</td>
                            <td>".$cargo[$i]."</td>
                            <td>".$id[$i]."</td>
                            <td>".$sueldo[$i]."</td>";
                            $salariod=round(($sueldo[$i]/30)*$dias_l[$i]);
                        $salariodT+=$salariod;
                        if($dias_vd != 0){
                            $vacacionesd=round(($sueldo[$i]/30)*$dias_vd[$i]);
                        }else{
                            $vacacionesd=0;
                        }
                        $vacacionesdT+=$vacacionesd;
                        if($dias_vc != 0){
                            $vacacionesc=round(($sueldo[$i]/30)*$dias_vc[$i]);
                        }else{
                            $vacacionesc=0;
                        }
                        $vacacionescT+=$vacacionesc;
                        if($sueldo[$i]<1817052){
                            $auxilioT=round((106454/30)*$dias_l[$i]);
                        }else{
                            $auxilioT=0;
                        }
                        $auxilioTT+=$auxilioT;
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
                        $IempT+=$Iemp;
                        $IEPST+=$IEPS;
                        $IARLT+=$IARL;
                        if($extra[$i]>0){
                            $hExtra=(round(((($sueldo[$i]/30)/8)*25/100)+(($sueldo[$i]/30)/8)))*$extra[$i];
                        }else{
                            $hExtra=0;
                        }
                        $hExtraT+=$hExtra;
                        //recargo nocturno
                        if($recargo[$i]>0){
                            $nocturno=(round((((($sueldo[$i]/30)/8)*35)/100)+(($sueldo[$i]/30)/8)))*$recargo[$i];
                        }else{
                            $nocturno=0;
                        }
                        $nocturnoT+=$nocturno;
                        //dominicales
                        if($dominicales>0){
                            $dom=(round((((($sueldo[$i]/30)/8)*75)/100)+(($sueldo[$i]/30)/8)))*$dominicales[$i];
                        }else{
                            $dom=0;
                        }
                        $domT+=$dom;
                        //Auxilio de alimentacion
                        if($sueldo[$i]<1817052){
                            $auxilioA=round((150000/30)*$dias_l[$i]);
                        }else{
                            $auxilioA=0;
                        }
                        $auxilioAT+=$auxilioA;
                        $devengadoT=$salariod+$vacacionesd+$vacacionesc+$auxilioT+$Iemp+$IEPS+$IARL+$hExtra+$nocturno+$dom+$auxilioT;
                        $TotalDevendagosT+=$devengadoT;
                        
                        echo"
                            <td>".$dias_l[$i]."</td>
                            <td>$".$salariod."</td>
                            <td>$".$vacacionesd."</td>
                            <td>$".$vacacionesc."</td>
                            <td>$".$auxilioT."</td>
                            <td>$".$Iemp."</td>
                            <td>$".$IEPS."</td>
                            <td>$".$IARL."</td>
                            <td>$".$hExtra."</td>
                            <td>$".$nocturno."</td>
                            <td>$".$dom."</td>
                            <td>$".$auxilioA."</td>
                            <th>$".$devengadoT."</th>
                            ";
                        //DECUCCIONES
                        $salud=($sueldo[$i]+$hExtra+$vacacionesc)*4/100;
                            $pension=$salud;
                            if($sueldo[$i]>3634104){
                                $fondop=round(($sueldo[$i]*1)/100);
                            }else if($sueldo[$i]>18170520){
                                $fondop=round(($sueldo[$i]*2)/100);
                            }else{
                                $fondop=0;
                            }
                            if($anticipo[$i]!=null){
                                $anticipoNom=$anticipo[$i];
                            }else{
                                $anticipoNom=0;
                            }
                            $pagoV=round(($sueldo[$i]/30)*$dias_vd[$i]);
                            if($valor_p[$i]!=null){
                                $montoD=$valor_p[$i];
                                $Nocuotas=$cuota[$i];
                                $fechaD=$fecha[$i];
                                $NocuotaA=$cuotaA[$i];
                                $cpDescontar=$Nocuotas-$NocuotaA;
                                $fechat=explode('-',$fecha[$i]);
                                $año=intval($fechat[0]);
                                $mes=intval($fechat[1]);
                                if(($mes+($Nocuotas-1))>12){
                                    $año++;
                                    $mes=(($mes+($Nocuotas-1))-12);
                                }else{
                                    $mes=$mes+($Nocuotas-1);
                                }
                                if($mes==1){
                                    $fechafinal="Enero ".$año;
                                }
                                if($mes==2){
                                    $fechafinal="Febrero ".$año;
                                }
                                if($mes==3){
                                    $fechafinal="Marzo ".$año;
                                }
                                if($mes==4){
                                    $fechafinal="Abril ".$año;
                                }
                                if($mes==5){
                                    $fechafinal="Mayo ".$año;
                                }
                                if($mes==6){
                                    $fechafinal="Junio ".$año;
                                }
                                if($mes==7){
                                    $fechafinal="Julio ".$año;
                                }
                                if($mes==8){
                                    $fechafinal="Agosto ".$año;
                                }
                                if($mes==9){
                                    $fechafinal="Septiembre ".$año;
                                }
                                if($mes==10){
                                    $fechafinal="Octubre ".$año;
                                }
                                if($mes==11){
                                    $fechafinal="Noviembre ".$año;
                                }
                                if($mes==12){
                                    $fechafinal="Diciembre ".$año;
                                }
                                $valorcuota=round($montoD/$Nocuotas);
                                $saldo=$valorcuota*$cpDescontar;
                            }else{
                                $montoD=0;
                                $Nocuotas="";
                                $fechaD=" ";
                                $NocuotaA=" ";
                                $cpDescontar=" ";
                                $fechafinal=" ";
                                $valorcuota=0;
                                $saldo=0;
                            }
                            $deduccionesT=$salud+$pension+$fondop+$pagoV+$valorcuota;
                            $totalNomina=$devengadoT-$deduccionesT;
                            echo"
                                <td>$".$salud."</td>
                                <td>$".$pension."</td>
                                <td>$".$fondop."</td>
                                <td>$".$anticipoNom."</td>
                                <td>$".$pagoV."</td>
                                <td>$".$montoD."</td>
                                <td>".$Nocuotas."</td>
                                <td>".$fechaD."</td>
                                <td>".$NocuotaA."</td>
                                <td>".$cpDescontar."</td>
                                <td>".$fechafinal."</td>
                                <td>$".$valorcuota."</td>
                                <td>$".$saldo."</td>
                                <th>$".$deduccionesT."</th>
                                <th>$".$totalNomina."</th>";
                            $saludT+=$salud;
                            $pensionT+=$pension;
                            $fondopT+=$fondop;
                            $anticipoT+=$anticipoNom;
                            $pagoVT+=$pagoV;
                            $valorcuotaT+=$valorcuota;
                            $totalDeducciones+=$deduccionesT;
                            $totalNominaT+=$totalNomina;
                            //Liquidacion Aportes SOI
                            $base=$sueldo[$i]+$hExtra+$vacacionesc;
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
                            $totalLiquidacion=$AporteEPS+$FSP+$AportePension+$AportePensionH+$AporteARL+$AporteCaja;

                            echo"
                                <td>".$ite[$i]."</td>
                                <td>".$clase_r[$i]."</td>
                                <td>".$centro_t[$i]."</td>
                                <td>$".$base."</td>
                                <td>$".$AporteEPS."</td>
                                <td>$".$FSP."</td>
                                <td>$".$AportePension."</td>
                                <td>$".$AportePensionH."</td>
                                <td>$".$AporteARL."</td>
                                <td>$".$AporteCaja."</td>
                                <th>$".$totalLiquidacion."</th>";
                            $baseT+=$base;
                            $AporteEPST+=$AporteEPS;
                            $FSPT+=$FSP;
                            $AportePensionT+=$AportePension;
                            $AportePensionHT+=$AportePensionH;
                            $AporteARLT+=$AporteARL;
                            $AporteCajaT+=$AporteCaja;
                            $totalesLiquidacionT+=$totalLiquidacion;
                            //Prestaciones sociales
                            $prima=round((($hExtra+$auxilioT+$sueldo[$i])*8.33)/100);
                            $cesantias=round((($hExtra+$auxilioT+$sueldo[$i])*8.33)/100);
                            $interesC=round($cesantias*(($dias_l[$i]*12)/100)/360);
                            $vacaciones=round($sueldo[$i]*4.17)/100; 
                            $totalPrestaciones=$prima+$cesantias+$interesC+$vacaciones;
                            echo"
                                <td>$".$prima."</td>
                                <td>$".$cesantias."</td>
                                <td>$".$interesC."</td>
                                <td>$".$vacaciones."</td>
                                <th>$".$totalPrestaciones."</th>";
                            $primaT+=$prima;
                            $cesantiasT+=$cesantias;
                            $interesCT+=$interesC;
                            $vacacionesT+=$vacaciones; 
                            $totalPrestacionesT+=$totalPrestaciones;
                            //Reportes
                            $reporteM=$devengadoT+$AportePensionH+$AporteCaja+$AporteARL+$totalPrestaciones;
                            $reporteD=round($reporteM/30);
                            $reporteA=$reporteM*12;
                            $totalD+=$reporteD;
                            $totalM+=$reporteM;
                            $totalA+=$reporteA;
                            echo"
                            <td>$".$reporteD."</td>
                            <td>$".$reporteM."</td>
                            <td>$".$reporteA."</td>
                            </tr>";
                    }
                    echo"<tr>
                            <td colspan=7> </td>
                            <th>$".$salariodT."</th>
                            <th>$".$vacacionesdT."</th>
                            <th>$".$vacacionescT."</th>
                            <th>$".$auxilioTT."</th>
                            <th>$".$IempT."</th>
                            <th>$".$IEPST."</th>
                            <th>$".$IARLT."</th>
                            <th>$".$hExtraT."</th>
                            <th>$".$nocturnoT."</th>
                            <th>$".$domT."</th>
                            <th>$".$auxilioAT."</th>
                            <th>$".$TotalDevendagosT."</th>
                            <th>$".$saludT."</th>
                            <th>$".$pensionT."</th>
                            <th>$".$fondopT."</th>
                            <th>$".$anticipoT."</th>
                            <th>$".$pagoVT."</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>$".$valorcuotaT."</th>
                            <th> </th>
                            <th>$".$totalDeducciones."</th>
                            <th>$".$totalNominaT."</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th>$".$baseT."</th>
                            <th>$".$AporteEPST."</th>
                            <th>$".$FSPT."</th>
                            <th>$".$AportePensionT."</th>
                            <th>$".$AportePensionHT."</th>
                            <th>$".$AporteARLT."</th>
                            <th>$".$AporteCajaT."</th>
                            <th>$".$totalesLiquidacionT."</th> 
                            <th>$".$primaT."</th>
                            <th>$".$cesantiasT."</th>
                            <th>$".$interesCT."</th>
                            <th>$".$vacacionesT."</th>
                            <th>$".$totalPrestacionesT."</th>  
                            <th>$".$totalD."</th>
                            <th>$".$totalM."</th>
                            <th>$".$totalA."</th>
                            </tr>";
                            
                    ?>
                </table>
            </div>
    </div>
    <br>
    <div class="d-grid gap-2">
        <a href="crearPdf.php" class="btn btn-danger btn-lg">Generar PDF</a>
    </div>
</body>
</html>