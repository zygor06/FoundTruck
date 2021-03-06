USE BD_FOUNDTRUCKS;

/*INSERÇÃO DE USUÁRIOS: */
INSERT INTO TB_USUARIO SET NM_CPF = "1234" , TE_EMAIL = "cbandeira@gmail.com" , TE_SENHA = "1234", TE_NOME = "Carlos";

/*INSERÇÃO DE FOOCTRUCK + NM_LAT LONG*/

INSERT INTO TB_FOODTRUCK (TE_NOME, NM_LAT, NM_LONG, NM_CPF_USUARIO) VALUES ("Foodteste1", "-15.7912741", "-47.8883282", "1234");
INSERT INTO TB_FOODTRUCK (TE_NOME, NM_LAT, NM_LONG, NM_CPF_USUARIO) VALUES ("Foodteste2", "-15.793695", "-47.941617", "1234");
INSERT INTO TB_FOODTRUCK (TE_NOME, NM_LAT, NM_LONG, NM_CPF_USUARIO) VALUES ("Foodteste3", "-15.781302", "-47.922025", "1234");

/*ATUALIZAÇÃO DA DESCRIÇÃO DE FOODTRUCK*/
UPDATE TB_FOODTRUCK SET TE_DESCRICAO = "Cervejas especiais" WHERE NM_ID = "1";

/*ATUALIZAÇÃO DA LOCALIZAÇÃO DO FOODTRUCK*/
UPDATE TB_FOODTRUCK SET NM_LAT = "-15.781302" , NM_LONG = "-47.922025" WHERE NM_ID = "3";


/*ATUALIZAÇÃO DA IMAGEM DO FOODTRUCK*/
UPDATE TB_FOODTRUCK SET TE_IMAGEM = "images/imagem.png" WHERE NM_ID = "1";

/*INSERÇÃO DE CATEGORIAS DE ALIMENTOS*/
INSERT INTO tb_alimento SET TE_ALIMENTO = "Cervejas Especiais";
INSERT INTO tb_alimento SET TE_ALIMENTO = "Hamburger Artesanal";
INSERT INTO tb_alimento SET TE_ALIMENTO = "Pizzas";

/*INSERÇÃO DE TIPOS DE ALIMENTOS PARA DETERMINADOS FOODTRUCKS*/
INSERT INTO TB_ALIMENTO_HAS_TB_FOODTRUCK (TB_ALIMENTO_NM_ID, TB_FOODTRUCK_NM_ID) VALUES ("1", "1");
INSERT INTO TB_ALIMENTO_HAS_TB_FOODTRUCK (TB_ALIMENTO_NM_ID, TB_FOODTRUCK_NM_ID) VALUES ("3", "1");
INSERT INTO TB_ALIMENTO_HAS_TB_FOODTRUCK (TB_ALIMENTO_NM_ID, TB_FOODTRUCK_NM_ID) VALUES ("2", "2");
INSERT INTO TB_ALIMENTO_HAS_TB_FOODTRUCK (TB_ALIMENTO_NM_ID, TB_FOODTRUCK_NM_ID) VALUES ("2", "3");

/*INSERÇÃO DE COMENTÁRIO RELATIVO A FOODTRUCK*/

INSERT INTO TB_COMENTARIO (TE_COMENTARIO, NM_ID_FOODTRUCK) VALUES
	("Mussum Ipsum, cacilds vidis litro abertis. Per aumento de cachacis, eu reclamis. 
	A ordem dos tratores não altera o pão duris Nec orci ornare consequat. Praesent 
	lacinia ultrices consectetur. Sed non ipsum felis. Interessantiss quisso pudia ce 
	receita de bolis, mais bolis eu num gostis.", 1);
	
INSERT INTO TB_COMENTARIO (TE_COMENTARIO, NM_ID_FOODTRUCK) VALUES
	("Best design, furthermore pleasure to use after that Jony Ive’s incredible design,
	first Siri is better than TellMe and Google Voice put together generally iPhone 
	rip-offs, another point is that Apple will only get better to whom profit, on the
	whole profit suddenly gorgeous, to sum up gorgeous, afterwards delay in getting 
	Ice Cream Sandwich, prior to user experience sucks, soon profit, despite Android
	geek, exactly because profit, apparently iCloud in contrast genius.", 2);

INSERT INTO TB_COMENTARIO (TE_COMENTARIO, NM_ID_FOODTRUCK) VALUES
	("Professional fanboy and Android sells more phones in conclusion Google Voice is 
	better than Siri and TellMe put together, such a fanboi soon marketing, despite 
	you suck. Apple copied LG besides you don’t know anything after you suck overall 
	hypnotised at last Apple are nothing without Steve Jobs, apparently Apple didn’t
	invent anything, nevertheless sucky ass, eventually professional fanboy, in the 
	beginning fanboy.", 3);
	
/* 
Exemplo de query para saber quais alimentos determinado foodtruck vende.
Nesse select, o resultado será uma tabela mostrando que o foodtruck 1 vende os alimentos 1 e 3, 
e que o foodtruck 2 vende o alimento 2.
*/

SELECT TB_FOODTRUCK.TE_NOME, TB_ALIMENTO.TE_ALIMENTO FROM TB_FOODTRUCK 
	JOIN TB_ALIMENTO_HAS_TB_FOODTRUCK JOIN TB_ALIMENTO 
	ON TB_FOODTRUCK.NM_ID = TB_ALIMENTO_HAS_TB_FOODTRUCK.TB_FOODTRUCK_NM_ID
	AND TB_ALIMENTO_HAS_TB_FOODTRUCK.TB_ALIMENTO_NM_ID = TB_ALIMENTO.NM_ID;
	


	
	
	
	