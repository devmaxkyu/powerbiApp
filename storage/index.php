<?php

class Storage{

    // default client information
    public static $default_resource_url = 'https://analysis.windows.net/powerbi/api';
    public static $default_api_url = 'https://api.powerbi.com';
    public static $default_authority_url = 'https://login.microsoftonline.com/';
    public static $default_redirect_url = 'http://localhost/powerbi_api/index.php';
    public static $default_client_id = '1c19b59d-e22f-4d78-95ef-9e9391b66e75';
    public static $default_secret_key = '[jV?R:Xg:p7IPSVib3tySF8zts7?O[bk';
    public static $default_tenant_id = '3ae3944a-ba2c-429d-af77-8955799d10b0';

    public static $default_access_token = null;
    public static $default_expires = null;

    // session key
    public static $client_id_sesskey = 'client_id';
    public static $secret_key_sesskey = 'secret_key';
    public static $authority_url_sesskey = 'authority_url';
    public static $api_url_sesskey = 'api_url';
    public static $redirect_url_sesskey = 'redirect_url';
    public static $resource_url_sesskey = 'resource_url';
    public static $access_token_sesskey = 'access_token';
    public static $refresh_token_sesskey = 'refresh_token';
    public static $expires_sesskey = 'expires';
    public static $tenant_id_sesskey = 'tenant_id';

    public static function getValue($key){
        if(!isset($_SESSION[$key]) || empty($_SESSION[$key]))
        {
            $_SESSION[$key] = self::${'default_'.$key};
        }

        return $_SESSION[$key];
    }

    public static function setValue($key, $val){
     
        $_SESSION[$key] = $val;
    }

}