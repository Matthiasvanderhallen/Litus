<?php
return array(
    'CudiBundle\Module'                                     => __DIR__ . '/Module.php',
    'CudiBundle\Component\Controller\SaleController'        => __DIR__ . '/src/Component/Controller/SaleController.php',
    'CudiBundle\Component\Document\Generator\OrderPdf'      => __DIR__ . '/src/Component/Document/Generator/OrderPdf.php',
    'CudiBundle\Component\Document\Generator\OrderXml'      => __DIR__ . '/src/Component/Document/Generator/OrderXml.php',
    'CudiBundle\Component\Validator\ArticleBarcode'         => __DIR__ . '/src/Component/Validator/ArticleBarcode.php',
    'CudiBundle\Component\Validator\Barcode'                => __DIR__ . '/src/Component/Validator/Barcode.php',
    'CudiBundle\Component\Validator\UniqueArticleBarcode'   => __DIR__ . '/src/Component/Validator/UniqueArticleBarcode.php',
    'CudiBundle\Component\WebSocket\Sale\Queue'             => __DIR__ . '/src/Component/WebSocket/Sale/Queue.php',
    'CudiBundle\Controller\Admin\ArticleController'         => __DIR__ . '/src/Controller/Admin/ArticleController.php',
    'CudiBundle\Controller\Admin\BookingController'         => __DIR__ . '/src/Controller/Admin/BookingController.php',
    'CudiBundle\Controller\Admin\DeliveryController'        => __DIR__ . '/src/Controller/Admin/DeliveryController.php',
    'CudiBundle\Controller\Admin\FileController'            => __DIR__ . '/src/Controller/Admin/FileController.php',
    'CudiBundle\Controller\Admin\FinancialController'       => __DIR__ . '/src/Controller/Admin/FinancialController.php',
    'CudiBundle\Controller\Admin\InstallerController'       => __DIR__ . '/src/Controller/Admin/InstallerController.php',
    'CudiBundle\Controller\Admin\OrderController'           => __DIR__ . '/src/Controller/Admin/OrderController.php',
    'CudiBundle\Controller\Admin\SaleController'            => __DIR__ . '/src/Controller/Admin/SaleController.php',
    'CudiBundle\Controller\Admin\FinancialController'       => __DIR__ . '/src/Controller/Admin/FinancialController.php',
    'CudiBundle\Controller\Admin\StockController'           => __DIR__ . '/src/Controller/Admin/StockController.php',
    'CudiBundle\Controller\Sale\QueueController'            => __DIR__ . '/src/Controller/Sale/QueueController.php',
    'CudiBundle\Controller\Sale\SaleController'             => __DIR__ . '/src/Controller/Sale/SaleController.php',
    'CudiBundle\Entity\Article'                             => __DIR__ . '/src/Entity/Article.php',
    'CudiBundle\Entity\Articles\ArticleHistory'             => __DIR__ . '/src/Entity/Articles/ArticleHistory.php',
    'CudiBundle\Entity\Articles\MetaInfo'                   => __DIR__ . '/src/Entity/Articles/MetaInfo.php',
    'CudiBundle\Entity\Articles\Stock'                      => __DIR__ . '/src/Entity/Articles/Stock.php',
    'CudiBundle\Entity\Articles\StockArticles\Binding'      => __DIR__ . '/src/Entity/Articles/StockArticles/Binding.php',
    'CudiBundle\Entity\Articles\StockArticles\Color'        => __DIR__ . '/src/Entity/Articles/StockArticles/Color.php',
    'CudiBundle\Entity\Articles\StockArticles\External'     => __DIR__ . '/src/Entity/Articles/StockArticles/External.php',
    'CudiBundle\Entity\Articles\StockArticles\Internal'     => __DIR__ . '/src/Entity/Articles/StockArticles/Internal.php',
    'CudiBundle\Entity\Articles\Stub'                       => __DIR__ . '/src/Entity/Articles/Stub.php',
    'CudiBundle\Entity\ArticleSubjectMap'                   => __DIR__ . '/src/Entity/ArticleSubjectMap.php',
    'CudiBundle\Entity\File'                                => __DIR__ . '/src/Entity/File.php',
    'CudiBundle\Entity\InventoryMap'                        => __DIR__ . '/src/Entity/InventoryMap.php',
    'CudiBundle\Entity\SaleApp\PollingData'                 => __DIR__ . '/src/Entity/SaleApp/PollingData.php',
    'CudiBundle\Entity\Sales\Booking'                       => __DIR__ . '/src/Entity/Sales/Booking.php',
    'CudiBundle\Entity\Sales\PayDesk'                       => __DIR__ . '/src/Entity/Sales/PayDesk.php',
    'CudiBundle\Entity\Sales\SaleItem'                      => __DIR__ . '/src/Entity/Sales/SaleItem.php',
    'CudiBundle\Entity\Sales\ServingQueueItem'              => __DIR__ . '/src/Entity/Sales/ServingQueueItem.php',
    'CudiBundle\Entity\Sales\ServingQueueStatus'            => __DIR__ . '/src/Entity/Sales/ServingQueueStatus.php',
    'CudiBundle\Entity\Sales\Session'                       => __DIR__ . '/src/Entity/Sales/Session.php',
    'CudiBundle\Entity\Stock\DeliveryItem'                  => __DIR__ . '/src/Entity/Stock/DeliveryItem.php',
    'CudiBundle\Entity\Stock\Order'                         => __DIR__ . '/src/Entity/Stock/Order.php',
    'CudiBundle\Entity\Stock\OrderItem'                     => __DIR__ . '/src/Entity/Stock/OrderItem.php',
    'CudiBundle\Entity\Stock\StockItem'                     => __DIR__ . '/src/Entity/Stock/StockItem.php',
    'CudiBundle\Entity\Supplier'                            => __DIR__ . '/src/Entity/Supplier.php',
    'CudiBundle\Form\Admin\Article\Add'                     => __DIR__ . '/src/Form/Admin/Article/Add.php',
    'CudiBundle\Form\Admin\Article\Edit'                    => __DIR__ . '/src/Form/Admin/Article/Edit.php',
    'CudiBundle\Form\Admin\Article\NewVersion'              => __DIR__ . '/src/Form/Admin/Article/NewVersion.php',
    'CudiBundle\Form\Admin\Booking\Add'                     => __DIR__ . '/src/Form/Admin/Booking/Add.php',
    'CudiBundle\Form\Admin\Delivery\Add'                    => __DIR__ . '/src/Form/Admin/Delivery/Add.php',
    'CudiBundle\Form\Admin\Delivery\AddDirect'              => __DIR__ . '/src/Form/Admin/Delivery/AddDirect.php',
    'CudiBundle\Form\Admin\File\File'                       => __DIR__ . '/src/Form/Admin/File/File.php',
    'CudiBundle\Form\Admin\Order\Add'                       => __DIR__ . '/src/Form/Admin/Order/Add.php',
    'CudiBundle\Form\Admin\Order\AddDirect'                 => __DIR__ . '/src/Form/Admin/Order/AddDirect.php',
    'CudiBundle\Form\Admin\Sale\CashRegisterAdd'            => __DIR__ . '/src/Form/Admin/Sale/CashRegisterAdd.php',
    'CudiBundle\Form\Admin\Sale\CashRegisterClose'          => __DIR__ . '/src/Form/Admin/Sale/CashRegisterClose.php',
    'CudiBundle\Form\Admin\Sale\CashRegisterEdit'           => __DIR__ . '/src/Form/Admin/Sale/CashRegisterEdit.php',
    'CudiBundle\Form\Admin\Sale\SessionComment'             => __DIR__ . '/src/Form/Admin/Sale/SessionComment.php',
    'CudiBundle\Form\Admin\Stock\Update'                    => __DIR__ . '/src/Form/Admin/Stock/Update.php',
    'CudiBundle\Form\Sale\Queue\SignIn'                     => __DIR__ . '/src/Form/Sale/Queue/SignIn.php',
    'CudiBundle\Form\Sale\Sale\ReturnBooking'               => __DIR__ . '/src/Form/Sale/Sale/ReturnBooking.php',
    'CudiBundle\Repository\Article'                         => __DIR__ . '/src/Repository/Article.php',
    'CudiBundle\Repository\Articles\ArticleHistory'         => __DIR__ . '/src/Repository/Articles/ArticleHistory.php',
    'CudiBundle\Repository\Articles\MetaInfo'               => __DIR__ . '/src/Repository/Articles/MetaInfo.php',
    'CudiBundle\Repository\Articles\Stock'                  => __DIR__ . '/src/Repository/Articles/Stock.php',
    'CudiBundle\Repository\Articles\StockArticles\Binding'  => __DIR__ . '/src/Repository/Articles/StockArticles/Binding.php',
    'CudiBundle\Repository\Articles\StockArticles\Color'    => __DIR__ . '/src/Repository/Articles/StockArticles/Color.php',
    'CudiBundle\Repository\Articles\StockArticles\External' => __DIR__ . '/src/Repository/Articles/StockArticles/External.php',
    'CudiBundle\Repository\Articles\StockArticles\Internal' => __DIR__ . '/src/Repository/Articles/StockArticles/Internal.php',
    'CudiBundle\Repository\Articles\Stub'                   => __DIR__ . '/src/Repository/Articles/Stub.php',
    'CudiBundle\Repository\ArticleSubjectMap'               => __DIR__ . '/src/Repository/ArticleSubjectMap.php',
    'CudiBundle\Repository\File'                            => __DIR__ . '/src/Repository/File.php',
    'CudiBundle\Repository\InventoryMap'                    => __DIR__ . '/src/Repository/InventoryMap.php',
    'CudiBundle\Repository\SaleApp\PollingData'             => __DIR__ . '/src/Repository/SaleApp/PollingData.php',
    'CudiBundle\Repository\Sales\Booking'                   => __DIR__ . '/src/Repository/Sales/Booking.php',
    'CudiBundle\Repository\Sales\PayDesk'                   => __DIR__ . '/src/Repository/Sales/PayDesk.php',
    'CudiBundle\Repository\Sales\SaleItem'                  => __DIR__ . '/src/Repository/Sales/SaleItem.php',
    'CudiBundle\Repository\Sales\ServingQueueItem'          => __DIR__ . '/src/Repository/Sales/ServingQueueItem.php',
    'CudiBundle\Repository\Sales\ServingQueueStatus'        => __DIR__ . '/src/Repository/Sales/ServingQueueStatus.php',
    'CudiBundle\Repository\Sales\Session'                   => __DIR__ . '/src/Repository/Sales/Session.php',
    'CudiBundle\Repository\Stock\DeliveryItem'              => __DIR__ . '/src/Repository/Stock/DeliveryItem.php',
    'CudiBundle\Repository\Stock\Order'                     => __DIR__ . '/src/Repository/Stock/Order.php',
    'CudiBundle\Repository\Stock\OrderItem'                 => __DIR__ . '/src/Repository/Stock/OrderItem.php',
    'CudiBundle\Repository\Stock\StockItem'                 => __DIR__ . '/src/Repository/Stock/StockItem.php',
    'CudiBundle\Repository\Supplier'                        => __DIR__ . '/src/Repository/Supplier.php',
);
