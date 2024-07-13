<?php
/* Smarty version 4.5.3, created on 2024-07-03 20:06:40
  from 'D:\xampp\htdocs\tecnologiaweb\html\form_proveedores.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_6685f5a01fe854_02280047',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '241bc06c4a401a2cdb6185f99d9fee3c63be30da' => 
    array (
      0 => 'D:\\xampp\\htdocs\\tecnologiaweb\\html\\form_proveedores.html',
      1 => 1720055196,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:menu_top.html' => 1,
  ),
),false)) {
function content_6685f5a01fe854_02280047 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\tecnologiaweb\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<!DOCTYPE html>
<html>
    <head>
        <?php $_smarty_tpl->_subTemplateRender("file:head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'head'), 0, false);
?>
        <title>Proveedores</title>
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
    </head>
    <body>
        <?php $_smarty_tpl->_subTemplateRender("file:menu_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'menu_top'), 0, false);
?>
        <form id="frmClt" name="frmClt" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>
" onsubmit="return validarFrm()">
            <fieldset style="width:99.5%; text-align:left; padding:0px">
                <legend style="color: blue">Registro de proveedores</legend>
                <div align="center" style="float: left; width: 55%; text-align: center;">
                    <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['pr']->value['razonsocial']))) {
echo $_smarty_tpl->tpl_vars['pr']->value['razonsocial'];
}?>" name="razonsocial" id="razonsocial" placeholder="Razon social" title="Razon social" required autofocus style="width:100%; text-transform:uppercase"/>
                    <?php if ((isset($_smarty_tpl->tpl_vars['pr']->value['idtipodocumento']))) {?>
                        <?php $_smarty_tpl->_assignInScope('tipodoc', $_smarty_tpl->tpl_vars['pr']->value['idtipodocumento']);?>
                    <?php } else { ?>
                        <?php $_smarty_tpl->_assignInScope('tipodoc', 6);?>
                    <?php }?>
                    <?php echo smarty_function_html_options(array('name'=>'idtipodocumento','id'=>'idtipodocumento','options'=>$_smarty_tpl->tpl_vars['tipodocumento']->value,'selected'=>$_smarty_tpl->tpl_vars['tipodoc']->value,'title'=>"Tipo documento",'required'=>"required",'onchange'=>"onchangeIdtipodocumento(this)",'style'=>"width:100%"),$_smarty_tpl);?>

                    <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['pr']->value['numero']))) {
echo $_smarty_tpl->tpl_vars['pr']->value['numero'];
}?>" name="numero" id="numero" placeholder="Ruc" title="Numero" onkeypress="return number(event)" maxlength="11" required style="width:100%"/>
                </div>
                <div align="center" style="float: left; width: 45%">
                    <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['pr']->value['direccion']))) {
echo $_smarty_tpl->tpl_vars['pr']->value['direccion'];
}?>" name="direccion" id="direccion" placeholder="Direccion" title="Direccion" style="width:100%; text-transform:uppercase"/>
                    <input type="email" value="<?php if ((isset($_smarty_tpl->tpl_vars['pr']->value['email']))) {
echo $_smarty_tpl->tpl_vars['pr']->value['email'];
}?>" name="email" id="email" placeholder="Email" title="Email" style="width:100%; text-transform:lowercase"/>
                    <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['pr']->value['celular']))) {
echo $_smarty_tpl->tpl_vars['pr']->value['celular'];
}?>" name="celular" id="celular" placeholder="Celular" title="Celular" onkeypress="return number(event);" maxlength="9" style="width:100%"/>
                </div>
                <div align="center" style="float: left; width: 45%">
                    <input type="text" value="<?php if ((isset($_smarty_tpl->tpl_vars['pr']->value['url']))) {
echo $_smarty_tpl->tpl_vars['pr']->value['url'];
}?>" name="url" id="url" placeholder="Url" title="Url" style="width:100%; text-transform:uppercase"/>
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
            <caption style="text-align:left"><input type="search" id="bsc" placeholder="Buscar" title="Buscar" autofocus onkeyup="getProveedores()"/></caption>
            <thead><tr><th>PROVEEDOR</th><th>RUC / DNI</th><th>DIRECCION</th><th></th><th></th></tr></thead>
            <tbody></tbody>
        </table>
        <?php echo '<script'; ?>
 type="text/javascript" src="js/proveedores.js<?php echo $_smarty_tpl->tpl_vars['vars']->value['version'];?>
"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript">
            getProveedores();
        <?php echo '</script'; ?>
>
    </body>
</html><?php }
}
