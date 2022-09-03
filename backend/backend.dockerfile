FROM php:8.1-cli

ARG USER_ID=1000
ARG GROUP_ID=1000
ARG TZ=Asia/Almaty

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install apt-utils -y \
#
#   устанавливаем необходимые пакеты
    && apt-get install -y --no-install-recommends \
    git \
    zip \
    libzip-dev \
    libpq-dev \
    libffi-dev \
    libssl-dev \
    libxml2-dev \
    libicu-dev \
    libxslt-dev \
    libc-ares-dev \
    curl
#
#   Включаем необходимые расширения
RUN docker-php-ext-configure intl \
    && docker-php-ext-install \
    -j$(nproc) \
    pdo \
    mysqli \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    sockets \
    zip \
    pcntl \
    bcmath \
    ffi \
    dom \
    xml \
    intl \
    xsl

RUN pecl install xdebug-3.1.4 \
    && docker-php-ext-enable xdebug
#
#   Чистим временные файлы
RUN docker-php-source delete \
    && apt-get autoremove --purge -y \
    && apt-get autoclean -y \
    && apt-get clean -y \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

RUN groupadd -g ${USER_ID} www
RUN useradd -u ${GROUP_ID} -ms /bin/bash -g www www

EXPOSE 8000

USER www

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
