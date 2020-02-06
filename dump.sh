#!/bin/bash

# See http://stackoverflow.com/questions/59895/can-a-bash-script-tell-what-directory-its-stored-in/23905052#23905052
ROOT=$(readlink -f $(dirname "$0"))

cd $ROOT



