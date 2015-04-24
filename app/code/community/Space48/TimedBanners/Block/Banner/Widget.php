<?php
/**
 * @category   Space48
 * @package    Space48_TimedBanners
 * @author     Dusan Lukic <ldusan84@gmail.com>
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
class Space48_TimedBanners_Block_Banner_Widget extends Mage_Core_Block_Template implements Mage_Widget_Block_Interface
{

    protected function _construct()
    {
        $this->setTemplate('space48/timer/banner.phtml');
        
        parent::_construct();

        $this->addData(array(
            'cache_lifetime'    => 1,
            'cache_tags'        => array(Mage_Catalog_Model_Product::CACHE_TAG),
        ));
    }

    public function getCacheKeyInfo()
    {
        $info = parent::getCacheKeyInfo();
        if ($id = $this->getData('unique_id')) {
            $info['unique_id'] =  (string) $id;
        }

        return $info;
    }

    /**
     * Returns selected active banner
     *
     * @return Space48_TimedBanners_Model_Banner
     */
    public function getActiveBanner()
    {
        return Mage::getModel('space48timer/banner')->load($this->getData('active'));
    }

    /**
     * Returns selected non-active banner
     *
     * @return Space48_Timer_Model_Banner
     */
    public function getNonactiveBanner()
    {
        return Mage::getModel('space48timer/banner')->load($this->getData('nonactive'));
    }
}
