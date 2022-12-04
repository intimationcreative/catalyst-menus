<?php

namespace Intimation\Catalyst;

class MenusElement extends Element
{
    const REGISTER = 'register';
    const UNREGISTER = 'unregister';

    public function init()
    {
        if (array_key_exists(self::REGISTER, $this->config)) {
            $this->add($this->config[self::REGISTER]);
        }

        if (array_key_exists(self::UNREGISTER, $this->config)) {
            $this->remove($this->config[self::UNREGISTER]);
        }
    }

    protected function add(array $nav_menus)
    {
        foreach ($nav_menus as $nav_menu) {
            /**
             * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
             */
            register_nav_menu($nav_menu[Menu::SLUG], $nav_menu[Menu::DESCRIPTION]);
        }
    }

    protected function remove(array $nav_menu_slugs)
    {
        /**
         * @link https://developer.wordpress.org/reference/functions/unregister_nav_menu/
         */
        array_map('unregister_nav_menu', $nav_menu_slugs);
    }
}
