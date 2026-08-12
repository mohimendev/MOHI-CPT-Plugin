=== MOHI CPT ===
Contributor: Mohimen
Tags: portfolio, testimonial, custom post type, metabox
Requires at least: 6.0
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Easily register high-performance Custom Post Types for Portfolios and Testimonial showcases, tailored perfectly for the MOHI ecosystem.

== Description ==

MOHI CPT is a lightweight, performance-first WordPress plugin built specifically to handle structural Portfolio layouts and Testimonial sliders without plugin bloat. Designed keeping ultra-fast load times and clean semantic markup in mind, it provides smooth dashboard control toggles and secure front-end rendering.

= Key Features =
* **Performance First:** Ultra-clean codebase ensuring under 2-second site asset loading.
* **Dual Showcase:** Registers standard-compliant 'Portfolio' and 'Testimonial' custom post types.
* **Smart Assets Enqueueing:** Conditional script & style loading ensures Bootstrap assets only load where needed, keeping the rest of the site clean.
* **Isolated Admin Scope:** Customized options layout panel with robust view control toggles built specifically to avoid global CSS style bleed.
* **Shortcode-Ready:** Easily display your Portfolios or Testimonials inside any pages, sections, or popular page builders using shortcodes.
* **Translation Ready:** Full internationalization integration adhering to secure WordPress core localization patterns.

== Installation ==

1. Upload the `mohi-cpt` folder to the `/wp-content/plugins/` directory, or install directly through the WordPress admin panel.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Navigate to the newly created 'MOHI CPT' dashboard entry to configure single portfolio or testimonial options.
4. (Optional) If you face any broken links, use the integrated 'Flush Permalinks' feature in the settings screen.

== Frequently Asked Questions ==

= How do I display the portfolio layout on a specific page? =
You can easily display your Portfolios in any pages, sections and builders by dropping in the standard `[my_portfolio]` shortcode.

= Does this plugin inject massive CSS files sitewide? =
No. Following our performance-first rule, Bootstrap layout definitions and Bootstrap Icons are strictly limited and conditionally loaded on single CPT items, post-type archives, or explicit shortcode occurrences only.

= What does the Meta Box Toggle button do? =
It provides an intuitive micro-control panel over your single layouts. You can easily show or hide the project details section on your single portfolio layout with a single click.

== Screenshots ==

The `/assets/` directory contains:
* 1 Plugin Icon
* 1 Plugin Banner
* 4 Screenshots demonstrating the plugin interface and front-end layouts
    1. Single Portfolio Page – Displays the individual portfolio layout on the front-end.
    2. MOHI CPT Main Dashboard – Main plugin settings and configuration panel.
    3. Portfolio Archive Page – Portfolio archive/grid layout displayed on the front-end.
    4. Portfolio Dashboard – Portfolio custom post type management screen inside WordPress admin.

== Third-Party Resources & Bundled Assets ==

This plugin bundles localized copies of the following external open-source framework assets to ensure modern grid structure rendering and iconography support:

* **Bootstrap Framework (Core CSS & JS Bundle)**
    * Source: https://github.com/twbs/bootstrap
    * License: MIT License (https://github.com/twbs/bootstrap/blob/main/LICENSE)
    * Version Bundled: 5.3.8

* **Bootstrap Icons (Font Assets & Framework CSS)**
    * Source: https://github.com/twbs/icons
    * License: MIT License (https://github.com/twbs/icons/blob/main/LICENSE)
    * Version Bundled: 1.11.3

== Changelog ==

= 1.0.0 =
* Initial baseline production release.
* Added strict admin option screen asset boundaries to prevent style overrides.
* Optimized semantic localization templates and fixed local asset fonts fallback routing.

== Upgrade Notice ==

= 1.0.0 =
Initial release. Safe to install on production setups running custom WooCommerce or minimalist block structures.
