<?php

namespace WpAdv;

/**
 * Allows you to bind an instance to a key so that you can
 * retrieve the instance in a global/static scope.
 */
class App
{

    /**
     * An array of all the application bindings.
     *
     * @var array
     */
    private static $bindings = [];

    /**
    * Bind an object to a key in a bindings array.
    *
    * @param string $key The key to store it under
    * @param object $object The object we're storing
    */
    public static function bind($key, $object)
    {
        self::$bindings[$key] = $object;
    }

    /**
    * Grab an instance which has already been binded to this container
    * otherwise we'll return null.
    *
    * @param string $key The key we're storing it under
    * @return objet|boolean The object which is stored OR false
    */
    public static function instance($key)
    {
        if(isset(self::$bindings[$key]))
        {
            return self::$bindings[$key];
        }

        return false;
    }

    /**
     * What happens when we call a static method that doesn't exist,
     * maybe we should return an instance with that name if it exists.
     *
     * @param string $name The name of the function, we'll use it as the key
     * @param array $args The arguments passed to that function
     * @return object The object instance
     */
    public static function __callStatic($name, $args)
    {
        return self::instance($name);
    }

}
