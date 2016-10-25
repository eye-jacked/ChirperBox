<?php

class PostRepo
{

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param $chirpId
     * @return array
     */
    public function getPostsByChirpId($chirpId)
    {
        $Posts = array();
        $stmt = $this->pdo->prepare('SELECT p.id, p.rst_users_id, p.content, u.fname, u.surname
                                     FROM rst_posts as p
                                     LEFT JOIN `rst_users` as u ON p.rst_users_id = u.id
                                     WHERE rst_chirps_id = :chirpId;');

        $stmt->bindParam(':chirpId', $chirpId, PDO::PARAM_INT);
        $stmt->execute();
        $PostsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$PostsData) {
            $nullPost = new Post();
            $nullPost->setContent("No comments yet!");
            return $nullPost;
        }

        return $PostsData;
    }

    private function createPostFromData(array $PostData)
    {
        $Post = new Post ($PostData['id']);
        $Post->setUserId($PostData['rst_users_id']);
        $Post->setContent($PostData['content']);
        return $Post;
    }

    /**
     * @param Post $Post
     */
    public function sendPostToDB(Post $Post)
    {

        $stmt = $this->pdo->prepare('INSERT INTO rst_posts (rst_users_id, rst_chirps_id, content)
                                                         VALUES (:users_id, :rst_chirp_id, :content);');

        $userId = $Post->getUserId();
        $content = $Post->getContent();
        $chirpId = $Post->getChirpId();

        $stmt->bindParam(':users_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':rst_chirp_id', $chirpId, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['flash'] = "You have sucessfully posted!";

    }

    //TODO updatepost to db? is this necessary?
}