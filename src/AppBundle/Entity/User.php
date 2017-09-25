<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * User constructor.
     *
     * @param string $email
     * @param string $username
     * @param string $password
     * @param array $roles
     */
    public function __construct(
        string $email,
        string $username,
        string $password,
        array $roles
    ) {
        parent::__construct();

        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->plainPassword = $password;
        $this->roles = $roles;
        $this->enabled = true;
    }

    public function getId()
    {
        return $this->id;
    }
}
