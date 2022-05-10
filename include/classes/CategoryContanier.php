<?php
#this is body part do changes when you want to change somthing in body
class CategoryContanier
{

    private $un, $conn;

    public function __construct($conn, $un)
    {
        $this->conn = $conn;
        $this->un = $un;
    }

    public function showTVShowCategorys()
    {
        $query = $this->conn->prepare("SELECT * FROM categories");
        $query->execute();
        $html = "<div class='previewCategory'>
                    <h1>TV shows</h1>";

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, null, true, false);
        }

        return $html . "</div>";
    }
    public function showMovieCategorys()
    {
        $query = $this->conn->prepare("SELECT * FROM categories");
        $query->execute();
        $html = "<div class='previewCategory'>
                    <h1>TV shows</h1>";

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, null, false, true);
        }

        return $html . "</div>";
    }
    
    public function showAllCategorys()
    {
        $query = $this->conn->prepare("SELECT * FROM categories");
        $query->execute();
        $html = "<div class='previewCategory'>";

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, null, true, true);
        }

        return $html . "</div>";
    }

    public function showCategory($categoryId,$title = null)
    {
        $query = $this->conn->prepare("SELECT * FROM categories WHERE id = :id");
        $query->bindValue(":id",$categoryId);
        $query->execute();
        $html = "<div class='previewCategory'>";

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $html .= $this->getCategoryHtml($row, $title, true, true);
        }

        return $html . "</div>";
    }

    private function getCategoryHtml($sqlData, $title, $tvShows, $movies)
    {
        $categoryId = $sqlData["id"];
        $title = $title == null ? $sqlData["name"] : $title;

        if ($tvShows && $movies) {
            $entities = EntityProvider::getEntity($this->conn, $categoryId, 30);
        } 
        else if ($tvShows) {
            //TODO: Get tv show entities
            $entities = EntityProvider::getTVShowEntity($this->conn,$categoryId,30);
        } else {
            //TODO: Get movie entities
            $entities = EntityProvider::getMoviesEntity($this->conn,$categoryId,30);
        }

        if (sizeof($entities) == 0) { // remove all the null element category 
            return;
        }

        $entitiesHtml = "";
        $previewProvider = new PreviewProvider($this->conn,$this->un);
        foreach ($entities as $entity) {
            $entitiesHtml .= $previewProvider->createEntityPreviewSquare($entity);
        }

        return "<div class = 'category'>
                    <a href='category.php?id=$categoryId'>
                        <h3>$title</h3>
                    </a>

                    <div class='entities'>
                    $entitiesHtml
                    </div>
                </div>";

    }
}
?>
