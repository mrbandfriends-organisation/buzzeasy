<?php

namespace Roots\Sage\Services;

/**
 * Allows access and manipulation of Wordpress menus
 *
 * Example:
 * <?= Menu::get('primary_navigation')->append([
 *     'text' => 'Sit by Mr B & Friends',
 *     'url' => 'http://www.mrbandfriends.co.uk'
 * ]); ?>
 */
class Menu
{
    /**
     * @var string
     */
    private $menuName;

    /**
     * @var array
     */
    private $menuOptions;

    /**
     * @var array
     */
    private $defaultMenuItemData = [
        'modifier' => '',
        'url' => '',
        'text' => '',
        'open_in_new_tab' => false,
    ];

    /**
     * @return Tells the class how to echo 'itself'
     */
    public function __toString()
    {
        return wp_nav_menu([
            'menu' => $this->menuName,
            'container' => 'nav',
            'echo' => false,
            'container_class' => $this->menuOptions['container_class'] ?? '',
            'menu_class' => $this->menuOptions['menu_class'] ?? '',
        ]) ?: '';
    }

    /**
     * @param  string $menuName
     * @param  array  $menuOptions
     * @return object Menu
     */
    public static function get(string $menuName, array $menuOptions = [])
    {
        $class = new static;

        $class->menuName = $menuName;

        $class->menuOptions = $menuOptions;

        return $class;
    }

    /**
     * @param  array  $menuItemData
     * @return object Menu
     */
    public function prepend(array $menuItemData = [])
    {
        $this->registerMenuFilter(function ($menuString, $arguments) use ($menuItemData) {
            if ($arguments->menu === $this->menuName) {
                $menuString = $this->generateMenuItem($menuItemData) . $menuString;
            }

            return $menuString;
        });

        return $this;
    }

    /**
     * @param  array  $menuItemData
     * @return object Menu
     */
    public function append(array $menuItemData = [])
    {
        $this->registerMenuFilter(function ($menuString, $arguments) use ($menuItemData) {
            if ($arguments->menu === $this->menuName) {
                $menuString .= $this->generateMenuItem($menuItemData);
            }

            return $menuString;
        });

        return $this;
    }

    /**
     * @param  callable $callback
     * @return void
     */
    private function registerMenuFilter(callable $callback)
    {
        add_filter('wp_nav_menu_items', $callback, 10, 2);
    }

    /**
     * @param  array  $menuItemData
     * @return string
     */
    private function generateMenuItem(array $menuItemData)
    {
        $menuItemData = array_merge($this->defaultMenuItemData, $menuItemData);

        return sprintf(
            '<li class="menu-item %s"><a %s %s>%s</a></li>',
            $menuItemData['modifier'],
            $menuItemData['url'] ? sprintf('href="%s"', $menuItemData['url']) : '',
            $menuItemData['open_in_new_tab'] ? 'target="_blank" rel="noopener" rel="noreferrer"' : '',
            $menuItemData['text']
        );
    }
}
