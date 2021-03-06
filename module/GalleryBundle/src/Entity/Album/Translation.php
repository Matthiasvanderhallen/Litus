<?php
 
namespace GalleryBundle\Entity\Album;

use CommonBundle\Entity\General\Language;

/**
 * This entity stores the node item.
 *
 * @Entity(repositoryClass="GalleryBundle\Repository\Album\Translation")
 * @Table(name="gallery.translation")
 */
class Translation
{
    /**
     * @var int The ID of this tanslation
     *
     * @Id
     * @GeneratedValue
     * @Column(type="bigint")
     */
    private $id;
    
    /**
     * @var \GalleryBundle\Entity\Album\Album The album of this translation
     *
     * @ManyToOne(targetEntity="GalleryBundle\Entity\Album\Album", inversedBy="translations")
     * @JoinColumn(name="album", referencedColumnName="id")
     */
    private $album;
        
    /**
     * @var \CommonBundle\Entity\General\Language The language of this tanslation
     *
     * @ManyToOne(targetEntity="CommonBundle\Entity\General\Language")
     * @JoinColumn(name="language", referencedColumnName="id")
     */
    private $language;
        
    /**
     * @var string The title of this tanslation
     *
     * @Column(type="string")
     */
    private $title;
    
    /**
     * @var string The name of this tanslation
     *
     * @Column(type="string", unique=true)
     */
    private $name;
    
    /**
     * @param \GalleryBundle\Entity\Album\Album $album
     * @param \CommonBundle\Entity\General\Language $language
     * @param string $content
     * @param string $title
     */
    public function __construct(Album $album, Language $language, $title)
    {
        $this->album = $album;
        $this->language = $language;
        $this->title = $title;
        $this->_setName($title);
    }
    
    /**
     * @return \GalleryBundle\Entity\Album\Album
     */
    public function getAlbum()
    {
        return $this->album;
    }
    
    /**
     * @return \CommonBundle\Entity\General\Language
     */
    public function getLanguage()
    {
        return $this->language;
    }
    
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * @param string $title
     *
     * @param \PageBundle\Entity\Nodes\Page
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->_setName($title);
        return $this;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     *
     * @param \PageBundle\Entity\Nodes\Page
     */
    private function _setName($name)
    {
        $this->name = $this->album->getDate()->format('Ymd') . '_' . str_replace(' ', '_', strtolower($name));
        return $this;
    }
}