# Інтернет-магазин одягу та аксесуарів Divisima

Проєкт був розроблений як дипломна робота за допомогою фреймворку PHP Laravel.
У приорітет ставилася Backend розробка.

## Про проєкт

Магазин розділений по групам категорій (стать людини). Для кожної групи категорій є окремий розділ магазину, де відображено індивідуально всі пункти меню, бренди (до яких прив'язаний хоча б один товар цієї групи категорій), банери та інше. Тобто, група категорій - це великий окремий розділ (як і у приміщенні магазину), у якому відображається все індивідуально для даної групи категорій.

### Реалізовано наступний функціонал:

#### _Відображення товарів_
Відображення відбувається за групами категорій (Жінки/Чоловіки тощо), категоріями та підкатегоріями (підкатегорії та категорії передбачено окремо для кожної групи категорій). 
#### _Сторінка товару_
На даній сторінці відображена уся інформація про товар та наявна можливість додати його у кошик (для будь-якого користувача), а також залишити відгк (для зареєстрованих користувачів).
#### _Банери_
Знаходяться на головній сторінці, для кожної групи категорій індивідуально.
#### _Пошук товарів_
В залежності від сторінки з якої він здійснюється - виконується пошук товарів з урахуванням групи категорій, якій належить сторінка. Тобто, якщо користувач знаходится у розділі для чоловіків, то пошук виконається тільки по товарам для чоловіків (_Реалізовано за допомогою пошукового двигуна **ElasticSearch**_).
#### _Фільтрація товарів_
Реалізовані фільтри по розмірам, кольорам, брендам, сезонам, матеріалам, цінами (проміжок) (_Реалізовано за допомогою пошукового двигуна **ElasticSearch**_).
#### _Сортування_ 
На кожній сторінці передбачено сортування відображення товарів як і без застосування фільтрів, так і з ними (_Реалізовано за допомогою пошукового двигуна **ElasticSearch**_).
#### _Кошик_
Додавання товарів у кошик можливо як і зареєстрованому користувачу так і незареєстрованому. У кошику є можливість обрати промокоди (про них далі).
#### _Оформлення замовлення_
Також доступне для усіх відвідувачів магазину. 
#### _Промокоди_
"З коробки" (при застосуванні db:seed) у базі даних є 2 промокоди, з якими взаємодіє деякий функціонал: для кожного нового користувача видається промокод на знижку 15% (з деякими умовами для застосування), за загальну кількість товарів у кошку (вказана у таблиці).
#### _Особистий кабінет_
У кожного зареєстрованого користувача є доступ до особистого кабінету. Там він може відфільтрувати та переглянути замовлення, їх деталі та статус який поставив адміністратор. Також є можливість змінити налаштування профілю, пароль, пошту, ім'я тощо. У кабінеті також відображаются активні промокоди користувача, які він може застосувати та їхній опис, умови застосування. Відображена також інформація про кількість здійснених замовлень користувачем та їхню суму.
#### _Відгуки_
Кожен зареєстрований користувач може залишити відгук про товар з оцінкою. Також на основі оцінок відображаються "зірочки" та кількість відгуків у кожного товара на його сторінці.
####  _Реєстрація_
Доступна реєстрація для усіх користувачів.
#### _Авторизація_
Раніше зареєстровані користувачі можуть, звісно, увійти в свій акаунт. У разі, якщо користувач забув пароль, існує відповідна кнопка на сторінці входу для відправки повідомлення на пошту користувачу з посиланням для відновлення паролю.
#### _Ролі_
У кожного користувача за замовчуванням є відповідна роль 'user". Також є "з коробки" ролі "content manager", "orders manager", "feedback manager" та "super admin". Відповідно до їх назви можна зрозуміти набір  їх доступів до пунктів адмін-панелі та виконання певних дій.
#### _Адміністративна панель_
Уся база даних може регулюватись адміністратором за допомогою адміністративної панелі (за наявності доступу, про нього нижче). У ній в таблицях відображені усі необхідні дані, доступні для редагування, або створення нових. А саме:
   
  + **Товари**. Додавання, редагування, видалення товарів, усіх їх додаткових параметрів (розміри, матеріали, бренди тощо) окремо. За кожним товаром закріплена якась кількість його розмірів, які мають кількість цього самого товару. Наприклад 44-го розміру на складі знаходиться 1000 шт., 45-го - 2000 шт. Це все можна регулювати при додаванні, редагуванні товарів. Також встановлення знижки, прив'язка до банеру (акції), зображення тощо.
  + **Замовлення**. Редагування та перегляд кожного замовлення та надання йому певного статусу. При наданні статусу "Доставляється" (з коробки при виконанні db:seed ці статуси буде вже додано) - для всіх товарів з даного замовлення від кількості певного розміру цього товару автоматично відніметься кількість цього товару у замовленні (коли забрали якусь кількість товару якогось розміру зі складу та відправили клієнтові).
  + **Властивості товарів**. Сезони, розміри, матеріали, бренди, кольори - усе це може бути відредаговано або додано до магазину.
  + **Категорії**. Усі види категорій також можна редагувати, додавати та видаляти.
  + **Повідомлення**. Зі сторінки контактів можна відправити фідбек, який можна буде переглянути відповідній людині (за наявності ролі) у цьому розділі адміністративної панелі.
  + **Промокоди**. Можна також додавати, редагувати промокоди та їхні умови застосування.
  + **Банери**. Банери, що на головній сторінці також представлені у адміністративній панелі для редагування, видалення чи додавання.
  + **Користувачі**. Так звані суперадміни можуть редагувати користувачів та надавати ім якість ролі.

## У розробці
- Інтегровація Docker + NGINX + php-fpm + mysql + Elasticsearch
- Покриття коду Unit тестами.


## Розгортання проєкту 
**_[У найближчий час Elasticsearch буде жити у Docker контейнері. Поки що для роботи пошуку потрібно його завантажити безпосередньо на ПК]_**

Для того, щоб коректно розгорнути проєкт локально, потрібно виконати наступні кроки:

- Завантажити у папку серверу проєкт (для OpenServer папка domains);
- Скопіювати у файл `.env` зміст файлу `.env.example` та налаштувати відповідно до своїх налаштувань серверу та БД;


**_[УВАГА!] Оскільки пошук,  фільтрація та сортування товарів працюють на основі запитів до пошукового двигуна ElasticSearch, тому для коректної їх роботи необхідно встановити та запустити пошуковий двигун ElasticSearch. А також визначити його хост та порт у змінній `ELASTICSEARCH_HOSTS` файлу `.env`_. _** 

- У консолі, знаходячись в дерикторії проєкту виконати наступні консольні команди почергово:
    + `composer install`
    + `php artisan key:generate`
    + `php artisan migrate`
    + `php artisan db:seed`
-  Якщо розраховуєте на фільтрацію, сортування та пошук, і вже запущено пошуковий двигун ElasticSearch, то виконайте команду `php artisan search:reindex` для індексації товарів, щоб їх міг бачити пошуковий двигун та враховувати їх при виконанні пошуку.
-  Для запуску проєкту виконати команду `php artisan serve`


Після виконання вищевказаних кроків проєкт має бути повністю готовим для використання з деякими початковими даними у БД.

### Акаунти:
В залежності від ролі акаунту представлені окремі пункти меню в адміністративній панелі. Якщо вам вдалося виконати раніше команду `php artisan db:seed`, то нижче представлені "креди" для входу в акаунти вже створених користувачів:

| Роль                  |             Логін             |                                  Пароль |
|-----------------------|:-----------------------------:|----------------------------------------:|
| Адміністратор         |      admin@divisima.com       |                                   admin |
| Контент менеджер      | content_manager@divisima.com  |                         content_manager |
| Менеджер замовлень    |  orders_manager@divisima.com  |                          orders_manager |
| Менеджер повідомдлень | feedback_manager@divisima.com |                        feedback_manager |
| Користувач            |       user@divisima.com       |                                    user |
