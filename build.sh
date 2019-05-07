#!/bin/bash

BOXBIN=`dirname $0`/box
BINDIR=bin/

if [ -z "$1" ]
then
    printf "Usage: $0 <version>\nPrevious tags:\n"
    #git tag -l
    exit 1
fi
version=$1
shift 1

echo "Version: ${version}"

# Make sure vendor/ dir contents is coherent with composer.json
composer install
composer dump-autoload --optimize

# Create temporary distributable application file
sed "s/@@version@@/${version}/" ${BINDIR}/application.php > ${BINDIR}/app.php

# Launch box build command
$BOXBIN build "$@"

# Remove temporary distributable application file
rm ${BINDIR}/app.php

# Post-build processing: 
# - remove phar extension from binary name
# - generate MD5 & SHA384 signature files
cd $BINDIR
mv -v yamltools.phar yamltools
md5sum yamltools | awk '{ print $1; }' > yamltools.md5
sha384sum yamltools | awk '{ print $1; }' > yamltools.sha384
