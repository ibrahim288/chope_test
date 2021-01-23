#!/bin/sh
# wait-for-composer.sh
while ping -c1 chope_test_composer &>/dev/null; do sleep 1; done; echo 'Composer Finished!'
