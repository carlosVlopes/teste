<?php

namespace Core;


/**
 * Configurações básicas do site.
 *
 * @author Cesar <cesar@celke.com.br>
 */

abstract class Config
{

    /**
     * Possui as constantes com as configurações.
     * Configurações de endereço do projeto.
     * Página principal do projeto.
     * Credenciais de acesso ao banco de dados
     * E-mail do administrador.
     * 
     * @return void
     */
    protected function config(): void
    {
        //URL do projeto
        define('URL', 'http://192.168.30.15/estudo/carlos/MVC-template_completo/');
        define('URLADM', 'http://192.168.30.15/estudo/carlos/MVC-template_completo/adm/');

        define('CONTROLLER', 'Home');
        define('CONTROLLERERRO', 'Erro');

        $_PATH = "/estudo/carlos/MVC-template_completo/";

        $_URI = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? "https://{$_SERVER['SERVER_NAME']}{$_PATH}" : "http://{$_SERVER['SERVER_NAME']}{$_PATH}";

        define( 'HOME_URI', $_URI );

        //Credenciais do banco de dados
        define('HOST', '192.168.30.15');
        define('USER', 'carlos');
        define('PASS', 'Ac4rl0s??ss10n');
        define('DBNAME', 'carlos_teste');
        define('PORT', 3306);

        define('EMAILADM', 'ss');
    }
}
