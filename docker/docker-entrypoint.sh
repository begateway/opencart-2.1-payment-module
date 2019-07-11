#!/bin/bash
set -e

# setup opencart
/install-opencart.sh

# run apache2
/usr/bin/supervisord -n

exec "$@"
