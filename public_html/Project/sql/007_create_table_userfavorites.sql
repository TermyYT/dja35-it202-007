CREATE TABLE IF NOT EXISTS `UserFavorites` ( -- The User-Game association table.
    `id` INT AUTO_INCREMENT NOT NULL PRIMARY KEY, -- Has an ID to keep track of records in this table.
    `user_id` INT NOT NULL, -- The User's ID.
    `game_id` INT NOT NULL, -- The Game's ID.
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- The created timestamp. Modified not included because hard deletes are planned.
    FOREIGN KEY (`user_id`)  -- Foreign key for the user ID.
        REFERENCES Users (`id`) 
            ON DELETE CASCADE -- When the parent record is deleted, so is this one.
            ON UPDATE CASCADE, -- When the parent record is updated, so is this one.
    FOREIGN KEY (`game_id`)  -- Foreign key for the game ID.
        REFERENCES Games (`id`) 
            ON DELETE CASCADE -- When the parent record is deleted, so is this one.
            ON UPDATE CASCADE, -- When the parent record is updated, so is this one.
    UNIQUE KEY (`user_id`, `game_id`) -- Ensures that a user can only favorite a game once.
); -- DJA35 - 12/13/2023