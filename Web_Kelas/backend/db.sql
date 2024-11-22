-- Membuat database dan menggunakan database tersebut
CREATE DATABASE web4_demo;
USE web4_demo;

-- Membuat tabel coffee
CREATE TABLE data_cowfee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Menambahkan data dummy ke tabel coffee
INSERT INTO data_cowfee (name, description, image_url) VALUES
('Kopi Robusta', 'Kopi robusta dengan rasa khas dan aroma kuat.', 'https://upload.wikimedia.org/wikipedia/commons/4/45/A_small_cup_of_coffee.JPG'),
('Kopi Arabika', 'Kopi arabika berkualitas tinggi dari pegunungan.', 'https://upload.wikimedia.org/wikipedia/commons/4/45/A_small_cup_of_coffee.JPG'),
('Kopi Gayo', 'Kopi Gayo asli Aceh dengan cita rasa yang unik.', 'https://upload.wikimedia.org/wikipedia/commons/4/45/A_small_cup_of_coffee.JPG'),
('Kopi Toraja', 'Kopi khas Toraja dengan rasa klasik dan aroma earthy.', 'https://upload.wikimedia.org/wikipedia/commons/4/45/A_small_cup_of_coffee.JPG'),
('Kopi Luwak', 'Kopi termahal di dunia dengan rasa unik dan lembut.', 'https://upload.wikimedia.org/wikipedia/commons/4/45/A_small_cup_of_coffee.JPG');
