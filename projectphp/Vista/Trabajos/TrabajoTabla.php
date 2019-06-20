<?php
$query = $r;
?>

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Estado</th>
            <th>Tipo de trabajo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td scope="row"><?php echo $row['id'] ?></td>
            <td><?php echo $row['nombre'] ?></td>
            <td><?php echo $row['descripcion'] ?></td>
            <td><?php echo $row['fecha_inicio'] ?></td>
            <td><?php echo $row['fecha_fin'] ?></td>
            <td><?php echo $row['status'] ?></td>
            <td><?php echo $row['Tipos_trabajo_id'] ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>