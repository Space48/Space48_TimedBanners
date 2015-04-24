<?php
/**
 * @category   Space48
 * @package    Space48_TimedBanners
 * @author     Dusan Lukic <ldusan84@gmail.com>
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
class Space48_TimedBanners_Block_Adminhtml_Timer_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('space48timerGrid');
        $this->setDefaultSort('banner_id');
        $this->setDefaultDir('ASC');
        //$this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('space48timer/banner_collection');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('banner_id', array(
            'header'    => Mage::helper('space48timer')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'banner_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('space48timer')->__('Name'),
            'align'     =>'left',
            'index'     => 'name',
        ));

        $this->addColumn('start_date', array(
            'header'    => Mage::helper('space48timer')->__('Start Date'),
            'align'     => 'left',
            'index'     => 'start_date',
            'type'      => 'date',
            'format'    => 'MMM d, Y',
            'renderer'  => 'Space48_TimedBanners_Block_Adminhtml_Timer_Renderer_Startdate'
        ));

        $this->addColumn('end_date', array(
            'header'	=> Mage::helper('space48timer')->__('End Date'),
            'align'	=> 'left',
            'index'	=> 'end_date',
            'type'    => 'date',
            'format'  => 'MMM d, Y',
            'renderer'=> 'Space48_TimedBanners_Block_Adminhtml_Timer_Renderer_Enddate'
        ));

        $this->addColumn('active', array(
            'header'		=> Mage::helper('space48timer')->__('Type'),
            'align'		=> 'left',
            'index'		=> 'active',
            'renderer'	=> 'Space48_TimedBanners_Block_Adminhtml_Timer_Renderer_Active'
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('banner_id');
        $this->getMassactionBlock()->setFormFieldName('space48timer');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('space48timer')->__('Delete'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('space48timer')->__('Are you sure?')
        ));

        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
