<?php

/**
 * @author mchubar
 */
class Map {
    /*
      Главная
      Регистрация разводная
      Регистрация по email
      Регистрация по инвайту
      Личный кабинет
      Профиль фирмы
      Профиль пользователя
      Рейтинг фирм
      Рейтинг пользователей
      Создание инвайта разводная
      Создание инвайта втроем
      Создание инвайта работодателем

     */

    public static $map = array(
        'index' => array(
            '' => 'index',
        ),
        'logout' => array(
            '' => 'logout',
        ),
        'register' => array(
            '' => 'register',
            'email' => 'register_email',
            'invite' => 'register_invite',
        ),
        'profile' => array(
            '' => 'my_profile',
            'edit' => 'profile_edit',
            '%s' => 'profile',
            '%d' => 'profile',
        ),
        'company' => array(
            '' => 'company',
        ),
        'ratings' => array(
            '' => 'ratings',
            'people' => 'rating_people',
            'company' => 'rating_company',
        ),
        'invite' => array(
            '' => 'invite',
            'coop' => 'invite_coop',
            'boss' => 'invite_boss',
        ),
        'test' => array(
            '' => 'test',
            'me' => array(
                '' => 'test',
                'please' => array(
                    '' => 'test',
                    '%s' => 'test',
                    '%d' => 'test'
                )
            ),
        ),
    );

    public static function getPageConfiguration(array $url_array) {
        $url_array = count($url_array) ? $url_array : array('index');
        $page_name = false;
        foreach (Map::$map as $page => $subparams) {
            if ($url_array[0] === $page) {
                $page_name = Map::getSubpageConfiguration($url_array, $subparams);
            }
        }
        if (!$page_name)
            throw new Exception('no route for ' . implode('/', $url_array));

        $config = PagesConfig::get($page_name);
        if (!count($config))
            throw new Exception('no configuration for route [' . $page_name . ']');
        return $config;
    }

    private static function getSubpageConfiguration($url_array, $subparams, $max_page_name = '') {

        if (!is_array($subparams))
            return $subparams;

        array_shift($url_array);

        $next_url_part = isset($url_array[0]) ? $url_array[0] : '';

        foreach ($subparams as $page => $subparams_) {
            if ($page === '')
                $max_page_name = $subparams_;
            if ($next_url_part === $page) {
                return Map::getSubpageConfiguration($url_array, $subparams_, $max_page_name);
            }
        }

        if (is_numeric($next_url_part)) {
            foreach ($subparams as $page => $subparams_) {
                if ('%d' === $page) {
                    return Map::getSubpageConfiguration($url_array, $subparams_, $max_page_name);
                }
            }
        }

        foreach ($subparams as $page => $subparams_) {
            if ('%s' === $page) {
                return Map::getSubpageConfiguration($url_array, $subparams_, $max_page_name);
            }
        }

        return $max_page_name;
    }

}