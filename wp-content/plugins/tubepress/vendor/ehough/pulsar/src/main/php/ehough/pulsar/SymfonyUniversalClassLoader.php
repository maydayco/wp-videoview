<?php
/**
 * Copyright 2012 Eric D. Hough (http://ehough.com)
 *
 * This file is part of pulsar (https://github.com/ehough/pulsar)
 *
 * pulsar is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * pulsar is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with pulsar.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

/**
 * This class is nearly identical to the UniversalClassLoader from Symfony. The only differences are
 * that it's compliant with PHP < 5.3 and there are a few code style changes.
 *
 * https://github.com/symfony/ClassLoader/blob/master/UniversalClassLoader.php
 * https://github.com/symfony/ClassLoader/blob/master/LICENSE
 */

/**
 * For Symfony...
 *
 * Copyright (c) 2004-2012 Fabien Potencier
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * UniversalClassLoader implements a "universal" autoloader for PHP 5.
 *
 * It is able to load classes that use either:
 *
 *  * The technical interoperability standards for PHP 5.3 namespaces and
 *    class names (https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md);
 *
 *  * The PEAR naming convention for classes (http://pear.php.net/).
 *
 * Classes from a sub-namespace or a sub-hierarchy of PEAR classes can be
 * looked for in a list of locations to ease the vendoring of a sub-set of
 * classes for large projects.
 *
 * Example usage:
 *
 *     $loader = new UniversalClassLoader();
 *
 *     // register classes with namespaces
 *     $loader->registerNamespaces(array(
 *         'Symfony\Component' => dirname(__FILE__).'/component',
 *         'Symfony'           => dirname(__FILE__).'/framework',
 *         'Sensio'            => array(dirname(__FILE__).'/src', dirname(__FILE__).'/vendor'),
 *     ));
 *
 *     // register a library using the PEAR naming convention
 *     $loader->registerPrefixes(array(
 *         'Swift_' => dirname(__FILE__).'/Swift',
 *     ));
 *
 *
 *     // to enable searching the include path (e.g. for PEAR packages)
 *     $loader->useIncludePath(true);
 *
 *     // activate the autoloader
 *     $loader->register();
 *
 * In this example, if you try to use a class in the Symfony\Component
 * namespace or one of its children (Symfony\Component\Console for instance),
 * the autoloader will first look for the class under the component/
 * directory, and it will then fallback to the framework/ directory if not
 * found before giving up.
 *
 */
class ehough_pulsar_SymfonyUniversalClassLoader
{
    private $_registeredDirectories = array();

    private $_fallbackDirs = array();

    /**
     * Gets the configured class prefixes.
     *
     * @return array A hash with class prefixes as keys and directories as values
     */
    public final function getRegisteredDirectories()
    {
        return $this->_registeredDirectories;
    }

    /**
     * Gets the directory(ies) to use as a fallback for class prefixes.
     *
     * @return array An array of directories
     */
    public final function getFallbackDirectories()
    {
        return $this->_fallbackDirs;
    }

    /**
     * Registers directories to use as a fallback for class prefixes.
     *
     * @param array $dirs An array of directories.
     *
     * @return void
     */
    public final function registerFallbackDirectories(array $dirs)
    {
        $this->_fallbackDirs = array_merge($this->_fallbackDirs, $dirs);
    }

    /**
     * Registers a directory to use as a fallback for class prefixes.
     *
     * @param string $dir A directory.
     *
     * @return void
     */
    public final function registerFallbackDirectory($dir)
    {
        $this->_fallbackDirs[] = $dir;
    }

    /**
     * Registers an array of classes using the PEAR naming convention.
     *
     * @param array $classes An array of classes (prefixes as keys and locations as values).
     *
     * @return void
     */
    public final function registerDirectories(array $classes)
    {
        foreach ($classes as $prefix => $locations) {

            $this->_registeredDirectories[$prefix] = $this->_safeToArray($locations);
        }
    }

    /**
     * Registers a set of classes using the PEAR naming convention.
     *
     * @param string       $prefix The classes prefix.
     * @param array|string $paths  The location(s) of the classes.
     *
     * @return void
     */
    public final function registerDirectory($prefix, $paths)
    {
        $this->_registeredDirectories[$prefix] = $this->_safeToArray($paths);
    }

    /**
     * Registers this instance as an autoloader.
     *
     * @param boolean $prepend Whether to prepend the autoloader or not.
     *
     * @return void
     */
    public final function register($prepend = false)
    {
        //override point
        $this->onBeforeRegister();

        // We need a special call to the autoloader for PHP 5.2, missing the
        // third parameter.
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {

            spl_autoload_register(array($this, 'loadClass'), true);

        } else {

            spl_autoload_register(array($this, 'loadClass'), true, $prepend);
        }
    }

    /**
     * Loads the given class or interface.
     *
     * @param string $class The name of the class.
     *
     * @return void
     */
    public final function loadClass($class)
    {
        $file = $this->_findFile($class);

        if ($file) {

            /** @noinspection PhpIncludeInspection */
            require $file;
        }
    }

    /**
     * Finds the path to the file where the class is defined.
     *
     * @param string $class The name of the class.
     *
     * @return string|null The path, if found
     */
    private function _findFile($class)
    {
        $file = $this->findFileDefiningClass($class);

        if ($file !== null) {

            return $file;
        }

        if ('\\' == $class[0]) {

            $class = substr($class, 1);
        }

        $pos = strrpos($class, '\\');

        if ($pos !== false) {

            // namespaced class name
            $namespace = substr($class, 0, $pos);
            $className = substr($class, ($pos + 1));
            $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;

        } else {

            // PEAR-like class name
            $classPath = null;
            $className = $class;
        }

        $classPath .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        foreach ($this->_registeredDirectories as $prefix => $dirs) {

            if ($prefix[0] !== $class[0]) {

                continue;
            }

            if (strpos($class, $prefix) !== 0) {

                continue;
            }

            $file = $this->_tryToLoadFromLocations($dirs, $classPath);

            if ($file !== null) {

                return $file;
            }
        }

        $file = $this->_tryToLoadFromLocations($this->_fallbackDirs, $classPath);

        if ($file !== null) {

            return $file;
        }

        return false;
    }

    /**
     * Child classes can override this to perform "quick" lookups.
     *
     * @param string $class The class to lookup.
     *
     * @return string The file containing the definition for the class parameter, or null if not found.
     */
    protected function findFileDefiningClass($class)
    {
        //override point
        return null;
    }

    /**
     * Hook for actions to perform immediately before this classloader is registered with PHP.
     *
     * @return void
     */
    protected function onBeforeRegister()
    {
        //override point
    }

    /**
     * Tries to load the class from a fallback location.
     *
     * @param array  $locations       An array of fallback locations.
     * @param string $normalizedClass The class to load.
     *
     * @return null|string The location of the file defining the class. Null otherwise.
     */
    private function _tryToLoadFromLocations(array $locations, $normalizedClass)
    {
        foreach ($locations as $location) {

            $file = $location . DIRECTORY_SEPARATOR . $normalizedClass;

            if (is_file($file)) {

                return $file;
            }
        }

        return null;
    }

    /**
     * Wraps non-array data into an array.
     *
     * @param mixed $candidate The data to conditionally wrap.
     *
     * @return array An array.
     */
    private function _safeToArray($candidate)
    {
        if (is_array($candidate)) {

            return $candidate;
        }

        return array($candidate);
    }
}