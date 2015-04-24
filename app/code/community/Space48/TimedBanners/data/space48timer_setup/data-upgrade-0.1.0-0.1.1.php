<?php
//Define the CMS Block
$idsAndTitles = array(
    'banner_timer' => 'Banner timer',

);

$content['banner_timer'] = <<<EOT
{{widget type="space48timer/banner_widget" active="1" nonactive="4" }}
EOT;


//Add / update the Block
$storeId = 0; //all Desktop store

foreach ($idsAndTitles as $id => $title) {
    $cmsBlock = Mage::getModel('cms/block');
    $cmsBlock->setStoreId($storeId)
        ->load($id);
    try {
        if ($cmsBlock->isObjectNew()) {
            $cmsBlock->setIdentifier($id)
                ->setStores(array($storeId))
                ->setIsActive(true)
                ->setTitle($title)
                ->setContent($content[$id])
                ->save();
        } else {
            $cmsBlock->setContent($content[$id])
                ->save();
        }
        $cmsBlock->unsetData('block_id');
    } catch (Exception $e) {

    }
}