<?php
/**
 * @category   Space48
 * @package    Space48_TimedBanners
 * @author     Dusan Lukic <ldusan84@gmail.com>
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
class Space48_TimedBanners_Model_Banner extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('space48timer/banner');
    }
}
