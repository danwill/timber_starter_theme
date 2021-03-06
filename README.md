# Mechanic Starter WP Theme

This is a barebones project scaffold for developing Wordpress themes. It creates a project with the following features:
* Laravel Mix - Makes webpack much more tolerable
* Timber - Enables the Twig templating engine within Wordpress templates
* ACF Pro - Provided as a distributed plugin
* Soil - Sensible Wordpress defaults
* Vue - For front-end magic

This starter theme is based on the awesome [timber-starter-theme](https://github.com/laras126/timber-starter-theme) and [lumberjack](https://github.com/Rareloop/lumberjack)


## What's here?

`assets/` contains static front-end files and images. In other words, your compiled CSS, JS, SVGs, or any PNGs would live here.

`acf-json/` contains JSON files for tracking Advanced Custom Fields. This is incredibly useful for version control. After cloning this repository, you can go in`to Custom Fields from the Dashboard and select "Sync" to import these custom fields into your theme.

`lib/` contains files for custom post type arguments and taxonomies. These are added to WordPress inside functions.php and could be included there, but are separated into other files to keep functions.php a bit cleaner.

`views/` contains all of your Twig templates. These correspond 1 to 1 with the PHP files that make the data available to the Twig templates.

`source/` has all of your working Sass and JS (Vue) files

`front-page.php` and `views/front-page.twig` are templates for a static home page should you choose to use one. This template will automatically be applied to that page whatever its name may be.

## Setup

We like using [Laravel Valet](https://laravel.com/docs/5.4/valet) for serving up our local sites. Here's how to get that set up:

1. Make sure Homebrew is [installed](https://brew.sh/) and updated: `brew update`
2. Confirm that the `~/.composer/vendor/bin` directory is in your system's `PATH`
3. Install Laravel Valet by following the instructions [here](https://laravel.com/docs/5.4/valet)
  * Make sure PHP 7.1 is installed (`php -v`), according to the Valet instructions
4. Run `valet park` within your main project folder (e.g. `~/Sites/`)
5. Install MariaDB: `brew install mariadb`
6. Start MariaDB: `mysql.server start`
  * Note that rebooting may stop this process. To keep the service running, you can run `brew services start mariadb`. Review running services with `brew services list`. 

Finally, there are a couple of Wordpress-specific command line tools we need:
1. Install [WP-CLI](http://wp-cli.org/)
2. Install scaffolding plugin: `wp package install aaemnnosttv/wp-cli-valet-command`

May need to increase PHP memory limit. If you get any "allowed memory size of X bytes exhausted" errors:
1. Find where your local php.ini file: `php --ini`
2. Open the `php.ini` file at the listed path and search for `memory_limit`
3. Change the value to `512M` then save
4. Type `php -ini | grep memory_limit` to make sure the change was applied. If not, look for a `php-memory-limits.ini` file instead of `php.ini` and apply the value there.


## Creating a Project

Here's how to create a new Wordpress project and clone in this starter theme to get started:

1. In your command line, go to your project folder (e.g. `~/Sites/`), or wherever you parked Valet above.
2. Run `wp valet new your-project-name --unsecure`
  * You can leave off the `--unsecure` flag to enable HTTPS locally
  * You can change this option after the project is created using `valet secure your-project-name` / `valet unsecure your-project-name`
  * Full list of options available [here](https://github.com/aaemnnosttv/wp-cli-valet-command#wp-valet-new)
3. Confirm that the site is running by opening the URL that is returned in the success message
4. `cd` into the project directory


Let's clone in this starter theme and set up some stuff in Wordpress:

1. From your project folder, `cd` in the plugins folder: `cd wp-content/plugins`
2. Clone in the [Soil plugin](https://roots.io/plugins/soil/): `git clone --depth=1 https://github.com/roots/soil.git --single-branch soil && rm -rf soil/.git`
3. Remove some default plugins: `wp plugin uninstall hello akismet`
4. Activate Soil: `wp plugin activate soil`
5. `cd ../themes`
  * You may want to remove the standard Wordpress themes from this directory (`open .`)
6. Clone in this theme: `git clone --depth=1 https://github.com/danwill/timber_starter_theme.git your-project-name && rm -rf your-project-name/.git`
7. `open https://www.advancedcustomfields.com/my-account/`, sign on, and download the most recent version of ACF Pro
8. Copy the contents of the ACF Pro .zip file into the theme's `acf/` directory
9. `cd` into the theme folder (e.g. `cd your-project-name`)
10. Add in the timber library: `composer require timber/timber`
11. Activate the starter theme: `wp theme activate your-project-name`

Now get our front-end process set up:

1. Make sure you are in your theme folder
2. Run `npm install`
3. Open up the _webpack.mix.js_ file (or use `code webpack.mix.js`) and edit the **browsersync proxy to point to the .test url** (e.g. <your-project-name.test>)
4. Run `npm run watch` to confirm that the source files compile successfully. The site should open up in your browser with a URL of <localhost:3000>

Git

1. We will initialize a git repo in the wp-content folder, so `cd ../..` and `git init`
2. `git add *` and `git commit -m "Initial commit"`
3. If you use Tower: 
  * Open the repo in Tower with `gittower .`
  * Add a remote repo named _origin_ and paste in the link to your remote repo
4. Make your first push to your remote repo!


## Cloning

If you are a team member working on a project that someone has already created using the above steps and just need to pull down the project and get started, follow these steps:

1. In your command line, go to your project folder (e.g. `~/Sites/`), or wherever you parked Valet above.
2. Run `wp valet new your-project-name --unsecure`
  * Note that you should ideally use the same settings as the rest of the team
  * You can leave off the `--unsecure` flag to enabled HTTPS locally
  * You can change this option after the project is created using `valet secure your-project-name` / `valet unsecure your-project-name`
  * Full list of options available [here](https://github.com/aaemnnosttv/wp-cli-valet-command#wp-valet-new)
3. Confirm that the site is running by going to <http://your-project-name.dev>
6. `cd` into the wp-content folder `cd your-project-name/wp-content` and remove everything in this directory. We will clone the project repo into here.
7. `git clone your.git.repo.url.here . `
  * _Note the trailing "space period space"_
8. Open in Tower, if that's your thing: `gittower .` and make sure your remote _origin_ is set up correctly
9. `wp plugin activate soil`
10. `wp theme activate your-project-name`
11. `cd` into the theme folder (e.g. `cd themes/your-project-name`)
12. Run `npm install`
13. Run `npm run watch` to confirm that the source files compile successfully. The site should open up in your browser with a URL of <localhost:3000>

## Extras

6. Set a static home page in Settings > Reading and choosing "A Static Page". This will automatically act as your home page and will reference the `views/front-page.twig` template.

