<?php
/**
 * @category   Space48
 * @package    Space48_TimedBanners
 * @author     Dusan Lukic <ldusan84@gmail.com>
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
class Space48_TimedBanners_Block_Adminhtml_Timer_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'space48timer';
        $this->_controller = 'adminhtml_timer';

        $this->_updateButton('save', 'label', Mage::helper('space48timer')->__('Save Banner'));
        $this->_updateButton('delete', 'label', Mage::helper('space48timer')->__('Delete Banner'));
        $slideId = Mage::registry('space48timer_data')->getId();

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor()
            {
                if (tinyMCE.getInstanceById('space48timer_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'space48timer_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'space48timer_content');
                }
            }

            function saveAndContinueEdit()
            {
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if ( Mage::registry('space48timer_data') && Mage::registry('space48timer_data')->getId() ) {
            return Mage::helper('space48timer')->__("Edit Banner '%s'", $this->htmlEscape(Mage::registry('space48timer_data')->getTitle()));
        } else {
            return Mage::helper('space48timer')->__('Add Banner');
        }
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
}
