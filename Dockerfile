# Use a imagem oficial do PHP 8.0 com suporte ao FPM (FastCGI Process Manager) e Alpine Linux
FROM php:8.2-fpm-alpine

# Instale as extensões PHP necessárias para o Laravel
RUN apk add --no-cache \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    oniguruma-dev \
    curl \
    autoconf \
    g++ \
    make \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd \
    && pecl install redis \
    && docker-php-ext-enable redis

# Defina o diretório de trabalho como o diretório do seu projeto Laravel
WORKDIR /var/www/html

# Copie todos os arquivos do seu projeto Laravel para o diretório de trabalho no contêiner
COPY . .

# Exponha a porta 9000 para que o servidor PHP embutido possa ser acessado de fora do contêiner
EXPOSE 9000

# Comando padrão para iniciar o servidor PHP embutido quando o contêiner for iniciado
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
