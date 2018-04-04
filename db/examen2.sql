DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios (
    id         bigserial    PRIMARY KEY
  , nombre     varchar(255) NOT NULL UNIQUE
  , password   varchar(255) NOT NULL
);

DROP TABLE IF EXISTS aeropuertos CASCADE;

CREATE TABLE aeropuertos (
    id           bigserial    PRIMARY KEY
  , codigo       varchar(3)   UNIQUE
  , denominacion varchar(255) NOT NULL
);

DROP TABLE IF EXISTS companias CASCADE;

CREATE TABLE companias (
    id           bigserial    PRIMARY KEY
  , denominacion varchar(255) NOT NULL
);

DROP TABLE IF EXISTS vuelos CASCADE;

CREATE TABLE vuelos (
    id          bigserial    PRIMARY KEY
  , codigo      varchar(6)   UNIQUE CONSTRAINT ck_codigo_valido
                             CHECK(codigo ~ '^[A-Z]{2}\d{4}$')
  , origen_id   bigint       NOT NULL REFERENCES aeropuertos (id)
                             ON DELETE NO ACTION ON UPDATE CASCADE
  , destino_id  bigint       NOT NULL REFERENCES aeropuertos (id)
                             ON DELETE NO ACTION ON UPDATE CASCADE
  , compania_id bigint       NOT NULL REFERENCES companias (id)
                             ON DELETE NO ACTION ON UPDATE CASCADE
  , salida      timestamp    NOT NULL
  , llegada     timestamp    NOT NULL
  , plazas      numeric(3)   NOT NULL
  , precio      numeric(8,2) NOT NULL
);

DROP TABLE IF EXISTS reservas CASCADE;

CREATE TABLE reservas (
    id         bigserial  PRIMARY KEY
  , usuario_id bigint     NOT NULL REFERENCES usuarios (id)
                          ON DELETE NO ACTION ON UPDATE CASCADE
  , vuelo_id   bigint     NOT NULL REFERENCES vuelos (id)
                          ON DELETE NO ACTION ON UPDATE CASCADE
  , asiento    numeric(3) NOT NULL
  , created_at timestamp  NOT NULL DEFAULT localtimestamp
  , UNIQUE (vuelo_id, asiento)
);


INSERT INTO usuarios (nombre, password) VALUES
  ('pepe', crypt('pepe', gen_salt('bf', 13)))
  , ('raul', crypt('1234', gen_salt('bf', 13)))
  , ('antonio', crypt('1234', gen_salt('bf', 13)))
  , ('juan', crypt('juan', gen_salt('bf', 13)))
  , ('Manolo', crypt('1234', gen_salt('bf', 13)))
  , ('Ana', crypt('1234', gen_salt('bf', 13)))
  , ('Julia', crypt('1234', gen_salt('bf', 13)));

INSERT INTO aeropuertos (codigo, denominacion) VALUES
  ('AAA', 'Trebujena')
  , ('BBB', 'Lebrija')
  , ('CCC', 'Valladolid')
  , ('DDD', 'Madrid')
  , ('EEE', 'Sevilla')
  , ('FFF', 'Málaga')
  , ('GGG', 'Córdoba')
  , ('HHH', 'Rota');

INSERT INTO companias (denominacion) VALUES
  ('Aeroplanos Pepe')
  , ('Avionetas Manolo')
  , ('Red Bull')
  , ('La nube')
  , ('Rayo MC')
  , ('Aviones Manolo');

INSERT INTO vuelos (codigo, origen_id, destino_id, compania_id, salida,
                    llegada, plazas, precio) VALUES
  ('AA1234', 1, 2, 3, localtimestamp + 'P2D'::interval,
   localtimestamp + 'P6D'::interval, 1, 100)
  , ('AB1234', 1, 4, 1, localtimestamp + 'P3D'::interval,
     localtimestamp + 'P7D'::interval, 2, 100)
  , ('AC1234', 3, 2, 2, localtimestamp + 'P4D'::interval,
     localtimestamp + 'P8D'::interval, 10, 100)
  , ('AD1234', 3, 2, 2, localtimestamp + 'P4D'::interval,
     localtimestamp + 'P8D'::interval, 10, 100)
  , ('AE1234', 3, 2, 2, localtimestamp + 'P4D'::interval,
     localtimestamp + 'P8D'::interval, 10, 100)
  , ('AF1234', 3, 2, 2, localtimestamp + 'P4D'::interval,
     localtimestamp + 'P8D'::interval, 10, 100)
  , ('AG1234', 3, 2, 2, localtimestamp + 'P3D'::interval,
     localtimestamp + 'P5D'::interval, 1, 100)
  , ('AH1234', 3, 4, 3, localtimestamp + 'P5D'::interval,
     localtimestamp + 'P9D'::interval, 20, 100);

INSERT INTO reservas (usuario_id, vuelo_id, asiento, created_at) VALUES
  (1, 1, 3, localtimestamp)
  , (2, 2, 1, localtimestamp)
  , (3, 2, 2, localtimestamp)
  , (4, 3, 1, localtimestamp)
  , (5, 3, 2, localtimestamp)
  , (6, 3, 3, localtimestamp);
