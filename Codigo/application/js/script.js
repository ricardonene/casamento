/**
 *  Scripts para funcoes especificas no site.
 *  
 *  Autor: Ricardo Nenê
 */

function criarMascaras() {
    
    $('.dinheiro').maskMoney();
    $('.telefone').mask('(99) 9999-9999');
    $('.data').mask('99/99/9999');
    $('.data').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true
    });
    $('.cep').mask('99999-999');
    $('.placa').mask('aaa-9999');
    $('.placa').css("text-transform", "uppercase");
}

function addCampo(classCampo) {
    novoCampo = $("div."+classCampo+":first").clone();
    novoCampo.find("input").val("");
    novoCampo.insertAfter("div."+classCampo+":last");
    novoCampo.focus();
    criarMascaras();

}

function delCampo(e, classCampo) {
    i=0;
    $("div."+classCampo).each(function () {
        i++;
    });
    if (i>1) {
        $(e).parent().remove();
    } else {
        $(e).parent().find("input").val("");
    }
}

/*
 * @deprecated
 */
function validaImagem(inputFile) 
{
    var imagensValidas = /\.(jpeg|jpg|gif|png|bmp)/i;
    if (inputFile.value == "") 
    {
        alert("Selecione uma foto para enviar.");
        return false;
    }

    if (imagensValidas.exec(inputFile.value) == null) {
        alert("Imagem inv�lida. Envie um arquivo com extens�o JPG, JPEG, BMP, GIF ou PNG.");
        inputFile.value = "";
        return false;
    }
              
    return true;
}

/*
 * @deprecated
 */
function validaDocumentos(inputFile)
{
    var documentosValidos = /\.(pdf|doc)/i;
    if (inputFile.value == "") 
    {
        alert("Selecione um documento para enviar.");
        return false;
    }

    if (documentosValidos.exec(inputFile.value) == null) {
        alert("Documento inv�lido. Envie um arquivo com extens�o PDF ou DOC.");
        inputFile.value = "";
        return false;
    }
              
    return true;
}