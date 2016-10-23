<?php

class PostRepo{

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param $userId
     * @return array
     */
    public function getPostsByUserId($userId)
    {
        $Posts = array();
        $stmt = $this->pdo->prepare('SELECT * FROM rst_posts WHERE rst_chirp_id = :userid');
        $stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $PostsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (!$PostsData) {
            $nullPost = new Post();
            $nullPost->setContent("You haven't posted any tweets! Maybe it's time to get started!");
            return $nullPost;
        }

        foreach($PostsData as $PostRow){
            $Posts[] = $this->createPostFromData($PostRow);
        }

        return $Posts;
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
    public function sendPostToDB(Post $Post){

        $stmt = $this->pdo->prepare('INSERT INTO rst_Posts (rst_users_id, content)
                                                         VALUES (:users_id, :content);');

        $userId = $Post->getUserId();
        $content = $Post->getContent();

        $stmt->bindParam(':users_id', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content , PDO::PARAM_STR);
        $stmt->execute();

        $_SESSION['flash'] = "You have sucessfully posted a Post!";

    }
}