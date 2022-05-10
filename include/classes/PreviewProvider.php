<?php

class PreviewProvider{

    private $username,$conn;

    public function __construct($conn,$username)
    {
        $this->conn = $conn;
        $this->username = $username;
    }

    #TODO : creating privew of TV shows page header videos 
    public function createTVShowPreview()
    {
        $entitiesArray = EntityProvider::getTVShowEntity($this->conn,null,1);

        if(sizeof($entitiesArray) == 0)
        {
            ErrorMessage::errorShow("No TV shows found");
        }

        return $this->createPreview($entitiesArray[0]);
    }
    public function createMoviesPreview()
    {
        $entitiesArray = EntityProvider::getMoviesEntity($this->conn, null, 1);

        if (sizeof($entitiesArray) == 0) {
            ErrorMessage::errorShow("No Movies found");
        }

        return $this->createPreview($entitiesArray[0]);
    }
    public function createCategoryPreview($categoryId)
    {
        $entitiesArray = EntityProvider::getEntity($this->conn,$categoryId,1);

        if(sizeof($entitiesArray) == 0)
        {
            ErrorMessage::errorShow("No Movies found");
        }

        return $this->createPreview($entitiesArray[0]);
    }

    #TODO : creating preview of main header video
    public function createPreview($entity)
    {
        if($entity == NULL)
        {
            $entity = $this->getRandomEntity();
        }

        $id = $entity->getId();
        $name = $entity->getName();
        $preview = $entity->getPreview();
        $thumbnail = $entity->getThumbnail();

        $videoId = VideoProvide::getEntityVideoForUser($this->conn,$id,$this->username);
        $video = new Video($this->conn,$videoId);

        $seasonEpisode = $video->getNextEpisodeNum();
        $subtitle = $video->isMovie() ? "" : "<h4>$seasonEpisode</h4>";

        $isInProgress = $video->isInProgress($this->username);
        $playButtonText = $isInProgress ? "Continue Watching" : "Play";

        return "<div class='previewContainer'>

                    <img src='$thumbnail' class='previewImage' hidden>

                    <video autoplay muted class='previewVideo' onended='previewEnded()'>
                        <source src='$preview' type='video/mp4'>
                    </video>
                    <div class='previewOverlay'>
                        <div class='mainDetails'>
                            <h3>$name</h3>
                            $subtitle
                            <div class='buttons'>
                                <button onclick='watchNow($videoId)'><i class='fas fa-play'></i>$playButtonText</button>
                                <button onclick='volumeToggele(this)'><i class='fas fa-volume-mute'></i></button>
                            </div>
                        </div>

                    </div>
                </div>";

    }

    #TODO : genreating random header video preview item
    private function getRandomEntity()
    {
        $entity1 = EntityProvider::getEntity($this->conn, null, 1);
        return $entity1[0];
    }
    

    #TODO : creating preview off cms; 
    public function createEntityPreviewSquare($entity){
        $id = $entity->getId();
        $thumbnail = $entity->getThumbnail();
        $name = $entity->getName();

        return "<a href = 'entity.php?id=$id'>
                <div class='previewContainer small'>
                <img src='$thumbnail' title='$name'>
                </div>
                </a?";
    }


    
    
}
?>