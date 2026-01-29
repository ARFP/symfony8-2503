TRUNCATE TABLE `flower`;
TRUNCATE TABLE `category`;


INSERT INTO `category` (`name`) VALUES 
('Sans catégorie'), /* 1 */
('Annuelle'), /* 2 */
('Bisannuelle'), /* 3 */
('Vivace'); /* 4 */

insert INTO `flower` (`name`, `color`, `category_id`) VALUES
('Tulipe', 'Marron', 4), /* VIVACE */
('Pensée', 'Violet', 2), /* ANNUELLE */
('Arnica', 'Jaune', 4), /* VIVACE */
('Valériane', 'Rose', 4), /* VIVACE */
('Capucine', 'Orange', 2); /* ANNUELLE */
