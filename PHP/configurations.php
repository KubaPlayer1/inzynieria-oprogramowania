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
#[Table('configurations')]
class Configurations
{
    #[Id]
    #[Column(type: 'integer', name: 'ID')]
    #[GeneratedValue]
    private int|null $ID = null;
    #[Column(type: 'integer', name: 'ID_account')]
    private int $ID_account;
    #[Column(type: 'integer', name: 'ID_cpu')]
    private int $ID_cpu;
    #[Column(type: 'integer', name: 'ID_mb')]
    private int $ID_mb;
    #[Column(type: 'integer', name: 'ID_ram')]
    private int $ID_ram;
    #[Column(type: 'integer', name: 'ID_gpu')]
    private int $ID_gpu;
    #[Column(type: 'integer', name: 'ID_zasilacz')]
    private int $ID_zasilacz;
    #[Column(type: 'integer', name: 'ID_chlodzenie')]
    private int $ID_chlodzenie;
    #[Column(type: 'integer', name: 'ID_hdd')]
    private int $ID_hdd;
    #[Column(type: 'integer', name: 'ID_ssd')]
    private int $ID_ssd;
    #[Column(type: 'integer', name: 'ID_obudowa')]
    private int $ID_obudowa;
    #[Column(type: 'text')]
    private string $name;

    public function getID()
    {
        return $this->ID;
    }

    public function getID_account()
    {
        return $this->ID_account;
    }

    public function setID_account($ID_account)
    {
        $this->ID_account = $ID_account;

        return $this;
    }

    public function getID_cpu()
    {
        return $this->ID_cpu;
    }

    public function setID_cpu($ID_cpu)
    {
        $this->ID_cpu = $ID_cpu;

        return $this;
    }

    public function getID_mb()
    {
        return $this->ID_mb;
    }

    public function setID_mb($ID_mb)
    {
        $this->ID_mb = $ID_mb;

        return $this;
    }

    public function getID_ram()
    {
        return $this->ID_ram;
    }

    public function setID_ram($ID_ram)
    {
        $this->ID_ram = $ID_ram;

        return $this;
    }

    public function getID_gpu()
    {
        return $this->ID_gpu;
    }

    public function setID_gpu($ID_gpu)
    {
        $this->ID_gpu = $ID_gpu;

        return $this;
    }

    public function getID_zasilacz()
    {
        return $this->ID_zasilacz;
    }

    public function setID_zasilacz($ID_zasilacz)
    {
        $this->ID_zasilacz = $ID_zasilacz;

        return $this;
    }

    public function getID_chlodzenie()
    {
        return $this->ID_chlodzenie;
    }

    public function setID_chlodzenie($ID_chlodzenie)
    {
        $this->ID_chlodzenie = $ID_chlodzenie;

        return $this;
    }

    public function getID_hdd()
    {
        return $this->ID_hdd;
    }

    public function setID_hdd($ID_hdd)
    {
        $this->ID_hdd = $ID_hdd;

        return $this;
    }

    public function getID_ssd()
    {
        return $this->ID_ssd;
    }

    public function setID_ssd($ID_ssd)
    {
        $this->ID_ssd = $ID_ssd;

        return $this;
    }

    public function getID_obudowa()
    {
        return $this->ID_obudowa;
    }

    public function setID_obudowa($ID_obudowa)
    {
        $this->ID_obudowa = $ID_obudowa;

        return $this;
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