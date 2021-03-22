FROM --platform=linux/arm64/v8 redis:latest
COPY redis.conf /usr/local/etc/redis/redis.conf
RUN mkdir -p /run/redis
RUN chmod 777 /run/redis
CMD [ "redis-server", "/usr/local/etc/redis/redis.conf" ]