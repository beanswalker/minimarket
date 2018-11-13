/*Utilizando Inner Join:... */
SELECT cosas.name as Nombre, cosas.description as Descripcion,
 cosas.stock as Unidades, cosas.status as Estado, categoria.name as Categoria,
 categoria.description as Tipo_Categ FROM store.article as cosas inner join
 store.category as categoria ON cosas.idcategory = categoria.idcategory;
 
 /*A la antigua, con Where reemplazando a ON, y la coma reemplazando a inner Join:..*/
SELECT cosas.id_article as ID_Art, cosas.name as Nombre, cosas.description as Descripcion,
 cosas.stock as Unidades, cosas.status as Estado, categoria.name as Categoria,
 categoria.description as Tipo_Categ  FROM store.article as cosas,
 store.category as categoria WHERE cosas.idcategory = categoria.idcategory && cosas.id_article=1;