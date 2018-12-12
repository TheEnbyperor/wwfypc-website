#!/usr/bin/env bash
/usr/bin/rpl "(pass)" $EMAIL_PASS /etc/ssmtp/ssmtp.conf
/usr/sbin/apache2ctl -D FOREGROUND