<?php

namespace App;

use Slim\Slim;

class MainController
{
    private $app;
    private $mainService;
    
    public function __construct()
    {
        $this->app = Slim::getInstance();
        $this->mainService = $this->app->MainService;
    }
    
    public function showHome()
    {
        $pageContent = $this->mainService->getPageContent();
        $this->app->render('index.php', ['pageContent' => $pageContent]);
    }

    public function homePost()
    {
        $result = $this->app->request()->post();
        if(!empty($result['addTitle']) && !empty($result['addContent'])){
            $this->mainService->createPageContent($result['addTitle'], $result['addContent']);
        }
        if(!empty($result['deleteId'])){
            $this->mainService->deletePageContent($result['deleteId']);
        }
        if(!empty($result['updateId']) && !empty($result['updateTitle']) && !empty($result['updateData'])){
            $this->mainService->updatePageContent($result['updateId'], $result['updateTitle'], $result['updateData']);
        }
        
        $this->app->redirectTo("ShowHome");
    }
    
    

}