#!/bin/bash
cd /var/www/ndstudiotest_usr/data/www/ndstudiotestdomain.cfd
php artisan queue:work --queue=wallet-generation --verbose --tries=3 --max-time=3600
