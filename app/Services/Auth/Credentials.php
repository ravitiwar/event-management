<?php


namespace App\Services\Auth;


class Credentials
{
    private string $userId;
    private string $password;

    /**
     * Credentials constructor.
     * @param string $userId
     * @param string $password
     */
    public function __construct(string $userId, string $password)
    {
        $this->userId = $userId;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     * @return Credentials
     */
    public function setUserId(string $userId): Credentials
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): Credentials
    {
        $this->password = $password;
        return $this;
    }

}
