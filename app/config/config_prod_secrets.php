<?php
$secrets = getenv("APP_SECRETS");
if (!$secrets) {
    return;
}

// read the file and decode json to an array
$secrets = json_decode(file_get_contents($secrets), true);

// set database parameters to the container
if (isset($secrets['MYSQL'])) {
    $container->setParameter('database_driver', 'pdo_mysql');
    $container->setParameter('database_host', $secrets['MYSQL']['HOST']);
    $container->setParameter('database_name', $secrets['MYSQL']['DATABASE']);
    $container->setParameter('database_user', $secrets['MYSQL']['USER']);
    $container->setParameter('database_password', $secrets['MYSQL']['PASSWORD']);
}

//Set mail params to container
$container->setParameter('locale', 'en');
$container->setParameter('mailer_transport', "smtp");
$container->setParameter('mailer_host', "smtp-relay.gmail.com");
$container->setParameter('mailer_user', "admin@ko-rent.com");
$container->setParameter('mailer_password', "Golden16");

//set status params
$container->setParameter('PER_KONFIRMIM_PRONARI', 1);
$container->setParameter('KONFIRMUAR', 2);
$container->setParameter('ANULLUAR', 3);

// check if the Memcache component is present
if (isset($secrets['MEMCACHE'])) {
    $memcache = $secrets['MEMCACHE'];
    $handlers = array();

    foreach (range(1, $memcache['COUNT']) as $num) {
        $handlers[] = $memcache['HOST'.$num].':'.$memcache['PORT'.$num];
    }

    // apply ini settings
    ini_set('session.save_handler', 'memcached');
    ini_set('session.save_path', implode(',', $handlers));

    if ("2" === $memcache['COUNT']) {
        ini_set('memcached.sess_number_of_replicas', 1);
        ini_set('memcached.sess_consistent_hash', 1);
        ini_set('memcached.sess_binary', 1);
    }
}
