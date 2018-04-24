# Buzzeasy Site

## Tech Stack

### Backend
* __Server-side Language__: PHP
* __Database__: MySQL
* __Webserver__: NGINX
* __CMS__: WordPress

### Frontend
* __Preprocessor__: SASS
* __CSS Framework__: Custom
* __JavaScript Framework__: Custom
* __JS Dependency Management__: Custom

### Hosting
* __Provider__: Microsoft Azure



## Project Quirks

The following items represent quirks of this particular project. 

* This project has been set up with Ansible v2.5.0.0, though it may work with older versions.
    * If you encounter an error regarding the SSL certificate for Github, try using Ansible 2.5.0.0 (or MAMP!)

## Installation

* Ensure you have [Node.js](http://nodejs.org/download/) installed
* Install any npm packages
  * `$ npm install`
  * Note on Windows you may have to install the grunt CLI globally - `npm install -g grunt-cli`

* Install any Gems from Gemfile using bundler 
  * `$ bundle install`
  * check contents of install - `$ bundle show`

* Test your setup
  * use `bundle exec` to run `grunt` or `compass` commands, this ensures that bundle gems are used in place of system gems
  * `$ bundle exec grunt`

__Please note:__ if this project relies on node tools which are powered by Ruby Gems (eg: compass) then it is recommended that you run any such tools by prepending their node command with `bundle exec`. For example:

````
bundle exec gulp
````

This will force the tasks to be run using the Gem file versions defined in your Gem lock file and avoids complicated dependency issues.



## Source Control

This project uses Git for version/source control. The repository for this project is available on [Beanstalk](https://mrbandfriends.beanstalkapp.com/buzzeasy) (please speak with the Lead Developer for access).

### Branching model

This project uses a [Git-Flow](https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow/) inspired branching model. 

#### Branches 
* `develop` - the next release of the website code
* `master` - the current production-ready website code
* `feature/<branchName>` - a feature branch representing a distinct Story component or Feature
* `hotfix/<branchName>` - a minor change branch used when you need to roll minor fixes directly onto Production via `master`

Please read the Gitflow docs for more information.


## Style Guide

Please ensure you have read the [Mr B Developer Standards document](https://docs.google.com/a/mrbandfriends.co.uk/document/d/1F1a2P_TfKvzTi1heSKiZoW79z96kCPp0QGkdVx0jpUg/edit) (please request access from the Lead Developer).


### Comments

Please use comments in the following format

#### SASS

##### Block
````
// ==========================================================================
// # FIELDSET
// ==========================================================================
````

##### Sub Block
````
// # FIELDSET LEGEND
// ==========================================================================
````

#### CSS

##### Block
````
/* ==========================================================================
   SECTION COMMENT BLOCK
   ========================================================================== */
````

##### Sub Block
````
/* SUB-SECTION COMMENT BLOCK
   ========================================================================== */
````


#### JavaScript

##### Multiline
````
/**
 * Title / Heading
 * 
 * make() returns a new element
 * based on the passed in tag name
 *
 * @param {String} tag
 * @return {Element} element
 */

var Model = function() {};
````

##### Inline
````
// this is an inline comment and should be above the subject of the comment
var myvar = foo;
````



