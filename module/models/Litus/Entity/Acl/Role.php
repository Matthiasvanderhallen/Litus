<?php

namespace Litus\Entity\Acl;

use \Doctrine\Common\Collections\ArrayCollection;

use \Litus\Acl\Acl;

/**
 * Represents a group of users and is capable of determining which rights those users have.
 *
 * @Entity(repositoryClass="Litus\Repository\Acl\Role")
 * @Table(
 *      name="acl.roles",
 *      uniqueConstraints={@UniqueConstraint(name="role_unique_name", columns={"name"})}
 * )
 */
class Role
{
    /**
     * @var string $name The name of the Role
     *
     * @Id
     * @Column(type="string")
     */
    private $name;

    /**
     * @var Litus\Entity\Acl\Role $parents The parents of this role
     *
     * @ManyToMany(targetEntity="Litus\Entity\Acl\Role")
     * @JoinTable(
     *      name="acl.roles_inheritance",
     *      joinColumns={@JoinColumn(name="parent", referencedColumnName="name")},
     *      inverseJoinColumns={@JoinColumn(name="child", referencedColumnName="name")}
     * )
     */
    private $parents;

    /**
     * @var \Litus\Entity\Acl\Role $actions The actions that this role can execute
     *
     * @ManyToMany(targetEntity="Litus\Entity\Acl\Action")
     * @JoinTable(
     *      name="acl.roles_actions",
     *      joinColumns={@JoinColumn(name="role", referencedColumnName="name")},
     *      inverseJoinColumns={@JoinColumn(name="action", referencedColumnName="id")}
     * )
     */
    private $actions;

    /**
     * @param string $name The name of the role
     * @param array $parents The role's parents
     */
    public function __construct($name, array $parents = array())
    {
        $this->name = $name;

        $this->parents = new ArrayCollection($parents);
        $this->actions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getParents()
    {
        return $this->parents->toArray();
    }

    /**
     * @return array
     */
    public function getActions()
    {
        return $this->actions->toArray();
    }

    /**
     * Add a new action to the allow list of this Role
     *
     * @param \Litus\Entity\Acl\Action $action
     * @return void
     */
    public function allow(Action $action)
    {
        $this->actions->add($action);
    }


    /**
     * Checks whether or not this role has sufficient permissions to access
     * the specified action.
     *
     * @param string $resource The resource the action belongs to
     * @param string $action The action that should be verified
     * @return bool
     */
    public function isAllowed($resource, $action)
    {
        $acl = new Acl();

        if (
            $acl->getAcl()->isAllowed(
                $this->getName(), $resource, $action
            )
        ) {
            return true;
        }

        foreach ($this->getParents() as $parent) {
            if ($parent->isAllowed($resource, $action))
                return true;
        }

        return false;
    }
}