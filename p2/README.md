# Práctica 2 SIBW
Práctica 2 de la asignatura Sistsemas de Información Basados en Web.

## Objetivos de la práctica
* Realizar una primera toma de contacto con Javascript

## Descripción de la práctica
El objetivo de la práctica es el diseño de un espacio para comentarios que los
usuarios del sitio pueden hacer asociados a cada uno de los eventos mostrados
en el sitio. Los cambios han de realizarse en el archivo evento.html.
Debe tener la siguiente funcionalidad:
  * El panel de comentarios debe estar oculto a la derecha, y desplegarse al
    pulsar un botón de comentarios.
  * Cuando se despliegue, deberá contar con dos comentarios predefinidos
    (como si hubieran sido introducidos por usuarios anteriores de la web).
  * Cada comentario tendrá autor, fecha y hora del comentario y texto del
    comentario.
  * A continuación de los dos comentarios existentes, habrá un formulario con
    los siguientes campos:
      * Nombre.
      * E-mail.
      * Texto del comentario.
      * Botón de enviar.

  * Al pulsar el botón de enviar, el texto del comentario se incluirá de forma
    similar a los ya existentes a continuación de estos usando Javascript.
    Obviamente, al no estar guardando los comentarios en ningún sitio dichos
    comentarios nuevos desaparecerán al recargar la página.

  * Al pulsar el botón de enviar, antes de incluir el texto del comentario se
    comprobará que todos los campos han sido rellenados. En caso negativo
    se avisará con un dialogo modal y NO se incluirá el comentario. Además
    se realizará también una validación del e-mail (que sea un e-mail válido).

  * Conforme el usuario escribe el comentario, el sistema detectará mediante
    Javascript la aparición de palabras prohibidas (se pueden definir hasta
    10 palabras prohibidas en el script). Cada uno de los caracteres de cada
    palabra prohibida se sustituirá por un * en tiempo de escritura.

   
