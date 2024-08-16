create database arquivoUpload;
use arquivoUpload;

create teble arquivo(
    id int primary key auto_increment,
    foto longblob,
    tipoFoto varchar (50)
);