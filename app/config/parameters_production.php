<?php
    $db = parse_url(getenv('CLEARDB_DATABASE_URL'));

    $container->setParameter('database_driver', 'pdo_mysql');
    $container->setParameter('database_host', $db['host']);
    $container->setParameter('database_port', $db['port']);
    $container->setParameter('database_name', substr($db["path"], 1));
    $container->setParameter('database_user', $db['user']);
    $container->setParameter('database_password', $db['pass']);
    $container->setParameter('secret', getenv('SECRET'));
    $container->setParameter('locale', 'en');
    $container->setParameter('mailer_transport', "smtp");
    $container->setParameter('mailer_host', "localhost");
    $container->setParameter('mailer_user', "thoma.rudi@gmail.com");
    $container->setParameter('mailer_password', "");
    $contrainer->setParameter('PER_KONFIRMIM_PRONARI', 1);
    $container->setParameter('KONFIRMUAR', 2);
    $container->setParameter('ANULLUAR', 3);
