-- Active: 1684597606940@@127.0.0.1@3306@test
CREATE DATABASE IF NOT EXISTS GestionNote;

USE GestionNote;

CREATE TABLE IF NOT EXISTS SchoolYear(
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(15) NOT NULL UNIQUE,
    status ENUM('TERMINE', 'EN_COURS', 'A_VENIR')
);

INSERT INTO
    `SchoolYear`(label, status)
VALUES
    ('2020-2021', 'TERMINE'),
    ('2021-2022', 'EN_COURS'),
    ('2022-2023', 'A_VENIR');

CREATE TABLE IF NOT EXISTS LevelGroup(
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(100) NOT NULL UNIQUE
);

INSERT INTO
    `LevelGroup`(label)
VALUES
    ('Enseignement primaire'),
    ('Enseignement seconaire inférieure'),
    ('Enseignement secondaire supérieure');

CREATE TABLE IF NOT EXISTS SchoolYear_LevelGroup(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_school_year INT NOT NULL,
    id_level_group INT NOT NULL,
    FOREIGN KEY(id_school_year) REFERENCES SchoolYear(id),
    FOREIGN KEY(id_level_group) REFERENCES LevelGroup(id)
);

INSERT INTO
    `SchoolYear_LevelGroup`(id_school_year, id_level_group)
VALUES
    (1, 1),
    (1, 2),
    (1, 3),
    (2, 2),
    (2, 3);

CREATE TABLE IF NOT EXISTS Level (
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(100) NOT NULL UNIQUE,
    id_level_group INT NOT NULL,
    FOREIGN KEY(id_level_group) REFERENCES LevelGroup(id)
);

INSERT INTO
    `Level`(label, id_level_group)
VALUES
    ('CI', 1),
    ('CP', 1),
    ('CE1', 1),
    ('CE2', 1),
    ('CM1', 1),
    ('CM2', 1),
    ('6e', 2),
    ('5e', 2),
    ('4e', 2),
    ('3e', 2),
    ('2nd', 3);

CREATE TABLE IF NOT EXISTS SchoolYear_Level (
    id_school_year INT NOT NULL,
    id_level INT NOT NULL,
    FOREIGN KEY(id_school_year) REFERENCES SchoolYear(id),
    FOREIGN KEY(id_level) REFERENCES Level(id)
);

INSERT INTO
    `SchoolYear_Level`(id_school_year, id_level)
VALUES
    (1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (1, 5),
    (1, 6),
    (1, 7),
    (1, 8),
    (1, 9),
    (1, 10),
    (1, 11),
    (2, 1),
    (2, 2),
    (2, 3),
    (2, 8),
    (2, 8),
    (2, 10),
    (2, 11);

CREATE TABLE IF NOT EXISTS Classe (
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(100) NOT NULL UNIQUE,
    id_level INT NOT NULL,
    FOREIGN KEY(id_level) REFERENCES Level(id)
);

INSERT INTO
    `Classe`(label, id_level)
VALUES
    ('CI A', 1),
    ('CI B', 1),
    ('CE2 A', 4),
    ('CE2 B', 4),
    ('CM2 A', 6),
    ('6e A', 7),
    ('5e A', 8),
    ('5e B', 8),
    ('3e A', 10),
    ('2nd A', 11);

CREATE TABLE IF NOT EXISTS SchoolYear_Classe(
    id_school_year INT NOT NULL,
    id_classe INT NOT NULL,
    FOREIGN KEY(id_school_year) REFERENCES SchoolYear(id),
    FOREIGN KEY(id_classe) REFERENCES Classe(id)
);

INSERT INTO
    `SchoolYear_Classe`(id_school_year, id_classe)
VALUES
    (1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (1, 5),
    (1, 6),
    (1, 7),
    (1, 8),
    (1, 9),
    (1, 10);

CREATE TABLE IF NOT EXISTS SubjectGroup(
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(100) NOT NULL UNIQUE,
    id_level INT NOT NULL,
    FOREIGN KEY(id_level) REFERENCES Level(id)
);

INSERT INTO
    `SubjectGroup`(label, id_level)
VALUES
    ('Langue et communication', 1),
    ('Controle des ressources', 1);

CREATE TABLE IF NOT EXISTS Subject(
    id INT PRIMARY KEY AUTO_INCREMENT,
    label VARCHAR(100) NOT NULL UNIQUE,
    code VARCHAR(15) NOT NULL UNIQUE,
    id_level_group INT,
    FOREIGN KEY(id_level_group) REFERENCES SubjectGroup(id)
);

INSERT INTO
    `Subject`(label, code, id_level_group)
VALUES
    ('Vocabulaire', 'VOC', 1),
    ('Ecriture', 'EC', 1),
    ('Grammaire', 'GRA', 1),
    ('Vivre dans son milieu', 'VDM', 2),
    ('Vivre ensemble', 'VE', 2),
    ('Enseignement morale et civique', 'EMC', 2),
    (
        'Initation scientifique et technologique',
        'IST',
        NULL
    ),
    ('Mathématique', 'MATH', NULL),
    ('Français', 'FR', NULL),
    ('Science de la vie et de la terre', 'SVT', NULL),
    ('Physique Chimie', 'PC', NULL);

CREATE TABLE IF NOT EXISTS Subject_Level(
    id_level INT NOT NULL,
    id_subject INT NOT NULL,
    FOREIGN KEY(id_level) REFERENCES Level(id),
    FOREIGN KEY(id_subject) REFERENCES Subject(id)
);

INSERT INTO
    `Subject_Level`(id_level, id_subject)
VALUES
    (1, 1),
    (2, 1),
    (4, 1),
    (6, 1),
    (6, 9),
    (6, 8),
    (6, 10),
    (7, 8),
    (7, 9),
    (7, 10),
    (9, 11),
    (10, 11),
    (10, 10),
    (10, 9);

-- `id` INT PRIMARY KEY AUTO_INCREMENT,
USE GestionNote;

CREATE TABLE IF NOT EXISTS `Student` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `firstname` VARCHAR(100) NOT NULL,
    `lastname` VARCHAR(50) NOT NULL,
    `type` ENUM('INTERNE', 'EXTERNE') NOT NULL,
    `number` INT,
    `birth_date` DATE,
    `birth_place` VARCHAR(50),
    `sex` TINYINT NOT NULL,
    `state` ENUM('ARCHIVE', 'NON_ARCHIVE') DEFAULT 'NON_ARCHIVE',
    `photo` VARCHAR(255)
);

INSERT INTO
    `Student`(
        `firstname`,
        `lastname`,
        `type`,
        `birth_date`,
        `birth_place`,
        `sex`,
        `number`,
        `photo`
    )
VALUES
    (
        'Pyther',
        'Killer',
        'EXTERNE',
        '1997-01-11',
        'Dakar',
        1,
        NULL,
        NULL
    ),
    (
        'Zal',
        'Hassan',
        'INTERNE',
        '2001-01-25 18:47:34',
        'Tambacounda',
        1,
        1,
        NULL
    ),
    (
        'Ibrahima',
        'Diop',
        'EXTERNE',
        '1998-10-01',
        'Louga',
        1,
        NULL,
        NULL
    ),
    (
        'Fatou',
        'Dieng',
        'INTERNE',
        '2000-01-03',
        'Kaolack',
        0,
        3,
        NULL
    );

CREATE TABLE IF NOT EXISTS `Registration` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `id_student` INT NOT NULL,
    `id_school_year` INT NOT NULL,
    `id_classe` INT NOT NULL,
    `registered_at` DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY(`id_school_year`) REFERENCES SchoolYear(id),
    FOREIGN KEY(`id_classe`) REFERENCES Classe(id),
    FOREIGN KEY(`id_student`) REFERENCES Student(id)
);

INSERT INTO
    `Registration` (id_classe, id_school_year, id_student)
VALUES
    (
        7,
        (
            SELECT
                id
            FROM
                `SchoolYear`
            WHERE
                status = 1
            LIMIT
                1
        ), 1
    ), (
        19, (
            SELECT
                id
            FROM
                `SchoolYear`
            WHERE
                status = 1
            LIMIT
                1
        ), 2
    ), (
        5, (
            SELECT
                id
            FROM
                `SchoolYear`
            WHERE
                status = 1
            LIMIT
                1
        ), 3
    ), (
        10, (
            SELECT
                id
            FROM
                `SchoolYear`
            WHERE
                status = 1
            LIMIT
                1
        ), 4
    );

USE GestionNote;
CREATE TABLE IF NOT EXISTS `Admin`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `login` VARCHAR(30) NOT NULL,
    `passwd` VARCHAR(100) NOT NULL
);

INSERT INTO `Admin`(login, passwd) VALUES('usher', 'Password123');