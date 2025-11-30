#!/bin/bash

# 1. Actualizar e instalar Docker (Igual que antes)
yum update -y
amazon-linux-extras install docker -y
service docker start
systemctl enable docker
usermod -a -G docker ec2-user

# 2. Arrancar el contenedor de Base de Datos (MySQL)
# Definimos contraseña root y nombre de la base de datos
docker run -d \
  --name base-de-datos \
  -p 3306:3306 \
  -e MYSQL_ROOT_PASSWORD=rootpassword \
  -e MYSQL_DATABASE=mi_base_datos \
  -e MYSQL_USER=usuario \
  -e MYSQL_PASSWORD=password123 \
  --restart always \
  mysql:5.7