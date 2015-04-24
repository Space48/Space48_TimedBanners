<?php
/**
 * @category   Space48
 * @package    Space48_TimedBanners
 * @author     Dusan Lukic <ldusan84@gmail.com>
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
class Space48_TimedBanners_Model_Banner_Options_Active extends Mage_Core_Model_Abstract
{
    public function toOptionArray()
    {
        $banners = $this->_getActiveBanners();

        $options = array();
        foreach ($banners as $banner) {
            $options[] = array('value' => $banner->getId(), 'label' => $banner->getName());
        }

        return $options;
    }

    /**
     * Return all active banners
     *
     * @return Space48_TimedBanners_Model_Mysql4_Banner_Collection
     */
    protected function _getActiveBanners()
    {
        $collection = Mage::getModel('space48timer/banner')->getCollection();
        $collection->getSelect()->where('main_table.active = ? ', 1);

        return $collection;
    }
}
