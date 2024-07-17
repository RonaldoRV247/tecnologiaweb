<?php
/* Smarty version 4.5.3, created on 2024-07-15 16:31:37
  from 'C:\xampp\htdocs\tecnologiaweb\html\form_compras.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66959539d0e077_13946297',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd6ef213ea870551821485e4159ae64e720f61f6b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tecnologiaweb\\html\\form_compras.html',
      1 => 1721078065,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:menu_top.html' => 1,
  ),
),false)) {
function content_66959539d0e077_13946297 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\tecnologiaweb\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<!DOCTYPE html>
<html>
<head>
    <?php $_smarty_tpl->_subTemplateRender("file:head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'head'), 0, false);
?>
    <title>Compras</title>
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
        function calcularIGV() {
            var subtotal = parseFloat(document.getElementById("subtotal").value) || 0;
            var igv = subtotal * 0.18;
            document.getElementById("igv").value = igv.toFixed(2);
            document.getElementById("total").value = (subtotal + igv).toFixed(2);
        }
        
    <?php echo '</script'; ?>
>
</head>
<body>
    <?php $_smarty_tpl->_subTemplateRender("file:menu_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'menu_top'), 0, false);
?>
    <form id="frmClt" name="frmClt" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>
" onsubmit="return validarFrm()">
        <fieldset style="width:99.5%; text-align:left; padding:0px">
            <legend style="color: blue">Registro de compras</legend>
            <div align="center" style="float: left; width: 55%; text-align: center;">
                <input type="date" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['fecha']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['fecha'];
}?>" name="fecha" id="fecha" placeholder="Fecha" title="Fecha" required autofocus style="width:100%; text-transform:uppercase"/>
                <select name="idproveedor" id="idproveedor" required style="width:100%">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['proveedores']->value,'selected'=>$_smarty_tpl->tpl_vars['cr']->value['idproveedor']),$_smarty_tpl);?>

                </select>
                <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['serie']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['serie'];
}?>" name="serie" id="serie" placeholder="Serie" title="Serie" onkeypress="return Text(event)" maxlength="11" required style="width:100%"/>
            </div>
            <div align="center" style="float: left; width: 45%">
                <input type="number" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['numero']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['numero'];
} else {
echo $_smarty_tpl->tpl_vars['numero_inicial']->value;
}?>" name="numero" id="numero" placeholder="Numero" title="Numero" readonly style="width:100%; text-transform:uppercase"/>
                <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['subtotal']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['subtotal'];
}?>" name="subtotal" id="subtotal" placeholder="Subtotal" title="Subtotal" oninput="calcularIGV()" style="width:100%; text-transform:lowercase"/>
                <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['igv']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['igv'];
} else {
echo 0;
}?>" name="igv" id="igv" placeholder="Igv" title="Igv" readonly style="width:100%"/>
            </div>
            <div align="center" style="float: left; width: 45%">
                <input type="number" step=".01" value="<?php if ((isset($_smarty_tpl->tpl_vars['cr']->value['total']))) {
echo $_smarty_tpl->tpl_vars['cr']->value['total'];
}?>" name="total" id="total" placeholder="Total" title="Total" readonly style="width:100%; text-transform:uppercase"/>
            </div>
            <section style="clear: both; text-align: center">
                <input type="submit" id="bnguardar" name="mod" value="<?php if ((isset($_REQUEST['mod'])) == 'editar') {?>Modificar<?php } else { ?>Insertar<?php }?>"/> &nbsp; 
                <input type="reset" value="Cancelar" onclick="window.location.href='<?php echo $_SERVER['SCRIPT_NAME'];?>
';"/>
            </section>
        </fieldset>
    </form>
    <br/>
    <table id="data" border="1" cellspacing="0" cellpadding="0" align="center" style="min-width:90%;">
        <caption style="text-align:left">🔎<input type="search" id="bsc" placeholder="Buscar" title="Buscar" autofocus onkeyup="getCompras()"/></caption>
        <thead><tr><th>PROVEEDORES</th><th>FECHA</th><th>SERIE</th><th>NUMERO</th><th>SUBTOTAL</th><TH>IGV</TH><TH>TOTAL</TH></tr></thead>
        <tbody></tbody>
    </table>
    <?php echo '<script'; ?>
 type="text/javascript" src="js/compras.js<?php echo $_smarty_tpl->tpl_vars['vars']->value['version'];?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
        getCompras();
    <?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
