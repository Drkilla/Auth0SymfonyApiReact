<?php

namespace App\Security\User;

use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class WebServiceUser implements UserInterface, EquatableInterface
{
    //UserInterface : Wich represents the interface that all user classes must implent and
    //EquatableInterface : wich is used to test if two objects are equal in security and re-auth context


    private $roles;
    private $jwt;

    public function __construct($jwt,array $roles)
    {
        $this->roles = $roles;
        $this->jwt = $jwt;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return null;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return isset($this->jwt["email"]) ? $this->jwt["email"] : $this->jwt["sub"];
    }

    public function eraseCredentials()
    {

    }

    public function isEqualTo( UserInterface $user )
    {
        if(!$user instanceof WebServiceUser)
        {
            return false;
        }

        if($this->getUsername() !== $user->getUsername()){
            return false;
        }

        return true;
    }

}