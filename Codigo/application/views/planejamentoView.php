<script type='text/javascript' language='javascript'>
    $(document).ready(function(){
        $('#categorias').change(function(){
            $('#items').load('planejamento/listarItems/'+$('#categorias').val());
        });
    });
    
    function addItemListaDinamica(controller, formulario, lista, divFormulario) {
        //alert(formulario + "\n" + controller + "\n" + lista + "\n" + divFormulario);

        //$(formulario+" > .flash").show();
        //$(formulario+" > .flash").fadeIn(400).html('<img src="../imagens/loader.gif" align="absmiddle"> <span class="loading">Incluindo...</span>');
        $.post("planejamento/salvar",
        $(formulario).serialize(),
        function (html) {
            $("#msg").html(html);
            $(lista).append(html);
            $(lista+":first").slideDown(300);
            //$(formulario+" > .flash").hide();
            $(divFormulario).slideToggle('slow');
            $(formulario +" :input[type=text]").each(function(index) {
                $(this).val("");
            });
        });
        
        return false;

    }

    function delItemListaDinamica(controller, elemento) {
        var linha = $(elemento).parent("div").siblings("div.linhaPrincipal").html().trim();
        jConfirm("Tem certeza que deseja excluir '"+linha+"' ?", 'Excluir', 
        function(resposta) {
            if (resposta == true) {
                $.post("../_controllers/"+controller,
                {id: $(elemento).attr("id")}, 
                function (html) {
                    $(elemento).parents("div.item, div.itemUnico").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");
                });     
            }
        }
    );

    }

    //Método Genérico para ocultar a div e limpar o formulário
    function btnCancelar(divFormulario, formulario) {
        $(divFormulario).slideToggle('slow');
        $(formulario+" :input[type=text]").each(function(index) {
            $(this).val("");
        });
        $(formulario).validate().resetForm();
    }
</script>

<h2>Planejamento</h2>
<div id="msg"></div>

<div id="totalGastos">
    <fieldset>
        <legend>Total dos Gastos</legend>
        <table border="0" width="100%">
            <tr>
                <td> Previsto </td>
                <td> R$ <?php echo rand(10, 100000); ?>,00 </td>
                <td> Realizado </td>
                <td> R$ <?php echo rand(10, 100000); ?>,00 </td>
                <td> Pago </td>
                <td> R$ <?php echo rand(10, 100000); ?>,00 </td>
                <td> Saldo Devedor </td>
                <td> R$ <?php echo rand(10, 100000); ?>,00 </td>
                <td> Percentual Total Pago </td>
                <td> <?php echo rand(0, 100); ?>% </td>
            </tr>
        </table>
    </fieldset>
</div>

<br>

<table border="1" width="90%" cellspacing="0">
    <tr>
        <th class="tituloItem"> Item </th>
        <th> Previsto </th>
        <th> Realizado </th>
        <th> % </th>
        <th> Pago </th>
        <th> Saldo Devedor </th>
    </tr>
    <?php
    for ($i = 0; $i < 5; $i++) {
        echo '<tr>';
        echo '<td class="descricaoItem"> Igreja </td>';
        echo '<td> R$ '. rand(10, 100000).',00 </td>';
        echo '<td> R$ '. rand(10, 100000).',00 </td>';
        echo '<td> '.rand(0, 100).'% </td>';
        echo '<td> R$'. rand(10, 100000).',00 </td>';
        echo '<td> R$'. rand(10, 100000).',00 </td>';
        echo '</tr>';
    }
    ?>
</table>


<div class="clear"></div>