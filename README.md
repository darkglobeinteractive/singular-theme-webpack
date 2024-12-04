===================================
GitHub Repository
===================================

https://github.com/darkglobeinteractive/singular-theme


===================================
Singular Theme Installation Notes
===================================

# Remove Remote Repositories From Git

Run the following command to remove the origin for the repository:
$ git remove rm origin


# Remove assets/* from .gitignore

You will want to remove this from .gitignore because you will definitely want to be pushing these to the server.


# mmenu (v.9.3)

mmenu is used to handle the mobile menus in this theme. Documentation can be found here:
https://mmenujs.com/


# Add Main Menu

Admin > Appearance > Menus

1. [ ] Create "Main Menu"
2. [ ] Add something to the menu tree so it appears correctly on the front-end
3. [ ] Assign the new menu to the Manage Locations > Main Menu Navigation theme location


# Required Plugin Installation Notes

Advanced Custom Fields PRO is required by this theme.

1. [ ] Install "Advanced Custom Fields PRO" and do the following:
       [ ] Add ACF Pro license and update plugin
       [ ] Create an Options Page named "Global Options"
       [ ] Import the following JSON files into ACF PRO:
              [ ] /singular-theme/_configurations/acf-json/acf-options-pages.json
              [ ] /singular-theme/_configuration/acf-json/acf-base-import.json
              [ ] /singular-theme/_configutation/acf-json/acf-custom-blocks.json
        [ ] Double-check the Settings > Show this field group if... settings for each block
        [ ] Once theme is activated, save each of these field groups in order to create the local /acf-json/ files
2. [ ] Install "Filebird" (https://wordpress.org/plugins/filebird/)
3. [ ] Install "Yoast SEO" (https://wordpress.org/plugins/wordpress-seo/)
       [ ] Change the default separator to a pipe so it matches the header.php title separator -or- change the header.php title separator to a hyphen
       [ ] Add site name and image to the Yoast SEO admin
       [ ] Remove sitemap page and template file if using Yoast SEO
4. [ ] Install "ACF Content Analysis for Yoast SEO" (https://wordpress.org/plugins/acf-content-analysis-for-yoast-seo/)
5. [ ] Install "Redirection" (https://wordpress.org/plugins/redirection/)
       [ ] Add redirect from /user to /wp-admin
6. [ ] Install "Wordfence"
       [ ] Send license information to hello@[clientaddress]
       [ ] Request Google reCAPTCHA keys and install them
               [ ] Admin > Wordfence > Login Security > Settings > reCAPTCHA section
       [ ] Set brute force login limit to 5 attempts:
               [ ] Admin > Wordfence > Firewall > All Firewall Options > Brute Force Protection


# Create Pages / Modify Templates

1. [ ] Create a Block Pattern Guide and use the code in /configuration/code/block-pattern-guide.html to create it
        [ ] Modify this as needed to get page to display
1. [ ] Create search form page and update template file to reflect page ID
2. [ ] If you're not using Yoast SEO, create the sitemap page and update template file (page-search.php) to use page ID (page-[id].php)
        [ ] If you ARE using Yoast SEO, delete the sitemap page template 
3. [ ] Create home page and use customizer to set this page to the front page
4. [ ] Delete existing widgets


# Login Page Customizations

1. [ ] Update the image located at /singular-theme/img/login-logo.png
2. [ ] Modify the styles at /singular-theme/css/login.css


# General Notes

1. The Settings > Reading blog listing is limited to 3 items for testing purposes. The custom WP_Query post limit must match this for the blog listing to display the desired number of items.
2. [ ] Disable admin-based Theme Editor (Appearance > Theme Editor)
       [ ] In wp-config.php file == define('DISALLOW_FILE_EDIT', true);
3. [ ] Double-check that commenting is completely turned-off


# Disabling Comments

If this site will not allow discussions, follow these instructions for effectively removing the functionality from the site:

1. [ ] Goto Admin > Settings > Discussion and uncheck the checkbox for "Allow people to submit comments on new posts"
2. [ ] Uncomments the following line in functions.php:
        [ ] include( 'inc/remove-comments.php' );
3. [ ] Enable the site support section which contains information on the fact that comments have been disabled and how to enable them in necessary. To do this, uncomment the following line in functions.php:
        [ ] include( 'admin-support/index.php' );


# Fixed Header Notes

The "Smooth Scrolling" functionality in the /js/global.js file contains a header_height variable. 

If a fixed header is used on the site, you'll want to change this from "0" to "$('#header').innerHeight()" and possibly adjust the scroll_top_padding variable as well.


# Custom Block Patterns

Custom block patterns should be created and managed via core WordPress functionality in the block editor. There are two blocks which should manually migrated into the block editor. Follow these instructions:

1. [ ] Update the block pattern category name ("[CLIENT] Patterns") in the following file to use the client name:
        [ ] Line 12: /block-patterns/block-patterns.php
2. [ ] Migrate the following block pattern code into the block editor and save as WP Core patterns:
        [ ] /block-patterns/blocks/accordion.php
        [ ] /block-patterns/blocks/basic-content-wrapper.php
       NOTE: Remember to name the block pattern block elements in the block editor before saving.
3. [ ] Delete the files used in Step #2 from the remote server

At this point, you simply have to add new CSS files for each additional custom block created.


# Custom Blocks

The theme contains a handful of custom blocks.

1. [ ] Update the slug ("client-blocks") and name ("[CLIENT] Blocks") of the block category to use the client name in the following file:
        [ ] Lines 5-6: /blocks/blocks.php
2. [ ] Update the 'category' attribute in each block json files to match the slug set in Step 1:
        [ ] Line 5: /blocks/color-block-cta/block.json
        [ ] Line 5: /blocks/image-cta/block.json
        [ ] Line 5: /blocks/multi-slider/block.json
        [ ] Line 5: /blocks/testimonial/block.json


# GreenSock Animation Support

GreenSock is the animation library we'd like to focus on using:
https://greensock.com/docs/

To disable GreenSock animation:

1. [ ] Remove the following lines from webpack.config.js:
        [ ] config.entry.public
            [ ] './src/js/animations.js'
        [ ] config.entry.defer
            [ ] './libs/gsap/minifired/gsap.min.js'
            [ ] './libs/gsap/minified/ScrollTrigger.min.js'
2. [ ] Remove the following lines from /src/scss/public.scss:
        [ ] @import "public/animations";


# QUALITY ASSURANCE / WRAP-UP / MISC NOTES

1. [ ] Check basic Search and Search Results templating
2. [ ] Check 404 page templating
3. [ ] /inc/custom-post-columns.php shows you an example of how to customize the admin post listing columns and headers


===================================
Singular Plugin Installation Notes
===================================

The Singular Plugin is included in the repository. Since we've moved the custom accordion block to the block patterns sections, you should not install this plugin.


===================================
Available Libraries
===================================

There are a handful of libraries included in the theme directory in the /libs/ directory.

# Accessible Slick v.1.0.1
Git Location: https://github.com/Accessible360/accessible-slick.git
Website: https://accessible360.github.io/accessible-slick/
Notes: This is the accessible version of the slider we've been using for years.

# Modaal v.0.4.4
Git Location: https://github.com/humaan/Modaal
Notes: We're beginning to try-out this modal library because it's proven to be simpler to use and passes accessibility scans. The /libs/modaal/index.html demos are better than the github information.


===================================
Version Notes (A little late to this party...)
===================================

# General Notes (v.2.0) (November 30, 2024)

This was a major update from the original Singular theme project. The entire theme was overhauled in order to use Webpack for asset minification and aggregation.

# General Notes (v.1.3) (June 29, 2024)

Miscellaneous tweaks:
- Adding basic styling to search and 404 pages
- Adding autoplay option to multi-slider custom block
- Added starter code for custom admin post columns
- Revised how menus are declared and assigned
- Miscellaneous other tweaks

# General Notes (v.1.2) (June 3, 2024)

Major changes were added to the theme over the past few days:
- Admin Support (/admin-support/): The basics are now in-place and ready to use
- Block Patterns (/block-patterns/)
- Custom Blocks (/blocks/): This required enabling the Modaal and Slick Slider libraries out of the box
- Color Patterns (/css/color-palette.css): This requires setting the color palette in multiple places (notes are at the top of the CSS file)
- Global Options: Company info and social media link are now handled via an ACF block and presented in the following template files:
       - /templates/social-media.php
       - /templates/vcard.php
- SVG Support (/svg/): First attempt at this. Placing includeable files here for SVG-based icons