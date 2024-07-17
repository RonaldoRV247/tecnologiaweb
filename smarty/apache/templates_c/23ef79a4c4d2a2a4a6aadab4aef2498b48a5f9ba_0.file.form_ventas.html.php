<?php
/* Smarty version 4.5.3, created on 2024-07-16 23:15:15
  from 'D:\xampp\htdocs\tecnologiaweb\html\form_ventas.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66974553083668_79964007',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23ef79a4c4d2a2a4a6aadab4aef2498b48a5f9ba' => 
    array (
      0 => 'D:\\xampp\\htdocs\\tecnologiaweb\\html\\form_ventas.html',
      1 => 1721189713,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:menu_top.html' => 1,
  ),
),false)) {
function content_66974553083668_79964007 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\tecnologiaweb\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<!DOCTYPE html>
<html>
<head>
    <?php $_smarty_tpl->_subTemplateRender("file:head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'head'), 0, false);
?>
    <title>Ventas</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        table{border-spacing:0px; border-collapse:collapse; border:0.1px solid #000; font-size:12px;}
        thead{background-color:#dce6f1;}            
        th, td {padding: 0px; border:0.1px solid #000; vertical-align: middle}
        table th{vertical-align: middle}
        #data tr:nth-child(odd) td{background-color:#c5daeb}
        #data tr:nth-child(even) td{background-color:#e3fbf0}
        
    </style>
    <?php echo '<script'; ?>
 type="text/javascript">
    <?php echo '</script'; ?>
>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"><?php echo '</script'; ?>
>
</head>
<body>
    
    <?php $_smarty_tpl->_subTemplateRender("file:menu_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'menu_top'), 0, false);
?>
    <input type="button" class="form-control btn btn-warning" onclick="location.href='reportes.php';" value="Ir a reportes" />
    <form id="frmClt" name="frmClt" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>
" onsubmit="return validarFrm()">
        <fieldset class="mx-5 p-3">
            <legend class="text-primary">Registro de ventas</legend>
            <div class="row">
                <input class="form-control mx-2 mb-2 col" type="date" value="<?php if ((isset($_smarty_tpl->tpl_vars['vt']->value['fecha']))) {
echo $_smarty_tpl->tpl_vars['vt']->value['fecha'];
}?>" name="fecha" id="fecha" placeholder="Fecha" title="Fecha" required autofocus/>
                <select class="form-select mx-2 mb-2 col" name="idcliente" id="idcliente" required >
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['clientes']->value,'selected'=>$_smarty_tpl->tpl_vars['vt']->value['idcliente']),$_smarty_tpl);?>

                </select>
                <input class="form-control mx-2 mb-2 col" type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['vt']->value['serie']))) {
echo $_smarty_tpl->tpl_vars['vt']->value['serie'];
}?>" name="serie" id="serie" placeholder="Serie" title="Serie" onkeypress="return Text(event)" maxlength="11" required/>
                <input class="form-control mx-2 mb-2 col" type="number" value="<?php if ((isset($_smarty_tpl->tpl_vars['vt']->value['numero']))) {
echo $_smarty_tpl->tpl_vars['vt']->value['numero'];
} else {
echo $_smarty_tpl->tpl_vars['numero_inicial']->value;
}?>" name="numero" id="numero" placeholder="Numero" title="Numero" readonly style="text-transform:uppercase"/>
            </div>
            <div class="row">
                <input class="form-control mx-2 mb-2 col" type="number" step=".01"  name="subtotal" id="subtotal" placeholder="Subtotal" title="Subtotal" onchange="calcularIGV()" readonly/>
                <input class="form-control mx-2 mb-2 col" type="number" step=".01"  name="igv" id="igv" placeholder="Igv" title="Igv" readonly/>
                <input class="form-control mx-2 mb-2 col" type="number" step=".01"  name="total" id="total" placeholder="Total" title="Total" readonly/>
            </div>
            <!-- Aqui esta la parte de detalle de venta, para no perderme xd -->
            <div class="border rounded border-secondary p-2 mb-2" id="detalle_venta">
                <h6>Agregar productos</h6>
                <div class="row mx-2">
                    <select class="form-select mx-2 mb-2 col" name="idproducto" id="idproducto" required >
                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['productos']->value),$_smarty_tpl);?>

                    </select>
                    <input class="form-control mx-2 mb-2 col" type="number"  name="precio" id="precio" placeholder="precio" title="precio" required/>
                    <!--  --><input type="hidden" name="detalle" id="detalle" />
                    <input class="form-control mx-2 mb-2 col" type="number" name="cantidad" id="cantidad" placeholder="cantidad" title="cantidad" required/>
                    <!-- <button class="col-1 btn btn-outline-secondary mx-2 mb-2" type="button" title="Agregar producto" onclick="agregarProducto()">➕</button> -->
                    <!--  --><button id="btnAgregar" class="col-1 btn btn-outline-secondary mx-2 mb-2" type="button" title="Agregar producto" onclick="agregarProducto()">➕</button>
                </div>
                <div class="" style="max-height: 250px; overflow-y: auto; border: 2px;">
                    <table class="table table-hover rounded" id="detallevta">
                        <thead><tr><th>PRODUCTO</th><th>PRECIO</th><th>CANTIDAD</th><th>IMPORTE</th></tr></thead>
                        <tbody style="overflow-y: auto;">
                            <?php if ((isset($_smarty_tpl->tpl_vars['det_vt']->value))) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['det_vt']->value, 'det');
$_smarty_tpl->tpl_vars['det']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['det']->value) {
$_smarty_tpl->tpl_vars['det']->do_else = false;
?>
                                    <tr data-idproducto="<?php echo $_smarty_tpl->tpl_vars['det']->value['idproducto'];?>
">
                                        <td><?php echo $_smarty_tpl->tpl_vars['det']->value['producto'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['det']->value['precio'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['det']->value['cantidad'];?>
</td>
                                        <td><?php echo $_smarty_tpl->tpl_vars['det']->value['importe'];?>
</td>
                                        <td align="center"><span style="cursor:pointer;" title="Eliminar" onclick="eliminarDetalle(`<?php echo $_smarty_tpl->tpl_vars['det']->value['iddetalleventa'];?>
`)">❌</span>️</td>
                                    </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <?php } else { ?>
                            <?php }?>
                        </tbody>
                        <tfoot class="fw-bold">
                            <tr>
                                <td colspan="3">Sub Total</td>
                                <td id="subtotaldetalle"></td>
                            </tr>
                        </tfoot>
                    </table>
                    <input class="form-control" type="text" name="datosdetalle" id="datosdetalle">
                </div>
            </div>
            <!-- Aqui esta el fin de la parte de detalle de venta, para no perderme xd -->
            <section style="clear: both; text-align: center">
                <input class="btn btn-primary" type="submit" id="bnguardar" name="mod" value="<?php if ((isset($_REQUEST['mod'])) == 'editar') {?>Modificar<?php } else { ?>Insertar<?php }?>"/> &nbsp; 
                <input class="btn btn-secondary" type="reset" value="Cancelar" onclick="window.location.href='<?php echo $_SERVER['SCRIPT_NAME'];?>
';"/>
            </section>
        </fieldset>
    </form>
    <br/>
    
    <div class="mx-5">
        <caption class="ms-5" style="text-align:left"><input type="search" id="bsc" placeholder="Buscar" title="Buscar" autofocus onkeyup="getVentas()"/></caption>
        <table class="table table-hover rounded" id="data" border="1" cellspacing="0" cellpadding="0" align="center" style="min-width:90%;">
            <thead><tr><th>ID VTA</th><th>CLIENTES</th><th>FECHA</th><th>SERIE - NÚMERO</th><th>SUBTOTAL</th><TH>IGV</TH><TH>TOTAL</TH></tr></thead>
            <tbody></tbody>
        </table>
    </div>
    <?php echo '<script'; ?>
 type="text/javascript" src="js/ventas.js<?php echo $_smarty_tpl->tpl_vars['vars']->value['version'];?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
        getVentas();
        function calcularSubtotalDetalle(){
            let filas = document.querySelectorAll('#detallevta tbody tr');
            console.log(filas);
            let suma = 0;
            // let datosfila = '';
            // let datos = new Array();
            let detalle = [];
            filas.forEach(fila => {
                let productotd = fila.children[0].textContent;
                let preciotd = parseFloat(fila.children[1].textContent);
                let cantidadtd = parseFloat(fila.children[2].textContent);
                let importetd = parseFloat(fila.children[3].textContent);
                suma += importetd;
                let idproducto = fila.getAttribute('data-idproducto'); // Asumiendo que has agregado este atributo en la función agregarProducto
                // datosfila += `'${productotd}';${preciotd};${cantidadtd};${importetd};`;
                // datos.push(datosfila);
                detalle.push({
                    producto: productotd,
                    precio: preciotd,
                    cantidad: cantidadtd,
                    importe: importetd,
                    idproducto: idproducto
                });
            });
            // document.getElementById("datosdetalle").value=datos;
            /* */document.getElementById('detalle').value = JSON.stringify(detalle);
            let totalPrecioElemento = document.getElementById('subtotaldetalle');
            totalPrecioElemento.innerHTML = suma.toFixed(2);
            let subtotalvta = document.getElementById('subtotal');
            subtotalvta.value = suma.toFixed(2);
            let subtotal = parseFloat(document.getElementById("subtotal").value) || 0;
            let igv = subtotal * 0.18;
            document.getElementById("igv").value = igv.toFixed(2);
            document.getElementById("total").value = (subtotal + igv).toFixed(2);
        }
        function agregarProducto(){
            var producto = $("#idproducto option:selected").text();
            var idproducto = $("#idproducto").val();
            var precio = parseFloat($("#precio").val());
            var cantidad = parseInt($("#cantidad").val());
            var importe = precio * cantidad;
            if(precio>0 && cantidad>0){
                $("#detallevta tbody").append(
                    `<tr data-idproducto="${idproducto}">
                    <td>${producto}</td>
                    <td>${precio.toFixed(2)}</td>
                    <td>${cantidad}</td>
                    <td>${importe.toFixed(2)}</td>
                    <td align="center"><span title="Eliminar" onclick="eliminarfila(this)">❌</span>️</td>
                    </tr>`
                );
                calcularSubtotalDetalle();
            }
        }
        function eliminarfila(elim){
            var fila = elim.parentNode.parentNode;
            fila.parentNode.removeChild(fila);
            var tabla = document.getElementById("detallevta");
            var filasRestantes = tabla.getElementsByTagName("tr").length;
            if (filasRestantes === 2) {
                document.getElementById("datosdetalle").value="";
                calcularSubtotalDetalle();
            }
            console.log(filasRestantes);
            calcularSubtotalDetalle();
        }

        function eliminarDetalle(iddetalle){
            if (!confirm('Se eliminará el producto')) {
                return false;
            }
            $.ajax({type: "POST", url: 'ventas.php?&mod=eliminardetalle&iddetalleventa='+iddetalle,
                success: function (result){
                    if (result==='Se ha eliminado corectamente.') {
                        alert('Eliminado!');
                        window.location.href='ventas.php';
                    }
                    
                },
            });
        }

        $(document).ready(function(){
            calcularSubtotalDetalle();
        })
    <?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
