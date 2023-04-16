<?php
require_once 'vendor/autoload.php';
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\SequenceGenerator;

#[Entity]
#[Table('accounts')]
class Accounts
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int|null $id = null;
    #[Column]
    private string $username;
    #[Column]
    private string $email;
    #[Column(type: 'text')]
    private string $password;

 
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}

?>
