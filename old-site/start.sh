#!/usr/bin/env bash
/bin/cat /etc/ssmtp/ssmtp.conf | /bin/sed "s/(pass)/$EMAIL_PASS/g" > /etc/ssmtp/ssmtp.conf
/usr/sbin/apache2ctl -D FOREGROUND