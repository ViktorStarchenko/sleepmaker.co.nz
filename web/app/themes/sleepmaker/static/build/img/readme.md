# Изображения

### Путь размещения после сборки:

    /build/img

### Пример использования:

CSS
```css
.logo {
	background-image: url(../img/logo.svg);
}
```
HTML
```html
<img src="img/logo.svg" alt="logo" />
```

### Cтруктура:

* `/src`
  * `/favicon` - директория для хранения набора "значков для избранного"
    * `favicon.ico` - значёк
  * `/icons` - директория для храненения иконок сайта
    * `icon.svg` - иконка
  * `logo.svg` - главня иконка
  * `social.jpeg` - изображение для исползования в Open Graph