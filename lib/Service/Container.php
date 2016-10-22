<?php


class Container
{
    private $configuration;

    private $pdo;

    private $userRepo;

    private $chirpRepo;

    private $postRepo;

    private $msgRepo;


    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return PDO
     */
    public function getPDO()
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_pass']
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    /**
     * @return UserRepo
     */
    public function getUserRepo()
    {
        if ($this->userRepo === null) {
            $this->userRepo = new UserRepo($this->getPDO());
        }

        return $this->userRepo;
    }

    /**
     * @return ChirpRepo
     */
    public function getChirpRepo()
    {
        if ($this->chirpRepo === null) {
            $this->chirpRepo = new ChirpRepo($this->getPDO());
        }

        return $this->chirpRepo;
    }

    /**
     * @return PostRepo
     */
    public function getPostRepo()
    {
        if ($this->postRepo === null) {
            $this->postRepo = new PostRepo($this->getPDO());
        }

        return $this->postRepo;
    }

    /**
     * @return MsgRepo
     */
    public function getMsgRepo()
    {
        if ($this->msgRepo === null) {
            $this->msgRepo = new MsgRepo($this->getPDO());
        }

        return $this->msgRepo;
    }

}
