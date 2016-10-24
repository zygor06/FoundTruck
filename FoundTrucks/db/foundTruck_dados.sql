INSERT INTO tb_usuarios SET email = "cbandeira@gmail.com" , senha = "1234", nome = "Carlos";

INSERT INTO tb_foodtrucks (nome, lat, lng, idusuarios_fk) VALUES ("Foodteste1", "-15.7912741", "-47.8883282", "1");
INSERT INTO tb_foodtrucks (nome, lat, lng, idusuarios_fk) VALUES ("Foodteste2", "-15.7912741", "-47.8883282", "1");
INSERT INTO tb_foodtrucks (nome, lat, lng, idusuarios_fk) VALUES ("Foodteste3", "-15.7912741", "-47.8883282", "1");

INSERT INTO tb_alimentos SET alimento = "Cervejas Especiais";
INSERT INTO tb_alimentos_has_tb_foodtrucks (tb_alimentos_id_alimentos, tb_foodtrucks_idfoodtrucks) VALUES ("1", "1");
INSERT INTO tb_alimentos_has_tb_foodtrucks (tb_alimentos_id_alimentos, tb_foodtrucks_idfoodtrucks) VALUES ("3", "1");
INSERT INTO tb_alimentos_has_tb_foodtrucks (tb_alimentos_id_alimentos, tb_foodtrucks_idfoodtrucks) VALUES ("2", "2");

/* 
Exemplo de query para saber quais alimentos determinado foodtruck vende.
Nesse select, o resultado será uma tabela mostrando que o foodtruck 1 vende os alimentos 1 e 3, 
e que o foodtruck 2 vende o alimento 2.
*/

SELECT tb_foodtrucks.nome, tb_alimentos.alimento FROM tb_foodtrucks 
	JOIN tb_alimentos_has_tb_foodtrucks JOIN tb_alimentos 
	ON tb_foodtrucks.idfoodtrucks = tb_alimentos_has_tb_foodtrucks.tb_foodtrucks_idfoodtrucks
	AND tb_alimentos_has_tb_foodtrucks.tb_alimentos_id_alimentos = tb_alimentos.id_alimentos;