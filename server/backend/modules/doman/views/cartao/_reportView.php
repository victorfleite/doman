

<table width="100%">
    <tbody>
        <tr>
            <td style="margin-right: 10px;" width="20%">
                <img src="valle.png" width="140px" height="75px">
            </td>
            <td style="text-align:left" width="80%" class="line-header">
                <h1><?php echo $atividade->titulo ?></h1>
            </td>
        </tr>        
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td style="width: 70%; text-align: justify; padding: 10px;">
                <?php echo $atividade->descricao ?>
            </td>
            <td class="text-right">

                <table border="1" class="table-arquivo">
                    <tbody>
                        <tr>
                            <th class="text-right">Quantidade de Cartões: </th><td class="text-right"><?php echo $atividade->getCartoes()->where(['deletado' => false])->count() ?></td>
                        </tr>
                        <tr>
                            <th class="text-right">Código Agrupador: </th><td class="text-right"><?php echo $agrupador ?></td>
                        </tr>
                    </tbody>
                </table>               

            </td>
        </tr>        
    </tbody>
</table>
<?php if (!empty($atividade->instrucao)) { ?>
    <table border="1" class="table-arquivo">
        <tbody>
            <tr>
                <th class="text-left">
                    Instrução:
                </th>
            </tr>
            <tr>
                <td style="text-align: justify"><?php echo $atividade->instrucao ?></td>
            </tr>
        </tbody>
    </table>
<?php } ?>
<div style="text-align: center; margin-right: 20px">www.cvf-brasil.com</div>

<pagebreak page-break-type="clonebycss" />

<p>&nbsp;</p>
<div style="text-align: right;">verso</div>

<table border="1" class="table-header-cartao">
    <tbody>
        <tr>
            <th class="nome-cartao">
                <?php echo $cartao->nome ?>
            </th>
        </tr>
        <tr>
            <td class="agrupador">
                agrupador: <?php echo $agrupador ?>
            </td>
        </tr>
    </tbody>
</table>
<p>&nbsp;</p>
<div style="text-align: center;"><img src="valle.png"></div>
<div style="text-align: center;">www.cvf-brasil.com</div>

<?php
$cartoes = $atividade->getCartoes()->where(["deletado" => false, "status" => 1])->all();
$i = 0;
foreach ($cartoes as $cartao) {
    ?>
    <pagebreak page-break-type="clonebycss" />

    <table class="table-imagem">
        <tbody>
            <tr>
                <td style="text-align: center"><img src="<?php echo $cartao->imagem_caminho ?>" width="100%"></td>
            </tr>
        </tbody>
    </table>

    <pagebreak page-break-type="clonebycss" />

    <p>&nbsp;</p>
    <div style="text-align: right;">verso</div>

    <table border="1" class="table-header-cartao">
        <tbody>
            <tr>
                <th class="nome-cartao">
                    <?php echo $cartao->nome ?>
                </th>
            </tr>
            <tr>
                <td class="agrupador">
                    agrupador: <?php echo $agrupador ?>
                </td>
            </tr>
        </tbody>
    </table>
    <p>&nbsp;</p>
    <div style="text-align: center;"><img src="valle.png"></div>
    <div style="text-align: center;">www.cvf-brasil.com</div>



    <?php
    $i++;
}
?>