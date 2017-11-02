<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actor
 *
 * @ORM\Table(name="actor")
 * @ORM\Entity
 */
class Actor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="anio_nacimiento", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $anioNacimiento;

    /**
     * @var \AppBundle\Entity\Pais
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pais", inversedBy="actors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     * })
     */
    private $pais;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", inversedBy="actors")
     * @ORM\JoinTable(name="actor_pelicula",
     *   joinColumns={
     *     @ORM\JoinColumn(name="actor_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pelicula_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     */
    private $peliculas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pelicula = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Actor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set anioNacimiento
     *
     * @param \DateTime $anioNacimiento
     *
     * @return Actor
     */
    public function setAnioNacimiento($anioNacimiento)
    {
        $this->anioNacimiento = $anioNacimiento;

        return $this;
    }

    /**
     * Get anioNacimiento
     *
     * @return \DateTime
     */
    public function getAnioNacimiento()
    {
        return $this->anioNacimiento;
    }

    /**
     * Set pais
     *
     * @param \AppBundle\Entity\Pais $pais
     *
     * @return Actor
     */
    public function setPais(\AppBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \AppBundle\Entity\Pais
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Add pelicula
     *
     * @param \AppBundle\Entity\Pelicula $pelicula
     *
     * @return Actor
     */
    public function addPelicula(\AppBundle\Entity\Pelicula $pelicula)
    {
        $this->pelicula[] = $pelicula;

        return $this;
    }

    /**
     * Remove pelicula
     *
     * @param \AppBundle\Entity\Pelicula $pelicula
     */
    public function removePelicula(\AppBundle\Entity\Pelicula $pelicula)
    {
        $this->pelicula->removeElement($pelicula);
    }

    /**
     * Get pelicula
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPelicula()
    {
        return $this->pelicula;
    }
}
