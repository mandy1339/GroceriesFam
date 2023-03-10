<?php
class Navigation 
{
    # Get the site name from configuration. Get it only once and remember it in a static variable.
    static function get_site_name()
    {
        static $site_name;
        if (!isset($site_name))
        {
            $config = parse_ini_file(BASEDIR . "/../config.ini");
            //$site_name = '/PersonalBlogDev';
            $site_name = $config['SITE_NAME'];
        }
        return $site_name;
    }


    static function get_navigation_header()
    {
        $the_site_name = self::get_site_name();
        # Display the navigation header
        echo <<<HTML
        <header>
            <nav>           
                <ul>
                    <li><a href="{$the_site_name}/View/ShoppingList.php">Shopping List</a></li>             
                    <li><a href="{$the_site_name}/Controller/LogoutController.php">Log Out</a></li>           
                </ul>
            </nav>
        </header>
HTML;
    }
}
?>