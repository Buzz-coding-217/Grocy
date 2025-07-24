FROM ghcr.io/linuxserver/grocy

ENV PUID=1000
ENV PGID=1000
ENV TZ=Australia/Melbourne

VOLUME [ "/config" ]

EXPOSE 80
