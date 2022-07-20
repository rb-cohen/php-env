# php-env
Useful function for getting envrionment varibles for config, with a default fallback if the variable is not set.

## Functions

### env($name, $default = null)
Looks for an environment variable called `$name`, returning `$default` if the variable is not available.

`$default` can be an anonymous function, which will be called to obtain a value if the environment variable is not set.

Strings 'true', 'false' and 'null' will be converted to their PHP types `true`, `false` and `null`.

### env_to_array($name, $default = array())
Similar to env, calls env internally, but will split the env variable or default value in to an array by comma.

Also trims the array values.

### resolve_value($value)

Used by `env()` to recursively call anonymous functions to resolve a value if the variable is not set.

## Examples
### Basic config
```php
$config = [
  'mysql' => [
    'host' => env('DB_HOST', 'localhost'),
    'username' => env('DB_USERNAME', 'dbuser'),
    'password' => env('DB_PASSWORD'),
    'dbname' => env('DB_NAME', 'my_database'),
  ]
];
```

### Using an anonymous function
```php
$username = env('USER', function(){
  return exec('whoami');
});
```
