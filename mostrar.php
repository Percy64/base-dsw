<?php
require_once 'conexion.php';
// Ejecutar una consulta
$consulta = "SELECT * FROM usuarios";
$resultado = $pdo->query($consulta);
// Obtener los resultados de la consulta
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
// Acceder a los datos de la fila
echo $fila['id'] . " - " . $fila['nombre'] . " - " . $fila['email'] . " - " . $fila['telefono'] . "<br>";
}
// Cerrar la conexión
$pdo = null;
?>