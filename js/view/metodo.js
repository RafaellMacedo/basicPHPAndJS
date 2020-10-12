function setTableColumn(count, campo, value, valueFormat = ""){
    let id = campo + '_' + count;

    if(valueFormat == ""){
        valueFormat = value;
    }

    return '<td id="' + id + '" data-' + campo + '="' + value + '">' + valueFormat + '</td>';
}

function setTableButton(count, value, referencia, css){
    return '<button type="button" class="btn btn-' + css + ' bt' + referencia + '" id="bt' + referencia + '_' + count + '">' + value + '</button>';
}

function getTableDado(nomeColumn, count, value){
    let valueField = $("tr[id=" + nomeColumn + "_" + count + "]").find('td[data-' + value + ']').data(value);
    $("#" + value).val(valueField);
}

function getTableDadoSelect(nomeColumn, count, value){
    let valueField = $("tr[id=" + nomeColumn + "_" + count + "]").find('td[data-' + value + ']').data(value);

    $("#" + value).html("<option value='" + valueField + "'>" + valueField + "</option>");
}

function mensagem(tipo, mensagem){
    $("div.mensagem").removeClass("alert-danger alert-success").html("").hide();
    $("div.mensagem").addClass(tipo).html("<h4>" + mensagem + "</h4>").show();
}

function campoVazio(campo, value){
    if(value.length == 0){
        $("#" + campo).addClass("campo_vazio");
        return true;

    } else {
        return false;
    }
}