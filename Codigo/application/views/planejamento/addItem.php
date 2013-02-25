<script type='text/javascript' language='javascript'>
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
        });
        
        /* Regras de Validação do Formulário Item*/
        $("#formAddItem").validate({
            rules: {
                categorias: {required: true},
                items: {required: true},
                DataExecucao: {required: true},
                ValorPrevisto: {required: function(element) {
                        //alert(element.value == "0,00");
                        return false;//(element.value == "0,00");
                    }}
            },
            messages: {
                DataExecucao: { required: "" },
                ValorPrevisto: { required: "" },
                categorias: {required: ""},
                items: {required: ""}
            }
        });
        
    });
</script>
<div id="divAddItem" class="divFomularioListasDinamicas">
    <form id="formAddItem" class="form-horizontal">
        <input type="hidden" name="items" id="items" value="<?= $idItem; ?>">
        <div class="control-group">
            <label class="control-label" for="DataExecucao"> Data Execução*: </label>
            <div class="controls">
                <input class="data input-small" type="text" name="DataExecucao" id="DataExecucao" value="<?= $DataExecucao; ?>"> 
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="ValorPrevisto"> Previsto*: </label>
            <div class="controls">
                <input class="dinheiro input-small" type="text" name="ValorPrevisto" id="ValorPrevisto" value="0,00"> 
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="ValorContratado"> Contratado: </label>
            <div class="controls">
                <input class="dinheiro input-small" type="text" name="ValorContratado" id="ValorContratado" value="0,00"> 
            </div>
        </div>
        <tr>
        <div class="control-group">
            <label class="control-label" for="ValorPago"> Pago: </label>
            <div class="controls">
                <input class="dinheiro input-small" type="text" name="ValorPago" id="ValorPago" value="0,00"> 
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="fornecedores"> Fornecedor: </label>
            <div class="controls">
                <?php
                echo form_dropdown('fornecedores', $optionsFornecedor, '', 'id="fornecedores" class="span7"');
                ?>
                <input type="button" value="Novo Fornecedor" class="btn btn-small" onclick="novoFornecedor()"> 
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"> Pagamento: </label>
            <div class="controls">
                <label class="radio inline">
                    <input type="radio" name="FormaPagamento" id="rbtnVista" value="V" checked="checked" onclick="$('#divPrestacoes').hide();"> 
                    Vista
                </label>
                <label class="radio inline">
                    <input type="radio" name="FormaPagamento" id="rbtnPrazo" value="P" onclick="listarParcelas();"> 
                    Prazo
                </label>
            </div>
        </div>

        <div id="divPrestacoes" style="display: none;">
            <div class="control-group form-inline">
                <label class="control-label" for="parcelaEntrada"> Entrada: </label>
                <div class="controls">
                    <input id="parcelaEntrada" name="parcelaEntrada" value="0,00" class="dinheiro input-small" />

                    <label for="dataEntrada"> Data: </label>
                    <input type="text" id="dataEntrada" name="dataEntrada" class="data input-small" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="nroPrestacoes">Nº de Prestações:</label>
                <div class="controls">
                    <input class="input-small" id="nroPrestacoes" name="nroPrestacoes" value="1" size="5" />
                </div>
            </div>

            <div id="divParcela1" class="control-group form-inline">
                <label class="control-label" for="parcela1">1ª Parcela:</label>
                <div class="controls">
                    <input id="parcela1" name="parcelas[]" value="0,00" class="dinheiro input-small" />
                    
                    <label for="dataParcela1"> Data: </label>
                    <input type="text" id="dataParcela1" name="dataParcelas[]" class="data input-small" />
                </div>
            </div>
            <div id="divParcelas"></div>
        </div>

        <div class="control-group">
            <div class="controls">
                <input type="button" id="addItem" value="Adicionar" class="btn btn-primary" onclick="addItemListaDinamica('veiculoController.php', '#formAddItem', '#listaVeiculos', '#divFormVeiculo')">
                <input type="button" id="cancelarItem" value="Cancelar" class="btn" onclick="btnCancelarItem()">
            </div>
        </div>
    </form>
</div>