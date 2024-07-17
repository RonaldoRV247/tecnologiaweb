<?php
require_once("cSetup.php");

class reportes extends Setup {
    var $mod;

    function __construct() {
        parent::__construct();
        if (isset($_REQUEST['mod'])) {
            $this->mod = $_REQUEST['mod'];
        }
    }

    function form() {
        // Obtener lista de productos
        $productos = $this->obtenerProductos();
        $this->smarty->assign('productos', $productos);

        // Obtener lista de años (suponiendo que tienes una función para esto)
        $anios = $this->obtenerAnios();
        $proveedores = $this->obtenerProveedores();
        $this->smarty->assign('proveedores', $proveedores);
        $this->smarty->assign('anios', $anios);
        $this->smarty->assign('report_url', '../tecnologiaweb/reportes/r_clientes.php');
        $this->smarty->assign('report_compras', '../tecnologiaweb/reportes/r_compras.php');
        $this->smarty->assign('report_productos', '../tecnologiaweb/reportes/r_productos.php');
        $this->smarty->display('form_reportes.html');
    }

    // Función para obtener lista de productos desde la base de datos
    function obtenerProductos() {
        try {
            $query = "SELECT idproducto, producto FROM productos";
            $stmt = $this->db->query($query);
            $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Transformar el array para eliminar índices numéricos
            $productos_options = array();
            foreach ($productos as $producto) {
                $productos_options[$producto['idproducto']] = $producto['producto'];
            }

            return $productos_options;
        } catch (PDOException $e) {
            die("Error al obtener productos: " . $e->getMessage());
        }
    }

    // Función para obtener lista de años disponibles
    function obtenerAnios() {
        // Ejemplo de generación de años (puedes adaptarlo según tu lógica)
        $anios = array();
        $anio_actual = date('Y');
        for ($i = $anio_actual; $i >= $anio_actual - 30; $i--) {
            $anios[$i] = $i;
        }
        return $anios;
    }
    function obtenerProveedores() {
        try {
            $query = "SELECT idproveedor, razonsocial, email FROM proveedores";
            $stmt = $this->db->query($query);
            $proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Transformar el array para eliminar índices numéricos
            $proveedores_options = array();
            foreach ($proveedores as $proveedor) {
                $proveedores_options[$proveedor['idproveedor']] ='Razón Social: '. $proveedor['razonsocial'] .' | Correo: '. $proveedor['email'];
            }

            return $proveedores_options;
        } catch (PDOException $e) {
            die("Error al obtener proveedores: " . $e->getMessage());
        }
    }
}
?>
