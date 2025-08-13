module.exports = {
  apps: [
    {
      name: 'laravel-queue-wallet',
      script: 'php',
      args: ['artisan', 'queue:work', '--queue=wallet-generation', '--verbose', '--tries=3', '--max-time=3600'],
      cwd: '/var/www/ndstudiotest_usr/data/www/ndstudiotestdomain.cfd',
      autorestart: true,
      max_restarts: 10,
      min_uptime: '10s',
      instances: 1,
      exec_mode: 'fork'
    },
    {
      name: 'laravel-queue-broadcast',
      script: 'php',
      args: ['artisan', 'queue:work', '--queue=default', '--verbose', '--tries=3', '--max-time=3600'],
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
      args: ['artisan', 'reverb:start'],
      cwd: '/var/www/ndstudiotest_usr/data/www/ndstudiotestdomain.cfd',
      autorestart: true,
      max_restarts: 10,
      min_uptime: '10s',
      instances: 1,
      exec_mode: 'fork'
    },
    {
      name: 'crash-game-loop',
      script: 'php',
      args: ['artisan', 'crash:run'],
      cwd: '/var/www/ndstudiotest_usr/data/www/ndstudiotestdomain.cfd',
      autorestart: true,
      max_restarts: 10,
      min_uptime: '10s',
      instances: 1,
      exec_mode: 'fork'
    }
  ]
};