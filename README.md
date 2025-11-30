# FileLogger
FileLogger is an PSR-3 Logger for write log in log file

Example usage:
```php
<?php

use QuadruPHP\FileLogger\FileLogger;

$logger = new FileLogger("YourPath");
$logger->info("Hello World!");
```
