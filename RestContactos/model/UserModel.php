<?php

/**
 * Created by PhpStorm.
 * User: agomez
 * Date: 9/02/18
 * Time: 9:37
 */
class UserModel implements JsonSerializable
{
    private $id;
    private $user;
    private $password;

    public function __construct($id, $user, $password)
    {
        $this->id = $id;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'user' => $this->user,
            'password' => $this->password
        );
    }

    public function __sleep(){
        return array('id' , 'user' , 'password' );
    }
}