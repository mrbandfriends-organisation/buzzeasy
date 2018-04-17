# Mr B Wordpress Theme

This is a fork of the excellent [Sage](https://roots.io/sage/) starter Theme. We advise reading the original Sage `README.md` file.

## Installation

1. `cd` into the `/themes` directory of your project
2. `git clone` the Mr B WordPress Theme - `git clone --depth=1 git@mrbandfriends.git.beanstalkapp.com:/mrbandfriends/mrb-wordpress-theme.git`
3. Remove the `git` references from the Theme - `rm -rf mrb-wordpress-theme/.git`
4. Consider installing MrB Frontend Assets (see below)

## Setup

### Assets

We have removed the original Sage/Roots setup for CSS and JS (aka: assets). As a result we recommend you utilise the Mr B & Friends Frontend Boilerplate Assets. To do this

1. Within the `mrb-wordpress-theme` theme directory, clone the Frontend Boilerplate Assets repo as `assets` - `git clone --depth=1 git@mrbandfriends.git.beanstalkapp.com:/mrbandfriends/frontend-boilerplate-assets.git assets`
2. Remove all git references from the `assets` directory - `rm -rf assets/.git`
3. Run `yarn` or `npm install` - this will install the deps listed in the _theme_ `package.json` but also those listen in the `package.json` within the `assets` dir. 

#### Relationship between the Theme and the Frontend Boilerplate Assets

There are two projects 

1. Mr B WordPress Theme - this repo. A standard boilerplate theme for all new Mr B WordPress projects
2. Mr B Frontend Boilerplate Assets - a repo containing our standard frontend setup for all projects

We maintain both projects as seperate Git repos, but we need to be able to use them together on new WordPress builds. In order to do this we use a feature of `npm` called "Local Packages". 

Unlike normal `npm` packages which exist on the NPM repo, local packages exist on your local filesystem. The local package must be a valid `npm` package and should have it's own `package.json` with valid meta data. You can then create a reference to this package using the special `file:` syntax in your `package.json` file. Then when you `npm install` NPM will not only install the packages listed in your `package.json` file but will also install those listed in the `package.json` file of the local repo.

The main benefit of this approach is that you can `require()` your local package just like any other package. 

We utilise this to great effect within the Mr B WordPress Theme Boilerplate to allow us to run `gulp` inside the Theme directory and have it trigger all the functionality and behaviours we store seperately within the Frontend Boilerplate Assets package. If we didn't take this approach then the Theme would have to have the full assets setup baked into it and our assets package would only be suitable inside a very specific WordPress context.


## Maintaining against Upstream Sage repo

__Note:__ once you have deployed this Plugin into your project (following steps under "Installation" above) then you should no longer try to maintain the Theme against the original Sage "upstream".

This repo has several changes made to the core Sage files. Nonetheless, it's important we can keep up to date with the latest features in the original Sage project. To do this repo has an upstream set to `git@github.com:roots/sage.git`. 

To pull in the latest changes

1. Create a feature branch 
2. `git fetch upstream` - pulls down latest changes from Sage (doesn't do any merges yet)
3. `git merge upstream/master` - merges upstream changes into your feature
4. Resolve all merge conflicts.
5. Test carefully.
6. Close feature as per standard proceedure.