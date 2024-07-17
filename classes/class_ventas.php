<?php /** @package EBC * @author Elmer Blas * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com * @copyright Elmer Blas */
require_once ("cSetup.php");
class ventas extends Setup{
    var $error;
    var $mod;
    var $query = array( 0 => 'select c.*,v.razonsocial from ventas c inner join clientes v where c.idcliente=v.idcliente 
                            and if(length(?), v.razonsocial like ?,1) order by c.idventa asc limit 30',
                        1 => 'select * from ventas where idventa=?',
                        2 => 'update ventas set fecha=?, serie=?, numero=?, subtotal=?, igv=?,total=?, idcliente=? where idventa=?',
                        3 => 'insert into ventas (fecha, serie, numero, subtotal, igv,total, idcliente) values(?, ?, ?, ?,?, ?, ?)',
                        4 => 'delete from ventas where idventa=?',
                        5 => 'select MAX(numero) as max_numero FROM ventas',
                        6 => 'select dv.*,p.producto from detalleventa dv inner join productos p where p.idproducto=dv.idproducto and idventa=?',
                        7 => 'insert into detalleventa (precio,cantidad,importe,idproducto,idventa) values (?,?,?,?,?)',
                        8 => 'select idventa from ventas order by idventa desc limit 1',
                        9 => 'delete from detalleventa where iddetalleventa=?',
                        10 => 'update detalleventa set precio=?,cantidad=?,importe=?,idproducto=?,idventa=? where iddetalleventa=?',

    );
    function __construct() {
        parent::__construct();
        if (isset($_REQUEST['mod'])) {
            $this->mod = $_REQUEST['mod'];
        }
    }

    function setNumeroInicial() {
        $p = $this->db->prepare($this->query[5]);
        $p->execute();
        $result = $p->fetch();
        $numero = $result['max_numero'] ? $result['max_numero'] + 1 : 1000;
        $this->smarty->assign('numero_inicial', $numero);
    }

    function form(){
        $this->getTipodocumento();
        $this->getProveedores(); // Añadir esta línea
        $this->getProductos(); 
        if ($this->mod == 'editar'){
            $this->cargarDatos();
            // $this->getDetalleVta();
        }else
            $this->setNumeroInicial(); // Llamamos a la nueva función
        $this->smarty->display('form_ventas.html');
    }
    
    function getProveedores() {
        $sql = "SELECT idcliente, razonsocial FROM clientes";
        $p = $this->db->prepare($sql);
        $p->execute();
        $proveedores = array();
        while($row = $p->fetch()) {
            $clientes[$row['idcliente']] = $row['razonsocial'];
        }
        $this->smarty->assign('clientes', $clientes);
    }
    
    function getVentas(){
        $p = $this->db->prepare($this->query[0]);
        $p->execute(array($_REQUEST['bsc'], '%'.$_REQUEST['bsc'].'%'));
        while($rw=$p->fetch())
            $ventas[]=$rw;
        echo json_encode($ventas);
    }

    function getProductos() {
        $sql = "SELECT idproducto,producto FROM productos";
        $p = $this->db->prepare($sql);
        $p->execute();
        // $productos = array();
        while($row = $p->fetch()) {
            $productos[$row['idproducto']] = $row['producto'];
        }
        $this->smarty->assign('productos', $productos);
    }
    
    function cargarDatos(){
        $p = $this->db->prepare($this->query[1]);
        $p->execute(array($_REQUEST['idventa']));
        $vt = $p->fetch();
        $this->smarty->assign('vt', $vt);
        //para el detalle de venta 
        $p2 = $this->db->prepare($this->query[6]);
        $p2->execute(array($_REQUEST['idventa']));
        while($rw=$p2->fetch())
            $det_vt[]=$rw;
        $this->smarty->assign('det_vt', $det_vt);
    }

    function guardar(){
        try {
//            $this->db->beginTransaction();
            if(isset($_REQUEST['idventa'])){
                $idventa = $_REQUEST['idventa'];
                $p = $this->db->prepare($this->query[2]);
                $p->execute(array($_REQUEST['fecha'],$_REQUEST['serie'],$_REQUEST['numero'],$_REQUEST['subtotal'],$_REQUEST['igv'],$_REQUEST['total'],$_REQUEST['idcliente'],$_REQUEST['idventa']));
                // $act = $this->db->prepare($this->query[10]);
                if(isset($_REQUEST['detalle'])){
                    $detalle = json_decode($_REQUEST['detalle'], true);
                    foreach ($detalle as $item) {
                        $pd = $this->db->prepare($this->query[7]);
                        $pd->execute(array($item['precio'], $item['cantidad'], $item['importe'], $item['idproducto'], $idventa));
                    }
                }

            }else{
                $p = $this->db->prepare($this->query[3]);
                $p->execute(array($_REQUEST['fecha'],$_REQUEST['serie'],$_REQUEST['numero'],$_REQUEST['subtotal'],$_REQUEST['igv'],$_REQUEST['total'],$_REQUEST['idcliente']));
                 // Obtener el último ID de venta insertado
                $idventa = $this->db->lastInsertId();
                // Guardar detalle de venta
                $detalle = json_decode($_REQUEST['detalle'], true);
                foreach ($detalle as $item) {
                    $pd = $this->db->prepare($this->query[7]);
                    $pd->execute(array($item['precio'], $item['cantidad'], $item['importe'], $item['idproducto'], $idventa));
                }
            }

            header('location: ventas.php');
//            $this->db->commit();
        } catch (Exception $exc) {
//            $this->db->rollback();
            $this->error=1;
            $this->msg = $p->errorInfo()[2]; //$p->queryString;
        }
    }
    function eliminar(){
        
        try {
            //code...
            $p = $this->db->prepare($this->query[4]);
            $p->execute(array($_REQUEST['idventa']));
        } catch (Exception $exc) {
            $this->error=1;
        }
        echo $this->error ? 'Error ['.$p->errorInfo()[2] .']' : 'Se ha eliminado corectamente.';
    }
    function eliminardetalle(){
        
        try {
            //code...
            $p = $this->db->prepare($this->query[9]);
            $p->execute(array($_REQUEST['iddetalleventa']));
        } catch (Exception $exc) {
            $this->error=1;
        }
        echo $this->error ? 'Error ['.$p->errorInfo()[2] .']' : 'Se ha eliminado corectamente.';
    }
}