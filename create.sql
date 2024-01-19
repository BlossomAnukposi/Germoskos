-- Script voor het aanmaken van de tabel voor bugrapporten
CREATE TABLE IF NOT EXISTS bugrapporten (
    id INT AUTO_INCREMENT PRIMARY KEY,
    productnaam VARCHAR(255) NOT NULL,
    productversie VARCHAR(50) NOT NULL,
    hardware VARCHAR(100) NOT NULL,
    besturingssysteem VARCHAR(100) NOT NULL,
    frequentie VARCHAR(50) NOT NULL,
    oplossing TEXT NOT NULL,
    datum_ingediend TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
