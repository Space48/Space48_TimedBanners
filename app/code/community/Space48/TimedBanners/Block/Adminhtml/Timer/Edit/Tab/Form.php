<?php
/**
 * @category   Space48
 * @package    Space48_TimedBanners
 * @author     Dusan Lukic <ldusan84@gmail.com>
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
class Space48_TimedBanners_Block_Adminhtml_Timer_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $dateFormatIso = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_FULL);

        $fieldset = $form->addFieldset('space48timer_form', array('legend'=>Mage::helper('space48timer')->__('Banner information')));

        $fieldset->addField('name', 'text', array(
            'label'		=> Mage::helper('space48timer')->__('Name'),
            'name'		=> 'name',
            'required'	=> true,
        ));

        $fieldset->addField('background_image', 'image', array(
            'label'     => Mage::helper('space48timer')->__('Background Image'),
            'name'      => 'background_image',
            'required'  => true,
        ));

        $fieldset->addField('active', 'select', array(
            'label'     => Mage::helper('space48timer')->__('Active'),
            'name'      => 'active',
            'required'  => true,
            'values'    => array('0' => 'Non-Active', '1' => 'Active')
        ));
        
        $fieldset->addField('start_date', 'date', array(
                'label'     => Mage::helper('space48timer')->__('Start Date'),
                'name'      => 'start_date',
                'required'  => false,
                'image'     => $this->getSkinUrl('images/grid-cal.gif'),
                'format'    => $dateFormatIso
        ));
        
        $fieldset->addField('end_date', 'date', array(
                'label'     => Mage::helper('space48timer')->__('End Date'),
                'name'      => 'end_date',
                'required'  => false,
                'image'     => $this->getSkinUrl('images/grid-cal.gif'),
                'format'    => $dateFormatIso
        ));
        
        if ( Mage::getSingleton('adminhtml/session')->getSpace48timerData() ) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getSpace48timerData());
            Mage::getSingleton('adminhtml/session')->getSpace48timerData(null);
        } elseif ( Mage::registry('space48timer_data') ) {
            $form->setValues(Mage::registry('space48timer_data')->getData());
        }

        return parent::_prepareForm();
    }
}
