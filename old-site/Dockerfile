FROM ubuntu:14.04
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y apache2 mysql-client php5-mysql php5 libapache2-mod-php5 php5-mcrypt msmtp
RUN rm /var/www/html/index.html
COPY config /etc/apache2/sites-available
COPY msmtprc /etc/
COPY src /var/www/html

CMD /usr/sbin/apache2ctl -D FOREGROUND