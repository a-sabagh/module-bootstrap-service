<?php 

namespace WOAP\Controllers\Web;

class Bootstrap {
    
    public $boostraps;
    public $modules;

    public function __construct(){
        $this->bootstraps = [
            [            
                'class' => \VOS\Init::class,
                'path' => trailingslashit(WOAP_PDP) . 'modules/application-report/bootstrap.php',
                'version' => 1.0,
                'web_slug' => 'vos',
                'api_slug' => 'VOSApi'
            ],
        ];
        $this->bootstrap_modules();
    }

    public function bootstrap_modules(){
        $boostraps = $this->bootstraps ?: [];
        if(empty($boostraps)){
            return;
        }
        foreach($boostraps as $module){
            extract($module);
            require_once $path;
            $this->modules[$class] = new $class($version,$web_slug,$api_slug);
        }
        return $this->modules;
    }

}

new Bootstrap;
