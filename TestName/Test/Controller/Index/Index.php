<?php
namespace TestName\Test\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('customer_address_entity');
        $fields = array('entity_id','firstname', 'lastname', 'company');

        $sql = $connection->select()
            ->from($tableName, $fields);

        $results = $connection->fetchAll($sql);


        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Clients'));
        $this->_view->getLayout()->getBlock('testname_test_block_test')->setData('clients', $results);
        return $resultPage;

    }

}