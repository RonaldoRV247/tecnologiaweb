<?php
require_once '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

// Incluir las configuraciones necesarias
require_once('../classes/config.php'); // Ajusta la ruta según sea necesario

// Conectarse a la base de datos
$dsn = "{$CONFIG['dbtype']}:host={$CONFIG['dbhost']};port={$CONFIG['dbport']};dbname={$CONFIG['dbname']}";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
    $conn = new PDO($dsn, $CONFIG['dbuser'], $CONFIG['dbpass'], $options);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}

// Obtener los parámetros del formulario
$idproveedor = isset($_POST['proveedor']) ? $_POST['proveedor'] : 1; // Valor por defecto si no se selecciona nada

// Consulta para obtener los datos de compras por año
$sql = "SELECT YEAR(fecha) AS anio, COUNT(*) AS total_compras
        FROM compras
        WHERE idproveedor = :idproveedor
        GROUP BY anio";
$stmt = $conn->prepare($sql);
$stmt->execute(['idproveedor' => $idproveedor]);

// Preparar datos para el gráfico
$data = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[$row['anio']] = $row['total_compras'];
}

// Asegurar que todos los años entre el más antiguo y el más reciente tengan un valor
$current_year = date('Y');
$earliest_year = min(array_keys($data));
for ($year = $earliest_year; $year <= $current_year; $year++) {
    if (!isset($data[$year])) {
        $data[$year] = 0;
    }
}
ksort($data); // Ordenar el array por años

// Crear una imagen en blanco
$width = 800;
$height = 600;
$image = imagecreatetruecolor($width, $height);

// Asignar colores
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);
$blue = imagecolorallocate($image, 0, 191, 255);

// Rellenar el fondo de blanco
imagefilledrectangle($image, 0, 0, $width, $height, $white);

// Calcular dimensiones de las barras
$bar_width = 20;
$bar_spacing = 20;
$plot_area_width = $width - 200; // Área para dibujar las barras
$interval = $plot_area_width / (count($data) - 1); // Intervalo entre barras

// Dibujar las barras y etiquetas
$i = 0;
foreach ($data as $anio => $total_compras) {
    $x1 = 100;
    $y1 = 100 + ($interval * $i);
    $x2 = $x1 + (($total_compras / max($data)) * $plot_area_width);
    $y2 = $y1 + $bar_width;

    // Dibujar la barra
    imagefilledrectangle($image, $x1, $y1, $x2, $y2, $blue);

    // Etiquetas de los valores numéricos
    $value_label = number_format($total_compras); // Formato de número
    $text_width = imagefontwidth(5) * strlen($value_label); // Ancho del texto
    $x_text = $x2 + 10; // Ajuste horizontal
    $y_text = $y1 + ($bar_width / 2) - 7; // Ajuste vertical
    imagestring($image, 5, $x_text, $y_text, $value_label, $black);

    // Etiquetas de los años
    $year_label = $anio;
    $text_width = imagefontwidth(5) * strlen($year_label); // Ancho del texto
    $x_text = 50; // Ajuste horizontal
    $y_text = $y1 + ($bar_width / 2) - 7; // Ajuste vertical
    imagestring($image, 5, $x_text, $y_text, $year_label, $black);

    $i++;
}

// Etiquetas del gráfico
imagestring($image, 5, $width / 2 - 100, 20, 'Compras Anuales por Proveedor', $black);
imagestringup($image, 5, 20, $height / 2 + 100, 'Año', $black);

// Guardar la imagen
$file_path = '../images/grafico_compras_proveedor.png';
imagepng($image, $file_path); // Asegúrate de que la ruta sea correcta

// Liberar memoria
imagedestroy($image);

echo "Gráfico generado y guardado en " . $file_path;
?>
