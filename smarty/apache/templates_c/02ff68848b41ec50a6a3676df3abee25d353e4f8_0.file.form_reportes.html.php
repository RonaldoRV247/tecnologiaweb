<?php
/* Smarty version 4.5.3, created on 2024-07-16 22:28:04
  from 'D:\xampp\htdocs\tecnologiaweb\html\form_reportes.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66973a440e0a58_22629324',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02ff68848b41ec50a6a3676df3abee25d353e4f8' => 
    array (
      0 => 'D:\\xampp\\htdocs\\tecnologiaweb\\html\\form_reportes.html',
      1 => 1721186881,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head.html' => 1,
    'file:menu_top.html' => 1,
  ),
),false)) {
function content_66973a440e0a58_22629324 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\tecnologiaweb\\smarty\\libs\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<!DOCTYPE html>
<html>
<head>
    <?php $_smarty_tpl->_subTemplateRender("file:head.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'head'), 0, false);
?>
    <title>Reportes</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluir Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php $_smarty_tpl->_subTemplateRender("file:menu_top.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'menu_top'), 0, false);
?>
    <div class="container mx-auto p-4">
        <form id="frmRptClientes" name="frmRptClientes" method="post" action="<?php echo $_smarty_tpl->tpl_vars['report_url']->value;?>
" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" target="_blank">
            <fieldset>
                <legend class="text-blue-500 text-xl font-bold mb-4">Generar Reporte de Clientes</legend>
                
                <div class="text-center">
                    <input type="submit" id="bngenerarClientes" name="mod" value="Generar Reporte" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" formtarget="_blank"/>
                </div>
            </fieldset>
        </form>
        
        <form id="frmRptProductos" name="frmRptProductos" method="post" action="<?php echo $_smarty_tpl->tpl_vars['report_productos']->value;?>
" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" target="_blank">
            <fieldset>
                <legend class="text-blue-500 text-xl font-bold mb-4">Generar Reporte de Productos Vendidos por Año</legend>
                
                <div class="mb-4">
                    <label for="producto" class="block text-gray-700 text-sm font-bold mb-2">Producto</label>
                    <select name="producto" id="producto" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['productos']->value),$_smarty_tpl);?>

                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="anio" class="block text-gray-700 text-sm font-bold mb-2">Año</label>
                    <select name="anio" id="anio" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['anios']->value),$_smarty_tpl);?>

                    </select>
                </div>
                
                <div class="text-center">
                    <input type="submit" id="bngenerarProductos" name="mod" value="Generar Reporte" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" formtarget="_blank"/>
                </div>
            </fieldset>
        </form>
        
        <form id="frmRptCompras" name="frmRptCompras" method="post" action="<?php echo $_smarty_tpl->tpl_vars['report_compras']->value;?>
" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" target="_blank">
            <fieldset>
                <legend class="text-blue-500 text-xl font-bold mb-4">Generar Reporte de Compras a Proveedores</legend>
                
                <div class="mb-4">
                    <label for="proveedor" class="block text-gray-700 text-sm font-bold mb-2">Proveedor</label>
                    <select name="proveedor" id="proveedor" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['proveedores']->value),$_smarty_tpl);?>

                    </select>
                </div>
                
                <div class="text-center">
                    <input type="submit" id="bngenerarCompras" name="mod" value="Generar Reporte" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" formtarget="_blank"/>
                </div>
            </fieldset>
        </form>
    </div>
    <?php echo '<script'; ?>
 type="text/javascript" src="js/reportes.js<?php echo $_smarty_tpl->tpl_vars['vars']->value['version'];?>
"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
