<?php
// chart.php

// Conectar a la base de datos
require_once('../classes/config.php');

$dsn = "{$CONFIG['dbtype']}:host={$CONFIG['dbhost']};port={$CONFIG['dbport']};dbname={$CONFIG['dbname']}";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
    $conn = new PDO($dsn, $CONFIG['dbuser'], $CONFIG['dbpass'], $options);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}

// Consulta para obtener la cantidad de clientes por tipo de documento
$sql = "SELECT td.descripcion, COUNT(c.idcliente) AS cantidad
        FROM tipodocumento td
        LEFT JOIN clientes c ON td.idtipodocumento = c.idtipodocumento
        GROUP BY td.descripcion";
$result = $conn->query($sql);

// Preparar datos para el gráfico
$labels = [];
$data = [];

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // Ajustar nombres largos
    $labels[] = wordwrap($row['descripcion'], 15, "\n", true);
    $data[] = $row['cantidad'];
}

// Crear una imagen en blanco
$width = 800; // Ajustar el ancho según necesidades
$height = 600; // Ajustar la altura según necesidades
$image = imagecreatetruecolor($width, $height);

// Asignar colores
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$blue = imagecolorallocate($image, 0, 0, 255);
$lightGray = imagecolorallocate($image, 200, 200, 200);

// Rellenar el fondo de blanco
imagefilledrectangle($image, 0, 0, $width, $height, $white);

// Dibujar ejes del plano cartesiano
imageline($image, 100, 50, 100, $height - 50, $black); // Eje Y
imageline($image, 100, $height - 50, $width - 50, $height - 50, $black); // Eje X

// Calcular dimensiones de las barras
$bar_width = 50;
$bar_spacing = 20;
$max_value = max($data);
$scale = ($height - 120) / $max_value; // Ajustar la altura máxima de las barras

// Dibujar las barras y etiquetas
for ($i = 0; $i < count($data); $i++) {
    $bar_height = $data[$i] * $scale;
    $x1 = ($i * ($bar_width + $bar_spacing)) + 130;
    $y1 = $height - 50;
    $x2 = $x1 + $bar_width;
    $y2 = $y1 - $bar_height;
    
    imagefilledrectangle($image, $x1, $y1, $x2, $y2, $blue);
    
    // Etiquetas de los valores numéricos
    $value_label = number_format($data[$i]); // Formato de número
    $text_width = imagefontwidth(5) * strlen($value_label); // Ancho del texto
    $x_text = $x1 + ($bar_width / 2) - ($text_width / 2);
    $y_text = $y2 - 20; // Ajustar posición vertical
    imagettftext($image, 8, 0, $x_text, $y_text, $black, '../fonts/arial.ttf', $value_label);
    
    // Etiquetas de los nombres de los tipos de documento
    $lines = explode("\n", $labels[$i]);
    $num_lines = count($lines);
    $text_height = imagefontheight(5) * $num_lines; // Alto del texto
    $x_label = $x1 + ($bar_width / 2) - ($text_width / 2); // Ajustar posición horizontal centrada
    $y_label = $y1 + 30; // Ajustar posición vertical para las etiquetas
    
    foreach ($lines as $line) {
        $line_width = imagefontwidth(6) * strlen($line); // Ancho del texto de la etiqueta
        $x_label_adjusted = $x1 + ($bar_width / 2) - ($line_width / 2); // Ajuste centrado bajo la barra
        imagettftext($image, 6, 0, $x_label_adjusted, $y_label, $black, '../fonts/arial.ttf', $line);
        $y_label += imagefontheight(5); // Incrementar posición vertical para la siguiente línea
    }
}

// Etiquetas del gráfico
imagettftext($image, 14, 0, $width / 2 - 200, 30, $black, '../fonts/arial.ttf', 'Cantidad de Clientes por Tipo de Documento');
imagettftext($image, 12, 90, 20, $height / 2 + 50, $black, '../fonts/arial.ttf', 'Cantidad de Clientes');

// Guardar la imagen
imagepng($image, '../images/chart.png'); // Asegúrate de que la ruta sea correcta

// Liberar memoria
imagedestroy($image);
?>
