-- SQLBook: Code
CREATE TABLE persona (
    nombre varchar(15),
    apellido varchar(150),
    nrodoc varchar PRIMARY KEY,
    telefono int
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE empresa (
    idempresa bigint (20) AUTO_INCREMENT PRIMARY KEY,
    enombre varchar(150),
    edireccion varchar(150)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE responsable (
    numeroDocumentoRes varchar (150)PRIMARY KEY,
    numeroEmpleado bigint ,
    numeroLicencia varchar(15),
	idViajeResp bigint,

    FOREIGN KEY (numeroDocumentoRes) REFERENCES persona (nrodoc)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
	FOREIGN KEY (idViajeResp) REFERENCES viaje (idviaje)
	ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE viaje (
    idviaje bigint AUTO_INCREMENT PRIMARY KEY, /* código de viaje */
    vdestino varchar(150),
    vcantmaxpasajeros int,
    idempresa bigint (20),
    rnumeroempleado varchar (150),
    vimporte float,
    FOREIGN KEY (idempresa) REFERENCES empresa (idempresa) ON UPDATE CASCADE
    ON DELETE CASCADE,
    FOREIGN KEY (rnumeroempleado) REFERENCES responsable (numeroDocumentoRes)  /* Corregido para que coincida con el nombre de columna en la tabla "responsable" */
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;


CREATE TABLE pasajero (
    numdocPasajero varchar (150) PRIMARY KEY,
	idViajePas bigint ,
    FOREIGN KEY (numdocPasajero) REFERENCES persona (nrodoc)
	ON UPDATE CASCADE
    ON DELETE CASCADE,
	FOREIGN KEY (idViajePas) REFERENCES viaje (idviaje)
	ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;	


