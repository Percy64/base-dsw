<?php
require_once 'conexion.php';

$nombre = '';
$email = '';
$telefono = '';


$msg_nombre = '';
$msg_email = '';    
$msg_telefono = '';


$error = false;



if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener datos del usuario
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit;
    }
} else {
    echo "ID no especificado.";
    exit;
}

// Actualizar datos si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    if (!$error) {
        $stmt = $pdo->prepare("UPDATE usuarios SET nombre = ?, email = ?, telefono = ? WHERE id = ?");
        $stmt->execute([$nombre, $email, $telefono, $id]);

        echo "Usuario actualizado correctamente.<br>";
        echo "<a href='mostrar2.php'>Volver</a>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
</head>
<body>
    <h2>Editar Usuario</h2>
    <form method="post">
        Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>"><br>
        Email: <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>"><br>
        Teléfono: <input type="text" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>"><br>
        <input type="submit" value="Actualizar">
    </form>
    <a href="mostrar2.php">Cancelar</a>
</body>
</html>
<?php $pdo = null; ?>