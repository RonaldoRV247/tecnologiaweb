<?php
/* Smarty version 4.5.3, created on 2024-07-04 19:22:22
  from 'D:\xampp\htdocs\tecnologiaweb\html\form_ventas.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66873cbe7c2ac0_66053203',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '23ef79a4c4d2a2a4a6aadab4aef2498b48a5f9ba' => 
    array (
      0 => 'D:\\xampp\\htdocs\\tecnologiaweb\\html\\form_ventas.html',
      1 => 1720138775,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:menu_top.html' => 1,
  ),
),false)) {
function content_66873cbe7c2ac0_66053203 (Smarty_Internal_Template $_smarty_tpl) {
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
    <?php echo '<script'; ?>
 src="https://cdn.tailwindcss.com"><?php echo '</script'; ?>
>
    <style type="text/css">
        table { border-collapse: collapse; }
        thead { background-color: #dce6f1; }            
        th, td { padding: 0.5rem; border: 0.1px solid #000; vertical-align: middle; }
        table th { vertical-align: middle; }
        #data tr:nth-child(odd) td { background-color: #c5daeb; }
        #data tr:nth-child(even) td { background-color: #e3fbf0; }
        body {
            font-size: 20px !important;
        }
        input {
            height: 50px !important;
        }
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
<body class="bg-gray-100">
    <?php $_smarty_tpl->_subTemplateRender("file:menu_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'menu_top'), 0, false);
?>
    <div class="container mx-auto p-4">
        <form id="frmClt" name="frmClt" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>
" onsubmit="return validarFrm()" class="bg-white p-6 rounded shadow-md">
            <fieldset class="border border-blue-500 p-4 rounded">
                <legend class="text-blue-500 font-bold">Registro de ventas</legend>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label for="fecha" class="mb-2">Fecha</label>
                        <input type="date" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['fecha']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['fecha'];
}?>" name="fecha" id="fecha" placeholder="Fecha" title="Fecha" required autofocus class="p-2 border rounded"/>
                    </div>
                    <div class="flex flex-col">
                        <label for="idcliente" class="mb-2">Cliente</label>
                        <select name="idcliente" id="idcliente" required class="p-2 border rounded">
                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['clientes']->value,'selected'=>$_smarty_tpl->tpl_vars['cr']->value['idcliente']),$_smarty_tpl);?>

                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="serie" class="mb-2">Serie</label>
                        <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['serie']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['serie'];
}?>" name="serie" id="serie" placeholder="Serie" title="Serie" onkeypress="return Text(event)" maxlength="11" required class="p-2 border rounded"/>
                    </div>
                    <div class="flex flex-col">
                        <label for="numero" class="mb-2">Número</label>
                        <input type="number" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['numero']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['numero'];
} else {
echo $_smarty_tpl->tpl_vars['numero_inicial']->value;
}?>" name="numero" id="numero" placeholder="Número" title="Número" readonly class="p-2 border rounded"/>
                    </div>
                    <div class="flex flex-col">
                        <label for="subtotal" class="mb-2">Subtotal</label>
                        <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['subtotal']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['subtotal'];
}?>" name="subtotal" id="subtotal" placeholder="Subtotal" title="Subtotal" oninput="calcularIGV()" class="p-2 border rounded"/>
                    </div>
                    <div class="flex flex-col">
                        <label for="igv" class="mb-2">IGV</label>
                        <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['igv']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['igv'];
} else {
echo 0;
}?>" name="igv" id="igv" placeholder="IGV" title="IGV" readonly class="p-2 border rounded"/>
                    </div>
                    <div class="flex flex-col">
                        <label for="total" class="mb-2">Total</label>
                        <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['total']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['total'];
}?>" name="total" id="total" placeholder="Total" title="Total" readonly class="p-2 border rounded"/>
                    </div>
                </div>
                <div class="flex justify-center mt-4">
                    <button type="submit" id="bnguardar" name="mod" value="<?php if ((isset($_REQUEST['mod'])) == 'editar') {?>Modificar<?php } else { ?>Insertar<?php }?>" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
                    <button type="reset" class="bg-red-500 text-white px-4 py-2 rounded ml-4" onclick="window.location.href='<?php echo $_SERVER['SCRIPT_NAME'];?>
';">Cancelar</button>
                </div>
            </fieldset>
        </form>
        <div class="mt-6">
            <div class="flex justify-end mb-2">
                🔎<input style="width: 100% !important;" type="search" id="bsc" placeholder="Buscar" title="Buscar" autofocus onkeyup="getVentas()" class="p-2 border rounded"/>
            </div>
            <table id="data" class="min-w-full bg-white rounded shadow-md">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">CLIENTES</th>
                        <th class="p-2 border">FECHA</th>
                        <th class="p-2 border">SERIE</th>
                        <th class="p-2 border">NÚMERO</th>
                        <th class="p-2 border">SUBTOTAL</th>
                        <th class="p-2 border">IGV</th>
                        <th class="p-2 border">TOTAL</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
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
</html>
<?php }
}
