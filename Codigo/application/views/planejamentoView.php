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
                $(this).popover('destroy');
                $(this).parent('li').removeClass('active');
            });
            var el = $(this);
            $.ajax({
                url: el.attr('data-content'),
                success: function(html){
                    el.popover({ content: html, placement:'right', html:true, trigger:'manual' }).popover("toggle");
                    $('.arrow').offset({top: el.offset().top});
                }
            });
            
            //Deixa o item do menu selecionado
            $(this).parent('li').toggleClass('active');            
            criarMascaras();
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
<div id="msg" class="alert alert-block alert-success fade in" data-alert="alert" style="display: block; position: absolute; top: -100px; left: 5px; width: 95%;">
    <button type="button" class="close">×</button>
    <strong>Item inserido com sucesso!</strong>
</div>
<div id="divAddFornecedor">
    <form id="formAddFornecedor">
        <div class="controls controls-row">
            <label class="span2 text-right" for="Nome"> Razão Social*: </label>
            <input class="span6" type="text" name="Nome" id="Nome" value=""> 
        </div>
        <div class="controls controls-row">
            <label class="span2 text-right" for="Responsavel"> Responsável*: </label>
            <input class="span6" type="text" name="Responsavel" id="Responsavel" value=""> 
        </div>
        <div class="controls controls-row">
            <label class="span2 text-right" for="Telefone"> Telefone*: </label>
            <input class="telefone span2" type="text" name="Telefone" id="Telefone" value=""> 
            <label class="span2 text-right" for="Celular"> Celular: </label>
            <input class="telefone span2" type="text" name="Celular" id="Celular" value=""> 
        </div>
        <div class="controls controls-row">
            <label class="span2 text-right" for="EMail"> E-Mail: </label>
            <input class="span2" type="text" name="EMail" id="EMail" value=""> 
            <label class="span2 text-right" for="Site"> Site: </label>
            <input class="span2" type="text" name="Site" id="Site" value=""> 
        </div>
        <div class="controls controls-row">
            <label class="span2 text-right" for="Endereco"> Endereço: </label>
            <input class="span6" type="text" name="Endereco" id="Endereco" value=""> 
        </div>
        <div class="controls controls-row">
            <label class="span2 text-right" for="UF"> Estado/Cidade*: </label>
                <?php
                $options = array('' => 'UF');
                echo form_dropdown('uf', $options, '', 'id="uf" class="span2"');
                $options = array('' => 'Cidade');
                echo form_dropdown('cidade', $options, '', 'id="cidade" class=span4');
                ?> 
        </div>
        <div class="controls controls-row">
            <label class="span2 text-right"> Categorias: </label>
            <div id="divListaCategorias" class="span6"></div>

        </div>
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