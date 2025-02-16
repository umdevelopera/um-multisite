# Ultimate Member - Multisite
Changes the registration and uploads logic on multisite.

The [Ultimate Member](https://wordpress.org/plugins/ultimate-member/) plugin supports individual registration and individual uploads (profile photo, cover photo, etc.) for every site in the network. See [UM in Multisite](https://docs.ultimatemember.com/article/1717-um-in-multisite).
This extension changes the registration and upload logic on multisite to use common registration and common uploads for all sites in the network.

## Key features
- The extension automatically adds users who are registering on one site to all sites.
- The directory for user uploads is changed. All sites use a common directory. Photos uploaded on one site are used for all sites.
- The extension adds the "Multisite transfer users" widget to WordPress dashboard.

## Installation

### Clone from GitHub

Open git bash, navigate to the **plugins** folder and execute this command:

`git clone --branch=main git@github.com:umdevelopera/um-multisite.git um-multisite`

Once the plugin is cloned, enter your site admin dashboard and go to _wp-admin > Plugins > Installed Plugins_. Find the **Ultimate Member - Multisite** plugin and click the **Activate** link.

### Install from ZIP archive

You can install this plugin from the [ZIP file](https://drive.google.com/file/d/1OqUsg-yYTimFUf9P_3k1NKbx0cOApqdY/view) as any other plugin. Follow [this instruction](https://wordpress.org/support/article/managing-plugins/#upload-via-wordpress-admin).

## How to use

The extension automatically syncs new users and their uploads across all sites in the network.

You can use a tool to sync old existing users and their uploads. Go to _wp-admin > Dashboard > Home_. 
You'll see the **Multisite transfer users** widget here. This widget contains two tools:
- The first tool transfers users and their uploads from site to site in the network.
- The second tool transfers users from the main site to all sites and copies users uploads from sites to the common uploads directory.

Go to the second tool and click the **Sync** button.

![WP Dashboard + Multisite transfer users](https://user-images.githubusercontent.com/113178913/190995444-ba0da47f-2633-4e15-9c31-ee134ec9be6f.png)

## Support

This is a free extension created for the community. The Ultimate Member team does not provide support for this extension.
Open new [issue](https://github.com/umdevelopera/um-multisite/issues) if you are facing a problem or have a suggestion.

**Give a star if you think this extension is useful. Thanks.**

## Useful links

[Ultimate Member core plugin info and download](https://wordpress.org/plugins/ultimate-member)

[Documentation for Ultimate Member](https://docs.ultimatemember.com)

[Official extensions for Ultimate Member](https://ultimatemember.com/extensions/)

[Free extensions for Ultimate Member](https://docs.google.com/document/d/1wp5oLOyuh5OUtI9ogcPy8NL428rZ8PVTu_0R-BuKKp8/edit?usp=sharing)

[Code snippets for Ultimate Member](https://docs.google.com/document/d/1_bikh4JYlSjjQa0bX1HDGznpLtI0ur_Ma3XQfld2CKk/edit?usp=sharing)
