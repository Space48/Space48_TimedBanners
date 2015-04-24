<?php
/**
 * @category   Space48
 * @package    Space48_TimedBanners
 * @author     Dusan Lukic <ldusan84@gmail.com>
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
class Space48_TimedBanners_Block_Adminhtml_Timer_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('space48timer_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('space48timer')->__('Banner Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('space48timer')->__('Banner Information'),
          'title'     => Mage::helper('space48timer')->__('Banner Information'),
          'content'   => $this->getLayout()->createBlock('space48timer/adminhtml_timer_edit_tab_form')->toHtml(),
      ));

      return parent::_beforeToHtml();
  }
}
