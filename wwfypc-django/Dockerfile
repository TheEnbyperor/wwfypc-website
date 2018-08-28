FROM python:3
ENV PYTHONUNBUFFERED 1
RUN apt-get update \
    && apt-get upgrade \
    && wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb \
    && dpkg -i google-chrome-stable_current_amd64.deb \
    && apt-get install -y -f \
    && apt-get install -y --no-install-recommends default-libmysqlclient-dev \
    && rm -rf /var/lib/apt/lists/* \
    && pip install --upgrade pip

RUN mkdir /src
WORKDIR /src
ADD requirements.txt /src
RUN pip install -r requirements.txt
COPY . /src
CMD /src/start.sh
EXPOSE 8000