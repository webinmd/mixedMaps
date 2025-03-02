## mixedMaps

Компонент для MODX2
Вывод карты и маркера в админ панели для TV поля 


### Системные настройки
        
Название |  Описание | Ключ  | Значение |  
------------- | ------------- | ------------ | ------------ |
Класс загружаемой карты |   | mixedmaps_map_class | Leaflet
JS файл подгружаемый на сайт | Может быть пустым | mixedmaps_frontend_js | /assets/components/mixedmaps/libs/leaflet/web.js



### Параметры
 

Название |  Описание | Ключ  | Значение |  
------------- | ------------- | ------------ | ------------ |
ID блока карты |   | mapId | map
Класс блока карты |   | mapClass | mixedmaps
Центр карты |   | mapCenter | -
Чанк вывода |   | tpl | -
Координаты точки | Координаты через запятую | coordinates | -
Параметры для карты | Передаются в js файл рендера  | mapParams | map
JS файл рендера карты и маркеров |   | mapJs | /assets/components/mixedmaps/libs/leaflet/web.js
TV поле с координатами | Можно указать вместо coordinates   | tv | -
ID ресурса с координатами | Если не указаны координаты и указан TV - координаты будут получены самостоятельно | resource | -


### Пример 

```
{'!mixedMaps'|snippet:[
    'mapId' => 'map',
    'elementClass' => 'contact-map',
    'coordinates' => '47.054498550000005,28.86587997933522',
    'mapParams' => [ 
        'zoom' =>  13,
        'scrollWheelZoom' => false
    ]
]} 

```