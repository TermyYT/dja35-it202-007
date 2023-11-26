CREATE TABLE Games (
    check(originalPrice >= 0),
    check(discountPrice >= 0),
    `id` INT AUTO_INCREMENT NOT NULL,
    `api_id` VARCHAR(255) DEFAULT NULL,
    `title` VARCHAR(255),
    `publisherName` VARCHAR(255) DEFAULT NULL,
    `description` TEXT,
    `releaseDate` DATE,
    `url` VARCHAR(255),
    `originalPrice` INT,
    `discountPrice` INT,
    `currencyCode` VARCHAR(3),
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `modified` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY (`api_id`),
    UNIQUE KEY (`title`)
);
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