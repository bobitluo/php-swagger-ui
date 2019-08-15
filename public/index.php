<?php
require __DIR__ . '/../vendor/autoload.php';
$config = \Noodlehaus\Config::load( __DIR__ . '/../config.yaml' );
$configProjects = $config->get('projects');

if( isset($_GET['p']) && $_GET['p'] ){
    header('Access-Control-Allow-Origin: * ');
    header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: Content-Type, api_key, Authorization');
    header('Content-type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
        exit();
    }

    $project = $_GET['p'];
    $configProject = $configProjects[$project];

    \bobitluo\Php\Swagger\Options::getInstance( $configProject['swagger'] );

    $swaggerDirectory = new \bobitluo\Php\Swagger\Directory( $configProject['dir'], function($uriPath){
        return preg_replace('/(\/controllers)$/', '', $uriPath);
    });

    echo $swaggerDirectory->build();
}else{
    $list = [];
    
    foreach( $configProjects as $k => $v ){
        $url = urlencode( $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "?p={$k}" );
        $list[] = "<li><a target='_blank' href='https://petstore.swagger.io/?url={$url}'>{$v['swagger']['title']}</a></li>";
    }

    $list = implode(PHP_EOL, $list);

echo <<<"EOD"
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP Swagger UI</title>
    </head>
    <body>
        <ul>
            {$list}
        </ul>
    </body>
</html>
EOD;
}
