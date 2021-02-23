# WP Starter theme

## Initial setup
1. Установить Wordpress
2. Установить тему
3. Установить зависимости PHP (`composer install`)
4. Выполнить `npm install`
5. На время разработки `npm run watch`
6. Для сборки `npm run build`
7. Для выгрузки на срвер `npm run production`
8. Использовать eslint  `npm run eslint:fix`

# Documentation

**При активации темы, на почту, которая была указана при создании сайта, будет приходить письмо с логином и паролем.
Логин всегда `client` пароль рандомный.
Так же будет создан файл в корне темы с теми же данными что и в письме**
## Только этого юзера можно давать клиенту

## Eslint

**Для Eslint применяется Airbnb JavaScript Style Guide (https://github.com/airbnb/javascript). 
Документация по правилам Eslint - https://eslint.org/** 

## Создание типа записи

Для создания типа записи необходимо создать объект типа PostType
из RST\Base\Structure.

В кконстуктор нееобходимо передать имя создаваемого типа записей.
При необходимости, можно переопределить заданные по-умолчанию
надписи и аргументы типа записей через методы `setArgs` и `setLabels`

**Пример:**
```php
use RST\Base\Structure\PostType;

// Создаем тип записи
$services = new PostType('services');

// Устанавливаем надписи
$services->setLabels([
    'name' => __('Services')
]);

// Меняем аргументы
$services->setArgs([
    'rest_base' => 'services_rest_base'
]);
```

## Создание таксономии

Для создания таксономии необходимо создать объект типа Taxonomy
из RST\Base\Structure.

В констуктор нееобходимо передать имя создаваемой таксономии и слаг.
Причем, слаг не является обязательным параметром.

При необходимости, можно переопределить заданные по-умолчанию
надписи и аргументы таксономии через методы `setArgs` и `setLabels`

В любой момент можно установить слаг таксономии через метод `setSlug`

Для любой тасономии, созданной таким образом, существует возможность
указания любого количества созданных типов записей при помощи метода `uses`

**Пример:**
```php
use RST\Base\Structure\Taxonomy;

// Создаем таксономию
$servicesCategory = new Taxomony('services_cat');

// Устанавливаем надписи
$servicesCategory->setLabels([
    'name' => __('Services category')
]);

// Меняем аргументы
$servicesCategory->setArgs([
    'rest_base' => 'services_category'
]);

// Устанавливаем слаг
$servicesCategory->setSlug('services');

// Указываем тип записи ($books и $works - тоже типы записей)
$serviceCategory->uses($services);
$serviceCategory->uses($books);
$serviceCategory->uses($works);
```

## Создание ресурсов REST API
### Общие правила
Ресурсы в REST используются для создания групп методов для работы с одним и
тем же набором / типом данных. В рамках стартовой темы каждый ресурс должен
быть реализован в отдельном классе.

### Создание ресурса
Для создания ресурса необходимо в рамках простанства имен `RST\Rest\Resources` 
(папка src/Rest/Resources) создать класс, реализующий интерфейс 
`RST\Base\Rest\ResourceInterface` 

Далее ресурсу необходимо указать пространство имен, реализовав метод `getResourceName`.
Метод должен возврашать строку, которая будет использована в качествее пространства имен.

**Пример:**
```php
namespace RST\Rest\Resources;

use RST\Base\Rest\ResourceInterface;

class TestData implements ResourceInterface
{
    public function getRoutes(): array
    {
        return [];
    }

    public function getResourceName(): string
    {
        return 'test_data';
    }
}
```
### Создание endpoint
Для создания endpoint необзодимо добавить элемент в массив, возвращаемый функцией `getRoutes`

Ключем должен быть абсолютный путь от корня пространтства имеен, в качестве значения должны быть
переданы аргументы endpoint, в частности, метод, возвращающий массив обработынных данных. 
Вызываемая функция обязана быть статической. 

**Пример: (на базе созданного выше класса)** 

```php
public function getRoutes(): array
{
    return [
        '/' => [
            'methods'  => 'GET',
            'callback' => [ __CLASS__, 'testRoute' ]
        ]
    ];
}

public static function testRoute()
{
    return ['test' => 'data'];
}
```

## Работа с Gutenberg
### Общие правила
1. Все блоки Gutenberg и связанные с ними элементами размещаются в папке blocks
2. Независимо от объема, для каждого блока создается папка, соответствующая имени блока
3. Точкой входа для каждого блока, по умолчанию считается файл main.js
4. Файл main.js блока должен быть импортирован в общий bundle через файл `blocks/entry.js` 
5. Список зависимостей блока может быть расширен через функцию `setDependencies` базового объекта Gutenberg

**Пример:**
```php
use RST\Theme;

$theme = Theme::getInstance();
$theme->gutenberg->setDependencies([
    'wp-blocks', 
    'wp-element', 
    'wp-editor', 
    'wp-components', 
    'wp-data'
]);
```

### Создание динамического блока
Для создания динамического блока следует выполнить слеедующее:

1. Создать в пространстве имен `RST\Blocks` класс, расширяющий `RST\Gutenberg\GutenBlock`
либо реализовующий интерфейс `RST\Gutenberg\Guten\BlockInterface`
2. Создать функцию, отвечающую за серверный рендеринг блока. 
**ВАЖНО !!! _Функция возвращает строку. Во время выполнения функции ничего не должно выводиться на экран_**
3. Зарегистрировать функцию серверного рендеринга блока в базовом объекте Gutenberg

Пример: 
```php
use RST\Theme;
use RST\Blocks\PostSnapshot;

$theme = Theme::getInstance();
$theme->gutenberg->register([
    'block' => 'post-snapshot',
    'render' => [PostSnapshot::class, 'renderCallback']
]);
```

### Оформление блоков
Блоки поддерживают импорт scss-стилей внутри точки входа.
Для этого достаточно создать файл стилей в папке с блоком и импортировать
стили в точке входа.

**Пример:**
```javascript
import './admin.scss';
import './front.scss';
```
