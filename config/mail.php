<?php

return [
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'from' => array('address' => 'space@auction.com', 'name' => 'Awesome Space Auction'),
    'encryption' => 'tls',
    'username' => 'spaceauction@gmail.com',
    'password' => 'SpaceAuction1',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
];
