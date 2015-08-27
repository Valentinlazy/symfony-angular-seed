Seed project
========================

## What included

 - Configured PHP 5.6
 - Configured Nginx
 - Configured PostgreSQL 9.4 (via [ANXS.postgresql](https://github.com/ANXS/postgresql))
 - [MailDev](http://djfarrelly.github.io/MailDev/) for email debugging and functional tests
 - Symfony 2.7 standard edition
 - Doctrine ORM 2.5
 - Enabled APCu cache for Doctrine and Validator (only in prod environment)
 - Gulp build toolchain
 - Angular

## Required software

 - VirtualBox
 - [Vagrant](https://www.vagrantup.com/)
 - [vagrant-host-shell](https://github.com/phinze/vagrant-host-shell) for auto install galaxy roles
 - [Vagrant Host Manager](https://github.com/smdahlen/vagrant-hostmanager) for handling local DNS and DHCP instead of static IP
 - [Ansible](http://docs.ansible.com/intro_installation.html)

## Development

To prepare your local dev environment just run `vagrant up`. All actions to setup projects should be automated and ideally shouldn't require any manual actions. Project will be available at [seed.vagrant](http://seed.vagrant).

## Deployment

To deploy project on real server you can use ansible. For example, this commands:

```
gulp buildPack
ansible-playbook ansible/playbook.yml --limit=server --sudo --ask-sudo-pass
```

You have to replace example server config in file `ansible/inventories/hosts`.

### Ansible verbocity level

If you want to debug your ansible provisioner, you can just run `vagrant provision --debug`. Also you can specify verbosity level via `VAGRANT_LOG` env variable (`info` or `debug`)

### XDebug

This project template provides simple remote debugging with xdebug. To use xdebug sessions verify that your IDE KEY is `PHPSTORM` and xdebug port is `9000`.
