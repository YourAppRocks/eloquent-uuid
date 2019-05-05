# Changelog

All Notable changes to `your-app-rocks/eloquent-uuid` will be documented in this file. This project adheres to [Semantic Versioning](http://semver.org/).

The format is based on [Keep a Changelog](http://keepachangelog.com/).

## [Unreleased]

## [2.0] - 2019-05-05
### Updated

- Fixing "Class was composed in Model" ([#1](https://github.com/YourAppRocks/eloquent-uuid/issues/1))
- **Breaking Change**: `Uuidable` trait: Replaced trait properties ( *$uuidColumnName*, *$uuidVersion* and *$uuidString* ) by 'get' methods with return default value
- **Breaking Change**: `Uuidable` trait: `generateUuid()` method now throws `InvalidUuidVersionException` instead of `InvalidArgumentException`
- **Breaking Change**: `Uuidable` trait: `validateUuidVersion()` method now has visibility `public` instead of `private`
- Refactored all tests

### Removed

- **Breaking Change**: `Uuidable` trait: Removeded `setUuidColumnName()`, `setUuidVersion()` and `setUuidString()` methods.


## [1.2.2] - 2019-02-13
### Added
- Tests against PHP 7.3

### Updated
- Updated dependencies

## [1.2.1] - 2018-05-31
### Added
- Add 'check-style' composer script.

## [1.2.0] - 2018-04-30
### Added
- Add 'findByUuid()' scope query.

## [1.1.0] - 2018-04-29
### Added
- Add support for the custom key name model binding.  [See Laravel Documentation](https://laravel.com/docs/5.7/routing#route-model-binding)

## 1.0.0 - 2018-03-25
### Added
- First Release

[Unreleased]: https://github.com/YourAppRocks/eloquent-uuid/compare/2.0...HEAD

[2.0]: https://github.com/YourAppRocks/eloquent-uuid/compare/1.2.2...2.0
[1.2.2]: https://github.com/YourAppRocks/eloquent-uuid/compare/1.2.1...1.2.2
[1.2.1]: https://github.com/YourAppRocks/eloquent-uuid/compare/1.2.0...1.2.1
[1.2.0]: https://github.com/YourAppRocks/eloquent-uuid/compare/1.1.0...1.2.0
[1.1.0]: https://github.com/YourAppRocks/eloquent-uuid/compare/1.0.0...1.1.0
