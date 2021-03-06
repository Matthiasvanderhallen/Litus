<?php
 
namespace NewsBundle\Entity\Nodes;

use CommonBundle\Entity\General\Language,
    CommonBundle\Entity\Users\Person;

/**
 * This entity stores the node item.
 *
 * @Entity(repositoryClass="NewsBundle\Repository\Nodes\Translation")
 * @Table(name="nodes.news_translation")
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
     * @var \NewsBundle\Entity\Nodes\News The news of this translation
     *
     * @ManyToOne(targetEntity="NewsBundle\Entity\Nodes\News", inversedBy="translations")
     * @JoinColumn(name="news", referencedColumnName="id")
     */
    private $news;
        
    /**
     * @var \CommonBundle\Entity\General\Language The language of this tanslation
     *
     * @ManyToOne(targetEntity="CommonBundle\Entity\General\Language")
     * @JoinColumn(name="language", referencedColumnName="id")
     */
    private $language;
    
    /**
     * @var string The content of this tanslation
     *
     * @Column(type="string")
     */
    private $content;
        
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
     * @param \NewsBundle\Entity\Nodes\News $news
     * @param \CommonBundle\Entity\General\Language $language
     * @param string $content
     * @param string $title
     */
    public function __construct(News $news, Language $language, $content, $title)
    {
        $this->news = $news;
        $this->language = $language;
        $this->content = $content;
        $this->title = $title;
        $this->_setName($title);
    }
    
    /**
     * @return \NewsBundle\Entity\Nodes\News
     */
    public function getNews()
    {
        return $this->news;
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
     * @return \NewsBundle\Entity\Nodes\Translation
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
     * @param \NewsBundle\Entity\Nodes\Translation
     */
    private function _setName($name)
    {
        $this->name = $this->news->getCreateTime()->format('Ymd') . '_' . str_replace(' ', '_', strtolower($name));
        return $this;
    }
    
    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * @return string
     */
    public function getSummary($length = 50)
    {
        $content = strip_tags($this->content);
        return substr($content, 0, $length) . (strlen($content) > $length ? '...' : '');
    }
    
    /**
     * @param string $content
     *
     * @param \NewsBundle\Entity\Nodes\Translation
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
}