=== Gravity Forms MC Unique ID Generator Field (Lite) ===
Contributors: modcodingcom
Donate link: https://modcoding.com/product/gravity-forms-mc-unique-id-generator-field-wordpress-plugin/?utm_source=wordpress
Tags: gravity forms, unique identifier generator
Requires at least: 3.0.1
Tested up to: 4.8.0
Stable tag: 1.40
License: GNU GPL v.2
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html

Creates a new field in Advanced Fields tab of form editor. 

== Description ==

Gravity Forms MC Unique ID Generator Field plugin adds new field to Gravity Forms fields editor that you can use to generate random unique (site wide) identifiers like user identifiers, order identifiers, passwords, serial numbers and so on.
You can make it rendered as <INPUT type="hidden" />, <INPUT type="text" />, <INPUT type="number" /> or custom HTML template.

The plugin supports sequence digital identifiers up to 10 digits length.

This is Lite version of plugin. 
You can order Full Version here:
https://modcoding.com/product/gravity-forms-mc-unique-id-generator-field-wordpress-plugin/?utm_source=wordpress

Full version provides additional functionality:
1) Separators can be specified between every X characters of value being generated.
2) Compatibility with Graivty Forms Post Update plugin. You can use shortcodes for update existing submissions 
without regeneration of identifier (identifier value will be same as on first submission that created new post in Wordpress).

[gravityform id="<FORM_ID>" update="<POST_ID>"] 
or 
[gravityform id="<FORM_ID>" update]

NOTE:
The plugin contains minified and compressed javascript (assets/js/*.js)
and style (assets/css/*.css) files for production use.
Source files renamed so they ends with "-full.js" and "-full.css".
To use source files just delete minified files and rename full files to
original names (remove "-full" from file names).


== Installation ==
You can install the plugin from dashboard, Plugins, Install Now. 
If your server has no write permissions to wp-content/plugins you can install by uploading unzipped plugin folder to wp-content/plugins and activating from dashboard Plugins page.
You should install Gravity Forms before first use of the plugin.

== Frequently Asked Questions ==

= What are differences between Lite version and Full Version? = 
Full version provides additional functionality:
1) Separators can be specified between every X characters of value being generated.
2) Compatibility with Graivty Forms Post Update plugin. You can use shortcodes for update existing submissions 
without regeneration of identifier (identifier value will be same as on first submission that created new post in Wordpress).

[gravityform id="<FORM_ID>" update="<POST_ID>"] 
or 
[gravityform id="<FORM_ID>" update]


= Where can I order Full Version of the plugin? =

You can buy it here:
https://modcoding.com/product/gravity-forms-mc-unique-id-generator-field-wordpress-plugin/?utm_source=wordpress


= Can it be used with other form plugins like formidable? =

No, this plugin can be used only with Gravity Forms. 



== Screenshots ==

1. This screenshot shows unqiue id field settings in Gravity Forms editor for numeric id generation.
2. Here is screen with demo form showing unqiue id field.
3. Settings screen with example of text id generation (like serial number).
4. Here is screen with alphabetical id generation example.
5. Screenshot with unique number and space as thousand separator.


== Changelog ==
v.1.40 - 10 July 2017
Bugs with loading settings in editor and regenerating same value multiple times fixed.

v.1.30 - 2 March 2017
Support for multiple Unique ID fields added.
Form editor issues solved.
CSS & JS files are minified.

v.1.20 - 14 September 2016
Code style improved.

v.1.10 - 12 September 2016
Lite version created to be complied with GNU GPL v.2.

v.1.00 - 5 January 2016
First version of the plugin.

== Upgrade Notice ==
All upgrades are free lifetime, even for commercial full version.
(c) Modular Coding Inc., 2016-2017