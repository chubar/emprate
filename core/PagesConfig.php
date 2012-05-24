<?php

/**
 * @author mchubar
 */
class PagesConfig {

    private static $pages = array(
        '404' => array(),
        'test' => array(
            'title' => 'Test Page',
            'layout' => 'standart',
            'css' => array(
                array('href' => '/static/css/test.css'),
            ),
            'js' => array(
                array('href' => '/static/js/test.js'),
            ),
            'blocks' => array(
                'content' => array(
                    array('name' => 'test', 'action' => 'show', 'mode' => 'test'),
                ),
            ),
        ),
        // Главная страница
        'index' => array(
            'title' => 'EmployeerRate',
            'layout' => 'standart',
            'css' => array(
                array('href' => '/static/css/index.css'),
            ),
            'js' => array(
                array('href' => '/static/js/index.js'),
            ),
            'blocks' => array(
            ),
        ),
        // Мой Профиль
        'my_profile' => array(
            'title' => 'Профиль пользователя',
            'layout' => 'standart',
            'css' => array(
                array('href' => '/static/css/profile.css'),
            ),
            'js' => array(
                array('href' => '/static/js/profile.js'),
            ),
            'blocks' => array(
                'content' => array(
                    array('name' => 'user', 'action' => 'show', 'mode' => 'profile'),
                ),
            ),
        ),
        // Профиль
        'profile' => array(
            'title' => 'Профиль пользователя',
            'layout' => 'standart',
            'css' => array(
                array('href' => '/static/css/profile.css'),
            ),
            'js' => array(
                array('href' => '/static/js/profile.js'),
            ),
            'blocks' => array(
                'content' => array(
                    array('name' => 'user', 'action' => 'show', 'mode' => 'profile'),
                ),
            ),
        ),
        // Редактирование профиля
        'profile_edit' => array(
            'title' => 'Редактирование профиля',
            'layout' => 'standart',
            'css' => array(
                array('href' => '/static/css/profile.css'),
            ),
            'js' => array(
                array('href' => '/static/js/profile.js'),
            ),
            'blocks' => array(
                'content' => array(
                    array('name' => 'user', 'action' => 'edit', 'mode' => 'profile'),
                ),
            ),
        ),
        // Logout
        'logout' => array(
            'title' => 'EmployeerRate',
            'layout' => 'standart',
            'css' => array(
                array('href' => '/static/css/logout.css'),
            ),
            'js' => array(
                array('href' => '/static/js/index.js'),
            ),
            'blocks' => array(
                'content' => array(
                    array('name' => 'user', 'action' => 'show', 'mode' => 'logout'),
                ),
            ),
        ),
        // Регистрация
        'register' => array(
            'title' => 'Регистрация',
            'layout' => 'fiftyfifty',
            'css' => array(
                array('href' => '/static/css/5050.css'),
            ),
            'js' => array(
                array('href' => '/static/js/register.js'),
            ),
            'blocks' => array(
                'content' => array(
                    array('name' => 'user', 'action' => 'show', 'mode' => 'register_email_snippet'),
                ),
                'sidebar' => array(
                    array('name' => 'user', 'action' => 'show', 'mode' => 'register_invite_snippet'),
                ),
            ),
        ),
    );
    // эти модули и настройки- на всех страницах по умолчанию
    private static $pages_default = array(
        'js' => array(
            array('href' => '/static/js/jquery.min.js'),
        ),
        'css' => array(
            array('href' => '/static/css/style.css'),
        ),
        'blocks' => array(
            'top' => array(
                array('name' => 'user', 'action' => 'show', 'mode' => 'login'),
            ),
        ),
    );

    public static function get($page_name) {
        global $dev_mode;
        $config = array();
        $p404 = false;
        if (isset(self::$pages[$page_name])) {
            $config = self::$pages[$page_name];
        } else {
            $config = self::$pages['404'];
            $p404 = true;
        }
        // apply default
        if (!$p404) {
            //blocks
            if (isset(self::$pages_default['blocks'])) {
                foreach (self::$pages_default['blocks'] as $blockname => $modules) {
                    foreach ($modules as $module) {
                        $config['blocks'][$blockname][] = $module;
                    }
                }
            }
            if (isset(self::$pages_default['css'])) {
                foreach (self::$pages_default['css'] as &$css) {
                    if ($dev_mode)
                        $css['href'].='?' . time();
                    $css['href'].='default';
                    $config['css'][] = $css;
                }
            }
            $tjs = array();
            if (isset(self::$pages_default['js'])) {
                foreach (self::$pages_default['js'] as $js) {
                    if ($dev_mode)
                        $js['href'].='?' . time();
                    $js['href'].='default';
                    $tjs [] = $js;
                }
            }

            foreach ($config['js'] as &$js) {
                if ($dev_mode)
                    $js['href'].='?' . time();
                $tjs [] = $js;
            }
            $config['js'] = $tjs;
        }
        return $config;
    }

}