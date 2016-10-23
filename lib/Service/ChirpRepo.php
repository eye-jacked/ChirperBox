<?php

class ChirpRepo{

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param $userId
     * @return array
     */
    public function getChirpsByUserId($userId)
    {
        $chirps = array();
        $stmt = $this->pdo->prepare('SELECT * FROM rst_chirps WHERE rst_users_id = :userid');
        $stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $chirpsData = $stmt->fetch(PDO::FETCH_ASSOC);

        var_dump($chirpsData);die;
        if (!$chirpsData) {
            $nullChirp = new Chirp();
            $nullChirp->setContent("You haven't posted any tweets! Maybe it's time to get started!");
            return $nullChirp;
        }

        foreach($chirpsData as $chirpRow){
            $chirps[] = $this->createChirpFromData($chirpRow);
        }

        return $chirps;
    }

    private function createChirpFromData(array $chirpData)
    {
        $chirp = new Chirp ($chirpData['id']);
        $chirp->setUserId($chirpData['rst_users_id']);
        $chirp->setContent($chirpData['content']);
        return $chirp;
    }

    /**
     * @param Chirp $chirp
     */
    public function sendChirpToDB(Chirp $chirp){

        $stmt = $this->pdo->prepare('INSERT INTO rst_chirps (rst_users_id, content)
                                                         VALUES (:users_id, :content);');

        $userId = $chirp->getUserId();
        $content = $chirp->getContent();

        $stmt->bindParam(':users_id', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content , PDO::PARAM_STR);
        $stmt->execute();

        $_SESSION['flash'] = "You have sucessfully posted a chirp!";

    }
}