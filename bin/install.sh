#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

$DIR/../vendor/bin/doctrine-module orm:schema-tool:create
$DIR/../vendor/bin/doctrine-module orm:generate-proxies
$DIR/../vendor/bin/doctrine-module data-fixture:import
