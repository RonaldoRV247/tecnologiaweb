<?php
require_once '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

// Incluir las configuraciones necesarias
require_once('../classes/config.php'); // Ajusta la ruta según sea necesario

// Obtener los parámetros del formulario
$producto_id = isset($_POST['producto']) ? $_POST['producto'] : 1; // Valor por defecto si no se selecciona nada
$anio = isset($_POST['anio']) ? $_POST['anio'] : date('Y'); // Valor por defecto si no se selecciona nada

// Generar el gráfico
$_POST['producto'] = $producto_id;
$_POST['anio'] = $anio;
include '../graficos/grafico_productos.php'; // Ajusta la ruta según la estructura de tu proyecto

ini_set('memory_limit', '1500000M');
ini_set("pcre.backtrack_limit", "3000000");

// Conectarse a la base de datos
$dsn = "{$CONFIG['dbtype']}:host={$CONFIG['dbhost']};port={$CONFIG['dbport']};dbname={$CONFIG['dbname']}";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
    $conn = new PDO($dsn, $CONFIG['dbuser'], $CONFIG['dbpass'], $options);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}

// Obtener datos del producto seleccionado
$sql = "SELECT idproducto, producto, peso FROM productos WHERE idproducto = :producto_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['producto_id' => $producto_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Crear contenido HTML para el PDF
$html = '
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        h1, h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .header {
            background-color: #f8f8f8;
        }
    </style>
</head>
<body>
<h1>Gráfico de Ventas por Producto del año '.$anio.'</h1>
    <img src="../images/grafico_productos.png" width="100%" /> <!-- Asegúrate de que la ruta sea correcta -->

    <h1>Datos del Producto</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Peso</th>
            </tr>
        </thead>
        <tbody>';

$html .= '
            <tr>
                <td>' . htmlspecialchars($product['idproducto']) . '</td>
                <td>' . htmlspecialchars($product['producto']) . '</td>
                <td>' . htmlspecialchars($product['peso']) . '</td>
            </tr>';

$html .= '
        </tbody>
    </table>
    </body>
</html>';

// Crear instancia de mPDF
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4'
]);

// Escribir el contenido HTML en el PDF
$mpdf->WriteHTML($html);

// Salida del PDF
$mpdf->Output();
?>
