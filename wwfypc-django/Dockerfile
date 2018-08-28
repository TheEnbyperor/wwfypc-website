FROM python:3
ENV PYTHONUNBUFFERED 1
RUN apt-get update \
    && apt-get install -y --no-install-recommends default-libmysqlclient-dev chromium \
    && rm -rf /var/lib/apt/lists/* \
    && pip install --upgrade pip

RUN mkdir /src
WORKDIR /src
ADD requirements.txt /src
RUN pip install -r requirements.txt
COPY . /src
CMD /src/start.sh
EXPOSE 8000