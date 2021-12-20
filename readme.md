# URL shortener
 No third party library/framework used for the implementation. 
 Url shortened as per the requests
## Shortened URL calls
Redirected to corresponding original urls
## Shortened functions
Corresponding unique code generated for the url
```php
 $code = generate_short_url($url);// generate corresponding key
```
## Storing Shortened URLS
Storing the shortened url for future tracking and return short url
```php
 $code = store_url($url);// storing shortened url
```
## Fetch and redirect Shortened URLS
If the shorten url is called, then the url will redirect to original link
```php
 $code = fetch_url($url);// To fetch shortened url
```
## Working set up

Db available in data/db.sql
Corresponding settings update in database.php file.

## Working flow
Configutration setted in config.php file.There is base url, charcter set are defined as global variable.The shortend url details stored in `short_links` table. There is option to generate shorten url for the link.



