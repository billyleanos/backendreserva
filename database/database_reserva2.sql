CREATE DATABASE dbreserva;
USE dbreserva;

CREATE TABLE salas (
    id_sala INT AUTO_INCREMENT PRIMARY KEY,
    nombre_sala VARCHAR(50) NOT NULL,
    capacidad INT NOT NULL,
    descripcion VARCHAR(50) NOT NULL,
    estado BOOLEAN NOT NULL
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_apellido VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    password BLOB NOT NULL,
    telefono VARCHAR(100) NOT NULL,
    estado BOOLEAN NOT NULL
);

CREATE TABLE areas (
	id_area INT AUTO_INCREMENT PRIMARY KEY,
	nombre_area VARCHAR (100) NOT NULL
);

CREATE TABLE IF NOT EXISTS reservas (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_sala INT NOT NULL,
    id_area INT NOT NULL,
    fecha_reserva DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    evento VARCHAR (100) NOT NULL,
    estado BOOLEAN NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_sala) REFERENCES salas(id_sala),
    FOREIGN KEY (id_area) REFERENCES areas(id_area)
);

-- DATOS INSERTADOS EN SALAS
INSERT INTO salas (nombre_sala, capacidad, descripcion, estado) VALUES 
('Sala A', 50, 'Sala de conferencias', true),
('Sala B', 30, 'Sala de reuniones', true),
('Sala C', 20, 'Sala de juntas', true),
('Sala D', 40, 'Sala de eventos', false),
('Sala E', 25, 'Sala de capacitación', true),
('Sala F', 35, 'Sala de formación', true),
('Sala G', 45, 'Sala de presentaciones', true),
('Sala H', 30, 'Sala de reuniones pequeñas', true),
('Sala I', 20, 'Sala de entrevistas', true),
('Sala J', 40, 'Sala de talleres', false),
('Sala K', 25, 'Sala de seminarios', true),
('Sala L', 35, 'Sala de reuniones', true),
('Sala M', 45, 'Sala de juntas', true),
('Sala N', 30, 'Sala de videoconferencias', true),
('Sala O', 20, 'Sala de capacitación', true),
('Sala P', 40, 'Sala de charlas', false),
('Sala Q', 25, 'Sala de conferencias', true),
('Sala R', 35, 'Sala de debates', true),
('Sala S', 45, 'Sala de presentación de proyectos', true),
('Sala T', 30, 'Sala de reuniones ejecutivas', true);

-- DATOS INSERTADOS EN USUARIOS
INSERT INTO usuarios (nombre_apellido, correo, password, telefono, estado) VALUES 
('Juan Pérez', 'juan.perez@example.com', AES_ENCRYPT('Chingado810', 'abcxyz'), '555-1234', true),
('Ana Gómez', 'ana.gomez@example.com', AES_ENCRYPT('Chingado820', 'abcxyz'), '555-5678', true),
('Carlos Ruiz', 'carlos.ruiz@example.com', AES_ENCRYPT('Chingado830', 'abcxyz'), '555-9012', true),
('María Torres', 'maria.torres@example.com', AES_ENCRYPT('Chingado840', 'abcxyz'), '555-3456', false),
('Luis Martínez', 'luis.martinez@example.com', AES_ENCRYPT('Chingado890', 'abcxyz'), '555-7890', true),
('Pedro Sánchez', 'pedro.sanchez@example.com', AES_ENCRYPT('Chingado850', 'abcxyz'), '555-1235', true),
('Laura Fernández', 'laura.fernandez@example.com', AES_ENCRYPT('Chingado860', 'abcxyz'), '555-5679', true),
('Miguel Ramírez', 'miguel.ramirez@example.com', AES_ENCRYPT('Chingado870', 'abcxyz'), '555-9013', true),
('Sandra Pérez', 'sandra.perez@example.com', AES_ENCRYPT('Chingado880', 'abcxyz'), '555-3457', false),
('David Jiménez', 'david.jimenez@example.com', AES_ENCRYPT('Chingado891', 'abcxyz'), '555-7891', true),
('Marta González', 'marta.gonzalez@example.com', AES_ENCRYPT('Chingado892', 'abcxyz'), '555-1236', true),
('José López', 'jose.lopez@example.com', AES_ENCRYPT('Chingado893', 'abcxyz'), '555-5670', true),
('Lucía García', 'lucia.garcia@example.com', AES_ENCRYPT('Chingado894', 'abcxyz'), '555-9014', true),
('Raúl Fernández', 'raul.fernandez@example.com', AES_ENCRYPT('Chingado895', 'abcxyz'), '555-3458', false),
('Cristina Sánchez', 'cristina.sanchez@example.com', AES_ENCRYPT('Chingado896', 'abcxyz'), '555-7892', true),
('Antonio Martínez', 'antonio.martinez@example.com', AES_ENCRYPT('Chingado897', 'abcxyz'), '555-1237', true),
('Sofía Torres', 'sofia.torres@example.com', AES_ENCRYPT('Chingado898', 'abcxyz'), '555-5671', true),
('Pablo Ruiz', 'pablo.ruiz@example.com', AES_ENCRYPT('Chingado899', 'abcxyz'), '555-9015', true),
('Elena Ramírez', 'elena.ramirez@example.com', AES_ENCRYPT('Chingado900', 'abcxyz'), '555-3459', false),
('Andrés Jiménez', 'andres.jimenez@example.com', AES_ENCRYPT('Chingado901', 'abcxyz'), '555-7893', true);

-- DATOS INSERTADOS EN AREAS
INSERT INTO areas (nombre_area) VALUES 
('Administración'),
('Recursos Humanos'),
('Finanzas'),
('Marketing'),
('Tecnología'),
('Operaciones'),
('Ventas'),
('Compras'),
('Logística'),
('Atención al Cliente'),
('Investigación y Desarrollo'),
('Calidad'),
('Producción'),
('Legal'),
('Consultoría'),
('Educación'),
('Salud'),
('Ingeniería'),
('Diseño'),
('Comunicación');

-- DATOS INSERTADOS EN RESERVAS
INSERT INTO reservas (id_usuario, id_sala, id_area, fecha_reserva, hora_inicio, hora_fin, evento, estado) VALUES
(1, 1, 1, '2024-01-15', '09:00:00', '11:00:00', 'Reunión de planificación', true),
(2, 2, 2, '2024-02-16', '10:00:00', '12:00:00', 'Capacitación anual', true),
(3, 3, 3, '2024-03-17', '14:00:00', '16:00:00', 'Presentación financiera', true),
(4, 4, 4, '2024-04-18', '11:00:00', '13:00:00', 'Evento de marketing', false),
(5, 5, 5, '2024-05-19', '15:00:00', '17:00:00', 'Revisión tecnológica', true),
(6, 1, 6, '2024-06-20', '09:00:00', '11:00:00', 'Reunión de operaciones', true),
(7, 2, 7, '2024-07-21', '10:00:00', '12:00:00', 'Entrenamiento de ventas', true),
(8, 3, 8, '2024-08-22', '14:00:00', '16:00:00', 'Revisión de compras', true),
(9, 4, 9, '2024-09-23', '11:00:00', '13:00:00', 'Taller de logística', false),
(10, 5, 10, '2024-10-24', '15:00:00', '17:00:00', 'Reunión de atención al cliente', true),
(11, 1, 11, '2024-11-25', '09:00:00', '11:00:00', 'Presentación de I+D', true),
(12, 2, 12, '2024-12-26', '10:00:00', '12:00:00', 'Revisión de calidad', true),
(13, 3, 13, '2025-01-27', '14:00:00', '16:00:00', 'Informe de producción', true),
(14, 4, 14, '2025-02-28', '11:00:00', '13:00:00', 'Revisión legal', false),
(15, 5, 15, '2025-03-29', '15:00:00', '17:00:00', 'Reunión de consultoría', true),
(16, 1, 16, '2025-04-30', '09:00:00', '11:00:00', 'Taller de educación', true),
(17, 2, 17, '2025-05-31', '10:00:00', '12:00:00', 'Sesión de salud', true),
(18, 3, 18, '2025-06-01', '14:00:00', '16:00:00', 'Reunión de ingeniería', true),
(19, 4, 19, '2025-07-02', '11:00:00', '13:00:00', 'Taller de diseño', false),
(20, 5, 20, '2025-08-03', '15:00:00', '17:00:00', 'Reunión de comunicación', true);
