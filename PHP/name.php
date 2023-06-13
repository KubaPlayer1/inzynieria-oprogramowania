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
#[Table('nazwa_konfiguracji')]
class NameOfConfig
{
    #[Id]
    #[Column(type: 'integer', name: 'ID')]
    #[GeneratedValue]
    private int|null $ID = null;
    #[Column(type: 'text')]
    private string $name;

    public function getID()
    {
        return $this->ID;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
?>