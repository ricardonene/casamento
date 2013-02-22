<?php
foreach ($categorias as $categoria) {
    ?>
    <table cellspacing="0" class="table table-hover" id="tblCategoria<?php echo $categoria['idCategoria']; ?>">
        <thead>
            <tr>
                <th class="tituloItem"> <?php echo $categoria['Categoria']; ?> </th>
                <th> Previsto </th>
                <th> Contratado </th>
                <th> Pago </th>
                <th> Saldo Devedor </th>
                <th style="text-align: center;"> % </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categoria['itens'] as $item) { ?>
                <tr>
                    <td class="descricaoItem"> <?= $item->Descricao; ?> 
                        <br> <span class="fornecedorItem"> <?= $item->NomeFornecedor; ?> </span> 
                    </td>
                    <td class="itemPlanejado">R$ <?= real_format($item->ValorPrevisto); ?> </td>
                    <td class="itemPlanejado">R$ <?= real_format($item->ValorContratado); ?> </td>
                    <td class="itemPlanejado">R$ <?= real_format($item->ValorPago); ?> </td>
                    <td class="itemPlanejado">R$ <?= real_format($item->SaldoDevedor); ?> </td>
                    <td class="itemPlanejado"> <?= real_format($item->Percentual); ?> 100% </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="6"> <input type="button" class="btn btn-small btn-primary" value="Novo Item" onclick="mostrarFormulario(<?php echo $categoria['idCategoria']; ?>);"> </td>
            </tr>
        </tbody>
    </table>
<?php } ?>
