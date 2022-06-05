<?php
    
    //Conexion a la Db//
    $username = "root";
    $password = "";
    $database = "laravel";
    $mysqli = new mysqli("localhost", $username, $password, $database);

    header('Content-type:application/xls');
    header('Content-Disposition: attachment; filename=Reporte.xls');
    
    $dateActual = date('Y-m-d');

    $date = new DateTime($dateActual);
    $date->modify('-1 day');
    $dataclose = $date->format('Y-m-d') . "\n";

    $sql = "SELECT t.date_close, u.name, u.email, du.telefono, du.pais, b.b_name, t.monto AS montoT , t.p_intereses, t.m_intereses, t.saldo, s.concepto, s.estatus,  s.monto AS montoS FROM transactions t
           INNER JOIN users u
           ON t.id_user = u.id
           INNER JOIN datos_users du
           ON t.id_user = du.id_user
           INNER JOIN bonos b
           ON b.id_bono = t.id_bono
           INNER JOIN solicitudes s
           ON s.id_transaction = t.id
           INNER JOIN dblines dl
           ON dl.id_user = u.id
           WHERE t.date_close = '".$dataclose."' AND u.bloqueo='0' AND dl.block='0'";
           //echo $sql;
    if($result = $mysqli->query($sql))
    {
        echo '<strong>LISTADO DE INVERSORES CON CIERRE DE LINEA EL DIA '.$dataclose.'</strong>';
        echo'<table border="1">
            <tr>
            <th>Fecha de cierre de la linea</th>
            <th>Nombre y apellido del inversor</th>
            <th>Correo electronico</th>
            <th>Numero telefonico</th>
            <th>Pais linea</th>
            <th>Modalidad</th>
            <th>Monto inicial</th>
            <th>Porcentaje</th>
            <th>Ganancia</th>
            <th>Monto total</th>
            <th>Decision de la linea</th>
            <th>Solicitado Abonar / Retirar </th>
            <th>Nuevo monto para iniciar la nueva linea </th>
            <th>Estatus </th>
        </tr>';
        while ($row = $result->fetch_assoc()) 
        {
                $Tganancia = ($field1name = $row["montoT"] * $field1name = $row["p_intereses"])/100;
                $montoTotal = $field1name = $row["montoT"] + $Tganancia;
                $montoNL = $montoTotal + $field1name = $row["montoS"];
                $status = $row["estatus"];
                if($status == 'A'){
                    $msj = "Aprobado";
                }
                if($status == 'P'){
                    $msj = "Pendiente";
                }

                if($status == 'R'){
                    $msj = "Rechazado";
                }
                echo '<tr>';
                    echo '<td>'.$field1name = $row["date_close"].'</td>';
                    echo '<td>'.$field1name = $row["name"].'</td>';
                    echo '<td>'.$field1name = $row["email"].'</td>';
                    echo '<td>'.$field1name = $row["telefono"].'</td>';
                    echo '<td>'.$field1name = $row["pais"].'</td>';
                    echo '<td>'.$field1name = $row["b_name"].'</td>';
                    echo '<td>'.$field1name = $row["montoT"].'</td>';
                    echo '<td>'.$field1name = $row["p_intereses"].'</td>';
                    echo '<td>'.$Tganancia.'</td>';
                    echo '<td>'.$montoTotal.'</td>';
                    echo '<td>'.$field1name = $row["concepto"].'</td>';
                    echo '<td>'.$field1name = $row["montoS"].'</td>';
                    echo '<td>'.$montoNL.'</td>';
                    echo '<td>'.$msj.'</td>';
                echo '</tr>';
        }
    }
    

?>