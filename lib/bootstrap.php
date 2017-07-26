<?php

namespace Mechanic;

use Mechanic\Core\Site;
use Mechanic\Config\Menus;
use Mechanic\Config\Images;
use Mechanic\Functions\Assets;
use Mechanic\Config\ACFSettings;
use Mechanic\Config\ThemeSupport;
use Mechanic\Config\CustomPostTypes;
use Mechanic\Config\CustomTaxonomies;

require_once('autoload.php');

/**
 * ------------------
 * Core
 * ------------------
 */

new Site;

/**
 * ------------------
 * Config
 * ------------------
 */

ThemeSupport::register();

CustomPostTypes::register();

CustomTaxonomies::register();

Menus::register();
Menus::removeAdminMenus();

Images::registerSizes();

ACFSettings::register();
ACFSettings::config();

/**
 * ------------------
 * Functions
 * ------------------
 */

Assets::load();