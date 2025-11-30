#!/bin/bash

# Actualizar sistema
yum update -y

# Instalar Docker (Comando específico para Amazon Linux 2)
amazon-linux-extras install docker -y

# Arrancar el servicio
service docker start
systemctl enable docker

# IMPORTANTE: Añadir al usuario ec2-user al grupo docker
# (para que puedas usar docker sin escribir 'sudo' todo el tiempo)
usermod -a -G docker ec2-user

# Lanzar el contenedor Nginx
# Esto levantará un servidor web en el puerto 80 inmediatamente
docker run -dit -p 80:80 --name mi-nginx nginx:alpine