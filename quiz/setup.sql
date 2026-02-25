-- Create database and tables for the quiz application
CREATE DATABASE IF NOT EXISTS `quizdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `quizdb`;

-- Main questions table (legacy/backup)
CREATE TABLE IF NOT EXISTS `questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `letter` VARCHAR(4) DEFAULT NULL,
  `filename` VARCHAR(255) DEFAULT NULL,
  `image` LONGBLOB,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_letter` (`letter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Primary quiz questions table with options
-- Structure: ID, Question, QuestionImage, OptionA, OptionB, OptionC, OptionD, CorrectOption
CREATE TABLE IF NOT EXISTS `image_questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `question` VARCHAR(500) DEFAULT NULL,
  `filename` VARCHAR(255) DEFAULT NULL,
  `image` LONGBLOB,
  `option_a` VARCHAR(255) DEFAULT NULL,
  `option_b` VARCHAR(255) DEFAULT NULL,
  `option_c` VARCHAR(255) DEFAULT NULL,
  `option_d` VARCHAR(255) DEFAULT NULL,
  `correct_option` CHAR(1) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_question` (`question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Example question data (insert after setting up images)
-- INSERT INTO image_questions (id, question, filename, image, option_a, option_b, option_c, option_d, correct_option) 
-- VALUES 
-- (1, 'What letter is this?', 'A.png', <image_blob>, 'A', 'B', 'C', 'D', 'A'),
-- (2, 'Identify the letter', 'B.png', <image_blob>, 'A', 'B', 'C', 'D', 'B');
