<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Idioma
 *
 * @ORM\Table(name="idioma")
 * @ORM\Entity
 */
class Idioma
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", mappedBy="idioma_audio")
     */
    private $pelicula_audio;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pelicula", inversedBy="idioma_subtitulo")
     * @ORM\JoinTable(name="idioma_pelicula",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idioma_id", referencedColumnName="id", onDelete="CASCADE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pelicula_id", referencedColumnName="id", onDelete="CASCADE")
     *   }
     * )
     */
    private $pelicula_subtitulo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pelicula_audio = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pelicula_subtitulo = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Idioma
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
     * Add peliculaAudio
     *
     * @param \AppBundle\Entity\Pelicula $peliculaAudio
     *
     * @return Idioma
     */
    public function addPeliculaAudio(\AppBundle\Entity\Pelicula $peliculaAudio)
    {
        $this->pelicula_audio[] = $peliculaAudio;

        return $this;
    }

    /**
     * Remove peliculaAudio
     *
     * @param \AppBundle\Entity\Pelicula $peliculaAudio
     */
    public function removePeliculaAudio(\AppBundle\Entity\Pelicula $peliculaAudio)
    {
        $this->pelicula_audio->removeElement($peliculaAudio);
    }

    /**
     * Get peliculaAudio
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeliculaAudio()
    {
        return $this->pelicula_audio;
    }

    /**
     * Add peliculaSubtitulo
     *
     * @param \AppBundle\Entity\Pelicula $peliculaSubtitulo
     *
     * @return Idioma
     */
    public function addPeliculaSubtitulo(\AppBundle\Entity\Pelicula $peliculaSubtitulo)
    {
        $this->pelicula_subtitulo[] = $peliculaSubtitulo;

        return $this;
    }

    /**
     * Remove peliculaSubtitulo
     *
     * @param \AppBundle\Entity\Pelicula $peliculaSubtitulo
     */
    public function removePeliculaSubtitulo(\AppBundle\Entity\Pelicula $peliculaSubtitulo)
    {
        $this->pelicula_subtitulo->removeElement($peliculaSubtitulo);
    }

    /**
     * Get peliculaSubtitulo
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPeliculaSubtitulo()
    {
        return $this->pelicula_subtitulo;
    }
}

