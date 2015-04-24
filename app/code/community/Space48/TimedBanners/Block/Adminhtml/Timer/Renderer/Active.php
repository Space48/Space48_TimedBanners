<?php
/**
 * @category   Space48
 * @package    Space48_TimedBanners
 * @author     Dusan Lukic <ldusan84@gmail.com>
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
class Space48_TimedBanners_Block_Adminhtml_Timer_Renderer_Active extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Renders row returning active or non active
     *
     * @param Varien_Object $row
     *
     * @return string
     */
    public function render(Varien_Object $row)
    {
        if ($row['active'] == 1) {
            return Mage::helper('space48timer')->__('Active');
        }

        return Mage::helper('space48timer')->__('Non active');
    }
}
