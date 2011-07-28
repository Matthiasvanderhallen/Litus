<?php

namespace Litus\Entity\Cudi\Articles;

use Litus\Entity\Cudi\Article;

/**
 * @Entity(repositoryClass="Litus\Repository\Cudi\Articles\MetaInfo")
 * @Table(name="cudi.articles_metainfo")
 */
class MetaInfo
{
	/**
	 * @Id
	 * @GeneratedValue
	 * @Column(type="bigint")
	 */
	private $id;
	
	/**
	 * @OneToOne(targetEntity="Litus\Entity\Cudi\Article")
	 * @JoinColumn(name="article_id", referencedColumnName="id")
	 */
	private $article;
	
	/**
	 * @Column(type="string")
	 */
	private $authors;
	
	/**
	 * @Column(type="string")
	 */
	private $publishers;
	
	/**
	 * @Column(name="year_published", type="integer", length=4)
	 */
	private $yearPublished;
	
	public function __construct($authors, $publishers, $yearPublished) {
		$this->authors = $authors;
		$this->publishers = $publishers;
		$this->yearPublished = $yearPublished;
	}
	
	/**
	 * @return bigint
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @return Article
	 */
	public function getArticle()
	{
		return $this->article;
	}
	
	/**
	 * @param Article $article The article to link to this metainfo object.
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
	 * @return string
	 */
	public function getPublishers()
	{
		return $this->publishers;
	}
	
	/**
	 * @return integer
	 */
	public function getYearPublished()
	{
		return $this->yearPublished;
	}
}