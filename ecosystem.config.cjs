module.exports = {
    apps: [
      {
        name: 'laravel-queue',
        script: 'php',
        args: 'artisan queue:work --queue=wallet-generation,default --sleep=3 --tries=3 --max-time=3600',
        cwd: '/var/www/ndstudiotest_usr/data/www/ndstudiotestdomain.cfd',
        autorestart: true,
        max_restarts: 10,
        min_uptime: '10s',
        instances: 1,
        exec_mode: 'fork'
      },
      {
        name: 'laravel-reverb',
        script: 'php',
        args: 'artisan reverb:start',
        cwd: '/var/www/ndstudiotest_usr/data/www/ndstudiotestdomain.cfd',
        autorestart: true,
        max_restarts: 10,
        min_uptime: '10s',
        instances: 1,
        exec_mode: 'fork'
      }
    ]
  };