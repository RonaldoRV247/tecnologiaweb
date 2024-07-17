<?php
require_once '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

// Incluir las configuraciones necesarias
require_once('../classes/config.php'); // Ajusta la ruta según sea necesario

// Obtener los parámetros del formulario
$idproveedor = isset($_POST['proveedor']) ? $_POST['proveedor'] : 1; // Valor por defecto si no se selecciona nada
$anio = isset($_POST['anio']) ? $_POST['anio'] : date('Y'); // Valor por defecto si no se selecciona nada

// Generar el gráfico
$_POST['idproveedor'] = $idproveedor;
include '../graficos/grafico_compras.php'; // Ajusta la ruta según la estructura de tu proyecto

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

// Obtener datos del proveedor seleccionado
$sql = "SELECT idproveedor, razonsocial, numero, direccion, celular, email, url FROM proveedores WHERE idproveedor = :idproveedor";
$stmt = $conn->prepare($sql);
$stmt->execute(['idproveedor' => $idproveedor]);
$proveedor = $stmt->fetch(PDO::FETCH_ASSOC);

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
<h1>Gráfico de Compras por Proveedor</h1>
    <img src="../images/grafico_compras_proveedor.png" width="100%" /> <!-- Asegúrate de que la ruta sea correcta -->

    <h1>Datos del Proveedor</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Razón Social</th>
                <th>Número</th>
                <th>Dirección</th>
                <th>Celular</th>
                <th>Email</th>
                <th>URL</th>
            </tr>
        </thead>
        <tbody>';

$html .= '
            <tr>
                <td>' . htmlspecialchars($proveedor['idproveedor']) . '</td>
                <td>' . htmlspecialchars($proveedor['razonsocial']) . '</td>
                <td>' . htmlspecialchars($proveedor['numero']) . '</td>
                <td>' . htmlspecialchars($proveedor['direccion']) . '</td>
                <td>' . htmlspecialchars($proveedor['celular']) . '</td>
                <td>' . htmlspecialchars($proveedor['email']) . '</td>
                <td>' . htmlspecialchars($proveedor['url']) . '</td>
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
