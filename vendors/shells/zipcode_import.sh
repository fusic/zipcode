#!/bin/sh
#
# 郵便番号インポートshショートカット
# ※このshはROOTに置いて実行して下さい
#
ROOT=$(cd $(dirname $0);pwd)
php $ROOT/cake/console/cake.php zipcode_import
