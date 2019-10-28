<?php

namespace App;

class MainService
{
    private $dao;

    public function __construct(MainDao $dao)
    {
        $this->dao = $dao;
    }
    
    public function getPageContent()
    {
        return $this->dao->getPageContent();
    }

    public function createPageContent($title, $content)
    {
        $this->dao->createPageContent($title, $content);
    }

    public function deletePageContent($id)
    {
        $this->dao->deletePageContent($id);
    }

    public function updatePageContent($id, $title, $content)
    {
        $this->dao->updatePageContent($id, $title, $content);
    }
}