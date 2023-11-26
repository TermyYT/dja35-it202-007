CREATE TABLE Games ( -- Table for storing all games and their info.
    check(originalPrice >= 0), -- Checks if originalPrice value is 0 or greater. 0 = free.
    check(discountPrice >= 0), -- Checks if discountPrice value is 0 or greater. 0 = free.
    `id` INT AUTO_INCREMENT NOT NULL, -- id is auto-incremented and cannot be NULL.
    `api_id` VARCHAR(255) DEFAULT NULL, -- api_id is only set when API data is pulled.
    `title` VARCHAR(255), -- The game's title.
    `publisherName` VARCHAR(255) DEFAULT NULL, -- The game's publisher. Not all API pulls acquire publisher names, so default is NULL.
    `description` TEXT, -- The game's description.
    `releaseDate` DATE, -- The game's release date on Epic Games.
    `url` VARCHAR(255), -- The game's URL.
    `originalPrice` INT, -- The game's original/base price. Acquires "currentPrice" field from the API.
    `discountPrice` INT, -- The game's current, discounted price. Acquires "discountPrice" field from the API.
    `currencyCode` VARCHAR(3), -- The game's 3-letter currency code. (e.g. - "USD")
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- The creation time for the record.
    `modified` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- The update time for the record.
    PRIMARY KEY (`id`), -- The record ID is the primary key.
    UNIQUE KEY (`api_id`), -- All API IDs must be unique.
    UNIQUE KEY (`title`) -- All game titles must be unique.
); -- DJA35 - 11/27/2023
/*CREATE TABLE CA_Breeds(
    `id`         int auto_increment not null,
    `api_id`    VARCHAR(10),
    `name` VARCHAR(30),
    `alt_names` TEXT,
    `description` TEXT,
    `origin` VARCHAR(30),
    `indoor` TINYINT(1),
    `lap` TINYINT(1),
    `adaptability` TINYINT,
    `affection_level` TINYINT,
    `child_friendly` TINYINT,
    `cat_friendly` TINYINT,
    `dog_friendly` TINYINT,
    `energy_level` TINYINT,
    `grooming` TINYINT,
    `health_issues` TINYINT,
    `intelligence` TINYINT,
    `shedding_level` TINYINT,
    `social_needs` TINYINT,
    `stranger_friendly` TINYINT,
    `vocalisation` TINYINT,
    `bidability` TINYINT,
    `experimental` TINYINT,
    `hairless` TINYINT(1),
    `natural` TINYINT(1),
    `rare` TINYINT(1),
    `rex` TINYINT(1),
    `suppressed_tail` TINYINT(1),
    `short_legs` TINYINT(1),
    `hypoallergenic` TINYINT(1),
    `min_weight_lbs` int,
    `max_weight_lbs` int,
    `min_life_span_years` int,
    `max_life_span_years` int,
    `urls` TEXT COMMENT 'May not be the best approach to use a text field for multiple urls, but did not want to opt for another table for minimal info to my app',
    `created`    timestamp default current_timestamp,
    `modified`   timestamp default current_timestamp on update current_timestamp,
    PRIMARY KEY (`id`),
    UNIQUE KEY(`api_id`),
    UNIQUE KEY(`name`)
)*/