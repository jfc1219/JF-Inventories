<?php

    $modulo_buscardor=limpiar_cadena($_POST['modulo_buscador']);
    $modulos=["usuario","categoria","producto"];
    if(in_array($modulo_buscardor,$modulos)){
        $modulos_url=[
            "usuario"=>"user_search",
            "categoria"=>"category_search",
            "producto"=>"product_search"
        ];

        $modulos_url=$modulos_url[$modulo_buscardor];
        $modulo_buscardor="busqueda_".$modulo_buscardor;

        //iniciamos la busqueda
        if(isset($_POST['txt_buscador'])){
            $txt=limpiar_cadena($_POST['txt_buscador']);
            if($txt==""){
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        Introduzca un termino de busqueda
                    </div>
                ';
            }else{
                if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}",$txt)){
                    echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Ocurrio un error inesperado!</strong><br>
                            El termino de busqueda no coincide con el formato solicitado
                        </div>
                    ';
                }else{
                    $_SESSION[$modulo_buscardor]=$txt;
                    header("Location: index.php?vista=$modulos_url",true,303);
                    exit();
                }
            }
        }

        //Eliminamos la busqueda
        if(isset($_POST['eliminar_buscador'])){
            unset($_SESSION[$modulo_buscardor]);
            header("Location: index.php?vista=$modulos_url",true,303);
            exit();

        }
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                 No podemos procesar la petición
            </div>
        ';
    }