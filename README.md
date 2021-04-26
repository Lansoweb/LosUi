# LosUI 
[![Build Status](https://travis-ci.org/Lansoweb/LosUi.svg?branch=master)](https://travis-ci.org/Lansoweb/LosUi) [![Latest Stable Version](https://poser.pugx.org/los/losui/v/stable.svg)](https://packagist.org/packages/los/losui) [![Total Downloads](https://poser.pugx.org/los/losui/downloads.svg)](https://packagist.org/packages/los/losui) [![Coverage Status](https://coveralls.io/repos/Lansoweb/LosUi/badge.svg)](https://coveralls.io/r/Lansoweb/LosUi) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Lansoweb/LosUi/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Lansoweb/LosUi/?branch=master) [![SensioLabs Insight](https://img.shields.io/sensiolabs/i/bab31378-77d2-46b3-94df-976c60ed2fe6.svg?style=flat)](https://insight.sensiolabs.com/projects/bab31378-77d2-46b3-94df-976c60ed2fe6) [![Dependency Status](https://www.versioneye.com/user/projects/54da836cc1bbbd5f82000357/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54da836cc1bbbd5f82000357) [![Dependency Status](https://www.versioneye.com/user/projects/54da837ec1bbbd5f8200035e/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54da837ec1bbbd5f8200035e)


## Introduction
This module provides a shortcut to several UI resources from [Bootstrap](http://getbootstrap.com).
 
In the version 2.*, this library provides only method for styling your HTML with bootstrap. 
The previous method (providing the js and css files) had a serious performance issue, 
because if hooked on the end of the request (404 error) to return the required files.

## Requirements
Please see composer.json

## Installation
For composer documentation, please refer to [getcomposer.org](http://getcomposer.org/).

  1. Enter your project directory
  2. Run `php composer.phar require los/losui`
     
## Usage
This module provides two main View Helpers: LosHeadLink and LosHeadScript.

### Jquery
The first argument indicates the use of minified version (default) or not, while the second indicates a specific version of a CDN file.
  
Just add the following to your layout.phtml file:
```php
<?php
echo $this->losHead()->getJquery();
 
//Will use the 2.2.0 unminified version  
echo $this->losHead()->getJquery(false, '2.1.0');
?>
```

It will generate the following html:
```html
<script src="http://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-2.1.0.js" type="text/javascript"></script>
``` 

You can have just the link, for example to pass it to other ViewHelper like HeadLink (from zendframework)
```php
<?php
//Will use the 2.2.0 unminified version  
echo $this->losHead()->getJqueryLink(false, '2.1.0');
?>
```

It will generate only the link:
```
http://code.jquery.com/jquery-2.2.0.js
``` 


### Font Awesome
The first argument indicates the use of minified version (default) or not, while the second indicates a specific version.

Include the stylesheet with:
```php
<?php 
echo $this->losHead()->getFontAwesome();

//Will use the unminified version
echo $this->losHead()->getFontAwesome(false);
 
//Will use the 4.2.0 unminified version  
echo $this->losHead()->getFontAwesome(false, '4.2.0');

// Will return only the css link
echo $this->losHead()->getFontAwesomeLink();
?>
```

It will generate the following html:
```html
<link type="text/css" rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
<link type="text/css" rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css">
https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css
``` 

To use their icon is simple, just use the LosIcon View Helper:
```php
<?= $this->losIcon('fa-user') ?>
```
Will generate:
```html
<i class="fa fa-user"></i>
```

You can pass a second parameter to add any style:
```php
<?= $this->losIcon('fa-user', 'margin-right:4px;float:none') ?>
```
Will generate:
```html
<i class="fa fa-user" style="margin-right:4px;float:none"></i>
```

If you need to add a class, pass it along with the icon:
```php
<?= $this->losIcon('fa-user pull-right') ?>
```
Will generate:
```html
<i class="fa fa-user pull-right"></i>
```

### Bootstrap
The first argument indicates the use of minified version (default) or not, while the second indicates a specific version.

Include the stylesheet with (can use append or prepend)
```php
<?php 
//Will use the minified local version (both css and js)
echo $this->losHead()->addBootstrap();

//Will use the minified version
echo $this->losHead()->addBootstrap(true);

//Will use the 3.3.1 unminified version  
echo $this->losHead()->addBootstrap(true, '3.3.1');

// Will only generate the javascript link
echo $this->losHead()->addBootstrapJs();

// Will only generate the css link
echo $this->losHead()->addBootstrapCss();

// Will only generate the css link url
echo $this->losHead()->addBootstrapCssLink();
?>
```

The first call will generate the following html:
```html
<script src="https://bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" media="screen" href="https://bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://bootstrap/3.3.7/js/bootstrap.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" media="screen" href="https://bootstrap/3.3.7/css/bootstrap.css">

<script src="https://bootstrap/3.3.1/js/bootstrap.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" media="screen" href="https://bootstrap/3.3.1/css/bootstrap.css">

<script src="https://bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>

<link type="text/css" rel="stylesheet" media="screen" href="https://bootstrap/3.3.1/css/bootstrap.css">

https://bootstrap/3.3.1/css/bootstrap.css
``` 

For each section bellow, please refer to the [bootstrap documentation](http://getbootstrap.com) for the classes specifications.

#### Forms
This module provides a Form View Helper that automatically adds bootstrap style to forms. Just use the default form but with the new view helper: 
```php
<?= $this->losForm($form) ?>
```

To make the form [horizontal](http://getbootstrap.com/css/#forms-horizontal), just pass true in the second argument, 
and the number of columns the label will use (default is 2):
```php
<?= $this->losForm($form, true) ?>
<?= $this->losForm($form, true, 4) ?>
```

In the horizontal form, buttons and checkboxes will be aligned with the other fields, not using the label column.
To better style checkboxes and radios, add the following to your stylesheet:
```css
.radio label, .checkbox label {
    padding-right: 20px;
}
```

There is a LosFormRow view helper that prints just a row. It will add all necessary classes, including alerts for form errors.
```php
<?= $this->losFormRow($form->get('password') ?>
```
 
If you need to change the order of the form elements, you can do (example for horizontal form with 4 columns for labels):
```php
<?php
echo $this->losForm()->openTag($form, true);
foreach (['name','gender','email','password','passwordVerify','captcha','newsletter','submit'] as $element) {
    echo $this->losFormRow()->render($form->get($element), true, 4);
}
echo $this->losForm()->closeTag();
?>
```

You can add bootstrap addons to form inputs. Just add the keys "addon-append" or "addon-prepend" to the input options 
and can combine them with icons (both glyphicon and fontawesome):
```php
<?php
array(
	'spec' => array(
	    'type'    => 'Laminas\Form\Element\Text',
    	'name'    => 'price',
    	'options' => array(
        	'label' => 'Price',
        	'addon-append' => '.00',
        	'addon-prepend' => 'glyphicon-usd',
    	),
    ),
),
array(
	'user' => array(
	    'type'    => 'Laminas\Form\Element\Text',
    	'name'    => 'user',
    	'options' => array(
        	'label' => 'User',
        	'addon-prepend' => 'fa-user'
    	),
    ),
),
?>
```

The same for annotations:
```php
<?php
/**
 * @Form\Attributes({"type":"text","placeholder":"Price"})
 * @Form\Options({"label":"Price", "addon-prepend":"glyphicon-usd", "addon-append":".00"})
 */
protected $price;
?>
```

```php
<?php
array(
	'spec' => array(
	    'type'    => 'Laminas\Form\Element\Text',
    	'name'    => 'price',
    	'options' => array(
        	'label' => 'Price',
        	'addon-append' => '.00',
        	'addon-prepend' => 'glyphicon-usd',
        	'help-block' => 'Value is a price',
    	),
    ),
),
?>
```

#### Alert
```php
<?= $this->losAlert('test') ?>
<?= $this->losAlert('<strong>Warning</strong> Testing...') ?>
```

The default alert uses the warning style without the close icon (X). But you can use any alert:
```php
<?= $this->losAlert()->success('test') ?>
<?= $this->losAlert()->info('test') ?>
<?= $this->losAlert()->warning('test') ?>
<?= $this->losAlert()->danger('test') ?>
```

If you want the dismissible alert just call:
```php
<?= $this->losAlert()->setDismissible(true)->success('test') ?>
```

#### Badge
```php
<?= $this->losBadge('2') ?>
```

#### Button
```php
<?= $this->losButton('Test') ?>
<?= $this->losButton('Test','primary') ?>
<?= $this->losButton('Test','danger','margin-right:10px;') ?>
<?= $this->losButton()->setDefault('Test') ?>
<?= $this->losButton()->primary('Test') ?>
<?= $this->losButton()->success('Test') ?>
<?= $this->losButton()->info('Test') ?>
<?= $this->losButton()->warning('Test') ?>
<?= $this->losButton()->danger('Test') ?>
<?= $this->losButton()->link('Test') ?>
<?= $this->losButton()->primary('Test','margin-right:10px;') ?>
<?= $this->losButton()->setId('testid')->primary('Test') ?>
<?= $this->losButton()->setName('testname')->primary('Test') ?>
<?= $this->losButton()->setLarge()->primary('Test') ?>
<?= $this->losButton()->setSmall()->primary('Test') ?>
<?= $this->losButton()->setExtraSmall()->primary('Test') ?>
<?= $this->losButton()->isActive()->primary('Test') ?>
<?= $this->losButton()->isBlock()->danger('Test') ?>
<?= $this->losButton()->isDisabled()->info('Test') ?>
<?= $this->losButton()->setId('testid')->setName('testname')->isDisabled()->isBlock()->info('Test') ?>
```

#### Icons
To use their icon is simple, just use the LosIcon View Helper:
```php
<?= $this->losIcon('glyphicon-user') ?>
```
Will generate:
```html
<span class="glyphicon glyphicon-user"></span>
```

You can pass a second parameter to add any style:
```php
<?= $this->losIcon('glyphicon-user', 'margin-right:4px;float:none') ?>
```
Will generate:
```html
<span class="glyphicon glyphicon-user" style="margin-right:4px;float:none"></span>
```

If you need to add a class, pass it along with the icon:
```php
<?= $this->losIcon('glyphicon-user pull-right') ?>
```
Will generate:
```html
<span class="glyphicon glyphicon-user pull-right"></span>
```

#### Image
```php
<?php echo $this->losImage('/images/logo.png') ?>
<?php echo $this->losImage()->circle('/images/logo.png') ?>
<?php echo $this->losImage()->rounded('/images/logo.png') ?>
<?php echo $this->losImage()->thumbnail('/images/logo.png') ?>
```

As default, the image receives a img-responsive class. To remove it, call:
```php
<?php echo $this->losImage('/images/logo.png')->setResponsive(false) ?>
```

#### Label
```php
<?= $this->losLabel('test') ?>
<?= $this->losLabel()->default('test') ?>
<?= $this->losLabel()->primary('test') ?>
<?= $this->losLabel()->success('test') ?>
<?= $this->losLabel()->info('test') ?>
<?= $this->losLabel()->warning('test') ?>
<?= $this->losLabel()->danger('test') ?>
```

The first call, will use the "default" style.

#### Navigation
For now, there is two Navigation View Helpers: Breadcrumbs and Menu. 

```php
<?= $this->losNavigation('Navigation')->menu()?>
<?= $this->losNavigation('Navigation')->breadcrumbs()?>
```

The menu helper will use the "navbar" style form bootstrap, using the first level as navbar links 
and submenus as dropdown as in [Bootstrap Navbar](http://getbootstrap.com/components/#navbar-default).

There is a new Page type that enable you to add a divider to the menu helper:
```php
<?php
'navigation' => [
    'default' => [
        'crud' => [
            'pages' => [
                [
                    'label' => 'Client',
                    'route' => 'client',
                    'pages' => [
                        [
                            'label' => 'Edit Client',
                            'route' => 'client/edit',
                        ],
                        [
                    		'type' => 'LosUi\Navigation\Page\Divider'
                 		],
                  		[
                            'label' => 'Remove Client',
                            'route' => 'client/remove',
                        ],
                    ]
                ]
            ]
        ]
    ]
]
?>
``` 

The breadcrumbs helper will follow [Breadcrumbs](http://getbootstrap.com/components/#breadcrumbs).

If you define a page of type URI with just a '#' href, the breadcrumbs will print just it's label and not a link. 
Very useful if you have a category not linked to a route.

#### Paginator
You can use the Paginator View Helper to style as [Default Paginator](http://getbootstrap.com/components/#pagination-default) or
[Pager](http://getbootstrap.com/components/#pagination-pager).

The default helper will use the 'Sliding' scroll system, and the 'default paginator' from bootstrap. To change this behavior, just
use the second argument to the scroll system, null as the third (will use this lib view file). 

```php
<?= $this->losPaginationControl($this->paginator); ?>
<?= $this->losPaginationControl($this->paginator, 'All'); ?>
<?= $this->losPaginationControl($this->paginator, 'Elastic'); ?>
<?= $this->losPaginationControl($this->paginator, 'Jumping'); ?>
<?= $this->losPaginationControl($this->paginator, 'Sliding'); ?>
<?= $this->losPaginationControl($this->paginator, 'Sliding', null, ['type' => 'pager','aligned'=>false,'nextLabel'=>'Próximo']); ?>
``` 

The following options are available in the fourth parameter:
- 'type': 'pager'. If specified as pager, will use the Pager. If omited, will use the Default Paginator.
- 'aligned': true (default) or false. Will use the aligned version of the pager.
- 'size': 'sm' or 'lg'. Use the small or large, respectively.
- 'nextLabel': the label for the 'Next' buttton. Can be combined with glyphicon or FontAwesome.
- 'previousLabel': the same as nextLabel, but for the 'Previous' button.

#### Well
```php
<?= $this->losWell('test') ?>
<?= $this->losWell()->small('test') ?>
<?= $this->losWell()->large('test') ?>
```
