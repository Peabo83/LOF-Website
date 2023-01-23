# LOF-Website

Intial build that runs a website off of a google sheet and google docs.

I built this on PHP 8.2, bootstrap 5.2 loads from the CDN.

Set /public as the website root

Set website variables in define.php, fount in the root of the build

/public/do-the-thing.php will load with a text input and a 'GO' button. Enter the password defined in define.php to run the script that caches the pages and images.

You will likely have to change the permissions on /public/img and /public/txt so PHP can write to those files

# Usage

## Menu
Create a google sheet that will build your menu. Populate the first sheet with rows of data as:
<Item Name><Link URL><URL to google doc>

In your google menu sheet click File > Publish to Web

When prompted, select the output as CSV and publish to the web. Copy the link and paste this into define.php for MAIN_MENU_CSV

For submenus add a new line with the title of the submenu, place items to go inside the submenu on the preceeding lines, and then to close the submenu set the <Item Name> to 'End'.

## Pages
Create a new google doc. Add '##BEGIN##' and '##END##' into the doc, and put your content between these two lines.

Inside your google doc click File > Publish to Web

Copy the link URL generated for the doc. This is the URL used in the google doc menu as the <URL to google doc> column.
