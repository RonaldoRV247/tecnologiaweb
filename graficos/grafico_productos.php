<?php
// Conectar a la base de datos
require_once('../classes/config.php');

$dsn = "{$CONFIG['dbtype']}:host={$CONFIG['dbhost']};port={$CONFIG['dbport']};dbname={$CONFIG['dbname']}";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
    $conn = new PDO($dsn, $CONFIG['dbuser'], $CONFIG['dbpass'], $options);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}

// Obtener los parámetros del formulario
$producto_id = isset($_POST['producto']) ? $_POST['producto'] : 1; // Valor por defecto si no se selecciona nada
$anio = isset($_POST['anio']) ? $_POST['anio'] : date('Y'); // Valor por defecto si no se selecciona nada

// Consulta para obtener los datos de ventas por mes
$sql = "SELECT MONTH(ventas.fecha) as mes, SUM(detalleventa.cantidad) as total_vendido
        FROM detalleventa
        JOIN ventas ON detalleventa.idventa = ventas.idventa
        WHERE detalleventa.idproducto = :producto_id AND YEAR(ventas.fecha) = :anio
        GROUP BY mes";
$stmt = $conn->prepare($sql);
$stmt->execute(['producto_id' => $producto_id, 'anio' => $anio]);

// Preparar datos para el gráfico
$data = [];
for ($i = 1; $i <= 12; $i++) {
    $data[$i] = 0; // Inicializar los meses en 0
}

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[$row['mes']] = $row['total_vendido'];
}

// Crear una imagen en blanco
$width = 800;
$height = 600;
$image = imagecreatetruecolor($width, $height);

// Asignar colores
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$green = imagecolorallocate($image, 0, 128, 0);

// Rellenar el fondo de blanco
imagefilledrectangle($image, 0, 0, $width, $height, $white);

// Dibujar ejes del plano cartesiano
imageline($image, 100, 50, 100, $height - 50, $black); // Eje Y
imageline($image, 100, $height - 50, $width - 50, $height - 50, $black); // Eje X

// Calcular dimensiones de las barras
$bar_width = 40;
$bar_spacing = 20;
$max_value = max($data);
$scale = ($height - 120) / ($max_value > 0 ? $max_value : 1); // Ajustar la altura máxima de las barras

// Dibujar las barras y etiquetas
for ($i = 1; $i <= 12; $i++) {
    $bar_height = $data[$i] * $scale;
    $x1 = ($i * ($bar_width + $bar_spacing)) + 100;
    $y1 = $height - 50;
    $x2 = $x1 + $bar_width;
    $y2 = $y1 - $bar_height;
    
    imagefilledrectangle($image, $x1, $y1, $x2, $y2, $green);
    
    // Etiquetas de los valores numéricos
    $value_label = number_format($data[$i]); // Formato de número
    $text_width = imagefontwidth(5) * strlen($value_label); // Ancho del texto
    $x_text = $x1 + ($bar_width / 2) - ($text_width / 2);
    $y_text = $y2 - 20; // Ajustar posición vertical
    imagestring($image, 5, $x_text, $y_text, $value_label, $black);
    
    // Etiquetas de los meses
    $month_label = date('M', mktime(0, 0, 0, $i, 10)); // Abreviatura del mes
    $text_width = imagefontwidth(5) * strlen($month_label); // Ancho del texto
    $x_text = $x1 + ($bar_width / 2) - ($text_width / 2);
    $y_text = $height - 30; // Ajustar posición vertical
    imagestring($image, 5, $x_text, $y_text, $month_label, $black);
}

// Etiquetas del gráfico
imagestring($image, 5, $width / 2 - 100, 20, 'Ventas por Mes', $black);
imagestringup($image, 5, 20, $height / 2 + 100, 'Total Vendido', $black);

// Guardar la imagen
$file_path = '../images/grafico_productos.png';
imagepng($image, $file_path); // Asegúrate de que la ruta sea correcta

// Liberar memoria
imagedestroy($image);

echo "Gráfico generado y guardado en " . $file_path;
?>
