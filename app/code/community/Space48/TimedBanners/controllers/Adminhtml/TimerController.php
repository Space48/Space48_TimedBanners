<?php
/**
 * @category   Space48
 * @package    Space48_TimedBanners
 * @author     Dusan Lukic <ldusan84@gmail.com>
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
class Space48_TimedBanners_Adminhtml_TimerController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('space48timer/banner')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Space48 Timer'), Mage::helper('adminhtml')->__('Banner Manager'));

        return $this;
    }

    public function indexAction()
    {
        $this->_initAction()
            ->renderLayout();
    }

    public function editAction()
    {
        $id     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('space48timer/banner')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('space48timer_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('space48timer/banner')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Space48 Timer'), Mage::helper('adminhtml')->__('Banner Manager'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('space48timer/adminhtml_timer_edit'))
                ->_addLeft($this->getLayout()->createBlock('space48timer/adminhtml_timer_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('space48timer')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                // check date
                if (strtotime($data['start_date']) > strtotime($data['end_date'])) {
                    throw new Exception('Start date must be before end date');
                }

                if (isset($_FILES['background_image']['name']) && $_FILES['background_image']['name'] != '') {
                    try {
                        $uploader = new Varien_File_Uploader('background_image');
                           $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                        $uploader->setAllowRenameFiles(false);
                        $uploader->setFilesDispersion(false);
                        $path = Mage::getBaseDir('media') . DS . 'space48timer';
                        $uploader->save($path, $_FILES['background_image']['name']);
                    } catch (Exception $e) {
                    }
                      $data['background_image'] = 'space48timer/'.$_FILES['background_image']['name'];
                } else {
                    if (isset($data['background_image']['delete']) && $data['background_image']['delete'] == 1) {
                        $data['background_image'] = '';
                    } else {
                        unset($data['background_image']);
                    }
                }

                $model = Mage::getModel('space48timer/banner');
                $model->setData($data)
                    ->setId($this->getRequest()->getParam('id'));
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('space48timer')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));

                    return;
                }
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('space48timer')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('space48timer/space48timer');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));

                return;
            }
        }
        $this->_redirect('*/*/');
    }
    
    
    public function massDeleteAction() {
        $bannerIds = $this->getRequest()->getParam('space48timer');
        if(!is_array($bannerIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($bannerIds as $bannerId) {
                    $banner = Mage::getModel('space48timer/banner')->load($bannerId);
                    $banner->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($bannerIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

}
