# cld2-php-language-detection-library
PHP library for language detection build on top of CLD2.

# Topicos para explicar
 * Está é uma biblioteca free para detecação de idiomas usando PHP.
 * Está biblioteca funciona sobre a a exteção https://github.com/fntlnz/cld2-php-ext que por usa vez funciona sobre https://github.com/CLD2Owners/cld2
 * Falar que para esta library funcionar é necesário usar o docker, tanto para construir a imagem a partir do Dockerfile, ou tbm baixar a imagem da minha conta doker.
    * Precisa explicar que o dockerfile apenas monta o ambiente para se usar esta library, mas não adiciona a library propriamente dita.
    * Em oturas palavras, este dockerfile instala e configura todas as dependencias necessarias para este projeto funcionar, porem, não disponibiliza nenhuma porta ou servico HTTP para consumir esta library.
    * Este docker é basicamente uma imagem base para que vc possa criar outras imagens dockers que vão disponibilizar um meio de consumir esta biblioteca.
        * Isto na verdade já é feito em https://github.com/stavarengo/language-detection-service
 * Dizer tbm que toda essa configuração de ambiente está disponivel gratuitamente na URL http://free-language-detector-online.stavarengo.me/
 * Documentar como usar esta library caso o cara faça questão de usar ela ao inves de usar o nosso site.
