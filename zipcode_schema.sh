#!/bin/sh
#
# create schemaコマンドショートカット
#
ROOT=$(cd $(dirname $0);pwd)
php $ROOT/app/Console/cake.php schema create Zipcode --path app/Plugin/Zipcode/Config/Schema
