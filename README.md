# yannoff/yamltools

The YAML Tools Project: A command-line swiss-knife for `YAML`, written in PHP.


[![Latest Stable Version](https://poser.pugx.org/yannoff/yamltools/v/stable)](https://packagist.org/packages/yannoff/yamltools)
[![Total Downloads](https://poser.pugx.org/yannoff/yamltools/downloads)](https://packagist.org/packages/yannoff/yamltools)
[![License](https://poser.pugx.org/yannoff/yamltools/license)](https://packagist.org/packages/yannoff/yamltools)


## Requirements

- `php` 5.6.40+
- `go-md2man` for advanced configuration (see [Advanced install section](#advanced-install) for details)


## Installation

### Quick install

#### Option A: As a composer global package

_The [yamltools phar](https://github.com/yannoff/yamltools/releases/latest/download/yamltools) may be installed as a global package using [composer](https://getcomposer.org/) or [offenbach](https://github.com/yannoff/offenbach)._

```bash
composer global require yannoff/yamltools
```

or

```bash
offenbach global require yannoff/yamltools
```

> *The `$COMPOSER_HOME/vendor/bin` directory have to be in the `PATH` system-wide environment variable.*

#### Option B: Manual download

Get the latest release and install it

```
curl -Lo /usr/bin/yamltools https://github.com/yannoff/yamltools/releases/latest/download/yamltools
chmod +x /usr/bin/yamltools
```

> _The `/usr/bin/yamltools` path is just an example, fell free to replace by any custom binary file path._

### Advanced install

1. Clone or fetch a zipball from this repository
2. Run configure if you want to fine-tune installation parameters (run `./configure --help` to see available options and invocation _modus operandi_).
3. Compille & install: `make && sudo make install`

## Usage

The YAML Tools Project comes with several utilities to handle YAML from the command-line:

- [Converter](doc/converter.md) : Juggle easily between `JSON` & `YAML` formats
- [Comments](doc/comments.md) : Manipulate YAML comments: export, import & merge

## Acknowledgement

The YAML Tools Project is based on the well-known [symfony/yaml](https://github.com/symfony/yaml) component,
which implements its own engine to dump/parse YAML data.

Two reasons motivated the choice:

- The component is a standalone, pure PHP implementation: no need to have the [Yaml PHP extension](http://pecl.php.net/package/yaml) installed, guaranteeing a wider support for many platforms.
- The dumps are more pretty-print oriented, and more flexible, allowing to customize indentation and inline wrapping level.

The major drawback on the other hand is that the component is [not fully compliant](https://symfony.com/doc/3.4/components/yaml/yaml_format.html#unsupported-yaml-features) with YAML Standards. 

## Credits

Licensed under the [MIT License](LICENSE).

Compiled as a PHAR self-executable using [Box](https://github.com/box-project/box2).
