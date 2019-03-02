#!/bin/bash

BOXBIN=`dirname $0`/box
BINDIR=bin/

# Make sure vendor/ dir contents is coherent with composer.json
composer install

# Launch box build command
$BOXBIN build "$@"

# Post-build processing: 
# - remove phar extension from binary name
# - generate MD5 & SHA384 signature files
cd $BINDIR
mv -v yamltools.phar yamltools
md5sum yamltools | awk '{ print $1; }' > yamltools.md5
sha384sum yamltools | awk '{ print $1; }' > yamltools.sha384
