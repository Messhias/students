<?php

/**
 * @author Fabio William Conceição
 */

// class namespace.
namespace Core;

// importing the uses statements
use Exception;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

/**
 * View
 *
 * In this class we set up the views and render for the ender user.
 *
 * PHP version 7.1
 */
class View
{
    /**
     * Render a view file
     *
     * @param string $view
     * @param array  $args
     *
     * @return void
     * @throws Exception
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);

        $file = dirname(__DIR__) . "/App/Views/$view";  // relative to Core directory

        if (is_readable($file)) {
            /**
             * Linter bypass
             * @noinspection PhpIncludeInspection
             */
            require $file;
        }
        else {
            throw new Exception("$file not found");
        }
    }

    /**
     * Render a view template using Twig
     *
     * @param string $template
     * @param array $args
     *
     * @return void
     */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new FilesystemLoader(dirname(__DIR__) . '/App/Views');
            $twig = new Environment($loader);
        }

        try {
            echo $twig->render($template, $args);
        } catch (LoaderError $e) {
            echo $e->getMessage();
        } catch (RuntimeError $e) {
            echo $e->getMessage();
        } catch (SyntaxError $e) {
            echo $e->getMessage();
        }
    }
}
