<div class="col-md-6">
    <div class="card p-5">
        <h4>Resumo da Compra</h4>
        <hr>
        <p>Produtos:</p>
        <ul>
            <?php
            // Verifica se os detalhes do carrinho estão armazenados na sessão
            if (isset($_SESSION['detalhes_carrinho'])) {
                $detalhes_carrinho = $_SESSION['detalhes_carrinho'];

                // Acessa os dados gerais do carrinho
                $total_carrinho = $detalhes_carrinho['total_carrinho'];
                $itens_carrinho = $detalhes_carrinho['itens_carrinho'];

                // Exibe os detalhes de cada item do carrinho
                foreach ($itens_carrinho as $item) {
                    $nome_produto = $item['nome_produto'];
                    $valor_sem_frete = $item['valor_sem_frete'];
                    $frete = $item['frete'];
                    $quantidade = $item['quantidade'];

                    echo "<li>Nome do quadro: $nome_produto</li>";
                    echo "<li>Valor sem frete: R$ $valor_sem_frete</li>";
                    echo "<li>Frete: R$ $frete</li>";
                    echo "<li>Quantidade: $quantidade</li>";
                    echo "<hr>";
                }
            }
            ?>
        </ul>
        <p>Total: R$ <?php echo $total_carrinho; ?></p>
        <div class="text-center">
            <a href="carrinho.php" class="btn btn-secondary">Modificar Pedido</a>
            <a href="pagamento.php" class="btn btn-primary">Ir para Pagamento</a>
        </div>
    </div>
</div>
