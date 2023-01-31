# Ultimate Member - Multisite
Changes the registration and profile photos logic on multisite.

The [Ultimate Member](https://wordpress.org/plugins/ultimate-member/) plugin supports individual registration on each site and provides individual profile photos for each site on WordPress multisite installation.
The extension [Ultimate Member - Multisite](https://github.com/umdevelopera/um-multisite) changes the registration and profile photos logic on multisite to use single registration for all sites in the network.

__Note:__ This is a free extension created for the community. The Ultimate Member team does not support this extension.

## Key features
- The extension automatically adds users who are registering on the main site to all additional sites. Note: This does not work in reverse.
- The directory for user uploads is changed. With this extension all sites use a common directory. So profile photos uploaded on one site will be used for all sites.
- The extension adds the "Multisite transfer users" widget to WordPress dashboard.

## Installation
### Clone from GitHub
Open git bash, navigate to the **plugins** folder and execute this command:

`git clone --branch=main git@github.com:umdevelopera/um-multisite.git um-multisite`

Once the plugin is cloned, enter your site admin dashboard and go to _wp-admin > Plugins > Installed Plugins_. Find the "Ultimate Member - Multisite" plugin and click the "Activate" link.

### Install from ZIP archive
You can install this plugin from the [ZIP archive](https://drive.google.com/file/d/1OqUsg-yYTimFUf9P_3k1NKbx0cOApqdY/view) as any other plugin. Follow [this instruction](https://wordpress.org/support/article/managing-plugins/#upload-via-wordpress-admin).

## How to use
Once the plugin is activated go to *wp-admin > Dashboard > Home*. You'll see the "Multisite transfer users" widget here. This widget contains two tools:
- The first tool transfers users and their uploads (photos) from site to site in the network.
- The second tool transfers users from the main site to all subsites and copies users uploads (photos) from sites to the common uploads directory.

### Screenshots:
![WP Dashboard + Multisite transfer users](https://user-images.githubusercontent.com/113178913/190995444-ba0da47f-2633-4e15-9c31-ee134ec9be6f.png)

## Related links:
Download the core Ultimate Member plugin: https://wordpress.org/plugins/ultimate-member/

Ultimate Member home page: https://ultimatemember.com/

Ultimate Member documentation: https://docs.ultimatemember.com/

Article [UM in Multisite](https://docs.ultimatemember.com/article/1717-um-in-multisite)
