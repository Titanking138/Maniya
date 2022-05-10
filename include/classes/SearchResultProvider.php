<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of SearchResultProvider
 *
 * @author admin
 */
class SearchResultProvider {

    //put your code here
    private $conn, $username;

    public function __construct($conn, $username) {
        $this->conn = $conn;
        $this->username = $username;
    }

    public function getResult($inputText) {
        $entities = EntityProvider::getSearchEntity($conn, $inputText);
        
        $html = "<div class='previewCategories noScroll'>";
        $html .= $this->getResultHtml($entities);
        
        return $html."</div>";
    }

    private function getResultHtml($entities) {
        if (sizeof($entities) == 0) { // remove all the null element category 
            return;
        }

        $entitiesHtml = "";
        $previewProvider = new PreviewProvider($this->conn, $this->un);
        foreach ($entities as $entity) {
            $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity);
        }

        return "<div class = 'category'>
                    <div class='entities'>
                    $entitiesHtml
                    </div>
                </div>";
    }

}
