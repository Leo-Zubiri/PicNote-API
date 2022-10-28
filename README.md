# **PicNote API**

La documentación busca registrar todos los aspectos importantes desde la configuración hasta la finalización de ésta API hecha con el framework laravel (PHP).

La funcionalidad esperada queda descrita a continuación:

Se dan de alta apuntes tomados como fotografías o notas, estos apuntes pertenecen a materias de las cuales se toman clases. El objetivo es conseguir una manipulación tipo álbum, con mayor organización de apuntes según las respectivas materias a las que pertenecen.

Se busca que la funcionalidad de esta API sea dinámica. Segun las materias dadas de alta por el usuario y su respectivo horario, la alta de apuntes debe asignarse de forma organizada y de forma automática hacia la materia o álbum correspondiente. 

## **SETUP del proyecto**

```composer create-project laravel/laravel PicNote-API```

## **DISEÑO**

Diseño prototipo para generar un diagrama en [**dbDiagram.io**](https://dbdiagram.io/):

```SQL
Table User {
  userID int
  username varchar 
  password password
}

Table Course{
  courseID int
  albumID int [ref: > Album.albumID]
  name varchar
  group char
  grade int
  schedule datetime
  daysperweek list
}

Table Album{
  albumID int
  userID int [ref: > User.userID]
  name varchar
  desc varchar
}

Table Note {
  noteID int
  courseID int [ref: > Course.courseID]
  imageUrl varchar
  title varchar
  desc varchar
  creationDate datetime
  isHomework boolean
  dueTo datetime
}
```
![](doc/img/tablesDesign.png)