# LOF-Website

Intial build that runs a website off of a google sheet and google docs.

I built this on PHP 8.2, bootstrap 5.2 loads from the CDN.

Set /public as the website root

Set website variables in define.php, fount in the root of the build

/public/do-the-thing.php will load with a text input and a 'GO' button. Enter the password defined in define.php to run the script that caches the pages and images.

You will likely have to change the permissions on /public/img and /public/txt so PHP can write to those files
