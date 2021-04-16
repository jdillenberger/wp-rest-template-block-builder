#!/usr/bin/env bash

ARCHIVE_NAME='wp-rest-template-blocks'

if ! command -v 'npm' &> /dev/null
then
    echo "NPM is not installed. Please install npm and then restart this script."
    exit
fi

# reset subshell
set -e

CURRENT_DIRECTORY=`realpath $(dirname $0)`

# Change into the project directory
pushd "$CURRENT_DIRECTORY"
    
    VERSION=`git branch --show-current`
    
    # install and build with npm
    npm install
    npm run build

    # Create a zip-file containing all files except the ones excluded below
    rm -f "./${ARCHIVE_NAME}.${VERSION}.zip"
    zip -r "${ARCHIVE_NAME}.${VERSION}.zip" . -x './node_modules/*'  './js/*' '*.git*' './README.md' './*.json' './*.sh' '*~*' './webpack*' '*.log' 'Vagrantfile' './*.config.js'

popd

echo "${ARCHIVE_NAME} was build '${CURRENT_DIRECTORY}/${ARCHIVE_NAME}.${VERSION}.zip'"
