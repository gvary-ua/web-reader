FROM nginx:1.26.1-alpine3.19

COPY ./.docker/nginx/conf.d/app.conf /etc/nginx/conf.d/app.conf

# Copy PHP project
COPY . /var/www