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
            $("#msg").html("Enviado Formulário...");
            //$(formulario+" > .flash").show();
            //$(formulario+" > .flash").fadeIn(400).html('<img src="../imagens/loader.gif" align="absmiddle"> <span class="loading">Incluindo...</span>');
        
            $.post("planejamento/salvar", $(formulario).serialize(), function (html) 
            {
                //                    $(lista).append(html);
                //                    $(lista+":first").slideDown(300);
                //                    $(formulario+" > .flash").hide();
                //                    $(divFormulario).slideToggle('slow');
                $("#msg").html(html);
                btnCancelarItem();
                carregarItensCasamento();
                carregarTotaisGastos();                
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
        $('#divAddItem').insertAfter('body');
        $('#divAddItem .dinheiro').each(function(index) {
            $(this).val("0,00");
        });
        $('#divAddItem .data').each(function(index) {
            $(this).val("");
        });
        
        $('#rbtnVista').click();
        $("#formAddItem").validate().resetForm();
    }
    
    function carregarItemFornecedorByCategoria(categoria) {
        $('#items').load('planejamento/listarItems/'+categoria);
        $('#fornecedores').load('planejamento/listarFornecedores/'+categoria);
    }
    
    function carregarItensCasamento() {
        $('#divItensCasamento').load('planejamento/listarItensCasamento');
    }
    
    function carregarTotaisGastos() {
        $('#divTotalGastos').load('planejamento/totalGastos');
    }
    
    function carregarUF() {
        $('#uf').load('cidade/listarUF');
    }
    
    function carregarCidades() {
        $('#uf').change(function(){
            $('#cidade').load('cidade/listarCidades/'+$('#uf').val());
        });
    }
    
    function carregarCheckBoxCategorias(idCategoria) {
        $('#divListaCategorias').load('planejamento/checkBoxCategorias/'+idCategoria);
    }
    
    function novoFornecedor() {
        carregarCheckBoxCategorias($('#categorias').val());
        $( '#divAddFornecedor' ).dialog( 'open' );
    }
    
    $(document).ready(function(){
        criarMascaras();
        carregarItensCasamento();
        carregarTotaisGastos();
        carregarUF();
        carregarCidades();
        
        $( '#divAddFornecedor' ).dialog({
            autoOpen: false,
            resizable: true,
            width: 700,
            height: 500,
            modal: true,
            title: 'Novo Fornecedor',
            buttons: {
                'Salvar': function() {
                    if ($('#formAddFornecedor').validate().form()) {
                        $.post("planejamento/salvarFornecedor", $(formAddFornecedor).serialize(), function (html) {
                            $("#msg").html(html);
                            $('#fornecedores').load('planejamento/listarFornecedores/'+$('#categorias').val()+'/1');
                        });
                        $('#formAddFornecedor input').each(function(index) {
                            $(this).val("");
                        });
                        $( this ).dialog( "close" );
                    }
                },
                'Cancelar': function() {
                    $('#formAddFornecedor input').each(function(index) {
                        $(this).val("");
                    });
                    $( this ).dialog( "close" );
                }
            }
        });

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
        
        /* Calcula a data execução ao alterar o item*/
        $('#items').change(function(){
            $.get('planejamento/calcularDataExecucao/'+$('#items').val(), function (data){
                $('#DataExecucao').val(data);
            });
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
        
        /* Regras de Validação do Formulário Fornecedor*/
        $("#formAddFornecedor").validate({
            rules: {
                Nome: {required: true},
                Responsavel: {required: true},
                Telefone: {required: true},
                EMail: {email: true},
                uf: {required: true},
                cidade: {required: true},
                chkCategorias : {required: true }
            },
            messages: {
                Nome: {required: ''},
                Responsavel: {required: ''},
                Telefone: {required: ''},
                EMail: {email: ''},
                uf: {required: ''},
                cidade: {required: ''},
                chkCategorias : {required: '' }
            }
        });
    });
</script>
<div id="msg" style="font-size: 18px; color: red;">
    <?php ?>
</div>
<input type="button" value="Novo Item" onclick="mostrarFormulario(0);">
<div id="divAddFornecedor" class="divFomularioListasDinamicas">
    <form id="formAddFornecedor">
        <table width="100%" border="0">
            <tr>
                <td class="label" width="25%"> Nome*: </td>
                <td colspan="3">
                    <input class="inputText" type="text" name="Nome" id="Nome" value=""> 
                </td>
            </tr>
            <tr>
                <td class="label"> Responsável*: </td>
                <td colspan="3"> 
                    <input class="inputText" type="text" name="Responsavel" id="Responsavel" value=""> 

                </td>
            </tr>
            <tr>
                <td class="label"> Telefone*: </td>
                <td> 
                    <input class="inputText telefone" type="text" name="Telefone" id="Telefone" value=""> 
                </td>
                <td class="label"> Celular: </td>
                <td> 
                    <input class="inputText telefone" type="text" name="Celular" id="Celular" value=""> 

                </td>
            </tr>
            <tr>
                <td class="label"> E-Mail: </td>
                <td> 
                    <input class="inputText" type="text" name="EMail" id="EMail" value=""> 

                </td>
                <td class="label"> Site: </td>
                <td> 
                    <input class="inputText" type="text" name="Site" id="Site" value=""> 

                </td>
            </tr>
            <tr>
                <td class="label"> Endereço: </td>
                <td colspan="3"> 
                    <input class="inputText" type="text" name="Endereco" id="Endereco" value=""> 
                </td>
            </tr>
            <tr>
                <td class="label"> Estado/Cidade*: </td>
                <td colspan="3">
                    <?php
                    $options = array('' => 'UF');
                    echo form_dropdown('uf', $options, '', 'id="uf"');
                    ?>


                    <?php
                    $options = array('' => 'Cidade');
                    echo form_dropdown('cidade', $options, '', 'id="cidade"');
                    ?>


                </td>
            </tr>
            <tr>
                <td class="label"> Categorias*: </td>
                <td colspan="4"> 
                    <div id="divListaCategorias"></div>
                </td>
            </tr>       
        </table>
    </form>
</div>

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
                        $options[$categoria->idCategoria] = $categoria->Descricao;
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
                    <input type="button" value="Novo Fornecedor" onclick="novoFornecedor()">

                </td>
            </tr>
            <tr>
                <td class="label" colspan="2"> Pagamento: </td>
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
    <div id="divTotalGastos"></div>
    <br />
    <div id="divItensCasamento"></div>
</center>

<div class="clear"></div>