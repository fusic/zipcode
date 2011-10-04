#!/bin/sh
#
# 郵便番号インポートshショートカット
# ※このshはROOTに置いて実行して下さい
#
ROOT=$(cd $(dirname $0);pwd)
php $ROOT/app/Console/cake.php Zipcode.zipcode_import
