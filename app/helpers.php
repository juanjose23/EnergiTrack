<?php

// app/helpers.php
if (!function_exists('isModuleActive')) {
    function isModuleActive($submodulos)
    {
        if (is_array($submodulos)) {
            foreach ($submodulos as $submodulo) {
                if (isset($submodulo['enlace']) && isActiveRoute($submodulo['enlace'])) {
                    return true;
                }
                // Si hay sub-submódulos, verifica recursivamente
                if (isset($submodulo['submodulos']) && isModuleActive($submodulo['submodulos'])) {
                    return true;
                }
            }
        }
        return false;
    }
}

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($route)
    {
        // Compara la ruta actual con el nombre de la ruta dada
        return request()->routeIs($route);
    }
}

