<?php

if (!function_exists('dump_r')) {
    /**
     * Custom function to print_r with styled <pre> tags and optional exit.
     *
     * @param mixed $data The data to be dumped.
     * @param bool $exit Whether to exit after dumping. Default is false.
     */
    function dump_r($data, $exit = false)
    {
        echo '<div style="background-color: #d4a778; padding: 10px; border: 2px solid #000; margin: 10px 0;">';
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        echo '</div>';

        if ($exit) {
            exit;
        }
    }
}
