<?php
require_once 'fotocontoller.php'; // Certifique-se de que o arquivo está correto

ob_start();
?>

<div class="container">
    <form name="cadImovel" id="cadImovel" action="" method="post" enctype="multipart/form-data">
        <div class="card" style="top:40px">
            <div class="card-header">
                <span class="card-title"><h2>Foto</h2></span>
            </div>
            <div class="card-body">
                <!-- Aqui pode ter conteúdo adicional -->
            </div>
            <div class="form-group form-row">
                <label class="col-sm-2 col-form-label text-right">Foto:</label>
                <input type="file" class="form-control col-sm-8" name="foto" id="foto"/>
            </div>
            <div class="card-footer">
                <input type="hidden" name="id" id="id" value="<?php echo isset($imovel) ? $imovel->getId() : ''; ?>" />
                <input type="hidden" name="path" id="path" value="<?php echo isset($imovel) ? $imovel->getPath() : ''; ?>" />
                <input type="submit" class="btn btn-success" name="btnSalvar" id="btnSalvar" value="Salvar">
            </div>
        </div>
    </form>
</div>

<?php
if (isset($_POST['btnSalvar'])) {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        // Verifica se a classe e o método existem
        if (class_exists('fotocontoller')) {
            if (method_exists('fotocontoller', 'salvar')) {
                // Chama o método salvar diretamente
                if (isset($imovel)) {
                    fotocontoller::salvar($_FILES['foto'], $imovel->getFotoTipo());
                } 
                else {
                    fotocontoller::salvar($_FILES['foto']);
                }

                // Redireciona para a página listfoto.php
                header('Location: listfoto.php');
                exit(); // Adiciona exit após header para garantir que o script não continue executando
            } 
            else {
                echo 'Método salvar não encontrado na classe fotocontoller.';
            }
        } 
        else {
            echo 'Classe fotocontoller não encontrada.';
        }
    } 
    else {
        echo 'Erro ao enviar a foto. Verifique o arquivo e tente novamente.';
    }
}

ob_end_flush();
?>
