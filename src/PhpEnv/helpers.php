<?php

if(!function_exists('env')){
    function env($name, $default = null){
        $value = getenv($name);

        if ($value === false) {
            return resolve_value($default);
        }

        switch (strtolower($value)) {
            case 'true':
                return true;
            case 'false':
                return false;
            case 'null':
                return null;
        }

        return $value;
    }
}

if(!function_exists('resolve_value')){
    function resolve_value($value){
        if(is_callable($value)){
            $result = $value();
            return resolve_value($result);
        }

        return $value;
    }
}