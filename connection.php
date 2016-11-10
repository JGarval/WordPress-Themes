<?php
$servername = "localhost";
$username = "javierga_admin";
$password = "monchitodelta8";
$dbname = "javierga_productos";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO Pedidos (id, Pedido, Precio, Nombre, Apellidos)
    VALUES (:id, :pedido, :precio, :nombre, :apellidos)");
    $stmt->bindParam(':id', '');
    $stmt->bindParam(':pedido', $pedido);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellidos', $apellidos);

    // insert a row
    $pedido = "prueba";
    $precio = "2";
    $nombre = "prueba";
    $apellidos = "prueba";
    $stmt->execute();

    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
?>
