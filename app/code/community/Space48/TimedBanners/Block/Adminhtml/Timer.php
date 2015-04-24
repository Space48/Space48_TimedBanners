<?php
/**
 * @category   Space48
 * @package    Space48_TimedBanners
 * @author     Dusan Lukic <ldusan84@gmail.com>
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
class Space48_TimedBanners_Block_Adminhtml_Timer extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_timer';
        $this->_blockGroup = 'space48timer';
        $this->_headerText = Mage::helper('space48timer')->__('Banner Manager');
        $this->_addButtonLabel = Mage::helper('space48timer')->__('Add Banner');
        parent::__construct();
    }
}
