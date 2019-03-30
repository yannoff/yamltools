# yannoff/yamltools

The YAML Tools Project: A command-line swiss-knife for `YAML`, written in PHP.

## Requirements

- `php` 5.5.9+ | 7.0.8+
- `go-md2man` for advanced configuration (see [Advanced install section](#advanced-install) for details)


## Quick installation

1. Clone or fetch a zipball from this repository
2. Run `sudo make install`

## Advanced install 

1. Clone or fetch a zipball from this repository
2. Run configure if you want to fine-tune installation parameters (run `./configure --help` to see available options and invocation _modus operandi_).
3. Compille & install: `make && sudo make install`

## Usage

The YAML Tools Project comes with several utilities to handle YAML from the command-line:

- [Converter](doc/converter.md) : Juggle easily between `JSON` & `YAML` formats

## Credits

Licensed under the [MIT License](LICENSE).

Compiled as a PHAR self-executable using [Box](https://github.com/box-project/box2).
