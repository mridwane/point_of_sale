<?php 

use Jenssegers\Blade\Blade;

if (!function_exists('view'))
{
    function view($view, $data = [])
    {
        $viewDirectory = APPPATH. 'views';
        $cacheDirectory = APPPATH. 'cache';

        $blade = new Blade($viewDirectory, $cacheDirectory);
        echo $blade->make($view, $data);
    }
}

?>