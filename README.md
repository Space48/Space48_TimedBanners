#Space48 Timed Banners
=====================

##Description
-----------
Timed banners allow a banner image to be used along side a countdown timer, the module works by overlaying the countdown timer over the banner image, the countdown timer is in real time and dynamically counts down the time to an end date. The countdown is displayed in the format of 'Day Hour Minutes Seconds'



##Requirements
------------
- PHP >= 5.2.0
- Mage_Core


##Compatibility
-------------
Magento >= 1.4

##Tested
-------------
Enterprise 1.13

##Installation Instructions
-------------------------
To install the module copy the app and skin folder to the root directory of the site.

A banner needs to be created that allows an area on the image where the timer can be overlayed this will provide a blank area on the image for 'Days, Hours, Minutes, Seconds'

###Setup:
* Go to the magento admin of the site.
* To add the timed banner, go to CMS -> Timed Banners Management.
* Click 'Add Banner'
* Give the banner a name, upload the banner image, set to active and enter the period from the start to the end date. The end date will be used as the end time for the countdown.

Finally the output code need to be added to the template file where you want the banner to be visible for example adding the following code:
```php

<div class="timer-container">
	<?php
	echo $this->getLayout()
	          ->createBlock('cms/block')
	          ->setBlockId('banner_timer')
	          ->toHtml();
	?>
</div>

```
to the header file the timed banner will be visible in the header.



##Uninstallation
--------------



##Copyright
---------
(c) 2015 Space48