<?php /** @package EBC * @author Elmer Blas * @e-mail elmer.blas@gmail.com and kimer_12@hotmail.com * @copyright Elmer Blas */
require_once ("cSetup.php");
class ventas extends Setup{
    var $error;
    var $mod;
    var $query = array( 0 => 'select v.*,cl.razonsocial from ventas v inner join clientes cl where v.idcliente=cl.idcliente 
                            and if(length(?), v.numero like ?,1) order by v.idventa asc limit 30',
                        1 => 'select * from ventas where idventa=?',
                        2 => 'update ventas set fecha=?, serie=?, numero=?, subtotal=?, igv=?,total=?, idcliente=? where idventa=?',
                        3 => 'insert into ventas (fecha, serie, numero, subtotal, igv,total, idcliente) values(?, ?, ?, ?,?, ?, ?)',
                        4 => 'delete from ventas where idventa=?'
);
    function __construct() {
        parent::__construct();
        if (isset($_REQUEST['mod'])) {
            $this->mod = $_REQUEST['mod'];
        }
        
    }
    
    function setNumeroInicial() {
         $p = $this->db->prepare("SELECT ultimo_numero FROM config WHERE id = 1");
         $p->execute();
         $result = $p->fetch();
         $numero = $result['ultimo_numero'] + 1;
 
         // Asignar el nuevo número al template
         $this->smarty->assign('numero_inicial', $numero);
    }

    function form(){
        $this->getTipodocumento();
        $this->getClientes(); // Añadir esta línea
        if ($this->mod == 'editar')
            $this->cargarDatos();
        else
            $this->setNumeroInicial(); // Llamamos a la nueva función
        $this->smarty->display('form_ventas.html');
    }
    
    function getClientes() {
        $sql = "SELECT idcliente, razonsocial FROM clientes";
        $p = $this->db->prepare($sql);
        $p->execute();
        $clientes = array();
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
    function cargarDatos(){
        $p = $this->db->prepare($this->query[1]);
        $p->execute(array($_REQUEST['idventa']));
        $v = $p->fetch();
        $this->smarty->assign('v', $v);
    }
    function guardar(){
        try {
//            $this->db->beginTransaction();
            if(isset($_REQUEST['idventa'])){
                $p = $this->db->prepare($this->query[2]);
                $p->execute(array($_REQUEST['fecha'],$_REQUEST['serie'],$_REQUEST['numero'],$_REQUEST['subtotal'],$_REQUEST['igv'],$_REQUEST['total'],$_REQUEST['idcliente'],$_REQUEST['idventa']));
            }else{
                $p = $this->db->prepare($this->query[3]);
                $p->execute(array($_REQUEST['fecha'],$_REQUEST['serie'],$_REQUEST['numero'],$_REQUEST['subtotal'],$_REQUEST['igv'],$_REQUEST['total'],$_REQUEST['idcliente']));
                // Actualizar el último número generado en la tabla de configuración
                $numero = $_REQUEST['numero'];
                $p = $this->db->prepare("UPDATE config SET ultimo_numero = :numero WHERE id = 1");
                $p->execute(['numero' => $numero]);
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
}