# YAML Tools : Comments 

A command-line utility to export, import, merge `YAML` comments.

## Usage

### Merging: incorporate comments from one file to another

If invoked without the `--write` option, the resulting YAML will be printed to standard output.

```bash
$ yamltools yaml:comments:merge [options] <original.yaml> <target.yaml>
```

**Arguments:**

- `original.yaml` The original YAML file to read comments from
- `target.yaml`   The target YAML file in which comments should be incorporated

**Options:**

- `-w`, `--write` Write contents to the target file

### Exporting: dump comments information from a commented YAML file

```bash
$ yamltools yaml:comments:export [options] <original.yaml> [<dump.yaml>]
```

**Arguments:**

- `original.yaml` The original YAML file to read comments from
- `dump.yaml`     Optional file to store the dump. If no one provided, print to stdout.

### Importing: restore comments inside YAML file from a previous dump

If invoked without the `--write` option, the resulting YAML will be printed to standard output.

```bash
$ yamltools yaml:comments:import [options] <dump.yaml> <target.yaml>
```

**Arguments:**

- `dump.yaml`   The information file to load the dump from.
- `target.yaml` The target YAML file in which comments should be incorporated

**Options:**

- `-w`, `--write` Write contents to the target file

## Limitations

- Multi-line comment blocks are supported with the caveat that merging in an already commented target file may give unexpected results.
- Blank lines (which in YAML are also considered comments) are [not yet supported](https://github.com/yannoff/y-a-m-l/issues/2).
- Multi-document YAML streams are not meant to be supported and will never be.
