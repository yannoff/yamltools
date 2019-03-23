# yannoff/yamltools

The YAML Tools Project: A command-line toolbox for `YAML`, written in PHP.

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

### Converting YAML to JSON

```bash
$ yamltools convert:yaml:json <file.yaml> [<file.json>]
```

**Aguments:**

- `file.yaml` The YAML file to read from
- `file.json` The (optional) JSON file to write output to. If no file specified, write to standard output. 

### Converting JSON to YAML

```bash
$ yamltools convert:json:yaml <file.json> [<file.yaml>]
```

**Aguments:**

- `file.json` The JSON file to read from
- `file.yaml` The (optional) YAML file to write output to. If no file specified, write to standard output. 

## Credits

Licensed under the [MIT License](LICENSE).

Compiled as a PHAR self-executable using [Box](https://github.com/box-project/box2).
