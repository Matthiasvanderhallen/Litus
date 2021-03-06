<?php
/**
 * Litus is a project by a group of students from the K.U.Leuven. The goal is to create
 * various applications to support the IT needs of student unions.
 *
 * @author Karsten Daemen <karsten.daemen@litus.cc>
 * @author Bram Gotink <bram.gotink@litus.cc>
 * @author Pieter Maene <pieter.maene@litus.cc>
 * @author Kristof Mariën <kristof.marien@litus.cc>
 * @author Michiel Staessen <michiel.staessen@litus.cc>
 * @author Alan Szepieniec <alan.szepieniec@litus.cc>
 *
 * @license http://litus.cc/LICENSE
 */
 
namespace CudiBundle\Entity\Articles;

use CudiBundle\Entity\Article;

/**
 * @Entity(repositoryClass="CudiBundle\Repository\Articles\MetaInfo")
 * @Table(name="cudi.articles_metainfo")
 */
class MetaInfo
{
	/**
	 * @var integer The ID of the meta info
	 *
	 * @Id
	 * @GeneratedValue
	 * @Column(type="bigint")
	 */
	private $id;
	
	/**
	 * @var \CudiBundle\Entity\Article The article of this meta info
	 *
	 * @OneToOne(targetEntity="CudiBundle\Entity\Article")
	 * @JoinColumn(name="article", referencedColumnName="id")
	 */
	private $article;
	
	/**
	 * @var string The authors of the article
	 *
	 * @Column(type="string")
	 */
	private $authors;
	
	/**
	 * @var string The publishers of the article
     *
	 * @Column(type="string")
	 */
	private $publishers;
	
	/**
     * @var integer The year the article was published
     *
	 * @Column(name="year_published", type="integer", length=4)
	 */
	private $yearPublished;
	
	/**
	 * @param string $authors The authors of the article
	 * @param string $publishers The publishers of the article
	 * @param string $yearPublished The year of the article
	 */
	public function __construct($authors, $publishers, $yearPublished) {
		$this->authors = $authors;
		$this->publishers = $publishers;
		$this->yearPublished = $yearPublished;
	}
	
	/**
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @return \CudiBundle\Entity\Article
	 */
	public function getArticle()
	{
		return $this->article;
	}
	
	/**
	 * @param \CudiBundle\Entity\Article $article The article to link to this metainfo object.
	 */
	public function setArticle($article)
	{
		$this->article = $article;
	}
	
	/**
	 * @return string
	 */
	public function getAuthors()
	{
		return $this->authors;
	}
	
	/**
     * @param string $authors
	 *
     * @return \CudiBundle\Entity\Articles\MetaInfo
     */
	public function setAuthors($authors)
	{
		$this->authors = $authors;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getPublishers()
	{
		return $this->publishers;
	}
	
	/**
     * @param string $publishers
	 *
     * @return \CudiBundle\Entity\Articles\MetaInfo
     */
	public function setPublishers($publishers)
	{
		$this->publishers = $publishers;
		return $this;
	}
	
	/**
	 * @return integer
	 */
	public function getYearPublished()
	{
		return $this->yearPublished;
	}
	
	/**
     * @param string $yearPublished
	 *
     * @return \CudiBundle\Entity\Articles\MetaInfo
     */
	public function setYearPublished($yearPublished)
	{
		$this->yearPublished = $yearPublished;
		return $this;
	}
}