FROM nginx:alpine

# printf "USER:$(openssl passwd -crypt PASSWORD)\n" >> .htpasswd 
COPY default.conf /etc/nginx/conf.d/default.conf
COPY .htpasswd /etc/nginx/