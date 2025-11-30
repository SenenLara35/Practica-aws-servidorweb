provider "aws" {
  region = "us-east-1"
}

# ==========================================
# 1. RED - VPC A (PRINCIPAL)
# ==========================================
resource "aws_vpc" "vpc_a" {
  cidr_block           = "10.1.0.0/16"
  enable_dns_support   = true
  enable_dns_hostnames = true
  tags = { Name = "VPC-A-Principal" }
}

resource "aws_internet_gateway" "igw_a" {
  vpc_id = aws_vpc.vpc_a.id
  tags = { Name = "IGW-VPC-A" }
}

resource "aws_subnet" "subnet_public_a" {
  vpc_id                  = aws_vpc.vpc_a.id
  cidr_block              = "10.1.1.0/24"
  availability_zone       = "us-east-1a"
  map_public_ip_on_launch = true
  tags = { Name = "Subnet-Publica-A" }
}

resource "aws_subnet" "subnet_private_a" {
  vpc_id            = aws_vpc.vpc_a.id
  cidr_block        = "10.1.2.0/24"
  availability_zone = "us-east-1a"
  tags = { Name = "Subnet-Privada-A" }
}

resource "aws_route_table" "rt_public_a" {
  vpc_id = aws_vpc.vpc_a.id
  route {
    cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.igw_a.id
  }
  tags = { Name = "RT-Publica-A" }
}

resource "aws_route_table_association" "assoc_public_a" {
  subnet_id      = aws_subnet.subnet_public_a.id
  route_table_id = aws_route_table.rt_public_a.id
}

# ==========================================
# 2. RED - VPC B (SECUNDARIA)
# ==========================================
resource "aws_vpc" "vpc_b" {
  cidr_block           = "10.2.0.0/16"
  enable_dns_support   = true
  enable_dns_hostnames = true
  tags = { Name = "VPC-B-Secundaria" }
}

resource "aws_internet_gateway" "igw_b" {
  vpc_id = aws_vpc.vpc_b.id
  tags = { Name = "IGW-VPC-B" }
}

resource "aws_subnet" "subnet_public_b" {
  vpc_id                  = aws_vpc.vpc_b.id
  cidr_block              = "10.2.1.0/24"
  availability_zone       = "us-east-1b"
  map_public_ip_on_launch = true
  tags = { Name = "Subnet-Publica-B" }
}

resource "aws_subnet" "subnet_private_b" {
  vpc_id            = aws_vpc.vpc_b.id
  cidr_block        = "10.2.2.0/24"
  availability_zone = "us-east-1b"
  tags = { Name = "Subnet-Privada-B" }
}

resource "aws_route_table" "rt_public_b" {
  vpc_id = aws_vpc.vpc_b.id
  route {
    cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.igw_b.id
  }
  tags = { Name = "RT-Publica-B" }
}

resource "aws_route_table_association" "assoc_public_b" {
  subnet_id      = aws_subnet.subnet_public_b.id
  route_table_id = aws_route_table.rt_public_b.id
}

# ==========================================
# 3. PEERING (CONEXIÓN)
# ==========================================
resource "aws_vpc_peering_connection" "peering" {
  peer_vpc_id = aws_vpc.vpc_b.id
  vpc_id      = aws_vpc.vpc_a.id
  auto_accept = true
  tags = { Name = "Peering-A-B" }
}

resource "aws_route" "route_a_to_b" {
  route_table_id            = aws_route_table.rt_public_a.id
  destination_cidr_block    = aws_vpc.vpc_b.cidr_block
  vpc_peering_connection_id = aws_vpc_peering_connection.peering.id
}

resource "aws_route" "route_b_to_a" {
  route_table_id            = aws_route_table.rt_public_b.id
  destination_cidr_block    = aws_vpc.vpc_a.cidr_block
  vpc_peering_connection_id = aws_vpc_peering_connection.peering.id
}

# ==========================================
# 4. SEGURIDAD
# ==========================================
resource "aws_security_group" "web_sg" {
  name        = "web-server-sg"
  description = "Permitir HTTP y SSH"
  vpc_id      = aws_vpc.vpc_a.id

  ingress {
    description = "HTTP"
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  ingress {
    description = "SSH"
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }

  tags = { Name = "Web-Server-SG" }
}

# ==========================================
# 5. INSTANCIA
# ==========================================
resource "aws_instance" "instancia1" {
  ami           = "ami-0c02fb55956c7d316" # Amazon Linux 2 (us-east-1)
  instance_type = "t2.micro"

  subnet_id                   = aws_subnet.subnet_public_a.id
  vpc_security_group_ids      = [aws_security_group.web_sg.id]
  associate_public_ip_address = true
  
  # IMPORTANTE: Aquí pones el nombre de la clave que creaste en AWS en el Paso 1
  # Si la llamaste diferente a "clave-practica", cambia el nombre aquí abajo.
  key_name = "clave-para-mi-servidor"

  # El script debe estar en la misma carpeta con nombre "script.sh"
  user_data = file("script.sh")

  tags = {
    Name = "instancia1Nginx"
  }
}

output "public_ip" {
  value = aws_instance.instancia1.public_ip
}