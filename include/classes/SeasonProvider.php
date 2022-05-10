<?php

class SeasonProvider{

    private $conn,$username;

    public function __construct($conn,$username)
    {
        $this->conn = $conn;
        $this->un = $username;
    }

    public function createSP($entity) // creating season preview 
    {
        $seasons = $entity->getSeason();

        if(sizeof($seasons) == 0)
        {
            return;
        }

        $seasonHtml = "";
        foreach($seasons as $season)
        {
            $seasonNumber =  $season->getSeasonNumber();

            $videoHtml = "";
            foreach($season->getVideos() as $video)
            {
                $videoHtml .= $this->createVideoSquare($video);
            }
            $seasonHtml .= "<div class='season'>
                                <h3>Season $seasonNumber</h3>
                                <div class='videos'>
                                    $videoHtml
                                </div>
                            </div>";
        }
        return $seasonHtml;
    }

    private function createVideoSquare($video)
    {
        $id = $video->getId();
        $name = $video->getTitle();
        $thumbnail = $video->getThumbnail();
        $description = $video->getDescription();
        $episodNumber = $video->getEpisodNumber();
         // TODO: fix the seen check mark problem ;
        $hasSeen = $video->hasSeen($this->username) ? "<i class='fas fa-check-circle seen'></i>" : "";

        return "<a href='watch.php?id=$id'>
                    <div class='episodContainer'>
                    <div class='content'>
                            <img src='$thumbnail' alt='thumbnail '>
                            <div class='videoInfo'>
                                <h4>$episodNumber. $name</h4>
                                <span>$description</span>
                            </div>
                        </div>
                    </div>
                    $hasSeen;
                </a>";
    }
}

?>