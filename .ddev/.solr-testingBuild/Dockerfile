ARG APACHE_SOLR_TESTING_VERSION
FROM solr:$APACHE_SOLR_TESTING_VERSION

ENV TERM linux

RUN rm -fR /opt/solr/server/solr/*

COPY packages/ext-solr/Resources/Private/Solr /opt/solr/server/solr

USER root

ARG APACHE_SOLR_TESTING_PORT
RUN mkdir -p /opt/solr/server/solr/data && \
    chown -R solr:solr /opt/solr/server/solr/ && \
    sed -i -e "s/#SOLR_PORT=8983/SOLR_PORT=$APACHE_SOLR_TESTING_PORT/" "/opt/solr/bin/solr.in.sh"

USER solr

ARG APACHE_SOLR_TESTING_PORT
EXPOSE $APACHE_SOLR_TESTING_PORT
ENV APACHE_SOLR_TESTING_PORT=$APACHE_SOLR_TESTING_PORT