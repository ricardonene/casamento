<?php

foreach ($categorias as $categoria) {
    //var_dump($categoria);
    ?>
    <table cellspacing="0" class="tabelaItensPlanejados" id="tblCategoria<?php echo $categoria['idCategoria']; ?>">
        <tr>
            <th class="tituloItem"> <?php echo $categoria['Categoria']; ?> </th>
            <th> Previsto </th>
            <th> Contratado </th>
            <th> Pago </th>
            <th> Saldo Devedor </th>
            <th style="text-align: center;"> % </th>
        </tr>
        <tr>
            <td colspan="7" class="itemEspaco"> &nbsp; </td>
        </tr>
        <?php foreach ($categoria['itens'] as $item){ ?>
            <tr>
                <td class="descricaoItem"> <?= $item->Descricao; ?> 
                    <br> <span class="fornecedorItem"> <?= $item->NomeFornecedor; ?> </span> 
                </td>
                <td class="itemPlanejado">R$ <?= real_format($item->ValorPrevisto); ?> </td>
                <td class="itemPlanejado">R$ <?= real_format($item->ValorContratado); ?> </td>
                <td class="itemPlanejado">R$ <?= real_format($item->ValorPago); ?> </td>
                <td class="itemPlanejado">R$ <?= real_format($item->SaldoDevedor); ?> </td>
                <td class="itemPlanejado"> <?= real_format($item->Percentual); ?> % </td>
            </tr>
        <?php } ?>
        <tr>
            <td style="text-align: left;"> <input type="button" value="Novo Item" onclick="mostrarFormulario(<?php echo $categoria['idCategoria']; ?>);"> </td>
        </tr>
    </table>
<?php } ?>
