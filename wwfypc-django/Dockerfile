FROM ubuntu:18.04
ENV PYTHONUNBUFFERED 1
RUN apt-get update -qqy \
    && apt-get install wget gnupg2 -qqy \
    && wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add - \
    && echo "deb http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google-chrome.list \
    && apt-get update -qqy \
    && apt-get upgrade -qqy \
    && apt-get -qqy install google-chrome-stable default-libmysqlclient-dev python3 python3-pip \
    && rm /etc/apt/sources.list.d/google-chrome.list \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/* \
    && pip3 install --upgrade pip

RUN mkdir /src
WORKDIR /src
ADD requirements.txt /src
RUN pip install -r requirements.txt
COPY . /src
CMD /src/start.sh
EXPOSE 8000