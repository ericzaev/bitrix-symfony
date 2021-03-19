## Symfony в Битрикс

### Список всех комманд
Через Symfony/Console: `php bin/console`

Создание своей команды `php bin/console make:command`

Подробнее [тут](https://symfony.com.ua/doc/current/console.html)

### Профилирование
На странице http://localhost/_profiler/

![profiler](https://i.ibb.co/Wg6kC88/2020-10-11-16-55-04.png)

### Доступ к сервис-контейнеру
В файле /local/php_interface/functions.php определены две функции: 1) service(string); 2) instance(string). 

Оба одинаковы но по смыслу они отличаются. Как правило сервисы - twig, doctrine, form; их можно назвать таковыми т.к. предоставляют услуги.

Получение экземпляра класса `CategoryRepository` через **instance**.
```
use App\Repository\CategoryRepository;

foreach (instance(CategoryRepository::class)->find(1)->getNews() as $news) {
	var_dump($news->getTitle());
}
```
Получение сервиса doctrine через **service** и использование языка DQL.

```
$query = service('doctrine')->getManager()->createQuery("SELECT n FROM App:News n JOIN n.category c WHERE c.name = 'politic'");

foreach ($query->getResult() as $news) {
	var_dump($news->getTitle());
}
```

Шаблонизатор twig
```
echo service('twig')->render('test.html.twig');

{# templates/test.html.twig #}
{% if is_granted('ROLE_SUPPORT') %}
    you support user
{% endif %}

{% if is_granted('ROLE_ADMIN') %}
    you admin user
{% endif %}
```

Сервис форм
```
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

$form = service('form.factory')
    ->createBuilder(FormType::class)
    ->add('task', TextType::class)
    ->add('dueDate', DateType::class)
    ->add('save', SubmitType::class, array('label' => 'Create Task'))
    ->getForm();

echo service('twig')->render('default/new.html.twig', array(
    'form' => $form->createView(),
));

{# templates/test.html.twig #}
{{ form_start(form) }}
{{ form_widget(form) }}
{{ form_end(form) }}
```
Подробнее о сервис-контейнере [тут](https://symfony.com.ua/doc/current/service_container.html)

### Доступ к ИБ через Doctrine
```
$query = service('doctrine')->getManager()
	->createQuery("SELECT e FROM App:Iblock\Element e JOIN e.properties p JOIN p.iblockProperty ip WHERE ip.code = 'PHONE' AND p.value = '556677'");
```

Или в режиме QueryBuilder
```
$mg = service('doctrine')->getManager();

$qb = $mg->createQueryBuilder()->select('a')->from('App:Iblock\Element', 'a');

foreach (['PHONE' => '556677' , 'PERSON' => 'Иванов Василий Петрович'] as $code => $value) { //
	$iqb = $mg->createQueryBuilder($code)
		->select('e')
		->from('App:Iblock\Element', 'e')
		->join('e.properties', 'p')
		->join('p.iblockProperty', 'ip');

	$iqb->where(
		$iqb->expr()->eq('ip.code', $iqb->expr()->literal($code)),
		$iqb->expr()->eq('p.value', $iqb->expr()->literal($value))
	)->andWhere('a.id = e.id');

	$qb->andWhere($qb->expr()->exists($iqb->getDQL()));
}

echo ($qb->getQuery()->getSql());
```

И вывод результата
```
foreach ($qb->getQuery()->getResult() as $element) {
	foreach ($element->getProperties() as $property) {
		if ($property->getValueEnum()) {
			var_dump($property->getValueEnum()->getValue().' -> '.$property->getIblockProperty()->getCode());
		} else if ($property->getUser()) {
			var_dump($property->getUser()->getLogin().' -> '.$property->getIblockProperty()->getCode());
		} else if ($property->getElement()) {
			var_dump($property->getElement()->getName().' -> '.$property->getIblockProperty()->getCode());
		} else {
			var_dump($property->getValue().' -> '.$property->getIblockProperty()->getCode());
		}
    }   
}
```

Такие вызовы через QueryBuilder конечно лучше обернуть в методы `Repository/Iblock/ElementRepository.php` 
Рекомендую использовать стандартную библиотеку битрикс для ИБ. Doctrine можно использовать заместо HL.

Подробнее об этом режиме [тут](https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/query-builder.html)

### Контроллеры
Они доступны по адресу localhost/api/v2. Пути прописаны в www/.htaccess `RewriteRule ^(api/v2|_profiler) /local/api/symfony/index.php [L]`

Создание контроллеров происходит через `php bin/console make:controller`

Подробнее [тут](https://symfony.com.ua/doc/current/controller.html)

### Аунтификация через провайдер Bitrix
Определена в файле symfony/src/Security/BitrixAuthenticator.php (по логину `$USER->GetLogin()`) 

Проверку прав доступа можно использовать через `@IsGranted("ROLE_ADMIN")`. 
Пример в контроллере `symfony/src/Controller/PingController.php`.

### Миграции Symfony
В настройках Doctrine `symfony/config/packages/doctrine.yaml` включен фильтр `schema_filter: ~^(?!b\_)~` 
дабы избежать удаления таблиц битрикса при создании миграции symfony.

#### Импорт таблиц битрикса в сущность Doctrine.
Импорт - создает класс/сущность на осове таблицы из БД.

Перед импортом, добавить (на время) в исключения нужную таблицу, например **b_iblock_element**. 
`schema_filter: ~^((?!b\_)|b_iblock_element$)~` и выполнить команду:
`php bin/console doctrine:mapping:import "App\Entity" annotation --path="symfony/src/Entity" --filter="BIblockElement"` 
(в фильтре используется CamelCase название таблицы). 

Импортирует только в свойства/аттрибуты класса, без геттеров/сеттеров и репозитория.
Для генерации используйте: 
1. Дописать аннотацию (src/Entity/BIblockElement.php)  `@ORM\Entity(repositoryClass="App\Repository\BIblockElementRepository")`
2. Выполнить команду `php bin/console make:entity --regenerate BIblockElement`
3. Смотрим результат
4. В классе переписать аннотацию `@ORM\Entity(repositoryClass=BIblockElementRepository::class)`

Не забудьте убрать таблицу из schema_filter.

## Локальное развертывание (Docker)
В данном способе отсутствует поддержка PushServer. Если она вам нужна: используйте вариант с VirtualBox.

### Unix систем
1. Скопировать файл .env.example -> .env
2. Предварительно установить пакеты: wget, zip, unzip
3. Запустить команду в терминале: bash ./deploy_docker.sh
4. ~~Ввести пароль к архиву (core.zip, dump.zip)~~
5. Ждем скачивания и распаковки

### Windows
Запустить через WSL ./deploy.sh или вручную скачать архивы.

### Настройка БД
Прописать настройки подключения `www/bitrix/.settings.php` и `www/bitrix/php_interface/dbconn.php`
```
'host' => '10.100.0.3',
'database' => 'bitrix',
'login'    => 'bitrix',
'password' => 'secret',
```
###### .env
```
MYSQL_HOST=10.100.0.3
MYSQL_DATABASE=bitrix
MYSQL_USER=bitrix
MYSQL_PASSWORD=secret
MYSQL_ROOT_PASSWORD=secret
```
### Настройка Redis
```
REDIS_URL=redis://secret@10.100.0.7:6379
REDIS_HOST=redis
REDIS_PORT=6379
REDIS_PASSWORD=secret
```

## Локальное развертывание (VirtualBox)

### Настройка BitrixVM7

Скачать образ [VirtualBox](https://repos.1c-bitrix.ru/vm/vm_bitrix24_crm_virtualbox.zip)

Импортировать

![Import](https://i.ibb.co/88zHWMF/2020-10-10-19-39-16.png)

Примонтировать раздел от корня репозитория

![Shared folders](https://i.ibb.co/n63kmBD/2020-10-10-15-03-47.png)

Пробрасываем порты Network -> Port Forwarding

![Port Forwarding](https://i.ibb.co/3ddKZKc/2020-10-10-19-15-56.png)

Запускаем. BitrixVM предложит вам установить пароль.

После того как вы вошли в систему, прописать монтирование в `vim /root/.bashrc`
в конец строки добавить `mount -t vboxsf -o uid=600,gid=600 home /home/bitrix/` (проверено на macos и windows 10). 

Перезагружаемся и проверяем директорию `cd /home/bitrix && ll`. Если в ней есть файлы то монтирование прошло удачно. 

### Настройка и установка битрикс
1. Предварительно установить пакеты: `yum install wget zip unzip composer`
2. Добавляем недостающие модули в php. Прописываем в терминале:
3. `echo "extension=phar" > /etc/php.d/20-phar.ini` (для composer)
4. `echo "extension=pdo" > /etc/php.d/20-pdo.ini` (для doctrine)
5. `echo "extension=xmlwriter" > /etc/php.d/20-xmlwriter.ini` (для word/excel)
6. `echo "extension=xmlreader" > /etc/php.d/30-xmlreader.ini` (для word/excel)
7. `echo "extension=pdo_mysql" > /etc/php.d/30-pdo_mysql.ini` (для doctrine)
8. В конфигах `vim /etc/php.d/bitrixenv.ini` удалить строку `mbstring.func_overload` (для symfony)
9. В том же файле `vim /etc/php.d/bitrixenv.ini` поставить `sendmail_path = "cat >> ~/logs/mail.log"`
10. Обновить node `npm cache clean -f && npm install -g n && n stable` и перезагрузить машину.
11. Создать БД и пользователя `mysql -u root` -> `create database bitrix;` -> `CREATE USER 'bitrix'@'%' IDENTIFIED BY 'secret';` -> `GRANT ALL PRIVILEGES ON bitrix.* TO 'bitrix'@'%';` -> `FLUSH PRIVILEGES;` -> `exit;`
12. Зайти в директорию `cd /home/bitrix/`
13. Зайти от пользвателя bitrix `su bitrix` (это надо будет делать каждый раз перед запуском команд npm, composer, php bin/console, php bin/migrate)
14. Скопировать файл `cp .env.example .env` (и прописать [настройки БД](#настройка-бд) `vim .env`)
15. Запустить установщик `bash ./deploy_vbox.sh`. Он скачает дистрибутив bitrix24. ~~В процессе установки будет запрашивать пароль (два раза: 1. core.zip; 2. dump.zip.)~~
16. Генерируем секретные ключи для symfony: устанавливаем `yum install php-sodium` и `php bin/console secrets:generate-keys`
17. Скачать файл urlrewrite.php из development сервера и добавить в www/urlrewrite.php.

Если при сборке assets выходит ошибка (последний этап deploy_vbox.sh): пересоберите node-sass `npm rebuild node-sass` и после заново запустите сборку `npm run build` либо `bash ./deploy_vbox.sh`

###### push-server
Последний этап настроить подключение к [push-server](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=41&LESSON_ID=2033)

Решение проблемы с падением (при первом подключении) push-server [тут](https://pocketadmin.tech/ru/bitrix24-%D0%BD%D0%B5-%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B0%D0%B5%D1%82-push/)

### Настройка БД
Прописать настройки подключения `www/bitrix/.settings.php` и `www/bitrix/php_interface/dbconn.php`
```
'host' => '127.0.0.1',
'database' => 'bitrix',
'login'    => 'bitrix',
'password' => 'secret',
```
###### .env
```
MYSQL_HOST=127.0.0.1
MYSQL_DATABASE=bitrix
MYSQL_USER=bitrix
MYSQL_PASSWORD=secret
MYSQL_ROOT_PASSWORD=secret
```
### bitrix/composer.json
Добавить в /bitrix/.settings.php
```
'composer' => [
  'value' => ['config_path' => '/home/bitrix/composer.json']
],
```
[Документация](https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=4637&LESSON_PATH=3913.3516.4776.2483.4637)
### Убираем шаблон 404
Из-за отсутствия файлов в директории /upload/, битрикс подставляет шаблон "Карта Сайта" на каждый запрос, что увеличивает нагрузку.

Решение: закомментить строку в файле `vim /etc/nginx/bx/conf/errors.conf` -> `#error_page 404 = @fallback;` и перезапустить nignx `systemctl restart nginx`


## Webpack Encore (Vue, Bootstrap, Widgets)

### Библиотеки/Фреймворки
1. Bootstrap и [Bootstrap-vue](https://bootstrap-vue.org/docs/components), стили изолированы (.bootstrap-styles)
2. moment - дата и время
3. lodash - [функции](https://lodash.com/docs/4.17.15)
4. axios - ajax
5. eslint - правописание

### Запуск
###### Сборка
`npm run build` результат `www/assets/public`. 
###### dev-server (hot-reload)
`npm run dev-server` проксируется через 127.0.0.1 (битрикс). Автоматическое обновление кода и шаблона но без стилей.
> Encore does support HMR for Vue.js, but does not work for styles anywhere at this time.

### Ипользование в шаблонах битрикс (через виджеты)
Виджеты автоматически монтируются; где `is="sale/order"` - путь к виджету от директории assets/widget. Пропсы передаются через аттрибут data и имеют тип данных (type:value).
```
<div is="sale/order" data-id="int:<?=$order->getId();?>" data-list="array:<?=json_encode($order->getList());?>"></div>
```

### Правила компонентов (Vue)
###### Директории
Виджеты: `./widget/{module name}. `
Повторно используемые компоненты: `./components/common. `
###### Дочерние компоненты
Дробление компонента происходит на директории, в нижнем регистре. 

Пример. Виджет заказа находится `./widget/sale/order.vue`, а список корзины заказа `./components/widget/sale/order/basket.vue`; каждый элемент корзины имеет свой компонент и т.п. 

![Components](https://i.ibb.co/chGjH1g/2020-10-11-13-34-27.png)
###### Пропсы
Пропсы должны быть типизированы
```
props: {
    id: {
      type: Number,
      required: true
    },
    list: {
      type: Array,
      required: true
    }
},
```

## Псевдонимы Символьные коды в ИБ, HL, Группах, Свойствах
Использовать где можно **символьный код** ИБ/HL. **ID** ИБ/HL могут быть разные на разных машинах. Это касается свойств (тип список), групп и т.д.

Метод для получения символьного кода по ID ИБ: `getIblockCodeById(int $id): ?string`

Метод для получения ID по символьному коду ИБ: `getIblockIdByCode(string $code, ?string $type = null): ?int`

Например, если в компонент надо передать IBLOCK_ID.
```
"HIDE_LINK_WHEN_NO_DETAIL" => "N",
"IBLOCK_ID" => getIblockIdByCode('bulletin', 'news'),
"IBLOCK_TYPE" => "news",
"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
```

Тоже самое и касается групп пользователей: не использовать ID.
```
use Local\Main\User;

$user = User::getInstanceCurrent();
$user->getGroups() // ['ROLE_ADMIN', 'ROLE_USER']
$user->setGroups(['ROLE_ADMIN', 'ROLE_USER'])
$user->addGroups(['ROLE_ADMIN', 'ROLE_USER'])
$user->removeGroups(['ROLE_ADMIN', 'ROLE_USER'])
```
или через функции
```
getGroupCodeById(7) // ROLE_SUPPORT
getGroupIdByCode('ROLE_SUPPORT') // 7
getGroupCodeById([1, 17, 7]) // ROLE_ADMIN, ROLE_SUPPORT, ROLE_USER
getGroupIdByCode(['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPPORT']) // 1, 7, 17
```
Получение HL экземпляра по названию сущности
```
use Bitrix\Highloadblock\HighloadBlockTable;

HighloadBlockTable::compileEntity(getHLIdByName('ProductMarkingCodeGroup'))
```

Под это правило так-же попадает тип свойства - "Список". В нем рекомендуется использовать XML_ID.

## Переменные окружения

Дабы не хардкодить и не хранить в коде конфиденциальные данные (токены, пароли и т.д), рекомендуется ипользовать переменные окружения. 

Используется [пакет](https://github.com/symfony/dotenv)

Файл .env (скопировать из .env.example)

###### Прим. Получение токена для сервиса smsc.kz в коде
```
env('SMSC_TOKEN')
```

###### APP_ENV
```
isDev() // true если APP_ENV=dev
isProd() // true если APP_ENV=prod
```

Например, отправить рассылку только админам если `APP_ENV=dev`
```
'RUB_ID' => $rubric['ID'],
'GROUP_ID' => getGroupIdByCode(isDev() ? ['ROLE_ADMIN'] : ['ROLE_USER']),
'AUTO_SEND_TIME' => date('d.m.Y H:i:s', strtotime('+1 minute')),
```

## Миграции bitrix в БД

Используется [модуль](https://github.com/andreyryabin/sprint.migration)

[Примеры команд](https://github.com/andreyryabin/sprint.migration/wiki#%D0%9F%D1%80%D0%B8%D0%BC%D0%B5%D1%80%D1%8B-%D0%BA%D0%BE%D0%BC%D0%B0%D0%BD%D0%B4)

```
php bin/migrate add (создать новую миграцию)
php bin/migrate ls (показать список миграций)
php bin/migrate up (накатить все миграции)
php bin/migrate down (откатить все миграции)
```

[Примеры миграций](https://github.com/andreyryabin/sprint.migration/tree/master/examples)

В директорию /www/local/php_interface/migrations садятся файлы миграции

### Правила создания 
1. Использовать символьные коды (ИБ, HL, групп, элементов)
2. Перед созданием проверять (в методе up) (через сим. код) создан-ли ИБ/HL/Группа/Элемент - во избежание появления дубликатов

## Другое

### Файл urlrewrite.php
Был удален из репозитория, причина - конфликтный т.к. bitrix его сам периодически сортирует и обновляет. Если вы добавляете страницу (которая использует ЧПУ) на локальной машине а затем в репозиторий, после пула в master/development сервере ее надо будет открыть в виз.редакторе и пересохранить (без изменений) чтобы добавилась запись в urlrewrite.php.

### Подтягивать зависимости если изменились/добавились фалы:
Зависимости:
1. composer.json - `composer install`
2. package.json - `npm install`

Миграции:
1. symfony/migrations - `php bin/console doctrine:migrations:migrate`
2. www/local/php_interface/migrations - `php bin/migrate up`
