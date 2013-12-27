#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

$DIR/../vendor/bin/doctrine-module orm:schema-tool:drop --force
