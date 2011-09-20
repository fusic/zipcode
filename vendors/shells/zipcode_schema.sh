#!/bin/sh
#
# create schemaコマンドショートカット
#
ROOT=$(cd $(dirname $0);pwd)
php $ROOT/cake/console/cake.php schema create Zipcode -path app/plugins/zipcode/config/schema
