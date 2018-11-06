FROM ubuntu:18.04
ENV PYTHONUNBUFFERED 1
ENV WKHTML2PDF_VERSION '0.12.4'

RUN apt-get update -qqy \
    && apt-get upgrade -qqy \
    && apt-get install -y openssl build-essential xorg libssl-dev default-libmysqlclient-dev python3 python3-pip \
    && wget "https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/${WKHTML2PDF_VERSION}/wkhtmltox-${WKHTML2PDF_VERSION}_linux-generic-amd64.tar.xz"
    && tar -xJf "wkhtmltox-${WKHTML2PDF_VERSION}_linux-generic-amd64.tar.xz"
    && cd wkhtmltox
    && chown root:root bin/wkhtmltopdf
    && sudo cp -r * /usr/ \
    && rm -rf /var/lib/apt/lists/* /var/cache/apt/* \
    && pip3 install --upgrade pip

RUN mkdir /src
WORKDIR /src
ADD requirements.txt /src
RUN pip install -r requirements.txt
COPY . /src
CMD /src/start.sh
EXPOSE 8000