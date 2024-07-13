function getProveedores(){
    var bsc = $('#bsc').val();
//    if(bsc.length<3) return false;
    $.ajax({type: "POST", dataType: 'json', url: 'proveedores.php?&mod=getProveedores&bsc='+bsc,
        success: function (result){
            $('#data tbody').empty();
            $.each(result, function(id, c){
                var html = '<tr><td>'+c.razonsocial+'</td>';
                html += '<td>'+c.numero+'</td>';
                html += '<td>'+c.direccion+'</td>';
                html += '<td align="center"><span style="cursor:pointer;" title="Editar" onclick="Editar('+c.idproveedor+')">🖊️</span>️</td>';
                html += '<td align="center"><span style="cursor:pointer;" title="Eliminar" onclick="Eliminar('+c.idproveedor+')">💔</span>️</td></tr>';
                $('#data tbody').append(html);
            });
        },
    });
}
function Editar(idproveedor) {
    window.location.href='proveedores.php?mod=editar&idproveedor='+idproveedor;
}
function Eliminar(idproveedor) {
    if (!confirm('Estas seguro de eliminar? O me estás loqueando?')) {
        return false;
    }
    $.ajax({type: "POST", url: 'proveedores.php?&mod=eliminar&idproveedor='+idproveedor,
        success: function (result){
            if (result==='Se ha eliminado corectamente.') {
                alert('Eliminado!');
                window.location.href='proveedores.php';
            }
            
        },
    });
}