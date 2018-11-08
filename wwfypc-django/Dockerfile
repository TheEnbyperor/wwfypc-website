FROM ubuntu:18.04
ENV PYTHONUNBUFFERED 1
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update -qqy \
    && apt-get upgrade -qqy \
    && apt-get install -y wget default-libmysqlclient-dev python3 python3-pip wkhtmltopdf xvfb \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/* \
    && pip3 install --upgrade pip

RUN mkdir /src
WORKDIR /src
ADD requirements.txt /src
RUN pip install -r requirements.txt
COPY . /src
CMD /src/start.sh
EXPOSE 8000