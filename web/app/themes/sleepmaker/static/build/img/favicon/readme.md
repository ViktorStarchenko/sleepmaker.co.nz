# favicon

### Путь размещения после сборки:

    /build/img/favicon

### Информация:

**Что такое favicons?**

Favicons - это небольшие файлы иконок размером 16x16, которые отображаются рядом с URL-адресом вашего сайта в адресной строке браузера. Кроме того, они часто отображаются рядом с названием вашего сайта в списке открытых вкладок и списках закладок пользователя, что упрощает пользователю быстрый поиск среди других сайтов.

### https://www.favicon-generator.org/

**Что делает этот инструмент?**

Хотя многие современные веб-браузеры поддерживают значки избранного, сохраненные как GIF, PNG или другие популярные форматы файлов, все версии Internet Explorer по-прежнему требуют сохранения значков в виде файлов ICO ( формат значков Microsoft ). Этот инструмент предоставляет простой способ конвертировать любой GIF, PNG или JPEG в ICO, который поддерживается всеми современными веб-браузерами. Он также позволяет создавать значки с нуля с помощью удобного онлайн-редактора. Кроме того, редактор позволяет вручную настраивать сгенерированные значки избранного для обеспечения наилучшего результата.

Использование генератора:

1. Загрузите изображение (PNG в ICO, JPG в ICO, GIF в ICO)
2. Включите следующий код в заголовок вашего HTML-документа.
    ```html
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    ```
3. Загрузите созданный архив и распакуйте его содержимое в корневой каталог вашего сайта (в нашем случае `img/favicon`)