<?php
// conexion.php
// Establecer la conexión a la base de datos
require_once 'conexion.php';
$nombre= '';
$contraseña= '';

$msg_nombre = '';
$msg_contraseña = '';

$error = false;

if (isset($_POST['env_boton'])) {
    if (isset($_POST['nombre'])){
        $nombre=trim($_POST['nombre']);
        if (empty($nombre)) {
            $msg_nombre = 'El campo nombre es obligatorio.';
            $error = true;
        } elseif (strlen($nombre) < 3) {
            $msg_nombre = 'El nombre debe tener al menos 3 caracteres.';
            $error = true;    
        }
    }
    if (isset($_POST['contraseña'])){
        $contraseña=trim($_POST['contraseña']);
        if (empty($contraseña)) {
            $msg_contraseña = 'El campo contraseña es obligatorio.';
            $error = true;
        } elseif (strlen($contraseña) < 6) {
            $msg_contraseña = 'La contraseña debe tener al menos 6 caracteres.';
            $error = true;
        }
}
if (!$error) {
    $sql = "INSERT INTO usuario (nombre, contraseña) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $contraseña]);
    
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section>
        <form action="" method="post">
            <div>
                <label for="nombre"></label>
                <input type="text" name="nombre" placeholder="ingresar nombre" value="<?=$nombre?>">
                <output><?=$msg_nombre?></output>
            </div>
            <div>
                <label for="contraseña"></label>
                <input type="password" name="contraseña" placeholder="ingresar contraseña" value="<?=$contraseña?>">
                <output><?=$msg_contraseña?></output>
            </div>
            <div>
                <button type="submit" name="env_boton">Enviar</button>
            </div>
        </form>
    </section>
</body>
</html>