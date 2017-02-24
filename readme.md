
## About Stratafy

Stratafy is an online voting for condominium boards aka strata's. It was built to demonstrate how to do BDD in Behat.

- Allow administrators to setup list of owners
- Allow administrators to setup resolutions
- Allow owners to vote on resolutions


## How Behat was installed

```
composer create-project --prefer-dist laravel/laravel stratafy
composer require --dev behat/behat behat/mink behat/mink-extension
vendor/bin/behat --init
```

## How to run Behat tests

`vendor/bin/behat`

Get a list of features with implementations

`vendor/bin/behat -di`

Get a list of definitions

`vendor/bin/behat -dl`


## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
