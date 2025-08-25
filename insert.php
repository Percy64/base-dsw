<?php
require_once 'conexion.php';
$nombre = '';
$email = '';
$telefono = '';
$contraseña = '';

$msg_nombre = '';
$msg_email = '';    
$msg_telefono = '';
$msg_contraseña = '';

$error = false;


if(isset($_POST['env_btn'])){

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
    if (isset($_POST['email'])){
        $email=trim($_POST['email']);
        if (empty($email)) {
            $msg_email = 'El campo email es obligatorio.';
            $error = true;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg_email = 'El email no es válido.';
            $error = true;
        }
    }
    if (isset($_POST['telefono'])){
        $telefono=trim($_POST['telefono']);
        if (empty($telefono)) {
            $msg_telefono = 'El campo teléfono es obligatorio.';
            $error = true;
        } elseif (!is_numeric($telefono)) {
            $msg_telefono = 'ingrese solo numeros de telefono ';
        }elseif (strlen($telefono) < 8 or strlen($telefono) > 12){ 
            $msg_telefono = 'El teléfono debe tener 10 dígitos.';
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
        $sql = "INSERT INTO usuarios (nombre, email, telefono, contraseña) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $email, $telefono, $contraseña]);
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
                <label for="email"></label>
                <input type="email" name="email" placeholder="ingresar email" value="<?=$email?>">
                <output><?=$msg_email?></output>
            </div>
            <div>
                <label for="telefono"></label>
                <input type="text" name="telefono" placeholder="ingresar teléfono" value="<?=$telefono?>">
                <output><?=$msg_telefono?></output>
            </div>
            <div>
                <label for="contraseña"></label>
                <input type="password" name="contraseña" placeholder="ingresar contraseña" value="<?=$contraseña?>">
                <output><?=$msg_contraseña?></output>
            </div>
            <div>
                <button type="submit" name="env_btn">Enviar</button>
            </div>
        </form>
    </section>
</body>
</html>