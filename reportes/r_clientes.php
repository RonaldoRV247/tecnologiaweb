<?php
require_once '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

// Incluir las configuraciones necesarias
require_once('../classes/config.php'); // Ajusta la ruta según sea necesario
// Generar el gráfico
include '../graficos/chart.php'; // Ajusta la ruta según la estructura de tu proyecto

// Conectarse a la base de datos
$dsn = "{$CONFIG['dbtype']}:host={$CONFIG['dbhost']};port={$CONFIG['dbport']};dbname={$CONFIG['dbname']}";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
    $conn = new PDO($dsn, $CONFIG['dbuser'], $CONFIG['dbpass'], $options);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}

// Obtener datos de los clientes
$sql = "SELECT idcliente, razonsocial, email, direccion, celular FROM clientes where idcliente<=100";
$result = $conn->query($sql);

// Crear contenido HTML para el PDF
$html = '
<html>
<head>
    <style>
        @import url("https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css");
        body { font-family: sans-serif; background-color: #f7fafc; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px 12px; border: 1px solid #dee2e6; text-align: left; }
        th { background-color: #f8f9fa; }
        h1 { color: #007bff; }
        .container { max-width: 800px; margin: 20px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Gráfico de Clientes</h1>
        <img src="../images/chart.png" class="w-full mb-8" /> <!-- Asegúrate de que la ruta sea correcta -->

        <h1 class="text-2xl font-bold mb-4">Reporte de Clientes (Primeros 100 para no hacer lenta la máquina)</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Razón Social</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Celular</th>
                </tr>
            </thead>
            <tbody>';

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $html .= '
                <tr>
                    <td>' . htmlspecialchars($row['idcliente']) . '</td>
                    <td>' . htmlspecialchars($row['razonsocial']) . '</td>
                    <td>' . htmlspecialchars($row['email']) . '</td>
                    <td>' . htmlspecialchars($row['direccion']) . '</td>
                    <td>' . htmlspecialchars($row['celular']) . '</td>
                </tr>';
}

$html .= '
            </tbody>
        </table>
    </div>
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
