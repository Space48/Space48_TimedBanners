<?php
/**
 * @category   Space48
 * @package    Space48_TimedBanners
 * @author     Dusan Lukic <ldusan84@gmail.com>
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
class Space48_TimedBanners_Model_Mysql4_Banner extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('space48timer/banners', 'banner_id');
    }

    public function load(Mage_Core_Model_Abstract $object, $value, $field=null)
    {
        if (!intval($value) && is_string($value)) {
            $field = 'banner_id';
        }

        return parent::load($object, $value, $field);
    }
}
