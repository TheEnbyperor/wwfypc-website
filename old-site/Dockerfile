FROM ubuntu:14.04
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y apache2 mysql-client php5-mysql php5 libapache2-mod-php5 php5-mcrypt ssmtp rpl
RUN rm /var/www/html/index.html
COPY config /etc/apache2/sites-available
COPY start.sh /
RUN chmod +x /start.sh
COPY ssmtp.conf /etc/ssmtp/
COPY src /var/www/html
VOLUME /var/www/html/upload
VOLUME /var/www/html/wewillfixyouripad/upload

CMD /start.sh