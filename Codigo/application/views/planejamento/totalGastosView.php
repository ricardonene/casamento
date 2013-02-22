<fieldset>
    <legend>Total dos Gastos</legend>
    <table border="0" width="100%">
        <tr>
            <td> Previsto </td>
            <td> R$ <?php echo real_format($ValorPrevisto); ?> </td>
        </tr>
        <tr>
            <td> Contratado </td>
            <td> R$ <?php echo real_format($ValorContratado); ?> </td>
        </tr>
        <tr>
            <td> Pago </td>
            <td> R$ <?php echo real_format($ValorPago); ?> </td>
        </tr>
        <tr>
            <td> Saldo Devedor </td>
            <td> R$ <?php echo real_format($SaldoDevedor); ?> </td>
        </tr>
        <tr>
            <td> Percentual Pago </td>
            <td> <?php echo number_format($PercentualPago, 2, ',', ''); ?>% </td>
        </tr>
    </table>
</fieldset>
