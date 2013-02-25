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
            clone.children(".data").datepicker();
                    
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
        $('#divAddItem').insertAfter('#divAddItemAnchor');
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
        //$('#items').load('planejamento/listarItems/'+categoria);
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
        
        //Código do POPOVER
        $('.mnuCategoriaItem').click(function (e) {
            $('.mnuCategoriaItem').each(function (index){
                if(e != this) {
                    //alert(index);
                    //$(this).popover('hide');                    
                }
            });
            var el = $(this);
            $.ajax({
                url: el.attr('data-content'),
                success: function(html){
                    el.popover({ content: html, placement:'right', html:true, trigger:'manual' }).popover("toggle");
                }
            });
            $('.arrow').css({"top":"30%"});
            
            //Deixa o item do menu selecionado
            $(this).parent('li').toggleClass('active');            
            criarMascaras();
            //alert(el.offset);
            return false;
        });

        
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

        
        
        
        /* Calcula a data execução ao alterar o item*/
        $('#items').change(function(){
            $.get('planejamento/calcularDataExecucao/'+$('#items').val(), function (data){
                $('#DataExecucao').val(data);
            });
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
<h2>Planejamento</h2>
<div id="divAddItemAnchor"></div>
<div id="msg" style="font-size: 18px; color: red;">
    <?php ?>
</div>
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

<div class="row-fluid">
    <div id="divMenuCategorias" class="span2" style="border: solid 0px red;">
        <ul class="nav nav-list">
            <?php
            foreach ($menuCategorias as $categoria) {
                ?>
                <li class="nav-header"> <?php echo $categoria['Categoria']; ?> </li>
                <?php foreach ($categoria['itens'] as $item) { ?>
                    <li>
                        <a href="#" class="mnuCategoriaItem" data-toggle="popover" data-placement="right" data-categoria="<?= $categoria['idCategoria']; ?>" data-idItem="<?= $item->idItem; ?>" data-content="planejamento/addItem/<?= $item->idItem; ?>/<?= $categoria['idCategoria']; ?>" title="" data-original-title="Adicionar <?= $item->Descricao; ?>"> 
                            <i class="icon-camera"></i>
                            <?= $item->Descricao; ?> 
                        </a>
                    </li>
                <?php } ?>


            <?php } ?>
        </ul>
    </div>
    <div id="divItensCasamento" class="span7" style="border: solid 0px red;"></div>
    <div id="divTotalGastos" class="span2" style="border: solid 1px red;"></div>
</div>