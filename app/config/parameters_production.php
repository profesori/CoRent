<?php
    $container->setParameter('locale', 'en');
    $container->setParameter('mailer_transport', "smtp");
    $container->setParameter('mailer_host', "smtp-relay.gmail.com");
    $container->setParameter('mailer_user', "admin@ko-rent.com");
    $container->setParameter('mailer_password', "Golden16");
    $container->setParameter('PER_KONFIRMIM_PRONARI', 1);
    $container->setParameter('KONFIRMUAR', 2);
    $container->setParameter('ANULLUAR', 3);
