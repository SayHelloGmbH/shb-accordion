=== Block: Accordion ===
Contributors:      joelmelon
Tags:              block
Tested up to:      5.9
Stable tag:        0.2.1
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

Provides a block which acts like an accordion.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/shb-accordion` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. You can now add the “Accordion” block.

== Changelog ==

= 0.2.1 =
* Fix duplication of accordion IDs
* Remove unnecessary JS element wrappers

= 0.2.0 =
* Fix and extend default CSS styling
* Add translation files

= 0.1.2 =
* Rename shb/accordion-title to shb/accordion-content
* Proper class setup with core block classes

= 0.1.1 =
* Setup correct template locking. Now it is not possible to edit the innerBlock of shb/accordion, but it is possible to insert several blocks into the shb/accordion-title & shb/accordion-content block.
* Restrict allowed blocks for shb/accordion-title
* Make variable for addition block class more unique

= 0.1.0 =
* Release.
