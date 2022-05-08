<?php
    
    //Conexion a la Db//
    $username = "root";
    $password = "";
    $database = "Laravel";
    $mysqli = new mysqli("localhost", $username, $password, $database);

    header('Content-type:application/xls');
    header('Content-Disposition: attachment; filename=usersList.xls');
    $dateActual = date('Y-m-d');

    $sql = "SELECT t.date_close, u.name, u.email, du.telefono, du.pais, b.b_name, t.monto AS montoT , t.p_intereses, t.m_intereses, t.saldo, s.concepto,  s.monto AS montoS FROM transactions t
           INNER JOIN users u
           ON t.id_user = u.id
           INNER JOIN datos_users du
           ON t.id_user = du.id_user
           INNER JOIN bonos b
           ON b.id_bono = t.id_bono
           INNER JOIN solicitudes s
           ON s.id_transaction = t.id
           WHERE t.date_close = '".$dateActual."'";
           //echo $sql;
    if($result = $mysqli->query($sql))
    {
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
        </tr>';
        while ($row = $result->fetch_assoc()) 
        {
            $Tganancia = ($field1name = $row["montoT"] * $field1name = $row["p_intereses"])/100;
            $montoTotal = $field1name = $row["montoT"] + $Tganancia;
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
            echo '</tr>';
        }
    }
    

?>