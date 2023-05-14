<?php
require_once 'vendor/autoload.php';
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;



#[Entity]
#[Table('chlodzenie_cpu')]
class CpuCooler
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int|null $id_chlodzenie_cpu = null;
    #[Column]
    private string $nazwa;
    #[Column(type: 'float')]
    private float $maks_TDP;
    #[Column]
    private string $socket;
    #[Column(type: 'float')]
    private float $wysokosc;
    #[Column(type: 'float')]
    private float $szerokosc;
    #[Column(type: 'float')]
    private float $glebokosc;
    #[Column(type: 'float')]
    private float $ilosc_cieplowodow;
    #[Column(type: 'float')]
    private float $srednica_cieplowodow;

    public function getId_chlodzenie_cpu()
    {
        return $this->id_chlodzenie_cpu;
    }

    public function getNazwa()
    {
        return $this->nazwa;
    }

    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getMaks_TDP()
    {
        return $this->maks_TDP;
    }

    public function setMaks_TDP($maks_TDP)
    {
        $this->maks_TDP = $maks_TDP;

        return $this;
    }

    public function getSocket()
    {
        return $this->socket;
    }

    public function setSocket($socket)
    {
        $this->socket = $socket;

        return $this;
    }

    public function getWysokosc()
    {
        return $this->wysokosc;
    }

    public function setWysokosc($wysokosc)
    {
        $this->wysokosc = $wysokosc;

        return $this;
    }

    public function getSzerokosc()
    {
        return $this->szerokosc;
    }

    public function setSzerokosc($szerokosc)
    {
        $this->szerokosc = $szerokosc;

        return $this;
    }

    public function getGlebokosc()
    {
        return $this->glebokosc;
    }

    public function setGlebokosc($glebokosc)
    {
        $this->glebokosc = $glebokosc;

        return $this;
    }

    public function getIlosc_cieplowodow()
    {
        return $this->ilosc_cieplowodow;
    }

    public function setIlosc_cieplowodow($ilosc_cieplowodow)
    {
        $this->ilosc_cieplowodow = $ilosc_cieplowodow;

        return $this;
    }

    public function getSrednica_cieplowodow()
    {
        return $this->srednica_cieplowodow;
    }

    public function setSrednica_cieplowodow($srednica_cieplowodow)
    {
        $this->srednica_cieplowodow = $srednica_cieplowodow;

        return $this;
    }
}

#[Entity]
#[Table('cpu')]
class Cpu
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int|null $id_cpu = null;
    #[Column]
    private string $nazwa;
    #[Column(name: 'socket')]
    private string $cpu_socket;
    #[Column(type: 'float')]
    private float $zegar;
    #[Column(type: 'float')]
    private float $turbo;
    #[Column(type: 'float')]
    private float $rdzenie;
    #[Column(type: 'float')]
    private float $watki;

    public function getId_cpu()
    {
        return $this->id_cpu;
    }

    public function getNazwa()
    {
        return $this->nazwa;
    }

    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getCpu_socket()
    {
        return $this->cpu_socket;
    }

    public function setCpu_socket($cpu_socket)
    {
        $this->cpu_socket = $cpu_socket;

        return $this;
    }

    public function getZegar()
    {
        return $this->zegar;
    }

    public function setZegar($zegar)
    {
        $this->zegar = $zegar;

        return $this;
    }

    public function getTurbo()
    {
        return $this->turbo;
    }

    public function setTurbo($turbo)
    {
        $this->turbo = $turbo;

        return $this;
    }

    public function getRdzenie()
    {
        return $this->rdzenie;
    }

    public function setRdzenie($rdzenie)
    {
        $this->rdzenie = $rdzenie;

        return $this;
    }

    public function getWatki()
    {
        return $this->watki;
    }

    public function setWatki($watki)
    {
        $this->watki = $watki;

        return $this;
    }
}

#[Entity]
#[Table('gpu')]
class Gpu
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int|null $id_gpu = null;
    #[Column]
    private string $nazwa;
    #[Column]
    private string $producent_chipsetu;
    #[Column(type: 'float')]
    private float $dlugosc_karty;
    #[Column(type: 'integer')]
    private int $ilosc_ram;
    #[Column]
    private string $rodzaj_chipsetu;
    #[Column(type: 'float')]
    private float $rekomendowana_moc_zasilacza;
    #[Column(type: 'float')]
    private float $taktowanie_rdzenia_boost;

    public function getId_gpu()
    {
        return $this->id_gpu;
    }

    public function getNazwa()
    {
        return $this->nazwa;
    }

    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getProducent_chipsetu()
    {
        return $this->producent_chipsetu;
    }

    public function setProducent_chipsetu($producent_chipsetu)
    {
        $this->producent_chipsetu = $producent_chipsetu;

        return $this;
    }

    public function getDlugosc_karty()
    {
        return $this->dlugosc_karty;
    }

    public function setDlugosc_karty($dlugosc_karty)
    {
        $this->dlugosc_karty = $dlugosc_karty;

        return $this;
    }

    public function getIlosc_ram()
    {
        return $this->ilosc_ram;
    }

    public function setIlosc_ram($ilosc_ram)
    {
        $this->ilosc_ram = $ilosc_ram;

        return $this;
    }

    public function getRodzaj_chipsetu()
    {
        return $this->rodzaj_chipsetu;
    }

    public function setRodzaj_chipsetu($rodzaj_chipsetu)
    {
        $this->rodzaj_chipsetu = $rodzaj_chipsetu;

        return $this;
    }

    public function getRekomendowana_moc_zasilacza()
    {
        return $this->rekomendowana_moc_zasilacza;
    }

    public function setRekomendowana_moc_zasilacza($rekomendowana_moc_zasilacza)
    {
        $this->rekomendowana_moc_zasilacza = $rekomendowana_moc_zasilacza;

        return $this;
    }

    public function getTaktowanie_rdzenia_boost()
    {
        return $this->taktowanie_rdzenia_boost;
    }

    public function setTaktowanie_rdzenia_boost($taktowanie_rdzenia_boost)
    {
        $this->taktowanie_rdzenia_boost = $taktowanie_rdzenia_boost;

        return $this;
    }
}

#[Entity]
#[Table('hdd')]
class Hdd
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int|null $id_hdd = null;
    #[Column]
    private string $nazwa;
    #[Column]
    private string $format;
    #[Column]
    private string $interfejs;
    #[Column(type: 'float')]
    private float $pamiec_podreczna;
    #[Column(type: 'float')]
    private float $pojemnosc;
    #[Column(type: 'float')]
    private float $predkosc;

    public function getId_hdd()
    {
        return $this->id_hdd;
    }

    public function getNazwa()
    {
        return $this->nazwa;
    }

    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    public function getInterfejs()
    {
        return $this->interfejs;
    }

    public function setInterfejs($interfejs)
    {
        $this->interfejs = $interfejs;

        return $this;
    }

    public function getPamiec_podreczna()
    {
        return $this->pamiec_podreczna;
    }

    public function setPamiec_podreczna($pamiec_podreczna)
    {
        $this->pamiec_podreczna = $pamiec_podreczna;

        return $this;
    }

    public function getPojemnosc()
    {
        return $this->pojemnosc;
    }

    public function setPojemnosc($pojemnosc)
    {
        $this->pojemnosc = $pojemnosc;

        return $this;
    }

    public function getPredkosc()
    {
        return $this->predkosc;
    }

    public function setPredkosc($predkosc)
    {
        $this->predkosc = $predkosc;

        return $this;
    }
}

#[Entity]
#[table('mb')]
class Mb
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int|null $id_mb;
    #[Column]
    private string $nazwa;
    #[Column]
    private string $chipset_plyty;
    #[Column]
    private string $gniazdo_procesora;
    #[Column(type: 'integer')]
    private int $liczba_slotow_pamieci;
    #[Column]
    private string $standard_plyty;
    #[Column]
    private string $standard_pamieci;
    #[Column(type: 'integer')]
    private int $maks_ilosc_pamieci_ram;

    public function getId_mb()
    {
        return $this->id_mb;
    }

    public function getNazwa()
    {
        return $this->nazwa;
    }

    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getChipset_plyty()
    {
        return $this->chipset_plyty;
    }

    public function setChipset_plyty($chipset_plyty)
    {
        $this->chipset_plyty = $chipset_plyty;

        return $this;
    }

    public function getGniazdo_procesora()
    {
        return $this->gniazdo_procesora;
    }

    public function setGniazdo_procesora($gniazdo_procesora)
    {
        $this->gniazdo_procesora = $gniazdo_procesora;

        return $this;
    }

    public function getLiczba_slotow_pamieci()
    {
        return $this->liczba_slotow_pamieci;
    }

    public function setLiczba_slotow_pamieci($liczba_slotow_pamieci)
    {
        $this->liczba_slotow_pamieci = $liczba_slotow_pamieci;

        return $this;
    }

    public function getStandard_plyty()
    {
        return $this->standard_plyty;
    }

    public function setStandard_plyty($standard_plyty)
    {
        $this->standard_plyty = $standard_plyty;

        return $this;
    }

    public function getStandard_pamieci()
    {
        return $this->standard_pamieci;
    }

    public function setStandard_pamieci($standard_pamieci)
    {
        $this->standard_pamieci = $standard_pamieci;

        return $this;
    }

    public function getMaks_ilosc_pamieci_ram()
    {
        return $this->maks_ilosc_pamieci_ram;
    }

    public function setMaks_ilosc_pamieci_ram($maks_ilosc_pamieci_ram)
    {
        $this->maks_ilosc_pamieci_ram = $maks_ilosc_pamieci_ram;

        return $this;
    }
}

#[Entity]
#[Table('obudowa')]
class Obudowa
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int|null $id_obudowa = null;
    #[Column]
    private string $nazwa;
    #[Column]
    private string $standard;
    #[Column(type: 'float')]
    private float $maks_dlugosc_karty_graf;
    #[Column]
    private string $typ_obudowy;
    #[Column(type: 'float')]
    private float $wysokosc;
    #[Column(type: 'float')]
    private float $szerokosc;
    #[Column(type: 'float')]
    private float $glebokosc;

    public function getId_obudowa()
    {
        return $this->id_obudowa;
    }

    public function getNazwa()
    {
        return $this->nazwa;
    }

    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getStandard()
    {
        return $this->standard;
    }

    public function setStandard($standard)
    {
        $this->standard = $standard;

        return $this;
    }

    public function getMaks_dlugosc_karty_graf()
    {
        return $this->maks_dlugosc_karty_graf;
    }

    public function setMaks_dlugosc_karty_graf($maks_dlugosc_karty_graf)
    {
        $this->maks_dlugosc_karty_graf = $maks_dlugosc_karty_graf;

        return $this;
    }

    public function getTyp_obudowy()
    {
        return $this->typ_obudowy;
    }

    public function setTyp_obudowy($typ_obudowy)
    {
        $this->typ_obudowy = $typ_obudowy;

        return $this;
    }

    public function getWysokosc()
    {
        return $this->wysokosc;
    }

    public function setWysokosc($wysokosc)
    {
        $this->wysokosc = $wysokosc;

        return $this;
    }

    public function getSzerokosc()
    {
        return $this->szerokosc;
    }

    public function setSzerokosc($szerokosc)
    {
        $this->szerokosc = $szerokosc;

        return $this;
    }

    public function getGlebokosc()
    {
        return $this->glebokosc;
    }

    public function setGlebokosc($glebokosc)
    {
        $this->glebokosc = $glebokosc;

        return $this;
    }
}

#[Entity]
#[Table('ram')]
class Ram
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int|null $id_ram = null;
    #[Column]
    private string $nazwa;
    #[Column(type: 'float')]
    private float $czestotliwosc;
    #[Column(type: 'integer')]
    private int $liczba_modulow;
    #[Column(type: 'integer')]
    private int $laczna_pamiec;
    #[Column(name: 'opoznienie')]
    private string $opluznienie;
    #[Column]
    private string $typ_pamieci;

    public function getId_ram()
    {
        return $this->id_ram;
    }

    public function getNazwa()
    {
        return $this->nazwa;
    }

    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getCzestotliwosc()
    {
        return $this->czestotliwosc;
    }

    public function setCzestotliwosc($czestotliwosc)
    {
        $this->czestotliwosc = $czestotliwosc;

        return $this;
    }

    public function getLiczba_modulow()
    {
        return $this->liczba_modulow;
    }

    public function setLiczba_modulow($liczba_modulow)
    {
        $this->liczba_modulow = $liczba_modulow;

        return $this;
    }

    public function getLaczna_pamiec()
    {
        return $this->laczna_pamiec;
    }

    public function setLaczna_pamiec($laczna_pamiec)
    {
        $this->laczna_pamiec = $laczna_pamiec;

        return $this;
    }

    public function getOpluznienie()
    {
        return $this->opluznienie;
    }

    public function setOpluznienie($opluznienie)
    {
        $this->opluznienie = $opluznienie;

        return $this;
    }

    public function getTyp_pamieci()
    {
        return $this->typ_pamieci;
    }

    public function setTyp_pamieci($typ_pamieci)
    {
        $this->typ_pamieci = $typ_pamieci;

        return $this;
    }
}

#[Entity]
#[Table('ssd')]
class Ssd
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int|null $id = null;
    #[Column]
    private string $nazwa;
    #[Column]
    private string $interfejs;
    #[Column(type: 'float')]
    private float $pojemnosc;
    #[Column]
    private string $format;
    #[Column(type: 'float')]
    private float $odczyt;
    #[Column(type: 'float')]
    private float $zapis;

    public function getId()
    {
        return $this->id;
    }

    public function getNazwa()
    {
        return $this->nazwa;
    }

    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getInterfejs()
    {
        return $this->interfejs;
    }

    public function setInterfejs($interfejs)
    {
        $this->interfejs = $interfejs;

        return $this;
    }

    public function getPojemnosc()
    {
        return $this->pojemnosc;
    }

    public function setPojemnosc($pojemnosc)
    {
        $this->pojemnosc = $pojemnosc;

        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    public function getOdczyt()
    {
        return $this->odczyt;
    }

    public function setOdczyt($odczyt)
    {
        $this->odczyt = $odczyt;

        return $this;
    }

    public function getZapis()
    {
        return $this->zapis;
    }

    public function setZapis($zapis)
    {
        $this->zapis = $zapis;

        return $this;
    }
}

#[Entity]
#[Table('zasilacz')]
class Zasilacz
{
    #[Id]
    #[Column(type: 'integer')]
    #[GeneratedValue]
    private int|null $id_zasilacz = null;
    #[Column]
    private string $nazwa;
    #[Column]
    private string $certyfikat;
    #[Column(type: 'float')]
    private float $srednica_wentylatora;
    #[Column(type: 'integer')]
    private int $moc;
    #[Column]
    private string $standard;
    #[Column(type: 'float')]
    private float $wysokosc;
    #[Column(type: 'float')]
    private float $szerokosc;
    #[Column(type: 'float')]
    private float $glebokosc;

    public function getId_zasilacz()
    {
        return $this->id_zasilacz;
    }

    public function getNazwa()
    {
        return $this->nazwa;
    }

    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getCertyfikat()
    {
        return $this->certyfikat;
    }

    public function setCertyfikat($certyfikat)
    {
        $this->certyfikat = $certyfikat;

        return $this;
    }

    public function getSrednica_wentylatora()
    {
        return $this->srednica_wentylatora;
    }

    public function setSrednica_wentylatora($srednica_wentylatora)
    {
        $this->srednica_wentylatora = $srednica_wentylatora;

        return $this;
    }

    public function getMoc()
    {
        return $this->moc;
    }

    public function setMoc($moc)
    {
        $this->moc = $moc;

        return $this;
    }

    public function getStandard()
    {
        return $this->standard;
    }

    public function setStandard($standard)
    {
        $this->standard = $standard;

        return $this;
    }

    public function getWysokosc()
    {
        return $this->wysokosc;
    }

    public function setWysokosc($wysokosc)
    {
        $this->wysokosc = $wysokosc;

        return $this;
    }

    public function getSzerokosc()
    {
        return $this->szerokosc;
    }

    public function setSzerokosc($szerokosc)
    {
        $this->szerokosc = $szerokosc;

        return $this;
    }

    public function getGlebokosc()
    {
        return $this->glebokosc;
    }

    public function setGlebokosc($glebokosc)
    {
        $this->glebokosc = $glebokosc;

        return $this;
    }
}
?>