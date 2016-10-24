<?php

class MsgRepo
{

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * MsgRepo constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param $userId
     * @return array|msg
     */
    public function getAllMessages($userId)
    {
        $msgs = array();
        $stmt = $this->pdo->prepare('SELECT rst_msgs.content, u2.email, u1.email, u2.fname, u1.fname, u2.surname, u1.surname
                                     FROM rst_msgs 
                                     JOIN `rst_users` u1 ON rst_msgs.sender_rst_users_id = u1.id
                                     JOIN `rst_users` u2 ON rst_msgs.receiver_rst_users_id = u2.id
                                     WHERE receiver_rst_users_id = :receiverId 
                                     OR sender_rst_users_id = :senderId');
        $stmt->bindParam(':receiverId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':senderId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $msgsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($msgsData);die;

        if (!$msgsData) {
            $nullMsg = new msg();
            $nullMsg->setContent("You, and no-one else haven't posted any msg! Maybe it's time to get started!");
            return $nullMsg;
        }

        foreach ($msgsData as $msgRow) {
            $msg[] = $this->createmsgFromData($msgRow);
        }

        return $msgs;
    }

    /**
     * @param array $msgData
     * @return Msg
     */
    private function createMsgFromData(array $msgData)
    {
        var_dump($msgData);die;
        $msg = new Msg ($msgData['id']);
        $msg->setSenderId($msgData['receiver_rst_users_id']);
        $msg->setReceiverId($msgData['sender_rst_users_id']);
        $msg->setContent($msgData['content']);
        return $msg;
    }

    /**
     * @param Msg $msg
     */
    public function sendMsgToDb(Msg $msg){

        $stmt = $this->pdo->prepare('INSERT INTO rst_msgs (sender_rst_users_id, receiver_rst_users_id, content)
                                                         VALUES (:sender_rst_users, :receiver_rst_users, :content);');

        $senderId = $msg->getSenderId();
        $receiverId = $msg->getReceiverId();
        $content = $msg->getContent();

        $stmt->bindParam(':sender_rst_users', $senderId, PDO::PARAM_INT);
        $stmt->bindParam(':receiver_rst_users',$receiverId , PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['flash'] = "You have sucessfully msged!";

    }
}