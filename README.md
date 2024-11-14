## Wordpress Export CSS Plugin

### What is this for?

If you want to use Wordpress in a headless setup, where Wordpress is just a CMS/editor, and you output the content elsewhere, you will need the additional CSS that Wordpress renders for your content.

That includes both generic styles, as well as styles specific to your theme/preset.

- The former can be included from `wp-includes/css/dist/block-library/style.css`.
- For the latter you can use this plugin. Install it, and the styles will become available at `example.com/wp-json/wordpress-export-css/wordpress-export-css.css`, where `example.com` is your Wordpress URL. (Consider caching the output.)

### Installation

Copy the contents of this plugin to your `wp-content/plugins`, then visit your Wordpress Admin and activate it.
