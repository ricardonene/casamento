<fieldset>
    <legend>Total dos Gastos</legend>
    <table border="0" width="100%">
        <tr>
            <td> Previsto </td>
            <td> R$ <?php echo real_format($ValorPrevisto); ?> </td>
            <td> Contratado </td>
            <td> R$ <?php echo real_format($ValorContratado); ?> </td>
            <td> Pago </td>
            <td> R$ <?php echo real_format($ValorPago); ?> </td>
            <td> Saldo Devedor </td>
            <td> R$ <?php echo real_format($SaldoDevedor); ?> </td>
            <td> Percentual Total Pago </td>
            <td> <?php echo number_format($PercentualPago, 2, ',', ''); ?>% </td>
        </tr>
    </table>
</fieldset>
