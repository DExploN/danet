<?php

namespace Deployer;

require 'recipe/laravel.php';

inventory('hosts.yml');

set(
    'bin/php',
    function () {
        return '/opt/php74/bin/php';
    }
);

set(
    'bin/composer',
    function () {
        if (commandExist('composer')) {
            $composer = "{{bin/php}} " . locateBinaryPath('composer');
        }

        if (empty($composer)) {
            run("cd {{release_path}} && curl -sS https://getcomposer.org/installer | {{bin/php}}");
            $composer = '{{bin/php}} {{release_path}}/composer.phar';
        }

        return $composer;
    }
);

// Project name
set('application', 'danet');

// Project repository
set('repository', 'https://github.com/DExploN/danet.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);
set('allow_anonymous_stats', false);


task(
    'build',
    function () {
        run('cd {{release_path}} && build');
    }
);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

