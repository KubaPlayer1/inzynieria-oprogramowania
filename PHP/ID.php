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
#[Table('id')]
class Iddb
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int|null $id = null;
    #[Column(type: 'integer')]
    private int $id_account;

    public function getId()
    {
        return $this->id;
    }

    public function getId_account()
    {
        return $this->id_account;
    }

    public function setId_account($id_account)
    {
        $this->id_account = $id_account;

        return $this;
    }
}

?>