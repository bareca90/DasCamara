<?php

    $serverName = "10.100.120.7";
    $connectionInfo = array( "Database"=>"SipeDes", "UID"=>"sa", "PWD"=>"84+-blaster32","CharacterSet"=>"UTF-8");
    $con = sqlsrv_connect($serverName, $connectionInfo);
    if(!$con) {     
        echo"Error al conectar a la base de datos"; 
        exit();               
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <link rel="stylesheet" href="css.css" type="text/css">
        <link rel="stylesheet" href="css-tabla1.css" type="text/css">
        <link rel="stylesheet" href="cards.css" type="text/css">
        <!--<link rel="stylesheet" href="csstitulos.css" type="text/css">-->
    </head>
    <div>
        <div class="contenedor_titulo">
            <div class="div_container_titulo">
                <img src="img/logopm.jpg">
            </div>
            <div class="contenido_titulo">
                <h2 class="titulo_principal">
                   <u>Dashboard - Embarques / CPT</u> 
                </h2>
            </div>
        </div>
        <div id="container">
            <?php 
                $aguaje = '';
                $supervisor = '';
                $turno = '';
                $sql="SELECT top 1 * from Vi_Datos_Embarque_Camara Order By FechaDatos";
                $result=sqlsrv_query($con,$sql);
                while($muestra=sqlsrv_fetch_array($result)){
                    $fechaactual=$muestra['FechaActual'];
                    $aguaje=$muestra['Aguaje'];
                    $supervisor=$muestra['Supervisor'];
                    $turno=$muestra['Turno'];
                }
            ?>
            <div class="kpi-card orange">
                <span class="card-value">Fecha</span>
                <span class="card-text"><?php 
                       echo date('d/m/Y');
                       
                        
                        
                        ?> 
                </span>
                <i class="fas fa-calendar icon"></i>
            </div>
        
        
            <div class="kpi-card purple">
                <span class="card-value">Aguaje</span>
                <span class="card-text"><?php echo $aguaje?> </span>
                <i class="fas fa-moon icon"></i>
            </div>
            
            <div class="kpi-card grey-dark">
                <span class="card-value">Supervisor</span>
                <span class="card-text"><?php echo $supervisor?></span>
                <i class="fas fa-user-lock icon"></i>
            </div>
            
            <div class="kpi-card red">
                <span class="card-value">Turno</span>
                <span class="card-text"><?php echo $turno?></span>
                <i class="fas fa-stopwatch icon"></i>
                
            </div>
        </div>
        <div class="titulo_tabla_dash">
            <h2>Plan de Embarques Diarios</h2>
            
        </div>
        <table>
            <thead>
                <tr>
                    <th class="ancho_celdas_normales"> Fec. Hra. Cita   </th>
                    <th class="ancho_celdas_normales">                  </th>
                    <th class="ancho_celdas_normales"> Fec. Hra. Real   </th>
                    <th class="ancho_celdas_normales"> Referencia       </th>
                    <th class="ancho_celdas_normales"> Cliente          </th>
                    <th class="ancho_celdas_normales"> Liquidador       </th>
                    <th class="ancho_celdas_normales"> Muelle </th>
                    <th class="ancho_celdas_normales"> CutOff </th>
                    <th class="ancho_celdas_normales"> Fec. Est. Term. </th>
                    <th class="ancho_celdas_normales">                  </th>
                    <!--<th class="ancho_celdas_normales"> Embarcadas </th>-->
                    <th class="ancho_celdas_barra"> Avance </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sql="SELECT * from Vi_Datos_Embarque_Camara Order By FechaDatos,Hora";
                    $result=sqlsrv_query($con,$sql);
                    while($mostrar=sqlsrv_fetch_array($result)){
                ?>

                <tr>
                    
                    <td><?php 
                            /* $Date = $mostrar['FechaDatos']->format('d/m/Y'); */
                            /* echo $Date;  */
                            echo $mostrar['Fec_Cita_Char']
                        ?>
                    </td>
                    <td>
                        <?php 
                            $minutos_diferencia = $mostrar['Minutos_Dif'];
                            if($minutos_diferencia<=0 ) //Verde
                            {
                                echo "
                                    <div  class='btn btn-success btn-circle btn-circle-sm m-1'>
                                    </div>
                                ";

                            }
                            if($minutos_diferencia>0 && $minutos_diferencia<=30) //Amarillo 
                            {
                                echo "
                                    <div  class='btn btn-warning btn-circle btn-circle-sm m-1'>
                                    </div>
                                ";
                            }
                            if($minutos_diferencia>30 ) //Verde
                            {
                                echo "
                                    <div  class='btn btn-danger btn-circle btn-circle-sm m-1'>
                                    </div>
                                ";

                            }
                        ?>
                    </td>

                    <td><?php echo $mostrar['Fec_Real_Char'] ?></td>
                    <td><?php echo $mostrar['Referencia'] ?></td>
                    <td><?php echo $mostrar['Cliente'] ?></td>
                    <td><?php echo $mostrar['Liquidador'] ?></td>
                    <td><?php echo $mostrar['Muelle'] ?></td>
                    <td><?php echo $mostrar['Cutoff'] ?></td>
                    <td><?php echo $mostrar['Fec_Est_Term_Chr'] ?></td>
                    <td>
                        <?php 
                            $minu_dif_estimada = $mostrar['Dif_Min_Hra_Estima'];
                            if($minu_dif_estimada<=0 ) //Verde
                            {
                                echo "
                                    <div  class='btn btn-success btn-circle btn-circle-sm m-1'>
                                    </div>
                                ";

                            }
                            if($minu_dif_estimada>0 && $minu_dif_estimada<=30) //Amarillo 
                            {
                                echo "
                                    <div  class='btn btn-warning btn-circle btn-circle-sm m-1'>
                                    </div>
                                ";
                            }
                            if($minu_dif_estimada>30 ) //Verde
                            {
                                echo "
                                    <div  class='btn btn-danger btn-circle btn-circle-sm m-1'>
                                    </div>
                                ";

                            }
                        ?>
                    </td>
                    <!--<td></*?php echo $mostrar['Embarcadas'] ?>*/</td>-->
                    <td>
                        <?php 
                            $porcentaje = $mostrar['porcentaje'];
                            if($porcentaje>=0 && $porcentaje<=30){
                                echo "
                                <div class='skill'>
                                    <p>".$mostrar['Embarcadas']."</p>
                                    <div class='skill-bar skill6 wow slideInLeft animated'>
                                        <span class='skill-count6'>
                                            ".$porcentaje."%
                                        </span>
                                    </div>
                                </div>
                                <div class='progress-bar'>
                                    <div class='js-completed-bar completed-bar-rojo' data-complete='".$porcentaje. "' style='width: ".$porcentaje."%; opacity: 1;'>
                                        <hr class='completed-bar-rojo__dashed'>
                                        <i class='fas fa-truck-moving completed-bar-rojo__truck'></i>
                                    </div>
                                </div>";
                                
                                

                            }
                            if($porcentaje>=31 && $porcentaje<=70){        
                                echo "
                                <div class='skill'>
                                    <p>".$mostrar['Embarcadas']."</p>
                                    <div class='skill-bar skill6 wow slideInLeft animated'>
                                        <span class='skill-count6'>
                                            ".$porcentaje."%
                                        </span>
                                    </div>
                                </div>
                                <div class='progress-bar'>
                                    <div class='js-completed-bar completed-bar-amarillo' data-complete='".$porcentaje. "' style='width: ".$porcentaje."%; opacity: 1;'>
                                        <hr class='completed-bar-amarillo__dashed'>
                                        <i class='fas fa-truck-moving completed-bar-amarillo__truck'></i>
                                    </div>
                                </div>";
                                
                            }
                            if($porcentaje>=70){        
                                echo "
                                <div class='skill'>
                                    <p>".$mostrar['Embarcadas']."</p>
                                    <div class='skill-bar skill6 wow slideInLeft animated'>
                                        <span class='skill-count6'>
                                            ".$porcentaje."%
                                        </span>
                                    </div>
                                </div>
                                <div class='progress-bar'>
                                    <div class='js-completed-bar completed-bar' data-complete='".$porcentaje. "' style='width: ".$porcentaje."%; opacity: 1;'>
                                        <hr class='completed-bar__dashed'>
                                        <i class='fas fa-truck-moving completed-bar__truck'></i>
                                    </div>
                                </div>";
                            }
                            
                        ?>
                        
                        
                    </td>
                </tr>
                <?php 
                }
                ?>


                <!--
                <tr>
                    <td> 22/04/2022 </td>
                    <td> 10852 </td>
                    <td> 10:20 </td>
                    <td> PescanoVa France </td>
                    <td> A_Bajana </td>
                    <td> 8 </td>
                    <td> Viernes </td>
                    <td> 2500/3000 </td>
                    <td>
                        <div class="progress-bar">
                            <div class="js-completed-bar completed-bar" data-complete="70" style="width: 80%; opacity: 1;">
                                <hr class="completed-bar__dashed">
                                <i class="fas fa-truck-moving completed-bar__truck"></i>
                            </div>
                        </div>
                        
                    </td>
                    
                    
                </tr>
                <tr>
                    <td> 22/04/2022 </td>
                    <td> 10852 </td>
                    <td> 10:20 </td>
                    <td> PescanoVa France </td>
                    <td> A_Bajana </td>
                    <td> 8 </td>
                    <td> Viernes </td>
                    <td> 2500/3000 </td>
                    <td>
                        <div class="progress-bar">
                            <div class="js-completed-bar completed-bar-amarillo" data-complete="70" style="width: 50%; opacity: 1;">
                                <hr class="completed-bar-amarillo__dashed">
                                <i class="fas fa-truck-moving completed-bar-amarillo__truck"></i>
                            </div>
                        </div>
                        
                    </td>
                    
                    
                </tr>
                <tr>
                    <td> 22/04/2022 </td>
                    <td> 10852 </td>
                    <td> 10:20 </td>
                    <td> PescanoVa France </td>
                    <td> A_Bajana </td>
                    <td> 8 </td>
                    <td> Viernes </td>
                    <td> 2500/3000 </td>
                    <td>
                        <div class="progress-bar">
                            <div class="js-completed-bar completed-bar" data-complete="70" style="width: 30%; opacity: 1;">
                                <hr class="completed-bar__dashed">
                                <i class="fas fa-truck-moving completed-bar__truck"></i>
                            </div>
                        </div>
                        
                        
                    </td>
                    
                    
                </tr>
                <tr>
                    <td> 22/04/2022 </td>
                    <td> 10852 </td>
                    <td> 10:20 </td>
                    <td> PescanoVa France </td>
                    <td> A_Bajana </td>
                    <td> 8 </td>
                    <td> Viernes </td>
                    <td> 2500/3000 </td>
                    <td>
                        <div class="progress-bar">
                            <div class="js-completed-bar completed-bar-amarillo" data-complete="70" style="width: 60%; opacity: 1;">
                                <hr class="completed-bar-amarillo__dashed">
                                <i class="fas fa-truck-moving completed-bar-amarillo__truck"></i>
                            </div>
                        </div>
                        
                    </td>
                    
                    
                </tr>
                <tr>
                    <td> 22/04/2022 </td>
                    <td> 10852 </td>
                    <td> 10:20 </td>
                    <td> PescanoVa France </td>
                    <td> A_Bajana </td>
                    <td> 8 </td>
                    <td> Viernes </td>
                    <td> 2500/3000 </td>
                    <td>
                        <div class="progress-bar">
                            <div class="js-completed-bar completed-bar-rojo" data-complete="70" style="width: 0%; opacity: 1;">
                                <hr class="completed-bar-rojo__dashed">
                                <i class="fas fa-truck-moving completed-bar-rojo__truck"></i>
                            </div>
                        </div>
                        
                    </td>
                    
                    
                </tr>
                <tr>
                    <td> 22/04/2022 </td>
                    <td> 10852 </td>
                    <td> 10:20 </td>
                    <td> PescanoVa France </td>
                    <td> A_Bajana </td>
                    <td> 8 </td>
                    <td> Viernes </td>
                    <td> 2500/3000 </td>
                    <td>
                        <div class="progress-bar">
                            <div class="js-completed-bar completed-bar-rojo" data-complete="70" style="width: 90%; opacity: 1;">
                                <hr class="completed-bar-rojo__dashed">
                                <i class="fas fa-truck-moving completed-bar-rojo__truck"></i>
                            </div>
                        </div>
                        
                    </td>
                    
                    
                </tr>
                <tr>
                    <td> 22/04/2022 </td>
                    <td> 10852 </td>
                    <td> 10:20 </td>
                    <td> PescanoVa France </td>
                    <td> A_Bajana </td>
                    <td> 8 </td>
                    <td> Viernes </td>
                    <td> 2500/3000 </td>
                    <td>
                        <div class="progress-bar">
                            <div class="js-completed-bar completed-bar-rojo" data-complete="70" style="width: 5%; opacity: 1;">
                                <hr class="completed-bar-rojo__dashed">
                                <i class="fas fa-truck-moving completed-bar-rojo__truck"></i>
                            </div>
                        </div>
                        
                    </td>
                    
                    
                </tr>
                <tr>
                    <td> 22/04/2022 </td>
                    <td> 10852 </td>
                    <td> 10:20 </td>
                    <td> PescanoVa France </td>
                    <td> A_Bajana </td>
                    <td> 8 </td>
                    <td> Viernes </td>
                    <td> 2500/3000 </td>
                    <td>
                        <div class="progress-bar">
                            <div class="js-completed-bar completed-bar-rojo" data-complete="70" style="width: 5%; opacity: 1;">
                                <hr class="completed-bar-rojo__dashed">
                                <i class="fas fa-truck-moving completed-bar-rojo__truck"></i>
                            </div>
                        </div>
                        
                    </td>
                    
                    
                </tr>
                <tr>
                    <td> 22/04/2022 </td>
                    <td> 10852 </td>
                    <td> 10:20 </td>
                    <td> PescanoVa France </td>
                    <td> A_Bajana </td>
                    <td> 8 </td>
                    <td> Viernes </td>
                    <td> 2500/3000 </td>
                    <td>
                        <div class="progress-bar">
                            <div class="js-completed-bar completed-bar-rojo" data-complete="70" style="width: 5%; opacity: 1;">
                                <hr class="completed-bar-rojo__dashed">
                                <i class="fas fa-truck-moving completed-bar-rojo__truck"></i>
                            </div>
                        </div>
                        
                    </td>
                    
                    
                </tr>
                <tr>
                    <td> 22/04/2022 </td>
                    <td> 10852 </td>
                    <td> 10:20 </td>
                    <td> PescanoVa France </td>
                    <td> A_Bajana </td>
                    <td> 8 </td>
                    <td> Viernes </td>
                    <td> 2500/3000 </td>
                    <td>
                        <div class="progress-bar">
                            <div class="js-completed-bar completed-bar-rojo" data-complete="70" style="width: 5%; opacity: 1;">
                                <hr class="completed-bar-rojo__dashed">
                                <i class="fas fa-truck-moving completed-bar-rojo__truck"></i>
                            </div>
                        </div>
                        
                        
                        
                    </td>
                    
                    
                </tr>
                -->
            </tbody>
            
            
        </table>
        <!--
        <div class="progress-bar">
            <div class="js-completed-bar completed-bar-rojo" data-complete="70" style="width: 30%; opacity: 1;">
                <hr class="completed-bar-rojo__dashed">
                <i class="fas fa-truck-moving completed-bar-rojo__truck"></i>
            </div>
        </div>
        <div class="box box-down blue">
            <h2>Plan de Embarques Diarios</h2>
        </div>
        -->
    </div>
    <script type="text/javascript">
        const progress = document.querySelector(".js-completed-bar");
        if (progress) {
            progress.style.width = progress.getAttribute("data-complete") + "%";
            progress.style.opacity = 1;
        }
        //Función actualizar
        
        function actualizar(){location.reload(true);}
        //Función para actualizar cada 5 segundos(5000 milisegundos)
        setInterval("actualizar()",5000);
        
    </script>
    
</html>
