<?php
class Videoprovide
{
    public static function getUpNext($conn, $currentVideo)
    {
        $query = $conn->prepare("SELECT * FROM videos 
                                WHERE entityId=:entityId AND id !=:videoId AND ( 
                                            (season=:season 
                                            AND episode > :episode) 
                                        OR season > :season ) 
                                ORDER BY season,episode ASC LIMIT 1");
        $query->bindValue(":videoId", $currentVideo->getId());
        $query->bindValue(":entityId", $currentVideo->getEntityId());
        $query->bindValue(":season", $currentVideo->getSeasonNumber());
        $query->bindValue(":episode", $currentVideo->getEpisodNumber());

        $query->execute();

        #TODO : implement that see if user already show next video tell me to saw other one OR new one 

        # if use finish the series and movie then below code for get new movie or series from the start

        if ($query->rowCount() == 0) {
            $query = $conn->prepare("SELECT * FROM videos
                                   WHERE season <= 1 AND episode <= 1
                                   AND id != :videoId
                                   ORDER BY views DESC LIMIT 1");
            $query->bindValue(":videoId", $currentVideo->getId());
            $query->execute();
        }

        $row = $query->fetch(PDO::FETCH_ASSOC);

        return new Video($conn, $row);
    }

    public static function getEntityVideoForUser($conn, $entityId, $username)
    {
        $query = $conn->prepare("SELECT videoId FROM videoProgress 
                                INNER JOIN videos ON videoprogress.videoId = videos.Id 
                                WHERE videos.entityId = :entityId 
                                AND username = :username 
                                ORDER BY videoProgress.dateModified DESC 
                                LIMIT 1");
        $query->bindValue(":entityId", $entityId);
        $query->bindValue(":username", $username);
        $query->execute();

        if ($query->rowCount() == 0) {
            $query = $conn->prepare("SELECT id FROM videos WHERE entityId = :entityId ORDER BY season,episode ASC LIMIT 1");
            $query->bindValue(":entityId", $entityId);
            $query->execute();
        }

        return $query->fetchColumn();
    }
}
?>