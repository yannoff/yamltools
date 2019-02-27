#!/bin/bash

BOXBIN=`dirname $0`/box
BINDIR=bin/

$BOXBIN build "$@"
cd $BINDIR
mv -v yamltools.phar yamltools
md5sum yamltools | awk '{ print $1; }' > yamltools.md5
sha384sum yamltools | awk '{ print $1; }' > yamltools.sha384
