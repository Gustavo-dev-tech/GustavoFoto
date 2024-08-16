<?php
require_once 'foto.php';

class Fotocontroller{

    public static function salvar($fotoAtual = '', $fotoTipo=''){

        $imovel = new Imovel();

        $imagem = array();
        if(is_uploaded_file($_FILES['foto']['tmp_name'])){
            $imagem['data'] = file_get_contents($_FILES['foto']['tmp_name']);
            $imagem['tipo'] = $_FILES['foto']['type'];
            $imagem['path'] = 'imagens/'.$_FILES['foto']['name'];
            $imagem ['path'] = $path;

            move_uploaded_file($_FILES['foto']['tmp_name'],$imagem['path'],$path);

        }

        if(!empty($imagem)){
            $imovel->setFoto($imagem['data']);
            $imovel->setFotoTipo($imagem['tipo']);
            $imovel->setPath($imagem['path']);
        

            if(!empty($_POST['path'])){
                unlink($_POST['path']);
            }
        }else{
            $imovel->setFoto($fotoAtual);
            $imovel->setFotoTipo($fotoTipo);
            $imovel->setPath($imagem['path']);
        }

        $imovel->save();
    }
}

?>