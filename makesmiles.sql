DROP Table if exists Smiles ;
CREATE TABLE if not exists Smiles (
id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
cid INT  UNSIGNED NOT NULL,
smiles VARCHAR(1024) NOT NULL
);

