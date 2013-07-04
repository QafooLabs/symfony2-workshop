
exec { 'apt-get update':
  command => 'apt-get update',
  path    => '/usr/bin/',
  timeout => 60,
  tries   => 3,
}

class { 'apt':
  always_apt_update => true,
}

package { ['python-software-properties']:
  ensure  => 'installed',
  require => Exec['apt-get update'],
}

file { '/home/vagrant/.bash_aliases':
  ensure => 'present',
  source => 'puppet:///modules/puphpet/dot/.bash_aliases',
}

package { ['build-essential', 'vim', 'curl']:
  ensure  => 'installed',
  require => Exec['apt-get update'],
}

class { 'apache': }

apache::dotconf { 'custom':
  content => 'EnableSendfile Off',
}

apache::module { 'rewrite': }

apache::vhost { 'workshop.dev':
  server_name    => 'workshop.dev',
  docroot        => '/srv/www/vhosts/workshop.dev/web',
  directory      => '/srv/www/vhosts/workshop.dev',
  options        => 'FollowSymLinks',
  allow_override => 'All'
}

apt::ppa { 'ppa:ondrej/php5':
  before  => Class['php'],
}

class { 'php':
  service => 'apache',
  require => Package['apache'],
}

php::module { 'php5-mysql': }
php::module { 'php5-cli': }
php::module { 'php5-curl': }
php::module { 'php5-intl': }
php::module { 'php5-mcrypt': }

class { 'php::devel':
  require => Class['php'],
}


class { 'php::composer':
  require => Package['php5', 'curl'],
}

php::ini { 'php':
  value   => ['date.timezone = "Europe/Berlin"'],
  target  => 'php.ini',
  service => 'apache',
}
php::ini { 'custom':
  value   => ['display_errors = On', 'error_reporting = -1'],
  target  => 'custom.ini',
  service => 'apache',
}

class { 'mysql':
  root_password => 'test123',
  require       => Exec['apt-get update'],
}

mysql::grant { 'ez':
  mysql_privileges     => 'ALL',
  mysql_db             => 'workshop',
  mysql_user           => 'workshop',
  mysql_password       => 'workshop',
  mysql_host           => 'localhost',
  mysql_grant_filepath => '/home/vagrant/puppet-mysql',
}

package{ "git":
    ensure => present,
}