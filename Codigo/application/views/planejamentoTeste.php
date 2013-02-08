<h2>Planejamento</h2>
<div id="msg"></div>

<center>
    <?php for ($j = 0; $j < 2; $j++) { ?>
    <table cellspacing="0">
        <tr>
            <th class="tituloItem"> Fotos e Filmagem </th>
            <th> Previsto </th>
            <th> Realizado </th>
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
                <td class="itemPlanejado"> <?= rand(0, 10000) ?>,00 </td>
                <td class="itemPlanejado"> <?= rand(0, 100000) ?>,00 </td>
                <td class="itemPlanejado"> <?= rand(0, 100000) ?>,00 </td>
                <td class="itemPlanejado"> <?= rand(0, 100000) ?>,00 </td>
                <td class="itemPlanejado"> <?= rand(0, 100) ?>% </td>
            </tr>
        <?php } ?>
            <tr>
                <td style="text-align: left;"> <input type="button" value="Novo Item"> </td>
            </tr>
    </table>
    <?php } ?>
</center>

<div class="clear"></div>