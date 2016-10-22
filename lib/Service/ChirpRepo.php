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

        if (!$chirpsData) {
            return null;
        }

        foreach($chirpsData as $chirpRow){
            $chirps[] = $this->createChirpFromData($chirpRow);
        }

        return $chirps;
    }

    private function createChirpFromData(array $chirpData)
    {
        $chirp = new Chirp ($chirpData['id']);
        $chirp->setEmail($chirpData['rst_users_id']);
        $chirp->setHash($chirpData['content']);
        return $chirp;
    }

    private function sendChirptoDB(Chirp $chirp){

        $stmt = $this->pdo->prepare('INSERT INTO rst_chirps (rst_users_id, content)
                                                         VALUES (:users_id,:content);');

        $userId = $chirp->getUserId();
        $content = $chirp->getContent();

        $stmt->bindParam(':users_id', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content , PDO::PARAM_STR);
        $stmt->execute();

    }
}