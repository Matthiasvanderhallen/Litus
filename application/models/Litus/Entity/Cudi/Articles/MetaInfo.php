<?php

namespace Litus\Entity\Cudi\Articles;

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
}