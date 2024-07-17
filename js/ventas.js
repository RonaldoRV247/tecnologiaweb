function getVentas(){
    var bsc = $('#bsc').val();
//    if(bsc.length<3) return false;
    $.ajax({type: "POST", dataType: 'json', url: 'ventas.php?&mod=getVentas&bsc='+bsc,
        success: function (result){
            $('#data tbody').empty();
            $.each(result, function(id, c){
                var html = '<tr><td>'+c.idventa+'</td>';
                html += '<td>'+c.razonsocial+'</td>';
                html += '<td>'+c.fecha+'</td>';
                html += '<td>'+c.serie+ ' - '+ c.numero+'</td>';
                html += '<td>'+c.subtotal+'</td>';
                html += '<td>'+c.igv+'</td>';
                html += '<td>'+c.total+'</td>';
                html += '<td align="center"><span style="cursor:pointer;" title="Editar" onclick="Editar('+c.idventa+')">✏</span>️</td>';
                html += '<td align="center"><span style="cursor:pointer;" title="Eliminar" onclick="Eliminar('+c.idventa+')">❌</span>️</td></tr>';
                $('#data tbody').append(html);
            });
        },
    });
}

function Editar(idventa) {
    window.location.href='ventas.php?mod=editar&idventa='+idventa;
}
function Eliminar(idventa) {
    if (!confirm('Estas seguro de eliminar?')) {
        return false;
    }
    $.ajax({type: "POST", url: 'ventas.php?&mod=eliminar&idventa='+idventa,
        success: function (result){
            if (result==='Se ha eliminado corectamente.') {
                alert('Eliminado!');
                window.location.href='ventas.php';
            }
            
        },
    });
}