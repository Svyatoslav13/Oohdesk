USE oohdesk;

DROP TABLE IF EXISTS history;

CREATE TABLE history (
    id INTEGER NOT NULL AUTO_INCREMENT,
    `time` INTEGER NOT NULL,
    plane_id INTEGER NOT NULL,
    state_id TINYINT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS planes_states;

CREATE TABLE planes_states (
    plane_id INTEGER NOT NULL,
    state_id INTEGER NOT NULL,
    PRIMARY KEY (plane_id)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS planes;

CREATE TABLE planes (
    id INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

DELIMITER $$

DROP TRIGGER IF EXISTS planes_states_insert;

CREATE TRIGGER planes_states_insert
    AFTER INSERT ON planes
    FOR EACH ROW
BEGIN
    INSERT INTO planes_states (plane_id, state_id)
    VALUES (NEW.id, 1);
END $$

DELIMITER ;

DELIMITER $$

DROP TRIGGER IF EXISTS history_insert;

CREATE TRIGGER history_insert
    AFTER INSERT ON planes_states
    FOR EACH ROW
BEGIN
    INSERT INTO history (`time`, plane_id, state_id)
    VALUES (unix_timestamp(), NEW.plane_id, NEW.state_id);
END $$

DELIMITER ;

DELIMITER $$

DROP TRIGGER IF EXISTS history_update;

CREATE TRIGGER history_update
    AFTER UPDATE ON planes_states
    FOR EACH ROW
BEGIN
    INSERT INTO history (`time`, plane_id, state_id)
    VALUES (unix_timestamp(), NEW.plane_id, NEW.state_id);
END $$

DELIMITER ;


INSERT INTO planes (`name`)
VALUES ('Boeing-737')
     , ('Airbus A330')
     , ('IL-96M')
     , ('Boeing-777')
;

DROP TABLE IF EXISTS states;

CREATE TABLE states (
    id TINYINT NOT NULL,
    `state` VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

INSERT INTO states (id, `state`)
VALUES (1, 'В ангаре')
     , (2, 'В очереди на взлет...')
     , (3, 'Взлетает...')
     , (4, 'Взлетел')
;