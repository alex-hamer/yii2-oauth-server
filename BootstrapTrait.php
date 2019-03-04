<?php

namespace eartotheground\yii2\oauth2server;

trait BootstrapTrait
{
    /**
     * @var array Model's map
     */
    private $_modelMap = [
        'OauthClients'               => 'eartotheground\yii2\oauth2server\models\OauthClients',
        'OauthAccessTokens'          => 'eartotheground\yii2\oauth2server\models\OauthAccessTokens',
        'OauthAuthorizationCodes'    => 'eartotheground\yii2\oauth2server\models\OauthAuthorizationCodes',
        'OauthRefreshTokens'         => 'eartotheground\yii2\oauth2server\models\OauthRefreshTokens',
        'OauthScopes'                => 'eartotheground\yii2\oauth2server\models\OauthScopes',
    ];
    
    /**
     * @var array Storage's map
     */
    private $_storageMap = [
        'access_token'          => 'eartotheground\yii2\oauth2server\storage\Pdo',
        'authorization_code'    => 'eartotheground\yii2\oauth2server\storage\Pdo',
        'client_credentials'    => 'eartotheground\yii2\oauth2server\storage\Pdo',
        'client'                => 'eartotheground\yii2\oauth2server\storage\Pdo',
        'refresh_token'         => 'eartotheground\yii2\oauth2server\storage\Pdo',
        'user_credentials'      => 'eartotheground\yii2\oauth2server\storage\Pdo',
        'public_key'            => 'eartotheground\yii2\oauth2server\storage\Pdo',
        'jwt_bearer'            => 'eartotheground\yii2\oauth2server\storage\Pdo',
        'scope'                 => 'eartotheground\yii2\oauth2server\storage\Pdo',
    ];
    
    protected function initModule(Module $module)
    {
        $this->_modelMap = array_merge($this->_modelMap, $module->modelMap);
        foreach ($this->_modelMap as $name => $definition) {
            \Yii::$container->set("eartotheground\\yii2\\oauth2server\\models\\" . $name, $definition);
            $module->modelMap[$name] = is_array($definition) ? $definition['class'] : $definition;
        }

        $this->_storageMap = array_merge($this->_storageMap, $module->storageMap);
        foreach ($this->_storageMap as $name => $definition) {
            \Yii::$container->set($name, $definition);
            $module->storageMap[$name] = is_array($definition) ? $definition['class'] : $definition;
        }
    }
}