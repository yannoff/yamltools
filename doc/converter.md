# YAML Tools : Converter 

A command-line utility to juggle easily with `JSON` & `YAML`.

## Usage

- [YAML to JSON Converter](#converting-yaml-to-json)
- [JSON to YAML Converter](#converting-json-to-yaml)

### Converting YAML to JSON

```bash
$ yamltools convert:yaml:json <file.yaml> [<file.json>]
```

Or using the short-hand wrapper script

```bash
$ yaml2json <file.yaml> [<file.json>]
```

**Arguments:**

- `file.yaml` The YAML file to read from
- `file.json` The (optional) JSON file to write output to. If no file specified, write to standard output. 

### Converting JSON to YAML

```bash
$ yamltools convert:json:yaml <file.json> [<file.yaml>]
```

Or using the short-hand wrapper script:

```bash
$ json2yaml <file.json> [<file.yaml>]
```

**Arguments:**

- `file.json` The JSON file to read from
- `file.yaml` The (optional) YAML file to write output to. If no file specified, write to standard output. 

