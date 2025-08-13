module.exports = {
  apps: [
    {
      name: 'laravel-queue',
      script: '/var/www/ndstudiotest_usr/data/www/ndstudiotestdomain.cfd/queue-worker.sh',
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