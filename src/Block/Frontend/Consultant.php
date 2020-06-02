<?php

namespace Retailcrm\Retailcrm\Block\Frontend;

class Consultant extends \Magento\Framework\View\Element\Template
{
    private $helper;
    private $storeResolver;
    private $js = '';

    /**
     * DaemonCollector constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Store\Api\StoreResolverInterface $storeResolver
     * @param \Retailcrm\Retailcrm\Helper\Data $helper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Api\StoreResolverInterface $storeResolver,
        \Retailcrm\Retailcrm\Helper\Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->storeResolver = $storeResolver;
        $this->helper = $helper;
    }

    /**
     * @return string
     */
    public function getJs()
    {
        return $this->js;
    }

    /**
     * @return $this
     */
    public function buildScript()
    {
        try {
            $this->js = $this->helper->getConsultantScript(
                $this->_storeManager->getStore(
                    $this->storeResolver->getCurrentStoreId()
                )->getWebsiteId()
            );
        } catch (\Magento\Framework\Exception\NoSuchEntityException $entityException) {
            return $this;
        }

        return $this;
    }
}
