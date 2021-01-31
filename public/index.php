<?php declare(strict_types=1);

// app.php will return a closure that will create a slim application instance
// so we then execute the closure to create the instance and call the run() method
// to run the application
(require __DIR__.'/../bootstrap/app.php')()->run();
