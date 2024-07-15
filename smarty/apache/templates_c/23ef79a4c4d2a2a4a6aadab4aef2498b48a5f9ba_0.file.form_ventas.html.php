<?php
/* Smarty version 4.5.3, created on 2024-07-13 23:01:17
  from 'D:\xampp\htdocs\tecnologiaweb\html\form_ventas.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66934d8d0836c9_55283664',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23ef79a4c4d2a2a4a6aadab4aef2498b48a5f9ba' => 
    array (
      0 => 'D:\\xampp\\htdocs\\tecnologiaweb\\html\\form_ventas.html',
      1 => 1720793870,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:menu_top.html' => 1,
  ),
),false)) {
function content_66934d8d0836c9_55283664 (Smarty_Internal_Template $_smarty_tpl) {
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
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
        function calcularIGV() {
            var subtotal = parseFloat(document.getElementById("subtotal").value) || 0;
            var igv = subtotal * 0.18;
            document.getElementById("igv").value = igv.toFixed(2);
            document.getElementById("total").value = (subtotal + igv).toFixed(2);
        }
    <?php echo '</script'; ?>
>

</head>
<body style="font-size: 20px !important;">
    <?php $_smarty_tpl->_subTemplateRender("file:menu_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'menu_top'), 0, false);
?>
    <form id="frmClt" name="frmClt" class="container" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>
" onsubmit="return validarFrm()">
        <fieldset class="border p-2">
            <legend class="w-auto" style="color: blue">Registro de Ventas</legend>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" value="<?php if ((isset($_smarty_tpl->tpl_vars['v']->value['fecha']))) {
echo $_smarty_tpl->tpl_vars['v']->value['fecha'];
}?>" name="fecha" id="fecha" class="form-control" required autofocus/>
                    </div>
                    <div class="form-group">
                        <label for="idcliente">Clientes</label>
                        <div class="input-group">
                            <select name="idcliente" id="idcliente" class="form-control" required>
                                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['clientes']->value,'selected'=>$_smarty_tpl->tpl_vars['v']->value['idcliente']),$_smarty_tpl);?>

                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark" type="button" onclick="window.location.href='clientes.php'">
                                    <span>➕</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="serie">Serie</label>
                        <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['v']->value['serie']))) {
echo $_smarty_tpl->tpl_vars['v']->value['serie'];
}?>" name="serie" id="serie" class="form-control" placeholder="Serie" maxlength="11" required onkeypress="return Text(event)"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="numero">Número</label>
                        <input type="number" value="<?php if ((isset($_smarty_tpl->tpl_vars['v']->value['numero']))) {
echo $_smarty_tpl->tpl_vars['v']->value['numero'];
} else {
echo $_smarty_tpl->tpl_vars['numero_inicial']->value;
}?>" name="numero" id="numero" class="form-control" placeholder="Número" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="subtotal">Subtotal</label>
                        <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['v']->value['subtotal']))) {
echo $_smarty_tpl->tpl_vars['v']->value['subtotal'];
}?>" name="subtotal" id="subtotal" class="form-control" placeholder="Subtotal" oninput="calcularIGV()"/>
                    </div>
                    <div class="form-group">
                        <label for="igv">IGV</label>
                        <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['v']->value['igv']))) {
echo $_smarty_tpl->tpl_vars['v']->value['igv'];
} else {
echo 0;
}?>" name="igv" id="igv" class="form-control" placeholder="IGV" readonly/>
                    </div>
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['v']->value['total']))) {
echo $_smarty_tpl->tpl_vars['v']->value['total'];
}?>" name="total" id="total" class="form-control" placeholder="Total" readonly/>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <input type="submit" id="bnguardar" name="mod" class="btn btn-primary" value="<?php if ((isset($_REQUEST['mod'])) == 'editar') {?>Modificar<?php } else { ?>Insertar<?php }?>"/>
                <input type="reset" value="Cancelar" class="btn btn-secondary" onclick="window.location.href='<?php echo $_SERVER['SCRIPT_NAME'];?>
';"/>
            </div>
        </fieldset>
    </form>
    
    <br/>
    <div class="container">
        <table id="data" class="min-w-full bg-white border border-gray-300" style="font-size: 15px;">
            <input type="search" id="bsc" placeholder="Buscar" title="Buscar" autofocus onkeyup="getVentas()" class="mb-4 p-2 border border-gray-300 rounded-md w-full"/>
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Clientes</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Fecha</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Serie</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Número</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Subtotal</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">IGV</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Total</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <br>
    <?php echo '<script'; ?>
 type="text/javascript" src="js/ventas.js<?php echo $_smarty_tpl->tpl_vars['vars']->value['version'];?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
        getVentas();
    <?php echo '</script'; ?>
>
</body>
</html><?php }
}
