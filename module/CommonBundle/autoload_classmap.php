<?php
return array(
    'CommonBundle\Module'                                                              => __DIR__ . '/Module.php',
    'CommonBundle\Component\Acl\Acl'                                                   => __DIR__ . '/src/Component/Acl/Acl.php',
    'CommonBundle\Component\Acl\Driver\Exception\RuntimeException'                     => __DIR__ . '/src/Component/Acl/Driver/Exception/RuntimeException.php',
    'CommonBundle\Component\Acl\Driver\HasAccess'                                      => __DIR__ . '/src/Component/Acl/Driver/HasAccess.php',
    'CommonBundle\Component\Authentication\Action'                                     => __DIR__ . '/src/Component/Authentication/Action.php',
    'CommonBundle\Component\Authentication\Adapter\Doctrine'                           => __DIR__ . '/src/Component/Authentication/Adapter/Doctrine.php',
    'CommonBundle\Component\Authentication\Adapter\Exception\InvalidArgumentException' => __DIR__ . '/src/Component/Authentication/Adapter/Exception/InvalidArgumentException.php',
    'CommonBundle\Component\Authentication\Adapter\Exception\QueryFailedException'     => __DIR__ . '/src/Component/Authentication/Adapter/Exception/QueryFailedException.php',
    'CommonBundle\Component\Authentication\Authentication'                             => __DIR__ . '/src/Component/Authentication/Authentication.php',
    'CommonBundle\Component\Authentication\Result\Doctrine'                            => __DIR__ . '/src/Component/Authentication/Result/Doctrine.php',
    'CommonBundle\Component\Authentication\Result'                                     => __DIR__ . '/src/Component/Authentication/Result.php',
    'CommonBundle\Component\Authentication\Service\Doctrine'                           => __DIR__ . '/src/Component/Authentication/Service/Doctrine.php',
    'CommonBundle\Component\Authentication\Service\Exception\InvalidArgumentException' => __DIR__ . '/src/Component/Authentication/Service/Exception/InvalidArgumentException.php',
    'CommonBundle\Component\Controller\ActionController\InstallerController'           => __DIR__ . '/src/Component/Controller/ActionController/InstallerController.php',
    'CommonBundle\Component\Controller\ActionController'                               => __DIR__ . '/src/Component/Controller/ActionController.php',
    'CommonBundle\Component\Controller\AuthenticationAware'                            => __DIR__ . '/src/Component/Controller/AuthenticationAware.php',
    'CommonBundle\Component\Controller\DoctrineAware'                                  => __DIR__ . '/src/Component/Controller/DoctrineAware.php',
    'CommonBundle\Component\Controller\Exception\HasNoAccessException'                 => __DIR__ . '/src/Component/Controller/Exception/HasNoAccessException.php',
    'CommonBundle\Component\Controller\Plugin\Exception\InvalidArgumentException'      => __DIR__ . '/src/Component/Controller/Plugin/Exception/InvalidArgumentException.php',
    'CommonBundle\Component\Controller\Plugin\Exception\RuntimeException'              => __DIR__ . '/src/Component/Controller/Plugin/Exception/RuntimeException.php',
    'CommonBundle\Component\Controller\Plugin\HasAccess'                               => __DIR__ . '/src/Component/Controller/Plugin/HasAccess.php',
    'CommonBundle\Component\Controller\Plugin\Paginator'                               => __DIR__ . '/src/Component/Controller/Plugin/Paginator.php',
    'CommonBundle\Component\Controller\Request\Exception\NoXmlHttpRequestException'    => __DIR__ . '/src/Component/Controller/Request/Exception/NoXmlHttpRequestException.php',
    'CommonBundle\Component\Document\Generator\Pdf'                                    => __DIR__ . '/src/Component/Document/Generator/Pdf.php',
    'CommonBundle\Component\FlashMessenger\FlashMessage'                               => __DIR__ . '/src/Component/FlashMessenger/FlashMessage.php',
    'CommonBundle\Component\Form\Admin\Decorator\ButtonDecorator'                      => __DIR__ . '/src/Component/Form/Admin/Decorator/ButtonDecorator.php',
    'CommonBundle\Component\Form\Admin\Decorator\DivSpanWrapper'                       => __DIR__ . '/src/Component/Form/Admin/Decorator/DivSpanWrapper.php',
    'CommonBundle\Component\Form\Admin\Decorator\FieldDecorator'                       => __DIR__ . '/src/Component/Form/Admin/Decorator/FieldDecorator.php',
    'CommonBundle\Component\Form\Admin\Decorator\FileDecorator'                        => __DIR__ . '/src/Component/Form/Admin/Decorator/FileDecorator.php',
    'CommonBundle\Component\Form\Admin\Form'                                           => __DIR__ . '/src/Component/Form/Admin/Form.php',
    'CommonBundle\Component\Form\Bootstrap\Decorator\Errors'                           => __DIR__ . '/src/Component/Form/Bootstrap/Decorator/Errors.php',
    'CommonBundle\Component\Form\Bootstrap\DisplayGroup\Actions'                       => __DIR__ . '/src/Component/Form/Bootstrap/DisplayGroup/Actions.php',
    'CommonBundle\Component\Form\Bootstrap\Element\Button'                             => __DIR__ . '/src/Component/Form/Bootstrap/Element/Button.php',
    'CommonBundle\Component\Form\Bootstrap\Element\Password'                           => __DIR__ . '/src/Component/Form/Bootstrap/Element/Password.php',
    'CommonBundle\Component\Form\Bootstrap\Element\Reset'                              => __DIR__ . '/src/Component/Form/Bootstrap/Element/Reset.php',
    'CommonBundle\Component\Form\Bootstrap\Element\Submit'                             => __DIR__ . '/src/Component/Form/Bootstrap/Element/Submit.php',
    'CommonBundle\Component\Form\Bootstrap\Element\Text'                               => __DIR__ . '/src/Component/Form/Bootstrap/Element/Text.php',
    'CommonBundle\Component\Form\Bootstrap\Element'                                    => __DIR__ . '/src/Component/Form/Bootstrap/Element.php',
    'CommonBundle\Component\Form\Bootstrap\Form'                                       => __DIR__ . '/src/Component/Form/Bootstrap/Form.php',
    'CommonBundle\Component\Util\AcademicYear'                                         => __DIR__ . '/src/Component/Util/AcademicYear.php',
    'CommonBundle\Component\Util\Exception\InvalidArgumentException'                   => __DIR__ . '/src/Component/Util/Exception/InvalidArgumentException.php',
    'CommonBundle\Component\Util\File\Exception\FailedToOpenException'                 => __DIR__ . '/src/Component/Util/File/Exception/FailedToOpenException.php',
    'CommonBundle\Component\Util\File\Exception\TmpFileClosedException'                => __DIR__ . '/src/Component/Util/File/Exception/TmpFileClosedException.php',
    'CommonBundle\Component\Util\File\TmpFile'                                         => __DIR__ . '/src/Component/Util/File/TmpFile.php',
    'CommonBundle\Component\Util\File'                                                 => __DIR__ . '/src/Component/Util/File.php',
    'CommonBundle\Component\Util\UTF8'                                                 => __DIR__ . '/src/Component/Util/UTF8.php',
    'CommonBundle\Component\Util\Xml\Exception\InvalidArgumentException'               => __DIR__ . '/src/Component/Util/Xml/Exception/InvalidArgumentException.php',
    'CommonBundle\Component\Util\Xml\Generator'                                        => __DIR__ . '/src/Component/Util/Xml/Generator.php',
    'CommonBundle\Component\Util\Xml\Object'                                           => __DIR__ . '/src/Component/Util/Xml/Object.php',
    'CommonBundle\Component\Validator\PhoneNumber'                                     => __DIR__ . '/src/Component/Validator/PhoneNumber.php',
    'CommonBundle\Component\Validator\Price'                                           => __DIR__ . '/src/Component/Validator/Price.php',
    'CommonBundle\Component\Validator\Username'                                        => __DIR__ . '/src/Component/Validator/Username.php',
    'CommonBundle\Component\Validator\ValidUsername'                                   => __DIR__ . '/src/Component/Validator/ValidUsername.php',
    'CommonBundle\Component\Validator\Year'                                            => __DIR__ . '/src/Component/Validator/Year.php',
    'CommonBundle\Component\View\Helper\Exception\RuntimeException'                    => __DIR__ . '/src/Component/View/Helper/Exception/RuntimeException.php',
    'CommonBundle\Component\View\Helper\GetParam'                                      => __DIR__ . '/src/Component/View/Helper/GetParam.php',
    'CommonBundle\Component\View\Helper\HasAccess'                                     => __DIR__ . '/src/Component/View/Helper/HasAccess.php',
    'CommonBundle\Component\WebSocket\Frame'                                           => __DIR__ . '/src/Component/WebSocket/Frame.php',
    'CommonBundle\Component\WebSocket\Server'                                          => __DIR__ . '/src/Component/WebSocket/Server.php',
    'CommonBundle\Component\WebSocket\User'                                            => __DIR__ . '/src/Component/WebSocket/User.php',
    'CommonBundle\Controller\Admin\AuthController'                                     => __DIR__ . '/src/Controller/Admin/AuthController.php',
    'CommonBundle\Controller\Admin\ConfigController'                                   => __DIR__ . '/src/Controller/Admin/ConfigController.php',
    'CommonBundle\Controller\Admin\DashboardController'                                => __DIR__ . '/src/Controller/Admin/DashboardController.php',
    'CommonBundle\Controller\Admin\RoleController'                                     => __DIR__ . '/src/Controller/Admin/RoleController.php',
    'CommonBundle\Controller\Admin\UserController'                                     => __DIR__ . '/src/Controller/Admin/UserController.php',
    'CommonBundle\Controller\ErrorController'                                          => __DIR__ . '/src/Controller/ErrorController.php',
    'CommonBundle\Entity\Acl\Action'                                                   => __DIR__ . '/src/Entity/Acl/Action.php',
    'CommonBundle\Entity\Acl\Resource'                                                 => __DIR__ . '/src/Entity/Acl/Resource.php',
    'CommonBundle\Entity\Acl\Role'                                                     => __DIR__ . '/src/Entity/Acl/Role.php',
    'CommonBundle\Entity\General\Bank\BankDevice\Amount'                               => __DIR__ . '/src/Entity/General/Bank/BankDevice/Amount.php',
    'CommonBundle\Entity\General\Bank\BankDevice'                                      => __DIR__ . '/src/Entity/General/Bank/BankDevice.php',
    'CommonBundle\Entity\General\Bank\CashRegister'                                    => __DIR__ . '/src/Entity/General/Bank/CashRegister.php',
    'CommonBundle\Entity\General\Bank\MoneyUnit\Amount'                                => __DIR__ . '/src/Entity/General/Bank/MoneyUnit/Amount.php',
    'CommonBundle\Entity\General\Bank\MoneyUnit'                                       => __DIR__ . '/src/Entity/General/Bank/MoneyUnit.php',
    'CommonBundle\Entity\General\Config'                                               => __DIR__ . '/src/Entity/General/Config.php',
    'CommonBundle\Entity\Users\Barcode'                                                => __DIR__ . '/src/Entity/Users/Barcode.php',
    'CommonBundle\Entity\Users\Credential'                                             => __DIR__ . '/src/Entity/Users/Credential.php',
    'CommonBundle\Entity\Users\People\Academic'                                        => __DIR__ . '/src/Entity/Users/People/Academic.php',
    'CommonBundle\Entity\Users\People\Corporate'                                       => __DIR__ . '/src/Entity/Users/People/Corporate.php',
    'CommonBundle\Entity\Users\Person'                                                 => __DIR__ . '/src/Entity/Users/Person.php',
    'CommonBundle\Entity\Users\Session'                                                => __DIR__ . '/src/Entity/Users/Session.php',
    'CommonBundle\Entity\Users\Statuses\Corporate'                                     => __DIR__ . '/src/Entity/Users/Statuses/Corporate.php',
    'CommonBundle\Entity\Users\Statuses\Union'                                         => __DIR__ . '/src/Entity/Users/Statuses/Union.php',
    'CommonBundle\Entity\Users\Statuses\University'                                    => __DIR__ . '/src/Entity/Users/Statuses/University.php',
    'CommonBundle\Form\Admin\Auth\Login'                                               => __DIR__ . '/src/Form/Admin/Auth/Login.php',
    'CommonBundle\Form\Admin\Config\Add'                                               => __DIR__ . '/src/Form/Admin/Config/Add.php',
    'CommonBundle\Form\Admin\Config\Edit'                                              => __DIR__ . '/src/Form/Admin/Config/Edit.php',
    'CommonBundle\Form\Admin\Role\Add'                                                 => __DIR__ . '/src/Form/Admin/Role/Add.php',
    'CommonBundle\Form\Admin\Role\Edit'                                                => __DIR__ . '/src/Form/Admin/Role/Edit.php',
    'CommonBundle\Form\Admin\User\Add'                                                 => __DIR__ . '/src/Form/Admin/User/Add.php',
    'CommonBundle\Form\Admin\User\Edit'                                                => __DIR__ . '/src/Form/Admin/User/Edit.php',
    'CommonBundle\Form\Auth\Login'                                                     => __DIR__ . '/src/Form/Auth/Login.php',
    'CommonBundle\Repository\Acl\Action'                                               => __DIR__ . '/src/Repository/Acl/Action.php',
    'CommonBundle\Repository\Acl\Resource'                                             => __DIR__ . '/src/Repository/Acl/Resource.php',
    'CommonBundle\Repository\Acl\Role'                                                 => __DIR__ . '/src/Repository/Acl/Role.php',
    'CommonBundle\Repository\General\Bank\BankDevice\Amount'                           => __DIR__ . '/src/Repository/General/Bank/BankDevice/Amount.php',
    'CommonBundle\Repository\General\Bank\BankDevice'                                  => __DIR__ . '/src/Repository/General/Bank/BankDevice.php',
    'CommonBundle\Repository\General\Bank\CashRegister'                                => __DIR__ . '/src/Repository/General/Bank/CashRegister.php',
    'CommonBundle\Repository\General\Bank\MoneyUnit\MoneyUnitAmount'                   => __DIR__ . '/src/Repository/General/Bank/MoneyUnit/Amount.php',
    'CommonBundle\Repository\General\Bank\MoneyUnit'                                   => __DIR__ . '/src/Repository/General/Bank/MoneyUnit.php',
    'CommonBundle\Repository\General\Config'                                           => __DIR__ . '/src/Repository/General/Config.php',
    'CommonBundle\Repository\Users\Barcode'                                            => __DIR__ . '/src/Repository/Users/Barcode.php',
    'CommonBundle\Repository\Users\Credential'                                         => __DIR__ . '/src/Repository/Users/Credential.php',
    'CommonBundle\Repository\Users\People\Academic'                                    => __DIR__ . '/src/Repository/Users/People/Academic.php',
    'CommonBundle\Repository\Users\People\Corporate'                                   => __DIR__ . '/src/Repository/Users/People/Corporate.php',
    'CommonBundle\Repository\Users\Person'                                             => __DIR__ . '/src/Repository/Users/Person.php',
    'CommonBundle\Repository\Users\Session'                                            => __DIR__ . '/src/Repository/Users/Session.php',
    'CommonBundle\Repository\Users\Statuses\Corporate'                                 => __DIR__ . '/src/Repository/Users/Statuses/Corporate.php',
    'CommonBundle\Repository\Users\Statuses\Union'                                     => __DIR__ . '/src/Repository/Users/Statuses/Union.php',
    'CommonBundle\Repository\Users\Statuses\University'                                => __DIR__ . '/src/Repository/Users/Statuses/University.php',
);