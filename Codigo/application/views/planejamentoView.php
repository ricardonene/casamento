<h2>Planejamento</h2>
<div id="msg"></div>
<script type='text/javascript' language='javascript'>
    function hoje() {
        var today = new Date(); 
        var dd = today.getDate(); 
        var mm = today.getMonth()+1;//Janeiro é 0! 
        var yyyy = today.getFullYear(); 
        if(dd<10){dd='0'+dd} 
        if(mm<10){mm='0'+mm} 
        return dd+'/'+mm+'/'+yyyy;
        
    }
    function listarParcelas() {
        if ($("#divPrestacoes").css("display") == "none"){        
            $("#divPrestacoes").show();
            $("#nroPrestacoes").val(1);
            $("#divParcelas").html('');
            $("#parcelaEntrada").val('0,00');
            $("#dataEntrada").val(hoje());
            $("#parcela1").val($("#ValorContratado").val());
        }
    }
    function calcularParcelas(nParcelas) {
        var valor = $("#ValorContratado").val();
        valor = valor.replace('.','').replace(',','.');
        var entrada = $("#parcelaEntrada").val();
        entrada = entrada.replace('.','').replace(',','.');
        entrada = entrada==''? 0: entrada;
        var valorParcela = accounting.formatMoney((valor-entrada)/nParcelas);
        $("#parcela1").val(valorParcela);
        $("#divParcelas").html("");
        for(var i=2; i<=nParcelas; i++) {
            var clone = $("#divParcela1").clone();
            clone.attr("id", "divParcela"+i);
            clone.children(".dinheiro").attr("id", "parcela"+i);
            clone.children(".dinheiro").val(valorParcela);
                    
            clone.children(".data").val();
            clone.children(".data").attr("id", "dataParcela"+i);
            //clone.children(".data").datepicker();
                    
            clone.children("label").html(i+ "ª Parcela:");
            clone.children("label").attr("for", "parcela"+i);
            clone.appendTo("#divParcelas"); 
            criarMascaras();
        }
    }
    function addItemListaDinamica(controller, formulario, lista, divFormulario) {
        
        if ($('#formAddItem').validate().form()) {
            //$(formulario+" > .flash").show();
            //$(formulario+" > .flash").fadeIn(400).html('<img src="../imagens/loader.gif" align="absmiddle"> <span class="loading">Incluindo...</span>');
        
            $.post("planejamento/salvar", $(formulario).serialize(), function (html) 
            {
                //                    $(lista).append(html);
                //                    $(lista+":first").slideDown(300);
                //                    $(formulario+" > .flash").hide();
                //                    $(divFormulario).slideToggle('slow');
                $("#msg").html(html);
                $(formulario +" :input[type=text]").each(function(index) {
                    //$(this).val("");
                });
            });
        }
        return false;

    }
    
    function mostrarFormulario(categoria) {
        $('#divAddItem').slideDown("slow");
        $('#divAddItem').insertAfter('#tblCategoria'+categoria);
        $('#categorias').val(categoria);
        $('#addItem').focus();
        carregarItemFornecedorByCategoria(categoria);
    }
    
    function btnCancelarItem(){
        $('#divAddItem').hide('slow');
        $("#divAddItem :input[type=text]").each(function(index) {
            $(this).val("");
        });
        //$(formulario).validate().resetForm();
    }
    
    function carregarItemFornecedorByCategoria(categoria) {
        $('#items').load('planejamento/listarItems/'+categoria);
        $('#fornecedores').load('planejamento/listarFornecedores/'+categoria);
    }
    
    
    
    $(document).ready(function(){
        criarMascaras();

        /** Calcula as parcelas quando o usuário altera o valor:
         *  Entrada, ValorContratado
         */
        $("#parcelaEntrada, #ValorContratado").keyup(function (){
            calcularParcelas($("#nroPrestacoes").val());
        });
        
        /* Cria o Spinner do número de parcelas */
        $( "#nroPrestacoes" ).spinner(
        { min: 1 },
        {
            spin: function( event, ui ) {
                calcularParcelas(ui.value);
            }
        }
    );
        
        /* Carrega os itens e fornecedores ao alterar a categoria*/
        $('#categorias').change(function(){
            carregarItemFornecedorByCategoria($('#categorias').val());
        });
        
        /* Regras de Validação do Formulário*/
        $("#formAddItem").validate({
            rules: {
                DataExecucao: {required: true},
                ValorPrevisto: {required:true}
            },
            messages: {
                DataExecucao: { required: "" },
                ValorPrevisto: { required: "" }
            }
        });
    });
</script>
<div id="msg"></div>
<div id="divAddItem" class="divFomularioListasDinamicas">
    <form id="formAddItem">
        <table width="100%" border="0">
            <tr>
                <td colspan="6"  class="labelCabecalho">
                    Adicionar Item
                </td>
            </tr>
            <tr>
                <td class="label"> Categoria*: </td>
                <td>
                    <?php
                    $options = array('' => 'Selecione a Categoria');
                    foreach ($categorias as $categoria)
                        $options[$categoria['idCategoria']] = $categoria['Descricao'];
                    echo form_dropdown('categorias', $options, '', 'id="categorias"');
                    ?>
                </td>
                <td class="label"> Item*: </td>
                <td> 
                    <?php
                    $options = array('' => 'Selecione a Categoria');
                    echo form_dropdown('items', $options, '', 'id="items"');
                    ?>
                </td>
                <td class="label"> Data Execução*: </td>
                <td> 
                    <input class="inputText data" type="text" name="DataExecucao" id="DataExecucao" value=""> 
                </td>
            </tr>
            <tr>
                <td class="label"> Previsto*: </td>
                <td> 
                    <input class="inputText dinheiro" type="text" name="ValorPrevisto" id="ValorPrevisto" value="0,00"> 

                </td>
                <td class="label"> Contratado: </td>
                <td> 
                    <input class="inputText dinheiro" type="text" name="ValorContratado" id="ValorContratado" value="0,00"> 

                </td>
                <td class="label"> Pago: </td>
                <td> 
                    <input class="inputText dinheiro" type="text" name="ValorPago" id="ValorPago" value="0,00"> 

                </td>
            </tr>
            <tr>
                <td class="label"> Fornecedor: </td>
                <td colspan="5"> 
                    <?php
                    $options = array('' => 'Selecione a Categoria');
                    echo form_dropdown('fornecedores', $options, '', 'id="fornecedores"');
                    ?>
                    <input type="button" value="Novo Fornecedor">

                </td>
            </tr>
            <tr>
                <td class="label" colspan="2"> Forma de Pagamento: </td>
                <td colspan="4"> 
                    <input type="radio" name="FormaPagamento" id="rbtnVista" value="V" checked="checked" onclick="$('#divPrestacoes').hide();"> <label for="rbtnVista">À Vista</label>
                    <input type="radio" name="FormaPagamento" id="rbtnPrazo" value="P" onclick="listarParcelas();"> <label for="rbtnPrazo">A Prazo</label>
                    <div id="divPrestacoes" style="display: none;">
                        <label for="parcelaEntrada">Entrada:</label>
                        <input id="parcelaEntrada" name="parcelaEntrada" value="0,00" class="dinheiro" />
                        Data: <input type="text" id="dataEntrada" name="dataEntrada" class="data" />
                        <p>
                            <label for="nroPrestacoes">Nº de Prestações:</label>
                            <input id="nroPrestacoes" name="nroPrestacoes" value="1" size="5" />
                        </p>

                        <div id="divParcela1">
                            <label for="parcela1">1ª Parcela:</label>
                            <input id="parcela1" name="parcelas[]" value="0,00" class="dinheiro" />
                            Data: <input type="text" id="dataParcela1" name="dataParcelas[]" class="data" />
                        </div>
                        <div id="divParcelas"></div>
                    </div>

                </td>
            </tr>       
            <tr>
                <td colspan="6" class="labelRodape">
                    <input type="button" id="addItem" value="Adicionar" class="botaoPrincipal" onclick="addItemListaDinamica('veiculoController.php', '#formAddItem', '#listaVeiculos', '#divFormVeiculo')">
                    <input type="button" id="cancelarItem" value="Cancelar" class="botaoSecundario" onclick="btnCancelarItem()">
                </td>
            </tr>
        </table>
    </form>
</div>

<center>
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
    <br />

    <?php
    // var_dump($categorias);
    foreach ($categorias as $categoria) {
        ?>
        <table cellspacing="0" class="tabelaItensPlanejados" id="tblCategoria<?php echo $categoria['idCategoria']; ?>">
            <tr>
                <th class="tituloItem"> <?php echo $categoria['Descricao']; ?> </th>
                <th> Previsto </th>
                <th> Contratado </th>
                <th> Pago </th>
                <th> Saldo Devedor </th>
                <th style="text-align: center;"> % </th>
            </tr>
            <tr>
                <td colspan="7" class="itemEspaco"> &nbsp; </td>
            </tr>
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <tr>
                    <td class="descricaoItem"> Lembrança Padrinhos e Pais 
                        <br> <span class="fornecedorItem">Nossa Senhora Catarina de Alexandria</span> 
                    </td>
                    <td class="itemPlanejado">R$ <?= rand(0, 10000) ?>,00 </td>
                    <td class="itemPlanejado"> <?= rand(0, 100000) ?>,00 </td>
                    <td class="itemPlanejado"> <?= rand(0, 100000) ?>,00 </td>
                    <td class="itemPlanejado"> <?= rand(0, 100000) ?>,00 </td>
                    <td class="itemPlanejado"> <?= rand(0, 100) ?>% </td>
                </tr>
            <?php } ?>
            <tr>
                <td style="text-align: left;"> <input type="button" value="Novo Item" onclick="mostrarFormulario(<?php echo $categoria['idCategoria']; ?>);"> </td>
            </tr>
        </table>
    <?php } ?>
</center>

<div class="clear"></div>