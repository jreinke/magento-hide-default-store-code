# This module allows you to hide default store code from URLs

![Magento Hide Default Store Code](http://i.imgur.com/FVuZL5f.png)

## Feature

http://www.example.com/default/shoes.html

_becomes_

http://www.example.com/shoes.html

## Installation

### Magento CE 1.8.x, 1.9.x

Install with [modgit](https://github.com/jreinke/modgit):

    $ cd /path/to/magento
    $ modgit init
    $ modgit clone hide_store https://github.com/jreinke/magento-hide-default-store-code.git

or download package manually:

* Download latest version [here](https://github.com/jreinke/magento-hide-default-store-code/archive/master.zip)
* Unzip in Magento root folder
* Clear cache
* Logout from admin then login again to access module configuration

## Configuration

* Go to "System > Configuration > Web > Url Options"
* Enable both "Add Store Code to Urls" and "Hide Default Store Code" options
* Clear cache

Other Magento extensions available on [www.bubbleshop.net](https://www.bubbleshop.net/)