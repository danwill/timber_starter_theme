# Timber Starter Theme (Tackle Box version)

With comments!

## What's here?

`assets/` contains static front-end files and images. In other words, your Sass files, JS files, SVGs, or any PNGs would live here.

`acf-json/` contains JSON files for tracking Advanced Custom Fields. This is incredibly useful for version control. After cloning this repository, you can go into Custom Fields from the Dashboard and select "Sync" to import these custom fields into your theme.

`lib/` contains files for custom post type arguments and taxonomies. These are added to WordPress inside functions.php and could be included there, but are separated into other files to keep functions.php a bit cleaner.

`views/` contains all of your Twig templates. These correspond 1 to 1 with the PHP files that make the data available to the Twig templates.

`front-page.php` and `views/front-page.twig` are templates for a static home page should you choose to use one. This template will automatically be applied to that page whatever its name may be.

## Installing

1. Make sure you have installed the plugins for the Timber Library and Advanced Custom Fields. You can find these by searching for them in Plugins > Add New.
2. Download the zip for this theme (or clone it) and move it to `wp-content/themes` in your WordPress installation. 
3. Rename the folder to something that makes sense for you website. It should be a short name with no spaces - underscores and hyphens are okay - and all lowercase.
4. Activate the theme in Appearance >  Themes.
5. You should see a notice that Timber needs to be activated; go to Plugins > All and activate both Timber and Advanced Custom Fields (ACF for short.)
6. Set a static home page in Settings > Reading and choosing "A Static Page". This will automatically act as your home page and will reference the `views/front-page.twig` template.

## Working in the Theme

There is an example of a custom post type called "Cocktails". You can create your own at [generatewp.com](http://generatewp.com) and add that array to `lib/custom-types.php`.

Custom Fields can be customized from the Custom Fields section in the Dashboard menu. 

Read the notes in `views/page-content.twig` and `views/front-page.twig` for notes on using ACF in your templates, and general Twig info.

## More soon!
