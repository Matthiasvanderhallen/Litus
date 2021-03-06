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
 
namespace CalendarBundle\Component\Validator;

use Doctrine\ORM\EntityManager;

/**
 * Matches the given faq title against the database to check whether it is
 * unique or not.
 *
 * @author Kristof Mariën <kristof.marien@litus.cc>
 */
class DateCompare extends \Zend\Validator\AbstractValidator
{
    /**
     * Error codes
     * @const string
     */
    const NOT_VALID      = 'notSame';

    /**
     * Error messages
     * @var array
     */
    protected $_messageTemplates = array(
        self::NOT_VALID      => "The end date must be after the start date",
    );

    /**
     * Original end date against which to validate
     * @var string
     */
    protected $_endDate;
    
    /**
     * @var string
     */
    private $_format;

	/**
     * Sets validator options
     *
     * @param  mixed $token
     * @param string $format
     * @return void
     */
    public function __construct($endDate = null, $format)
    {
        $this->_endDate = $endDate;
        $this->_format = $format;
        
        parent::__construct(is_array($endDate) ? $endDate : null);
    }
    
    /**
     * Returns true if and only if the end date is after the start date
     *
     * @param  mixed $value
     * @param  array $context
     * @return boolean
     */
    public function isValid($value, $context = null)
    {
        $this->setValue($value);

        if (null === $value || '' == $value)
            return true;
        
        if (($context !== null) && isset($context) && array_key_exists($this->_endDate, $context)) {
            $endDate = $context[$this->_endDate];
        } else {
            $this->error(self::NOT_VALID);
            return false;
        }

        if ($endDate === null) {
            $this->error(self::NOT_VALID);
            return false;
        }

        if (\DateTime::createFromFormat($this->_format, $value) <= \DateTime::createFromFormat($this->_format, $endDate)) {
            $this->error(self::NOT_VALID);
            return false;
        }

        return true;
    }
}