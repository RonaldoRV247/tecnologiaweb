<?php
/* Smarty version 4.5.3, created on 2024-07-15 22:38:49
  from 'D:\xampp\htdocs\tecnologiaweb\reportes\r_proveedores.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6695eb4925d079_58674360',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9975ef5f72e1185095752a429f53b7ae5188e718' => 
    array (
      0 => 'D:\\xampp\\htdocs\\tecnologiaweb\\reportes\\r_proveedores.php',
      1 => 1721100935,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6695eb4925d079_58674360 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php'; ?>

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
$sql = "SELECT idcliente, razonsocial, email, direccion, celular FROM clientes";
$result = $conn->query($sql);

// Crear contenido HTML para el PDF
$html = '
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
<h1>Gráfico de Clientes</h1>
    <img src="../images/chart.png" width="100%" /> <!-- Asegúrate de que la ruta sea correcta -->

    <h1>Reporte de Clientes</h1>
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
<?php echo '?>'; ?>

<?php }
}
