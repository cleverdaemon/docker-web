FROM httpd:latest

# RUN a2enmod vhost_alias

RUN apt update && apt install libcap2-bin -y

RUN setcap 'cap_net_bind_service=+ep' /usr/local/apache2/bin/httpd

 COPY ./default.conf /usr/local/apache2/conf/default.conf

 RUN echo "Include /usr/local/apache2/conf/default.conf" \
    >> /usr/local/apache2/conf/httpd.conf
