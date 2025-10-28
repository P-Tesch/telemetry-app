FROM golang:1.24-alpine

RUN apk update
RUN apk add --no-cache curl
RUN apk add protobuf protobuf-dev

RUN curl -sSfL https://raw.githubusercontent.com/cosmtrek/air/master/install.sh | sh -s -- -b /usr/local/bin

WORKDIR /var/www/html

# 8. Run with Air (hot reload)
CMD ["air"]
