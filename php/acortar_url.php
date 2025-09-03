<?php

/*Creamos la funcion cortarUrl, los parametros con null son los parametros opcionales */
function cortarUrl($url,$alias=null, $expiracion=null){
    $host = parse_url($url, PHP_URL_HOST); // devuelve solo el host
    $scheme = parse_url($url, PHP_URL_SCHEME); // Devuelve "https" o "http"
    //hacemos el hash a la url
    $url_hash=hash('sha1', $url);
    $url_hash_corta="";
    for($i=0; $i<4; $i++){
        $url_hash_corta.=$url_hash[$i];
        /*Aqui en este ciclo for lo que hacemos es obtener los primeros 4 digitos 
        de nuestro hash y lo concatenamos a la variable url_hash_corta
         */
    }
    $url_corta="";
    //si alias es nulo entonces tomamos el hash
    if(!$alias){
        $url_corta=$scheme."://".$host."/".$url_hash_corta;
        var_dump($url_corta);
    }else{
        //si no es nulo el alias entonces tomamos el alias, y el hash corto
        $url_corta=$scheme."://".$host."/".$alias.$url_hash_corta;
        var_dump($url_corta);
    }

}
if(isset($_GET)){
    $url_larga=$_GET['url']; //aqui obtenemos la url que nos envie el usuario
    $alias=$_GET['alias']; //el alias de la url si es que lo desea el usuario
    $expiracion=$_GET['expiracion']; //la cantidad de tiempo que debe de durar la url
   // $dominio=$_SERVER['HTTP_HOST'];
   //en nuestro if validamos que sea una url valida si si procedemos a hacer todo nuestro cambio
    if(filter_var($url_larga,FILTER_VALIDATE_URL)){
        echo "La URL '$url_larga' es válida.";
        cortarUrl($url_larga,$alias,$expiracion);//enviamos a la funcion los parametros que tendra la url corta           

    }else{
        echo "La URL $url_larga no es válida";
    }

    /*Para poner en el redireccionamiento 
    <div class="alert alert-success">
    Tu URL corta es: <a href="https://miacortador.com/cursoUNAM" target="_blank">https://miacortador.com/cursoUNAM</a>
</div> */

}
