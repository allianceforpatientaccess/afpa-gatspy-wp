# WordPress theme for use with [afpa-gatsby](https://github.com/avinoamsn/afpa-gatsby)

## Directions for local installation

1. Download [**xampp**](https://www.apachefriends.org/download.html) (or [**mamp**](https://www.mamp.info/en/downloads/), depending on your OS).
2. Clone this repo to the `htdocs` folder/directory of your xampp (or mamp) installation: `git clone https://github.com/woodberryassociates/afpa-gatsby-wp`.
3. [Install WordPress](https://wordpress.org/support/article/how-to-install-wordpress/):
    - Download & unzip.
    - Copy the contents of the `wordpress` directory to the site's root directory (`htdocs/afpa-gatsby-wp`).
    - [Create a database](https://wordpress.org/support/article/creating-database-for-wordpress/#using-phpmyadmin) with **phpMyAdmin** (included in the xampp installation).
4. Start xampp's **Apache** & **MySQL** services and navigate to the site in your browser (the address uses the root directory's name - in this case, it's `http://localhost/afpa-gatsby-wp`).
    - If the install script doesn't execute (i.e. your browser isn't showing the WP config dialog/you weren't redirected to `/wp-admin/setup-config.php`), something isn't working as expected - review the instructions above.
5. Activate the **Alliance for Patient Access** theme under **Appearance** -> **Themes** in the WP admin dashboard.

### Notes

- The actual theme files can be found under [wp-content/themes/afpa-gatsby-wp](https://github.com/woodberryassociates/afpa-gatsby-wp/tree/master/wp-content/themes/afpa-gatsby-wp).
