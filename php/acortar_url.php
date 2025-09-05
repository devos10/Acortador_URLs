<?php
include "../clases/url.php";
/*Creamos la funcion cortarUrl, los parametros con null son los parametros opcionales */
function cortarUrl($url, $alias = null, $expiracion = null)
{
    $host = parse_url($url, PHP_URL_HOST); // devuelve solo el host
    $scheme = parse_url($url, PHP_URL_SCHEME); // Devuelve "https" o "http"
    //hacemos el hash a la url
    $url_hash = hash('sha1', $url);
    $url_hash_corta = "";
    for ($i = 0; $i < 4; $i++) {
        $url_hash_corta .= $url_hash[$i];
        /*Aqui en este ciclo for lo que hacemos es obtener los primeros 4 digitos 
        de nuestro hash y lo concatenamos a la variable url_hash_corta
         */
    }
    $url_corta = "";
    $path = parse_url($url, PHP_URL_PATH); // obtiene el path de la URL
    if (!$path || $path === "/") {
        // La URL es solo el dominio base
        $url_corta = $scheme . "://" . $url_hash_corta.$alias.$expiracion;
    } else {
        // La URL tiene un path o más
        if (!$alias) {
            $url_corta = $scheme . "://" . $host . "/" . $url_hash_corta . $expiracion;
        } else {
            $url_corta = $scheme . "://" . $host . "/" . $alias . $url_hash_corta . $expiracion;
        }
    }
    // Retornamos un array con ambos valores
    return [
        'hash' => $url_hash_corta,
        'corta' => $url_corta
    ];
}
if (isset($_GET)) {
    $url_larga = $_GET['url']; //aqui obtenemos la url que nos envie el usuario
    $alias = $_GET['alias']; //el alias de la url si es que lo desea el usuario
    $expiracion = intval($_GET['expiracion']) ?? 0; //la cantidad de tiempo que debe de durar la url la pasamos a tipo entero
    //var_dump($expiracion);
    //$dominio=$_SERVER['HTTP_HOST'];
    $host = parse_url($url_larga, PHP_URL_HOST); // devuelve solo el host
    $scheme = parse_url($url_larga, PHP_URL_SCHEME); // Devuelve "https" o "http"
   // var_dump($host);
   // var_dump($scheme);
    //en nuestro if validamos que sea una url valida si si procedemos a hacer todo nuestro cambio
    if (filter_var($url_larga, FILTER_VALIDATE_URL)) {
        //echo "La URL '$url_larga' es válida.";
        $respuesta = cortarUrl($url_larga, $alias, $expiracion); //enviamos a la funcion los parametros que tendra la url corta
        $url_hash_corta = $respuesta['hash'];
        $url_corta = $respuesta['corta'];
        $url = new Url();
        $insertar = $url->insertarUrlCorta($url_larga, $url_hash_corta, $url_corta, $expiracion);

        if ($insertar) {
            echo "<script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '<strong>¡URL generada!</strong>',
                html: '<a href=\"$url_larga\" target=\"_blank\" style=\"color:#fff; text-decoration:underline;\">$url_corta</a>',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                background: '#22c55e', // verde limpio
                color: '#ffffff', // texto blanco
                customClass: {
                    popup: 'shadow-lg rounded-lg'
                }
            });
        </script>";
            echo "<div>La url es <a href=\"$url_larga\" target=\"_blank\" style=\"color:#fff; text-decoration:underline;\">$url_corta</a> </div>";
        } else {
            echo "<div class='alert alert-danger'>
                    Ocurrió un error al generar tu URL corta.
                  </div>";
        }
    } else {
        echo "La URL $url_larga no es válida";
    }

    /*Para poner en el redireccionamiento 
    <div class="alert alert-success">
    Tu URL corta es: <a href="https://miacortador.com/cursoUNAM" target="_blank">https://miacortador.com/cursoUNAM</a>
</div> */
}
