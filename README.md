# tna-base child theme template

This should be used when creating new child themes for tna-base

### 1.0 Clone Github repository 'tna-base-child-template' using SourceTree

Click 'Remote' in SourceTree and you will be shown a full list of repositories you have access to. Then:

* Create a folder called 'tna-base-child-template' in the Themes directory of your WordPress installation where 'tna-base' parent theme sits
* Select the 'tna-base-child-template' repository in SourceTree and clone it to your newly created 'tna-base-child-template' directory

### 1.1 Create your child theme from 'tna-base-child-template'

* Create a folder in the Themes directory of your WordPress installation where 'tna-base' parent sits and give it a name
* Use the naming convention, 'tna-child-...'
* Copy the files inside 'tna-base-child-template' into your new child theme folder

### 1.2 Add existing local repository (your newly created child theme) to Github using SourceTree

* Click on 'New repository' and select 'Add existing local repository'
* Browse and select your newly created folder
* Check 'Also create remote repository' and click 'Create'
* Change owner to 'nationalarchives', uncheck 'This is a private repository' and click 'Create'
* In SourceTree stage the files and make the first commit
* Click on 'Git Flow' to create the desired branches to begin development
* Push both branches 'master' and 'develop' to the remote repository

#### 1.2.1 Adding new repository to Travis CI

Log into your Travis CI account and navigate to The National Archives organisation. Here you will be able to add the repository to Travis CI. 

### 1.3 Create a new project for the WordPress installation in PhpStorm

* Select 'Create New Project from Existing Files'
* Select 'Web server is installed locally, source files are located under its document root'
* Set /Applications/MAMP/htdocs/sites/tna-base-dev/wp-content/themes/tna-child-... and click 'Project Root'
* Specify parameters for a new server as:
  * Name: tna-child-...
  * Web server root URL: http://tna-base:8888
  * Set Project URL as: http://tna-base:8888

### 1.4 Installing dependencies

This repository is configured to allow for easy integration with Travis CI (Continuous Integration).

#### 1.4.1 Obtaining dependencies via Composer

Having followed the steps above you will be able to install dependencies by typing ```composer install``` at the Terminal.

#### 1.4.2 Obtaining dependencies via NPM

Type ```npm install``` to obtain Node dependencies

### 1.5 Running PHPUnit

Having followed the steps under 'Obtaining dependencies via Composer' type ```vendor/bin/phpunit -c phpunit.xml``` from within the tna-base directory to run Unit Tests for the project.

Note: PhpStorm allows for PHPUnit integration - allowing your tests to be run automatically. Search the JetBrains website to find out how to configure this.

### 1.6 Running Jasmine tests

Having obtained the dependencies you can type ```grunt jasmine``` to run JavaScript tests