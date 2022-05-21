<?php
    //Conexion a la Db//
    $username = "root";
    $password = "";
    $database = "finanzasdevs";
    $mysqli = new mysqli("localhost", $username, $password, $database);

    //Busco usuarios activos
    $sql1 = "SELECT * FROM users WHERE bloqueo = '0'";
    $result1 = $mysqli->query($sql1);
    
    while ($data1 = mysqli_fetch_array($result1))
    {
        //Busco lineas activas
        $sql2 = "SELECT * FROM db_lines WHERE id_user = '$data1[0]' AND block = '0' "; 
        $result2 = $mysqli->query($sql2);

        while ($data2 = mysqli_fetch_array($result2))
        {
            $date = date("Y-m-d");

            //Busco las lineas con fecha de pago hoy
            $sql3 = "SELECT * FROM transactions WHERE id_line = '$data2[0]' AND id_solicitud = '0' AND date_pay = '$date' "; 
            $result3 = $mysqli->query($sql3);
            $data3 = mysqli_fetch_array($result3);

            if (!empty($data3))
            {
                //Busco si tiene solicitudes la linea que vence hoy
                $sql4 = "SELECT * FROM transactions WHERE id_line = '$data2[0]' AND id_solicitud != '0' AND solicitud = '1' AND date_pay = '$date' "; 
                $result4 = $mysqli->query($sql4);
                $data4 = mysqli_fetch_array($result4);

                //Busco la informacion del bono
                $sql5 = "SELECT * FROM bonos WHERE id_bono = '$data3[3]' ";
                $result5 = $mysqli->query($sql5);
                $data5 = mysqli_fetch_array($result5);

                //Si el bono tiene marca de ciclos y el ciclo actual es ya pasa el limite de ciclos del bono, busco modalidad 1
                if ($data5[5] == 1 && $data3[4] >= $data5[4])
                {
                    $sql5 = "SELECT * FROM bonos WHERE id_bono = '1' ";
                    $result5 = $mysqli->query($sql5);
                    $data5 = mysqli_fetch_array($result5);                        
                }
                
                //Si tiene solicitud
                if (!empty($data4))
                {
                    //Busco la solicitud
                    $sql7 = "SELECT * FROM solicitudes WHERE id_sol = '$data4[2]' ";
                    $result7 = $mysqli->query($sql7);
                    $data7 = mysqli_fetch_array($result7);
                    //Valido si es abono o retiro y hago el calculo con la informacion que viene del ciclo actual
                    if ($data7[6] == "A")
                    {
                        $monto = $data3[13] + $data7[3];
                    }
                    elseif ($data7[6] == "R")
                    {
                        $monto = $data3[13] - $data7[3];
                    }                    
                    
                    $m_intereses = $monto * ($data5[3] / 100);
                    $saldo = $monto + $m_intereses;
                    
                }
                //Si no tiene solicitud Reinvierto 
                else  
                {                   
                    //Hago el calculo con la informacion que viene del ciclo actual
                    $monto = $data3[13];
                    $m_intereses = $monto * ($data5[3] / 100);
                    $saldo = $monto + $m_intereses;
                }

                $cicle = $data3[4] + 1;

                $date_mov = $data3[9];          
                $date_sistem = date("Y-m-d",strtotime($date_mov."+ 3 days"));
                echo $dia = date("w", strtotime($date_sistem));
                //Cuando el movimiento es en miercoles, jueves o viernes debe caer en lunes, se suman 5 dias
                if ($dia == 6)
                {
                    $date_sistem = date("Y-m-d",strtotime($date_sistem."+ 5 days"));
                }
                if ($dia == 0)
                {
                    $date_sistem = date("Y-m-d",strtotime($date_mov."+ 5 days"));
                }
                if ($dia == 1)
                {
                    $date_sistem = date("Y-m-d",strtotime($date_mov."+ 5 days"));
                }

                echo $date_sistem;

                $dias = $data5[2];
                $aux =  $data5[2];
                
                $date_close = date("Y-m-d",strtotime($date_sistem."+ ".$dias." days"));
                $dia = date("w", strtotime($date_close));
                if ($dia == 6)
                {
                    $aux = $aux + 2;
                    $date_close = date("Y-m-d",strtotime($date_sistem."+ ".$aux." days"));
                }
                if ($dia == 0)
                {
                    $aux = $aux + 2;
                    $date_close = date("Y-m-d",strtotime($date_sistem."+ ".$aux." days"));
                }

                $date_pay = date("Y-m-d",strtotime($date_close."+ 4 days"));
                $dia = date("w", strtotime($date_pay));
                //Cuando el movimiento es en miercoles, jueves o viernes debe caer en lunes, se suman 5 dias
                if ($dia == 6)
                {
                    $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                }
                if ($dia == 0)
                {
                    $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                }
                if ($dia == 1)
                {
                    $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                }
                if ($dia == 2)
                {
                    $date_pay = date("Y-m-d",strtotime($date_close."+ 6 days"));
                }

                $datetime = date("Y-m-d hh:mm:ss");
                $sql6 = "INSERT INTO transactions (id_user,
                                                        id_solicitud,
                                                        id_bono,
                                                        cicle,
                                                        dias,
                                                        date_mov,
                                                        date_sistema,
                                                        date_close,
                                                        date_pay,
                                                        monto,
                                                        p_intereses,
                                                        m_intereses,
                                                        saldo,
                                                        id_line,
                                                        solicitud,
                                                        created_at,
                                                        updated_at)
                            VALUES ('$data3[1]',
                                    '0',
                                    '$data5[0]',
                                    '$cicle',
                                    '$data5[2]',
                                    '$date_mov',
                                    '$date_sistem',
                                    '$date_close',
                                    '$date_pay',
                                    '$monto',
                                    '$data5[3]',
                                    '$m_intereses',
                                    '$saldo',
                                    '$data2[0]',
                                    '0',
                                    '$datetime',
                                    '$datetime)";

                $result6 = $mysqli->query($sql6);     
            }
        }
    }
    
?>