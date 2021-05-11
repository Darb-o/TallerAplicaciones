<!DOCTYPE html>
<html lang="en">
<head>
    <title>Nomina</title>
</head>
<body>

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
    <!--INFORMACION GENERAL-->
    <table border=1 style="border-collapse: collapse;">
        <tr>
            <th colspan=6 style="background-color: rgb(175, 162, 159);">INFORMACION GENERAL</th>
        </tr>
        <tr>
            <th style="background-color: rgb(175, 162, 159);">Nombre</th><th style="background-color: rgb(175, 162, 159);">Apellido</th>
            <th style="background-color: rgb(175, 162, 159);">Costo</th><th style="background-color: rgb(175, 162, 159);">Cargo</th>
            <th style="background-color: rgb(175, 162, 159);">Identificacion</th><th style="background-color: rgb(175, 162, 159);">Sueldo</th>
        </tr>
        <?php
            for($i = 0; $i<count($id) ; $i++){
                echo"<tr>
                    <td>".$nombre[$i]."</td>
                    <td>".$apellido[$i]."</td>
                    <td>".$costo[$i]."</td>
                    <td>".$cargo[$i]."</td>
                    <td>".$id[$i]."</td>
                    <td>".$sueldo[$i]."</td>
                    </tr>";
                }
                    ?>
                </table>
                <br>
                <!--DEVENGADOS-->
                <table border=1 style="border-collapse: collapse;">
                     <tr>
                        <th colspan=14 style="background-color: rgb( 75, 156, 152 );">DEVENGADOS</th>
                     </tr>
                    <tr>
                        <th style="background-color: rgb( 75, 156, 152 );">Cedula</th><th style="background-color: rgb( 75, 156, 152 );">Dias Laborados</th>
                        <th style="background-color: rgb( 75, 156, 152 );">Salario segun dias laborados</th><th style="background-color: rgb( 75, 156, 152 );">Vacaciones disfrutadas</th>
                        <th style="background-color: rgb( 75, 156, 152 );">Vacaciones compensadas</th><th style="background-color: rgb( 75, 156, 152 );">Auxilio de transporte</th>
                        <th style="background-color: rgb( 75, 156, 152 );">Auxilio monetario por incapacidad (empleador)</th><th style="background-color: rgb( 75, 156, 152 );">Pago incapacidad EPS</th>
                        <th style="background-color: rgb( 75, 156, 152 );">Pago incapacidad ARL</th><th style="background-color: rgb( 75, 156, 152 );">Extra Turno</th>
                        <th style="background-color: rgb( 75, 156, 152 );">Recargo nocturno</th><th style="background-color: rgb( 75, 156, 152 );">H. Dominicales</th>
                        <th style="background-color: rgb( 75, 156, 152 );">Aux. Alimentacion no prestacional</th><th style="background-color: rgb( 75, 156, 152 );">Total devengado</th>
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
                    $TotalDevengados=0;
                    for($i = 0; $i<count($id) ; $i++){
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
                            $hExtra=(round((((($sueldo[$i]/30)/8)*25)/100)+(($sueldo[$i]/30)/8)))*$extra[$i];
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
                        $devengadoT[$i]=$salariod+$vacacionesd+$vacacionesc+$auxilioT+$Iemp+$IEPS+$IARL+$hExtra+$nocturno+$dom+$auxilioT;
                        $TotalDevengados+=$devengadoT[$i];
                        echo"<tr>
                            <td>".$id[$i]."</td>
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
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$devengadoT[$i]."</th>
                            </tr>";
                    }
                    echo"<tr>
                            <td colspan=2 style='background-color: rgb( 75, 156, 152 );'> </td>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$salariodT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$vacacionesdT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$vacacionescT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$auxilioTT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$IempT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$IEPST."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$IARLT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$hExtraT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$nocturnoT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$domT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$auxilioAT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$TotalDevengados."</th>
                            </tr>";
                    ?>
                </table>
                <br>
                <!--DEDUCCIONES-->
                <table border=1 style="border-collapse: collapse;">
                <tr>
                        <th colspan=15 style="background-color: rgb( 91, 207, 139 );">DEDUCCIONES</th><th rowspan=2 style="background-color: rgb(175, 162, 159);"></th>
                    </tr>
                    <tr>
                        <th colspan=6 style="background-color: rgb( 91, 207, 139 );">Deducciones Nominales</th><th colspan=9 style="background-color: rgb( 91, 207, 139 );">Deducciones por prestamo</th>
                    </tr>
                    <tr>
                        <th style="background-color: rgb( 91, 207, 139 );">Cedula</th><th style="background-color: rgb( 91, 207, 139 );">Salud</th>
                        <th style="background-color: rgb( 91, 207, 139 );">Pension</th><th style="background-color: rgb( 91, 207, 139 );">Fondo de Solidaridad Pensional</th>
                        <th style="background-color: rgb( 91, 207, 139 );">Anticipos de nomina</th><th style="background-color: rgb( 91, 207, 139 );">Pago vacaciones</th>
                        <th style="background-color: rgb( 91, 207, 139 );">Monto de desembolso</th><th style="background-color: rgb( 91, 207, 139 );">No de Cuotas a descontar</th>
                        <th style="background-color: rgb( 91, 207, 139 );">Fecha del desembolso</th><th style="background-color: rgb( 91, 207, 139 );">No de cuota pagada</th>
                        <th style="background-color: rgb( 91, 207, 139 );">Cuotas por descontar</th><th style="background-color: rgb( 91, 207, 139 );">Nomina en que termina el prestamo</th>
                        <th style="background-color: rgb( 91, 207, 139 );">Valor cuota</th><th style="background-color: rgb( 91, 207, 139 );">Saldo Prestamo</th>
                        <th style="background-color: rgb( 91, 207, 139 );">Total Deducciones</th><th style="background-color: rgb(175, 162, 159);">TOTAL NOMINA</th>
                    </tr>
                    <?php
                        $saludT=0;
                        $pensionT=0;
                        $fondopT=0;
                        $anticipoT=0;
                        $pagoVT=0;
                        $valorcuotaT=0;
                        $totalDeducciones=0;
                        $NominaT=0;
                        for($i = 0; $i<count($id) ; $i++){
                            $salud=($sueldo[$i]+((round((((($sueldo[$i]/30)/8)*25)/100)+(($sueldo[$i]/30)/8)))*$extra[$i])+round(($sueldo[$i]/30)*$dias_vc[$i]))*4/100;
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
                                $montoD=" ";
                                $Nocuotas=" ";
                                $fechaD=" ";
                                $NocuotaA=" ";
                                $cpDescontar=" ";
                                $fechafinal=" ";
                                $valorcuota=0;
                                $saldo=" ";
                            }
                            $deduccionesT=$salud+$pension+$fondop+$pagoV+$valorcuota;
                            $totalnomina=$devengadoT[$i]-$deduccionesT;
                            echo"<tr>
                                <td>".$id[$i]."</td>
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
                                <th style='background-color: rgb( 91, 207, 139 );'>$".$deduccionesT."</th>
                                <th style='background-color: rgb(175, 162, 159);'>$".$totalnomina."</th>
                                </tr>";
                            $saludT+=$salud;
                            $pensionT+=$pension;
                            $fondopT+=$fondop;
                            $anticipoT+=$anticipoNom;
                            $pagoVT+=$pagoV;
                            $valorcuotaT+=$valorcuota;
                            $totalDeducciones+=$deduccionesT;
                            $NominaT+=$totalnomina;
                        }
                        echo"<tr>
                                <th style='background-color: rgb( 91, 207, 139 );'> </th>
                                <th style='background-color: rgb( 91, 207, 139 );'>$".$saludT."</th>
                                <th style='background-color: rgb( 91, 207, 139 );'>$".$pensionT."</th>
                                <th style='background-color: rgb( 91, 207, 139 );'>$".$fondopT."</th>
                                <th style='background-color: rgb( 91, 207, 139 );'>$".$anticipoT."</th>
                                <th style='background-color: rgb( 91, 207, 139 );'>$".$pagoVT."</th>
                                <td style='background-color: rgb( 91, 207, 139 );'></td>
                                <td style='background-color: rgb( 91, 207, 139 );'></td>
                                <td style='background-color: rgb( 91, 207, 139 );'></td>
                                <td style='background-color: rgb( 91, 207, 139 );'></td>
                                <td style='background-color: rgb( 91, 207, 139 );'></td>
                                <td style='background-color: rgb( 91, 207, 139 );'></td>
                                <th style='background-color: rgb( 91, 207, 139 );'>$".$valorcuotaT."</th>
                                <th style='background-color: rgb( 91, 207, 139 );'> </th>
                                <th style='background-color: rgb( 91, 207, 139 );'>$".$totalDeducciones."</th>
                                <th style='background-color: rgb(175, 162, 159);'>$".$NominaT."</th>
                                </tr>";
                    ?>
                </table>
                <br>
                <!--Liquidacion SOI-->
                <table border=1 style="border-collapse: collapse;">
                    <tr>
                        <td colspan=4 style='background-color: rgb(175, 162, 159);'></td><th colspan=8 style='background-color: rgb(175, 162, 159);'>LIQUIDACION APORTES SOI</th>
                    </tr>
                    <tr>
                    <th style='background-color: rgb(175, 162, 159);'>Cedula</th><th style='background-color: rgb(175, 162, 159);'>Indicador tarifa Especial (pension)</th>
                    <th style='background-color: rgb(175, 162, 159);'>Clase de Riesgo</th><th style='background-color: rgb(175, 162, 159);'>Centro de Trabajo</th>
                    <th style='background-color: rgb(175, 162, 159);'>BASE PARA LOQUIDACION DE APORTES</th><th style='background-color: rgb(175, 162, 159);'>APORTES EPS EMPLEADO 4%</th>
                    <th style='background-color: rgb(175, 162, 159);'>FSP 1%</th><th style='background-color: rgb(175, 162, 159);'>APORTES PENSION EMPLEADO 4%</th>
                    <th style='background-color: rgb(175, 162, 159);'>APORTES PENSION HERMES 12%</th><th style='background-color: rgb(175, 162, 159);'>APORTES HERMES ARL</th>
                    <th style='background-color: rgb(175, 162, 159);'>APORTE HERMES CAJA DE COM 4%</th><th style='background-color: rgb(175, 162, 159);'>TOTALES</th>
                    </tr>
                    <?php
                        $baseT=0;
                        $AporteEPST=0;
                        $FSPT=0;
                        $AportePensionT=0;
                        $AportePensionHT=0;
                        $AporteARLT=0;
                        $AporteCajaT=0;
                        $totalesLiquidacion=0;
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
                            $totalLiquidacion=$AporteEPS+$FSP+$AportePension+$AportePensionH+$AporteARL+$AporteCaja;

                            echo"<tr>
                                <td>".$id[$i]."</td>
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
                                <th style='background-color: rgb(175, 162, 159);'>$".$totalLiquidacion."</th>  
                                </tr>";
                            $baseT+=$base;
                            $AporteEPST+=$AporteEPS;
                            $FSPT+=$FSP;
                            $AportePensionT+=$AportePension;
                            $AportePensionHT+=$AportePensionH;
                            $AporteARLT+=$AporteARL;
                            $AporteCajaT+=$AporteCaja;
                            $totalesLiquidacion+=$totalLiquidacion;
                        }
                        echo"<tr>
                            <td style='background-color: rgb(175, 162, 159);'></td>
                            <td style='background-color: rgb(175, 162, 159);'></td>
                            <td style='background-color: rgb(175, 162, 159);'></td>
                            <td style='background-color: rgb(175, 162, 159);'></td>
                            <th style='background-color: rgb(175, 162, 159);'>$".$baseT."</th>
                            <th style='background-color: rgb(175, 162, 159);'>$".$AporteEPST."</th>
                            <th style='background-color: rgb(175, 162, 159);'>$".$FSPT."</th>
                            <th style='background-color: rgb(175, 162, 159);'>$".$AportePensionT."</th>
                            <th style='background-color: rgb(175, 162, 159);'>$".$AportePensionHT."</th>
                            <th style='background-color: rgb(175, 162, 159);'>$".$AporteARLT."</th>
                            <th style='background-color: rgb(175, 162, 159);'>$".$AporteCajaT."</th>
                            <th style='background-color: rgb(175, 162, 159);'>$".$totalesLiquidacion."</th>  
                            </tr>";
                    ?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <!--Prestaciones Sociales-->
                    <table border=1 style="border-collapse: collapse;">
                    <tr>
                        <th colspan=6 style='background-color: rgb( 75, 156, 152 );'>PRESTACIONES SOCIALES</th><th colspan=3 style="background-color: rgb( 18, 129, 174 );">REPORTES</th>
                    </tr>
                    <tr>
                    <th style='background-color: rgb( 75, 156, 152 );'>Cedula</th><th style='background-color: rgb( 75, 156, 152 );'>Prima</th>
                    <th style='background-color: rgb( 75, 156, 152 );'>Cesantias</th><th style='background-color: rgb( 75, 156, 152 );'>Interes de cesantias</th>
                    <th style='background-color: rgb( 75, 156, 152 );'>Vacaciones</th><th style='background-color: rgb( 75, 156, 152 );'>TOTALES</th>
                    <th style="background-color: rgb( 18, 129, 174 );">Costos a Cargo de la Empresa Diario</th>
                    <th style="background-color: rgb( 18, 129, 174 );">Costos a Cargo de la Empresa Mensual</th>
                    <th style="background-color: rgb( 18, 129, 174 );">Costos a Cargo de la Empresa Anual</th>
                    </tr>
                    <?php
                        $primaT=0;
                        $cesantiasT=0;
                        $interesCT=0;
                        $vacacionesT=0; 
                        $totales=0;
                        $totalD=0;
                        $totalM=0;
                        $totalA=0;
                        for($i = 0; $i<count($id) ; $i++){
                            if($sueldo[$i]<1817052){
                                $auxilioT=round((106454/30)*$dias_l[$i]);
                            }else{
                                $auxilioT=0;
                            }
                            if($extra[$i]>0){
                                $hExtra=(round((((($sueldo[$i]/30)/8)*25)/100)+(($sueldo[$i]/30)/8)))*$extra[$i];
                            }else{
                                $hExtra=0;
                            }
                            $prima=round((($hExtra+$auxilioT+$sueldo[$i])*8.33)/100);
                            $cesantias=round((($hExtra+$auxilioT+$sueldo[$i])*8.33)/100);
                            $interesC=round($cesantias*(($dias_l[$i]*12)/100)/360);
                            $vacaciones=round($sueldo[$i]*4.17)/100; 
                            $total=$prima+$cesantias+$interesC+$vacaciones;
                            $base2=$sueldo[$i]+($hExtra=(round((((($sueldo[$i]/30)/8)*25)/100)+(($sueldo[$i]/30)/8)))*$extra[$i])+(round(($sueldo[$i]/30)*$dias_vc[$i]));
                            $AportePensionH2=round(($base2*12)/100);
                            $AporteARL2=round(($base2*0.525)/100);
                            $AporteCaja2=round(($base2*4)/100);
                            $reporteM=$devengadoT[$i]+$AporteARL2+$AporteCaja2+$AportePensionH2+$total;
                            $reporteD=round($reporteM/30);
                            $reporteA=$reporteM*12;
                            $totalD+=$reporteD;
                            $totalM+=$reporteM;
                            $totalA+=$reporteA;
                            echo"<tr>
                                <td>".$id[$i]."</td>
                                <td>$".$prima."</td>
                                <td>$".$cesantias."</td>
                                <td>$".$interesC."</td>
                                <td>$".$vacaciones."</td>
                                <th style='background-color: rgb( 75, 156, 152 );'>$".$total."</th>
                                <td>$".$reporteD."</td>
                                <td>$".$reporteM."</td>
                                <td>$".$reporteA."</td>
                                </tr>";
                            $primaT+=$prima;
                            $cesantiasT+=$cesantias;
                            $interesCT+=$interesC;
                            $vacacionesT+=$vacaciones; 
                            $totales+=$total;
                        }
                        echo"<tr>
                            <td style='background-color: rgb( 75, 156, 152 );'></td>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$primaT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$cesantiasT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$interesCT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$vacacionesT."</th>
                            <th style='background-color: rgb( 75, 156, 152 );'>$".$totales."</th>  
                            <th style='background-color: rgb( 18, 129, 174 );'>$".$totalD."</th>
                            <th style='background-color: rgb( 18, 129, 174 );'>$".$totalM."</th>
                            <th style='background-color: rgb( 18, 129, 174 );'>$".$totalA."</th>
                            </tr>";
                    ?>
                    
                </table>
</body>
</html>