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
 
namespace SyllabusBundle\Entity;

use CommonBundle\Entity\Users\People\Academic;

/**
 * @Entity(repositoryClass="SyllabusBundle\Repository\SubjectProfMap")
 * @Table(name="syllabus.subject_prof_map")
 */
class SubjectProfMap
{
    /**
     * @var integer The ID of this mapping
     *
	 * @Id
	 * @GeneratedValue
	 * @Column(type="bigint")
	 */
    private $id;

    /**
     * @var \CommonBundle\Entity\Users\People\Academic The prof of this mapping
     *
	 * @ManyToOne(targetEntity="CommonBundle\Entity\Users\People\Academic")
	 * @JoinColumn(referencedColumnName="id")
	 */
	private $prof;

	/**
	 * @var \SyllabusBundle\Entity\Subject The subject of this mapping
	 *
	 * @ManyToOne(targetEntity="SyllabusBundle\Entity\Subject")
	 * @JoinColumn(referencedColumnName="id")
	 */
	private $subject;
    
    /**
     * @param \SyllabusBundle\Entity\Subject $subject
     * @param \CommonBundle\Entity\Users\People\Academic $prof
     */
    public function __construct(Subject $subject, Academic $prof)
    {
        $this->subject = $subject;
        $this->prof = $prof;
    }
    
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return \SyllabusBundle\Entity\Subject
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
    /**
     * @return \CommonBundle\Entity\Users\People\Academic
     */
    public function getProf()
    {
        return $this->prof;
    }
}
