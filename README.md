# LosUI

## Introduction
This module provides a shortcut to several UI resources from some of the best front frameworks. 
I will add more libraries with time and add more resources to the current ones.

- Jquery: 2.1.1 [jquery.com](http://jquery.com)
- Bootstrap: 3.3.1 [getbootstrap.com](http://getbootstrap.com)
- Font Awesome: 4.2.0 [fortawesome.github.io](http://fortawesome.github.io/Font-Awesome/) 
- Chosen: 1.2.0 [http://harvesthq.github.io/chosen/](http://harvesthq.github.io/chosen/)

The ideia is to facilitate the front development. You do not need to worry about download individually each library, control their versions, so on. Refer to the Usage bellow.

## Requirements
- Zend Framework 2 [framework.zend.com](http://framework.zend.com/).
- AssetManager from rwoverdijk [rwoverdijk/assetmanager](https://github.com/RWOverdijk/AssetManager)
- Any library above

## Instalation
Instalation can be done with composer ou manually

### Installation with composer
For composer documentation, please refer to [getcomposer.org](http://getcomposer.org/).

  1. Enter your project directory
  2. Create or edit your `composer.json` file with following contents:

     ```json
     {
         "minimum-stability": "dev",
         "require": {
             "los/losui": "1.*"
         }
     }
     ```
  3. Run `php composer.phar install`
  4. Open `my/project/directory/config/application.config.php` and add `LosUi` to your `modules`
     
### Installation without composer

  1. Clone this module [LosUi](http://github.com/LansoWeb/LosUi) to your vendor directory
  2. Enable it in your config/application.config.php like the step 4 in the previous section.
  
## Usage
This module provides two main View Helpers: LosHeadLink and LosHeadScript. You can safely replace the default ZF HeadLink and HeadScript with this ones to use their resources.

### Jquery
Jquery is provided as local files (default) or with CDN. Just pass "true" to the appendJquery method to use the CDN files.
The second argument indicates the use of minified version (default) or not, while the third indicates a specific version of a CDN file.
  
Just add the following to your layout.phtml file:
```php
<?php
//Will use the local minified version  
echo $this->losHeadScript()->appendJquery();

//Will use the CDN version  
echo $this->losHeadScript()->appendJquery(true);
 
//Will use the 2.1.0 unminified CDN version  
echo $this->losHeadScript()->appendJquery(true, false, '2.1.0'); 
?>
```

It will generate the following html:
```html
<script src="/jquery/dist/jquery.min.js" type="text/javascript"></script>
``` 

### Font Awesome
Font Awesome is provided as local files (default) or with CDN. Just pass "true" to the appendFontAwesome method to use the CDN files.
The second argument indicates the use of minified version (default) or not, while the third indicates a specific version of a CDN file.

Include the stylesheet with:
```php
<?php 
//Will use the local minified version
echo $this->losHeadLink()->appendFontAwesome();

//Will use the minified CDN version
echo $this->losHeadLink()->appendFontAwesome(true);
 
//Will use the 4.2.0 unminified CDN version  
echo $this->losHeadLink()->appendFontAwesome(true, false, '4.2.0');
?>
```

The last call will generate the following html:
```html
<link type="text/css" rel="stylesheet" media="screen" href="/fontawesome/css/font-awesome.min.css">
``` 

To use their icon is simple, just use the LosIcon View Helper:
```php
<?= $this->losIcon('fa-user') ?>
```
Will generate:
```html
<span class="fa fa-user"></span>
```

You can pass a second parameter to add any style:
```php
<?= $this->losIcon('fa-user', 'margin-right:4px;float:none') ?>
```
Will generate:
```html
<span class="fa fa-user" style="margin-right:4px;float:none"></span>
```

If you need to add a class, pass it along with the icon:
```php
<?= $this->losIcon('fa-user pull-right') ?>
```
Will generate:
```html
<span class="fa fa-user pull-right"></span>
```

You can even call and icon as a method:
```php
<?= $this->losIcon()->FaUser() ?>
```

### Chosen
If you do not provide an element as the first parameter, the module will assume "select" and will apply the Chosen for all "select" elements.
You can pass thr Chosen attributes as an array (either as the first or second parameter).
```php
<script>
<?= $this->losChosen() ?>
<?= $this->losChosen('#my_select') ?>
<?= $this->losChosen('#my_select',['disable_search_threshold'=>10]) ?>
<?= $this->losChosen(['disable_search_threshold'=>10]) ?>
</script>
```

It is not mandatory that you include the stylesheet and script beforehand. If you call the view helper as above, the module will include both for you as minified versions.
To disabled this behavior, pass false as last parameter:
```php
<script>
<?= $this->losChosen(false) ?>
<?= $this->losChosen('#my_select', false) ?>
<?= $this->losChosen('#my_select',['disable_search_threshold'=>10], false) ?>
<?= $this->losChosen(['disable_search_threshold'=>10], false) ?>
</script>
```


To manually include the stylesheet and script (can use append or prepend)
```php
<?php echo $this->losHeadLink()->appendChosen() ?>
<?php echo $this->losHeadScript()->appendChosen() ?>
```

It will generate the following html:
```html
<link type="text/css" rel="stylesheet" media="screen" href="/chosen/chosen.min.css">
<script src="/chosen/chosen.jquery.min.js" type="text/javascript"></script>
``` 

Again, you can use the false parameter to get the default file:
```html
<link type="text/css" rel="stylesheet" media="screen" href="/chosen/chosen.css">
<script src="/chosen/chosen.jquery.js" type="text/javascript"></script>
```


### Bootstrap
Bootstrap is provided as local files (default) or with CDN. Just pass "true" to the appendBootstrap method to use the CDN files.
The second argument indicates the use of minified version (default) or not, while the third indicates a specific version of a CDN file.

Include the stylesheet with (can use append or prepend)
```php
<?php 
//Will use the minified local version
echo $this->losHeadLink()->appendBootstrap();
echo $this->losHeadScript()->appendBootstrap();

//Will use the minified CDN version
echo $this->losHeadLink()->appendBootstrap(true);
echo $this->losHeadScript()->appendBootstrap(true);  

//Will use the 3.3.1 unminified CDN version  
echo $this->losHeadLink()->appendBootstrap(true, false, '3.3.1');
echo $this->losHeadScript()->appendBootstrap(true, false, '3.3.1');
?>
```

The first call will generate the following html:
```html
<link type="text/css" rel="stylesheet" media="screen" href="/bootstrap/dist/css/bootstrap.min.css">
<script src="/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
``` 

For each section bellow, please refer to the [bootstrap documentation](http://getbootstrap.com) for the classes specifications.

#### Forms
This module provies a Form View Helper that automatically adds bootstrap style to forms. Just use the default form but with the new view helper: 
```php
<?= $this->losForm($form) ?>
```

The is a LosFormRow view helper that prints just a row. It will add all necessary classes, including alerts for form errors.
```php
<?= $this->losFormRow($form->get('password') ?>
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

You can even call and icon as a method:
```php
<?= $this->losIcon()->GlyphiconUser() ?>
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

The first call, will use the default style.

#### Well
```php
<?= $this->losWell('test') ?>
<?= $this->losWell()->small('test') ?>
<?= $this->losWell()->large('test') ?>
```
