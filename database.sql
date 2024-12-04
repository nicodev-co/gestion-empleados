-- Crear la base de datos
CREATE DATABASE gestion_empleados;
USE gestion_empleados;

-- Crear la tabla de Departamentos
CREATE TABLE departamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_departamento VARCHAR(255) NOT NULL
);

-- Crear la tabla de Géneros
CREATE TABLE generos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

-- Crear la tabla de Empleados
CREATE TABLE empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    edad INT NOT NULL,
    fecha_ingreso DATE NOT NULL,
    salario DECIMAL(10, 2),
    comentarios TEXT,
    genero_id INT,
    departamento_id INT,
    FOREIGN KEY (genero_id) REFERENCES generos(id),
    FOREIGN KEY (departamento_id) REFERENCES departamentos(id)
);

-- Crear la tabla de Gastos
CREATE TABLE gastos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year INT NOT NULL,
    mes INT NOT NULL,
    ingresos DECIMAL(10, 2) NOT NULL,
    gastos DECIMAL(10, 2) NOT NULL,
    departamento_id INT,
    FOREIGN KEY (departamento_id) REFERENCES departamentos(id)
);

-- Insertar datos de ejemplo en la tabla de Departamentos
INSERT INTO departamentos (nombre_departamento) VALUES
('Ti'),
('Servicio al Cliente'),
('Recursos Humanos'),
('Ventas');

-- Insertar datos de ejemplo en la tabla de Géneros
INSERT INTO generos (nombre) VALUES
('Masculino'),
('Femenino'),
('No Binario'),
('Otro');

-- Insertar datos de ejemplo en la tabla de Empleados
INSERT INTO empleados (nombres, apellidos, edad, fecha_ingreso, salario, comentarios, genero_id, departamento_id) VALUES
('Juan', 'Pérez', 30, '2022-01-15', 50000.00, 'Empleado destacado', 1, 1),
('Ana', 'Gómez', 25, '2021-03-10', 45000.00, 'Excelente en servicio al cliente', 2, 2),
('Luis', 'Martínez', 35, '2020-07-20', 55000.00, 'Responsable de recursos humanos', 1, 3),
('María', 'Rodríguez', 28, '2022-02-05', 48000.00, 'Excelente en ventas', 2, 1),
('Pedro', 'Hernández', 32, '2021-11-30', 47000.00, 'Empleado destacado', 1, 2),
('Sofía', 'López', 27, '2020-09-25', 46000.00, 'Excelente en recursos humanos', 2, 3);

-- Insertar datos de ejemplo en la tabla de Gastos
INSERT INTO gastos (year, mes, ingresos, gastos, departamento_id) VALUES
(2022, 1, 100000, 30000, 1),
(2022, 2, 120000, 35000, 1),
(2022, 1, 90000, 25000, 2),
(2022, 2, 110000, 30000, 2),
(2022, 1, 80000, 20000, 3),
(2022, 2, 95000, 25000, 3);

-- Listado de todos los datos de los empleados del departamento "Ti"
SELECT e.*
FROM empleados e
JOIN departamentos d ON e.departamento_id = d.id
WHERE d.nombre_departamento = 'Ti';

-- Listado de los 3 departamentos que más gastos producen
SELECT d.nombre_departamento, SUM(g.gastos) AS total_gastos
FROM gastos g
JOIN departamentos d ON g.departamento_id = d.id
GROUP BY d.nombre_departamento
ORDER BY total_gastos DESC
LIMIT 3;

-- Listado de datos del empleado con mayor salario
SELECT *
FROM empleados
ORDER BY salario DESC
LIMIT 1;

-- Cantidad de empleados con salarios menores a 1,500,000
SELECT COUNT(*) AS cantidad_empleados
FROM empleados
WHERE salario < 1500000;